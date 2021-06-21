<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BankPayment;
use App\Models\Delivery;
use App\Models\Invoice;
use App\Models\SupplierBankPayment;
use Illuminate\Http\Request;

class BankPaymentController extends Controller
{
    public function index()
    {
        $collection = null;
        if (auth()->user()->registration_type == 'Buyer') {
//            $collection = BankPayment::where('buyer_business_id', auth()->user()->business_id)->get();
            $collection = Invoice::where('buyer_business_id', auth()->user()->business_id)->where('invoice_status', 0)->get();
        }
        if (auth()->user()->registration_type == 'Supplier') {
//            $collection = BankPayment::where('supplier_business_id', auth()->user()->business_id)->where('status', '!=' ,0)->get();
            $collection = Invoice::where('supplier_business_id', auth()->user()->business_id)->where('invoice_status', 0)->get();
        }
        if (auth()->user()->hasRole('SuperAdmin|Finance Officer 1')) {
            return redirect()->route('emdad_payments');
        }

        return view('manual-payments.index', compact('collection'));
    }

    public function create(Invoice $invoice)
    {
        $delivery = Delivery::where('invoice_id', $invoice->id)->first();

        return view('manual-payments.create', compact('invoice', 'delivery'));
    }

    public function store(Request $request)
    {
        $time = strtotime($request->amount_date);
        $newformat = date('Y-m-d',$time);
        $request->merge(['amount_date'=> $newformat]);

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
        return redirect('proforma-invoices');
    }

    public function show(BankPayment $bankPayment)
    {
        return view('manual-payments.show', compact('bankPayment'));
    }

//    public function edit(BankPayment $bankPayment)
    public function edit($id)
    {
        $bankPayment = BankPayment::where('invoice_id', $id)->first();
        return view('manual-payments.edit', compact('bankPayment'));
    }

    public function update(Request $request, BankPayment $bankPayment)
    {
        $bankPayment->update($request->all());
        Invoice::where('id', $request->invoice_id)->update([
            'invoice_status' => $request->status
        ]);

        return redirect()->route('bank-payments.index');
    }

    public function update_payment(Request $request)
    {

        $path = null;
        if ($request->has('file_path_1')) {
            $path = $request->file('file_path_1')->store('', 'public');
            $request->merge(['file_path' => $path]);
        }
        $bankPayment = BankPayment::where('id', $request->bank_payment_id)->update([
                    'bank_name' => $request->bank_name,
                    'amount_received' => $request->amount_received,
                    'account_number' => $request->account_number,
                    'amount_date' => $request->amount_date,
                    'file_path' => $path,
                    'status' => 1,
                ]);
        $Invoice = Invoice::where('id', $request->invoice_id)->first();
        $Invoice->invoice_status = 1;
        $Invoice->save();
        return redirect()->route('bank-payments.index');
    }

    /* Bank payment show view (For Super Admin) */
    public function admin_supplier_payment_view($id)
    {
        $bankPayment = BankPayment::where('id', $id)->first();
        $invoice = Invoice::where('id', $bankPayment->invoice_id)->first();

        if ($bankPayment->supplier_payment_status == 0 || $bankPayment->supplier_payment_status == 2)
        {
            return view('manual-payments.emdad.create', compact('bankPayment', 'invoice'));
        }

        $bankPaymentToSupplier = SupplierBankPayment::with('bankPayment')->where('bank_payment_id', $bankPayment->id)->first();

        return view('manual-payments.emdad.show', compact('bankPaymentToSupplier'));

    }

    /* Update status for supplier payment status in bank payments table (For Super Admin) */
    public function update_supplier_payment_status(Request $request,$id)
    {
        $validated = \Validator::make($request->all(),[
            'bank_name' => 'required',
            'amount_received' => 'required',
            'account_number' => 'required',
            'amount_date' => 'required',
            'file_path_1' => 'required',
        ],[
            'file_path_1.required' => 'Receipt (Proof) is required'
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withInput()->withErrors($validated->errors());
        }

        BankPayment::where('invoice_id', $id)->update(['supplier_payment_status' => 1]);

        $path = $request->file('file_path_1')->store('', 'public');
        $request->merge(['file_path' => $path]);

        /* Checking whether to update or to create */
        $supplierBankPayment = SupplierBankPayment::where('bank_payment_id', $request->bank_payment_id)->first();

        if (isset($supplierBankPayment))
        {
            SupplierBankPayment::where('bank_payment_id', $request->bank_payment_id)->update([
                'amount_received' => $request->amount_received,
                'amount_date' => $request->amount_date,
                'file_path' => $request->file_path,
                'status' => 1,
            ]);
        }
        else
        {
            SupplierBankPayment::create($request->all());
        }

        session()->flash('message', 'Status updated Successfully!!');
        return redirect()->route('supplier_payment');
    }

    /* Bank payment show view (For Supplier) */
    public function supplier_payment_view($id)
    {
        $supplierBankPayment = SupplierBankPayment::where('id',$id)->first();

        return view('manual-payments.supplier.show', compact('supplierBankPayment'));

    }

    /* Update supplier payment status column updated by supplier (For Supplier) */
    public function update_bank_payment(Request $request, $id)
    {
        BankPayment::where('id', $id)->update(['supplier_payment_status' => $request->status]);
        SupplierBankPayment::where('bank_payment_id', $id)->update(['status' => $request->status]);

        session()->flash('message', 'Status updated Successfully!!');
        return redirect()->route('supplier_payment_received');
    }
}
