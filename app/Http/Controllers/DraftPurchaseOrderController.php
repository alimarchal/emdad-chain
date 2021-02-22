<?php

namespace App\Http\Controllers;

use App\Models\DeliveryNote;
use App\Models\DraftPurchaseOrder;
//use Barryvdh\DomPDF\PDF as PDF;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class DraftPurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->id;
        if(auth()->user()->registration_type == 'Supplier')
        {
            $dpos = DraftPurchaseOrder::where('supplier_user_id', $user)->where('supplier_business_id', auth()->user()->business_id)->where('status','approved')->get();
        }
        elseif(auth()->user()->registration_type == 'Buyer')
        {
            $dpos = DraftPurchaseOrder::where('user_id', $user)->where('business_id', auth()->user()->business_id)->where('status', 'pending')->get();
        }
        return view('draftPurchaseOrder.index', compact('dpos'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DraftPurchaseOrder  $draftPurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(DraftPurchaseOrder $draftPurchaseOrder)
    {

        return view('draftPurchaseOrder.show', compact('draftPurchaseOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DraftPurchaseOrder  $draftPurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(DraftPurchaseOrder $draftPurchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DraftPurchaseOrder  $draftPurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DraftPurchaseOrder $draftPurchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DraftPurchaseOrder  $draftPurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(DraftPurchaseOrder $draftPurchaseOrder)
    {
        //
    }

    public function approved(DraftPurchaseOrder $draftPurchaseOrder)
    {
        $user_type = auth()->user()->registration_type;
        $user_type_id = auth()->user()->id;
        $user_business_type = auth()->user()->business->business_type;
        $user_business_type_id = auth()->user()->business->id;
        $status = "approved";
        $draftPurchaseOrder->update([
            'status' => $status,
            'po_status' => $status,
            'approval_details' => 'User_TYPE_' . $user_type . '_' . $user_type_id . '_Business_TYPE_' . $user_business_type . '_' . $user_business_type_id . '_' . date('Y-m-d h:m'),
        ]);
        session()->flash('message', 'Business information successfully updated.');
        return redirect()->route('dpo.show', $draftPurchaseOrder->id);
    }

    public function rejected(DraftPurchaseOrder $draftPurchaseOrder)
    {
        $user_type = auth()->user()->registration_type;
        $user_type_id = auth()->user()->id;
        $user_business_type = auth()->user()->business->business_type;
        $user_business_type_id = auth()->user()->business->id;
        $status = "rejectToEdit";
        $draftPurchaseOrder->update([
            'status' => $status,
            'po_status' => $status,
            'approval_details' => 'User_TYPE_' . $user_type . '_' . $user_type_id . '_Business_TYPE_' . $user_business_type . '_' . $user_business_type_id . '_' . date('Y-m-d h:m'),
        ]);
        session()->flash('message', 'Business information successfully updated.');
        return redirect()->route('dpo.show', $draftPurchaseOrder->id);
    }

    public function cancel(DraftPurchaseOrder $draftPurchaseOrder)
    {
        $user_type = auth()->user()->registration_type;
        $user_type_id = auth()->user()->id;
        $user_business_type = auth()->user()->business->business_type;
        $user_business_type_id = auth()->user()->business->id;
        $status = "cancel";
        $draftPurchaseOrder->update([
            'status' => $status,
            'po_status' => $status,
            'approval_details' => 'User_TYPE_' . $user_type . '_' . $user_type_id . '_Business_TYPE_' . $user_business_type . '_' . $user_business_type_id . '_' . date('Y-m-d h:m'),
        ]);
        session()->flash('message', 'Business information successfully updated.');
        return redirect()->route('dpo.show', $draftPurchaseOrder->id);
    }


    /**
     * Generating PDF file for POs.
     *
     */
    public function generatePDF(DraftPurchaseOrder $draftPurchaseOrder)
    {
        $pdf = PDF::loadView('draftPurchaseOrder.PDF', compact('draftPurchaseOrder'))->setOptions(['defaultFont' => 'sans-serif']);
        //        $pdf = PDF::loadView('draftPurchaseOrder.PDF', $data);
        return $pdf->download('POs.pdf');
    }


    public function po()
    {
        $business_type = auth()->user()->business->business_type;
        if ($business_type == "Buyer") {
            $dpos = DraftPurchaseOrder::where('user_id', auth()->user()->id)->where('business_id', auth()->user()->business_id)->where('status', 'approved')->orWhere('status', 'prepareDelivery')->orWhere('status', 'completed')->get(); //->where('status','approved')
        } else {
            $dpos = DraftPurchaseOrder::where('supplier_business_id', auth()->user()->business_id)->where('status', 'approved')->orWhere('status', 'prepareDelivery')->orWhere('status', 'completed')->get(); //
        }

        return view('draftPurchaseOrder.po', compact('dpos'));
    }

    public function poShow(DraftPurchaseOrder $draftPurchaseOrder)
    {
        return view('draftPurchaseOrder.poShow', compact('draftPurchaseOrder'));
    }
}
