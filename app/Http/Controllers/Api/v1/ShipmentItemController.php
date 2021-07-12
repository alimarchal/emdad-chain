<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Shipment;
use App\Models\ShipmentItem;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipmentItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shipment_item = new ShipmentItem();
        if ($request->has('driver_id') || $request->has('status') || $request->has('supplier_business_id')) {
            if ($request->input('driver_id')) {
                $shipment_item = $shipment_item->where('driver_id', $request->driver_id);
            }

            if ($request->input('supplier_business_id')) {
                $shipment_item = $shipment_item->where('supplier_business_id', $request->supplier_business_id);
            }

            if ($request->input('status')) {
                $shipment_item = $shipment_item->where('status', $request->status);
            }
            $shipment_item = $shipment_item->get();
            if ($shipment_item->isEmpty()) {
                return response()->json(['message' => 'Not Found!'], 404);
            } else {
                return $shipment_item;
            }
        } else {
            $shipment_item = $shipment_item->paginate(20);
            return $shipment_item;
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

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {

        $token = $request->code;
        if ($token == "RRNirxFh4j9Ftd") {

            if ($request->has('driver_id')) {

                $ShipmentItem = [];
                $item = ShipmentItem::where('driver_id', $request->driver_id)->get();
                foreach ($item as $col) {
                    $itm = collect($col);
                    $ShipmentItem[]['ShipmentItem'] = $itm->merge(['Delivery' => [Delivery::find($col->delivery_id)]]);
                }
                return response()->json($ShipmentItem, 200);
//                $item = DB::table('shipment_items')
//                    ->Join('deliveries', 'deliveries.id', '=', 'shipment_items.delivery_id')
//                    ->where('shipment_items.driver_id', $request->driver_id)
//                    ->select('shipment_items.id as si_id', 'shipment_items.shipment_id  as si_shipment_id', 'shipment_items.driver_id  as si_driver_id', 'shipment_items.vehicle_type  as si_vehicle_type',
//                        'shipment_items.supplier_business_id  as si_supplier_business_id', 'shipment_items.delivery_id  as si_delivery_id', 'shipment_items.status  as si_status',
//                        'deliveries.id as del_id', 'deliveries.draft_purchase_order_id as del_draft_purchase_order_id', 'deliveries.delivery_note_id as del_delivery_note_id', 'deliveries.user_id as del_user_id', 'deliveries.invoice_id as del_invoice_id',
//                        'deliveries.business_id as del_business_id', 'deliveries.item_code as del_item_code', 'deliveries.item_name as del_item_name', 'deliveries.packing as del_packing', 'deliveries.brand as del_brand',
//                        'deliveries.quantity as del_quantity', 'deliveries.unit_price as del_unit_price', 'deliveries.rfq_no as del_rfq_no', 'deliveries.rfq_item_no as del_rfq_item_no', 'deliveries.qoute_no as del_qoute_no',
//                        'deliveries.payment_term as del_payment_term', 'deliveries.supplier_user_id as del_supplier_user_id', 'deliveries.supplier_business_id as del_supplier_business_id', 'deliveries.shipment_cost as del_shipment_cost',
//                        'deliveries.total_cost as del_total_cost', 'deliveries.vat as del_vat', 'deliveries.otp as del_otp', 'deliveries.otp_mobile_number as del_otp_mobile_number', 'deliveries.warehouse_coordinates as del_warehouse_coordinates',
//                        'deliveries.destination_coordinates as del_destination_coordinates', 'deliveries.waiting_time as del_waiting_time', 'deliveries.delivery_return as del_delivery_return', 'deliveries.shipment_status as del_shipment_status',
//                        'deliveries.delivery_address as del_delivery_address', 'deliveries.status as del_status', 'deliveries.driver_opt as del_driver_opt', 'deliveries.review_status as del_review_status',
//                        'deliveries.driver_rating as del_driver_rating', 'deliveries.buyer_rating as del_buyer_rating', 'deliveries.supplier_rating as del_supplier_rating', 'deliveries.emdad_rating as del_emdad_rating')
//                    ->get();
//                return response()->json($item, 200);
            }


            if ($request->has('supplier_business_id')) {

                $ShipmentItem = [];
                $item = ShipmentItem::where('supplier_business_id', $request->supplier_business_id)->get();
                foreach ($item as $col) {
                    $itm = collect($col);
                    $ShipmentItem[]['ShipmentItem'] = $itm->merge([
                        'Delivery' => [Delivery::find($col->delivery_id)],
                        'User' => [User::find($col->driver_id)],
                        'Vehicle' => [Vehicle::find($col->vehicle_id)],
                    ]);
                }

                return response()->json($ShipmentItem, 200);

//                $item = DB::table('shipment_items')
//                    ->Join('deliveries', 'deliveries.id', '=', 'shipment_items.delivery_id')
//                    ->Join('users', 'shipment_items.driver_id', '=', 'users.id')
//                    ->Join('vehicles', 'shipment_items.vehicle_type', '=', 'vehicles.id')
//                    ->where('shipment_items.supplier_business_id', $request->supplier_business_id)
//                    ->select('shipment_items.id as si_id', 'shipment_items.shipment_id  as si_shipment_id', 'shipment_items.driver_id  as si_driver_id', 'shipment_items.vehicle_type  as si_vehicle_type',
//                        'shipment_items.supplier_business_id  as si_supplier_business_id', 'shipment_items.delivery_id  as si_delivery_id', 'shipment_items.status  as si_status',
//                        'deliveries.id as del_id', 'deliveries.draft_purchase_order_id as del_draft_purchase_order_id', 'deliveries.delivery_note_id as del_delivery_note_id', 'deliveries.user_id as del_user_id', 'deliveries.invoice_id as del_invoice_id',
//                        'deliveries.business_id as del_business_id', 'deliveries.item_code as del_item_code', 'deliveries.item_name as del_item_name', 'deliveries.packing as del_packing', 'deliveries.brand as del_brand',
//                        'deliveries.quantity as del_quantity', 'deliveries.unit_price as del_unit_price', 'deliveries.rfq_no as del_rfq_no', 'deliveries.rfq_item_no as del_rfq_item_no', 'deliveries.qoute_no as del_qoute_no',
//                        'deliveries.payment_term as del_payment_term', 'deliveries.supplier_user_id as del_supplier_user_id', 'deliveries.supplier_business_id as del_supplier_business_id', 'deliveries.shipment_cost as del_shipment_cost',
//                        'deliveries.total_cost as del_total_cost', 'deliveries.vat as del_vat', 'deliveries.otp as del_otp', 'deliveries.otp_mobile_number as del_otp_mobile_number', 'deliveries.warehouse_coordinates as del_warehouse_coordinates',
//                        'deliveries.destination_coordinates as del_destination_coordinates', 'deliveries.waiting_time as del_waiting_time', 'deliveries.delivery_return as del_delivery_return', 'deliveries.shipment_status as del_shipment_status',
//                        'deliveries.delivery_address as del_delivery_address', 'deliveries.status as del_status', 'deliveries.driver_opt as del_driver_opt', 'deliveries.review_status as del_review_status',
//                        'deliveries.driver_rating as del_driver_rating', 'deliveries.buyer_rating as del_buyer_rating', 'deliveries.supplier_rating as del_supplier_rating', 'deliveries.emdad_rating as del_emdad_rating',
//                        'users.id as u_id', 'users.business_id as u_business_id', 'users.middle_initial as u_middle_initial', 'users.family_name as u_family_name', 'users.gender as u_gender', 'users.designation as u_designation', 'users.name as u_name', 'users.email as u_email', 'users.email_verified_at as u_email_verified_at', 'users.nid_num as u_nid_num', 'users.nid_exp_date as u_nid_exp_date', 'users.profile_photo_path as u_profile_photo_path', 'users.registration_type as u_registration_type', 'users.profile_approved as u_profile_approved', 'users.profile_approval_id as u_profile_approval_id', 'users.mobile as u_mobile', 'users.mobile_verify_token as u_mobile_verify_token', 'users.status as u_status', 'users.is_active as u_is_active', 'users.rtl as u_rtl', 'users.usertype as u_usertype', 'users.driver_status as u_driver_status', 'users.added_by_userId as u_added_by_userId', 'users.nid_photo as u_nid_photo',
//                        'vehicles.id as veh_id', 'vehicles.supplier_business_id as veh_supplier_business_id', 'vehicles.warehouse_id as veh_warehouse_id', 'vehicles.type as veh_type', 'vehicles.licence_plate_No as veh_licence_plate_No', 'vehicles.availability_status as veh_availability_status', 'vehicles.status as veh_status',
//                    )
//                    ->get();
//                return response()->json($item, 200);
            }

            $shipment_item = ShipmentItem::find($id);
            if (empty($shipment_item)) {
                return response()->json(['message' => 'Not Found!'], 404);
            } else {
                return $shipment_item;
            }
        } else {
            return response()->json(['message' => 'UnAuthorized Access!'], 404);
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
            $shipment_item = ShipmentItem::find($id);
            if (!empty($shipment_item)) {
                $updated = $shipment_item->update($request->all());
                return $shipment_item;
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
