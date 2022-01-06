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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;

class PurchaseRequestFormController extends Controller
{
    public function index()
    {
        $rfq = PurchaseRequestForm::where('business_id', Auth::user()->business_id)->get();
        return view('RFQ.index', compact('rfq'));
    }

    public function create()
    {
        $businessPackage = BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();
        if (isset($businessPackage))
        {
            $categories = explode(',', $businessPackage->categories);
            $parentCategories = Category::whereIn('id', $categories)->orderBy('name', 'asc')->get();
        }
        else{
            session()->flash('error', __('portal.No Business Package Found for you account! Contact Admin.'));
            return redirect()->back();
        }
        $childs = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
        $eCart = ECart::where(['business_id' => auth()->user()->business_id,'rfq_type' => 1])->orderByDesc('created_at')->get();

        // Remaining RFQ count
        $rfq = EOrders::where('business_id', auth()->user()->business_id)->whereDate('created_at', \Carbon\Carbon::today())->count();
        $business_package = BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();

        $latest_rfq = ECart::latest()->where('business_id', auth()->user()->business_id)->first();
        $package = Package::where('id', $business_package->package_id)->first();
        if ($business_package->package_id == 1 || $business_package->package_id == 2)
        {
            $rfqCount = $package->rfq_per_day - $rfq;
        }
        else{
            $rfqCount = null;
        }

        /* Below code added to redirect back if Requisition limit for day is reached Added because h-screen issue in App.css blade */
        if ($rfqCount <= 0 && $business_package->package_id != 3 && $business_package->package_id != 4)
        {
            session()->flash('error', __('portal.Your have reached daily requisition generate limit.'));
            return redirect()->route('rfqView');
        }

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
        session()->flash('message', __('portal.Item added successfully.'));


        $user = User::findOrFail(auth()->user()->id);
        $parentCategories = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
        $childs = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
        return redirect('RFQ/create',compact('parentCategories', 'childs', 'user'));
    }

    /* For Single Category RFQ*/
    public function create_single_rfq()
    {
        $businessPackage = BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();
        if (isset($businessPackage))
        {
            $categories = explode(',', $businessPackage->categories);
            $parentCategories = Category::whereIn('id', $categories)->orderBy('name', 'asc')->get();
        }
        else{
            session()->flash('error', __('portal.No Business Package Found for you account! Contact Admin.'));
            return redirect()->back();
        }
        $eCart = ECart::where(['business_id' => auth()->user()->business_id , 'rfq_type' => 0])->orderByDesc('created_at')->get();

        // Remaining RFQ count
        $rfq = EOrders::where('business_id', auth()->user()->business_id)->whereDate('created_at', \Carbon\Carbon::today())->count();
        $business_package = BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();

        $latest_rfq = ECart::latest()->where(['business_id' => auth()->user()->business_id, 'rfq_type' => 0])->first();
        $package = Package::where('id', $business_package->package_id)->first();

        if ($business_package->package_id == 1 || $business_package->package_id == 2)
        {
            $rfqCount = $package->rfq_per_day - $rfq;
        }
        else{
            $rfqCount = null;
        }

        /* Below code added to redirect back if Requisition limit for day is reached Added because h-screen issue in App.css blade */
        if ($rfqCount <= 0 && $business_package->package_id != 3 && $business_package->package_id != 4)
        {
            session()->flash('error', __('portal.Your have reached daily requisition generate limit.'));
            return redirect()->route('rfqView');
        }

        return view('RFQ.singleCategory.create', compact('parentCategories','eCart','rfqCount','latest_rfq'));
    }

    /* Below View is not in use because it has been added in RFQ history view*/
    public function view()
    {
        return view('RFQ.view');
    }

    public function deleteCartItem(Request $request): RedirectResponse
    {
        $eCart = ECart::findOrFail(decrypt($request->id));
        if(!is_null($eCart->file_path)) {
            $attachment = str_replace('/storage', '', $eCart->file_path);
            Storage::delete('/public/'. $attachment);
        }
        $eCart->delete();
        session()->flash('message', __('portal.Item successfully deleted.'));
        return back();
    }

}
