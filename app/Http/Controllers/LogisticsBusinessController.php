<?php

namespace App\Http\Controllers;

use App\Models\LogisticsBusiness;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\QueryBuilder\QueryBuilder;

class LogisticsBusinessController extends Controller
{
    use HasProfilePhoto;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logistic_business = QueryBuilder::for(LogisticsBusiness::class)
            ->allowedFilters(['business_name', 'vat_reg_certificate_number', 'phone'])
            ->where('user_id', auth()->user()->id)
            ->get();
        return view('logistic.business.index',compact('logistic_business'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::find(auth()->user()->id);
        if ($user->logistics_business_id == 0) {
            return view('logistic.business.create');
        } else {
            return redirect()->route('logistics.index', $user->logistics_business_id);
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
//        dd($request->all());
        $request->validate([
            'user_id' => 'required',
            'business_name' => 'required',
            'business_photo_url_1' => 'required|mimes:jpeg,jpg,png',
            'chamber_reg_number' => 'required',
            'chamber_reg_path_1' => 'required|mimes:jpeg,jpg,png',
            'vat_reg_certificate_number' => 'required',
            'vat_reg_certificate_path_1' => 'required|mimes:jpeg,jpg,png',
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

        $business = LogisticsBusiness::create($request->all());
        $user = User::find($business->user_id);
        $user->logistics_business_id = $business->id;
        $user->save();
        session()->flash('message', 'Business information successfully saved.');
        return redirect()->route('logistics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\LogisticsBusiness $logisticsBusiness
     * @return \Illuminate\Http\Response
     */
    public function show(LogisticsBusiness $logisticsBusiness)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\LogisticsBusiness $logisticsBusiness
     * @return \Illuminate\Http\Response
     */
    public function edit(LogisticsBusiness $logisticsBusiness)
    {
        return view('logistic.business.edit', compact('logisticsBusiness'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LogisticsBusiness $logisticsBusiness
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LogisticsBusiness $logisticsBusiness)
    {
        $request->validate([
            'user_id' => 'required',
            'business_name' => 'required',
            'business_photo_url_1' => 'required|mimes:jpeg,jpg,png',
            'chamber_reg_number' => 'required',
            'chamber_reg_path_1' => 'required|mimes:jpeg,jpg,png',
            'vat_reg_certificate_number' => 'required',
            'vat_reg_certificate_path_1' => 'required|mimes:jpeg,jpg,png',
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

        $logisticsBusiness->update($request->all());
        session()->flash('message', 'Business information successfully saved.');
        return redirect()->route('logistics.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\LogisticsBusiness $logisticsBusiness
     * @return \Illuminate\Http\Response
     */
    public function destroy(LogisticsBusiness $logisticsBusiness)
    {
        //
    }
}
