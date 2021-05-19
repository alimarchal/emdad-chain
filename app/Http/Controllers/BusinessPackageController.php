<?php

namespace App\Http\Controllers;

use App\Models\BusinessPackage;
use App\Models\CommissionPercentage;
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


    public function getCheckOutId(Request $request)
    {
        $package = Package::where('id', $request->package_id)->first();
//        dd($request->all());
        return view('subscribePackageView.step-one', compact('package'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // stop
        //return dd(env('entity_id_visa'));

        //after payment add payment details to payment table after that insert that payment id to BusinessPackage table
        $package = Package::where('id', $request->package_id)->first();
        // if price exist then return to new view else it's free one
        if ($request->package_id == 2 || $request->package_id == 3 || $request->package_id == 6 || $request->package_id == 7) {
            $data = null;
            $url = "https://test.oppwa.com/v1/checkouts";
            if ($request->gateway == "mada") {
                $data = "entityId=" . env('entity_id_mada') .
                    "&amount=" . $package->charges .
                    "&currency=SAR" .
                    "&paymentType=DB";
                $request->merge(["testMode" => "EXTERNAL"]);

            } elseif ($request->gateway == "visa_master") {
                $data = "entityId=" . env('entity_id_visa') .
                    "&amount=" . $package->charges .
                    "&currency=SAR" .
                    "&paymentType=DB";
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization:Bearer ' . env('AUTH_BEARER')));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            if (curl_errno($ch)) {
                return curl_error($ch);
            }

            curl_close($ch);
            $res_data = json_decode($responseData, true);
            $gateway = $request->gateway;

            return view('subscribePackageView.payment', compact('package', 'res_data', 'gateway'));
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

                $reference = IreCommission::where(['user_id' => auth()->id()], ['type' => 1])->first();   /* type 1 for Buyer */
                if (isset($reference)) {
                    $commission = CommissionPercentage::where(['commission_type' => 2], ['package_type' => $package->id])->where('ire_type', $reference->ireNoReferencee->type)->first();
                    if (isset($commission)) {
                        IreCommission::where('id', $reference->id)->update([
                            'payment' => $commission->amount
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

                $reference = IreCommission::where(['user_id' => auth()->id()], ['type' => 2])->first();      /* type 2 for Supplier */
                if (isset($reference)) {
                    $commission = CommissionPercentage::where(['commission_type' => 2], ['package_type' => $package->id])->where('ire_type', $reference->ireNoReferencee->type)->first();
                    if (isset($commission)) {
                        IreCommission::where('id', $reference->id)->update([
                            'payment' => $commission->amount
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


    public function getPaymentStatus($id, $resourcePath, $gateway)
    {
        $url = "https://test.oppwa.com/";
        $url .= $resourcePath;
        if ($gateway == "mada") {
            $url .= "?entityId=" . env('entity_id_mada');
        } else {
            $url .= "?entityId=" . env('entity_id_visa');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer ' . env('AUTH_BEARER')));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return json_decode($responseData, true);
    }

    public function businessPackagePaymentStatus(Request $request)
    {
        $id = $request->id;
        $resourcePath = $request->resourcePath;
        $gateway = $request->gateway;

        $transaction_status = $this->getPaymentStatus($id, $resourcePath, $gateway);

        //000.100.110
        $payment_status = $transaction_status['result']['code'];
        if ($payment_status == "000.100.110") {
            //$paymentService = new \Moyasar\Providers\PaymentService();
            //$payment_info = $paymentService->fetch($request->id);
            $package_id = $request->package_id;
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

                $reference = IreCommission::where(['user_id' => auth()->id()], ['type' => 1])->first();      /* type 1 for Buyer */
                if (isset($reference)) {
                    $commission = CommissionPercentage::where(['commission_type' => 2], ['package_type' => $package->id])->where('ire_type', $reference->ireNoReferencee->type)->first();
                    if (isset($commission)) {
                        $payment = round($package->charges * $commission->amount, 2);
                        IreCommission::where('id', $reference->id)->update([
                            'payment' => $payment
                        ]);
                    }
                }

                session()->flash('success', 'Transaction Successful.');
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

                $reference = IreCommission::where(['user_id' => auth()->id()], ['type' => 2])->first();      /* type 2 for Supplier */
                if (isset($reference)) {
                    $commission = CommissionPercentage::where(['commission_type' => 1], ['package_type' => $package->id])->where('ire_type', $reference->ireNoReferencee->type)->first();
                    if (isset($commission)) {
                        $payment = round($package->charges * $commission->amount, 2);
                        IreCommission::where('id', $reference->id)->update([
                            'payment' => $payment
                        ]);
                    }

                }

                session()->flash('success', 'Transaction Successful.');
                return redirect()->route('parentCategories');
            }
        } else {
            session()->flash('message', 'Transaction failed.');
            return redirect()->route('packages.index');
        }
    }
}
