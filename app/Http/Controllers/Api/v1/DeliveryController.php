<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Delivery;
use App\Models\DraftPurchaseOrder;
use App\Models\EOrderItems;
use App\Models\Shipment;
use App\Models\ShipmentItem;
use App\Models\User;
use App\Models\Vehicle;
use App\Notifications\DeliveryCompleted;
use App\Notifications\OTP;
use App\Notifications\SingleCategoryDeliveryCompleted;
use App\Notifications\UserRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\SmsMessages;



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
                $Deliveries = [];
                foreach ($collection as $col) {
                    $warehouse_id = DraftPurchaseOrder::find($col->draft_purchase_order_id)->warehouse_id;
                    $itm = collect($col);
                    $Deliveries[] = $itm->merge([
                        'SupplierBusiness' => Business::find($col->supplier_business_id),
                        'BuyerBusiness' => Business::find($col->business_id),
                        'buyer_business' => Business::find($col->business_id)->business_name,
                        'supplier_logo_url' => config('app.url') . '/storage/' . Business::find($col->supplier_business_id)->business_photo_url,
                        'BuyerRFQWarehouse' => [\App\Models\BusinessWarehouse::find($warehouse_id)],
                        'MultipleItems' => Delivery::where('rfq_no', $col->rfq_no)->where('rfq_type', 1)->get(),
                    ]);
                }
                return $Deliveries;
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

                // if send otp attr then generate code
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
                $warehouse_id = DraftPurchaseOrder::find($delivery->draft_purchase_order_id)->warehouse_id;

                if (!empty($business_url)) {
                    #convert to collection for appending the delivery eloquent collection
                    $delivery = collect(Delivery::find($id));
                    $business_warehouse = \App\Models\BusinessWarehouse::find($warehouse_id);
                    $custom = collect([
                        'supplier_logo_url' => config('app.url') . '/storage/' . $business_photo_url,
                        'business_name' => $business_url->business_name,
                        'buyerRFQWarehouse' => [$business_warehouse],
                        'buyerBusiness' => [Business::find($business_warehouse->business_id)],
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

    public function vehicle_user_shipment_update($vid, $uid, $sid, Request $request)
    {
        $token = $request->code;
        if ($token == "RRNirxFh4j9Ftd") {
            $vehicle = Vehicle::find($vid);
            $user = User::find($uid);
            $shipment = Shipment::find($sid);
            if ($user != null && $vehicle != null && $shipment != null) {
                $vehicle->availability_status = 1;
                $vehicle->save();
                $user->driver_status = 1;
                $user->save();
                $shipment->status = 1;
                $shipment->save();

                Notification::route('mail', 'business@emdad-chain.com')
                    ->notify(new DeliveryCompleted($user));
                return response()->json(['message' => 'Updated...'], 200);
            } else {
                return response()->json(['message' => 'Error some model not found please check your uid, sid, vid'], 404);
            }
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
    }


    public function delivery_shipment($rfq_type, $delivery_id, $rfq_no, $sitm, Request $request)
    {
        $token = $request->code;
        if ($token == "RRNirxFh4j9Ftd") {

            if ($rfq_type == 0)     /* 0 for single category */
            {
                $deliveries = Delivery::where('rfq_no', $rfq_no)->get();  /* Retrieve delivery details by rfq_no for single category instead of delivery ID */
                $shipment_item = ShipmentItem::find($sitm);

                if (isset($deliveries) && $shipment_item != null) {
                    foreach ($deliveries as $delivery)
                    {
                        $delivery->status = 1;
                        $delivery->save();
                    }
                    $shipment_item->status = 1;
                    $shipment_item->save();



//                if ($deliveries[0]->rfq_type == 1)
//                {
//                    Notification::route('mail', 'business@emdad-chain.com')
//                        ->notify(new DeliveryCompleted($deliveries, $deliveries[0]->id));
//                }

//                if ($deliveries[0]->rfq_type == 0)
//                {
//                    Notification::route('mail', 'business@emdad-chain.com')
//                        ->notify(new SingleCategoryDeliveryCompleted($deliveries, $deliveries[0]->id));
//                }

                    return response()->json(['message' => 'Updated...'], 200);
                }

            }

            elseif ($rfq_type == 1){     /* 1 for multi category*/

                $delivery = Delivery::where('id', $delivery_id)->first();       /* Retrieve delivery details by delivery_id for multiple category instead of delivery's rfq_no */
                $shipment_item = ShipmentItem::find($sitm);

                if (isset($delivery) && $shipment_item != null) {
                    $delivery->status = 1;
                    $delivery->save();
                    $shipment_item->status = 1;
                    $shipment_item->save();

                    return response()->json(['message' => 'Updated...'], 200);
                }
            }

            else {
                return response()->json(['message' => 'Error some model not found please check your rfq, sid'], 404);
            }
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
    }


    public function getDeliveries($rfq_no, $deliveryID, $rfq_type)
    {
        /* Previously delivery show page was one for both single and multiple categories (showOLD) but changed to two different views because of changes in showing the details  */
        if ($rfq_type == 0)
        {
            $deliveries = Delivery::with('eOrderItems', 'invoice', 'buyer', 'supplier')->where('rfq_no', $rfq_no)->get();
            return response()->json($deliveries, 200);
        }
        elseif($rfq_type == 1){
            $deliveries = Delivery::with('eOrderItems', 'invoice', 'buyer', 'supplier')->where('id', $deliveryID)->get();
            return response()->json($deliveries,200);
        }
        return response()->json(['message' => 'Not Found!'], 404);
    }


}
