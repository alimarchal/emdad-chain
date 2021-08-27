<?php

namespace App\Http\Controllers;

use App\Http\Livewire\BusinessWarehouse;
use App\Models\BankPayment;
use App\Models\Delivery;
use App\Models\DeliveryNote;
use App\Models\DraftPurchaseOrder;
use App\Models\EOrderItems;
use App\Models\EmdadInvoice;
use App\Models\Invoice;
use App\Models\Qoute;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function show(Invoice $invoice)
    {
        $draftPurchaseOrder = DraftPurchaseOrder::with('eOrderItem')->where('id',$invoice->draft_purchase_order_id)->first();
        $delivery = Delivery::where('id',$invoice->delivery_id)->first();

        return view('invoice.show', compact('draftPurchaseOrder','delivery','invoice'));
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
            'rfq_type' => 1,
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
                'ship_to_address' => $del->delivery_address,
                'rfq_type' => 1,
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

    //      Calculating total cost w/o VAT
            $quote = Qoute::where('id', $inv->quote->id)->first();
            $totalCost = ($quote->quote_quantity * $quote->quote_price_per_quantity) + $quote->shipment_cost;
            $totalEmdadCharges =  $totalCost * (1.5 / 100) ;
            $totalCharges =  $totalCost + $totalEmdadCharges ;

            EmdadInvoice::create([
                'invoice_id' => $inv->id,
                'supplier_business_id' => $inv->supplier_business_id,
                'rfq_no' => $quote->e_order_id,
                'charges' => $totalCharges,
                'rfq_type' => 1,
            ]);
            return redirect()->route('invoice.show',$inv->id);
        }
        elseif($del->payment_term == "Cash"){

            $invoice = Invoice::where('draft_purchase_order_id', $del->draft_purchase_order_id)->first();
            $invoice->update([
                'delivery_id' => $del->id,
                'invoice_type' => 0
            ]);

            $delivery_update =  Delivery::where('id', $del->id)->first();
            $delivery_update->update([
                'invoice_id' => $invoice->id,
            ]);


            if($invoice->invoice_cash_online != 1)
            {
                $bankPayment = BankPayment::where('invoice_id', $invoice->id)->first();
                $bankPayment->delivery_id = $del->id;
                $bankPayment->save();
            }

            $delivery_note->status = 'completed';
            $delivery_note->save();
            $purchase_order->status = 'completed';
            $purchase_order->save();
            return redirect()->route('invoice.show',$invoice->id);
        }
    }

    ############################################ Single Category Functions ##############################################
    public function singleCategoryShow($invoiceID)
    {
        $invoice = Invoice::where('id', $invoiceID)->first();
        $draftPurchaseOrders = DraftPurchaseOrder::where('rfq_no',$invoice->rfq_no)->get();

        return view('invoice.singleCategory.show', compact('draftPurchaseOrders','invoiceID', 'invoice'));
    }

    public function singleCategoryInvoiceGenerate(Request $request)
    {
        $delivery_notes = DeliveryNote::where('rfq_no', $request->rfq_no)->get();

        $purchase_order = DraftPurchaseOrder::where('id', $delivery_notes[0]->draft_purchase_order_id)->first();

        $rfq_item = EOrderItems::where('id',$purchase_order->rfq_item_no)->first('warehouse_id');
        $business_warehouse = \App\Models\BusinessWarehouse::where('id',$rfq_item->warehouse_id)->first();

        foreach ($delivery_notes as $delivery_note)
        {
            $po = DraftPurchaseOrder::where('id', $delivery_note->draft_purchase_order_id)->first();

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
                'item_code' => $po->item_code,
                'item_name' => $po->item_name,
                'uom' => $po->uom,
                'brand' => $po->brand,
                'quantity' => $po->quantity,
                'unit_price' => $po->unit_price,
                'rfq_no' => $po->rfq_no,
                'rfq_item_no' => $po->rfq_item_no,
                'qoute_no' => $po->qoute_no,
                'payment_term' => $po->payment_term,
                'shipment_status' => 0,
                'delivery_address' => $delivery_note->delivery_address,
                'destination_coordinates' => $business_warehouse->longitude . ',' . $business_warehouse->latitude,
                'waiting_time' => User::waitingTime(),
                'rfq_type' => 0,
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
                    'buyer_user_id' => $po->user_id,
                    'buyer_business_id' => $po->business_id,
                    'supplier_user_id' => $po->supplier_user_id,
                    'supplier_business_id' => $po->supplier_business_id,
                    'payment_method' => $del->payment_term,
                    'shipment_cost' => $po->shipment_cost,
                    'total_cost' => $po->total_cost,
                    'vat' => $po->vat,
                    'ship_to_address' => $del->delivery_address,
                    'rfq_type' => 0,
                ];

                $inv = Invoice::create($invoice);
                $delivery_update =  Delivery::where('id', $del->id);
                $delivery_update->update([
                    'invoice_id' => $inv->id,
                ]);

                $delivery_note->status = 'completed';
                $delivery_note->save();
                $po->status = 'completed';
                $po->save();

                //      Calculating total cost w/o VAT
                $quote = Qoute::where('id', $inv->quote->id)->first();
                $totalCost = ($quote->quote_quantity * $quote->quote_price_per_quantity) + $quote->shipment_cost;
                $totalEmdadCharges =  $totalCost * (1.5 / 100) ;
                $totalCharges =  $totalCost + $totalEmdadCharges ;

                EmdadInvoice::create([
                    'invoice_id' => $inv->id,
                    'supplier_business_id' => $inv->supplier_business_id,
                    'rfq_no' => $quote->e_order_id,
                    'charges' => $totalCharges,
                    'rfq_type' => 1,
                ]);
            }
            elseif($del->payment_term == "Cash"){

                $invoice = Invoice::where('draft_purchase_order_id', $delivery_note->draft_purchase_order_id)->first();
                $invoice->update([
                    'delivery_id' => $del->id,
                    'invoice_type' => 0
                ]);

                Delivery::where('id', $del->id)->update([
                    'invoice_id' => $invoice->id,
                ]);


                if($invoice->invoice_cash_online != 1)
                {
                    BankPayment::where('invoice_id', $invoice->id)->update([
                        'delivery_id' => $del->id
                    ]);
                }

                $delivery_note->status = 'completed';
                $delivery_note->save();
                $po->status = 'completed';
                $po->save();
            }
        }

        return redirect()->route('singleCategoryInvoices');
    }
}
