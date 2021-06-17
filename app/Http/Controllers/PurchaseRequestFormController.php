<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessPackage;
use App\Models\Category;
use App\Models\ECart;
use App\Models\EOrders;
use App\Models\Package;
use App\Models\POInfo;
use App\Models\PurchaseRequestForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseRequestFormController extends Controller
{
    public function index()
    {
        $rfq = PurchaseRequestForm::where('business_id', Auth::user()->business_id)->get();
        return view('RFQ.index', compact('rfq'));
    }

    public function create()
    {
//        $user = User::findOrFail(auth()->user()->id);
//        $businessPackage = BusinessPackage::where('user_id', \auth()->id())->first();
        $businessPackage = BusinessPackage::where('business_id', auth()->user()->business_id)->first();
        if (isset($businessPackage))
        {
            $categories = explode(',', $businessPackage->categories);
            $parentCategories = Category::whereIn('id', $categories)->orderBy('name', 'asc')->get();
        }
        else{
//            $parentCategories = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
            session()->flash('error','No Business Package Found for you account! Contact Admin.');
            return redirect()->back();
        }
        $childs = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
//        $eCart = ECart::where('user_id',auth()->user()->id)->where('business_id',auth()->user()->business_id)->get();
        $eCart = ECart::where('business_id',auth()->user()->business_id)->get();

        // Remaining RFQ count
        $rfq = EOrders::where('business_id', auth()->user()->business_id)->whereDate('created_at', \Carbon\Carbon::today())->count();
        $business_package = BusinessPackage::where('business_id', auth()->user()->business_id)->first();

        $latest_rfq = ECart::latest()->where('business_id', auth()->user()->business_id)->first();
        $package = Package::where('id', $business_package->package_id)->first();
        if ($business_package->package_id == 1 || $business_package->package_id == 2)
        {
            $rfqCount = $package->rfq_per_day - $rfq;
        }
        else{
            $rfqCount = null;
        }
        // dd($latest_rfq);

//        return view('RFQ.create', compact('parentCategories', 'childs', 'user','eCart','rfqCount'));

        return view('RFQ.create', compact('parentCategories', 'childs','eCart','rfqCount','latest_rfq'));
    }

    public function store(Request $request)
    {
        if ($request->has('file_path_1')) {
            $path = $request->file('file_path_1')->store('', 'public');
            $request->merge(['file_path' => $path]);
        }
        $request->merge(['item_code' => $request->item_name]);
        $request->merge(['item_name' => Category::find($request->item_name)->first()->name]);
        $rfq = PurchaseRequestForm::create($request->all());
        session()->flash('message', 'Item added successfully.');


        $user = User::findOrFail(auth()->user()->id);
        $parentCategories = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
        $childs = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
        return redirect('RFQ/create',compact('parentCategories', 'childs', 'user'));
    }

}
