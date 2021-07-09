<?php

namespace App\Http\Controllers;

use App\Models\DeliveryNote;
use App\Models\DraftPurchaseOrder;
use App\Models\EOrderItems;
use App\Models\Qoute;
use App\Models\User;
//use Barryvdh\DomPDF\PDF as PDF;
use App\Notifications\DpoApproved;
use App\Notifications\QuoteAccepted;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\SmartPunct\Quote;

class DraftPurchaseOrderController extends Controller
{
    public function index()
    {
        $user = auth()->user()->id;
        if(auth()->user()->registration_type == 'Supplier')
        {
            $dpos = DraftPurchaseOrder::where('supplier_user_id', $user)->where('supplier_business_id', auth()->user()->business_id)->where('status','approved')->get();
        }
        elseif(auth()->user()->registration_type == 'Buyer' || auth()->user()->can('Buyer DPO Approval') || auth()->user()->can('Buyer View Purchase Orders'))
        {
//            $dpos = DraftPurchaseOrder::where('user_id', $user)->where('business_id', auth()->user()->business_id)->where('status', 'pending')->get();
            $dpos = DraftPurchaseOrder::where(['business_id' => auth()->user()->business_id, 'rfq_type' => 1])->where('status', 'pending')->get();
        }
        return view('draftPurchaseOrder.index', compact('dpos'));
    }

    public function show(DraftPurchaseOrder $draftPurchaseOrder)
    {
        return view('draftPurchaseOrder.show', compact('draftPurchaseOrder'));
    }

    public function approved(DraftPurchaseOrder $draftPurchaseOrder)
    {

        try {
            DB::beginTransaction();

            $user_type = auth()->user()->registration_type;
            $user_type_id = auth()->user()->id;
            $user_business_type = auth()->user()->business->business_type;
            $user_business_type_id = auth()->user()->business->id;
            $status = "approved";
            $draftPurchaseOrder->update([
                'status' => $status,
                'po_status' => $status,
                'approval_details' => 'User_TYPE_' . $user_type . '_' . $user_type_id . '_Business_TYPE_' . $user_business_type . '_' . $user_business_type_id . '_' . date('Y-m-d h:m'),
            ]);

            $qoute = Qoute::find($draftPurchaseOrder->qoute_no);
            $order_items = EOrderItems::find($draftPurchaseOrder->rfq_item_no);
            $order_items->status = 'accepted';
            $order_items->save();

            $affected = DB::table('qoutes')->where('e_order_items_id', $draftPurchaseOrder->rfq_item_no)->where('id', '<>', $draftPurchaseOrder->qoute_no)->update(['qoute_status' => 'Rejected', 'qoute_status_updated' => 'Rejected', 'status' => 'expired']);
            DB::commit();
            /* Transaction successful. */
        } catch (\Exception $e) {

            DB::rollback();
            session()->flash('message', 'Due to some internal problem of server your quotation is not accepted please retry.');
            return redirect()->route('QoutationsBuyerReceived');
            /* Transaction failed. */
        }

        User::find($qoute->supplier_user_id)->notify(new QuoteAccepted($qoute));
        User::find(auth()->user()->id)->notify(new DpoApproved($draftPurchaseOrder));
        session()->flash('message', 'DPO Accepted.');
//        return redirect()->route('dpo.show', $draftPurchaseOrder->id);
        return redirect()->route('po.po');
    }

    public function rejected(DraftPurchaseOrder $draftPurchaseOrder)
    {
        $user_type = auth()->user()->registration_type;
        $user_type_id = auth()->user()->id;
        $user_business_type = auth()->user()->business->business_type;
        $user_business_type_id = auth()->user()->business->id;
        $status = "rejectToEdit";
        $draftPurchaseOrder->update([
            'status' => $status,
            'po_status' => $status,
            'approval_details' => 'User_TYPE_' . $user_type . '_' . $user_type_id . '_Business_TYPE_' . $user_business_type . '_' . $user_business_type_id . '_' . date('Y-m-d h:m'),
        ]);
        session()->flash('message', 'Business information successfully updated.');
        return redirect()->route('dpo.show', $draftPurchaseOrder->id);
    }

    public function cancel(DraftPurchaseOrder $draftPurchaseOrder)
    {
        $user_type = auth()->user()->registration_type;
        $user_type_id = auth()->user()->id;
        $user_business_type = auth()->user()->business->business_type;
        $user_business_type_id = auth()->user()->business->id;
        $status = "cancel";
        $draftPurchaseOrder->update([
            'status' => $status,
            'po_status' => $status,
            'approval_details' => 'User_TYPE_' . $user_type . '_' . $user_type_id . '_Business_TYPE_' . $user_business_type . '_' . $user_business_type_id . '_' . date('Y-m-d h:m'),
        ]);

        $quotation = Qoute::find($draftPurchaseOrder->qoute_no);
        $quotation->status = 'pending';
        $quotation->qoute_status_updated = 'Rejected';
        $quotation->qoute_status = 'Qouted';
        $quotation->save();
        session()->flash('message', 'Business information successfully updated.');
        return redirect()->route('dpo.show', $draftPurchaseOrder->id);
    }

    /**
     * Generating PDF file for POs.
     *
     */
    public function generatePDF(DraftPurchaseOrder $draftPurchaseOrder)
    {
        $pdf = PDF::loadView('draftPurchaseOrder.PDF', compact('draftPurchaseOrder'))->setOptions(['defaultFont' => 'sans-serif']);
        //        $pdf = PDF::loadView('draftPurchaseOrder.PDF', $data);
        return $pdf->download('POs.pdf');
    }

    public function po()
    {
        $business_type = auth()->user()->business->business_type;
        if ($business_type == "Buyer" || auth()->user()->can('Buyer DPO Approval')) {
//            $dpos = DraftPurchaseOrder::where('user_id', auth()->user()->id)->where('business_id', auth()->user()->business_id)->where('status', 'approved')->orWhere('status', 'prepareDelivery')->orWhere('status', 'completed')->get(); //->where('status','approved')
//            $dpos = DraftPurchaseOrder::where(['user_id'=> auth()->user()->id],['business_id' => auth()->user()->business_id],['status' => 'approved'])->orWhere(['status' => 'prepareDelivery'],['status' => 'completed'])->get(); //->where('status','approved')
            $dpos = DraftPurchaseOrder::where(['business_id' => auth()->user()->business_id],['status' => 'approved'],['rfq_type' => 1])
                    ->where(function($query) {
                        $query->where(['rfq_type' => 1],['status' => 'prepareDelivery'])->where(['business_id' => auth()->user()->business_id]);
                    })
                    ->where(function($query) {
                        $query->where(['rfq_type' => 1],['status' => 'completed'])->where(['business_id' => auth()->user()->business_id]);
                    })
                    ->where(function($query) {
                        $query->where('status', '!=', 'pending');
                    })
                    ->get(); //->where('status','approved')
        } else {
//            $dpos = DraftPurchaseOrder::where('supplier_business_id', auth()->user()->business_id)->where('status', 'approved')->orWhere('status', 'prepareDelivery')->orWhere('status', 'completed')->get(); //
//            $dpos = DraftPurchaseOrder::where(['supplier_business_id' => auth()->user()->business_id],['status' => 'approved'])->orWhere(['status' => 'prepareDelivery'], ['status' => 'completed'])->get(); //
            $dpos = DraftPurchaseOrder::where(['supplier_business_id' => auth()->user()->business_id],['status' => 'approved'],['rfq_type' => 1]) //
                    ->where(function($query) {
                    $query->where(['rfq_type' => 1],['status' => 'prepareDelivery'])->where(['supplier_business_id' => auth()->user()->business_id]);
                      })
                    ->where(function($query) {
                        $query->where(['rfq_type' => 1],['status' => 'completed'])->where(['supplier_business_id' => auth()->user()->business_id]);
                    })
                    ->where(function($query) {
                        $query->where('status', '!=', 'pending');
                    })
                    ->get();

        }

        return view('draftPurchaseOrder.po', compact('dpos'));
    }

    public function poShow(DraftPurchaseOrder $draftPurchaseOrder)
    {
        return view('draftPurchaseOrder.poShow', compact('draftPurchaseOrder'));
    }

    /* DPO for Single Category Quotations */

    public function singleCategoryDPOIndex()
    {
        if(auth()->user()->registration_type == 'Supplier')
        {
            $dpos = DraftPurchaseOrder::where(['supplier_business_id' => auth()->user()->business_id , 'rfq_type' => 0])->where('status','approved')->get();
        }
        elseif(auth()->user()->registration_type == 'Buyer' || auth()->user()->can('Buyer DPO Approval') || auth()->user()->can('Buyer View Purchase Orders'))
        {
            $data = DraftPurchaseOrder::where(['business_id' => auth()->user()->business_id, 'rfq_type' => 0])->where('status', 'pending')->orderByDesc('created_at')->get();
            $dpos = $data->unique('rfq_no');
        }
        return view('draftPurchaseOrder.singleCategory.index', compact('dpos'));
    }

    public function singleCategoryDPOShow($eOrderID)
    {
        $draftPurchaseOrders = DraftPurchaseOrder::where('rfq_no',$eOrderID)->get();

        return view('draftPurchaseOrder.singleCategory.show', compact('draftPurchaseOrders'));
    }

    public function singleCategoryApproved($rfqNo,$supplierBusinessID)
    {
        try {
            DB::beginTransaction();

            $user_type = auth()->user()->registration_type;
            $user_type_id = auth()->user()->id;
            $user_business_type = auth()->user()->business->business_type;
            $user_business_type_id = auth()->user()->business->id;
            $status = "approved";

            $draftPurchaseOrders = DraftPurchaseOrder::where(['rfq_no' => $rfqNo, 'supplier_business_id' => $supplierBusinessID])->get();

            foreach ($draftPurchaseOrders as $draftPurchaseOrder)
            {
                DraftPurchaseOrder::where(['id' => $draftPurchaseOrder->id])->update([
                    'status' => $status,
                    'po_status' => $status,
                    'approval_details' => 'User_TYPE_' . $user_type . '_' . $user_type_id . '_Business_TYPE_' . $user_business_type . '_' . $user_business_type_id . '_' . date('Y-m-d h:m'),
                ]);

                EOrderItems::where(['id' => $draftPurchaseOrder->rfq_item_no,'e_order_id' => $draftPurchaseOrder->rfq_no])->update([
                    'status' => 'accepted',
                ]);

                Qoute::where(['e_order_items_id' => $draftPurchaseOrder->rfq_item_no])->where('id', '!=', $draftPurchaseOrder->qoute_no)->update([
                    'qoute_status' => 'Rejected',
                    'qoute_status_updated' => 'Rejected',
                    'status' => 'expired'
                ]);
            }

            $qoute = Qoute::find($draftPurchaseOrders[0]->qoute_no);

            DB::commit();
            /* Transaction successful. */
        } catch (\Exception $e) {

            DB::rollback();
            session()->flash('error', 'Due to some internal problem of server your quotation is not accepted please retry.');
            return redirect()->route('singleCategoryBuyerRFQs');
            /* Transaction failed. */
        }

        User::find($qoute->supplier_user_id)->notify(new QuoteAccepted($qoute));
        User::find(auth()->user()->id)->notify(new DpoApproved($draftPurchaseOrders[0]));

        session()->flash('message', 'DPO Accepted and PO generated.');
        return redirect()->route('singleCategoryPO');
    }

    public function singleCategoryCancel($rfqNo,$supplierBusinessID)
    {
        $status = "cancel";
        $draftPurchaseOrders = DraftPurchaseOrder::where(['rfq_no' => $rfqNo, 'supplier_business_id' => $supplierBusinessID])->get();

        foreach ($draftPurchaseOrders as $draftPurchaseOrder)
        {
            DraftPurchaseOrder::where(['id' => $draftPurchaseOrder->id])->update([
                'status' => $status,
                'po_status' => $status,
                'approval_details' => 'User_TYPE_' . auth()->user()->registration_type . '_' . auth()->id() . '_Business_TYPE_' . auth()->user()->business->business_type . '_' . auth()->user()->business->id . '_' . date('Y-m-d h:m'),
            ]);

            Qoute::where(['id' => $draftPurchaseOrder->qoute_no])->update([
                'qoute_status' => 'Qouted',
                'qoute_status_updated' => 'Rejected',
                'status' => 'pending'
            ]);
        }

        session()->flash('message', 'DPO Rejected');
        return redirect()->route('singleCategoryIndex');
    }

    public function singleCategoryPO()
    {
        $business_type = auth()->user()->business->business_type;
        if ($business_type == "Buyer" || auth()->user()->can('Buyer DPO Approval')) {
            $data = DraftPurchaseOrder::where(['business_id' => auth()->user()->business_id], ['status' => 'approved'],['rfq_type' => 0])
                        ->where(function($query) {
                            $query->where(['rfq_type' => 0],['status' => 'prepareDelivery'],['status' <> 'pending'])->where(['business_id' => auth()->user()->business_id]);
                        })
                        ->where(function($query) {
                            $query->where(['rfq_type' => 0],['status' => 'completed'])->where(['business_id' => auth()->user()->business_id]);
                        })
                        ->where(function($query) {
                             $query->where('status', '!=', 'pending');
                         })
                        ->get();
            $pos = $data->unique('rfq_no');
        } else {
//            $pos = DraftPurchaseOrder::where(['supplier_business_id' => auth()->user()->business_id],['status' => 'approved'])->orWhere(['status' => 'prepareDelivery'], ['status' => 'completed'])->get(); //
            $data = DraftPurchaseOrder::where(['supplier_business_id' => auth()->user()->business_id],['status' => 'approved'],['rfq_type' => 0])
                        ->where(function($query) {
                            $query->where(['rfq_type' => 0],['status' => 'prepareDelivery'])->where(['supplier_business_id' => auth()->user()->business_id]);
                        })
                        ->where(function($query) {
                            $query->where(['rfq_type' => 0],['status' => 'completed'])->where(['supplier_business_id' => auth()->user()->business_id]);
                        })
                        ->where(function($query) {
                            $query->where('status', '!=', 'pending');
                        })
                        ->get();
            $pos = $data->unique('rfq_no');
        }

        return view('draftPurchaseOrder.singleCategory.po', compact('pos'));
    }

    public function singleCategoryPOShow($rfqNo)
    {
        $draftPurchaseOrders = DraftPurchaseOrder::where('rfq_no',$rfqNo)->get();

        return view('draftPurchaseOrder.singleCategory.poShow', compact('draftPurchaseOrders'));
    }

    /**
     * Generating PDF file for Single Category POs.
     *
     */
    public function singleCategoryGeneratePDF($rfqNo)
    {
        $draftPurchaseOrders = DraftPurchaseOrder::with('buyer_business')->where(['rfq_no' => $rfqNo])->get();
        $pdf = PDF::loadView('draftPurchaseOrder.singleCategory.PDF', compact('draftPurchaseOrders'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('POs.pdf');
    }


}
