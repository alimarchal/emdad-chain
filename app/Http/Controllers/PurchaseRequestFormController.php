<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\POInfo;
use App\Models\PurchaseRequestForm;
use Illuminate\Http\Request;

class PurchaseRequestFormController extends Controller
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
        $business = Business::where('user_id', auth()->id())->get();
        if ($business->isEmpty()) {
            session()->flash('message', 'Please enter business information first.');
            return redirect()->route('business.create');
        } else {

            return view('purchaseOrderInfo.create', compact('business'));
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
     * @param \App\Models\PurchaseRequestForm $purchaseRequestForm
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseRequestForm $purchaseRequestForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\PurchaseRequestForm $purchaseRequestForm
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseRequestForm $purchaseRequestForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PurchaseRequestForm $purchaseRequestForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseRequestForm $purchaseRequestForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\PurchaseRequestForm $purchaseRequestForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseRequestForm $purchaseRequestForm)
    {
        //
    }
}
