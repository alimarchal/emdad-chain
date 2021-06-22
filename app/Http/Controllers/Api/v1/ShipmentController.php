<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Shipment = new Shipment();
        if ($request->has('id') || $request->has('status')) {
            if ($request->input('id')) {
                $Shipment = $Shipment->where('id', $request->id);
            }
            if ($request->input('status')) {
                $Shipment = $Shipment->where('status', $request->status);
            }
            $Shipment = $Shipment->get();
            if ($Shipment->isEmpty()) {
                return response()->json(['message' => 'Not Found!'], 404);
            } else {
                return $Shipment;
            }
        } else {
            $Shipment = $Shipment->paginate(20);
            return $Shipment;
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
    public function show($id)
    {
        $shipment = Shipment::find($id);
        if (empty($shipment)) {
            return response()->json(['message' => 'Not Found!'], 404);
        } else {
            return $shipment;
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
            $Shipment = Shipment::find($id);
            if (!empty($Shipment)) {
                $updated = $Shipment->update($request->all());
                return $Shipment;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
