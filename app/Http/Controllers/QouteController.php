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
        $request->merge(['qoute_status' =>'Qouted']);
        $request->merge(['status' =>'pending']);

        // dd($request->all());
        Qoute::create($request->all());
        session()->flash('message', 'Qoute information successfully saved.');
        return redirect()->route('QoutedRFQQouted');
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

    public function QoutedRFQQouted()
    {
        $user_id = auth()->user()->id;
        $collection = Qoute::where('user_id',$user_id)->where('qoute_status','Qouted')->get();
        return view('supplier.supplier-qouted',compact('collection'));
    }


    public function QoutedRFQRejected()
    {
        $user_id = auth()->user()->id;
        $collection = Qoute::where('user_id',$user_id)->where('qoute_status','Rejected')->get();
        return view('supplier.supplier-qouted-Rejected',compact('collection'));
    }


    public function QoutedRFQModificationNeeded()
    {
        $user_id = auth()->user()->id;
        $collection = Qoute::where('user_id',$user_id)->where('qoute_status','ModificationNeeded')->get();
        return view('supplier.supplier-qouted-ModificationNeeded',compact('collection'));
    }


    public function QoutedRFQQoutedRFQPendingConfirmation()
    {
        $user_id = auth()->user()->id;
        $collection = Qoute::where('user_id',$user_id)->where('qoute_status','RFQPendingConfirmation')->get();
        return view('supplier.supplier-qouted-PendingConfirmation',compact('collection'));
    }

}
