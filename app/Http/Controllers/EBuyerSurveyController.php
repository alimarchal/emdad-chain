<?php

namespace App\Http\Controllers;

use App\Models\EBuyerSurvey;
use Illuminate\Http\Request;

class EBuyerSurveyController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EBuyerSurvey  $eBuyerSurvey
     * @return \Illuminate\Http\Response
     */
    public function show(EBuyerSurvey $eBuyerSurvey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EBuyerSurvey  $eBuyerSurvey
     * @return \Illuminate\Http\Response
     */
    public function edit(EBuyerSurvey $eBuyerSurvey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EBuyerSurvey  $eBuyerSurvey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EBuyerSurvey $eBuyerSurvey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EBuyerSurvey  $eBuyerSurvey
     * @return \Illuminate\Http\Response
     */
    public function destroy(EBuyerSurvey $eBuyerSurvey)
    {
        //
    }
}
