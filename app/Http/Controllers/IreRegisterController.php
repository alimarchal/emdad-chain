<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Bank;
use App\Models\DraftPurchaseOrder;
use App\Models\Ire;
use App\Models\IreCommission;
use App\Notifications\verifyEmail;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class IreRegisterController extends Controller
{
    use PasswordValidationRules; use Authenticatable;

    public function register_view()
    {
        return view('ire.english.register');
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

        $verifyToken = sha1(rand(1,100));

        $ire = Ire::create([
            'name' => $request['firstName'].' '.$request['lastName'],
            'mobile_number' => $request['mobile_number'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'verify_token' => $verifyToken,
        ]);

        Ire::where('id', $ire->id)->update([
            'ire_no' => 'IRE00000'.$ire->id,
        ]);

        $ire->notify(new verifyEmail($ire));

        \auth()->guard('ire')->login($ire);
        return redirect()->route('ireEmailVerify');
    }

    public function ire_register_details_view()
    {
        if (\auth()->guard('ire')->user()->bank != null || \auth()->guard('ire')->user()->iban != null || \auth()->guard('ire')->user()->nid_num != null)
        {
            return redirect()->route('ireDashboard');
        }

        $banks = Bank::all();

        return view('ire.english.registerDetails', compact('banks'));
    }

    public function ire_register_details(Request $request)
    {
        Validator::make($request->all(), [
            'referred_no' => ['string', 'nullable'],
            'gender' => ['required'],
            'nid_num' => ['required', 'string', 'max:10'],
            'nid_image' => ['required', 'file','mimes:jpeg,jpg,png', 'max:5120'],
            'type' => ['required'],
            'bank' => ['required'],
            'iban' => ['required'],

        ])->validate();

        $path = $request->file('nid_image')->store('', 'public');
        $request->merge(['nid_image' => $path]);

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
            return redirect()->route('ireDashboard');
        }
        else
        {
            $poCount = 0;

            $ireReferred = Ire::where('ire_no', $request->referred_no)->first();

            if (isset($ireReferred))
            {
                $businessCount = IreCommission::where('type', '!=', 0)->where(['ire_no' => $request->referred_no],['status' => 1])->get();
                $current = Carbon::now();
                $days = $current->diffInDays($ireReferred->created_at);

                if (isset($businessCount) && count($businessCount) > 0 )
                {
                    foreach ($businessCount as $business)
                    {
                        $this->userPoCount = DraftPurchaseOrder::where(['user_id' => $business->user_id],['status' => 'approved'])->first();

                        if (isset($this->userPoCount))
                        {
                            $poCount += 1;
                        }
                    }
                }
                if ($days >= 30 && $poCount >= 5)
                {
                    IreCommission::create([
                        'ire_no' => $request->referred_no,
                        'user_id' => \auth()->guard('ire')->user()->id,
                        'type' => 0,
                        'status' => 1,
                    ]);
                }

            }
        }

        return redirect()->route('ireDashboard');
    }

    public function email_verify()
    {
        if (\auth()->guard('ire')->user()->verified == 1)
        {
            return redirect()->route('ireRegisterDetails');
        }
        return view('ire.english.verify-email');
    }

    public function resend_email_verification()
    {
        $ire = Ire::where('id',auth()->guard('ire')->user()->id)->first();

        $verifyToken = sha1($ire->name);

        Ire::where('id', $ire->id)->update([
            'verify_token' => $verifyToken,
        ]);

        $ire->notify(new verifyEmail($ire));

        session()->flash('status', 'verification-link-sent');
        return redirect()->back();
    }

    public function email_verify_check($token)
    {
        if (auth()->guard('ire')->user()->verify_token == $token)
        {
            Ire::where('id', auth()->guard('ire')->user()->id)->update([
                'email_verified_at' => Carbon::now(),
                'verified' => 1,
            ]);
            return redirect()->route('ireRegisterDetails');
        }

        session()->flash('message', 'Something went wrong! Login to try again.');
        Auth::guard('ire')->logout();
        return redirect()->route('ireLogin');
    }

############################# Arabic funtions ###################################

    public function register_arabic_view()
    {
        return view('ire.arabic.register');
    }

    public function ire_register_details_arabic_view()
    {
        if (\auth()->guard('ire')->user()->bank != null || \auth()->guard('ire')->user()->iban != null || \auth()->guard('ire')->user()->nid_num != null)
        {
            return redirect()->route('ireDashboard');
        }

        $banks = Bank::all();

        return view('ire.arabic.registerDetails', compact('banks'));
    }

}
