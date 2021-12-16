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
            session()->flash('message', __('portal.Please enter business information first.'));
            return redirect()->route('business.create');
        }
        else {
        return view('businessWarehouse.create');
        }

    }

    public function businessWarehouseShow($id)
    {
        $business = BusinessWarehouse::where('business_id', $id)->orderByDesc('created_at')->get();
        return view('businessWarehouse.showAllWareHouse', compact('business'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->registration_type == 'Supplier')
        {
            $request->validate([
                'user_id' => 'required',
                'business_id' => 'required',
                'name' => 'required',
                'warehouse_name' => 'required',
                'designation' => 'required',
                'warehouse_email' => 'required',
                'mobile' => 'required|numeric',
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
                'number_of_delivery_vehicles' => 'required',
                'number_of_drivers' => 'required',
                'working_time' => 'required',
                'working_time_1' => 'required',
            ]);
        }
        else
        {
            $request->validate([
                'user_id' => 'required',
                'business_id' => 'required',
                'name' => 'required',
                'warehouse_name' => 'required',
                'designation' => 'required',
                'warehouse_email' => 'required',
                'mobile' => 'required|numeric',
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
        }

        $merge_time = $request->working_time . " - " . $request->working_time_1;
        $request->merge(['working_time' => $merge_time]);
        BusinessWarehouse::create($request->all());

        session()->flash('message', __('portal.Business warehouse information successfully saved.'));
        if (auth()->user()->business->status == 3)
        {
            return redirect()->route('businessWarehouseShow', auth()->user()->business_id);
        }
        return redirect()->route('purchaseOrderInfo.create');
    }

    public function show(BusinessWarehouse $businessWarehouse)
    {
        //
    }

    public function edit(BusinessWarehouse $businessWarehouse)
    {
        return view('businessWarehouse.edit', compact('businessWarehouse'));
    }

    public function update(Request $request, BusinessWarehouse $businessWarehouse)
    {
        if (auth()->user()->registration_type == 'Supplier')
        {
            $request->validate([
                'user_id' => 'required',
                'name' => 'required',
                'warehouse_name' => 'required',
                'designation' => 'required',
                'warehouse_email' => 'required',
                'mobile' => 'required|numeric',
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
        }
        else
        {
            $request->validate([
                'user_id' => 'required',
                'name' => 'required',
                'warehouse_name' => 'required',
                'designation' => 'required',
                'warehouse_email' => 'required',
                'mobile' => 'required|numeric',
                'country' => 'required',
                'address' => 'required',
                'warehouse_type' => 'required',
                'cold_storage' => 'required',
                'gate_type' => 'required',
                'fork_lift' => 'required',
                'total_warehouse_manpower' => 'required',
                'working_time' => 'required',
            ]);
        }
        $merge_time = $request->working_time . " - " . $request->working_time_1;
        $request->merge(['working_time' => $merge_time]);
        $businessWarehouse->update($request->all());

        session()->flash('message', __('portal.Warehouse information successfully updated.'));
        return redirect()->route('businessWarehouseShow', auth()->user()->business_id);
    }

    public function destroy(BusinessWarehouse $businessWarehouse)
    {
        //
    }

    /* Updating Buyer's warehouse number when he changes in responding to a quotation (OTP number) */
    public function updateNumber(Request $request)
    {
        $warehouse = BusinessWarehouse::where('business_id', auth()->user()->business_id)->first();
        if ($warehouse->mobile_verified == 0 && $warehouse->mobile_verification_code != null)
        {
            BusinessWarehouse::where('business_id', auth()->user()->business_id)->update([
                'mobile' => $request->number,
                'mobile_verification_code' => null,
            ]);
            return response()->json(['data' => 'success']);
        }

        if ($warehouse->mobile_verified == 0)
        {
            BusinessWarehouse::where('business_id', auth()->user()->business_id)->update([
                'mobile' => $request->number,
            ]);
        }
    }
}
