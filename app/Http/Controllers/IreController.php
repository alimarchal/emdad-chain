<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Bank;
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

    public function register_view()
    {
        return view('ire.english.register');
    }

    public function register_arabic_view()
    {
        $banks = Bank::all();

        return view('ire.arabic.register',compact('banks'));
    }

    public function ire_register(Request $request)
    {
        Validator::make($request->all(), [
            'firstName' => ['required', 'string', 'max:55'],
            'lastName' => ['required', 'string'],
            'mobile_number' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:ires'],
            'password' => $this->passwordRules(),
            'policy_procedure' => ['required'],

        ])->validate();

        $ire = Ire::create([
                    'name' => $request['firstName'].' '.$request['lastName'],
                    'mobile_number' => $request['mobile_number'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                ]);

        Ire::where('id', $ire->id)->update([
            'ire_no' => 'IRE00000'.$ire->id
        ]);


        session()->flash('status', 'Registered Successfully, Add details to start');
        return redirect()->route('ireRegisterDetails');
    }

    public function ire_register_details_view()
    {
        $banks = Bank::all();

        return view('ire.english.registerDetails', compact('banks'));
    }

    public function ire_register_details(Request $request)
    {
        Validator::make($request->all(), [
            'referred_no' => ['string', 'nullable'],
            'gender' => ['required'],
            'nid_num' => ['required', 'string', 'max:10'],
            'nid_image' => ['required', 'image'],
            'type' => ['required'],
            'bank' => ['required'],
            'iban' => ['required'],
            'policy_procedure' => ['required'],

        ])->validate();

        $ire = Ire::where('id', \auth()->guard('ire')->user()->id)->update([
            'referred_no' => $request['referred_no'],
            'gender' => $request['gender'],
            'nid_num' => $request['nid_num'],
            'nid_image' => $request['nid_image'],
            'type' => $request['type'],
            'bank' => $request['bank'],
            'iban' => $request['iban'],
                ]);

        if ($request->referred_no == null || $request->referred_no == ' ')
        {
//            session()->flash('status', 'Registered Successfully, Login to start');
            return redirect()->route('ireDashboard');
        }
        else
        {
            $ireReferred = Ire::where('ire_no', $request->referred_no)->first();

            if (isset($ireReferred))
            {
                IreCommission::create([
                    'ire_no' => $request->referred_no,
                    'user_id' => $ire->id,
                    'type' => 0,
                    'status' => 1,
                ]);
            }
        }

        return redirect()->route('ireDashboard');
    }

    public function dashboard()
    {
        if (\auth()->guard('ire')->user()->rtl == 1)
        {
            return redirect()->route('ireArabicDashboard');
        }

        return view('ire.english.dashborad');
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

        return view('ire.arabic.dashboard');
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

    public function arabic_profile()
    {
        if (\auth()->guard('ire')->user()->rtl == 0)
        {
            return redirect()->route('ireProfile');
        }

        return view('ire.arabic.profile');
    }
}
