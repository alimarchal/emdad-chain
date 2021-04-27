<?php

namespace App\Http\Controllers;

use App\Models\Ire;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return response()->json(['data' => 'Reference Verified: '.$seller->name]);
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
}
