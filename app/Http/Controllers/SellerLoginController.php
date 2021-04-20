<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerLoginController extends Controller
{

    protected $redirectTo = 'seller-dashboard';

    public function __construct()
    {
        $this->middleware('guest:seller')->except('logout');
    }

    public function username()
    {
        return 'name';
    }
    protected function guard()
    {
        return Auth::guard('seller');
    }

    public function search_seller(Request $request)
    {
        $seller = Seller::where('seller_no', $request->referred_no)->first();

        if (!$seller)
        {
            return response()->json( ['status' => 0]);
        }
        return response()->json(['data' => 'Reference Verified: '.$seller->name]);
    }

    public function login_view()
    {
        return view('sales.english.login');
    }

    public function arabic_login_view()
    {
        return view('sales.arabic.login');
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::guard('seller')->attempt($credentials)) {
            // validation successfull
            return redirect()->route('sellerDashboard');
        }
        else
        {
            // validation not successful, send back to form
            return redirect()->route('sellerLogin')->with('status', 'Invalid credentials');
        }

    }
}
