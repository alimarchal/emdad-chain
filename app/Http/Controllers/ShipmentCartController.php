<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\ShipmentCart;
use App\Models\User;
use Illuminate\Http\Request;

class ShipmentCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipmentCarts = ShipmentCart::where('business_id', auth()->user()->business_id)->get();
        return view('shipment.generated', compact(  'shipmentCarts'));
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
        $cartCheck = ShipmentCart::where(['business_id' =>  auth()->user()->business_id])->first();
        if (isset($cartCheck))
        {
//            $data = array([
//                'business_id'  =>  $cartCheck->business_id,
//                'driver_id'  =>  $cartCheck->driver_id,
//                'vehicle_type'  =>  $cartCheck->vehicle_type,
//                'delivery_id'  =>  $request->delivery_id,
//            ]);
            $shipmentCarts = ShipmentCart::create([
                'business_id'  =>  $cartCheck->business_id,
                'driver_id'  =>  $cartCheck->driver_id,
                'vehicle_type'  =>  $cartCheck->vehicle_type,
                'delivery_id'  =>  $request->delivery_id,
            ]);
            Delivery::where('id', $request->delivery_id)->update(['shipment_status' => 1]);

            session()->flash('message', 'Shipment successfully added to cart.');
        }
        else
            {
                $request->merge(['business_id' => auth()->user()->business_id]);
                $request->merge(['driver_id' => $request->driver_id]);
                $request->merge(['vehicle_type' => $request->vehicle_type]);
                $request->merge(['delivery_id' => $request->delivery_id]);
                $shipmentCarts = ShipmentCart::create($request->all());
                Delivery::where('id', $request->delivery_id)->update(['shipment_status' => 1]);
                session()->flash('message', 'Shipment successfully added to cart.');
            }

        return redirect()->route('shipment.create', compact('shipmentCarts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShipmentCart  $shipmentCart
     * @return \Illuminate\Http\Response
     */
    public function show(ShipmentCart $shipmentCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShipmentCart  $shipmentCart
     * @return \Illuminate\Http\Response
     */
    public function edit(ShipmentCart $shipmentCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShipmentCart  $shipmentCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShipmentCart $shipmentCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShipmentCart  $shipmentCart
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShipmentCart $shipmentCart)
    {
        session()->flash('message', 'Item successfully deleted.');
        Delivery::where('id', $shipmentCart->delivery_id)->update(['shipment_status' => 0]);
        $shipmentCart->delete();

        return back();
    }
}
