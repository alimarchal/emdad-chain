<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\DeliveryNote;
use App\Models\DraftPurchaseOrder;
use Illuminate\Http\Request;

class DeliveryNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = auth()->user()->id;
        $dpos = DraftPurchaseOrder::where('supplier_user_id', $user)->where('supplier_business_id', auth()->user()->business_id)->where('status','approved')->get();
        return view('deliveryNote.index', compact('dpos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['status' => 'processing']);
        $po_no = $request->draft_purchase_order_id;
        $delivery = DeliveryNote::create($request->all());
        if($delivery)
        {
            $po = DraftPurchaseOrder::where('id', $po_no)->first();
            $po->status = 'prepareDelivery';
            $po->save();
        }
        session()->flash('message', 'Delivery note has been successfully created.');
        return redirect('deliveryNote');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryNote  $deliveryNote
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryNote $deliveryNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveryNote  $deliveryNote
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryNote $deliveryNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryNote  $deliveryNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryNote $deliveryNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryNote  $deliveryNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryNote $deliveryNote)
    {
        //
    }

    public function deliveryNoteView(DraftPurchaseOrder $draftPurchaseOrder)
    {

        return view('deliveryNote.show', compact('draftPurchaseOrder'));

    }
}
