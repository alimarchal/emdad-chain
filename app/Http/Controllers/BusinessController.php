<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use App\Models\Business;
use App\Models\BusinessCategory;
use App\Models\BusinessPackage;
use App\Models\BusinessUpdateCertificate;
use App\Models\Category;
use App\Models\IreCommission;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
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
        }
        elseif (\auth()->user()->hasRole('Sales Specialist'))
        {
            if ($request->has('status')) {
                if ($request->status == 1) {
                    $businesses = Business::where('status', 3)->orderBy('id','desc')->paginate(10);
                    return view('business.saleSpecialist.incompleteMarketing', compact('businesses'));
                } elseif ($request->status == 2) {
                    $users = User::where('usertype', 'CEO')->where('business_id', null)->orderBy('id','desc')->paginate(10);

                    // Check for Sales Specialist if they checked/saw incomplete businesses
                    $userBusinessCheck = UserLog::latest('login_at')->where(['user_id' => \auth()->id()])->first();
                    if (isset($userBusinessCheck) && $userBusinessCheck->business_inspect_check == 0)
                    {
                        $userBusinessCheck->update(['business_inspect_check' => 1]);
                        $userBusinessCheck->save();
                    }

                    return view('business.saleSpecialist.incompleteMarketing', compact('users'));
                }
            }

            $businesses = Business::where('status', 3)->orderBy('id','desc')->paginate(10);
            return view('business.saleSpecialist.incompleteMarketing', compact('businesses'));
        }
        elseif (\auth()->user()->hasRole('Legal Approval Officer 1') || \auth()->user()->hasRole('Finance Officer 1') || \auth()->user()->hasRole('SC Supervisor'))
        {
            if ($request->has('status')) {
                if ($request->status == 3) {
                    $status = $request->status;
                    $businesses = Business::where('status', 3)->orderBy('id','desc')->paginate(10);
                    return view('business.legalOfficer.legalBusinessesInfo', compact('businesses', 'status'));
                } elseif ($request->status == 1) {
                    $status = $request->status;
                    $businesses = Business::where('status', 1)->orderBy('id','desc')->paginate(10);

                    // Check for Emdad users if they checked/saw pending businesses
                    $userBusinessCheck = UserLog::latest('login_at')->where(['user_id' => \auth()->id()])->first();
                    if (isset($userBusinessCheck) && $userBusinessCheck->business_inspect_check == 0)
                    {
                        $userBusinessCheck->update(['business_inspect_check' => 1]);
                        $userBusinessCheck->save();
                    }
//                    $users = User::where('usertype', 'CEO')->where('business_id', null)->orderBy('id','desc')->paginate(10);
                    return view('business.legalOfficer.legalBusinessesInfo', compact('businesses', 'status'));
                }
            }

            $businesses = Business::where('status', 3)->orderBy('id','desc')->paginate(10);
            return view('business.legalOfficer.legalBusinessesInfo', compact('businesses'));
        }
        elseif (\auth()->user()->hasRole('IT Admin'))
        {
            if ($request->has('status')) {
                if ($request->status == 3) {
                    $status = $request->status;
                    $businesses = Business::where('status', 3)->orderBy('id','desc')->paginate(10);
                    return view('business.itAdmin.business', compact('businesses', 'status'));
                } elseif ($request->status == 1) {
                    $status = $request->status;
                    $businesses = Business::where('status', 1)->orderBy('id','desc')->paginate(10);

                    // Check for IT Admin if he checked/saw pending businesses
                    $userBusinessCheck = UserLog::latest('login_at')->where(['user_id' => \auth()->id()])->first();
                    if (isset($userBusinessCheck) && $userBusinessCheck->business_inspect_check == 0)
                    {
                        $userBusinessCheck->update(['business_inspect_check' => 1]);
                        $userBusinessCheck->save();
                    }

//                    $users = User::where('usertype', 'CEO')->where('business_id', null)->orderBy('id','desc')->paginate(10);
                    return view('business.itAdmin.business', compact('businesses', 'status'));
                }
            }

            $businesses = Business::where('status', 3)->orderBy('id','desc')->paginate(10);
            return view('business.itAdmin.business', compact('businesses'));
        }
        else {
            $businesses = Business::where('user_id', auth()->user()->id)->paginate(10);
            return view('business.index', compact('businesses'));
        }
    }

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

    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required',
            'business_name' => 'required',
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
            'longitude' => 'required',
            'latitude' => 'required',
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

    public function show(Business $business)
    {
        $cats = explode(',', $business->category_number);
        return view('business.show', compact('business'));
    }

    public function edit(Business $business)
    {
//        $parentCategories = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
//        $categories = explode(',', auth()->user()->business_package->categories);
        $businessPackage = BusinessPackage::where('user_id', \auth()->id())->first();
        $categories = explode(',',$businessPackage->categories);
        $parentCategories = Category::whereIn('id', $categories)->orderBy('name', 'asc')->get();
        return view('business.edit', compact('parentCategories', 'business','categories'));
    }

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
        }
        elseif ($request->status_id == 4) {
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

    public function businessLegalFinanceStatus(Request $request)
    {
        $business = Business::where('id', $request->business_id)->first();

        if (\auth()->user()->hasRole('Legal Approval Officer 1'))
        {
            if ($request->status_id == 3) {
                $business->update([
                    'legal_status' => $request->status_id,
                ]);

            } elseif ($request->status_id == 4) {
                $business->update([
                    'legal_status' => $request->status_id,
                ]);
            } else {
                return redirect()->back()->with('message', 'Something went wrong');
            }
        }
        elseif (\auth()->user()->hasRole('Finance Officer 1'))
        {
            if ($request->status_id == 3) {
                $business->update([
                    'finance_status' => $request->status_id,
                ]);

            } elseif ($request->status_id == 4) {
                $business->update([
                    'finance_status' => $request->status_id,
                ]);
            } else {
                return redirect()->back()->with('message', 'Something went wrong');
            }
        }
        elseif (\auth()->user()->hasRole('SC Supervisor'))
        {
            if ($request->status_id == 3) {
                $business->update([
                    'sc_supervisor_status' => $request->status_id,
                ]);

            } elseif ($request->status_id == 4) {
                $business->update([
                    'sc_supervisor_status' => $request->status_id,
                ]);
            } else {
                return redirect()->back()->with('message', 'Something went wrong');
            }
        }

        return redirect()->back()->with('message', 'Business response send');
    }

    public function suppliers()
    {
        $suppliers = User::with('business')->where(['added_by_userId' => \auth()->id(), 'added_by' => 1])->get();

        return view('business.supplier', compact('suppliers'));
    }

    public function buyers()
    {
        $buyers = User::with('business')->where(['added_by_userId' => \auth()->id(), 'added_by' => 2])->get();

        return view('business.buyer', compact('buyers'));
    }

    public function incomplete()
    {
        $incompleteBusiness = User::where('email_verified_at', null)->where('usertype', 'CEO')->where('business_id', null)->paginate(10);
//        $incompleteBusiness = User::where(['usertype' => 'CEO','business_id' => null])->orWhere('email_verified_at', null)->paginate(10);

        return view('business.incomplete', compact('incompleteBusiness'));
    }

    /* Certificate update functions for CEO start */
    public function certificateView()
    {
        $business = Business::where('id', \auth()->user()->business_id)->first();

        return view('business.certificate.user.edit', compact('business'));
    }

    public function certificateUpdate(Request $request)
    {
        if ($request->has('vat_reg_certificate_path_1') || $request->has('chamber_reg_path_1') || $request->has('business_photo_url_1'))
        {
            if ($request->has('vat_reg_certificate_path_1')) {
                $path = $request->file('vat_reg_certificate_path_1')->store('', 'public');
                $request->merge(['vat_reg_certificate_path' => $path]);
            }

            if ($request->has('chamber_reg_path_1')) {
                $pathVat = $request->file('chamber_reg_path_1')->store('', 'public');
                $request->merge(['chamber_reg_path' => $pathVat]);
            }

            if ($request->has('business_photo_url_1')) {
                $pathLogo = $request->file('business_photo_url_1')->store('', 'public');
                $request->merge(['business_photo_url' => $pathLogo]);
            }

            BusinessUpdateCertificate::updateOrCreate(
                ['business_id' =>  \auth()->user()->business_id],
                [
                'business_id' =>  \auth()->user()->business_id,
                'vat_reg_certificate_path' =>  $request->vat_reg_certificate_path,
                'chamber_reg_path' =>  $request->chamber_reg_path,
                'business_photo_url' =>  $request->business_photo_url,

            ]);
            session()->flash('message', 'Respective Certificate Upload. Will be updated once emdad approves');
        }

        session()->flash('error', 'No Certificates were uploaded for updating');
        return redirect()->route('business.show', \auth()->user()->business_id);
    }

    /* Certificate update functions for CEO end */

    /* Certificate update functions for Emdad Users start */
    public function certificates()
    {
        $businessCertificates = BusinessUpdateCertificate::with('business')->get();

        return view('business.certificate.emdadUser.index', compact('businessCertificates'));
    }

    public function certificateShow($id)
    {
        $businessCertificate = BusinessUpdateCertificate::with('business')->where('id', $id)->first();

        return view('business.certificate.emdadUser.show', compact('businessCertificate'));
    }

    // Update status function for legal office status update for certificates
    public function certificateStatusUpdate($id, $status)
    {
        BusinessUpdateCertificate::where('id', $id)->update(['legal_officer_status' => $status]);

        session()->flash('message', 'Status Updated successfully!!');
        return redirect()->route('certificates');
    }

    // Update status function for IT Admin to update certificates
    public function certificateBusinessStatusUpdate($id)
    {
        $businessCertificates = BusinessUpdateCertificate::where('id', $id)->first();

        $business = Business::where('id', $businessCertificates->business_id)->first();

        if($businessCertificates->vat_reg_certificate_path != null)
        {
            $business->vat_reg_certificate_path = $businessCertificates->vat_reg_certificate_path;
            $business->save();
        }
        if($businessCertificates->chamber_reg_path != null)
        {
            $business->chamber_reg_path = $businessCertificates->chamber_reg_path;
            $business->save();
        }
        if($businessCertificates->business_photo_url != null)
        {
            $business->business_photo_url = $businessCertificates->business_photo_url;
            $business->save();
        }

        $businessCertificates->delete();

        session()->flash('message', 'Updated certificates successfully!!');
        return redirect()->route('certificates');
    }

    /* Certificate update functions for Emdad Users end */
}
