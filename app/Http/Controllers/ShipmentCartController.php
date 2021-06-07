<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
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
        if (isset($cartCheck))
        {
//            $data = array([
//                'business_id'  =>  $cartCheck->business_id,
//                'driver_id'  =>  $cartCheck->driver_id,
//                'vehicle_type'  =>  $cartCheck->vehicle_type,
//                'delivery_id'  =>  $request->delivery_id,
//            ]);
            $shipmentCarts = ShipmentCart::create([
                'driver_id'  =>  $cartCheck->driver_id,
                'vehicle_type'  =>  $cartCheck->vehicle_type,
                'supplier_business_id'  =>  $cartCheck->supplier_business_id,
                'delivery_id'  =>  $request->delivery_id,
            ]);
            Delivery::where('id', $request->delivery_id)->update(['shipment_status' => 1]);

            session()->flash('message', 'Shipment successfully added to cart.');
        }
        else
            {
                $request->merge(['driver_id' => $request->driver_id]);
                $request->merge(['vehicle_type' => $request->vehicle_type]);
                $request->merge(['supplier_business_id' => auth()->user()->business_id]);
                $request->merge(['delivery_id' => $request->delivery_id]);
                $shipmentCarts = ShipmentCart::create($request->all());
                Delivery::where('id', $request->delivery_id)->update(['shipment_status' => 1]);
                session()->flash('message', 'Shipment successfully added to cart.');
            }

        return redirect()->route('shipment.create', compact('shipmentCarts'));
    }

    public function destroy(ShipmentCart $shipmentCart)
    {
        Delivery::where('id', $shipmentCart->delivery_id)->update(['shipment_status' => 0]);
        $shipmentCart->delete();
        session()->flash('message', 'Item successfully deleted.');

        return back();
    }
}
