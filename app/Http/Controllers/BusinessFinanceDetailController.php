<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessFinanceDetail;
use Illuminate\Http\Request;

class BusinessFinanceDetailController extends Controller
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
            session()->flash('message', 'Pelase enter business inforamtion first.');
            return redirect()->route('business.create');
        } else {
            $finance = BusinessFinanceDetail::where('business_id', $business[0]->id)->get();
            if ($finance->isNotEmpty()) {
                return redirect()->route('businessFinanceDetail.show',$finance[0]->id);
            } else {
                $business = Business::where('user_id', auth()->id())->get();
                return view('businessFinanceDetails.create', compact('business'));
            }

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
        BusinessFinanceDetail::create([
            'business_id' => $request->business_id,
            'designation' => $request->designation,
            'name' => $request->name,
            'landline' => $request->landline,
            'mobile' => $request->mobile,
            'bank_name' => $request->bank_name,
            'iban' => $request->iban,
        ]);
        session()->flash('message', 'Business finance information successfully saved.');
        return redirect()->route('businessWarehouse.create');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\BusinessFinanceDetail $businessFinanceDetail
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessFinanceDetail $businessFinanceDetail)
    {
        return view('businessFinanceDetails.show', compact('businessFinanceDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\BusinessFinanceDetail $businessFinanceDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessFinanceDetail $businessFinanceDetail)
    {
        $business = Business::all();
        return view('businessFinanceDetails.edit', compact('businessFinanceDetail','business'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BusinessFinanceDetail $businessFinanceDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessFinanceDetail $businessFinanceDetail)
    {
        $businessFinanceDetail->update($request->all());
        session()->flash('message', 'Business finance information updated.');
        return redirect()->route('businessFinanceDetail.edit', $businessFinanceDetail->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BusinessFinanceDetail $businessFinanceDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessFinanceDetail $businessFinanceDetail)
    {
        //
    }
}
