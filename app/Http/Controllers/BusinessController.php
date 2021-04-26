<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use App\Models\Business;
use App\Models\BusinessCategory;
use App\Models\BusinessPackage;
use App\Models\Category;
use App\Models\IreCommission;
use App\Models\User;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (\auth()->user()->hasRole('SuperAdmin')) {
            if ($request->has('status')) {
                if ($request->status == 1) {
                    $businesses = Business::where('status', 1)->paginate(10);
                    return view('business.index', compact('businesses'));
                } elseif ($request->status == 3) {
                    $businesses = Business::where('status', 3)->paginate(10);
                    return view('business.index', compact('businesses'));
                } elseif ($request->status == 4) {
                    $businesses = Business::where('status', 4)->paginate(10);
                    return view('business.index', compact('businesses'));
                }
            }

            $businesses = Business::paginate(10);
            return view('business.index', compact('businesses'));
        } else {
            $businesses = Business::where('user_id', auth()->user()->id)->paginate(10);
            return view('business.index', compact('businesses'));
        }
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
            $businessPackage = BusinessPackage::where('user_id', \auth()->id())->first();
            $categories = explode(',',$businessPackage->categories);
            $parentCategories = Category::whereIn('id', $categories)->orderBy('name', 'asc')->get();
            return view('business.create', compact('parentCategories', 'categories'));
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

        $request->validate([
            'user_id' => 'required',
            'business_name' => 'required',
            'num_of_warehouse' => 'required',
            'business_photo_url_1' => 'required|mimes:jpeg,jpg,png,gif,csv,txt,pdf',
            'category' => 'required',
            'business_type' => 'required',
            'chamber_reg_number' => 'required',
            'chamber_reg_path_1' => 'required|mimes:jpeg,jpg,png,gif,csv,txt,pdf',
            'vat_reg_certificate_number' => 'required',
            'vat_reg_certificate_path_1' => 'required|mimes:jpeg,jpg,png,gif,csv,txt,pdf',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'business_email' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'iban' => 'required',
            'bank_name' => 'required',
            'policy_procedure' => 'required',
//            'address' => 'required',
        ]);
        $comma_separated = implode(",", $request->category);
        $request->merge(['category_number' => $comma_separated]);
        if ($request->has('chamber_reg_path_1')) {
            $path = $request->file('chamber_reg_path_1')->store('', 'public');
            $request->merge(['chamber_reg_path' => $path]);
        }
        if ($request->has('vat_reg_certificate_path_1')) {
            $path = $request->file('vat_reg_certificate_path_1')->store('', 'public');
            $request->merge(['vat_reg_certificate_path' => $path]);
        }
        if ($request->has('business_photo_url_1')) {
            $path = $request->file('business_photo_url_1')->store('', 'public');
            $request->merge(['business_photo_url' => $path]);
        }

        $business = Business::create($request->all());
        foreach ($request->category as $category) {
            BusinessCategory::create([
                'business_id' => $business->id,
                'category_number' => $category,
            ]);
        }
        $user = User::find($business->user_id);
        $user->business_id = $business->id;
        $user->save();

        $businessPackage = BusinessPackage::where('user_id', $business->user_id)->first();
        $businessPackage->business_id = $business->id;
        $businessPackage->save();

        session()->flash('message', 'Business information successfully saved.');
        return redirect()->route('businessWarehouse.create');
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
        $parentCategories = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
        $categories = explode(',', auth()->user()->business_package->categories);
        return view('business.edit', compact('parentCategories', 'business','categories'));
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

        if ($request->category === null) {
            $array = $request->all();
            unset($array["category_number"]);
            if ($request->has('chamber_reg_path')) {
                $path = $request->file('chamber_reg_path')->store('', 'public');
                $request->merge(['chamber_reg_path' => $path]);
            }
            if ($request->has('vat_reg_certificate_path')) {
                $path = $request->file('vat_reg_certificate_path')->store('', 'public');
                $request->merge(['vat_reg_certificate_path' => $path]);
            }
            if ($request->has('business_photo_url')) {
                $path = $request->file('business_photo_url')->store('', 'public');
                $request->merge(['business_photo_url' => $path]);
            }
            $business->update($array);
            session()->flash('message', 'Business information successfully updated.');
            return redirect()->route('business.edit', $business->id);
        } else {

            $comma_separated = implode(",", $request->category);
            $request->merge(['category_number' => $comma_separated]);

            if ($request->has('chamber_reg_path_1')) {
                $path = $request->file('chamber_reg_path_1')->store('', 'public');
                $request->merge(['chamber_reg_path' => $path]);
            }
            if ($request->has('vat_reg_certificate_path_1')) {
                $path = $request->file('vat_reg_certificate_path_1')->store('', 'public');
                $request->merge(['vat_reg_certificate_path' => $path]);
            }
            if ($request->has('business_photo_url_1')) {
                $path = $request->file('business_photo_url_1')->store('', 'public');
                $request->merge(['business_photo_url' => $path]);
            }
            $business->update($request->all());

            $business_category = BusinessCategory::where('business_id', $business->id)->get();
            foreach ($business_category as $biz) {
                $biz = BusinessCategory::find($biz->id);
                $biz->delete();
            }

            foreach ($request->category as $category) {
                BusinessCategory::create([
                    'business_id' => $business->id,
                    'category_number' => $category,
                ]);
            }
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

    public function accountStatus(Request $request)
    {
        $business = Business::where('id', $request->business_id)->first();
        $user = User::where('id', $business->user_id)->first();
        $ireCommission = IreCommission::where('user_id', $user->id)->first();
        if ($request->status_id == 3) {
            $business->update([
                'status' => 3,
            ]);
            $user->update([
                'status' => 3,
                'is_active' => 1,
            ]);

            if (!empty($ireCommission)){
                if($user->registration_type == 'Buyer')
                {
                    $ireCommission->update([
                        'type' => 1,
                        'status' => 1,
                    ]);
                }
                elseif($user->registration_type == 'Supplier')
                {
                    $ireCommission->update([
                        'type' => 2,
                        'status' => 1,
                    ]);
                }
            }


            $user->notify(new \App\Notifications\BusinessApproved());
        } elseif ($request->status_id == 4) {
            $business->update([
                'status' => 4,
            ]);
            $user->update([
                'status' => 4,
                'is_active' => 1,
            ]);
            $ireCommission->update([
                'status' => 2,
            ]);
            $user->notify(new \App\Notifications\BusinessRejected());
        } else {
            return redirect()->back()->with('message', 'Something went wrong');
        }

        return redirect()->back()->with('message', 'Business status updated...');
    }

    public function incomplete()
    {
        $incompleteBusiness = User::where('email_verified_at', null)->where('usertype', 'CEO')->where('business_id', null)->paginate(10);

        return view('business.incomplete', compact('incompleteBusiness'));
    }
}
