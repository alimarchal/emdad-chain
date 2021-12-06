<?php

namespace App\Http\Controllers;

use App\Models\BusinessPackage;
use App\Models\Package;
use App\Models\PackageManualPayment;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        if (auth()->user()->registration_type == 'Buyer' )
        {
            $packages = Package::where('user_type', 1)->get();
            return view('packageBuyer.index', compact('packages'));
        }
        elseif(auth()->user()->registration_type == 'Supplier')
        {
            $packages = Package::where('user_type', 2)->get();
            return view('packageSupplier.index', compact('packages'));
        }
        else
        {
            return redirect()->back();
        }

    }

    public function update($id)
    {
        $package = Package::where('id', decrypt($id))->first();
        $businessPackage = BusinessPackage::with('package')->where(['user_id' => auth()->id(), 'status' => 1])->first();

        return view('package.update', compact('businessPackage', 'package'));
    }

    public function pdf()
    {
        $businessPackage = BusinessPackage::with('package')->where('business_id', auth()->user()->business_id)->first();

        $pdf = PDF::loadView('package.PDF', compact('businessPackage'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('SubscriptionInvoice.pdf');
    }

    public function view($packageID)
    {
        return view('package.view', compact('packageID'));
    }

    public function paymentView($id)
    {
        $checkPackageManualPayment = PackageManualPayment::where('id', decrypt($id))->first();
        if ($checkPackageManualPayment->status == 1)
        {
            return redirect()->route('parentCategories');
        }
        return view('package.paymentView', compact('checkPackageManualPayment'));
    }

    /* Manual payment view for new subscription */
    public function manualPaymentView($packageID)
    {
        $package = Package::where('id', decrypt($packageID))->first();
        $packageSet = PackageManualPayment::where(['user_id' => auth()->id(), 'upgrade' => 0])->first();
        $businessPackage = BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();
        return view('package.manualPayment', compact('package', 'packageSet', 'businessPackage'));
    }

    /* Manual payment view for upgrading to new subscription */
    public function manualPaymentUpgradingView($id)
    {
        $upgradePackageStatus = PackageManualPayment::where('id', decrypt($id))->first();
        return view('package.manualPayment', compact('upgradePackageStatus'));
    }

    public function storeManualPayment(Request $request)
    {
        $request->validate([
            'amount_received' => 'required',
            'amount_date' => 'required',
            'file_path_1' => 'required|mimes:png,jpg,jpeg',
        ],[
            'amount_date.required' => __('portal.Please choose a deposit date'),
            'file_path_1.required' => __('portal.Receipt (Proof) is required'),
            'file_path_1.mines' => __('portal.Receipt (Proof) must be of type jpg,bmp,png,jpeg,JPEG,JPG,pdf'),
        ]);

        $time = strtotime($request->amount_date);
        $request->merge(['amount_date'=> date('Y-m-d',$time)]);

        $path = $request->file('file_path_1')->store('', 'public');

        $business_id = null;
        if (auth()->user()->business_id)
        {
            $business_id = auth()->user()->business_id;
        }
        $data = [
            'user_id' => auth()->id(),
            'business_id' => $business_id,
            'business_type' => $request->business_type,
            'package_id' => decrypt($request->package_id),
            'bank_name' => 'Alinma Bank',
            'amount_received' => $request->amount_received,
            'account_number' => 'SA2605000068203048310001',
            'amount_date' => $request->amount_date,
            'receipt' => $path,
        ];
        PackageManualPayment::create($data);
        session()->flash('message', __('portal.You have successfully updated payment details. Wait for Emdad response.'));
        return redirect()->route('dashboard');
    }

    public function updateManualPayment(Request $request)
    {
        $request->validate([
            'amount_date' => 'required',
            'file_path_1' => 'required|mimes:png,jpg,jpeg',
        ],[
            'amount_date.required' => __('portal.Please choose a deposit date'),
            'file_path_1.required' => __('portal.Receipt (Proof) is required'),
            'file_path_1.mines' => __('portal.Receipt (Proof) must be of type jpg,bmp,png,jpeg,JPEG,JPG,pdf'),
        ]);

        $time = Carbon::parse($request->amount_date)->format('Y-m-d');
        $request->merge(['amount_date'=> $time]);

        $path = $request->file('file_path_1')->store('', 'public');

        /* checking user is upgrading to a new subscription */
        $businessPackage = BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();
        if (isset($businessPackage))
        {
//            $packageManualPayment = PackageManualPayment::where(['business_id' => auth()->user()->business_id, 'upgrade' => 0])->where('status' , '!=', 1)->first();
            if ($request->package_manual_payment_id)
            {
                $packageManualPayment = PackageManualPayment::where('id', decrypt($request->package_manual_payment_id))->first();
                $data = [
                    'amount_date' => $request->amount_date,
                    'receipt' => $path,
                    'status' => 0,
                ];
                $packageManualPayment->update($data);
                session()->flash('message', __('portal.You have successfully updated payment details. Wait for Emdad response.'));
                return redirect()->route('dashboard');
            }
            $data = [
                'user_id' => auth()->id(),
                'business_id' => auth()->user()->business_id,
                'business_type' => $request->business_type,
                'package_id' => decrypt($request->package_id),
                'bank_name' => 'Alinma Bank',
                'amount_received' => $request->amount_received,
                'account_number' => 'SA2605000068203048310001',
                'amount_date' => $request->amount_date,
                'receipt' => $path,
            ];
            PackageManualPayment::create($data);
            session()->flash('message', __('portal.You have successfully updated payment details. Wait for Emdad response.'));
            return redirect()->route('dashboard');
        }
        else
        {
            $data = [
                'amount_date' => $request->amount_date,
                'receipt' => $path,
                'status' => 0,
            ];
        }

        PackageManualPayment::where('id', decrypt($request->id))->update($data);
        session()->flash('message', __('portal.You have successfully updated payment details. Wait for Emdad response.'));
        return redirect()->route('dashboard');
    }

}
