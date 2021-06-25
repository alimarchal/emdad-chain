<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use App\Models\Dashboard;
use App\Models\EOrderItems;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user_business_id = Auth::user()->business_id;
        $business_categories = [];
        $business_cate = BusinessCategory::where('business_id', $user_business_id)->get();
        if ($business_cate->isNotEmpty()) {
            foreach ($business_cate as $item) {
                $business_categories[] = (int)$item->category_number;
            }
        }
        sort($business_categories);
        // $business_categories = implode(",", $business_categories);
        $pending_orders = EOrderItems::where('status','pending')->whereIn('item_code', $business_categories)->get();

        return view('dashboard',compact($pending_orders));
    }

    public function languageChange(Request $request)
    {
        User::where('id', \auth()->user()->id)->update([
            'rtl' => $request->rtl_value,
        ]);

        return response()->json(['success']);
    }

}
