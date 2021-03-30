<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\TrackingDelivery;
use App\Models\User;
use Illuminate\Http\Request;

class TrackingDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TrackingDelivery::paginate(10);
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
        $token = $request->code;
        if ($token == "RRNirxFh4j9Ftd") {
            $td = TrackingDelivery::create($request->all());
            return $td;
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $td = TrackingDelivery::find($id);
        if (empty($td)) {
            return response()->json(['message' => 'Not Found!'], 404);
        } else {
            return $td;
        }
    }
    
    
    public function getAllDelivery($id)
    {
        $td = TrackingDelivery::where('delivery_id', $id)->get();
        if (empty($td)) {
            return response()->json(['message' => 'Not Found!'], 404);
        } else {
            return $td;
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
            $trackingDelivery = TrackingDelivery::find($id);
            $updated = $trackingDelivery->update($request->all());
            return $trackingDelivery;
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
