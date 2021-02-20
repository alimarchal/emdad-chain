<?php

namespace App\Http\Controllers;

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
        $delivery_note = DeliveryNote::where('id',$request->delivery_note)->first();
        $purchase_order = DraftPurchaseOrder::where('id',$request->draft_purchase_order_id)->first();
        // Invoice =>  'delivery_id', 'rfq_no', 'rfq_item_no', 'qoute_no', 'draft_purchase_order_id', 'buyer_user_id', 'buyer_business_id', 'supplier_user_id', 'supplier_business_id', 'payment_method', 'ship_to_address'
        // Delivery => 'user_id', 'invoice_id', 'business_id', 'item_code', 'item_name', 'uom', 'packing', 'brand', 'quantity', 'unit_price', 'rfq_no', 'rfq_item_no', 'qoute_no', 'payment_term', 'shipment_status', 'delivery_address'
        $delivery = [];
        // $del = Delivery::create($delivery);
        // $inv = Invoice::create($invoice);
        dd($request->all());
    }
}
