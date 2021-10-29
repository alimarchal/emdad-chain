<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
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
}
