<?php

namespace App\Http\Controllers;

use App\Models\DraftPurchaseOrder;
use Illuminate\Http\Request;

class DraftPurchaseOrderController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DraftPurchaseOrder  $draftPurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(DraftPurchaseOrder $draftPurchaseOrder)
    {
        return view('purchaseOrderInfo.dpo');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DraftPurchaseOrder  $draftPurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(DraftPurchaseOrder $draftPurchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DraftPurchaseOrder  $draftPurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DraftPurchaseOrder $draftPurchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DraftPurchaseOrder  $draftPurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(DraftPurchaseOrder $draftPurchaseOrder)
    {
        //
    }
}
