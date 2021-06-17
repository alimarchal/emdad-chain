<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ECart;
use App\Models\User;
use Illuminate\Http\Request;

class ECartController extends Controller
{
    public function index()
    {
//        $user = User::findOrFail(auth()->user()->id);
//        $user = User::findOrFail(auth()->user()->id);
        $parentCategories = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
        $childs = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
//        $eCart = ECart::where('user_id', auth()->user()->id)->where('business_id', auth()->user()->business_id)->get();
        $eCart = ECart::where('business_id', auth()->user()->business_id)->get();
        return view('RFQ.index', compact('parentCategories', 'childs', 'eCart'));
    }

    public function store(Request $request)
    {
        if ($request->has('file_path_1')) {
            $path = $request->file('file_path_1')->store('', 'public');
            $request->merge(['file_path' => $path]);
        }
        $request->merge(['item_code' => $request->item_name]);
        $request->merge(['status' => 'pending']);
        $request->merge(['item_name' => Category::where('id', $request->item_code)->first()->name]);
        ECart::create($request->all());
        session()->flash('message', 'RFQ successfully created.');

        return redirect('RFQ/create');
    }

    public function destroy(ECart $RFQCart)
    {
        session()->flash('message', 'Item successfully deleted.');
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
}
