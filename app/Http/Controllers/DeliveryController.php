<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function show($rfq_no)
    {
        $deliveries = Delivery::with('eOrderItems', 'invoice')->where('rfq_no', decrypt($rfq_no))->get();

        return view('delivery.show', compact('deliveries'));
    }
}
