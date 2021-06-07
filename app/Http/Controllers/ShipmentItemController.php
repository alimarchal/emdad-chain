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
            $delivery = Delivery::where('id', decrypt($request->delivery_id))->first();
            $shipmentId = Shipment::insertGetId([
                'supplier_id' => auth()->user()->id,
                'supplier_business_id' => auth()->user()->business_id,
                'buyer_business_id' => $delivery->business_id,
                'shipment_cost' => $delivery->shipment_cost,
            ]);
//            $eCartItems = ECart::findMany($request->item_number);
            $shipmentCart = ShipmentCart::where('supplier_business_id', auth()->user()->business_id)->get();
//            Vehicle::whereIn('id', $shipmentCart['vehicle_type'])->update(['status' => 0]);
            foreach ($shipmentCart as $item) {
                $shipmentItem = new ShipmentItem;
                $shipmentItem->shipment_id = $shipmentId;
                $shipmentItem->driver_id = $item->driver_id;
                $shipmentItem->vehicle_type = $item->vehicle_type;
                $shipmentItem->supplier_business_id = $item->supplier_business_id;
                $shipmentItem->delivery_id = $item->delivery_id;
                $shipmentItem->save();
            }
            foreach ($shipmentCart as $item) {
                $item->delete();
            }
            foreach ($shipmentCart as $item)
            {
                Vehicle::where('id', $item->vehicle_type)->update(['availability_status' => 0]);
                User::where('id', $item->driver_id)->update(['driver_status' => 0]);
                Delivery::where('id', $item->delivery_id)->update(['status' => 2]);
            }
        });

        return redirect()->route('shipment.index');
    }
}
