<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessCategory;
use App\Models\BusinessPackage;
use App\Models\Category;
use App\Models\Dashboard;
use App\Models\EOrderItems;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->logistic_solution == 1) {
            return redirect()->route('logistics.dashboard');
        }
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
        $pending_orders = EOrderItems::where('status', 'pending')->whereIn('item_code', $business_categories)->get();

        return view('dashboard', compact($pending_orders));
    }

    public function languageChange(Request $request)
    {
        User::where('id', \auth()->user()->id)->update([
            'rtl' => $request->rtl_value,
        ]);

        return response()->json(['success']);
    }

    public function logistic_dashboard(Request $request)
    {
        return view('logistic.dashboard');
    }

    public function logistic_setting(Request $request)
    {
        return view('logistic.setting');
    }

}
