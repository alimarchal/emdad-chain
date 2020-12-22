<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\POInfo;
use App\Models\User;
use Illuminate\Http\Request;

class POInfoController extends Controller
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
            $po = POInfo::where('business_id',auth()->user()->business->id)->get();
            return view('purchaseOrderInfo.create', compact('business','po'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $files = $request->file('order_info_1');
        $order_info = [];
        if ($request->has('order_info_1')) {
            foreach ($files as $file) {
                $path = $file->store('', 'public');
                $order_info[] = $path;
            }
        }
        $order_info = implode(', ', $order_info);
        $request->merge(['order_info' => $order_info]);
        $POInfo = POInfo::create($request->all());
        session()->flash('message', 'P.O.Info information successfully saved.');
        $business = Business::find($POInfo->business_id);
        $business->update(['status'=> '1']);
        $user = User::find(auth()->user()->id);
        $user->update(['status' => 1]);
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\POInfo  $pOInfo
     * @return \Illuminate\Http\Response
     */
    public function show(POInfo $purchaseOrderInfo)
    {
        $business = Business::find($purchaseOrderInfo->business_id)->first();
        return view('purchaseOrderInfo.show',compact('purchaseOrderInfo','business'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\POInfo  $pOInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(POInfo $pOInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\POInfo  $pOInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, POInfo $pOInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\POInfo  $pOInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(POInfo $pOInfo)
    {
        //
    }
}
