<?php

namespace App\Http\Controllers;

use App\Mail\Contracts;
use App\Mail\Orders;
use App\Models\Business;
use App\Models\BusinessWarehouse;
use App\Models\POInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class POInfoController extends Controller
{
    public function create()
    {
        $business = Business::where('user_id', auth()->id())->get();
        $businessWarehouse = BusinessWarehouse::where('user_id', auth()->id())->get();
        if ($business->isEmpty()) {
            session()->flash('message', 'Please enter business information first.');
            return redirect()->route('business.create');
        }
        elseif ($businessWarehouse->isEmpty()) {
            session()->flash('message', 'Please enter warehouse information first.');
            return redirect()->route('businessWarehouse.create');
        }
        else {
            $po = POInfo::where('business_id', auth()->user()->business->id)->get();
            return view('purchaseOrderInfo.create', compact('business', 'po'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_of_monthly_orders' => 'required',
            'volume' => 'required',
            'type' => 'required',
            'user_id' => 'required',
            'business_id' => 'required',
            'order_info_1.*' => 'required|mimes:jpeg,jpg,png,gif,csv,txt,pdf,docx,xlsx,doc,xls',
        ]);
        // dd($request->all());
        $files = $request->file('order_info_1');
        $order_info = [];
        if ($request->has('order_info_1')) {
            foreach ($files as $file) {
                $path = $file->store('', 'public');
                $order_info[] = $path;
            }
        }
        $order_info = implode(', ', $order_info);
        $request->merge(['order_info' => $order_info]);
        $POInfo = POInfo::create($request->all());
        session()->flash('message', 'P.O.Info information successfully saved.');
        $business = Business::find($POInfo->business_id);
        $business->update(['status' => '1']);
        $user = User::find(auth()->user()->id);
        $user->update(['status' => 1]);
        if ($user->registration_type == "Contracts") {
            Mail::to($user)->send(new Contracts($business, $user));
        } else {
            Mail::to($user)->send(new Orders($business, $user));
        }
        return redirect()->route('dashboard');
    }

    public function show(POInfo $purchaseOrderInfo)
    {
        $business = Business::find($purchaseOrderInfo->business_id);
        return view('purchaseOrderInfo.show', compact('purchaseOrderInfo', 'business'));
    }

    public function view()
    {
        return view('purchaseOrderInfo.view');
    }
}
