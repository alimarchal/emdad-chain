<?php

namespace App\Http\Controllers;

use App\Models\Qoute;
use Illuminate\Http\Request;

class QouteController extends Controller
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
        $request->merge(['user_id' => auth()->user()->id]);
        $request->merge(['qoute_status' =>'processing']);
        $request->merge(['status' =>'pending']);
        Qoute::create($request->all());
        session()->flash('message', 'Business information successfully saved.');
        return redirect()->route('businessWarehouse.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Qoute  $qoute
     * @return \Illuminate\Http\Response
     */
    public function show(Qoute $qoute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Qoute  $qoute
     * @return \Illuminate\Http\Response
     */
    public function edit(Qoute $qoute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Qoute  $qoute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Qoute $qoute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Qoute  $qoute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Qoute $qoute)
    {
        //
    }
}
