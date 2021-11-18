<?php

namespace App\Http\Controllers;

use App\Models\BusinessPackage;
use App\Models\CardPayment;
use App\Models\CommissionPercentage;
use App\Models\Invoice;
use App\Models\IreCommission;
use App\Models\MakePayment;
use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MakePaymentController extends Controller
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
     * @param  \App\Models\MakePayment  $makePayment
     * @return \Illuminate\Http\Response
     */
    public function show(MakePayment $makePayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MakePayment  $makePayment
     * @return \Illuminate\Http\Response
     */
    public function edit(MakePayment $makePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MakePayment  $makePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MakePayment $makePayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MakePayment  $makePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(MakePayment $makePayment)
    {
        //
    }

    public function makePayment(Request $request)
    {
        $invoice = null;
        if ($request->has('invoice_id'))
        {
            $invoice = Invoice::where('id', $request->input('invoice_id'))->first();
        }
        return view('moyasar_payment.payment', compact('invoice'));
    }

    public function getPaymentCheckOutId(Request $request)
    {
        $invoice = null;
        if ($request->has('invoice_id'))
        {
            $invoice = Invoice::where('id', $request->input('invoice_id'))->first();
        }
        return view('makePayment.step-one', compact('invoice'));
    }

    public function processPayment(Request $request)
    {

        $invoice = Invoice::where('id',$request->invoice_id)->first();

        $merchant_id = CardPayment::create([
            'invoice_id' => $invoice->id,
            'user_id' => auth()->user()->id,
            'amount' => $invoice->total_cost,
            'status' => '0',
        ]);

        $data = null;
        $url = env('URL_GATEWAY') . "/v1/checkouts";
        if ($request->gateway == "mada") {
            $data = "entityId=" . env('ENTITY_ID_MADA') .
                "&amount=" . $invoice->total_cost .
                "&currency=SAR" .
                "&paymentType=" . env("PAYMENT_TYPE") .
                "&merchantTransactionId=" . $merchant_id->id .
                "&customer.email=" . $request->customer_email .
                "&billing.street1=" . $request->billing_street1 .
                "&billing.city=" . $request->billing_city .
                "&billing.state=" . $request->billing_state .
                "&billing.country=" . $request->billing_country .
                "&billing.postcode=" . $request->billing_postcode .
                "&customer.givenName=" . $request->customer_givenName .
                "&customer.surname=" . $request->customer_surname;

        } elseif ($request->gateway == "visa_master") {
            $data = "entityId=" . env('ENTITY_ID_VISA') .
                "&amount=" . $invoice->total_cost .
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
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);// this should be set to true in production
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

        return view('makePayment.payment', compact('invoice', 'res_data', 'gateway', 'merchant_id'));


        // *********************************************
//        $paymentService = new \Moyasar\Providers\PaymentService();
//        $payment = $paymentService->fetch($request->id);
//        $request->merge(['invoice_id' => $payment->description]);
////        dd($payment->description);
//        $paymentInfoSave = MakePayment::create($request->all());
//        if ($payment->status == 'paid')
//        {
//            $invoice = Invoice::where('id', $payment->description)->first();
//            $invoice->invoice_status = 3;
//            $invoice->save();
//            session()->flash('message', 'You have successfully paid the amount.');
//            return redirect('bank-payments');
//        } else
//        {
//            session()->flash('message', $request->message);
//            return redirect('bank-payments');
//        }
    }


    public function processPaymentStatus(Request $request)
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

                $cp = CardPayment::where('id', $merchant_id)->first();
                $cp->status = 1;
                $cp->save();

                $invoice = Invoice::where('id', $request->invoice_id)->first();
                $invoice->invoice_status = 3;
                $invoice->save();

                session()->flash('message', 'You have successfully paid the amount.');
                return redirect('bank-payments');

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
                return route('bank-payments.index');;
            }
        }
    }

    public function getPaymentStatus($id, $resourcePath, $gateway)
    {
        $url = env('URL_GATEWAY') . "/";
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
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return json_decode($responseData, true);
    }

    public function paymentStatus(Request $request)
    {
        $paymentService = new \Moyasar\Providers\PaymentService();
        $payment = $paymentService->fetch($request->id);
        $request->merge(['invoice_id' => $payment->description]);
//        dd($payment->description);
        $paymentInfoSave = MakePayment::create($request->all());
        if ($payment->status == 'paid')
        {
            $invoice = Invoice::where('id', $payment->description)->first();
            $invoice->invoice_status = 3;
            $invoice->save();
            session()->flash('message', 'You have successfully paid the amount.');
            return redirect('bank-payments');
        } else
        {
            session()->flash('message', $request->message);
            return redirect('bank-payments');
        }
    }




}
