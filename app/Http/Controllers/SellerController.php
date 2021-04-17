<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;
use App\Models\Seller;
use App\Models\SellerCommission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{
    use PasswordValidationRules; use Authenticatable;

    public function register_view()
    {
        return view('sales.english.register');
    }

    public function register_arabic_view()
    {
        return view('sales.arabic.register');
    }

    public function seller_create(Request $request)
    {
        Validator::make($request->all(), [
            'firstName' => ['required', 'string', 'max:55'],
            'lastName' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'gender' => ['required'],
            'nid_num' => ['required', 'string', 'max:10'],
            'referred_no' => ['string', 'nullable'],
            'type' => ['required'],
            'mobile_number' => ['required', 'string', 'max:20'],

        ])->validate();

        $seller = Seller::create([
                    'name' => $request['firstName'].' '.$request['lastName'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'gender' => $request['gender'],
                    'nid_num' => $request['nid_num'],
                    'referred_no' => $request['referred_no'],
                    'type' => $request['type'],
                    'mobile_number' => $request['mobile_number'],
                ]);

        Seller::where('id', $seller->id)->update([
            'seller_no' => 'SR00'.$seller->id
        ]);

        if ($request->referred_no != null || $request->referred_no != ' ')
        {
            SellerCommission::create([
                'seller_no' => $request->referred_no,
                'user_id' => $seller->id,
            ]);
        }

        return redirect()->route('sellerDashboard');
    }

    public function dashboard()
    {
        return view('sales.english.dashborad');
    }
}
