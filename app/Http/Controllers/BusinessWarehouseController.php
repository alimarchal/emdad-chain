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
        if($request->has('status')) {
            // dd($request->all());
            $warehouses = new Business();
            if ($request->input('status')) {
                $warehouses = $warehouses->where('status',$request->status);

            }
            $warehouses = $warehouses->get();
            return view('business.index',compact('warehouses'));

        }

        else {
            $warehouses = BusinessWarehouse::all();

            return view('businessWarehouse.index',compact('warehouses'));
        }
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

    public function businessWarehouseShow(Request $request, $id)
    {
        $business = BusinessWarehouse::where('business_id',$id)->get();
        return view('businessWarehouse.showAllWareHouse',compact('business'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicle_category = NULL;
        $vehicle_type = NULL;
        if (isset($request->vehicle_category)) {
            $count = 1;
            foreach ($request->vehicle_category as $item) {
                if ($count == 1)
                    $vehicle_category = $item;
                else
                    $vehicle_category = $vehicle_category . ', ' . $item;
                $count++;
            }
        }
        if (isset($request->vehicle_type)) {
            $count = 1;
            foreach ($request->vehicle_type as $item) {
                if ($count == 1)
                    $vehicle_type = $item;
                else
                    $vehicle_type = $vehicle_type . ', ' . $item;
                $count++;
            }
        }
        $request->merge(['vehicle_category' => $vehicle_category]);
        $request->merge(['vehicle_type' => $vehicle_type]);
//        dd($request->all());
        $user = User::findOrFail($request->user_id[0]);
        if (isset($request->user_id)) {
            for ($count = 0; $count < count($request->user_id); $count++) {
                $businessWarehouse = new BusinessWarehouse();
                $businessWarehouse->user_id = $request->user_id[$count];
                $businessWarehouse->business_id = $user->business_id;
                $businessWarehouse->designation = $request->designation[$count];
                $businessWarehouse->name = $request->name[$count];
                $businessWarehouse->warehouse_email = $request->warehouse_email[$count];
                $businessWarehouse->landline = $request->landline[$count];
                $businessWarehouse->mobile = $request->mobile[$count];
                $businessWarehouse->country = $request->country[$count];
                $businessWarehouse->address = $request->address;
                $businessWarehouse->city = $request->city[$count];
                $businessWarehouse->longitude = $request->longitude[$count];
                $businessWarehouse->latitude = $request->latitude[$count];
                $businessWarehouse->warehouse_type = $request->warehouse_type[$count];
                $businessWarehouse->cold_storage = $request->cold_storage[$count];
                $businessWarehouse->gate_type = $request->gate_type[$count];
                $businessWarehouse->fork_lift = $request->fork_lift[$count];
                $businessWarehouse->total_warehouse_manpower = $request->total_warehouse_manpower[$count];
                $businessWarehouse->number_of_delivery_vehicles = $request->number_of_delivery_vehicles[$count];
                $businessWarehouse->number_of_drivers = $request->number_of_drivers[$count];
                $businessWarehouse->working_time = $vehicle_category;
                $businessWarehouse->vehicle_category = $vehicle_type;
                $businessWarehouse->save();
            }
        }
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
        return view('businessWarehouse.edit',compact('businessWarehouse'));
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
        $vehicle_category = NULL;
        $vehicle_type = NULL;
        if (isset($request->vehicle_category)) {
            $count = 1;
            foreach ($request->vehicle_category as $item) {
                if ($count == 1)
                    $vehicle_category = $item;
                else
                    $vehicle_category = $vehicle_category . ', ' . $item;
                $count++;
            }
        }
        if (isset($request->vehicle_type)) {
            $count = 1;
            foreach ($request->vehicle_type as $item) {
                if ($count == 1)
                    $vehicle_type = $item;
                else
                    $vehicle_type = $vehicle_type . ', ' . $item;
                $count++;
            }
        }
        $request->merge(['vehicle_category' => $vehicle_category]);
        $request->merge(['vehicle_type' => $vehicle_type]);
        $businessWarehouse->update($request->all());
        session()->flash('message', 'Warehouse information successfully updated.');
        return redirect()->route('businessWarehouse.edit',$businessWarehouse->id);
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
