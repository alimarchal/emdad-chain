<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\ShipmentItem;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('supplier_business_id')) {

            $collection = Vehicle::where('supplier_business_id', $request->supplier_business_id)->get();
            $vehicle = [];
            foreach ($collection as $col) {
                $get_vehicle_id = $col->id;
                $shipment_item_vehicle_status = ShipmentItem::where('vehicle_id', $get_vehicle_id)->where('status',0)->first();
                $itm = collect($col);
                $vehicle[] = $itm->merge([
                    'ShipmentInfo' => $shipment_item_vehicle_status,
                ]);
            }
            return $vehicle;
        }
        return Vehicle::paginate(10);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $vehicle = Vehicle::find($id);
        if (empty($vehicle)) {
            return response()->json(['message' => 'Not Found!'], 404);
        } else {
            return $vehicle;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $token = $request->code;
        if ($token == "RRNirxFh4j9Ftd") {
            $vehicle = Vehicle::find($id);
            $vehicle->availability_status = $request->availability_status;
            $vehicle->status = $request->status;
            $vehicle->save();
            return $vehicle;
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
