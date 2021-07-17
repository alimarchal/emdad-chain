<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\LogisticsBusiness;
use Illuminate\Http\Request;

class LogisticsBusinessController extends Controller
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
        $logisticsBusiness = Business::where('logistics_business_id', auth()->user()->id)->first();
        if ($logisticsBusiness === null) {
            return view('logistic.business.create', compact('logisticsBusiness'));
        } else {
            return redirect()->route('business.show', $logisticsBusiness->id);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\LogisticsBusiness $logisticsBusiness
     * @return \Illuminate\Http\Response
     */
    public function show(LogisticsBusiness $logisticsBusiness)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\LogisticsBusiness $logisticsBusiness
     * @return \Illuminate\Http\Response
     */
    public function edit(LogisticsBusiness $logisticsBusiness)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LogisticsBusiness $logisticsBusiness
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LogisticsBusiness $logisticsBusiness)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\LogisticsBusiness $logisticsBusiness
     * @return \Illuminate\Http\Response
     */
    public function destroy(LogisticsBusiness $logisticsBusiness)
    {
        //
    }
}
