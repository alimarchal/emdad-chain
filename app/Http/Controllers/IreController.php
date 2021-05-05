<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Bank;
use App\Models\DraftPurchaseOrder;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;
use App\Models\Ire;
use App\Models\IreCommission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class IreController extends Controller
{
    use PasswordValidationRules; use Authenticatable;

    public function dashboard()
    {
        if (\auth()->guard('ire')->user()->rtl == 1)
        {
            return redirect()->route('ireArabicDashboard');
        }

        $poCount = 0;

        $businessCount = IreCommission::where('type', '!=', 0)->where(['ire_no' => \auth()->guard('ire')->user()->ire_no],['status' => 1])->get();

        if (isset($businessCount) && count($businessCount) > 0 )
        {
            foreach ($businessCount as $business)
            {
                $userPoCount = DraftPurchaseOrder::where(['user_id' => $business->user_id],['status' => 'approved'])->first();

                if (isset($userPoCount))
                {
                    $poCount += 1;
                }
            }
        }

        return view('ire.english.dashborad', compact('poCount'));
    }

    public function reference()
    {
        if (\auth()->guard('ire')->user()->rtl == 1)
        {
            return redirect()->route('ireArabicReference');
        }

//        $ires = Ire::where('referred_no', \auth()->guard('ire')->user()->ire_no)->where('id', '!=' , \auth()->guard('ire')->user()->id)->get();
        $ires = IreCommission::with('ireReference')->where('ire_no', \auth()->guard('ire')->user()->ire_no)->where(['status' => 1])->get();

        return view('ire.english.reference', compact('ires'));
    }

    public function incomplete_reference()
    {
        if (\auth()->guard('ire')->user()->rtl == 1)
        {
            return redirect()->route('ireArabicIncompleteReference');
        }

        $incompleteReferences = IreCommission::with('nonIreReference')->where('ire_no', \auth()->guard('ire')->user()->ire_no)->where(['type'=> 3], ['status' => 0])->get();

        return view('ire.english.incompleteReference', compact('incompleteReferences'));
    }

    public function payment()
    {
        if (\auth()->guard('ire')->user()->rtl == 1)
        {
            return redirect()->route('ireArabicPayment');
        }

        $ireCommissions = IreCommission::where('ire_no', \auth()->guard('ire')->user()->ire_no)->where('status', 1)->get();

        return view('ire.english.payment', compact('ireCommissions'));
    }

    public function download()
    {
        if (\auth()->guard('ire')->user()->rtl == 1)
        {
            return redirect()->route('ireArabicDownload');
        }

        return view('ire.english.download');
    }

    public function profile()
    {
        if (\auth()->guard('ire')->user()->rtl == 1)
        {
            return redirect()->route('ireArabicProfile');
        }

        return view('ire.english.profile');
    }

    public function languageChange(Request $request)
    {
        Ire::where('id', \auth()->guard('ire')->user()->id)->update([
            'rtl' => $request->rtl_value,
        ]);

        return response()->json(['success']);
    }

#################### Arabic functions #######################

    public function arabic_dashboard()
    {
        if (\auth()->guard('ire')->user()->rtl == 0)
        {
            return redirect()->route('ireDashboard');
        }

        $poCount = 0;

        $businessCount = IreCommission::where('type', '!=', 0)->where(['ire_no' => \auth()->guard('ire')->user()->ire_no],['status' => 1])->get();

        if (isset($businessCount) && count($businessCount) > 0 )
        {
            foreach ($businessCount as $business)
            {
                $userPoCount = DraftPurchaseOrder::where(['user_id' => $business->user_id],['status' => 'approved'])->first();

                if (isset($userPoCount))
                {
                    $poCount += 1;
                }
            }
        }

        return view('ire.arabic.dashboard', compact('poCount'));
    }

    public function arabic_reference()
    {
        if (\auth()->guard('ire')->user()->rtl == 0)
        {
            return redirect()->route('ireReference');
        }

        $ires = IreCommission::with('ireReference')->where('ire_no', \auth()->guard('ire')->user()->ire_no)->where(['status' => 1])->get();


        return view('ire.arabic.reference', compact('ires'));
    }

    public function arabic_incomplete_reference()
    {
        if (\auth()->guard('ire')->user()->rtl == 0)
        {
            return redirect()->route('ireIncompleteReference');
        }

        $incompleteReferences = IreCommission::with('nonIreReference')->where('ire_no', \auth()->guard('ire')->user()->ire_no)->where(['type'=> 3], ['status' => 0])->get();

        return view('ire.arabic.incompleteReference', compact('incompleteReferences'));
    }

    public function arabic_payment()
    {
        if (\auth()->guard('ire')->user()->rtl == 0)
        {
            return redirect()->route('irePayment');
        }

        $ireCommissions = IreCommission::where('ire_no', \auth()->guard('ire')->user()->ire_no)->where('status', 1)->get();

        return view('ire.arabic.payment', compact('ireCommissions'));
    }

    public function arabic_download()
    {
        if (\auth()->guard('ire')->user()->rtl == 0)
        {
            return redirect()->route('ireDownload');
        }

        return view('ire.arabic.download');
    }

    public function arabic_profile()
    {
        if (\auth()->guard('ire')->user()->rtl == 0)
        {
            return redirect()->route('ireProfile');
        }

        return view('ire.arabic.profile');
    }
}
