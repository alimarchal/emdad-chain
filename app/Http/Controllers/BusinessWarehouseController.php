<?php

namespace App\Http\Controllers;

use App\Models\Business;
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
    public function index(Request $request)
    {
        if ($request->has('status')) {
            // dd($request->all());
            $warehouses = new Business();
            if ($request->input('status')) {
                $warehouses = $warehouses->where('status', $request->status);

            }
            $warehouses = $warehouses->get();
            return view('business.index', compact('warehouses'));

        } else {
            $warehouses = BusinessWarehouse::all();

            return view('businessWarehouse.index', compact('warehouses'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $business = Business::where('user_id', auth()->id())->get();
        if ($business->isEmpty()) {
            session()->flash('message', 'Please enter business information first.');
            return redirect()->route('business.create');
        }
        else {
        return view('businessWarehouse.create');
        }

    }

    public function businessWarehouseShow(Request $request, $id)
    {
        $business = BusinessWarehouse::where('business_id', $id)->get();
        return view('businessWarehouse.showAllWareHouse', compact('business'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'business_id' => 'required',
            'name' => 'required',
            'designation' => 'required',
            'warehouse_email' => 'required',
            'landline' => 'required',
            'mobile' => 'required',
            'country' => 'required',
            'address' => 'required',
            'city' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'warehouse_type' => 'required',
            'cold_storage' => 'required',
            'gate_type' => 'required',
            'fork_lift' => 'required',
            'total_warehouse_manpower' => 'required',
            'working_time' => 'required',
            'working_time_1' => 'required',
        ]);

        $merge_time = $request->working_time . " - " . $request->working_time_1;
        $request->merge(['working_time' => $merge_time]);
        $bw = BusinessWarehouse::create($request->all());
        session()->flash('message', 'Business warehouse information successfully saved.');
        return redirect()->route('purchaseOrderInfo.create');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\BusinessWarehouse $businessWarehouse
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessWarehouse $businessWarehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\BusinessWarehouse $businessWarehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessWarehouse $businessWarehouse)
    {
//        dd($businessWarehouse);
        return view('businessWarehouse.edit', compact('businessWarehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BusinessWarehouse $businessWarehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessWarehouse $businessWarehouse)
    {

        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'designation' => 'required',
            'warehouse_email' => 'required',
            'landline' => 'required',
            'mobile' => 'required',
            'country' => 'required',
            'address' => 'required',
            'warehouse_type' => 'required',
            'cold_storage' => 'required',
            'gate_type' => 'required',
            'fork_lift' => 'required',
            'total_warehouse_manpower' => 'required',
            'number_of_drivers' => 'required',
            'working_time' => 'required',
        ]);
        $businessWarehouse->update($request->all());
        session()->flash('message', 'Warehouse information successfully updated.');
        return redirect()->route('businessWarehouse.edit', $businessWarehouse->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BusinessWarehouse $businessWarehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessWarehouse $businessWarehouse)
    {
        //
    }
}
