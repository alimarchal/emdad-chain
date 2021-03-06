<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use App\Models\Dashboard;
use App\Models\EOrderItems;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd(Auth::user()->usertype);
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
        $pending_orders = EOrderItems::where('status','pending')->whereIn('item_code', $business_categories)->get();

        return view('dashboard',compact($pending_orders));
    }

    public function languageChange(Request $request)
    {
        User::where('id', \auth()->user()->id)->update([
            'rtl' => $request->rtl_value,
        ]);

        return response()->json(['success']);
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
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
