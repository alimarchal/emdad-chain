<?php

namespace App\Http\Controllers;

use App\Models\BankPayment;
use App\Models\BusinessPackage;
use App\Models\CardPayment;
use App\Models\CommissionPercentage;
use App\Models\Delivery;
use App\Models\Invoice;
use App\Models\Ire;
use App\Models\IreCommission;
use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusinessPackageController extends Controller
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


    public function getCheckOutId(Request $request)
    {
        $package = Package::where('id', $request->package_id)->first();
//        dd($request->all());
        return view('subscribePackageView.step-one', compact('package'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //after payment add payment details to payment table after that insert that payment id to BusinessPackage table
        $package = Package::where('id', $request->package_id)->first();
        $merchant_id = null;
        // if price exist then return to new view else it's free one
        if ($request->package_id == 2 || $request->package_id == 3 || $request->package_id == 6 || $request->package_id == 7) {
            $merchant_id = CardPayment::create([
                'package_id' => $request->package_id,
                'user_id' => auth()->user()->id,
                'amount' => $package->charges,
                'status' => '0',
            ]);
            $data = null;
            $url = "https://test.oppwa.com/v1/checkouts";
            if ($request->gateway == "mada") {
                $data = "entityId=" . env('ENTITY_ID_MADA') .
                    "&amount=" . $package->charges .
                    "&currency=SAR" .
                    "&merchantTransactionId=" . $merchant_id->id .
                    "&customer.email=" . $request->customer_email .
                    "&billing.street1=" . $request->billing_street1 .
                    "&billing.city=" . $request->billing_city .
                    "&billing.state=" . $request->billing_state .
                    "&billing.country=" . $request->billing_country .
                    "&billing.postcode=" . $request->billing_postcode .
                    "&customer.givenName=" . $request->customer_givenName .
                    "&customer.surname=" . $request->customer_surname .
                    "&paymentType=" . env("PAYMENT_TYPE");
                $request->merge(["testMode" => "EXTERNAL"]);

            } elseif ($request->gateway == "visa_master") {
                $data = "entityId=" . env('ENTITY_ID_VISA') .
                    "&amount=" . $package->charges .
                    "&currency=SAR" .
                    "&merchantTransactionId=" . $merchant_id->id .
                    "&customer.email=" . $request->customer_email .
                    "&billing.street1=" . $request->billing_street1 .
                    "&billing.city=" . $request->billing_city .
                    "&billing.state=" . $request->billing_state .
                    "&billing.country=" . $request->billing_country .
                    "&billing.postcode=" . $request->billing_postcode .
                    "&customer.givenName=" . $request->customer_givenName .
                    "&customer.surname=" . $request->customer_surname .
                    "&paymentType=" . env("PAYMENT_TYPE");
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization:Bearer ' . env('AUTH_BEARER')));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            if (curl_errno($ch)) {
                return curl_error($ch);
            }

            curl_close($ch);
            $res_data = json_decode($responseData, true);
            $gateway = $request->gateway;


            if ($res_data['result']['code'] == "200.300.404") {

                $cp = CardPayment::where('id', $merchant_id->id)->first();
                $cp->status = 2;
                $cp->save();
                return redirect()->route('packages.index')->with(['message' => 'Transaction failed incorrect parameters.']);
            }

//            return dd($merchant_id);
            return view('subscribePackageView.payment', compact('package', 'res_data', 'gateway', 'merchant_id'));
        } else {
            $subscription_end_date = Carbon::now()->addYear();
            if (auth()->user()->registration_type == 'Buyer') {
                BusinessPackage::create([
                    'business_type' => 1,
                    'package_id' => $package->id,
                    'user_id' => auth()->id(),
                    'subscription_start_date' => Carbon::now(),
                    'subscription_end_date' => $subscription_end_date,
                ]);

                $reference = IreCommission::where(['user_id' => auth()->id()], ['type' => 1])->first();   /* type 1 for Buyer */
                if (isset($reference)) {
                    $commission = CommissionPercentage::where(['commission_type' => 2], ['package_type' => $package->id])->where('ire_type', $reference->ireNoReferencee->type)->first();
                    if (isset($commission)) {
                        IreCommission::where('id', $reference->id)->update([
                            'payment' => $commission->amount
                        ]);
                    }

                }

                return redirect()->route('parentCategories');
            } elseif (auth()->user()->registration_type == 'Supplier') {
                BusinessPackage::create([
                    'business_type' => 2,
                    'package_id' => $package->id,
                    'user_id' => auth()->id(),
                    'subscription_start_date' => Carbon::now(),
                    'subscription_end_date' => $subscription_end_date,
                ]);

                $reference = IreCommission::where(['user_id' => auth()->id()], ['type' => 2])->first();      /* type 2 for Supplier */
                if (isset($reference)) {
                    $commission = CommissionPercentage::where(['commission_type' => 2], ['package_type' => $package->id])->where('ire_type', $reference->ireNoReferencee->type)->first();
                    if (isset($commission)) {
                        IreCommission::where('id', $reference->id)->update([
                            'payment' => $commission->amount
                        ]);
                    }
                }

                return redirect()->route('parentCategories');
            }
        }


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\BusinessPackage $businessPackage
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessPackage $businessPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\BusinessPackage $businessPackage
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessPackage $businessPackage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BusinessPackage $businessPackage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessPackage $businessPackage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BusinessPackage $businessPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessPackage $businessPackage)
    {
        //
    }

    public function updateCategories(Request $request)
    {
        $categories = implode(',', $request->category_id);

        $businessPackage = BusinessPackage::where('id', $request->business_id)->first();
        $businessPackage->update([
            'categories' => $categories,
        ]);
        return redirect()->route('business.create');
    }


    public function getPaymentStatus($id, $resourcePath, $gateway)
    {
        $url = "https://test.oppwa.com/";
        $url .= $resourcePath;
        if ($gateway == "mada") {
            $url .= "?entityId=" . env('ENTITY_ID_MADA');
        } else {
            $url .= "?entityId=" . env('ENTITY_ID_VISA');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer ' . env('AUTH_BEARER')));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return json_decode($responseData, true);
    }

    public function businessPackagePaymentStatus(Request $request)
    {

//        dd($request->all());
        $id = $request->id;
        $resourcePath = $request->resourcePath;
        $gateway = $request->gateway;
        $merchant_id = $request->merchant_id;

        $transaction_status = $this->getPaymentStatus($id, $resourcePath, $gateway);

        //000.100.110
        $payment_status = $transaction_status['result']['code'];


        if (isset($transaction_status['result']['code'])) {
            $successCodePattern = '/^(000\.000\.|000\.100\.1|000\.[36])/';
            $successManualReviewCodePattern = '/^(000\.400\.0|000\.400\.100)/';
            $success = null;
            //success status
            if (preg_match($successCodePattern, $transaction_status['result']['code']) || preg_match($successManualReviewCodePattern, $transaction_status['result']['code'])) {
                $success = 'Your payment has been processed successfully';

                //$paymentService = new \Moyasar\Providers\PaymentService();
                //$payment_info = $paymentService->fetch($request->id);

                $cp = CardPayment::where('id', $merchant_id)->first();
                $cp->status = 1;
                $cp->save();

                $package_id = $request->package_id;
                $package = Package::where('id', $package_id)->first();
                $subscription_end_date = Carbon::now()->addYear();
                if (auth()->user()->registration_type == 'Buyer') {
                    BusinessPackage::create([
                        'business_type' => 1,
                        'package_id' => $package->id,
                        'invoice_id' => $request->id,
                        'user_id' => auth()->id(),
                        'subscription_start_date' => Carbon::now(),
                        'subscription_end_date' => $subscription_end_date,
                    ]);

                    $reference = IreCommission::where(['user_id' => auth()->id()], ['type' => 1])->first();      /* type 1 for Buyer */
                    if (isset($reference)) {
                        $commission = CommissionPercentage::where(['commission_type' => 2], ['package_type' => $package->id])->where('ire_type', $reference->ireNoReferencee->type)->first();
                        if (isset($commission)) {
                            $payment = round($package->charges * $commission->amount, 2);
                            IreCommission::where('id', $reference->id)->update([
                                'payment' => $payment
                            ]);
                        }
                    }

                    session()->flash('success', 'Transaction Successful.');
                    return redirect()->route('parentCategories');
                } elseif (auth()->user()->registration_type == 'Supplier') {
                    BusinessPackage::create([
                        'business_type' => 2,
                        'package_id' => $package->id,
                        'invoice_id' => $request->id,
                        'user_id' => auth()->id(),
                        'subscription_start_date' => Carbon::now(),
                        'subscription_end_date' => $subscription_end_date,
                    ]);

                    $reference = IreCommission::where(['user_id' => auth()->id()], ['type' => 2])->first();      /* type 2 for Supplier */
                    if (isset($reference)) {
                        $commission = CommissionPercentage::where(['commission_type' => 1], ['package_type' => $package->id])->where('ire_type', $reference->ireNoReferencee->type)->first();
                        if (isset($commission)) {
                            $payment = round($package->charges * $commission->amount, 2);
                            IreCommission::where('id', $reference->id)->update([
                                'payment' => $payment
                            ]);
                        }

                    }

                    session()->flash('success', $success);
                    return redirect()->route('parentCategories');
                }
            } else {
                //fail case
                $failed_msg = $transaction_status['result']['description'];
                if (isset($transaction_status['card']['bin'])) {
                    $blackBins = User::blackBins();
                    $searchBin = $transaction_status['card']['bin'];
                    if (in_array($searchBin, $blackBins)) {
                        if (auth()->user()->rtl == 1) {
                            $failed_msg = 'عذرا! يرجى اختيار خيار الدفع "مدى" لإتمام عملية الشراء بنجاح.';
                        } else {
                            $failed_msg = 'Sorry! Please select "mada" payment option in order to be able to complete your purchase successfully.';
//                            return dd($failed_msg);
                        }
                    }
                }

                session()->flash('message', $failed_msg);
                return redirect()->route('packages.index');
            }
        }
    }


    public function getCheckOutId_InvoicePayment(Request $request)
    {
        $invoice = Invoice::where('id', $request->invoice_id)->first();
        return view('invoice-payment-online.invoice-view', compact('invoice'));
    }


    public function proceed_payment(Request $request)
    {
        $invoice = Invoice::where('id', $request->invoice_id)->first();
        $merchant_id = null;
        $total_charges = round(($invoice->total_cost + ($invoice->total_cost * 0.0175)),2);


        $merchant_id = CardPayment::create([
            'invoice_id' => $request->invoice_id,
            'user_id' => auth()->user()->id,
            'amount' => $total_charges,
            'status' => '0',
        ]);

        $data = null;
        $url = "https://test.oppwa.com/v1/checkouts";
        if ($request->gateway == "mada") {
            $data = "entityId=" . env('ENTITY_ID_MADA') .
                "&amount=" . $total_charges .
                "&currency=SAR" .
                "&merchantTransactionId=" . $merchant_id->id .
                "&customer.email=" . $request->customer_email .
                "&billing.street1=" . $request->billing_street1 .
                "&billing.city=" . $request->billing_city .
                "&billing.state=" . $request->billing_state .
                "&billing.country=" . $request->billing_country .
                "&billing.postcode=" . $request->billing_postcode .
                "&customer.givenName=" . $request->customer_givenName .
                "&customer.surname=" . $request->customer_surname .
                "&paymentType=" . env("PAYMENT_TYPE");
            $request->merge(["testMode" => "EXTERNAL"]);

        } elseif ($request->gateway == "visa_master") {
            $data = "entityId=" . env('ENTITY_ID_VISA') .
                "&amount=" . $total_charges .
                "&currency=SAR" .
                "&merchantTransactionId=" . $merchant_id->id .
                "&customer.email=" . $request->customer_email .
                "&billing.street1=" . $request->billing_street1 .
                "&billing.city=" . $request->billing_city .
                "&billing.state=" . $request->billing_state .
                "&billing.country=" . $request->billing_country .
                "&billing.postcode=" . $request->billing_postcode .
                "&customer.givenName=" . $request->customer_givenName .
                "&customer.surname=" . $request->customer_surname .
                "&paymentType=" . env("PAYMENT_TYPE");
        }


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer ' . env('AUTH_BEARER')));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }

        curl_close($ch);
        $res_data = json_decode($responseData, true);
        $gateway = $request->gateway;

        if ($res_data['result']['code'] == "200.300.404") {

            $cp = CardPayment::where('id', $merchant_id->id)->first();
            $cp->status = 2;
            $cp->save();
            return redirect()->route('invoices')->with(['message' => 'Transaction failed incorrect parameters.']);
        }

        return view('invoice-payment-online.payment', compact('invoice', 'res_data', 'gateway', 'merchant_id'));

    }


    public function invoice_payment_status(Request $request)
    {


        $id = $request->id;
        $resourcePath = $request->resourcePath;
        $gateway = $request->gateway;
        $merchant_id = $request->merchant_id;

        $transaction_status = $this->getPaymentStatus($id, $resourcePath, $gateway);

        //000.100.110
        $payment_status = $transaction_status['result']['code'];


        if (isset($transaction_status['result']['code'])) {
            $successCodePattern = '/^(000\.000\.|000\.100\.1|000\.[36])/';
            $successManualReviewCodePattern = '/^(000\.400\.0|000\.400\.100)/';
            $success = null;
            //success status
            if (preg_match($successCodePattern, $transaction_status['result']['code']) || preg_match($successManualReviewCodePattern, $transaction_status['result']['code'])) {
                $success = 'Your payment has been processed successfully';

                //$paymentService = new \Moyasar\Providers\PaymentService();
                //$payment_info = $paymentService->fetch($request->id);

                $cp = CardPayment::where('id', $merchant_id)->first();
                $cp->status = 1;
                $cp->invoice_transaction_id = $request->id;
                $cp->save();


//                $time = strtotime($request->amount_date);
//                $newformat = date('Y-m-d',$time);
//                $amount_date = $newformat;
//                $status = 1;
//
//                $bankPayment = BankPayment::create(
//
//                );

                $invoice = Invoice::where('id', $request->invoice_id)->first();
                $invoice->invoice_status = 3;
                $invoice->invoice_cash_online = 1;
                $invoice->save();



                session()->flash('success', 'Transaction Successful.');
                return redirect()->route('invoices');

            } else {
                //fail case
                $failed_msg = $transaction_status['result']['description'];
                if (isset($transaction_status['card']['bin'])) {
                    $blackBins = User::blackBins();
                    $searchBin = $transaction_status['card']['bin'];
                    if (in_array($searchBin, $blackBins)) {
                        if (auth()->user()->rtl == 1) {
                            $failed_msg = 'عذرا! يرجى اختيار خيار الدفع "مدى" لإتمام عملية الشراء بنجاح.';
                        } else {
                            $failed_msg = 'Sorry! Please select "mada" payment option in order to be able to complete your purchase successfully.';
//                            return dd($failed_msg);
                        }
                    }
                }

                session()->flash('message', $failed_msg);
                return redirect()->route('invoices');
            }
        }
    }
}
