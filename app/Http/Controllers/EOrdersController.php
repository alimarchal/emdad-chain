<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use App\Models\BusinessPackage;
use App\Models\Category;
use App\Models\ECart;
use App\Models\EOrderItems;
use App\Models\EOrders;
use App\Models\Item;
use App\Models\Qoute;
use App\Models\Quatation;
use App\Models\SmsMessages;
use App\Models\User;
use App\Notifications\RFQBusinessEmail;
use App\Notifications\RFQCreatedByUser;
use App\Notifications\User\QuotationCategory;
use App\Notifications\User\QuotationDiscard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use League\CommonMark\Extension\SmartPunct\Quote;

class EOrdersController extends Controller
{

    public function cancelRequisition(Request $request)
    {
        $EOrders = EOrders::where('id', $request->EOrderID)->first();

        DB::transaction(function () use ($request) {
            $EOrders = EOrders::where('id', $request->EOrderID)->first();
            //get list
            $get_quote_suppliers_list = Qoute::where('e_order_id', $EOrders->id)->get();
            // send notifications
            if ($get_quote_suppliers_list->isNotEmpty()) {
                foreach ($get_quote_suppliers_list as $item) {
                    $supplier_id = $item->supplier_user_id;
                    $supplierUser = User::find($supplier_id);
                    $supplierUser->notify(new QuotationDiscard());
                }

            }

            $EOrders->update(['discard' => 1, 'status' => 'Cancelled']);
            $eOrderItems = EOrderItems::where('e_order_id', $request->EOrderID)->get();
            foreach ($eOrderItems as $item) {
                $item->status = 'cancelled';
                $item->save();
            }
        });

        session()->flash('message', __('Requisition has been cancelled'));
        return redirect()->route('PlacedRFQ.index');
    }

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

                        // search for item code from business_categories table
                        $collection = BusinessCategory::where('category_number', $eOrderItem->item_code)->where('business_id', '!=', $item->business_id)->get();
                        foreach ($collection as $coll) {
                            if (!empty($coll->business)) {
                                {
                                    $get_user = User::where('id', $coll->business->user_id)->first();
                                    $get_user->notify(new QuotationCategory($eOrderItem->item_code, $eOrderItem->rfq_type));
                                }
                            }
                        }

                        $categoryName = Category::where('id', $eOrderItem->item_code)->first();
                        $parentName = Category::where('id', $categoryName->parent_id)->pluck('name')->first();


                        /* Sending message to business email ID */
                        $message = SmsMessages::find(7)->english_message;
                        $message = str_replace("{category_name}", $categoryName->name, $message);
                        $message = str_replace("{parent_name}", $parentName, $message);
                        $message = str_replace("{brand}", $eOrderItem->brand, $message);
                        $message = str_replace("{description}", $eOrderItem->description, $message);
                        $message = str_replace("{unit_of_measurement}", $eOrderItem->unit_of_measurement, $message);
                        $message = str_replace("{size}", $eOrderItem->size, $message);
                        $message = str_replace("{qty}", $eOrderItem->quantity, $message);
                        $message = str_replace("{last_price}", $eOrderItem->last_price, $message);
                        $message = str_replace("{delivery_period}", $eOrderItem->delivery_period, $message);
                        $message = str_replace("{payment_mode}", $eOrderItem->payment_mode, $message);
                        $message = str_replace("{remarks}", $eOrderItem->remarks, $message);
                        User::send_sms(env('SMS_NO_ONE'), $message);
                        User::send_sms(env('SMS_NO_TWO'), $message);
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

                        // search for item code from business_categories table
                        $collection = BusinessCategory::where('category_number', $eOrderItem->item_code)->where('business_id', '!=', $item->business_id)->get();
                        foreach ($collection as $coll) {
                            if (!empty($coll->business)) {
                                {
                                    $get_user = User::where('id', $coll->business->user_id)->first();
                                    $get_user->notify(new QuotationCategory($eOrderItem->item_code, $eOrderItem->rfq_type));
                                }
                            }
                        }

                        $categoryName = Category::where('id', $eOrderItem->item_code)->first();
                        $parentName = Category::where('id', $categoryName->parent_id)->pluck('name')->first();

                        /* Sending message to business email ID */
                        $message = SmsMessages::find(7)->english_message;
                        $message = str_replace("{category_name}", $categoryName->name, $message);
                        $message = str_replace("{parent_name}", $parentName, $message);
                        $message = str_replace("{brand}", $eOrderItem->brand, $message);
                        $message = str_replace("{description}", $eOrderItem->description, $message);
                        $message = str_replace("{unit_of_measurement}", $eOrderItem->unit_of_measurement, $message);
                        $message = str_replace("{size}", $eOrderItem->size, $message);
                        $message = str_replace("{qty}", $eOrderItem->quantity, $message);
                        $message = str_replace("{last_price}", $eOrderItem->last_price, $message);
                        $message = str_replace("{delivery_period}", $eOrderItem->delivery_period, $message);
                        $message = str_replace("{payment_mode}", $eOrderItem->payment_mode, $message);
                        $message = str_replace("{remarks}", $eOrderItem->remarks, $message);
                        User::send_sms(env('SMS_NO_ONE'), $message);
                        User::send_sms(env('SMS_NO_TWO'), $message);
                        //User::send_sms(env('SMS_NO_ONE'), 'RFQ generated.' . ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , ' . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
                        //User::send_sms(env('SMS_NO_TWO'), 'RFQ generated.' . ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , ' . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
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


                    // search for item code from business_categories table
                    $collection = BusinessCategory::where('category_number', $eOrderItem->item_code)->where('business_id', '!=', $item->business_id)->get();
                    foreach ($collection as $coll) {
                        if (!empty($coll->business)) {
                            {
                                $get_user = User::where('id', $coll->business->user_id)->first();
                                if (!empty($get_user)) {
                                    $get_user->notify(new QuotationCategory($eOrderItem->item_code, $eOrderItem->rfq_type));
                                }
                            }
                        }
                    }


                    $categoryName = Category::where('id', $eOrderItem->item_code)->first();
                    $parentName = Category::where('id', $categoryName->parent_id)->pluck('name')->first();

                    /* Sending message to business email ID */
                    $message = SmsMessages::find(7)->english_message;
                    $message = str_replace("{category_name}", $categoryName->name, $message);
                    $message = str_replace("{parent_name}", $parentName, $message);
                    $message = str_replace("{brand}", $eOrderItem->brand, $message);
                    $message = str_replace("{description}", $eOrderItem->description, $message);
                    $message = str_replace("{unit_of_measurement}", $eOrderItem->unit_of_measurement, $message);
                    $message = str_replace("{size}", $eOrderItem->size, $message);
                    $message = str_replace("{qty}", $eOrderItem->quantity, $message);
                    $message = str_replace("{last_price}", $eOrderItem->last_price, $message);
                    $message = str_replace("{delivery_period}", $eOrderItem->delivery_period, $message);
                    $message = str_replace("{payment_mode}", $eOrderItem->payment_mode, $message);
                    $message = str_replace("{remarks}", $eOrderItem->remarks, $message);
                    User::send_sms(env('SMS_NO_ONE'), $message);
                    User::send_sms(env('SMS_NO_TWO'), $message);
                    //User::send_sms(env('SMS_NO_ONE'), 'RFQ generated.' . ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , ' . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
                    //User::send_sms(env('SMS_NO_TWO'), 'RFQ generated.' . ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , ' . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
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


                        // search for item code from business_categories table
                        $collection = BusinessCategory::where('category_number', $eOrderItem->item_code)->where('business_id', '!=', $item->business_id)->get();
                        foreach ($collection as $coll) {
                            if (!empty($coll->business)) {
                                {
                                    $get_user = User::where('id', $coll->business->user_id)->first();
                                    if (!empty($get_user)) {
                                        $get_user->notify(new QuotationCategory($eOrderItem->item_code, $eOrderItem->rfq_type));
                                    }
                                }
                            }
                        }

                        $categoryName = Category::where('id', $eOrderItem->item_code)->first();
                        $parentName = Category::where('id', $categoryName->parent_id)->pluck('name')->first();

                        /* Sending message to business email ID */
                        $message = SmsMessages::find(7)->english_message;
                        $message = str_replace("{category_name}", $categoryName->name, $message);
                        $message = str_replace("{parent_name}", $parentName, $message);
                        $message = str_replace("{brand}", $eOrderItem->brand, $message);
                        $message = str_replace("{description}", $eOrderItem->description, $message);
                        $message = str_replace("{unit_of_measurement}", $eOrderItem->unit_of_measurement, $message);
                        $message = str_replace("{size}", $eOrderItem->size, $message);
                        $message = str_replace("{qty}", $eOrderItem->quantity, $message);
                        $message = str_replace("{last_price}", $eOrderItem->last_price, $message);
                        $message = str_replace("{delivery_period}", $eOrderItem->delivery_period, $message);
                        $message = str_replace("{payment_mode}", $eOrderItem->payment_mode, $message);
                        $message = str_replace("{remarks}", $eOrderItem->remarks, $message);
                        User::send_sms(env('SMS_NO_ONE'), $message);
                        User::send_sms(env('SMS_NO_TWO'), $message);
                        //User::send_sms(env('SMS_NO_ONE'), 'RFQ generated.' . ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , ' . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
                        //User::send_sms(env('SMS_NO_TWO'), 'RFQ generated.' . ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , ' . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
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


                        // search for item code from business_categories table
                        $collection = BusinessCategory::where('category_number', $eOrderItem->item_code)->where('business_id', '!=', $item->business_id)->get();
                        foreach ($collection as $coll) {
                            if (!empty($coll->business)) {
                                {
                                    $get_user = User::where('id', $coll->business->user_id)->first();
                                    $get_user->notify(new QuotationCategory($eOrderItem->item_code, $eOrderItem->rfq_type));
                                }
                            }
                        }

                        $categoryName = Category::where('id', $eOrderItem->item_code)->first();
                        $parentName = Category::where('id', $categoryName->parent_id)->pluck('name')->first();

                        /* Sending message to business email ID */
                        $message = SmsMessages::find(7)->english_message;
                        $message = str_replace("{category_name}", $categoryName->name, $message);
                        $message = str_replace("{parent_name}", $parentName, $message);
                        $message = str_replace("{brand}", $eOrderItem->brand, $message);
                        $message = str_replace("{description}", $eOrderItem->description, $message);
                        $message = str_replace("{unit_of_measurement}", $eOrderItem->unit_of_measurement, $message);
                        $message = str_replace("{size}", $eOrderItem->size, $message);
                        $message = str_replace("{qty}", $eOrderItem->quantity, $message);
                        $message = str_replace("{last_price}", $eOrderItem->last_price, $message);
                        $message = str_replace("{delivery_period}", $eOrderItem->delivery_period, $message);
                        $message = str_replace("{payment_mode}", $eOrderItem->payment_mode, $message);
                        $message = str_replace("{remarks}", $eOrderItem->remarks, $message);
                        User::send_sms(env('SMS_NO_ONE'), $message);
                        User::send_sms(env('SMS_NO_TWO'), $message);
//                        User::send_sms(env('SMS_NO_ONE'), 'RFQ generated.' . ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , ' . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
//                        User::send_sms(env('SMS_NO_TWO'), 'RFQ generated.' . ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , ' . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);

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

                    // search for item code from business_categories table
                    $collection = BusinessCategory::where('category_number', $eOrderItem->item_code)->where('business_id', '!=', $item->business_id)->get();

                    foreach ($collection as $coll) {

                        if (!empty($coll->business)) {
                            {
                                $get_user = User::where('id', $coll->business->user_id)->first();
                                if (!empty($get_user)) {
                                    $get_user->notify(new QuotationCategory($eOrderItem->item_code, $eOrderItem->rfq_type));
                                }
                            }
                        }
                    }

                    $categoryName = Category::where('id', $eOrderItem->item_code)->first();
                    $parentName = Category::where('id', $categoryName->parent_id)->pluck('name')->first();

                    /* Sending message to business email ID */
                    $message = SmsMessages::find(7)->english_message;
                    $message = str_replace("{category_name}", $categoryName->name, $message);
                    $message = str_replace("{parent_name}", $parentName, $message);
                    $message = str_replace("{brand}", $eOrderItem->brand, $message);
                    $message = str_replace("{description}", $eOrderItem->description, $message);
                    $message = str_replace("{unit_of_measurement}", $eOrderItem->unit_of_measurement, $message);
                    $message = str_replace("{size}", $eOrderItem->size, $message);
                    $message = str_replace("{qty}", $eOrderItem->quantity, $message);
                    $message = str_replace("{last_price}", $eOrderItem->last_price, $message);
                    $message = str_replace("{delivery_period}", $eOrderItem->delivery_period, $message);
                    $message = str_replace("{payment_mode}", $eOrderItem->payment_mode, $message);
                    $message = str_replace("{remarks}", $eOrderItem->remarks, $message);
                    User::send_sms(env('SMS_NO_ONE'), $message);
                    User::send_sms(env('SMS_NO_TWO'), $message);
                    //User::send_sms(env('SMS_NO_ONE'), 'RFQ generated.' . ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , ' . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
                    //User::send_sms(env('SMS_NO_TWO'), 'RFQ generated.' . ' ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ' , ' . 'Brand: ' . $eOrderItem->brand . ' , ' . 'Desc: ' . $eOrderItem->description . ' , ' . 'UOM: ' . $eOrderItem->unit_of_measurement . ' , ' . 'Size:' . $eOrderItem->size . ' , ' . 'Qty: ' . $eOrderItem->quantity . ' , ' . 'LP: ' . $eOrderItem->last_price . ' SR' . ' , ' . 'DP: ' . $eOrderItem->delivery_period . ' , ' . 'PM: ' . $eOrderItem->payment_mode . ' , ' . 'Rem: ' . $eOrderItem->remarks);
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
