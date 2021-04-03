<?php

namespace App\Http\Controllers;

use App\Models\EmdadInvoice;
use App\Models\Invoice;
use Illuminate\Http\Request;

class EmdadInvoiceController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('SuperAdmin'))
        {
            $emdadInvoices = EmdadInvoice::all();

            return view('invoice.emdad_invoice', compact('emdadInvoices'))->with('invoice');

        }
        elseif(auth()->user()->registration_type == "Supplier")
        {
            $emdadInvoices = EmdadInvoice::where([['supplier_business_id', auth()->user()->business_id],['send_status', 1]])->get();

            return view('invoice.supplier_emdad_invoices', compact('emdadInvoices'))->with('invoice');
        }
    }

    public function view($id)
    {
        $emdadInvoice = EmdadInvoice::where('id', $id)->first();

        return view('invoice.supplier_emdad-invoice_view', compact('emdadInvoice'));
    }

    public function generateInvoice($id)
    {
        EmdadInvoice::where('id', $id)->update([
            'send_status' => 1
        ]);

        session()->flash('message', 'Invoice send successfully');
        return redirect()->route('emdadInvoices');
    }
}
