<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DeliveryController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 300);
    }

    public function show($rfq_no, $deliveryID, $rfq_type)
    {
        /* Previously delivery show page was one for both single and multiple categories (showOLD) but changed to two different views because of changes in showing the details  */
        if ($rfq_type == 0) {
            $deliveries = Delivery::with('eOrderItems', 'invoice', 'buyer', 'supplier')->where('rfq_no', decrypt($rfq_no))->get();
            return view('delivery.showSingleCategory', compact('deliveries'));
        } elseif ($rfq_type == 1) {
            $deliveries = Delivery::with('eOrderItems', 'invoice', 'buyer', 'supplier')->where('id', decrypt($deliveryID))->get();
            return view('delivery.show', compact('deliveries'));
        }
        return view('errors.404');
    }

    /**
     * Generating PDF file for Delivery Note.
     *
     */
    public function pdf($deliveryID, $rfq_no, $rfq_type)
    {
        if ($rfq_type == 0) {
            $deliveries = Delivery::with('eOrderItems', 'invoice', 'buyer', 'supplier')->where('rfq_no', $rfq_no)->get();


            $pdf = App::make('snappy.pdf.wrapper');
            $pdf->loadView('delivery.showPDF', compact('deliveries'));
            return $pdf->download('Delivery Note.pdf');
//            $pdf = PDF::setOptions(['defaultFont' => 'sans-serif','isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('delivery.showPDF', compact('deliveries'));
//            return $pdf->download('Delivery Note.pdf');
        } elseif ($rfq_type == 1) {
            $deliveries = Delivery::with('eOrderItems', 'invoice', 'buyer', 'supplier')->where('id', $deliveryID)->get();

            $pdf = App::make('snappy.pdf.wrapper');
            $pdf->loadView('delivery.showPDF', compact('deliveries'));
            return $pdf->download('Delivery Note.pdf');

//            $pdf = PDF::setOptions(['defaultFont' => 'sans-serif','isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('delivery.showPDF', compact('deliveries'));
//            return $pdf->download('Delivery Note.pdf');
        }
    }
}
