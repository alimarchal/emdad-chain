<?php

namespace App\Http\Controllers;

use App\Http\Livewire\BusinessWarehouse;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('SuperAdmin'))
        {
            $vehicles = Vehicle::all();
        }
        else
            {
                $vehicles = Vehicle::where('supplier_business_id', auth()->user()->business_id)->get();
            }

        return view('vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicle.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicleCount = Vehicle::where('supplier_business_id', auth()->id())->count();

        if (\auth()->user()->business_package->package_id == 5 && $vehicleCount == 5 )
        {
            session()->flash('message', 'Cannot Add because Add Vehicles limit has reached');
            return redirect()->back();
        }
        elseif (\auth()->user()->business_package->package_id == 6 && $vehicleCount == 20 )
        {
            session()->flash('message', 'Cannot Add because Add Vehicles limit has reached');
            return redirect()->back();
        }

        $vehicle = new Vehicle();

        $vehicle->supplier_business_id = auth()->user()->business_id;
        $vehicle->warehouse_id = $request->warehouse_id;
        $vehicle->type = $request->type;
        $vehicle->licence_plate_No = $request->licence_plate_No;
        $vehicle->availability_status = 1;
        $vehicle->status = 1;
        $vehicle->save();

        return redirect()->route('vehicle.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        return view('vehicle.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $vehicle->type = $request->type;
        $vehicle->licence_plate_No = $request->licence_plate_No;
        $vehicle->warehouse_id = $request->warehouse_id;
        $vehicle->update();

        return redirect()->route('vehicle.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return back()->with('success', 'Vehicle deleted successfully');
    }
}
