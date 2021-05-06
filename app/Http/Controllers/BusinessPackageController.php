<?php

namespace App\Http\Controllers;

use App\Models\BusinessPackage;
use App\Models\Ire;
use App\Models\IreCommission;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusinessPackageController extends Controller
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //after payment add payment details to payment table after that insert that payment id to BusinessPackage table
        $package = Package::where('id', $request->package_id)->first();
        // if price exist then return to new view else it's free one
        if ($request->package_id == 2 || $request->package_id == 3 || $request->package_id == 6 || $request->package_id == 7) {
            return view('subscribePackageView.payment', compact('package'));
        } else {
            $subscription_end_date = Carbon::now()->addYear();
            if (auth()->user()->registration_type == 'Buyer') {
                BusinessPackage::create([
                    'business_type' => 1,
                    'package_id' => $package->id,
                    'user_id' => auth()->id(),
                    'subscription_start_date' => Carbon::now(),
                    'subscription_end_date' => $subscription_end_date,
                ]);

                $reference = IreCommission::where(['user_id' => auth()->id()],['type' => 1])->first();   /* type 1 for Buyer */
                if (isset($reference))
                {
                    if($reference->ireNoReferencee->type == 0)         /* 0 for non - employee */
                    {
                        IreCommission::where('id' , $reference->id)->update([
                            'payment' => 50
                        ]);
                    }

                }

                return redirect()->route('parentCategories');
            } elseif (auth()->user()->registration_type == 'Supplier') {
                BusinessPackage::create([
                    'business_type' => 2,
                    'package_id' => $package->id,
                    'user_id' => auth()->id(),
                    'subscription_start_date' => Carbon::now(),
                    'subscription_end_date' => $subscription_end_date,
                ]);

                $reference = IreCommission::where(['user_id' => auth()->id()],['type' => 2])->first();      /* type 2 for Supplier */
                if (isset($reference))
                {
                    if($reference->ireNoReferencee->type == 0)               /* 0 for non - employee */
                    {
                        IreCommission::where('id' , $reference->id)->update([
                            'payment' => 30
                        ]);
                    }

                }

                return redirect()->route('parentCategories');
            }
        }


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\BusinessPackage $businessPackage
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessPackage $businessPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\BusinessPackage $businessPackage
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessPackage $businessPackage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BusinessPackage $businessPackage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessPackage $businessPackage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BusinessPackage $businessPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessPackage $businessPackage)
    {
        //
    }

    public function updateCategories(Request $request)
    {
        $categories = implode(',', $request->category_id);

        $businessPackage = BusinessPackage::where('id', $request->business_id)->first();
        $businessPackage->update([
            'categories' => $categories,
        ]);
        return redirect()->route('business.create');
    }

    public function businessPackagePaymentStatus(Request $request)
    {
        $payment_status = $request->status;
        if ($payment_status == "paid") {
            $paymentService = new \Moyasar\Providers\PaymentService();
            $payment_info = $paymentService->fetch($request->id);
            $package_id = $payment_info->description;
            $package = Package::where('id', $package_id)->first();
            $subscription_end_date = Carbon::now()->addYear();
            if (auth()->user()->registration_type == 'Buyer') {
                BusinessPackage::create([
                    'business_type' => 1,
                    'package_id' => $package->id,
                    'invoice_id' => $request->id,
                    'user_id' => auth()->id(),
                    'subscription_start_date' => Carbon::now(),
                    'subscription_end_date' => $subscription_end_date,
                ]);

                $reference = IreCommission::where(['user_id' => auth()->id()],['type' => 1])->first();      /* type 1 for Buyer */
                if (isset($reference))
                {
                    if($reference->ireNoReferencee->type == 0)               /* 0 for non - employee */
                    {
                        $payment = round($package->charges * 0.1, 2);
                        IreCommission::where('id' , $reference->id)->update([
                            'payment' => $payment
                        ]);
                    }
                    elseif ($reference->ireNoReferencee->type == 1)          /* 1 for employee */
                    {
                        $payment = round($package->charges * 0.03, 2);
                        IreCommission::where('id' , $reference->id)->update([
                            'payment' => $payment
                        ]);
                    }

                }

                return redirect()->route('parentCategories');
            } elseif (auth()->user()->registration_type == 'Supplier') {
                BusinessPackage::create([
                    'business_type' => 2,
                    'package_id' => $package->id,
                    'invoice_id' => $request->id,
                    'user_id' => auth()->id(),
                    'subscription_start_date' => Carbon::now(),
                    'subscription_end_date' => $subscription_end_date,
                ]);

                $reference = IreCommission::where(['user_id' => auth()->id()],['type' => 2])->first();      /* type 2 for Supplier */
                if (isset($reference))
                {
                    if($reference->ireNoReferencee->type == 0)               /* 0 for non - employee */
                    {
                        $payment = round($package->charges * 0.1, 2);
                        IreCommission::where('id' , $reference->id)->update([
                            'payment' => $payment
                        ]);
                    }
                    elseif ($reference->ireNoReferencee->type == 1)          /* 1 for employee */
                    {
                        $payment = round($package->charges * 0.03, 2);
                        IreCommission::where('id' , $reference->id)->update([
                            'payment' => $payment
                        ]);
                    }

                }

                return redirect()->route('parentCategories');
            }
        }
        else {
            redirect()->route('packages.index');
        }
    }
}
