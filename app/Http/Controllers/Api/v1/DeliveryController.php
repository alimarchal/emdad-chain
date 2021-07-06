<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Livewire\BusinessWarehouse;
use App\Models\Business;
use App\Models\Delivery;
use App\Models\DraftPurchaseOrder;
use App\Models\EOrderItems;
use App\Models\User;
use App\Notifications\OTP;
use App\Notifications\OtpSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Moyasar\Providers\PaymentService;


class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $token = $request->code;
        if ($token == "RRNirxFh4j9Ftd") {
            if ($request->has('status')) {
                $collection = Delivery::where('status', $request->status)->get();
                if ($collection->isEmpty()) {
                    return response()->json(['message' => 'Not Found!'], 404);
                } else {
                    return $collection;
                }
            }
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
    }


    public function getAllDeliveries(Request $request, $id)
    {
        $token = $request->code;
        if ($token == "RRNirxFh4j9Ftd") {
            $collection = Delivery::where('user_id', $id)->get();
            if ($collection->isEmpty()) {
                return response()->json(['message' => 'Not Found!'], 404);
            } else {
                return $collection;
            }
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
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
                    $delivery->save();

                    $delivery = \App\Models\Delivery::where('id', $id)->first();
                    $eOrder = EOrderItems::where('id', $delivery->rfq_item_no)->first();
                    $wh_id = \App\Models\BusinessWarehouse::where('id', $eOrder->warehouse_id)->first();

                    if (!empty($wh_id)) {
                        $wh_email = $wh_id->warehouse_email;
                    }

                    if (!empty($wh_email)) {
                        Notification::route('mail', $wh_email)->notify(new OTP($otp));
                        $mobile_no = trim($delivery->otp_mobile_number);
                        $ch = User::send_otp($otp, $mobile_no);
                    }
                }

                $business_url = Business::where('id', $delivery->supplier_business_id)->first();
                $business_photo_url = $business_url->business_photo_url;

                if (!empty($business_url)) {
                    #convert to collection for appending the delivery eloquent collection
                    $delivery = collect(Delivery::find($id));
                    $custom = collect([
                        'supplier_logo_url' => config('app.url') . '/storage/' . $business_photo_url,
                        'business_name' => $business_url->business_name,

                    ]);
                    $delivery = $delivery->merge($custom);
                }
                return response()->json($delivery, 200);
            } else {
                return response()->json(['message' => 'Not Found!'], 404);
            }
        }
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
