<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\MakePayment;
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

    public function paymentStatus(Request $request)
    {
        $paymentService = new \Moyasar\Providers\PaymentService();
        $payment = $paymentService->fetch($request->id);
        $request->merge(['invoice_id' => $payment->description]);
//        dd($payment->description);
        $paymentInfoSave = MakePayment::create($request->all());
        session()->flash('message', $request->status);
        return redirect('bank-payments');

    }
}
