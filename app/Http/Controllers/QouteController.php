<?php

namespace App\Http\Controllers;

use App\Models\EOrderItems;
use App\Models\EOrders;
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
        $request->merge(['qoute_status' => 'Qouted']);
        $request->merge(['status' => 'pending']);

        // dd($request->all());
        Qoute::create($request->all());
        session()->flash('message', 'You have successfully qouted.');
        return redirect()->back();
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

        dd($request->all());
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
        $collection = Qoute::where('user_id', $user_id)->where('qoute_status', 'Qouted')->get();
        return view('supplier.supplier-qouted', compact('collection'));
    }


    public function QoutedRFQRejected()
    {
        $user_id = auth()->user()->id;
        $collection = Qoute::where('user_id', $user_id)->where('qoute_status', 'Rejected')->get();
        return view('supplier.supplier-qouted-Rejected', compact('collection'));
    }


    public function QoutedRFQModificationNeeded()
    {
        $user_id = auth()->user()->id;
        $collection = Qoute::where('user_id', $user_id)->where('qoute_status', 'ModificationNeeded')->get();
        return view('supplier.supplier-qouted-ModificationNeeded', compact('collection'));
    }


    public function QoutedRFQQoutedRFQPendingConfirmation()
    {
        $user_id = auth()->user()->id;
        $collection = Qoute::where('user_id', $user_id)->where('qoute_status', 'RFQPendingConfirmation')->get();
        return view('supplier.supplier-qouted-PendingConfirmation', compact('collection'));
    }


    public function QoutationsBuyerReceived(Request $request)
    {

        $PlacedRFQ = EOrders::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return view('buyer.receivedQoutations', compact('PlacedRFQ'));
    }

    public function QoutationsBuyerReceivedRFQItemsByID(Request $request, $EOrderItems)
    {
        $collection = EOrderItems::where('e_order_id', $EOrderItems)->orderBy('created_at', 'desc')->get();
        return view('buyer.byerItemsShow', compact('collection','EOrderItems'));
    }

    public function QoutationsBuyerReceivedQoutes(Request $request, $EOrderID, $EOrderItemID)
    {
        $collection = EOrderItems::where('id',$EOrderItemID)->orderBy('created_at', 'desc')->first();
        return view('buyer.qoutes',compact('collection','EOrderID','EOrderItemID'));
    }

    public function QoutationsBuyerReceivedQouteID(Request $request, Qoute $QouteItem)
    {

        return view('buyer.qoutesrespond', compact('QouteItem'));
    }

    public function updateModificationNeeded(Request $request, Qoute $qoute)
    {
        $qoute_status = 'ModificationNeeded';
        $qoute->update([
            'qoute_status' => $qoute_status,
            'qoute_updated_user_id' => auth()->user()->id,
        ]);
        session()->flash('message', 'Qoute status changes to ' . $qoute_status);
        return redirect()->back();
    }

    public function updateRejected(Request $request, Qoute $qoute)
    {
        $qoute_status = 'Rejected';
        $qoute->update([
            'qoute_status' => $qoute_status,
            'qoute_updated_user_id' => auth()->user()->id,
        ]);
        session()->flash('message', 'Qoute status changes to ' . $qoute_status);
        return redirect()->back();
    }
}
