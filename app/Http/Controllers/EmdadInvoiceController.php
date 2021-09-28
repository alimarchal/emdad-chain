<?php

namespace App\Http\Controllers;

use App\Models\EmdadInvoice;
use App\Models\Invoice;
use App\Models\Qoute;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class EmdadInvoiceController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('SuperAdmin|Finance Officer 1'))
        {
            $emdadInvoices = EmdadInvoice::where('rfq_type','=',1)->get();

            return view('invoice.emdad_invoice', compact('emdadInvoices'))->with('invoice');

        }
        elseif(auth()->user()->registration_type == "Supplier" || auth()->user()->hasRole('Supplier Payment Admin'))
        {
//            $emdadInvoices = EmdadInvoice::where([['supplier_business_id', auth()->user()->business_id],['send_status', 1]])->where('rfq_type', '=', 1)->get();

            $collection = EmdadInvoice::where([['supplier_business_id', auth()->user()->business_id],['send_status', 1]])->get();

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
            $emdadInvoices = $multiCategoryCollection->merge($singleCategoryInvoices);

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

        session()->flash('message', __('portal.Invoice send successfully.'));
        return redirect()->route('emdadInvoices');
    }

    /**
     * Generating PDF file for Emdad Invoice.
     *
     */
    public function generatePDF($emdadInvoiceID)
    {
        $emdadInvoice = EmdadInvoice::where('id', decrypt($emdadInvoiceID))->first();

        $pdf = PDF::loadView('invoice.emdadInvoicePDF', compact('emdadInvoice'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('Invoice.pdf');
    }

    ################################################## Single Category Functions ########################################################################

    public function singleCategoryIndex()
    {
        if (auth()->user()->hasRole('SuperAdmin|Finance Officer 1'))
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

        elseif(auth()->user()->registration_type == "Supplier" || auth()->user()->hasRole('Supplier Payment Admin'))
        {
            $totalAmount = 0;  /* For Calculating Total Amount W/O VAT */
            $totalEmdadCharges = 0; /* Total Emdad Charged */

            $collections = EmdadInvoice::where([['supplier_business_id', auth()->user()->business_id],['send_status', 1]])->where('rfq_type', '=', 0)->get();

            if (isset($collections) && $collections->count() > 0)
            {
                foreach ($collections as $collection)
                {
                    $quote = Qoute::where(['id' => $collection->invoice->quote->id , 'supplier_business_id' => auth()->user()->business_id])->first();
                    $totalAmount += ($quote->quote_quantity * $quote->quote_price_per_quantity);
                }
                $totalAmount += $quote->shipment_cost;
                $totalEmdadCharges = $totalAmount * (1.5 / 100);
            }

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

        session()->flash('message', __('portal.Invoice send successfully.'));
        return redirect()->route('singleCategoryEmdadInvoicesIndex');
    }

    /**
     * Generating PDF file for Single Category Emdad Invoice.
     *
     */
    public function singleCategoryGeneratePDF($emdadInvoiceRFQNo)
    {
        $emdadInvoices = EmdadInvoice::where('rfq_no' , decrypt($emdadInvoiceRFQNo))->get();

        $pdf = PDF::loadView('invoice.singleCategory.emdadInvoicePDF', compact('emdadInvoices'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('Invoice.pdf');
    }
}
