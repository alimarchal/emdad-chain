<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use App\Models\EOrderItems;
use App\Models\EOrders;
use App\Models\PlacedRFQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlacedRFQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PlacedRFQ = EOrders::where('user_id', auth()->user()->id)->get();
        return view('RFQPlaced.index', compact('PlacedRFQ'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlacedRFQ  $placedRFQ
     * @return \Illuminate\Http\Response
     */
    public function show(PlacedRFQ $placedRFQ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlacedRFQ  $placedRFQ
     * @return \Illuminate\Http\Response
     */
    public function edit(PlacedRFQ $placedRFQ)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlacedRFQ  $placedRFQ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlacedRFQ $placedRFQ)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlacedRFQ  $placedRFQ
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlacedRFQ $placedRFQ)
    {
        //
    }

    public function RFQItems(Request $request, $EOrderItems)
    {
        $collection = EOrderItems::where('e_order_id', $EOrderItems)->get();
        return view('RFQPlaced.show', compact('collection'));
    }


    public function viewRFQs()
    {
        $user_business_id = Auth::user()->business_id;
        $business_categories = [];
        $business_cate = BusinessCategory::where('business_id', $user_business_id)->get();
        if ($business_cate->isNotEmpty()) {
            foreach ($business_cate as $item) {
                $business_categories[] = (int)$item->category_number;
            }
        }
        sort($business_categories);
        // $business_categories = implode(",", $business_categories);
        $collection = EOrderItems::where('status', 'pending')->whereIn('item_code', $business_categories)->get();

        return view('supplier.index', compact('collection'));
    }


    public function viewRFQsID(EOrderItems $eOrderItems)
    {
        return view('supplier.supplier-qoute', compact('eOrderItems'));
    }

    public function RFQsQouted()
    {
        $collection = EOrderItems::where('e_orders_id', $EOrderItems)->get();
        return view('RFQPlaced.show', compact('collection'));
    }
}
