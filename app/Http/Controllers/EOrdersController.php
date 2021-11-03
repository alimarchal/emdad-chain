<?php

namespace App\Http\Controllers;

use App\Models\BusinessPackage;
use App\Models\Category;
use App\Models\ECart;
use App\Models\EOrderItems;
use App\Models\EOrders;
use App\Models\Item;
use App\Models\SmsMessages;
use App\Models\User;
use App\Notifications\RFQBusinessEmail;
use App\Notifications\RFQCreatedByUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class EOrdersController extends Controller
{
    public function store(Request $request)
    {

        $rfq = EOrders::where('business_id', auth()->user()->business_id)->whereDate('created_at', Carbon::today())->count();
        $business_package = BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();
        if ($business_package->package_id == 1) {
            if ($rfq == 3) {
                session()->flash('error', __('portal.You have reached daily rfq limit'));
                return redirect()->back();
            } else {
                DB::transaction(function () use ($request) {
                    $request->merge(['status' => 'Open']);
                    $request->merge(['rfq_type' => 1]);
                    $eOrders = EOrders::create($request->all());
                    $eCartItems = ECart::findMany($request->item_number);
                    foreach ($eCartItems as $item) {
                        $eOrderItem = new EOrderItems;
                        $eOrderItem->e_order_id = $eOrders->id;
                        $eOrderItem->business_id = $item->business_id;
                        $eOrderItem->user_id = $item->user_id;
                        $eOrderItem->warehouse_id = $item->warehouse_id;
                        $eOrderItem->company_name_check = $item->company_name_check;
                        $eOrderItem->item_code = $item->item_code;
                        $eOrderItem->item_name = $item->item_name;
                        $eOrderItem->description = $item->description;
                        $eOrderItem->unit_of_measurement = $item->unit_of_measurement;
                        $eOrderItem->size = $item->size;
                        $eOrderItem->quantity = $item->quantity;
                        $eOrderItem->brand = $item->brand;
                        $eOrderItem->last_price = $item->last_price;
                        $eOrderItem->remarks = $item->remarks;
                        $eOrderItem->delivery_period = $item->delivery_period;
                        $eOrderItem->file_path = $item->file_path;
                        $eOrderItem->payment_mode = $item->payment_mode;
                        $eOrderItem->required_sample = $item->required_sample;
                        $eOrderItem->status = $item->status;
                        $eOrderItem->quotation_time = Carbon::now()->addDays(3);
                        $eOrderItem->rfq_type = $item->rfq_type;
                        $eOrderItem->save();

                        $categoryName = Category::where('id', $eOrderItem->item_code)->first();
                        $parentName = Category::where('id', $categoryName->parent_id)->pluck('name')->first();

                        /* Sending message to business email ID */
                        User::send_sms('+966581382822', 'RFQ generated.'. ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , '  . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
                        User::send_sms('+966593388833', 'RFQ generated.'. ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , '  . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
                    }
                    foreach ($eCartItems as $item) {
                        $item->delete();
                    }

                    $user = User::find(auth()->user()->id);
                    /* Notifying business@emdad-chain.com for RFQ created by user */
                    Notification::route('mail', 'business@emdad-chain.com')
                        ->notify(new RFQCreatedByUser($user, $eOrders));
                });

                $user = User::find(auth()->user()->id);
//                $message = "New RFQ has been created by " . $user->name . "User ID: " . $user->id;
//                User::send_sms('+966552840506',$message);
//                User::send_sms('+966593388833',$message);
                $user->notify(new \App\Notifications\RfqCreated());

                /* Notifying business@emdad-chain.com for RFQ created by user */
                /*Notification::route('mail', 'business@emdad-chain.com')
                            ->notify(new RFQCreatedByUser($user, $eOrders));*/

                session()->flash('message', __('portal.RFQ placed successfully'));
                return redirect()->route('QoutationsBuyerReceived');
            }
        } elseif ($business_package->package_id == 2) {
            if ($rfq == 10) {
                session()->flash('error', __('portal.You have reached daily rfq limit'));
                return redirect()->back();
            } else {
                DB::transaction(function () use ($request) {
                    $request->merge(['status' => 'Open']);
                    $request->merge(['rfq_type' => 1]);
                    $eOrders = EOrders::create($request->all());
                    $eCartItems = ECart::findMany($request->item_number);
                    foreach ($eCartItems as $item) {
                        $eOrderItem = new EOrderItems;
                        $eOrderItem->e_order_id = $eOrders->id;
                        $eOrderItem->business_id = $item->business_id;
                        $eOrderItem->user_id = $item->user_id;
                        $eOrderItem->warehouse_id = $item->warehouse_id;
                        $eOrderItem->company_name_check = $item->company_name_check;
                        $eOrderItem->item_code = $item->item_code;
                        $eOrderItem->item_name = $item->item_name;
                        $eOrderItem->description = $item->description;
                        $eOrderItem->unit_of_measurement = $item->unit_of_measurement;
                        $eOrderItem->size = $item->size;
                        $eOrderItem->quantity = $item->quantity;
                        $eOrderItem->brand = $item->brand;
                        $eOrderItem->last_price = $item->last_price;
                        $eOrderItem->remarks = $item->remarks;
                        $eOrderItem->delivery_period = $item->delivery_period;
                        $eOrderItem->file_path = $item->file_path;
                        $eOrderItem->payment_mode = $item->payment_mode;
                        $eOrderItem->required_sample = $item->required_sample;
                        $eOrderItem->status = $item->status;
                        $eOrderItem->quotation_time = Carbon::now()->addDays(3);
                        $eOrderItem->rfq_type = $item->rfq_type;
                        $eOrderItem->save();

                        $categoryName = Category::where('id', $eOrderItem->item_code)->first();
                        $parentName = Category::where('id', $categoryName->parent_id)->pluck('name')->first();

                        /* Sending message to business email ID */
                        User::send_sms('+966581382822', 'RFQ generated.'. ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , '  . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
                        User::send_sms('+966593388833', 'RFQ generated.'. ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , '  . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
                    }
                    foreach ($eCartItems as $item) {
                        $item->delete();
                    }

                    $user = User::find(auth()->user()->id);
                    /* Notifying business@emdad-chain.com for RFQ created by user */
                    Notification::route('mail', 'business@emdad-chain.com')
                        ->notify(new RFQCreatedByUser($user, $eOrders));
                });

                $user = User::find(auth()->user()->id);
                $user->notify(new \App\Notifications\RfqCreated());

                /* Notifying business@emdad-chain.com for RFQ created by user */
                /*Notification::route('mail', 'business@emdad-chain.com')
                            ->notify(new RFQCreatedByUser($user));*/

                session()->flash('message', __('portal.RFQ placed successfully'));
                return redirect()->route('QoutationsBuyerReceived');
            }
        } elseif ($business_package->package_id == 3 || $business_package->package_id == 4) {
            DB::transaction(function () use ($request) {
                $request->merge(['status' => 'Open']);
                $request->merge(['rfq_type' => 1]);
                $eOrders = EOrders::create($request->all());
                $eCartItems = ECart::findMany($request->item_number);
                foreach ($eCartItems as $item) {
                    $eOrderItem = new EOrderItems;
                    $eOrderItem->e_order_id = $eOrders->id;
                    $eOrderItem->business_id = $item->business_id;
                    $eOrderItem->user_id = $item->user_id;
                    $eOrderItem->warehouse_id = $item->warehouse_id;
                    $eOrderItem->company_name_check = $item->company_name_check;
                    $eOrderItem->item_code = $item->item_code;
                    $eOrderItem->item_name = $item->item_name;
                    $eOrderItem->description = $item->description;
                    $eOrderItem->unit_of_measurement = $item->unit_of_measurement;
                    $eOrderItem->size = $item->size;
                    $eOrderItem->quantity = $item->quantity;
                    $eOrderItem->brand = $item->brand;
                    $eOrderItem->last_price = $item->last_price;
                    $eOrderItem->remarks = $item->remarks;
                    $eOrderItem->delivery_period = $item->delivery_period;
                    $eOrderItem->file_path = $item->file_path;
                    $eOrderItem->payment_mode = $item->payment_mode;
                    $eOrderItem->required_sample = $item->required_sample;
                    $eOrderItem->status = $item->status;
                    $eOrderItem->quotation_time = Carbon::now()->addDays(3);
                    $eOrderItem->rfq_type = $item->rfq_type;
                    $eOrderItem->save();

                    $categoryName = Category::where('id', $eOrderItem->item_code)->first();
                    $parentName = Category::where('id', $categoryName->parent_id)->pluck('name')->first();

                    /* Sending message to business email ID */
                    User::send_sms('+966581382822', 'RFQ generated.'. ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , '  . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
                    User::send_sms('+966593388833', 'RFQ generated.'. ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , '  . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
                }
                foreach ($eCartItems as $item) {
                    $item->delete();
                }

                $user = User::find(auth()->user()->id);
                /* Notifying business@emdad-chain.com for RFQ created by user */
                Notification::route('mail', 'business@emdad-chain.com')
                    ->notify(new RFQCreatedByUser($user, $eOrders));
            });

            $user = User::find(auth()->user()->id);
            $user->notify(new \App\Notifications\RfqCreated());

            /* Notifying business@emdad-chain.com for RFQ created by user */
            /*Notification::route('mail', 'business@emdad-chain.com')
                            ->notify(new RFQCreatedByUser($user, $eOrdersArray));*/


            session()->flash('message', __('portal.RFQ placed successfully'));
            return redirect()->route('QoutationsBuyerReceived');
        }

    }

    // For single category RFQ

    public function single_category_store(Request $request)
    {
        $rfq = EOrders::where('business_id', auth()->user()->business_id)->whereDate('created_at', Carbon::today())->count();

        $business_package = BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();

        if ($business_package->package_id == 1) {

            if ($rfq == 3) {
                session()->flash('error', __('portal.You have reached daily rfq limit'));
                return redirect()->back();
            } else {

                DB::transaction(function () use ($request) {
                    $request->merge(['status' => 'Open']);
                    $request->merge(['rfq_type' => 0]);
                    $eOrders = EOrders::create($request->all());

                    $eCartItems = ECart::findMany($request->item_number);
//                    dd(request()->all());
                    foreach ($eCartItems as $item) {
                        $eOrderItem = new EOrderItems;
                        $eOrderItem->e_order_id = $eOrders->id;
                        $eOrderItem->business_id = $item->business_id;
                        $eOrderItem->user_id = $item->user_id;
                        $eOrderItem->warehouse_id = $item->warehouse_id;
                        $eOrderItem->company_name_check = $item->company_name_check;
                        $eOrderItem->item_code = $item->item_code;
                        $eOrderItem->item_name = $item->item_name;
                        $eOrderItem->description = $item->description;
                        $eOrderItem->unit_of_measurement = $item->unit_of_measurement;
                        $eOrderItem->size = $item->size;
                        $eOrderItem->quantity = $item->quantity;
                        $eOrderItem->brand = $item->brand;
                        $eOrderItem->last_price = $item->last_price;
                        $eOrderItem->remarks = $item->remarks;
                        $eOrderItem->delivery_period = $item->delivery_period;
                        $eOrderItem->file_path = $item->file_path;
                        $eOrderItem->payment_mode = $item->payment_mode;
                        $eOrderItem->required_sample = $item->required_sample;
                        $eOrderItem->status = $item->status;
                        $eOrderItem->quotation_time = Carbon::now()->addDays(3);
                        $eOrderItem->rfq_type = $item->rfq_type;
                        $eOrderItem->save();

                        $categoryName = Category::where('id', $eOrderItem->item_code)->first();
                        $parentName = Category::where('id', $categoryName->parent_id)->pluck('name')->first();

                        /* Sending message to business email ID */
                        User::send_sms('+966581382822', 'RFQ generated.'. ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , '  . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
                        User::send_sms('+966593388833', 'RFQ generated.'. ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , '  . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
                    }
                    foreach ($eCartItems as $item) {
                        $item->delete();
                    }

                    $user = User::find(auth()->user()->id);
                    Notification::route('mail', 'business@emdad-chain.com')
                        ->notify(new RFQCreatedByUser($user, $eOrders));
                });

                $user = User::find(auth()->user()->id);
                $user->notify(new \App\Notifications\RfqCreated());

                /* Notifying business@emdad-chain.com for RFQ created by user */
                /*Notification::route('mail', 'business@emdad-chain.com')
                            ->notify(new RFQCreatedByUser($user));*/

                session()->flash('message', __('portal.RFQ placed successfully'));
//                return redirect()->route('singleCategoryBuyerRFQs');
                return redirect()->route('QoutationsBuyerReceived');
            }
        } elseif ($business_package->package_id == 2) {
            if ($rfq == 10) {
                session()->flash('error', __('portal.You have reached daily rfq limit'));
                return redirect()->back();
            } else {
                DB::transaction(function () use ($request) {
                    $request->merge(['status' => 'Open']);
                    $request->merge(['rfq_type' => 0]);
                    $eOrders = EOrders::create($request->all());
                    $eCartItems = ECart::findMany($request->item_number);
                    foreach ($eCartItems as $item) {
                        $eOrderItem = new EOrderItems;
                        $eOrderItem->e_order_id = $eOrders->id;
                        $eOrderItem->business_id = $item->business_id;
                        $eOrderItem->user_id = $item->user_id;
                        $eOrderItem->warehouse_id = $item->warehouse_id;
                        $eOrderItem->company_name_check = $item->company_name_check;
                        $eOrderItem->item_code = $item->item_code;
                        $eOrderItem->item_name = $item->item_name;
                        $eOrderItem->description = $item->description;
                        $eOrderItem->unit_of_measurement = $item->unit_of_measurement;
                        $eOrderItem->size = $item->size;
                        $eOrderItem->quantity = $item->quantity;
                        $eOrderItem->brand = $item->brand;
                        $eOrderItem->last_price = $item->last_price;
                        $eOrderItem->remarks = $item->remarks;
                        $eOrderItem->delivery_period = $item->delivery_period;
                        $eOrderItem->file_path = $item->file_path;
                        $eOrderItem->payment_mode = $item->payment_mode;
                        $eOrderItem->required_sample = $item->required_sample;
                        $eOrderItem->status = $item->status;
                        $eOrderItem->quotation_time = Carbon::now()->addDays(3);
                        $eOrderItem->rfq_type = $item->rfq_type;
                        $eOrderItem->save();

                        $categoryName = Category::where('id', $eOrderItem->item_code)->first();
                        $parentName = Category::where('id', $categoryName->parent_id)->pluck('name')->first();

                        /* Sending message to business email ID */
                        User::send_sms('+966581382822', 'RFQ generated.'. ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , '  . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
                        User::send_sms('+966593388833', 'RFQ generated.'. ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , '  . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);

                    }
                    foreach ($eCartItems as $item) {
                        $item->delete();
                    }

                    $user = User::find(auth()->user()->id);
                    Notification::route('mail', 'business@emdad-chain.com')
                        ->notify(new RFQCreatedByUser($user, $eOrders));
                });

                $user = User::find(auth()->user()->id);
                $user->notify(new \App\Notifications\RfqCreated());

                /* Notifying business@emdad-chain.com for RFQ created by user */
                /*Notification::route('mail', 'business@emdad-chain.com')
                            ->notify(new RFQCreatedByUser($user));*/

                session()->flash('message', __('portal.RFQ placed successfully'));
                return redirect()->route('QoutationsBuyerReceived');
            }
        } elseif ($business_package->package_id == 3 || $business_package->package_id == 4) {
            DB::transaction(function () use ($request) {
                $request->merge(['status' => 'Open']);
                $request->merge(['rfq_type' => 0]);
                $eOrders = EOrders::create($request->all());
                $eCartItems = ECart::findMany($request->item_number);
                foreach ($eCartItems as $item) {
                    $eOrderItem = new EOrderItems;
                    $eOrderItem->e_order_id = $eOrders->id;
                    $eOrderItem->business_id = $item->business_id;
                    $eOrderItem->user_id = $item->user_id;
                    $eOrderItem->warehouse_id = $item->warehouse_id;
                    $eOrderItem->company_name_check = $item->company_name_check;
                    $eOrderItem->item_code = $item->item_code;
                    $eOrderItem->item_name = $item->item_name;
                    $eOrderItem->description = $item->description;
                    $eOrderItem->unit_of_measurement = $item->unit_of_measurement;
                    $eOrderItem->size = $item->size;
                    $eOrderItem->quantity = $item->quantity;
                    $eOrderItem->brand = $item->brand;
                    $eOrderItem->last_price = $item->last_price;
                    $eOrderItem->remarks = $item->remarks;
                    $eOrderItem->delivery_period = $item->delivery_period;
                    $eOrderItem->file_path = $item->file_path;
                    $eOrderItem->payment_mode = $item->payment_mode;
                    $eOrderItem->required_sample = $item->required_sample;
                    $eOrderItem->status = $item->status;
                    $eOrderItem->quotation_time = Carbon::now()->addDays(3);
                    $eOrderItem->rfq_type = $item->rfq_type;
                    $eOrderItem->save();

                    $categoryName = Category::where('id', $eOrderItem->item_code)->first();
                    $parentName = Category::where('id', $categoryName->parent_id)->pluck('name')->first();

                    /* Sending message to business email ID */
                    User::send_sms('+966581382822', 'RFQ generated.'. ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , '  . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
                    User::send_sms('+966593388833', 'RFQ generated.'. ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , '  . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
                }
                foreach ($eCartItems as $item) {
                    $item->delete();
                }

                $user = User::find(auth()->user()->id);
                Notification::route('mail', 'business@emdad-chain.com')
                    ->notify(new RFQCreatedByUser($user, $eOrders));
            });

            $user = User::find(auth()->user()->id);
            $user->notify(new \App\Notifications\RfqCreated());

            /* Notifying business@emdad-chain.com for RFQ created by user */
            /*Notification::route('mail', 'business@emdad-chain.com')
                        ->notify(new RFQCreatedByUser($user));*/

            session()->flash('message', __('portal.RFQ placed successfully'));
            return redirect()->route('QoutationsBuyerReceived');
        }

    }
}
