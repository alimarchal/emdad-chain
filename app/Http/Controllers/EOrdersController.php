<?php

namespace App\Http\Controllers;

use App\Models\ECart;
use App\Models\EOrderItems;
use App\Models\EOrders;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EOrdersController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::transaction(function () use ($request) {
            $request->merge(['status' => 'Open']);
            $eOrders = EOrders::create($request->all());
            $eCartItems = ECart::findMany($request->item_number);
            foreach ($eCartItems as $item) {
                $eOrderItem = new EOrderItems;
                $eOrderItem->id = $item->id;
                $eOrderItem->e_order_id = $eOrders->id;
                $eOrderItem->business_id = $item->business_id;
                $eOrderItem->user_id = $item->user_id;
                $eOrderItem->warehouse_id = $item->warehouse_id;
                $eOrderItem->item_code = $item->item_code;
                $eOrderItem->item_name = $item->item_name;
                $eOrderItem->description = $item->description;
                $eOrderItem->unit_of_measurement = $item->unit_of_measurement;
                $eOrderItem->size = $item->size;
                $eOrderItem->quantity = $item->quantity;
                $eOrderItem->brand = $item->brand;
                $eOrderItem->last_price = $item->last_price;
                $eOrderItem->remarks = $item->remarks;
                $eOrderItem->delivery_period = $item->delivery_period;
                $eOrderItem->file_path = $item->file_path;
                $eOrderItem->payment_mode = $item->payment_mode;
                $eOrderItem->required_sample = $item->required_sample;
                $eOrderItem->status = $item->status;
                $eOrderItem->save();
            }
            foreach ($eCartItems as $item) {
                $item->delete();
            }
        });


        return redirect()->route('PlacedRFQ.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\EOrders $eOrders
     * @return \Illuminate\Http\Response
     */
    public function show(EOrders $eOrders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\EOrders $eOrders
     * @return \Illuminate\Http\Response
     */
    public function edit(EOrders $eOrders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EOrders $eOrders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EOrders $eOrders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\EOrders $eOrders
     * @return \Illuminate\Http\Response
     */
    public function destroy(EOrders $eOrders)
    {
        //
    }
}
