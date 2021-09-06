<?php

namespace App\Http\Controllers;

use App\Http\Livewire\BusinessWarehouse;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('SuperAdmin'))
        {
            $vehicles = Vehicle::all();
        }
        else
        {
            //Checking vehicles count for related packages
            $vehiclesCount = Vehicle::where([['supplier_business_id', \auth()->user()->business_id]])->count();

            $vehicles = Vehicle::where('supplier_business_id', auth()->user()->business_id)->get();
        }

        return view('vehicle.index', compact('vehicles', 'vehiclesCount'));
    }

    public function create()
    {
        //Checking vehicles count for related packages
        $vehiclesCount = Vehicle::where([['supplier_business_id', \auth()->user()->business_id]])->count();

        if (\auth()->user()->business_package->package_id == 5 && $vehiclesCount == 2 )
        {
            session()->flash('message', __('portal.Add Vehicles limit reached.'));
            return redirect()->back();
        }

        elseif (\auth()->user()->business_package->package_id == 6 && $vehiclesCount == 20 )
        {
            session()->flash('message', __('portal.Add Vehicles limit reached.'));
            return redirect()->back();
        }

        return view('vehicle.create', compact('vehiclesCount'));
    }

    public function store(Request $request)
    {
        $vehicleCount = Vehicle::where('supplier_business_id', auth()->id())->count();

        if (\auth()->user()->business_package->package_id == 5 && $vehicleCount == 5 )
        {
            session()->flash('message', __('portal.Cannot Add because Add Vehicles limit has reached.'));
            return redirect()->back();
        }
        elseif (\auth()->user()->business_package->package_id == 6 && $vehicleCount == 20 )
        {
            session()->flash('message', __('portal.Cannot Add because Add Vehicles limit has reached.'));
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

    public function edit(Vehicle $vehicle)
    {
        return view('vehicle.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $vehicle->type = $request->type;
        $vehicle->licence_plate_No = $request->licence_plate_No;
        $vehicle->warehouse_id = $request->warehouse_id;
        $vehicle->update();

        return redirect()->route('vehicle.index');
    }

    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->availability_status == 0)
        {
            session()->flash('error', __('portal.Vehicle cannot be deleted because it has a shipment assigned.'));
            return redirect()->back();
        }

        $vehicle->delete();
        return back()->with('success', __('portal.Vehicle deleted successfully.'));
    }
}
