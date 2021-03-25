<?php

namespace App\Http\Controllers;

use App\Models\DraftPurchaseOrder;
use App\Models\EOrderItems;
use App\Models\EOrders;
use App\Models\Qoute;
use App\Models\User;
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
        $buyer_id = User::where('business_id', $request->business_id)->first();
        $request->merge(['user_id' => $buyer_id->id]);
        $request->merge(['qoute_status' => 'Qouted']);
        $request->merge(['status' => 'pending']);
        $total_cost = ($request->quote_quantity * $request->quote_price_per_quantity);
        $total_vat = ($total_cost * ($request->VAT / 100));
        $total_shipment = $request->shipment_cost;
        $sum = ($total_cost + $total_vat + $total_shipment);
        $request->merge(['total_cost' => $sum]);
        $quote = Qoute::create($request->all());
        // sending mail for confirmation
        $user = User::find(auth()->user()->id)->notify(new \App\Notifications\QuoteSend($quote));
        $buyer_user_id = $quote->RFQ->user_id;
        // send mail to buyer also for receiving email
        $buyer_user = User::find($buyer_user_id)->notify(new \App\Notifications\QuoteReceivedBuyer());
        session()->flash('message', 'You have successfully qouted.');
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
        $request->merge(['user_id' => auth()->user()->id]);
        $request->merge(['qoute_status' => 'Modified']);
        $request->merge(['status' => 'pending']);
        $request->merge(['qoute_status_updated' => 'Modified']);
        session()->flash('message', 'You have update qoute.');
        $qoute->update($request->all());
        $quote = $qoute;
        $user = User::find(auth()->user()->id)->notify(new \App\Notifications\QuoteSend($quote));
        return redirect()->route('viewRFQs');
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
        $collection = Qoute::where('supplier_user_id', $user_id)->where([['qoute_status', 'Qouted'],['qoute_status_updated', null]])->orWhere('qoute_status', 'Modified')->get();
        return view('supplier.supplier-qouted', compact('collection'));
    }

    public function QoutedRFQRejected()
    {
        $user_id = auth()->user()->id;
        $collection = Qoute::where('supplier_user_id', $user_id)->where('qoute_status_updated', 'Rejected')->get();
        return view('supplier.supplier-qouted-Rejected', compact('collection'));
    }

    public function QoutedRFQModificationNeeded()
    {
        $user_id = auth()->user()->id;
        $collection = Qoute::where('supplier_user_id', $user_id)->where('qoute_status_updated', 'ModificationNeeded')->get();
        return view('supplier.supplier-qouted-ModificationNeeded', compact('collection'));
    }

    public function QoutedRFQQoutedRFQPendingConfirmation()
    {
        $user_id = auth()->user()->id;
        $collection = Qoute::where('supplier_user_id', $user_id)->where('qoute_status', 'RFQPendingConfirmation')->get();
        return view('supplier.supplier-qouted-PendingConfirmation', compact('collection'));
    }

    public function QoutationsBuyerReceived(Request $request)
    {
        if (auth()->user()->hasRole('SuperAdmin')) {
            $PlacedRFQ = EOrders::orderBy('created_at', 'desc')->get();
        } else {
            $PlacedRFQ = EOrders::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        }

        return view('buyer.receivedQoutations', compact('PlacedRFQ'));
    }

    public function QoutationsBuyerReceivedRFQItemsByID(Request $request, $EOrderItems)
    {
        $collection = EOrderItems::where('e_order_id', $EOrderItems)->orderBy('created_at', 'desc')->get();
        return view('buyer.byerItemsShow', compact('collection', 'EOrderItems'));
    }

    public function QoutationsBuyerReceivedQoutes(Request $request, $EOrderID, $EOrderItemID, $bypass_id)
    {
        $collection = EOrderItems::where('id', $EOrderItemID)->orderBy('created_at', 'desc')->first();
        if($bypass_id == 1)
        {
            $collection->update([
                'bypass' => 1
            ]);
        }
        return view('buyer.qoutes', compact('collection', 'EOrderID', 'EOrderItemID', 'bypass_id'));
    }

    public function QoutationsBuyerReceivedRejected(Request $request, $EOrderID, $EOrderItemID,$bypass_id)
    {
        $collection = EOrderItems::where('id', $EOrderItemID)->orderBy('created_at', 'desc')->first();
        return view('buyer.qoutedRejected', compact('collection', 'EOrderID', 'EOrderItemID', 'bypass_id'));
    }

    public function QoutationsBuyerReceivedModificationNeeded(Request $request, $EOrderID, $EOrderItemID,$bypass_id)
    {
        $collection = EOrderItems::where('id', $EOrderItemID)->orderBy('created_at', 'desc')->first();
        return view('buyer.qoutationsBuyerReceivedModificationNeeded', compact('collection', 'EOrderID', 'EOrderItemID', 'bypass_id'));
    }

    public function QoutationsBuyerReceivedAccepted(Request $request, $EOrderID, $EOrderItemID,$bypass_id)
    {
        $collection = EOrderItems::where('id', $EOrderItemID)->orderBy('created_at', 'desc')->first();
        return view('buyer.QoutationsBuyerReceivedAccepted', compact('collection', 'EOrderID', 'EOrderItemID', 'bypass_id'));
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

        $buyer_id = 0;
        // inform supplier user
        $supplier_user = User::find($qoute->supplier_user_id)->notify(new \App\Notifications\QuoteAgain($qoute));
        session()->flash('message', 'Qoute status changes to ' . $qoute_status);
        return redirect()->route('QoutationsBuyerReceivedModificationNeeded', [$qoute->e_order_id, $qoute->e_order_items_id, $buyer_id]);
    }

    public function updateRejected(Request $request, Qoute $qoute)
    {
        $qoute_status = 'Rejected';
        $qoute->update([
//            'qoute_status' => $qoute_status,
            'qoute_updated_user_id' => auth()->user()->id,
            'qoute_status_updated' => $qoute_status,
            'status' => 'expired',
        ]);

        $quote = $qoute;
        $user = User::find(auth()->user()->id)->notify(new \App\Notifications\QuoteRejected($quote));
        session()->flash('message', 'Qoute status changes to ' . $qoute_status);
        return redirect()->route('QoutationsBuyerReceived');
    }

    public function qouteAccepted(Request $request, Qoute $qoute)
    {

        $request->merge(['po_date' => date('Y-m-d')]);
        $request->merge(['po_status' => 'pending']);
        $request->merge(['status' => 'pending']);
        $dpo = null;

        try {
            DB::beginTransaction();
            $dpoCheck = DraftPurchaseOrder::where('qoute_no',$request->qoute_no)->first();
            if (isset($dpoCheck))
            {
                $qoute_status = 'accepted';
                $qoute->update([
                    'qoute_status' => $qoute_status,
                    'qoute_status_updated' => $qoute_status,
                    'status' => 'completed',
                ]);
                $dpoCheck->update([
                    'po_status' => $qoute_status,
                    'status' => $qoute_status,
                ]);
                $dpo = $dpoCheck;
            }
            else
            {
                $dpo = DraftPurchaseOrder::create($request->all());
                $qoute_status = 'accepted';
                $qoute->update([
                    'qoute_status' => $qoute_status,
                    'qoute_updated_user_id' => auth()->user()->id,
                    'qoute_status_updated' => $qoute_status,
                    'status' => 'completed',
                    'dpo' => $dpo->id,
                ]);
            }
            // $user = User::find(auth()->user()->id)->notify(new \App\Notifications\QuoteAccepted($qoute));
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
