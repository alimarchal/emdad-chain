<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $business = Business::where('user_id', auth()->user()->id)->first();
//        dd($business);
        if ($business === null) {
            $parentCategories = Category::where('parent_id', 0)->get();
            return view('business.create', compact('parentCategories'));
        } else {
            return redirect()->route('business.show', $business->id);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $exp = explode(', ', $request->category_number);
        $implode = implode(',', $exp);
        $request->merge(['category_number' => $implode]);

        if ($request->has('chamber_reg_path_1')) {
            $path = $request->file('chamber_reg_path_1')->store('', 'public');
            $request->merge(['profile_photo_path' => $path]);
        }
        if ($request->has('vat_reg_certificate_path_2')) {
            $path = $request->file('vat_reg_certificate_path_2')->store('', 'public');
            $request->merge(['profile_photo_path' => $path]);
        }
        $business = Business::create($request->all());
        $user = User::find($business->user_id);
        $user->business_id = $business->id;
        $user->save();
        session()->flash('message', 'Business information successfully saved.');
        if ($user->registration_type == "Contracts")
        {
            return redirect()->route('businessWarehouse.create');
        } else {
            return redirect()->route('businessFinanceDetail.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Business $business
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
        $cats = explode(',', $business->category_number);
//        $category = [];
//        foreach($cats as $c)
//        {
//            $cate = Category::find($c)
//        }
//        dd($category);
        return view('business.show', compact('business'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Business $business
     * @return \Illuminate\Http\Response
     */
    public function edit(Business $business)
    {
        $parentCategories = Category::where('parent_id', 0)->get();
        return view('business.edit', compact('parentCategories', 'business'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Business $business
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {
        if ($request->category_number === null) {
            $array = $request->all();
            unset($array["category_number"]);
            if ($request->has('chamber_reg_path_1')) {
                $path = $request->file('chamber_reg_path_1')->store('', 'public');
                $request->merge(['profile_photo_path' => $path]);
            }
            if ($request->has('vat_reg_certificate_path_2')) {
                $path = $request->file('vat_reg_certificate_path_2')->store('', 'public');
                $request->merge(['profile_photo_path' => $path]);
            }
            $business->update($array);
            session()->flash('message', 'Business information successfully updated.');
            return redirect()->route('business.edit', $business->id);
        }
        else {
            $exp = explode(', ', $request->category_number);
            $implode = implode(',', $exp);
            $request->merge(['category_number' => $implode]);

            if ($request->has('chamber_reg_path_1')) {
                $path = $request->file('chamber_reg_path_1')->store('', 'public');
                $request->merge(['profile_photo_path' => $path]);
            }
            if ($request->has('vat_reg_certificate_path_2')) {
                $path = $request->file('vat_reg_certificate_path_2')->store('', 'public');
                $request->merge(['profile_photo_path' => $path]);
            }
            $business->update($request->all());
            session()->flash('message', 'Business information successfully updated.');
            return redirect()->route('business.edit', $business->id);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Business $business
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business)
    {
        //
    }
}
