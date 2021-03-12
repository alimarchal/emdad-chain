<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Livewire\BusinessWarehouse;
use App\Models\Business;
use App\Models\Delivery;
use App\Models\DraftPurchaseOrder;
use App\Models\EOrderItems;
use App\Notifications\OTP;
use App\Notifications\OtpSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Delivery::paginate(10);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $token = $request->code;
        if ($token == "RRNirxFh4j9Ftd") {
            $delivery = Delivery::find($id);
            if (!empty($delivery)) {
                if ($request->input('otp') == 'generate') {
                    $string = rand(1000, 9999);
                    $otp = $delivery->otp = $string;
                    $rfq_item_no = $delivery->rfq_item_no;

                    $wh_id = EOrderItems::where('id', $rfq_item_no)->first()->warehouse_id;
                    if (!empty($wh_id)) {
                        $wh_email = \App\Models\BusinessWarehouse::find($wh_id)->first()->warehouse_email;
                    }
                    if (!empty($wh_email)) {
                        Notification::route('mail', $wh_email)
                            ->notify(new OTP($otp));
                        $delivery->save();
                    }
                }
                $delivery = Delivery::find($id);
                return $delivery;
            } else {
                return response()->json(['message' => 'Not Found!'], 404);
            }
        }

        // $delivery = Delivery::find($id);
        // if (!empty($delivery)) {
        //     return $delivery;
        // } else {
        //     return response()->json(['message' => 'Not Found!'], 404);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $token = $request->code;
        if ($token == "RRNirxFh4j9Ftd") {
            $delivery = Delivery::find($id);
            if (!empty($delivery)) {
                $updated = $delivery->update($request->all());
                return $delivery;
            } else {
                return response()->json(['message' => 'Not Found!'], 404);
            }
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
