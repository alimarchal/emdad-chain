<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ECart;
use App\Models\User;
use Illuminate\Http\Request;

class ECartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);
        $parentCategories = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
        $childs = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
        $eCart = ECart::where('user_id', auth()->user()->id)->where('business_id', auth()->user()->business_id)->get();
        return view('RFQ.index', compact('parentCategories', 'childs', 'user', 'eCart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->has('file_path_1')) {
            $path = $request->file('file_path_1')->store('', 'public');
            $request->merge(['file_path' => $path]);
        }
        $request->merge(['item_code' => $request->item_name]);
        $request->merge(['status' => 'pending']);
        $request->merge(['item_name' => Category::where('id', $request->item_code)->first()->name]);
        $eCart = ECart::create($request->all());
        session()->flash('message', 'RFP successfully created.');

        return redirect('RFQ/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ECart  $eCart
     * @return \Illuminate\Http\Response
     */
    public function show(ECart $eCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ECart  $eCart
     * @return \Illuminate\Http\Response
     */
    public function edit(ECart $eCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ECart  $eCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ECart $eCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ECart  $eCart
     * @return \Illuminate\Http\Response
     */
    public function destroy(ECart $RFQCart)
    {
        session()->flash('message', 'Item successfully deleted.');
        $RFQCart->delete();
        return back();
    }
}
