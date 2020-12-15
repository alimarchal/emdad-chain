<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class BusinessController extends Controller
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

        $parentCategories = Category::where('parent_id',0)->get();
        return view('business.create',compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    if ($request->has('chamber_reg_path_1')) {
        $path = $request->file('chamber_reg_path_1')->store('', 'public');
        $request->merge(['profile_photo_path' => $path]);
    }
    if ($request->has('vat_reg_certificate_path_2')) {
        $path = $request->file('vat_reg_certificate_path_2')->store('', 'public');
        $request->merge(['profile_photo_path' => $path]);
    }
    $business = Business::create($request->all());
    $user = User::find($business->user_id);
    $user->business_id = $business->id;
    $user->save();
    session()->flash('message', 'Business information successfully saved.');
    return redirect()->route('businessFinanceDetail.create');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Business $business
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Business $business
     * @return \Illuminate\Http\Response
     */
    public function edit(Business $business)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Business $business
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Business $business
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business)
    {
        //
    }
}
