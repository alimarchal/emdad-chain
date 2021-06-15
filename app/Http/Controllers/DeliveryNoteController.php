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
        $user = auth()->user()->id;
        $dpos = DraftPurchaseOrder::where('supplier_user_id', $user)->where('supplier_business_id', auth()->user()->business_id)->where('status','approved')->get();
        return view('deliveryNote.index', compact('dpos'));
    }

    public function store(Request $request)
    {

//        dd($request->all());
        $request->merge(['status' => 'processing']);
        $po_no = $request->draft_purchase_order_id;
        $delivery = DeliveryNote::create($request->all());
        if($delivery)
        {
            $po = DraftPurchaseOrder::where('id', $po_no)->first();
            $po->status = 'prepareDelivery';
            $po->save();
        }
        $buyer_user = User::find($delivery->user_id)->notify(new \App\Notifications\PreparingDelivery());
        session()->flash('message', 'Delivery note has been successfully created.');
        return redirect('notes');
    }

    public function deliveryNoteView(DraftPurchaseOrder $draftPurchaseOrder)
    {

        return view('deliveryNote.show', compact('draftPurchaseOrder'));

    }

    public function notes(Request $request)
    {
        $collection = DeliveryNote::where('supplier_business_id', auth()->user()->business->id)->get();
        return view('supplier.deliveryNotes', compact('collection'));
    }

    public function viewNote(DeliveryNote $deliveryNote)
    {
        return view('deliveryNote.viewNote',compact('deliveryNote'));
    }
}
