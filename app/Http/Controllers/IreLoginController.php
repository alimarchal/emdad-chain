<?php

namespace App\Http\Controllers;

use App\Models\Ire;
use App\Notifications\ireForgotPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IreLoginController extends Controller
{

    protected $redirectTo = 'seller-dashboard';

    public function __construct()
    {
        $this->middleware('guest:ire')->except('logout');
    }

    public function username()
    {
        return 'name';
    }
    protected function guard()
    {
        return Auth::guard('ire');
    }

    // used for ire search for reference
    public function search_ire(Request $request)
    {
        $seller = Ire::where('ire_no', $request->referred_no)->first();

        if (!$seller)
        {
            return response()->json( ['status' => 0]);
        }
        return response()->json(['data' => $seller->name]);
    }

    public function login_view()
    {
        return view('ire.english.login');
    }

    public function arabic_login_view()
    {
        return view('ire.arabic.login');
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::guard('ire')->attempt($credentials)) {
            // validation successfull
            return redirect()->route('ireDashboard');
        }
        else
        {
            // validation not successful, send back to form
            return redirect()->route('ireLogin')->with('status', 'Invalid credentials');
        }

    }

    public function forgot_password_view(Request $request)
    {
        return view('ire.english.forgotPassword');
    }

    public function forgot_password(Request $request)
    {

        $email = $request->only('email');

        $ireEmail = Ire::where('email', $email)->first();

        if (isset($ireEmail))
        {
            $password = rand();

            Ire::where('id', $ireEmail->id)->update([
                'password' => Hash::make($password),
            ]);

            $ire = Ire::where('id', $ireEmail->id)->first();

            $ire->notify(new ireForgotPassword($password));

            session()->flash('message','New password is send to your email address');
            return redirect()->route('ireLogin');
        }

        session()->flash('message', 'Invalid Email ID');
        return redirect()->back();

    }
}
