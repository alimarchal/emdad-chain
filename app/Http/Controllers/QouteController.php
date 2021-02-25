<?php

namespace App\Http\Controllers;

use App\Models\DraftPurchaseOrder;
use App\Models\EOrderItems;
use App\Models\EOrders;
use App\Models\Qoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $quote = Qoute::create($request->all());

        // php artisan make:notification QuoteSend --markdown=mail.quote.send
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
        $request->merge(['user_id' => auth()->user()->id]);
        $request->merge(['qoute_status' => 'Qouted']);
        $request->merge(['status' => 'pending']);
        $request->merge(['qoute_status_updated' => 'Qouted']);
        session()->flash('message', 'You have update qoute.');
        $qoute->update($request->all());
        return redirect()->back();
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
        if (auth()->user()->hasRole('SuperAdmin'))
        {
            $PlacedRFQ = EOrders::orderBy('created_at', 'desc')->get();
        }
        else
            {
                $PlacedRFQ = EOrders::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
            }

        return view('buyer.receivedQoutations', compact('PlacedRFQ'));
    }

    public function QoutationsBuyerReceivedRFQItemsByID(Request $request, $EOrderItems)
    {
        $collection = EOrderItems::where('e_order_id', $EOrderItems)->orderBy('created_at', 'desc')->get();
        return view('buyer.byerItemsShow', compact('collection', 'EOrderItems'));
    }

    public function QoutationsBuyerReceivedQoutes(Request $request, $EOrderID, $EOrderItemID)
    {
        $collection = EOrderItems::where('id', $EOrderItemID)->orderBy('created_at', 'desc')->first();
        return view('buyer.qoutes', compact('collection', 'EOrderID', 'EOrderItemID'));
    }

    public function QoutationsBuyerReceivedRejected(Request $request, $EOrderID, $EOrderItemID)
    {
        $collection = EOrderItems::where('id', $EOrderItemID)->orderBy('created_at', 'desc')->first();
        return view('buyer.qoutedRejected', compact('collection', 'EOrderID', 'EOrderItemID'));
    }

    public function QoutationsBuyerReceivedModificationNeeded(Request $request, $EOrderID, $EOrderItemID)
    {
        $collection = EOrderItems::where('id', $EOrderItemID)->orderBy('created_at', 'desc')->first();
        return view('buyer.qoutationsBuyerReceivedModificationNeeded', compact('collection', 'EOrderID', 'EOrderItemID'));
    }

    public function QoutationsBuyerReceivedAccepted(Request $request, $EOrderID, $EOrderItemID)
    {
        $collection = EOrderItems::where('id', $EOrderItemID)->orderBy('created_at', 'desc')->first();
        return view('buyer.QoutationsBuyerReceivedAccepted', compact('collection', 'EOrderID', 'EOrderItemID'));
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
            'qoute_status_updated' => $qoute_status,
            'status' => 'pending',
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
            'qoute_status_updated' => $qoute_status,
            'status' => 'expired',
        ]);
        session()->flash('message', 'Qoute status changes to ' . $qoute_status);
        return redirect()->back();
    }

    public function qouteAccepted(Request $request, Qoute $qoute)
    {

        $request->merge(['po_date' => date('Y-m-d')]);
        $request->merge(['po_status' => 'pending']);
        $request->merge(['status' => 'pending']);
        $dpo = null;

        try {
            DB::beginTransaction();
            $dpo = DraftPurchaseOrder::create($request->all());
            $qoute_status = 'accepted';
            $qoute->update([
                'qoute_status' => $qoute_status,
                'qoute_updated_user_id' => auth()->user()->id,
                'qoute_status_updated' => $qoute_status,
                'status' => 'completed',
                'dpo' => $dpo->id,
            ]);
            DB::commit();
            /* Transaction successful. */
        } catch (\Exception $e) {

            DB::rollback();
            /* Transaction failed. */
        }

        session()->flash('message', 'Draft purchase order has been generated');
        return redirect()->route('dpo.show', $dpo->id);
    }
}
