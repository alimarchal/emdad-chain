<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ECart;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ECartController extends Controller
{
    public function index()
    {
        $parentCategories = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
        $childs = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
        $eCart = ECart::where(['business_id' => auth()->user()->business_id,  'rfq_type' => 1])->orderByDesc('created_at')->get();
        return view('RFQ.index', compact('parentCategories', 'childs', 'eCart'));
    }

    public function store(Request $request)
    {
        if ($request->has('file_path_1')) {
            $path = $request->file('file_path_1')->store('', 'public');
            $request->merge(['file_path' => $path]);
        }

        Validator::make($request->all(), [
            'delivery_period' => 'required',
        ],[
            'delivery_period.required' => __('portal.Please select a Delivery Period.')
        ])->validate();

        $request->merge(['delivery_period' => Carbon::parse($request->delivery_period)->format('Y-m-d')]);
        $request->merge(['item_code' => $request->item_name]);
        $request->merge(['status' => 'pending']);
        $request->merge(['item_name' => Category::where('id', $request->item_code)->first()->name]);
        $request->merge(['rfq_type' => 1]);
        ECart::create($request->all());
        session()->flash('message', __('portal.Requisition successfully added to cart.'));

        return redirect('RFQ/create');
    }

    public function destroy(ECart $RFQCart)
    {
        session()->flash('message', __('portal.Item successfully deleted.'));
        $RFQCart->delete();
        return back();
    }

    // used for change company name check
    public function companyCheck(Request $request)
    {
        $eCartItem = ECart::where('id', $request->rfqNo)->first();

        if (!$eCartItem)
        {
            return response()->json( ['status' => 0]);
        }

        ECart::where('id', $request->rfqNo)->update(['company_name_check' => $request->status]);

        return response()->json( ['status' => 1]);
    }

    /* For Single Category RFQ */

    public function single_cart_index()
    {
        $parentCategories = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
        $eCart = ECart::where(['business_id' => auth()->user()->business_id,  'rfq_type' => 0])->orderByDesc('created_at')->get();
        return view('RFQ.singleCategory.cart', compact('parentCategories',  'eCart'));
    }

    public function single_cart_store_rfq(Request $request)
    {
        Validator::make($request->all(), [
            'delivery_period' => 'required',
        ],[
            'delivery_period.required' => __('portal.Please select a Delivery Period.')
        ])->validate();

        if ($request->has('file_path_1')) {
            $path = $request->file('file_path_1')->store('', 'public');
            $request->merge(['file_path' => $path]);
        }
        $request->merge(['delivery_period' => Carbon::parse($request->delivery_period)->format('Y-m-d')]);
        $request->merge(['item_code' => $request->item_name]);
        $request->merge(['status' => 'pending']);
        $request->merge(['item_name' => Category::where('id', $request->item_code)->first()->name]);
        $request->merge(['rfq_type' => 0]);
        ECart::create($request->all());
        session()->flash('message', __('portal.Requisition successfully added to cart.'));

        return redirect()->route('create_single_rfq');
    }

    public function single_cart_destroy($id)
    {
        ECart::where('id', $id)->delete();
        session()->flash('message', __('portal.Item successfully deleted.'));
        return back();
    }

}
