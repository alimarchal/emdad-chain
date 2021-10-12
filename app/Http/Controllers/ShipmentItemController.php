<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Shipment;
use App\Models\ShipmentCart;
use App\Models\ShipmentItem;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipmentItemController extends Controller
{
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $shipmentCart = ShipmentCart::where('supplier_business_id', auth()->user()->business_id)->get();

            $buyerBusinessIDArray = array();
            foreach ($shipmentCart as $item) {
                $buyerBusinessIDArray[] = $item->buyer_business_id;
            }
            $buyerBusinessIDs = implode(',', array_unique($buyerBusinessIDArray));

            $shipmentId = Shipment::insertGetId([
                'supplier_id' => auth()->user()->id,
                'supplier_business_id' => auth()->user()->business_id,
                'buyer_business_id' => $buyerBusinessIDs,
            ]);

            foreach ($shipmentCart as $item) {
                $shipmentItem = new ShipmentItem;
                $shipmentItem->shipment_id = $shipmentId;
                $shipmentItem->driver_id = $item->driver_id;
                $shipmentItem->vehicle_id = $item->vehicle_id;
                $shipmentItem->supplier_business_id = $item->supplier_business_id;
                $shipmentItem->buyer_business_id = (int)$item->buyer_business_id;
                $shipmentItem->rfq_no = $item->rfq_no;
                $shipmentItem->delivery_id = $item->delivery_id;
                $shipmentItem->save();
            }
            foreach ($shipmentCart as $item) {
                $item->delete();
            }
            foreach ($shipmentCart as $item)
            {
                Vehicle::where('id', $item->vehicle_id)->update(['availability_status' => 0]);
                User::where('id', $item->driver_id)->update(['driver_status' => 0]);
                Delivery::where('rfq_no', $item->rfq_no)->update(['status' => 2]);
            }
        });

        session()->flash('message', __('portal.Shipment Placed Successfully!'));
        return redirect()->route('shipment.index');
    }
}
