<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\DeliveryNote;
use App\Models\DraftPurchaseOrder;
use App\Models\User;
use Illuminate\Http\Request;

class DeliveryNoteController extends Controller
{

    public function index()
    {
        $dpos = DraftPurchaseOrder::where(['supplier_business_id' => auth()->user()->business_id, 'rfq_type' => 1])->where('status','approved')->get();
        return view('deliveryNote.index', compact('dpos'));
    }

    public function store(Request $request)
    {

//        dd($request->all());
        $request->merge(['status' => 'processing']);
        $request->merge(['rfq_type' => 1]);
        $po_no = $request->draft_purchase_order_id;
        $delivery = DeliveryNote::create($request->all());
        if($delivery)
        {
            $po = DraftPurchaseOrder::where('id', $po_no)->first();
            $po->status = 'prepareDelivery';
            $po->save();
        }
        User::find($delivery->user_id)->notify(new \App\Notifications\PreparingDelivery());
        session()->flash('message', 'Delivery note has been successfully created.');
        return redirect('notes');
    }

    public function deliveryNoteView(DraftPurchaseOrder $draftPurchaseOrder)
    {
        $deliveryNote = DeliveryNote::where('rfq_no', $draftPurchaseOrder->rfq_no)->first();

        if (isset($deliveryNote))
        {
            return view('deliveryNote.viewNote',compact('deliveryNote'));
        }
        return view('deliveryNote.show', compact('draftPurchaseOrder'));
    }

    public function notes()
    {
        $collection = DeliveryNote::where(['supplier_business_id' => auth()->user()->business->id, 'rfq_type' => 1])->get();
        return view('supplier.deliveryNotes', compact('collection'));
    }

    public function viewNote(DeliveryNote $deliveryNote)
    {
        return view('deliveryNote.viewNote',compact('deliveryNote'));
    }

    ###################################################### Single Category Quotation Functions #########################################

    public function singleCategoryIndex()
    {
        $collection = DraftPurchaseOrder::where(['supplier_business_id' => auth()->user()->business_id, 'rfq_type' => 0])->where('status','approved')->get();
        $dpos = $collection->unique('rfq_no');

        return view('deliveryNote.singleCategory.index', compact('dpos'));
    }

    public function singleCategoryStore(Request $request,$rfqNo)
    {
        $draftPurchaseOrders = DraftPurchaseOrder::where('rfq_no', $rfqNo)->get();

        $deliveryNoteUserId = null;

        foreach ($draftPurchaseOrders as $draftPurchaseOrder )
        {
            $data = [
                'draft_purchase_order_id' => $draftPurchaseOrder->id,
                'rfq_no' => $draftPurchaseOrder->rfq_no,
                'user_id' => $draftPurchaseOrder->user_id ,
                'business_id' => $draftPurchaseOrder->business_id ,
                'supplier_user_id' => $draftPurchaseOrder->supplier_user_id ,
                'supplier_business_id' => $draftPurchaseOrder->supplier_business_id,
                'shipment_cost' => $draftPurchaseOrder->shipment_cost,
                'total_cost' => $draftPurchaseOrder->total_cost,
                'vat' => $draftPurchaseOrder->vat,
                'delivery_address' => $request->delivery_address,
                'city' => $request->city,
                'unit_price' => $draftPurchaseOrder->unit_price ,
                'quantity' => $draftPurchaseOrder->quantity,
                'otp_mobile_number' => $draftPurchaseOrder->otp_mobile_number,
                'warranty' => $request->warranty,
                'terms_and_conditions' => $request->terms_and_conditions,
                'update_user_id' => auth()->id(),
                'status' => 'processing',
                'rfq_type' => 0,
            ];

            $deliveryNoteUserId = DeliveryNote::create($data)->user_id;

            $draftPurchaseOrder->status = 'prepareDelivery';
            $draftPurchaseOrder->save();
        }
        User::find($deliveryNoteUserId)->notify(new \App\Notifications\PreparingDelivery());
        session()->flash('message', 'Delivery note has been successfully created.');
        return redirect()->route('singleCategoryNotes');
    }

    public function singleCategoryDeliveryNoteView($rfqNo)
    {
        $draftPurchaseOrders = DraftPurchaseOrder::where('rfq_no', $rfqNo)->get();

        $deliveryNote = DeliveryNote::where('rfq_no', $draftPurchaseOrders[0]->rfq_no)->first();
        if (isset($deliveryNote))
        {
            return redirect()->route('singleCategoryViewNote', $draftPurchaseOrders[0]->rfq_no);
        }

        return view('deliveryNote.singleCategory.show', compact('draftPurchaseOrders'));
    }

    public function singleCategoryNotes()
    {
        $data = DeliveryNote::where(['supplier_business_id' => auth()->user()->business->id, 'rfq_type' => 0])->get();
        $collection = $data->unique('rfq_no');

        return view('supplier.singleCategoryRFQ.deliveryNotes', compact('collection'));
    }

    public function singleCategoryViewNote($rfq_no)
    {
        $deliveryNotes = DeliveryNote::with('purchase_order')->where('rfq_no', $rfq_no)->get();

        return view('deliveryNote.singleCategory.viewNote',compact('deliveryNotes'));
    }

}
