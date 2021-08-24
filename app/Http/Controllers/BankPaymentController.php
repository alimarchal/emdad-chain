<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BankPayment;
use App\Models\Delivery;
use App\Models\Invoice;
use App\Models\SupplierBankPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BankPaymentController extends Controller
{
    public function index()
    {
        $collection = null;
        if (auth()->user()->registration_type == 'Buyer') {
//            $collection = BankPayment::where('buyer_business_id', auth()->user()->business_id)->get();
            $collection = Invoice::where(['buyer_business_id' => auth()->user()->business_id, 'rfq_type' => 1])->where('invoice_status', 0)->get();
        }
        if (auth()->user()->registration_type == 'Supplier') {
//            $collection = BankPayment::where('supplier_business_id', auth()->user()->business_id)->where('status', '!=' ,0)->get();
            $collection = Invoice::where(['supplier_business_id' => auth()->user()->business_id, 'rfq_type' => 1])->where('invoice_status', 0)->get();
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

        $validator = $request->validate([
            'amount_date' => 'required',
            'file_path_1' => 'required|mimes:jpg,bmp,png,jpeg,JPEG,JPG',
        ]);


        $time = strtotime($request->amount_date);
        $newformat = date('Y-m-d',$time);
        $request->merge(['amount_date'=> $newformat]);

        if ($request->has('file_path_1')) {
            $path = $request->file('file_path_1')->store('', 'public');
            $request->merge(['file_path' => $path]);
        }
        $request->merge(['status' => 1]);
        $request->merge(['rfq_type' => 1]);
        BankPayment::create($request->all());
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
        BankPayment::where('id', $request->bank_payment_id)->update([
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
        $request->merge(['rfq_no' => 1]);

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

    ############################################## Single Category RFQ Functions ###############################

    public function singleCategoryIndex()
    {
        $collection = null;
        if (auth()->user()->registration_type == 'Buyer') {
//            $collection = BankPayment::where('buyer_business_id', auth()->user()->business_id)->get();
            $data = Invoice::where(['buyer_business_id' => auth()->user()->business_id, 'rfq_type' => 0])->where('invoice_status', 0)->get();
            $collection = $data->unique('rfq_no');
        }
        if (auth()->user()->registration_type == 'Supplier') {
//            $collection = BankPayment::where('supplier_business_id', auth()->user()->business_id)->where('status', '!=' ,0)->get();
            $data = Invoice::where(['supplier_business_id' => auth()->user()->business_id, 'rfq_type' => 0])->where('invoice_status', 0)->get();
            $collection = $data->unique('rfq_no');
        }
        if (auth()->user()->hasRole('SuperAdmin|Finance Officer 1')) {
            return redirect()->route('singleCategoryPayments');
        }

        return view('manual-payments.singleCategory.index', compact('collection'));
    }

    public function singleCategoryCreate($rfq_no)
    {
        $collections = Invoice::where('rfq_no', $rfq_no)->get();
        $invoices = $collections->unique('rfq_no');

        return view('manual-payments.singleCategory.create', compact('invoices'));
    }

    public function singleCategoryStore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'amount_date' => 'required',
            'file_path_1' => 'required|mimes: jpeg.jpg,png,',
        ]);

        if ($validator->fails())
        {
            session()->flash('error', 'All Fields are required');
            return redirect()->back();
        }

        $time = strtotime($request->amount_date);
        $newformat = date('Y-m-d',$time);
        $request->merge(['amount_date'=> $newformat]);
        $path = null;

        if ($request->has('file_path_1')) {
            $path = $request->file('file_path_1')->store('', 'public');
            $request->merge(['file_path' => $path]);
        }

        $invoices = Invoice::where('rfq_no', $request->rfq_no)->get();

        foreach ($invoices as $invoice)
        {
            $data = [
                'invoice_id' => $invoice->id,
                'draft_purchase_order_id' => $invoice->draft_purchase_order_id,
                'quote_no' => $invoice->qoute_no,
                'rfq_no' => $invoice->rfq_no,
                'bank_name' => $request->bank_name,
                'amount_received' => $request->amount_received,
                'amount_date' => $request->amount_date,
                'account_number' => $request->account_number,
                'supplier_business_id' => $invoice->supplier_business_id,
                'supplier_user_id' => $invoice->supplier_user_id,
                'buyer_user_id' => $invoice->buyer_user_id,
                'buyer_business_id' => $invoice->buyer_business_id,
                'file_path' => $path,
                'status' => 1,
                'rfq_type' => 0,
            ];
            BankPayment::create($data);

            $invoice->invoice_status = 1;
            $invoice->save();
        }
        session()->flash('message', 'You have successfully updated payment details');
        return redirect()->route('singleCategoryProformaInvoices');
    }

    // Function for Emdad
    public function singleCategoryShow($id)
    {
        $bankPayment = BankPayment::where('id', $id)->first();

        return view('manual-payments.singleCategory.show', compact('bankPayment'));
    }

    // Update function for Emdad
    public function singleCategoryUpdate(Request $request, $rfq_no)
    {
        $bankPayments = BankPayment::where('rfq_no', $rfq_no)->get();

        foreach ($bankPayments as $bankPayment)
        {
            $bankPayment->update(['status' => $request->status]);

            Invoice::where('id', $bankPayment->invoice_id)->update([
                'invoice_status' => $request->status
            ]);
        }

        return redirect()->route('singleCategoryPayments');
    }

    /* Bank payment show view (For Super Admin) */
    public function singleCategoryAdminSupplierPaymentView($rfq_no)
    {
        $bankPayments = BankPayment::where('rfq_no', $rfq_no)->get();
        $invoice = Invoice::where('id', $bankPayments[0]->invoice_id)->first();

        if ($bankPayments[0]->supplier_payment_status == 0 || $bankPayments[0]->supplier_payment_status == 2)
        {
            return view('manual-payments.singleCategory.emdad.create', compact('bankPayments', 'invoice'));
        }

        $bankPaymentToSupplier = SupplierBankPayment::with('bankPayment')->where('rfq_no', $rfq_no)->first();

        return view('manual-payments.singleCategory.emdad.show', compact('bankPaymentToSupplier'));

    }

    /* Update status for supplier payment status in bank payments table (For Super Admin) */
    public function singleCategoryUpdateSupplierPaymentStatus(Request $request,$rfqNo)
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

        BankPayment::where('rfq_no', $rfqNo)->update(['supplier_payment_status' => 1]);

        $path = $request->file('file_path_1')->store('', 'public');
        $request->merge(['file_path' => $path]);

        /* Checking whether to update or to create */
        $supplierBankPayment = SupplierBankPayment::where('rfq_no', $rfqNo)->first();

        $amount_date = Carbon::parse($request->amount_date)->format('Y-m-d');
        if (isset($supplierBankPayment))
        {
            SupplierBankPayment::where('rfq_no', $rfqNo)->update([
                'amount_received' => $request->amount_received,
                'amount_date' => $amount_date,
                'file_path' => $request->file_path,
                'status' => 1,
                ]);
        }
        else
        {
            $bankPayments = BankPayment::where('rfq_no', $rfqNo)->get();
            foreach ($bankPayments as $bankPayment)
            {
                $data = [
                    'bank_payment_id' => $bankPayment->id,
                    'bank_name' => $bankPayment->bank_name,
                    'rfq_no' => $bankPayment->rfq_no,
                    'amount_received' => $request->amount_received,
                    'account_number' => $request->account_number,
                    'amount_date' => $amount_date,
                    'file_path' => $request->file_path,
                    'supplier_business_id' => $bankPayment->supplier_business_id,
                    'supplier_user_id' => $bankPayment->supplier_user_id,
                    'status' => 1,
                    'rfq_type' => 0,
                ];

                SupplierBankPayment::create($data);
            }
        }

        session()->flash('message', 'Status updated Successfully!!');
        return redirect()->route('singleCategorySupplierPayment');
    }

    /* Bank payment show view (For Supplier) */
    public function singleCategorySupplierPaymentView($id)
    {
        $supplierBankPayment = SupplierBankPayment::where('id',$id)->first();

        return view('manual-payments.singleCategory.supplier.show', compact('supplierBankPayment'));
    }

    /* Update supplier payment status column updated by supplier (For Supplier) */
    public function singleCategoryUpdateBankPayment(Request $request, $rfq_no)
    {
        BankPayment::where('rfq_no', $rfq_no)->update(['supplier_payment_status' => $request->status]);
        SupplierBankPayment::where('rfq_no', $rfq_no)->update(['status' => $request->status]);

        session()->flash('message', 'Status updated Successfully!!');
        return redirect()->route('singleCategorySupplierPaymentsReceived');
    }

    public function singleCategoryEdit($id)
    {
        $bankPayment = BankPayment::where('invoice_id', $id)->first();
        return view('manual-payments.singleCategory.edit', compact('bankPayment'));
    }

    // Update function for Buyer
    public function singleUpdatePayment(Request $request, $rfq_no)
    {
        $validator = \Validator::make($request->all(), [
            'amount_date' => 'required',
            'file_path_1' => 'required|mimes: jpeg.jpg,png,',
        ]);

        if ($validator->fails())
        {
            session()->flash('error', 'All Fields are required');
            return redirect()->back();
        }

        $bankPayments = BankPayment::where('rfq_no', $rfq_no)->get();

        $path = null;
        if ($request->has('file_path_1')) {
            $path = $request->file('file_path_1')->store('', 'public');
            $request->merge(['file_path' => $path]);
        }

        foreach ($bankPayments as $bankPayment)
        {
            BankPayment::where('id', $bankPayment->id)->update([
                'amount_date' => $request->amount_date,
                'file_path' => $path,
                'status' => 1,
            ]);

            Invoice::where('id', $bankPayment->invoice_id)->update([
                'invoice_status' => 1
            ]);
        }

        return redirect()->route('singleCategoryProformaInvoices');
    }

}
