<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessWarehouse;
use App\Models\User;
use Illuminate\Http\Request;

class BusinessWarehouseController extends Controller
{
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

    public function show(BusinessWarehouse $businessWarehouse)
    {
        //
    }

    public function edit(BusinessWarehouse $businessWarehouse)
    {
//        dd($businessWarehouse);
        return view('businessWarehouse.edit', compact('businessWarehouse'));
    }

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

    public function destroy(BusinessWarehouse $businessWarehouse)
    {
        //
    }
}
