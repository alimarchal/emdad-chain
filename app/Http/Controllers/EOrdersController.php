<?php

namespace App\Http\Controllers;

use App\Models\BusinessPackage;
use App\Models\ECart;
use App\Models\EOrderItems;
use App\Models\EOrders;
use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EOrdersController extends Controller
{
    public function store(Request $request)
    {

        $rfq = EOrders::where('business_id', auth()->user()->business_id)->whereDate('created_at', Carbon::today())->count();

        $business_package = BusinessPackage::where('business_id', auth()->user()->business_id)->first();
        if ($business_package->package_id == 1) {
            if ($rfq == 3) {
                session()->flash('error', 'You have reached daily rfq limit');
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
                    }
                    foreach ($eCartItems as $item) {
                        $item->delete();
                    }
                });

                $user = User::find(auth()->user()->id);
                $user->notify(new \App\Notifications\RfqCreated());
                session()->flash('message', 'RFQ placed successfully');
                return redirect()->route('PlacedRFQ.index');
            }
        } elseif ($business_package->package_id == 2) {
            if ($rfq == 10) {
                session()->flash('error', 'You have reached daily rfq limit');
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
                    }
                    foreach ($eCartItems as $item) {
                        $item->delete();
                    }
                });

                $user = User::find(auth()->user()->id);
                $user->notify(new \App\Notifications\RfqCreated());
                session()->flash('message', 'RFQ placed successfully');
                return redirect()->route('PlacedRFQ.index');
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
                }
                foreach ($eCartItems as $item) {
                    $item->delete();
                }
            });

            $user = User::find(auth()->user()->id);
            $user->notify(new \App\Notifications\RfqCreated());
            session()->flash('message', 'RFQ placed successfully');
            return redirect()->route('PlacedRFQ.index');
        }

    }

    // For single category RFQ

    public function single_category_store(Request $request)
    {
        $rfq = EOrders::where('business_id', auth()->user()->business_id)->whereDate('created_at', Carbon::today())->count();

        $business_package = BusinessPackage::where('business_id', auth()->user()->business_id)->first();

        if ($business_package->package_id == 1) {

            if ($rfq == 3) {
                session()->flash('error', 'You have reached daily rfq limit');
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
                    }
                    foreach ($eCartItems as $item) {
                        $item->delete();
                    }
                });

                $user = User::find(auth()->user()->id);
                $user->notify(new \App\Notifications\RfqCreated());
                session()->flash('message', 'RFQ placed successfully');
                return redirect()->route('single_category_rfq_index');
            }
        } elseif ($business_package->package_id == 2) {
            if ($rfq == 10) {
                session()->flash('error', 'You have reached daily rfq limit');
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
                    }
                    foreach ($eCartItems as $item) {
                        $item->delete();
                    }
                });

                $user = User::find(auth()->user()->id);
                $user->notify(new \App\Notifications\RfqCreated());
                session()->flash('message', 'RFQ placed successfully');
                return redirect()->route('single_category_rfq_index');
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
                }
                foreach ($eCartItems as $item) {
                    $item->delete();
                }
            });

            $user = User::find(auth()->user()->id);
            $user->notify(new \App\Notifications\RfqCreated());
            session()->flash('message', 'RFQ placed successfully');
            return redirect()->route('single_category_rfq_index');
        }

    }
}
