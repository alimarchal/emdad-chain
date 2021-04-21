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
        $banks = Bank::all();

        return view('ire.english.register', compact('banks'));
    }

    public function register_arabic_view()
    {
        $banks = Bank::all();

        return view('ire.arabic.register',compact('banks'));
    }

    public function ire_create(Request $request)
    {
        Validator::make($request->all(), [
            'firstName' => ['required', 'string', 'max:55'],
            'lastName' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'gender' => ['required'],
            'bank' => ['required'],
            'iban' => ['required'],
            'nid_num' => ['required', 'string', 'max:10'],
            'referred_no' => ['string', 'nullable'],
            'type' => ['required'],
            'mobile_number' => ['required', 'string', 'max:20'],

        ])->validate();

        $ire = Ire::create([
                    'name' => $request['firstName'].' '.$request['lastName'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'gender' => $request['gender'],
                    'bank' => $request['bank'],
                    'iban' => $request['iban'],
                    'nid_num' => $request['nid_num'],
                    'referred_no' => $request['referred_no'],
                    'type' => $request['type'],
                    'mobile_number' => $request['mobile_number'],
                ]);

        Ire::where('id', $ire->id)->update([
            'ire_no' => 'IRE00000'.$ire->id
        ]);

        if ($request->referred_no == null || $request->referred_no == ' ')
        {
            session()->flash('status', 'Registered Successfully, Login to start');
            return redirect()->route('ireLogin');
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
                ]);
            }
        }

//        return redirect()->route('ireDashboard');
        session()->flash('status', 'Registered Successfully, Login to start');
        return redirect()->route('ireLogin');
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

        $ires = Ire::where('referred_no', \auth()->guard('ire')->user()->ire_no)->where('id', '!=' , \auth()->guard('ire')->user()->id)->get();

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

        $ireCommissions = IreCommission::where('ire_no', \auth()->guard('ire')->user()->ire_no)->get();

        return view('ire.english.payment', compact('ireCommissions'));
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

        $ires = Ire::where('referred_no', \auth()->guard('ire')->user()->ire_no)->where('id', '!=' , \auth()->guard('ire')->user()->id)->get();

        return view('ire.arabic.reference', compact('ires'));
    }

    public function arabic_incomplete_reference()
    {
        if (\auth()->guard('ire')->user()->rtl == 1)
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

        $ireCommissions = IreCommission::where('ire_no', \auth()->guard('ire')->user()->ire_no)->get();

        return view('ire.arabic.payment', compact('ireCommissions'));
    }
}
