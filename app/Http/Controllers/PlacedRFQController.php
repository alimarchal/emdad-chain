<?php

namespace App\Http\Controllers;

use App\Models\PlacedRFQ;
use Illuminate\Http\Request;

class PlacedRFQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('RFQPlaced.index');
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
}
