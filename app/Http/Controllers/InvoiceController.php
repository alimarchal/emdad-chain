<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\DeliveryNote;
use App\Models\DraftPurchaseOrder;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    public function invoiceGenerate(Request $request)
    {
        $delivery_note = DeliveryNote::where('id', $request->delivery_note)->first();
        $purchase_order = DraftPurchaseOrder::where('id', $request->draft_purchase_order_id)->first();
        $delivery = [
            'draft_purchase_order_id' => $delivery_note->draft_purchase_order_id,
            'user_id' => $delivery_note->user_id,
            'delivery_note_id' => $delivery_note->id,
            'business_id' => $delivery_note->business_id,
            'item_code' => $purchase_order->item_code,
            'item_name' => $purchase_order->item_name,
            'uom' => $purchase_order->uom,
            'packing' => $purchase_order->packing,
            'brand' => $purchase_order->brand,
            'quantity' => $purchase_order->quantity,
            'unit_price' => $purchase_order->unit_price,
            'rfq_no' => $purchase_order->rfq_no,
            'rfq_item_no' => $purchase_order->rfq_item_no,
            'qoute_no' => $purchase_order->qoute_no,
            'payment_term' => $purchase_order->payment_term,
            'shipment_status' => 0,
            'delivery_address' => $delivery_note->delivery_address,
        ];

        $del = Delivery::create($delivery);
        $invoice = [
            'delivery_id' => $del->id,
            'rfq_no' => $del->rfq_no,
            'rfq_item_no' => $del->rfq_item_no,
            'qoute_no' => $del->qoute_no,
            'draft_purchase_order_id' => $del->draft_purchase_order_id,
            'buyer_user_id' => $purchase_order->buyer_user_id,
            'buyer_business_id' => $purchase_order->buyer_business_id,
            'supplier_user_id' => $purchase_order->supplier_user_id,
            'supplier_business_id' => $purchase_order->supplier_business_id,
            'payment_method' => $del->payment_method,
            'ship_to_address' => $del->ship_to_address,
        ];
        
        $inv = Invoice::create($invoice);
        $delivery_update =  Delivery::where('id', $del->id);
        $updated_delivery = $delivery_update->update([
            'invoice_id' => $inv->id,
        ]);

        $delivery_note->status = 'completed';
        $delivery_note->save();
        $purchase_order->status = 'completed';
        $purchase_order->save();

        return redirect()->route('invoice.show',$inv->id);
    }
}
