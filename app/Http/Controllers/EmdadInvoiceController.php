<?php

namespace App\Http\Controllers;

use App\Models\EmdadInvoice;
use App\Models\Invoice;
use App\Models\Qoute;
use Illuminate\Http\Request;

class EmdadInvoiceController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('SuperAdmin'))
        {
            $emdadInvoices = EmdadInvoice::where('rfq_type','=',1)->get();

            return view('invoice.emdad_invoice', compact('emdadInvoices'))->with('invoice');

        }
        elseif(auth()->user()->registration_type == "Supplier")
        {
            $emdadInvoices = EmdadInvoice::where([['supplier_business_id', auth()->user()->business_id],['send_status', 1]])->where('rfq_type', '=', 1)->get();

            return view('invoice.supplier_emdad_invoices', compact('emdadInvoices'))->with('invoice');
        }
    }

    public function view($id)
    {
        $emdadInvoice = EmdadInvoice::where('id', $id)->first();

        return view('invoice.supplier_emdad-invoice_view', compact('emdadInvoice'));
    }

    /* Function for Emdad */
    public function generateInvoice($id)
    {
        EmdadInvoice::where('id', $id)->update([
            'send_status' => 1
        ]);

        session()->flash('message', 'Invoice send successfully');
        return redirect()->route('emdadInvoices');
    }

    ################################################## Single Category Functions ########################################################################

    public function singleCategoryIndex()
    {
        if (auth()->user()->hasRole('SuperAdmin'))
        {
            $collection = EmdadInvoice::where('rfq_type','=',0)->get();

            $IDs = array();
            $collectionIDS = EmdadInvoice::where('rfq_type','=',0)->get('invoice_id');
            foreach ($collectionIDS as $collectionID)
            {
                $IDs[] = $collectionID->invoice_id;
            }

            $emdadInvoices = $collection->unique('rfq_type');

            return view('invoice.singleCategory.emdad_invoice', compact('emdadInvoices', 'IDs'))->with('invoice');

        }

        elseif(auth()->user()->registration_type == "Supplier")
        {
            $totalAmount = 0;  /* For Calculating Total Amount W/O VAT */

            $collections = EmdadInvoice::where([['supplier_business_id', auth()->user()->business_id],['send_status', 1]])->where('rfq_type', '=', 0)->get();

            foreach ($collections as $collection)
            {
                $quote = Qoute::where('id', $collection->invoice->quote->id)->first();
                $totalAmount += ($quote->quote_quantity * $quote->quote_price_per_quantity);
            }
            $totalAmount += $quote->shipment_cost;
            $totalEmdadCharges = $totalAmount * (1.5 / 100);

            $emdadInvoices = $collections->unique('rfq_no');

            return view('invoice.singleCategory.supplier_emdad_invoices', compact('emdadInvoices', 'totalAmount','totalEmdadCharges'))->with('invoice');
        }
    }

    public function singleCategoryView($rfq_no)
    {
        $emdadInvoices = EmdadInvoice::where('rfq_no', $rfq_no)->get();

        return view('invoice.singleCategory.supplier_emdad_invoice_view', compact('emdadInvoices'));
    }

    /* Function for Emdad */
    public function singleCategoryGenerateInvoice(Request $request)
    {
        foreach ($request->IDs as $ID)
        {
            EmdadInvoice::where('invoice_id', $ID)->update([
                'send_status' => 1
            ]);
        }

        session()->flash('message', 'Invoice send successfully');
        return redirect()->route('singleCategoryEmdadInvoicesIndex');
    }
}
