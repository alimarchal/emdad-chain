<?php

namespace App\Http\Controllers;

use App\Models\PackagingSolution;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PackagingSolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packagingSolution = QueryBuilder::for(PackagingSolution::class)
//            ->allowedFilters(['business_name', 'vat_reg_certificate_number', 'phone'])
            ->where('user_id', auth()->user()->id)
            ->get();
        return view('logistic.packaging.index',compact('packagingSolution'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::find(auth()->user()->id);
        if ($user->packaging_solution == 1) {
            return view('logistic.packaging.create');
        } else {
            session()->flash('error', 'Please enable packaging solution before creating your solution.');
            return redirect()->route('logistics.setting');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'logistics_businesse_id' => 'required',
            'box_quantity_pieces' => 'required',
            'weight_piece' => 'required',
            'forklift' => 'required',
            'length' => 'required',
            'width' => 'required',
            'height' => 'required',
            'printing' => 'required|boolean',
            'printing_design_1' => 'exclude_if:printing,false|required|mimes:jpeg,jpg,png,JPEG,JPG,PNG',
            'commodity_type' => 'required',
            'commodity_information' => 'required',
            'msds_1' => 'exclude_if:printing,false|required|mimes:jpeg,jpg,png,JPEG,JPG,PNG',
            'msds_information' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
        ]);

        $request->merge(['user_id' => auth()->user()->id]);
        $request->merge(['logistics_businesse_id' => auth()->user()->logistics_business_id]);

        if ($request->has('printing_design_1')) {
            $path = $request->file('printing_design_1')->store('', 'public');
            $request->merge(['printing_design' => $path]);
        }
        if ($request->has('msds_1')) {
            $path = $request->file('msds_1')->store('', 'public');
            $request->merge(['msds' => $path]);
        }

        $packagingSolution = PackagingSolution::create($request->all());
        session()->flash('message', 'Packaging Solution created successfully.');
        return redirect()->route('packagingSolution.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackagingSolution  $packagingSolution
     * @return \Illuminate\Http\Response
     */
    public function show(PackagingSolution $packagingSolution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackagingSolution  $packagingSolution
     * @return \Illuminate\Http\Response
     */
    public function edit(PackagingSolution $packagingSolution)
    {
        return view('logistic.packaging.edit', compact('packagingSolution'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PackagingSolution  $packagingSolution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackagingSolution $packagingSolution)
    {
        $request->validate([
            'user_id' => 'required',
            'logistics_businesse_id' => 'required',
            'box_quantity_pieces' => 'required',
            'weight_piece' => 'required',
            'forklift' => 'required',
            'length' => 'required',
            'width' => 'required',
            'height' => 'required',
            'printing' => 'required|boolean',
            'printing_design_1' => 'exclude_if:printing,false|required|mimes:jpeg,jpg,png,JPEG,JPG,PNG',
            'commodity_type' => 'required',
            'commodity_information' => 'required',
            'msds_1' => 'exclude_if:printing,false|required|mimes:jpeg,jpg,png,JPEG,JPG,PNG',
            'msds_information' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
        ]);

        $request->merge(['user_id' => auth()->user()->id]);
        $request->merge(['logistics_businesse_id' => auth()->user()->logistics_business_id]);

        if ($request->has('printing_design_1')) {
            $path = $request->file('printing_design_1')->store('', 'public');
            $request->merge(['printing_design' => $path]);
        }
        if ($request->has('msds_1')) {
            $path = $request->file('msds_1')->store('', 'public');
            $request->merge(['msds' => $path]);
        }

        $packagingSolution->update($request->all());
        session()->flash('message', 'Packaging info successfully updated...');
        return redirect()->route('packagingSolution.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackagingSolution  $packagingSolution
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackagingSolution $packagingSolution)
    {
        //
    }
}
