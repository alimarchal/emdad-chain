<?php

namespace App\Http\Controllers;

use App\Models\BankPayment;
use App\Models\CommissionPercentage;
use App\Models\DeliveryNote;
use App\Models\DraftPurchaseOrder;
use App\Models\EmdadInvoice;
use App\Models\Invoice;
use App\Models\Ire;
use App\Models\IreCommission;
use App\Models\IreIndirectCommission;
use App\Models\Payment;
use App\Models\ProformaInvoice;
use App\Models\Qoute;
use App\Models\SupplierBankPayment;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 300);
    }

    public function index()
    {
//        $collection = DeliveryNote::where(['supplier_business_id' => auth()->user()->business->id, 'rfq_type' => 1])->get();

        $generateInvoices = DeliveryNote::where(['supplier_business_id' => auth()->user()->business_id])->orderByDesc('created_at')->get();

        $multiCategory = array();
        $singleCategory = array();
        foreach ($generateInvoices as $generateInvoice)
        {
            if ($generateInvoice['rfq_type'] == 1)
            {
                $multiCategory[] = $generateInvoice;
            }
            if ($generateInvoice['rfq_type'] == 0)
            {
                $singleCategory[] = $generateInvoice;
            }
        }
        $multiCategoryCollection = collect($multiCategory);
        $singleCategoryCollection = collect($singleCategory);
        $singleCategoryInvoices = $singleCategoryCollection->unique('rfq_no');
        $collection = $multiCategoryCollection->merge($singleCategoryInvoices)->sortByDesc('created_at');

        return view('supplier.deliveryNotes', compact('collection'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function view()
    {
        return view('payment.view');
    }

    public function generateProformaInvoiceView($id)
    {
        $draftPurchaseOrder = DraftPurchaseOrder::where('id', $id)->where('supplier_business_id', auth()->user()->business_id)->where('payment_term', 'Cash')->first();

        return view('payment.generateProformaInvoice', compact('draftPurchaseOrder'));
    }

    public function generateProformaInvoice($id)
    {
        $proformaInvoicePresent = Invoice::where('draft_purchase_order_id', $id)->first();

        if ($proformaInvoicePresent)
        {
            return redirect()->route('generate_proforma_invoices');
        }

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

        if (auth()->user()->hasRole('CEO'))
        {
            $user = IreCommission::where('user_id', auth()->id())->first();
        }
        else{
            /* Retrieving CEO ID*/
            $userCeoID = User::where([
                'business_id' => auth()->user()->business_id,
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
        return redirect()->route('generate_proforma_invoices');
    }

    /* Function for Buyer */
    public function proforma_invoices()
    {
        if (auth()->user()->registration_type == "Buyer" || auth()->user()->hasRole('Buyer Payment Admin')){
//            $proformaInvoices = Invoice::where('buyer_user_id', auth()->user()->id)->where('invoice_type', 1)->get();
//            $proformaInvoices = Invoice::with('bankPayment')->where(['buyer_business_id' => auth()->user()->business_id, 'rfq_type' => 1])->where('invoice_type', 1)->get();
            $collection = Invoice::with('bankPayment')->where(['buyer_business_id' => auth()->user()->business_id])->where('invoice_type', 1)->get();

            $multiCategory = array();
            $singleCategory = array();
            /* Separating Single and Multi category Invoices  */
            foreach ($collection as $col)
            {
                if ($col['rfq_type'] == 1)
                {
                    $multiCategory[] = $col;
                }
                if ($col['rfq_type'] == 0 )
                {
                    $singleCategory[] =$col;
                }
            }
            $multiCategoryCollection = collect($multiCategory);
            $singleCategoryCollection = collect($singleCategory);
            $singleCategoryInvoices = $singleCategoryCollection->unique('rfq_no');
            /* Merging Single and Multi category Invoices  */
            $proformaInvoices = $multiCategoryCollection->merge($singleCategoryInvoices)->sortByDesc('created_at');
        }
        elseif(auth()->user()->hasRole('SuperAdmin')){
            $proformaInvoices = Invoice::where('invoice_type', 1)->get();
        }

        return view('payment.invoice', compact('proformaInvoices'));
    }

    public function invoices()
    {
        $proformaInvoices = null;
        if (auth()->user()->registration_type == "Supplier" || auth()->user()->hasRole('Supplier Payment Admin'))
        {
            /*$proformaInvoices = Invoice::with('purchase_order')->where(['supplier_business_id' => auth()->user()->business_id, 'rfq_type' => 1])->get();*/
            $collection = Invoice::with('purchase_order')->where(['supplier_business_id' => auth()->user()->business_id])->orderByDesc('created_at')->get();

            $multiCategory = array();
            $singleCategory = array();
            /* Separating Single and Multi category Invoices  */
            foreach ($collection as $col)
            {
                if ($col['rfq_type'] == 1)
                {
                    $multiCategory[] = $col;
                }
                if ($col['rfq_type'] == 0 )
                {
                    $singleCategory[] =$col;
                }
            }
            $multiCategoryCollection = collect($multiCategory);
            $singleCategoryCollection = collect($singleCategory);
            $singleCategoryInvoices = $singleCategoryCollection->unique('rfq_no');
            /* Merging Single and Multi category Invoices  */
            $proformaInvoices = $multiCategoryCollection->merge($singleCategoryInvoices)->sortByDesc('created_at');
        }
        elseif(auth()->user()->registration_type == "Buyer" || auth()->user()->hasRole('Buyer Payment Admin'))
        {
            /*$proformaInvoices = Invoice::with('purchase_order')->where(['buyer_business_id' => auth()->user()->business_id, 'rfq_type' => 1])->get();*/
            $collection = Invoice::with('purchase_order')->where(['buyer_business_id' => auth()->user()->business_id])->orderByDesc('created_at')->get();

            $multiCategory = array();
            $singleCategory = array();
            /* Separating Single and Multi category Invoices  */
            foreach ($collection as $col)
            {
                if ($col['rfq_type'] == 1)
                {
                    $multiCategory[] = $col;
                }
                if ($col['rfq_type'] == 0 )
                {
                    $singleCategory[] =$col;
                }
            }
            $multiCategoryCollection = collect($multiCategory);
            $singleCategoryCollection = collect($singleCategory);
            $singleCategoryInvoices = $singleCategoryCollection->unique('rfq_no');
            /* Merging Single and Multi category Invoices  */
            $proformaInvoices = $multiCategoryCollection->merge($singleCategoryInvoices)->sortByDesc('created_at');
        }
        else{
            $proformaInvoices = Invoice::with('purchase_order')->where(['rfq_type' => 1])->get();
        }

        return view('payment.invoice', compact('proformaInvoices'));
    }

    // View function for Invoice details by ID (Payment history)
    public function invoiceView($id)
    {
       $invoice = Invoice::with('purchase_order','eOrderItem', 'deliveryNote', 'bankPayment')->where('id', $id)->first();

       return view('payment.invoiceView', compact('invoice'));

    }

    public function generate_proforma_invoice()
    {
        $dpos = DraftPurchaseOrder::where(['supplier_business_id' => auth()->user()->business_id , 'rfq_type' => 1])->where('payment_term', 'Cash')->get();
        return view('payment.proformaInvoices', compact('dpos'));
    }

    /* Manual Payments Emdad received from Buyer (For Emdad) */
    public function payments()
    {
        $payments = BankPayment::where(['rfq_type' => 1])->orderByDesc('created_at')->get();

        return view('payment.emdad.payment', compact('payments'));
    }

    /* Manual Payments Emdad has sent to Supplier (For Emdad) */
    public function supplier_payment()
    {
        $payments = BankPayment::where(['rfq_type' => 1])->orderByDesc('created_at')->get();

        return view('payment.emdad.supplierPayment', compact('payments'));
    }

    /* Manual Payments Supplier received from Emdad (For Supplier) */
    public function supplier_payment_received()
    {
//        $supplierPayments = SupplierBankPayment::with('bankPayment')->where(['rfq_type' => 1])->get();

        $collection = SupplierBankPayment::with('bankPayment')->orderByDesc('created_at')->get();

        $multiCategory = array();
        $singleCategory = array();
        foreach ($collection as $coll)
        {
            if ($coll['rfq_type'] == 1)
            {
                $multiCategory[] = $coll;
            }
            if ($coll['rfq_type'] == 0)
            {
                $singleCategory[] = $coll;
            }
        }
        $multiCategoryCollection = collect($multiCategory);
        $singleCategoryCollection = collect($singleCategory);
        $singleCategoryInvoices = $singleCategoryCollection->unique('rfq_no');
        $supplierPayments = $multiCategoryCollection->merge($singleCategoryInvoices)->sortByDesc('created_at');

        return view('manual-payments.supplier.list', compact('supplierPayments'));
    }

    /**
     * Generating PDF file for Invoice and also for Invoice show function present in InvoiceController
     *
     */
    public function generatePDF($invoiceID)
    {
        $invoice = Invoice::with('purchase_order','deliveryNote','eOrderItem')->where('id', decrypt($invoiceID))->first();
        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif','isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('payment.PDF', compact('invoice'));
        return $pdf->download('Invoice.pdf');
    }

    ######################################################### Single Category Quotations functions ############################################################

    public function singleCategoryIndex()
    {
        $data = DeliveryNote::where(['supplier_business_id' => auth()->user()->business->id, 'rfq_type' => 0])->get();
        $collection = $data->unique('rfq_no');

        return view('supplier.singleCategoryRFQ.deliveryNotes', compact('collection'));
    }

    public function singleCategoryGenerateProformaInvoiceView()
    {
        $collection = DraftPurchaseOrder::where(['supplier_business_id' => auth()->user()->business_id , 'rfq_type' => 0])->where('payment_term', 'Cash')->get();
        $dpos = $collection->unique('rfq_no');

        return view('payment.singleCategory.proformaInvoices', compact('dpos'));
    }

    public function singleCategoryGenerateProformaInvoice($rfqNo)
    {
        $proformaInvoicePresent = Invoice::where('rfq_no', $rfqNo)->first();

        if ($proformaInvoicePresent)
        {
            return redirect()->route('singleCategoryGenerateProformaInvoiceView');
        }
        $draftPurchaseOrders = DraftPurchaseOrder::where('rfq_no', $rfqNo)->get();

        foreach ($draftPurchaseOrders as $draftPurchaseOrder)
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
            Invoice::create($proformaInvoice);
        }

        $total = 0;

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

        if (auth()->user()->hasRole('CEO'))
        {
            $user = IreCommission::where('user_id', auth()->id())->first();
        }
        else{
            /* Retrieving CEO ID*/
            $userCeoID = User::where([
                'business_id' => auth()->user()->business_id,
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

        return redirect()->route('singleCategoryGenerateProformaInvoiceView');
    }

    public function singleCategoryInvoices()
    {
        if (auth()->user()->registration_type == "Supplier" || auth()->user()->hasRole('Supplier Payment Admin'))
        {
            $collection = Invoice::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 0])->get();
            $proformaInvoices = $collection->unique('rfq_no');
        }
        elseif(auth()->user()->registration_type == "Buyer" || auth()->user()->hasRole('Buyer Payment Admin'))
        {
            $collection = Invoice::where(['buyer_business_id' => auth()->user()->business_id, 'rfq_type' => 0])->get();
            $proformaInvoices = $collection->unique('rfq_no');
        }
        else{
            $collection = Invoice::where(['rfq_type' => 0])->get();
            $proformaInvoices = $collection->unique('rfq_no');
        }
        return view('payment.singleCategory.invoice', compact('proformaInvoices'));
    }

    /* Function for Buyer */
    public function singleCategoryProformaInvoices()
    {
        $collections = Invoice::with('bankPayment')->where(['buyer_business_id' => auth()->user()->business_id, 'rfq_type' => 0])->where('invoice_type', 1)->get();
        $proformaInvoices = $collections->unique('rfq_no');

        return view('payment.singleCategory.invoice', compact('proformaInvoices'));
    }

    // View function for Invoice details by ID (Payment history)
    public function singleCategoryInvoiceView($rfq_no)
    {
        $invoices = Invoice::with('purchase_order','eOrderItem')->where('rfq_no', $rfq_no)->get();

        return view('payment.singleCategory.invoiceView', compact('invoices'));
    }

    /* Manual Payments Emdad received from Buyer (For Emdad) */
    public function singleCategoryPayments()
    {
        $collection = BankPayment::where(['rfq_type' => 0])->orderByDesc('created_at')->get();
        $payments = $collection->unique('amount_received');

        return view('payment.singleCategory.emdad.payment', compact('payments'));
    }

    /* Manual Payments Emdad has sent to Supplier (For Emdad) */
    public function singleCategorySupplierPayment()
    {
        $collection = BankPayment::where(['rfq_type' => 0])->get();
        $payments = $collection->unique('rfq_type');

        return view('payment.singleCategory.emdad.supplierPayment', compact('payments'));
    }

    /* Manual Payments Supplier received from Emdad (For Supplier) */
    public function singleCategorySupplierPaymentsReceived()
    {
        $collection = SupplierBankPayment::with('bankPayment')->where(['rfq_type' => 0])->get();
        $supplierPayments = $collection->unique('rfq_no');

        return view('manual-payments.singleCategory.supplier.list', compact('supplierPayments'));
    }


    /**
     * Generating PDF file for Single Category Invoice and also for Invoice show function present in InvoiceController
     *
     */
    public function singleCategoryGeneratePDF($invoiceRfqNo)
    {
        $invoices = Invoice::with('eOrderItem','deliveryNote','eOrderItem')->where('rfq_no' , decrypt($invoiceRfqNo))->get();

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif','isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('payment.singleCategory.PDF', compact('invoices'));
        return $pdf->download('Invoice.pdf');
    }

}
