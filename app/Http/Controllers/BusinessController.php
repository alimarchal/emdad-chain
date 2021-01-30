<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Business;
use App\Models\BusinessCategory;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Auth;
class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('status')) { 
            // dd($request->all());
            $businesss = new Business();
            if ($request->input('status')) {
                $businesss = $businesss->where('status',$request->status);
         
            }
            $businesses = $businesss->get();
            return view('business.index',compact('businesses'));
        }   
        if($request->has('changestatus')) { 
            $businesss = new Business();
            if ($request->input('changestatus')) {
                $businesss = Business::where('id', $request->changestatus)->update(array('status' => 'Approved'));
                $usid = Business::find($request->changestatus)->user_id;
                $businesss = User::where('id', $usid)->update(array('status' => 'Approved'));


            }
            return redirect()->route('business.index','status=Approved');
        } 

        if($request->has('rejectstatus')) { 
            $businesss = new Business();
            if ($request->input('rejectstatus')) {
                $businesss = Business::where('id', $request->rejectstatus)->update(array('status' => 'Rejected')); 
                $usid = Business::find($request->rejectstatus)->user_id;
                $businesss = User::where('id', $usid)->update(array('status' => 'Rejected'));               
            }
            return redirect()->route('business.index','status=Rejected');

        } 
        if($request->has('/')) { 
            $businesss = new Business();
            if ($request->input('rejectstatus')) {
                $businesss = Business::where('id', $request->rejectstatus)->update(array('status' => 'Rejected'));                
            }
            return redirect()->route('business.index','status=Rejected');

        } 

        else {
          $businesses = Business::all();

          return view('business.index',compact('businesses'));
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
            $parentCategories = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
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
        $comma_separated = implode(",", $request->category);
        $request->merge(['category_number' => $comma_separated]);


        if ($request->has('chamber_reg_path_1')) {
            $path = $request->file('chamber_reg_path_1')->store('', 'public');
            $request->merge(['profile_photo_path' => $path]);
        }
        if ($request->has('vat_reg_certificate_path_2')) {
            $path = $request->file('vat_reg_certificate_path_2')->store('', 'public');
            $request->merge(['profile_photo_path' => $path]);
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

    // $business = User::where('registration_type', '!=', '');

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

        if ($request->category === null) {
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
        } else {

            $comma_separated = implode(",", $request->category);
            $request->merge(['category_number' => $comma_separated]);

            if ($request->has('chamber_reg_path_1')) {
                $path = $request->file('chamber_reg_path_1')->store('', 'public');
                $request->merge(['profile_photo_path' => $path]);
            }
            if ($request->has('vat_reg_certificate_path_2')) {
                $path = $request->file('vat_reg_certificate_path_2')->store('', 'public');
                $request->merge(['profile_photo_path' => $path]);
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


}
