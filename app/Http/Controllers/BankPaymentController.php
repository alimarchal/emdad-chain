<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BankPayment;
use App\Models\Delivery;
use App\Models\Invoice;
use Illuminate\Http\Request;

class BankPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->registration_type == 'Buyer') {
            $collection = BankPayment::where('buyer_business_id', auth()->user()->business_id)->get();
        } elseif (auth()->user()->registration_type == 'Supplier') {
            $collection = BankPayment::where('supplier_business_id', auth()->user()->business_id)->get();
        }
        return view('manual-payments.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Invoice $invoice)
    {
        $delivery = Delivery::where('id', $invoice->id)->first();
        return view('manual-payments.create', compact('invoice', 'delivery'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('file_path_1')) {
            $path = $request->file('file_path_1')->store('', 'public');
            $request->merge(['file_path' => $path]);
        }
        $request->merge(['status' => 1]);
        $bankPayment = BankPayment::create($request->all());
        $invoice = Invoice::where('id', $request->invoice_id)->first();
        $invoice->invoice_status = 1;
        $invoice->save();
        session()->flash('message', 'You have successfully updated payment details');
        return redirect('bank-payments');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankPayment  $bankPayment
     * @return \Illuminate\Http\Response
     */
    public function show(BankPayment $bankPayment)
    {
        return view('manual-payments.show', compact('bankPayment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankPayment  $bankPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(BankPayment $bankPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankPayment  $bankPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankPayment $bankPayment)
    {
        $updated = $bankPayment->update($request->all());

        return redirect()->route('bank-payments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankPayment  $bankPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankPayment $bankPayment)
    {
        //
    }
}
