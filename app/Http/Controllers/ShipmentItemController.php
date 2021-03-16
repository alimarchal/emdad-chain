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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $shipmentId = Shipment::insertGetId([
                'supplier_id' => auth()->user()->id,
                'supplier_business_id' => auth()->user()->business_id,
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

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ShipmentItem $shipmentItem
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(ShipmentItem $shipmentItem, Request $request)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShipmentItem  $shipmentItem
     * @return \Illuminate\Http\Response
     */
    public function edit(ShipmentItem $shipmentItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShipmentItem  $shipmentItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShipmentItem $shipmentItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShipmentItem  $shipmentItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShipmentItem $shipmentItem)
    {
        //
    }
}
