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
            $shipments = Shipment::where('supplier_business_id', auth()->user()->business_id)->get();
            return view('shipment.index', compact('shipments'));
        }
        elseif (auth()->user()->registration_type == 'Buyer')
        {
//            $shipments = Shipment::where('buyer_business_id', auth()->user()->business_id)->get();
            $collections = Shipment::all();

            $shipments = array();

            foreach ($collections as $collection)
            {
                $businessIds = explode(',', $collection->buyer_business_id);

                for ($i=0; $i< count($businessIds); $i++)
                {
                    if ($businessIds[$i] == auth()->user()->business_id)
                    {
                        $shipments[] =  $collection;
                    }
                }
            }
            $shipments = array_unique($shipments);
            return view('shipment.buyer.index', compact('shipments'));
        }

        return redirect()->back();

    }

    public function create()
    {
        $shipmentCarts = ShipmentCart::where('supplier_business_id', auth()->user()->business_id)->orderByDesc('created_at')->get();

        /*$collection = Delivery::where(['supplier_business_id' =>  auth()->user()->business_id, 'shipment_status' => 0])->get();
        $deliveries = $collection->unique('rfq_no');*/

        $deliveries = Delivery::where(['supplier_business_id' =>  auth()->user()->business_id, 'shipment_status' => 0])->get();

        $multiCategory = array();
        $singleCategory = array();
        foreach ($deliveries as $delivery)
        {
            if ($delivery['rfq_type'] == 1)
            {
                $multiCategory[] = $delivery;
            }
            if ($delivery['rfq_type'] == 0)
            {
                $singleCategory[] = $delivery;
            }
        }
        $multiCategoryCollection = collect($multiCategory);
        $singleCategoryCollection = collect($singleCategory);

        $singleCategoryInvoices = $singleCategoryCollection->unique('rfq_no');
        $deliveries = $multiCategoryCollection->merge($singleCategoryInvoices);

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
            $shipmentDetails = ShipmentItem::where(['shipment_id' => $shipment->id, 'buyer_business_id' => auth()->user()->business_id])->get();
            return view('shipment.buyer.show', compact('shipmentDetails'));
        }

    }

    /* Delivered delivery of Buyers */
    public function delivered()
    {
//        $shipments = Shipment::where(['buyer_business_id' => auth()->user()->business_id, 'status' => 1])->get();
        $collections = Shipment::where(['status' => 1])->get();
        $shipments = array();

        foreach ($collections as $collection)
        {
            $businessIds = explode(',', $collection->buyer_business_id);

            for ($i=0; $i< count($businessIds); $i++)
            {
                if ($businessIds[$i] == auth()->user()->business_id)
                {
                    $shipments[] =  $collection;
                }
            }
        }
        $shipments = array_unique($shipments);
        return view('shipment.buyer.delivered', compact('shipments'));
    }

    /* on going deliveries of Buyers */
    public function ongoingShipment()
    {
//        $shipments = Shipment::with('shipmentItems')->where(['buyer_business_id' => auth()->user()->business_id, 'status' => 0])->get();
        $collections = Shipment::with('shipmentItems')->where(['status' => 0])->get();

        $shipments = array();

        foreach ($collections as $collection)
        {
            $businessIds = explode(',', $collection->buyer_business_id);

                for ($i=0; $i< count($businessIds); $i++)
                {
                    if ($businessIds[$i] == auth()->user()->business_id)
                    {
                        $shipments[] =  $collection;
                    }
                }
        }

        $shipments = array_unique($shipments);
        return view('shipment.buyer.notdelivered', compact('shipments'));
    }
}
