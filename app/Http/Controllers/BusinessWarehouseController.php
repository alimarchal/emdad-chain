<?php

namespace App\Http\Controllers;

use App\Models\BusinessWarehouse;
use App\Models\User;
use Illuminate\Http\Request;

class BusinessWarehouseController extends Controller
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
        return view('businessWarehouse.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::findOrFail($request->user_id[0]);
        if (isset($request->user_id)) {
            for($count = 0; $count < count($request->user_id); $count++) {
                $businessWarehouse = new BusinessWarehouse();
                $businessWarehouse->user_id = $request->user_id[$count];
                $businessWarehouse->business_id = $user->business_id;
                $businessWarehouse->designation = $request->designation[$count];
                $businessWarehouse->name = $request->name[$count];
                $businessWarehouse->warehouse_email = $request->warehouse_email[$count];
                $businessWarehouse->landline = $request->landline[$count];
                $businessWarehouse->mobile = $request->mobile[$count];
                $businessWarehouse->country = $request->country[$count];
                $businessWarehouse->city = $request->city[$count];
                $businessWarehouse->longitude = $request->longitude[$count];
                $businessWarehouse->latitude = $request->latitude[$count];
                $businessWarehouse->warehouse_type = $request->warehouse_type[$count];
                $businessWarehouse->cold_storage = $request->cold_storage[$count];
                $businessWarehouse->gate_type = $request->gate_type[$count];
                $businessWarehouse->fork_lift = $request->fork_lift[$count];
                $businessWarehouse->total_warehouse_manpower = $request->total_warehouse_manpower[$count];
                $businessWarehouse->save();
            }
        }
        session()->flash('message', 'Business warehouse information successfully saved.');
        return redirect()->route('businessWarehouse.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessWarehouse  $businessWarehouse
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessWarehouse $businessWarehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessWarehouse  $businessWarehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessWarehouse $businessWarehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessWarehouse  $businessWarehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessWarehouse $businessWarehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessWarehouse  $businessWarehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessWarehouse $businessWarehouse)
    {
        //
    }
}
