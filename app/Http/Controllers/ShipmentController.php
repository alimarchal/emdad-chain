<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Shipment;
use App\Models\ShipmentCart;
use App\Models\ShipmentItem;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        if (auth()->user()->registration_type == 'Supplier')
        {
            $shipments = Shipment::where('supplier_id', auth()->user()->id)->get();
            return view('shipment.index', compact('shipments'));
        }
        elseif (auth()->user()->registration_type == 'Buyer')
        {
            $shipments = Shipment::where('buyer_business_id', auth()->user()->business_id)->get();
            return view('shipment.buyer.index', compact('shipments'));
        }

        return redirect()->back();

    }

    public function create()
    {
        $shipmentCarts = ShipmentCart::where('supplier_business_id', auth()->user()->business_id)->get();

        $collection = Delivery::where(['supplier_business_id' =>  auth()->user()->business_id, 'shipment_status' => 0])->get();
        $deliveries = $collection->unique('rfq_no');

        return view('shipment.create', compact('shipmentCarts', 'deliveries'));
    }

    public function show(Shipment $shipment)
    {
        if (auth()->user()->registration_type == 'Supplier')
        {
            $shipmentDetails = ShipmentItem::where('shipment_id', $shipment->id)->get();
            return view('shipment.show', compact('shipmentDetails'));
        }
        elseif (auth()->user()->registration_type == 'Buyer')
        {
            $shipmentDetails = ShipmentItem::where('shipment_id', $shipment->id)->get();
            return view('shipment.buyer.show', compact('shipmentDetails'));
        }

    }

    /* Delivered delivery of Buyers */
    public function delivered()
    {
        $shipments = Shipment::where(['buyer_business_id' => auth()->user()->business_id, 'status' => 1])->get();
        return view('shipment.buyer.delivered', compact('shipments'));
    }

    /* on going deliveries of Buyers */
    public function ongoingShipment()
    {
        $shipments = Shipment::with('shipmentItems')->where(['buyer_business_id' => auth()->user()->business_id, 'status' => 0])->get();
        return view('shipment.buyer.notdelivered', compact('shipments'));
    }
}
