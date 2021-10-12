<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Shipment;
use App\Models\ShipmentCart;
use App\Models\User;
use Illuminate\Http\Request;

class ShipmentCartController extends Controller
{
    public function index()
    {
        $shipmentCarts = ShipmentCart::where('supplier_business_id', auth()->user()->business_id)->get();
        return view('shipment.generated', compact(  'shipmentCarts'));
    }

    public function store(Request $request)
    {
        $cartCheck = ShipmentCart::where(['supplier_business_id' =>  auth()->user()->business_id])->first();

        /* Checking Cart for any shipment entry inorder to get driver, vehicle IDs and Supplier Business ID  */
        if (isset($cartCheck))
        {
            $validated = \Validator::make($request->all(),[
                'delivery_id' => 'required',
            ],[
                'delivery_id.required' => 'Please Select a Delivery',
            ]);

            if ($validated->fails()) {
                return redirect()->back()->withInput()->withErrors($validated->errors());
            }

            /* Exploding concatenated delivery and rfq IDs */
            $delivery = explode(',',$request->delivery_id);

            $buyerBusinessID = Delivery::where('id', (int)$delivery[0])->pluck('business_id')->first();

            $shipmentCarts = ShipmentCart::create([
                'driver_id'  =>  $cartCheck->driver_id,
                'vehicle_id'  =>  $cartCheck->vehicle_id,
                'supplier_business_id'  =>  $cartCheck->supplier_business_id,
                'buyer_business_id'  =>  $buyerBusinessID,
                'rfq_no'  =>  (int)$delivery[1],
                'delivery_id'  =>  (int)$delivery[0],
            ]);
            Delivery::where('rfq_no', (int)$delivery[1])->update(['shipment_status' => 1]);

            session()->flash('message', __('portal.Shipment successfully added to cart.'));
        }
        else
            {
                $validated = \Validator::make($request->all(),[
                    'driver_id' => 'required',
                    'vehicle_id' => 'required',
                    'delivery_id' => 'required',
                ],[
                    'driver_id.required' => 'Please Select a Driver',
                    'vehicle_id.required' => 'Please Select any Vehicle',
                    'delivery_id.required' => 'Please Select a Delivery',
                ]);

                if ($validated->fails()) {
                    return redirect()->back()->withInput()->withErrors($validated->errors());
                }

                /* Exploding concatenated delivery and rfq IDs */
                $delivery = explode(',',$request->delivery_id);

                $buyerBusinessID = Delivery::where('id', (int)$delivery[0])->pluck('business_id')->first();

                $request->merge(['driver_id' => $request->driver_id]);
                $request->merge(['vehicle_id' => $request->vehicle_id]);
                $request->merge(['supplier_business_id' => auth()->user()->business_id]);
                $request->merge(['buyer_business_id' => $buyerBusinessID]);
                $request->merge(['rfq_no' => (int)$delivery[1]]);
                $request->merge(['delivery_id' => (int)$delivery[0]]);
                $shipmentCarts = ShipmentCart::create($request->all());
                Delivery::where('rfq_no', $delivery[1])->update(['shipment_status' => 1]);

                session()->flash('message', __('portal.Shipment successfully added to cart.'));
            }

        return redirect()->route('shipment.create', compact('shipmentCarts'));
    }

    public function destroy($rfq_no)
    {
        Delivery::where('rfq_no', $rfq_no)->update(['shipment_status' => 0]);
        ShipmentCart::where('rfq_no', $rfq_no)->delete();

        session()->flash('message', __('portal.Item successfully deleted.'));

        return back();
    }
}
