<?php

namespace App\Http\Controllers;

use App\Models\DraftPurchaseOrder;
//use Barryvdh\DomPDF\PDF as PDF;
use Barryvdh\DomPDF\Facade as PDF;
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
        $user = auth()->user()->id;
        $dpos = DraftPurchaseOrder::where('user_id', $user)->get();
        return view('draftPurchaseOrder.index', compact('dpos'));
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

        return view('draftPurchaseOrder.show', compact('draftPurchaseOrder'));
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

    public function generatePDF(DraftPurchaseOrder $draftPurchaseOrder)
    {
//        $data = DraftPurchaseOrder::where('user_id', auth()->user()->id)->get();
//        $pdf = PDF::loadView('draftPurchaseOrder.PDF', compact('data'))->setOptions(['defaultFont' => 'sans-serif']);
//        $pdf = PDF::loadView('draftPurchaseOrder.PDF', $data);
//
//        $data = DraftPurchaseOrder::where('user_id', auth()->user()->id)->get();
        $pdf = PDF::loadView('draftPurchaseOrder.PDF', compact('draftPurchaseOrder'))->setOptions(['defaultFont' => 'sans-serif']);
//        $pdf = PDF::loadView('draftPurchaseOrder.PDF', $data);

        return $pdf->download('POs.pdf');
    }
}
