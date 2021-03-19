<?php

namespace App\Http\Controllers;

use App\Models\BusinessPackage;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BusinessPackageController extends Controller
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
        $package = Package::where('id', $request->package_id)->first();
//        dd($package);
        $subscription_end_date = Carbon::now()->addYear();
//        dd(Carbon::parse($subscription_end_date)->format('d-m-y'));
        if (auth()->user()->registration_type == 'Buyer')
        {
            BusinessPackage::create([
                'business_type' => 1,
                'package_id' => $package->id,
                'user_id' => auth()->id(),
                'subscription_start_date' => Carbon::now(),
                'subscription_end_date' => $subscription_end_date,
            ]);

            return redirect()->route('parentCategories');
        }
        elseif(auth()->user()->registration_type == 'Supplier')
        {
            BusinessPackage::create([
                'business_type' => 2,
                'package_id' => $package->id,
                'user_id' => auth()->id(),
                'subscription_start_date' => Carbon::now(),
                'subscription_end_date' => $subscription_end_date,
            ]);
            return redirect()->route('parentCategories');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessPackage  $businessPackage
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessPackage $businessPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessPackage  $businessPackage
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessPackage $businessPackage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessPackage  $businessPackage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessPackage $businessPackage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessPackage  $businessPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessPackage $businessPackage)
    {
        //
    }

    public function updateCategories(Request $request)
    {
        $categories = implode(',', $request->category_id);

        $businessPackage = BusinessPackage::where('id', $request->business_id)->first();
        $businessPackage->update([
            'categories' => $categories,
        ]);
        return redirect()->route('business.create');
    }
}
