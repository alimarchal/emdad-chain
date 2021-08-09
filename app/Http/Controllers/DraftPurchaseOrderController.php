<?php

namespace App\Http\Controllers;

use App\Models\CommissionPercentage;
use App\Models\DeliveryNote;
use App\Models\DraftPurchaseOrder;
use App\Models\EmdadInvoice;
use App\Models\EOrderItems;
use App\Models\Invoice;
use App\Models\Ire;
use App\Models\IreCommission;
use App\Models\IreIndirectCommission;
use App\Models\Qoute;
use App\Models\User;
//use Barryvdh\DomPDF\PDF as PDF;
use App\Notifications\DpoApproved;
use App\Notifications\QuoteAccepted;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
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

    public function approved(Request $request, DraftPurchaseOrder $draftPurchaseOrder)
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

            /* Proforma invoice being generated automatically rather than supplier generates it */
            if ($request->payment_method == 'Cash')
            {
                $proformaInvoice = [
                    'rfq_no' => $request->rfq_no,
                    'rfq_item_no' => $request->rfq_item_no,
                    'qoute_no' => $request->qoute_no,
                    'draft_purchase_order_id' => $request->draft_purchase_order_id,
                    'buyer_user_id' => $request->buyer_user_id,
                    'buyer_business_id' => $request->buyer_business_id,
                    'supplier_user_id' => $request->supplier_user_id,
                    'supplier_business_id' => $request->supplier_business_id,
                    'payment_method' => $request->payment_method,
                    'shipment_cost' => $request->shipment_cost,
                    'total_cost' => $request->total_cost,
                    'vat' => $request->vat,
                    'ship_to_address' => $request->ship_to_address,
                    'invoice_type' => 1,
                    'rfq_type' => 1,
                ];

                $invoiceProforma = Invoice::create($proformaInvoice);
                //      Calculating total cost w/o VAT
                $quote = Qoute::where('id', $invoiceProforma->quote->id)->first();
                $totalCost = ($quote->quote_quantity * $quote->quote_price_per_quantity) + $quote->shipment_cost;
                $totalEmdadCharges = ($totalCost * (1.5 / 100));    // Total emdad charges applicable

                EmdadInvoice::create([
                    'invoice_id' => $invoiceProforma->id,
                    'supplier_business_id' => $invoiceProforma->supplier_business_id,
                    'rfq_no' => $invoiceProforma->rfq_no,
                    'charges' => $totalEmdadCharges,
                    'rfq_type' => 1,
                ]);

                $userRole = User::where('id', $request->supplier_user_id)->first();
                if ($userRole->usertype == 'CEO')
                {
                    $user = IreCommission::where('user_id', $request->supplier_user_id)->first();
                }
                else{
                    /* Retrieving CEO ID*/
                    $userCeoID = User::where([
                        'business_id' => $request->supplier_business_id,
                        'usertype' => 'CEO'
                    ])->first();
                    $user = IreCommission::where('user_id', $userCeoID->id)->first();
                }

                /* Sales commission calculations for employee or non-employee */

                if (isset($user))
                {
                    if ($user->ireNoReferencee->type == 0)       /* 0 for Non-Employee*/
                    {
                        $commission = CommissionPercentage::where(['commission_type' => 0], ['ire_type', 0])->first();
                        if (isset($commission))
                        {
//                    $totalSalesAmount = 0;
                            $total = $totalEmdadCharges * $commission->amount;                          //total charges
                            $ireCommission = IreCommission::where('user_id', $user->user_id)->first();
                            $sales_amount = $ireCommission->sales_amount;
                            $totalSalesAmount = $sales_amount + $total;                                 //Total sales amount updated

                            IreCommission::where('user_id', $user->user_id)->update([
                                'sales_amount' => $totalSalesAmount,
                            ]);

                            /* Indirect Commission Calculations Start*/
                            $indirectCommission = CommissionPercentage::where(['commission_type' => 0], ['ire_type', 2])->first();
                            if (isset($indirectCommission))
                            {
                                $ire = Ire::where('ire_no', $ireCommission->ire_no)->first();

                                if (isset($ire->referred_no) || $ire->referred_no != null)
                                {
                                    $totalAmount = 0;
                                    $ireReferenceDetails  = IreCommission::where('ire_no', $ire->referred_no)->where('payment_status', 0)->get();
                                    foreach ($ireReferenceDetails as $ireReferenceDetail)
                                    {
                                        $totalAmount = $ireReferenceDetail->payment + $ireReferenceDetail->sales_amount;
                                    }
                                    $totalIndirectAmount = $totalAmount * $indirectCommission->amount;

                                    $indirectCommissionCheck =  IreIndirectCommission::where('ire_no',$ireCommission->ire_no)->first();
                                    if (isset($indirectCommissionCheck))
                                    {
                                        $indirectCommissionCheckCreated = Carbon::parse($indirectCommissionCheck->created_at)->floorMonth();
                                        $todayDate = Carbon::parse(Carbon::now())->floorMonth();
                                        $diff = $todayDate->diffInMonths($indirectCommissionCheckCreated);

                                        if ($diff == 0)
                                        {
                                            IreIndirectCommission::where('ire_no',$ireCommission->ire_no)->update([
                                                'amount' => $totalIndirectAmount,
                                            ]);
                                        }
                                        elseif ($diff > 0)
                                        {
                                            IreIndirectCommission::create([
                                                'ire_no' => $ireCommission->ire_no,
                                                'referencee_ire_no' => $ireCommission->ire_no->ireNoReferencee->referred_no,
                                                'amount' => $totalIndirectAmount,
                                            ]);
                                        }
                                    }
                                    else
                                    {
                                        IreIndirectCommission::create([
                                            'ire_no' => $ireCommission->ire_no,
                                            'referencee_ire_no' => $ireCommission->ire_no->ireNoReferencee->referred_no,
                                            'amount' => $totalIndirectAmount,
                                        ]);
                                    }
                                }
                            }

                            /* Indirect Commission Calculations End*/

                        }
                    }
                    elseif ($user->ireNoReferencee->type == 1)  /* 1 for Employee*/
                    {
                        $commission = CommissionPercentage::where(['commission_type' => 0], ['ire_type', 1])->first();
                        if (isset($commission))
                        {
//                    $totalSalesAmount = 0;
                            $total = $totalEmdadCharges * $commission->amount;                          //total charges
                            $ireCommission = IreCommission::where('user_id', $user->user_id)->first();
                            $sales_amount = $ireCommission->sales_amount;
                            $totalSalesAmount = $sales_amount + $total;                                 //Total sales amount updated

                            IreCommission::where('user_id', $user->user_id)->update([
                                'sales_amount' => $totalSalesAmount,
                            ]);

                            /* Indirect Commission Calculations Start*/
                            $indirectCommission = CommissionPercentage::where(['commission_type' => 0], ['ire_type', 2])->first();
                            if (isset($indirectCommission))
                            {
                                $ire = Ire::where('ire_no', $ireCommission->ire_no)->first();

                                if (isset($ire->referred_no) || $ire->referred_no != null)
                                {
                                    $totalAmount = 0;
                                    $ireReferenceDetails  = IreCommission::where('ire_no', $ire->referred_no)->where('payment_status', 0)->get();
                                    foreach ($ireReferenceDetails as $ireReferenceDetail)
                                    {
                                        $totalAmount = $ireReferenceDetail->payment + $ireReferenceDetail->sales_amount;
                                    }
                                    $totalIndirectAmount = $totalAmount * $indirectCommission->amount;

                                    $indirectCommissionCheck =  IreIndirectCommission::where('ire_no',$ireCommission->ire_no)->first();
                                    if (isset($indirectCommissionCheck))
                                    {
                                        $indirectCommissionCheckCreated = Carbon::parse($indirectCommissionCheck->created_at)->floorMonth();
                                        $todayDate = Carbon::parse(Carbon::now())->floorMonth();
                                        $diff = $todayDate->diffInMonths($indirectCommissionCheckCreated);

                                        if ($diff == 0)
                                        {
                                            IreIndirectCommission::where('ire_no',$ireCommission->ire_no)->update([
                                                'amount' => $totalIndirectAmount,
                                            ]);
                                        }
                                        elseif ($diff > 0)
                                        {
                                            IreIndirectCommission::create([
                                                'ire_no' => $ireCommission->ire_no,
                                                'referencee_ire_no' => $ireCommission->ire_no->ireNoReferencee->referred_no,
                                                'amount' => $totalIndirectAmount,
                                            ]);
                                        }
                                    }
                                    else
                                    {
                                        IreIndirectCommission::create([
                                            'ire_no' => $ireCommission->ire_no,
                                            'referencee_ire_no' => $ireCommission->ire_no->ireNoReferencee->referred_no,
                                            'amount' => $totalIndirectAmount,
                                        ]);
                                    }
                                }
                            }

                            /* Indirect Commission Calculations End*/
                        }
                    }
                }
            }

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

                /* Proforma invoice being generated automatically rather than supplier generates it */
                if ($draftPurchaseOrder->payment_term == 'Cash')
                {
                    $proformaInvoice = [
                        'rfq_no' => $draftPurchaseOrder->rfq_no,
                        'rfq_item_no' => $draftPurchaseOrder->rfq_item_no,
                        'qoute_no' => $draftPurchaseOrder->qoute_no,
                        'draft_purchase_order_id' => $draftPurchaseOrder->id,
                        'buyer_user_id' => $draftPurchaseOrder->user_id,
                        'buyer_business_id' => $draftPurchaseOrder->business_id,
                        'supplier_user_id' => $draftPurchaseOrder->supplier_user_id,
                        'supplier_business_id' => $draftPurchaseOrder->supplier_business_id,
                        'payment_method' => $draftPurchaseOrder->payment_term,
                        'shipment_cost' => $draftPurchaseOrder->shipment_cost,
                        'total_cost' => $draftPurchaseOrder->total_cost,
                        'vat' => $draftPurchaseOrder->vat,
                        'ship_to_address' => $draftPurchaseOrder->address,
                        'invoice_type' => 1,
                        'rfq_type' => 0,
                    ];
                    Invoice::create($proformaInvoice)->id;
                }
            }

            /* Part of automatically proforma invoice being generated */
            $total = 0;
            if ($draftPurchaseOrders[0]->payment_term == 'Cash')
            {
        //      Calculating total cost w/o VAT
                foreach ($draftPurchaseOrders as $draftPurchaseOrder)
                {
                    $quote = Qoute::where('dpo', $draftPurchaseOrder->id)->first();
                    $totalCost = $quote->quote_quantity * $quote->quote_price_per_quantity;
                    $total +=  $totalCost;
                }

                $totalWithShipmentCharges = $total + $draftPurchaseOrders[0]->shipment_cost;
                $totalEmdadCharges = ($totalWithShipmentCharges * (1.5 / 100));    // Total Emdad charges applicable

                $proformaInvoices = Invoice::where('rfq_no', $rfqNo)->get();

                foreach ($proformaInvoices as $proformaInvoice)
                {
                    EmdadInvoice::create([
                        'invoice_id' => $proformaInvoice->id,
                        'supplier_business_id' => $proformaInvoice->supplier_business_id,
                        'rfq_no' => $proformaInvoice->rfq_no,
                        'charges' => $totalEmdadCharges,
                        'rfq_type' => 0,
                    ]);
                }

                $userRole = User::where('id', $draftPurchaseOrder->supplier_user_id)->first();
                if ($userRole->usertype == 'CEO')
                {
                    $user = IreCommission::where('user_id', $draftPurchaseOrder->supplier_user_id)->first();
                }
                else{
                    /* Retrieving CEO ID*/
                    $userCeoID = User::where([
                        'business_id' => $draftPurchaseOrder->business_id,
                        'usertype' => 'CEO'
                    ])->first();
                    $user = IreCommission::where('user_id', $userCeoID->id)->first();
                }

                /* Sales commission calculations for employee or non-employee */

                if (isset($user))
                {
                    if ($user->ireNoReferencee->type == 0)       /* 0 for Non-Employee*/
                    {
                        $commission = CommissionPercentage::where(['commission_type' => 0], ['ire_type', 0])->first();
                        if (isset($commission))
                        {
                            //                  $totalSalesAmount = 0;
                            $total = $totalEmdadCharges * $commission->amount;                          // Total charges
                            $ireCommission = IreCommission::where('user_id', $user->user_id)->first();
                            $sales_amount = $ireCommission->sales_amount;
                            $totalSalesAmount = $sales_amount + $total;                                 // Total sales amount updated

                            IreCommission::where('user_id', $user->user_id)->update([
                                'sales_amount' => $totalSalesAmount,
                            ]);

                            /* Indirect Commission Calculations Start*/
                            $indirectCommission = CommissionPercentage::where(['commission_type' => 0], ['ire_type', 2])->first();
                            if (isset($indirectCommission))
                            {
                                $ire = Ire::where('ire_no', $ireCommission->ire_no)->first();

                                if (isset($ire->referred_no) || $ire->referred_no != null)
                                {
                                    $totalAmount = 0;
                                    $ireReferenceDetails  = IreCommission::where('ire_no', $ire->referred_no)->where('payment_status', 0)->get();
                                    foreach ($ireReferenceDetails as $ireReferenceDetail)
                                    {
                                        $totalAmount = $ireReferenceDetail->payment + $ireReferenceDetail->sales_amount;
                                    }
                                    $totalIndirectAmount = $totalAmount * $indirectCommission->amount;

                                    $indirectCommissionCheck =  IreIndirectCommission::where('ire_no',$ireCommission->ire_no)->first();
                                    if (isset($indirectCommissionCheck))
                                    {
                                        $indirectCommissionCheckCreated = Carbon::parse($indirectCommissionCheck->created_at)->floorMonth();
                                        $todayDate = Carbon::parse(Carbon::now())->floorMonth();
                                        $diff = $todayDate->diffInMonths($indirectCommissionCheckCreated);

                                        if ($diff == 0)
                                        {
                                            IreIndirectCommission::where('ire_no',$ireCommission->ire_no)->update([
                                                'amount' => $totalIndirectAmount,
                                            ]);
                                        }
                                        elseif ($diff > 0)
                                        {
                                            IreIndirectCommission::create([
                                                'ire_no' => $ireCommission->ire_no,
                                                'referencee_ire_no' => $ireCommission->ire_no->ireNoReferencee->referred_no,
                                                'amount' => $totalIndirectAmount,
                                            ]);
                                        }
                                    }
                                    else
                                    {
                                        IreIndirectCommission::create([
                                            'ire_no' => $ireCommission->ire_no,
                                            'referencee_ire_no' => $ireCommission->ire_no->ireNoReferencee->referred_no,
                                            'amount' => $totalIndirectAmount,
                                        ]);
                                    }
                                }
                            }

                            /* Indirect Commission Calculations End*/

                        }
                    }
                    elseif ($user->ireNoReferencee->type == 1)  /* 1 for Employee*/
                    {
                        $commission = CommissionPercentage::where(['commission_type' => 0], ['ire_type', 1])->first();
                        if (isset($commission))
                        {
//                    $totalSalesAmount = 0;
                            $total = $totalEmdadCharges * $commission->amount;                          //total charges
                            $ireCommission = IreCommission::where('user_id', $user->user_id)->first();
                            $sales_amount = $ireCommission->sales_amount;
                            $totalSalesAmount = $sales_amount + $total;                                 //Total sales amount updated

                            IreCommission::where('user_id', $user->user_id)->update([
                                'sales_amount' => $totalSalesAmount,
                            ]);

                            /* Indirect Commission Calculations Start*/
                            $indirectCommission = CommissionPercentage::where(['commission_type' => 0], ['ire_type', 2])->first();
                            if (isset($indirectCommission))
                            {
                                $ire = Ire::where('ire_no', $ireCommission->ire_no)->first();

                                if (isset($ire->referred_no) || $ire->referred_no != null)
                                {
                                    $totalAmount = 0;
                                    $ireReferenceDetails  = IreCommission::where('ire_no', $ire->referred_no)->where('payment_status', 0)->get();
                                    foreach ($ireReferenceDetails as $ireReferenceDetail)
                                    {
                                        $totalAmount = $ireReferenceDetail->payment + $ireReferenceDetail->sales_amount;
                                    }
                                    $totalIndirectAmount = $totalAmount * $indirectCommission->amount;

                                    $indirectCommissionCheck =  IreIndirectCommission::where('ire_no',$ireCommission->ire_no)->first();
                                    if (isset($indirectCommissionCheck))
                                    {
                                        $indirectCommissionCheckCreated = Carbon::parse($indirectCommissionCheck->created_at)->floorMonth();
                                        $todayDate = Carbon::parse(Carbon::now())->floorMonth();
                                        $diff = $todayDate->diffInMonths($indirectCommissionCheckCreated);

                                        if ($diff == 0)
                                        {
                                            IreIndirectCommission::where('ire_no',$ireCommission->ire_no)->update([
                                                'amount' => $totalIndirectAmount,
                                            ]);
                                        }
                                        elseif ($diff > 0)
                                        {
                                            IreIndirectCommission::create([
                                                'ire_no' => $ireCommission->ire_no,
                                                'referencee_ire_no' => $ireCommission->ire_no->ireNoReferencee->referred_no,
                                                'amount' => $totalIndirectAmount,
                                            ]);
                                        }
                                    }
                                    else
                                    {
                                        IreIndirectCommission::create([
                                            'ire_no' => $ireCommission->ire_no,
                                            'referencee_ire_no' => $ireCommission->ire_no->ireNoReferencee->referred_no,
                                            'amount' => $totalIndirectAmount,
                                        ]);
                                    }
                                }
                            }

                            /* Indirect Commission Calculations End*/
                        }
                    }
                }
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
