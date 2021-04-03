<?php

namespace App\Http\Controllers;

use App\Models\DeliveryNote;
use App\Models\DraftPurchaseOrder;
use App\Models\EmdadInvoice;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\ProformaInvoice;
use App\Models\Qoute;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = DeliveryNote::where('supplier_business_id', auth()->user()->business->id)->get();
        return view('supplier.deliveryNotes', compact('collection'));
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
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function generateProformaInvoiceView($id)
    {
        $draftPurchaseOrder = DraftPurchaseOrder::where('id', $id)->where('supplier_business_id', auth()->user()->business_id)->where('payment_term', 'Cash')->first();

        return view('payment.generateProformaInvoice', compact('draftPurchaseOrder'));
    }

    public function generateProformaInvoice($id)
    {
        $draftPurchaseOrder = DraftPurchaseOrder::where('id', $id)->first();
//        $proforma = [
//            'draft_purchase_order_id' => $draftPurchaseOrder->id,
//            'user_id' => $draftPurchaseOrder->user_id,
//            'business_id' => $draftPurchaseOrder->business_id,
//            'supplier_user_id' => $draftPurchaseOrder->supplier_user_id,
//            'supplier_business_id' => $draftPurchaseOrder->supplier_business_id,
//            'shipment_cost' => $draftPurchaseOrder->shipment_cost,
//            'total_cost' => $draftPurchaseOrder->total_cost,
//            'rfq_no' => $draftPurchaseOrder->rfq_no,
//            'rfq_item_no' => $draftPurchaseOrder->rfq_item_no,
//            'qoute_no' => $draftPurchaseOrder->qoute_no,
//            'payment_term' => $draftPurchaseOrder->payment_term,
//            'item_code' => $draftPurchaseOrder->item_code,
//            'item_name' => $draftPurchaseOrder->item_name,
//            'uom' => $draftPurchaseOrder->uom,
//            'packing' => $draftPurchaseOrder->packing,
//            'brand' => $draftPurchaseOrder->brand,
//            'quantity' => $draftPurchaseOrder->quantity,
//            'unit_price' => $draftPurchaseOrder->unit_price,
//            'warranty' => $draftPurchaseOrder->warranty,
//            'contract' => $draftPurchaseOrder->contract,
//            'delivery_city' => $draftPurchaseOrder->delivery_city,
//            'address' => $draftPurchaseOrder->address,
//            'warehouse' => $draftPurchaseOrder->warehouse,
//            'delivery_status' => $draftPurchaseOrder->delivery_status,
//            'delivery_time' => $draftPurchaseOrder->delivery_time,
//            'sub_total' => $draftPurchaseOrder->sub_total,
//            'vat' => $draftPurchaseOrder->vat,
//            'po_status' => $draftPurchaseOrder->po_status,
//            'po_date' => $draftPurchaseOrder->po_date,
//            'remarks' => $draftPurchaseOrder->remarks,
//            'approval_details' => $draftPurchaseOrder->approval_details,
//        ];
//        ProformaInvoice::create($proforma);
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
        ];
        $invoiceProforma = Invoice::create($proformaInvoice);

//      Calculating total cost w/o VAT
        $quote = Qoute::where('id', $invoiceProforma->quote->id)->first();
        $totalCost = ($quote->quote_quantity * $quote->quote_price_per_quantity) + $quote->shipment_cost;
        $totalEmdadCharges = ($totalCost * (1.5 / 100));    // Total emdad charges applicable
        $totalCharges =  $totalCost + $totalEmdadCharges ;  // Total emdad charges

        EmdadInvoice::create([
            'invoice_id' => $invoiceProforma->id,
            'supplier_business_id' => $invoiceProforma->supplier_business_id,
            'charges' => $totalCharges,
        ]);

        return redirect()->route('generate_proforma_invoices');
    }

    public function proforma_invoices()
    {
        if (auth()->user()->registration_type == "Buyer"){
            $proformaInvoices = Invoice::where('buyer_user_id', auth()->user()->id)->where('invoice_type', 1)->get();
        }
        elseif(auth()->user()->hasRole('SuperAdmin')){
            $proformaInvoices = Invoice::where('invoice_type', 1)->get();
        }

        return view('payment.invoice', compact('proformaInvoices'));
    }

    public function invoices()
    {
        if (auth()->user()->registeration_type == "Supplier")
        {
            $proformaInvoices = Invoice::where('supplier_user_id', auth()->user()->id)->get();
        }
        elseif(auth()->user()->registeration_type == "Buyer")
        {
            $proformaInvoices = Invoice::where('buyer_user_id', auth()->user()->id)->get();
        }
        else{
            $proformaInvoices = Invoice::all();
        }
        return view('payment.invoice', compact('proformaInvoices'));
    }

    public function generate_proforma_invoice()
    {
        $dpos = DraftPurchaseOrder::where('supplier_user_id', auth()->user()->id)->where('payment_term', 'Cash')->get();
        return view('payment.proformaInvoices', compact('dpos'));
    }
}
