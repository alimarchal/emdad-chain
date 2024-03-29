<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessCategory;
use App\Models\BusinessPackage;
use App\Models\BusinessUpdateCertificate;
use App\Models\Category;
use App\Models\IreCommission;
use App\Models\PackageManualPayment;
use App\Models\User;
use App\Models\UserLog;
use App\Notifications\BusinessApproved;
use App\Notifications\BusinessRejected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        if (\auth()->user()->hasRole('SuperAdmin')) {
            if ($request->has('status'))
            {
                if ($request->status == 1)
                {
                    $businesses = Business::where('status', 1)->orderByDesc('created_at')->paginate(10);
                    return view('business.index', compact('businesses'));
                }
                if ($request->status == 3)
                {
                    $businesses = Business::where('status', 3)->orderByDesc('created_at')->paginate(10);
                    return view('business.index', compact('businesses'));
                }
                if ($request->status == 4)
                {
                    $businesses = Business::where('status', 4)->orderByDesc('created_at')->paginate(10);
                    return view('business.index', compact('businesses'));
                }
            }

            $businesses = Business::orderByDesc('created_at')->paginate(10);
            return view('business.index', compact('businesses'));
        }
        elseif (\auth()->user()->hasRole('Sales Specialist')) {
            if ($request->has('status')) {
                if ($request->status == 1) /* 1 for complete businesses */ {
                    $businesses = Business::where('status', 3)->orderByDesc('created_at')->paginate(10);
                    return view('business.saleSpecialist.incompleteMarketing', compact('businesses'));
                }
                elseif ($request->status == 2) /* 2 for incomplete businesses */ {
                    $users = User::where('usertype', 'CEO')
                        ->where('business_id', null)
                        /* for incomplete business registration is_active is 0 and status is null. is_active is updated on business approval
                         or when business is rejected and status is updated to 1 when user submit details for approval. */
                        ->orWhere(function ($query){
                            $query->where(['status' => null, 'is_active' => 0]);
                        })
                        ->orderByDesc('created_at')
                        ->paginate(10);

                    // Check for Sales Specialist if they checked/saw incomplete businesses
                    $userBusinessCheck = UserLog::latest('login_at')->where(['user_id' => \auth()->id()])->first();
                    if (isset($userBusinessCheck) && $userBusinessCheck->business_inspect_check == 0) {
                        $userBusinessCheck->update(['business_inspect_check' => 1]);
                        $userBusinessCheck->save();
                    }

                    return view('business.saleSpecialist.incompleteMarketing', compact('users'));
                }
            }

            $businesses = Business::where('status', 3)->orderByDesc('created_at')->paginate(10);
            return view('business.saleSpecialist.incompleteMarketing', compact('businesses'));
        }
        elseif (\auth()->user()->hasRole('Legal Approval Officer 1') || \auth()->user()->hasRole('Finance Officer 1') || \auth()->user()->hasRole('SC Supervisor')) {
            if ($request->has('status')) {
                if ($request->status == 3) /* status 3 for completed businesses */ {
                    $status = $request->status;
                    $businesses = Business::where('status', 3)->orderByDesc( 'created_at')->paginate(10);
                    return view('business.legalOfficer.legalBusinessesInfo', compact('businesses', 'status'));
                }
                elseif ($request->status == 1) /* status 1 for pending businesses */ {
                    $status = $request->status;
                    $businesses = Business::where('status', 1)->orderByDesc( 'created_at')->paginate(10);

                    // Check for Emdad users if they checked/saw pending businesses
                    $userBusinessCheck = UserLog::latest('login_at')->where(['user_id' => \auth()->id()])->first();
                    if (isset($userBusinessCheck) && $userBusinessCheck->business_inspect_check == 0) {
                        $userBusinessCheck->update(['business_inspect_check' => 1]);
                        $userBusinessCheck->save();
                    }
//                    $users = User::where('usertype', 'CEO')->where('business_id', null)->orderBy('id','desc')->paginate(10);
                    return view('business.legalOfficer.legalBusinessesInfo', compact('businesses', 'status'));
                }
            }

            $businesses = Business::where('status', 3)->orderByDesc( 'created_at')->paginate(10);
            return view('business.legalOfficer.legalBusinessesInfo', compact('businesses'));
        }
        elseif (\auth()->user()->hasRole('SC Specialist')) {
            if ($request->has('status')) {
                if ($request->status == 3) /* 3 status for completed businesses */ {
                    $status = $request->status;
                    $businesses = Business::where('status', 3)->orderByDesc( 'created_at')->paginate(10);

                    return view('business.scSpecialist.info', compact('businesses', 'status'));
                }
                elseif ($request->status == 1) /* 1 status for pending businesses */ {
                    $status = $request->status;
                    $businesses = Business::where('status', 1)->orderByDesc( 'created_at')->paginate(10);

                    return view('business.scSpecialist.info', compact('businesses', 'status'));
                }
                elseif ($request->status == 2) /* 2 status for incomplete businesses */ {
                    $users = User::where('usertype', 'CEO')
                        ->where('business_id', null)
                        /* for incomplete business registration is_active is 0 and status is null. is_active is updated on business approval
                         or when business is rejected and status is updated to 1 when user submit details for approval. */
                        ->orWhere(function ($query){
                            $query->where(['status' => null, 'is_active' => 0]);
                        })
                        ->orderByDesc( 'created_at')
                        ->paginate(10);

                    return view('business.scSpecialist.info', compact('users'));
                }
            }

            $businesses = Business::where('status', 3)->orderByDesc( 'created_at')->paginate(10);
            return view('business.scSpecialist.info', compact('businesses'));
        }
        elseif (\auth()->user()->hasRole('IT Admin')) {
            if ($request->has('status')) {
                if ($request->status == 3) /* 3 status for completed businesses */ {
                    $status = $request->status;
                    $businesses = Business::where('status', 3)->orderByDesc( 'created_at')->paginate(10);
                    return view('business.itAdmin.business', compact('businesses', 'status'));
                }
                elseif ($request->status == 2) /* 2 status for incomplete businesses */ {
                    $users = User::where('usertype', 'CEO')
                        ->where('business_id', null)
                        /* for incomplete business registration is_active is 0 and status is null. is_active is updated on business approval
                         or when business is rejected and status is updated to 1 when user submit details for approval. */
                        ->orWhere(function ($query){
                            $query->where(['status' => null, 'is_active' => 0]);
                        })
                        ->orderByDesc( 'created_at')
                        ->paginate(10);

                    return view('business.itAdmin.business', compact('users'));
                }
                elseif ($request->status == 1) /* 1 status for pending businesses */ {
                    $status = $request->status;
                    $businesses = Business::where('status', 1)->orderByDesc( 'created_at')->paginate(10);

                    // Check for IT Admin if he checked/saw pending businesses
                    $userBusinessCheck = UserLog::latest('login_at')->where(['user_id' => \auth()->id()])->first();
                    if (isset($userBusinessCheck) && $userBusinessCheck->business_inspect_check == 0) {
                        $userBusinessCheck->update(['business_inspect_check' => 1]);
                        $userBusinessCheck->save();
                    }

//                    $users = User::where('usertype', 'CEO')->where('business_id', null)->orderBy('id','desc')->paginate(10);
                    return view('business.itAdmin.business', compact('businesses', 'status'));
                }
            }

            $businesses = Business::where('status', 3)->orderByDesc( 'created_at')->paginate(10);
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
        if ($business === null) {
            $businessPackage = BusinessPackage::where('user_id', \auth()->id())->first();
            $categories = explode(',', $businessPackage->categories);
            $parentCategories = Category::whereIn('id', $categories)->orderBy('name', 'asc')->get();
            return view('business.create', compact('parentCategories', 'categories'));
        } else {
            return redirect()->route('business.show', $business->id);
        }
    }

    public function store(Request $request)
    {
        if (\auth()->user()->registration_type == 'Buyer')
        {
            $request->validate([
                'user_id' => 'required',
                'business_name' => 'required',
                'nid_num' => 'required',
                'nid_photo_1' => 'required',
                'nid_exp_date' => 'required',
                'business_photo_url_1' => 'required|mimes:jpeg,jpg,png',
                'business_type' => 'required',
                'chamber_reg_number' => 'required',
                'chamber_reg_path_1' => 'required|mimes:jpeg,jpg,png',
                'vat_reg_certificate_number' => 'required',
                'vat_reg_certificate_path_1' => 'required|mimes:jpeg,jpg,png',
                'country' => 'required',
                'city' => 'required',
                'address' => 'required',
                'business_email' => 'required',
                'mobile' => 'required',
                'iban' => 'required',
                'longitude' => 'required',
                'latitude' => 'required',
                'bank_name' => 'required',
                'policy_procedure' => 'required',
//            'address' => 'required',
            ]);

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
            if ($request->has('nid_photo_1'))
            {
                $path = $request->file('nid_photo_1')->store('', 'public');
                User::where('id', \auth()->id())->update(['nid_photo' => $path]);
            }

            /* updating only the latest one */

        }
        else
        {
            $request->validate([
                'user_id' => 'required',
                'business_name' => 'required',
                'nid_num' => 'required',
                'nid_photo_1' => 'required',
                'nid_exp_date' => 'required',
                'business_photo_url_1' => 'required|mimes:jpeg,jpg,png',
                'category' => 'required',
                'business_type' => 'required',
                'chamber_reg_number' => 'required',
                'chamber_reg_path_1' => 'required|mimes:jpeg,jpg,png',
                'vat_reg_certificate_number' => 'required',
                'vat_reg_certificate_path_1' => 'required|mimes:jpeg,jpg,png',
                'country' => 'required',
                'city' => 'required',
                'address' => 'required',
                'business_email' => 'required',
                'mobile' => 'required',
                'iban' => 'required',
                'longitude' => 'required',
                'latitude' => 'required',
                'bank_name' => 'required',
                'policy_procedure' => 'required',
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
            if ($request->has('nid_photo_1'))
            {
                $path = $request->file('nid_photo_1')->store('', 'public');
                User::where('id', \auth()->id())->update(['nid_photo' => $path]);
            }
            foreach ($request->category as $category) {
                BusinessCategory::create([
                    'business_id' => $business->id,
                    'category_number' => $category,
                ]);
            }

            /* updating only the latest one */

        }
        $time = strtotime($request->nid_exp_date);
        $newformat = date('Y-m-d', $time);
        $nid_exp_date = $newformat;
        $user = User::find($business->user_id);
        $user->business_id = $business->id;
        $user->company_name = $business->business_name;
        $user->nid_exp_date = $nid_exp_date;
        $user->nid_num = $request->nid_num;
        $user->save();
        $manualPackage = PackageManualPayment::where(['user_id' => \auth()->id(), 'upgrade' => 0])->first();
        if (isset($manualPackage))
        {
            $manualPackage->update(['business_id' => \auth()->user()->business_id]);
        }
        $businessPackage = BusinessPackage::where('user_id', $business->user_id)->first();
        $businessPackage->business_id = $business->id;
        $businessPackage->save();

        session()->flash('message', __('portal.Business information successfully saved.'));
        return redirect()->route('businessWarehouse.create');
    }

    public function show(Business $business)
    {
        $business = $business::with('businessPackage')->firstWhere('id', \auth()->user()->business_id);
        return view('business.show', compact('business'));
    }

    public function edit(Business $business)
    {
        if (\auth()->user()->hasRole('SuperAdmin') || \auth()->user()->hasRole('SC Specialist')) {
            $businessPackage = BusinessPackage::where(['business_id' => $business->id, 'status' => 1])->first();
            $categories = explode(',', $businessPackage->categories);
            $parentCategories = Category::whereIn('id', $categories)->orderBy('name', 'asc')->get();

            /* Passing $businessPackage for calculating categories count in views/category/category/index */
            return view('business.edit', compact('parentCategories', 'business', 'categories', 'businessPackage'));
        }

        return redirect()->back();

        /* Commented below because User(CEO) cannot update Business Details */

        /*$businessPackage = BusinessPackage::where(['user_id' => \auth()->id(), 'status' => 1 ])->first();
        $categories = explode(',',$businessPackage->categories);
        $parentCategories = Category::whereIn('id', $categories)->orderBy('name', 'asc')->get();
        return view('business.edit', compact('parentCategories', 'business','categories'));*/
    }

    public function update(Request $request, Business $business)
    {
        /* Added condition because only SuperAdmin and SC Specialist can update Business Details */
        if (\auth()->user()->hasRole('SuperAdmin') || \auth()->user()->hasRole('SC Specialist')) {
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
                if ($request->has('nid_photo_1')) {
                    $path = $request->file('nid_photo_1')->store('', 'public');
                    User::where(['business_id' => $business->id, 'usertype' => 'CEO'])->update(['nid_photo' => $path]);
                }

                session()->flash('message', __('portal.Business information successfully updated.'));
                return redirect()->route('business.show', $business->id);
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
                if ($request->has('nid_photo_1')) {
                    $path = $request->file('nid_photo_1')->store('', 'public');
                    User::where(['business_id' => $business->id, 'usertype' => 'CEO'])->update(['nid_photo' => $path]);
                }

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

                session()->flash('message', __('portal.Business information successfully updated.'));
                return redirect()->route('business.show', $business->id);
            }
        }

        return redirect()->back();
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

            if (!empty($ireCommission)) {
                if ($user->registration_type == 'Buyer') {
                    $ireCommission->update([
                        'type' => 1,
                        'status' => 1,
                    ]);
                } elseif ($user->registration_type == 'Supplier') {
                    $ireCommission->update([
                        'type' => 2,
                        'status' => 1,
                    ]);
                }
            }
            $user->notify(new BusinessApproved());
        }
        elseif ($request->status_id == 4) {
            $business->update([
                'status' => 4,
            ]);
            $user->update([
                'status' => 4,
                'is_active' => 1,
            ]);
            if (isset($ireCommission)) {
                $ireCommission->update([
                    'status' => 2,
                ]);
            }
            $user->notify(new BusinessRejected());
        }
        else {
            return redirect()->back()->with('message', __('portal.Something went wrong.'));
        }

        return redirect()->back()->with('message', __('portal.Business status updated.'));
    }

    public function businessLegalFinanceStatus(Request $request)
    {
        $business = Business::where('id', $request->business_id)->first();

        if (\auth()->user()->hasRole('Legal Approval Officer 1')) {
            if ($request->status_id == 3) {
                $business->update([
                    'legal_status' => $request->status_id,
                ]);

            } elseif ($request->status_id == 4) {
                $business->update([
                    'legal_status' => $request->status_id,
                ]);
            } else {
                return redirect()->back()->with('message', __('portal.Something went wrong.'));
            }
        } elseif (\auth()->user()->hasRole('Finance Officer 1')) {
            if ($request->status_id == 3) {
                $business->update([
                    'finance_status' => $request->status_id,
                ]);

            } elseif ($request->status_id == 4) {
                $business->update([
                    'finance_status' => $request->status_id,
                ]);
            } else {
                return redirect()->back()->with('message', __('portal.Something went wrong.'));
            }
        } elseif (\auth()->user()->hasRole('SC Supervisor')) {
            if ($request->status_id == 3) {
                $business->update([
                    'sc_supervisor_status' => $request->status_id,
                ]);

            } elseif ($request->status_id == 4) {
                $business->update([
                    'sc_supervisor_status' => $request->status_id,
                ]);
            } else {
                return redirect()->back()->with('message', __('portal.Something went wrong.'));
            }
        }

        return redirect()->back()->with('message', __('portal.Business response send.'));
    }

    public function suppliers()
    {
        $suppliers = User::with('business')
            ->where(['added_by_userId' => \auth()->id(), 'added_by' => 1])
            ->where('usertype', '=', 'CEO')
            ->orderByDesc('created_at')
            ->get();

        return view('business.supplier', compact('suppliers'));
    }

    public function buyers()
    {
        $buyers = User::with('business')
            ->where(['added_by_userId' => \auth()->id(), 'added_by' => 2])
            ->where('usertype', '=', 'CEO')
            ->orderByDesc('created_at')
            ->get();

        return view('business.buyer', compact('buyers'));
    }

    public function incomplete()
    {
//        $incompleteBusiness = User::where('email_verified_at', null)->where('usertype', 'CEO')->where('business_id', null)->paginate(10);
        $incompleteBusiness = User::where('usertype', 'CEO')
            ->where('business_id', null)
            /* for incomplete business registration is_active is 0 and status is null. is_active is updated on business approval
             or when business is rejected and status is updated to 1 when user submit details for approval. */
            ->orWhere(function ($query){
                $query->where(['status' => null, 'is_active' => 0]);
            })
            ->orWhere(function ($query){
                $query->where(['email_verified_at' => null, 'is_active' => 0]);
            })
            ->orderByDesc('created_at')
            ->paginate(10);

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
        if ($request->has('vat_reg_certificate_path_1') || $request->has('chamber_reg_path_1') || $request->has('business_photo_url_1') || $request->has('nid_photo_1')) {
            if ($request->has('vat_reg_certificate_path_1')) {

                Validator::make($request->all(), [
                    'vat_reg_certificate_path_1' => 'required|mimes:jpeg,png,jpg',
                ], [
                    'vat_reg_certificate_path_1.mimes' => __('portal.VAT certificate must be an image (jpeg, jpg, png) type'),
                ])->validate();

                $path = $request->file('vat_reg_certificate_path_1')->store('', 'public');
                $request->merge(['vat_reg_certificate_path' => $path]);
            }

            if ($request->has('chamber_reg_path_1')) {

                Validator::make($request->all(), [
                    'chamber_reg_path_1' => 'required|mimes:jpeg,png,jpg',
                ], [
                    'chamber_reg_path_1.mimes' => __('portal.Commercial Registration certificate must be an image (jpeg, jpg, png) type'),
                ])->validate();

                $pathVat = $request->file('chamber_reg_path_1')->store('', 'public');
                $request->merge(['chamber_reg_path' => $pathVat]);
            }

            if ($request->has('business_photo_url_1')) {

                Validator::make($request->all(), [
                    'business_photo_url_1' => 'required|mimes:jpeg,png,jpg',
                ], [
                    'business_photo_url_1.mimes' => __('portal.Business Logo must be an image (jpeg, jpg, png) type'),
                ])->validate();

                $pathLogo = $request->file('business_photo_url_1')->store('', 'public');
                $request->merge(['business_photo_url' => $pathLogo]);
            }

            if ($request->has('nid_photo_1')) {

                Validator::make($request->all(), [
                    'nid_photo_1' => 'required|mimes:jpeg,png,jpg',
                ], [
                    'nid_photo_1.mimes' => __('portal.National ID Card Photo must be an image (jpeg, jpg, png) type'),
                ])->validate();

                $pathLogo = $request->file('nid_photo_1')->store('', 'public');
                $request->merge(['nid_photo' => $pathLogo]);
            }

            BusinessUpdateCertificate::updateOrCreate(
                ['business_id' => \auth()->user()->business_id],
                [
                    'business_id' => \auth()->user()->business_id,
                    'vat_reg_certificate_path' => $request->vat_reg_certificate_path,
                    'chamber_reg_path' => $request->chamber_reg_path,
                    'business_photo_url' => $request->business_photo_url,
                    'nid_photo' => $request->nid_photo,

                ]);
            session()->flash('message', __('portal.Respective Certificate Upload. Will be updated once emdad approves.'));
            return redirect()->route('business.show', \auth()->user()->business_id);
        }

        session()->flash('error', __('portal.No Certificates were uploaded for updating.'));
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

        session()->flash('message', __('portal.Status Updated successfully!'));
        return redirect()->route('certificates');
    }

    // Update status function for IT Admin to update certificates
    public function certificateBusinessStatusUpdate($id)
    {
        $businessCertificates = BusinessUpdateCertificate::where('id', $id)->first();

        $business = Business::where('id', $businessCertificates->business_id)->first();
        $user = User::where('business_id', $businessCertificates->business_id)->first();

        if ($businessCertificates->vat_reg_certificate_path != null) {
            $business->vat_reg_certificate_path = $businessCertificates->vat_reg_certificate_path;
            $business->save();
        }
        if ($businessCertificates->chamber_reg_path != null) {
            $business->chamber_reg_path = $businessCertificates->chamber_reg_path;
            $business->save();
        }
        if ($businessCertificates->business_photo_url != null) {
            $business->business_photo_url = $businessCertificates->business_photo_url;
            $business->save();
        }
        if ($businessCertificates->nid_photo != null) {
            $user->nid_photo = $businessCertificates->nid_photo;
            $user->save();
        }

        $businessCertificates->delete();

        session()->flash('message', __('portal.Updated certificates successfully!'));
        return redirect()->route('certificates');
    }

    /* Certificate update functions for Emdad Users end */

    /* Business show function for Admins */
    public function businessShow(Business $business)
    {
        $business = $business::with('businessPackage')->firstWhere('id', $business->id);
        return view('business.admins.businessViewByID', compact('business'));
    }
}
