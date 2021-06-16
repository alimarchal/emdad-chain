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
use Carbon\Carbon;
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

    public function store(Request $request)
    {
        dd($request->all());
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

        $emdadCharges = EmdadInvoice::create([
                        'invoice_id' => $invoiceProforma->id,
                        'supplier_business_id' => $invoiceProforma->supplier_business_id,
                        'charges' => $totalCharges,
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

    public function proforma_invoices()
    {
        if (auth()->user()->registration_type == "Buyer"){
//            $proformaInvoices = Invoice::where('buyer_user_id', auth()->user()->id)->where('invoice_type', 1)->get();
            $proformaInvoices = Invoice::with('bankPayment')->where('buyer_business_id', auth()->user()->business_id)->where('invoice_type', 1)->get();
        }
        elseif(auth()->user()->hasRole('SuperAdmin')){
            $proformaInvoices = Invoice::where('invoice_type', 1)->get();
        }

        return view('payment.invoice', compact('proformaInvoices'));
    }

    public function invoices()
    {
        if (auth()->user()->registration_type == "Supplier")
        {
            $proformaInvoices = Invoice::where('supplier_user_id', auth()->user()->id)->get();
        }
        elseif(auth()->user()->registration_type == "Buyer")
        {
            $proformaInvoices = Invoice::where('buyer_business_id', auth()->user()->business_id)->get();
        }
        else{
            $proformaInvoices = Invoice::all();
        }
        return view('payment.invoice', compact('proformaInvoices'));
    }

    // View function for Invoice details by ID (Payment history)
    public function invoiceView($id)
    {
       $invoice = Invoice::where('id', $id)->first();

       return view('payment.invoiceView', compact('invoice'));

    }

    public function generate_proforma_invoice()
    {
        $dpos = DraftPurchaseOrder::where('supplier_user_id', auth()->user()->id)->where('payment_term', 'Cash')->get();
        return view('payment.proformaInvoices', compact('dpos'));
    }

    /* Manual Payments Emdad received from Buyer */
    public function payments()
    {
        $payments = BankPayment::all();

        return view('payment.emdad.payment', compact('payments'));
    }

    /* Manual Payments Emdad has sent to Supplier (For Emdad) */
    public function supplier_payment()
    {
        $payments = BankPayment::all();

        return view('payment.emdad.supplierPayment', compact('payments'));
    }

    /* Manual Payments Supplier received from Emdad (For Supplier) */
    public function supplier_payment_received()
    {
        $supplierPayments = SupplierBankPayment::with('bankPayment')->get();

        return view('manual-payments.supplier.list', compact('supplierPayments'));
    }
}
