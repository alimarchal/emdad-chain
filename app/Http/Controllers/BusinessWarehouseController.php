<?php

namespace App\Http\Controllers;

use App\Models\BusinessWarehouse;
use Illuminate\Http\Request;

class BusinessWarehouseController extends Controller
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
        return view('businessWarehouse.create');
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
     * @param  \App\Models\BusinessWarehouse  $businessWarehouse
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessWarehouse $businessWarehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessWarehouse  $businessWarehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessWarehouse $businessWarehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessWarehouse  $businessWarehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessWarehouse $businessWarehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessWarehouse  $businessWarehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessWarehouse $businessWarehouse)
    {
        //
    }
}
