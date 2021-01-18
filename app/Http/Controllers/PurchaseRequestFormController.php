<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use App\Models\POInfo;
use App\Models\PurchaseRequestForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseRequestFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rfq = PurchaseRequestForm::where('business_id', Auth::user()->business_id)->get();
        return view('RFQ.index', compact('rfq'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::findOrFail(auth()->user()->id);
        $parentCategories = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
        $childs = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
        return view('RFQ.create', compact('parentCategories', 'childs', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('file_path_1')) {
            $path = $request->file('file_path_1')->store('', 'public');
            $request->merge(['file_path' => $path]);
        }
        $request->merge(['item_code' => $request->item_name]);
        $request->merge(['item_name' => Category::find($request->item_name)->first()->name]);
        $rfq = PurchaseRequestForm::create($request->all());
        session()->flash('message', 'RFP successfully created.');
        return redirect()->route('RFQ.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\PurchaseRequestForm $purchaseRequestForm
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseRequestForm $purchaseRequestForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\PurchaseRequestForm $purchaseRequestForm
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseRequestForm $purchaseRequestForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PurchaseRequestForm $purchaseRequestForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseRequestForm $purchaseRequestForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\PurchaseRequestForm $purchaseRequestForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseRequestForm $purchaseRequestForm)
    {
        //
    }
}
