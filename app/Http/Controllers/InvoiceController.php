<?php

namespace App\Http\Controllers;

use App\Http\Livewire\BusinessWarehouse;
use App\Models\BankPayment;
use App\Models\Delivery;
use App\Models\DeliveryNote;
use App\Models\DraftPurchaseOrder;
use App\Models\EOrderItems;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $draftPurchaseOrder = DraftPurchaseOrder::where('id',$invoice->draft_purchase_order_id)->first();
        $delivery = Delivery::where('id',$invoice->delivery_id)->first();

        return view('invoice.show', compact('draftPurchaseOrder','delivery','invoice'));
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
//
        $delivery_note = DeliveryNote::where('id', $request->delivery_note)->first();
        $purchase_order = DraftPurchaseOrder::where('id', $request->draft_purchase_order_id)->first();
        $rfq_item = EOrderItems::where('id',$purchase_order->rfq_item_no)->first('warehouse_id');
        $business_warehouse = \App\Models\BusinessWarehouse::where('id',$rfq_item->warehouse_id)->first();
        $delivery = [
            'draft_purchase_order_id' => $delivery_note->draft_purchase_order_id,
            'user_id' => $delivery_note->user_id,
            'delivery_note_id' => $delivery_note->id,
            'business_id' => $delivery_note->business_id,
            'supplier_user_id' => $delivery_note->supplier_user_id,
            'supplier_business_id' => $delivery_note->supplier_business_id,
            'shipment_cost' => $delivery_note->shipment_cost,
            'total_cost' => $delivery_note->total_cost,
            'vat' => $delivery_note->vat,
            'otp_mobile_number' => $delivery_note->otp_mobile_number,
            'item_code' => $purchase_order->item_code,
            'item_name' => $purchase_order->item_name,
            'uom' => $purchase_order->uom,
            'brand' => $purchase_order->brand,
            'quantity' => $purchase_order->quantity,
            'unit_price' => $purchase_order->unit_price,
            'rfq_no' => $purchase_order->rfq_no,
            'rfq_item_no' => $purchase_order->rfq_item_no,
            'qoute_no' => $purchase_order->qoute_no,
            'payment_term' => $purchase_order->payment_term,
            'shipment_status' => 0,
            'delivery_address' => $delivery_note->delivery_address,
            'destination_coordinates' => $business_warehouse->longitude . ',' . $business_warehouse->latitude,
            'waiting_time' => \App\Models\User::waitingTime(),
        ];

        $del = Delivery::create($delivery);

        if($del->payment_term == "Credit")
        {
            $invoice = [
                'delivery_id' => $del->id,
                'rfq_no' => $del->rfq_no,
                'rfq_item_no' => $del->rfq_item_no,
                'qoute_no' => $del->qoute_no,
                'draft_purchase_order_id' => $del->draft_purchase_order_id,
                'buyer_user_id' => $purchase_order->user_id,
                'buyer_business_id' => $purchase_order->business_id,
                'supplier_user_id' => $purchase_order->supplier_user_id,
                'supplier_business_id' => $purchase_order->supplier_business_id,
                'payment_method' => $del->payment_term,
                'shipment_cost' => $purchase_order->shipment_cost,
                'total_cost' => $purchase_order->total_cost,
                'vat' => $purchase_order->vat,
                'ship_to_address' => $del->ship_to_address,
            ];

            $inv = Invoice::create($invoice);
            $delivery_update =  Delivery::where('id', $del->id);
            $delivery_update->update([
                'invoice_id' => $inv->id,
            ]);

            $delivery_note->status = 'completed';
            $delivery_note->save();
            $purchase_order->status = 'completed';
            $purchase_order->save();
            return redirect()->route('invoice.show',$inv->id);
        }
        elseif($del->payment_term == "Cash"){

            $invoice = Invoice::where('draft_purchase_order_id', $del->draft_purchase_order_id)->first();
            $invoice->update(['delivery_id' => $del->id]);

            $delivery_update =  Delivery::where('id', $del->id)->first();
            $delivery_update->update([
                'invoice_id' => $invoice->id,
            ]);


            $bankPayment = BankPayment::where('invoice_id', $invoice->id)->first();

            $bankPayment->delivery_id = $del->id;
            $bankPayment->save();

            $delivery_note->status = 'completed';
            $delivery_note->save();
            $purchase_order->status = 'completed';
            $purchase_order->save();
            return redirect()->route('invoice.show',$invoice->id);
        }
    }
}
