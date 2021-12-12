<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ECart;
use App\Models\EOrders;
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

    /* Copying previous Multiple RFQ to multiple cart */
    public function deleteAndInsert($eOrderID)
    {
        ECart::where(['business_id' => auth()->user()->business_id, 'rfq_type' => 1])->delete();
        $eOrderID = EOrders::where('id', decrypt($eOrderID))->first();
        foreach ($eOrderID->OrderItems as $item)
        {
            $data = [
                'business_id' => $item->business_id,
                'user_id' => $item->user_id,
                'company_name_check' => $item->company_name_check,
                'item_code' => $item->item_code,
                'item_name' => $item->item_name,
                'description' => $item->description,
                'unit_of_measurement' => $item->unit_of_measurement,
                'size' => $item->size,
                'quantity' => $item->quantity,
                'brand' => $item->brand,
                'last_price' => $item->last_price,
                'remarks' => $item->remarks,
                'delivery_period' => $item->delivery_period,
                'file_path' => $item->file_path,
                'payment_mode' => $item->payment_mode,
                'required_sample' => $item->required_sample,
                'warehouse_id' => $item->warehouse_id,
                'rfq_type' => $item->rfq_type,
                'status' => 'pending',
            ];
            ECart::create($data);
        }
        session()->flash('message', __('portal.Requisition successfully copied to cart.'));
        return redirect()->route('RFQ.create');
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

    /* Copying previous Single RFQ to single cart */
    public function singleDeleteAndInsert($eOrderID)
    {
        ECart::where(['business_id' => auth()->user()->business_id, 'rfq_type' => 0])->delete();
        $eOrderID = EOrders::where('id', decrypt($eOrderID))->first();
        foreach ($eOrderID->OrderItems as $item)
        {
            $data = [
                'business_id' => $item->business_id,
                'user_id' => $item->user_id,
                'company_name_check' => $item->company_name_check,
                'item_code' => $item->item_code,
                'item_name' => $item->item_name,
                'description' => $item->description,
                'unit_of_measurement' => $item->unit_of_measurement,
                'size' => $item->size,
                'quantity' => $item->quantity,
                'brand' => $item->brand,
                'last_price' => $item->last_price,
                'remarks' => $item->remarks,
                'delivery_period' => $item->delivery_period,
                'file_path' => $item->file_path,
                'payment_mode' => $item->payment_mode,
                'required_sample' => $item->required_sample,
                'warehouse_id' => $item->warehouse_id,
                'rfq_type' => $item->rfq_type,
                'status' => 'pending',
            ];
            ECart::create($data);
        }
        session()->flash('message', __('portal.Requisition successfully copied to cart.'));
        return redirect()->route('create_single_rfq');
    }

}
