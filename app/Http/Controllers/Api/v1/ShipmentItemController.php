<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentItem;
use Illuminate\Http\Request;

class ShipmentItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shipment_item = new ShipmentItem();
        if ($request->has('driver_id') || $request->has('status')) {
            if ($request->input('driver_id')) {
                $shipment_item = $shipment_item->where('driver_id', $request->driver_id);
            }
            if ($request->input('status')) {
                $shipment_item = $shipment_item->where('status', $request->status);
            }
            $shipment_item = $shipment_item->get();
            if ($shipment_item->isEmpty()) {
                return response()->json(['message' => 'Not Found!'], 404);
            } else {
                return $shipment_item;
            }
        } else {
            $shipment_item = $shipment_item->paginate(20);
            return $shipment_item;
        }
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $token = $request->code;
        if ($token == "RRNirxFh4j9Ftd") {
            $shipment_item = ShipmentItem::find($id);
            if (empty($shipment_item)) {
                return response()->json(['message' => 'Not Found!'], 404);
            } else {
                return $shipment_item;
            }
        } else {
            return response()->json(['message' => 'UnAuthorized Access!'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $token = $request->code;
        if ($token == "RRNirxFh4j9Ftd") {
            $shipment_item = ShipmentItem::find($id);
            if (!empty($shipment_item)) {
                $updated = $shipment_item->update($request->all());
                return $shipment_item;
            } else {
                return response()->json(['message' => 'Not Found!'], 404);
            }
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
