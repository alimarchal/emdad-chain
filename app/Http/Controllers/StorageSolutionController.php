<?php

namespace App\Http\Controllers;

use App\Models\StorageSolution;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class StorageSolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storageSolution = QueryBuilder::for(StorageSolution::class)
            ->allowedFilters(['temprature_ctrl', 'logistics_businesse_id'])
            ->where('user_id', auth()->user()->id)
            ->get();
        return view('logistic.storage_solution.index', compact('storageSolution'));
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
            return view('logistic.storage_solution.create');
        } else {
            session()->flash('error', 'Please enable packaging solution before creating your solution.');
            return redirect()->route('logistics.setting');
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
            'logistics_businesse_id' => 'required',
            'box_quantity_pieces' => 'required',
            'weight_piece' => 'required',
            'temprature_ctrl' => 'required',
            'temprature_ctrl_max' => 'required',
            'temprature_ctrl_min' => 'required',
            'length' => 'required',
            'width' => 'required',
            'height' => 'required',
            'per_day' => 'required|min:0',
            'per_week' => 'required|min:0',
            'month' => 'required|min:0',
            'quarter' => 'required|min:0',
            'half_year' => 'required|min:0',
            'one_year' => 'required|min:0',
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

        if ($request->has('msds_1')) {
            $path = $request->file('msds_1')->store('', 'public');
            $request->merge(['msds' => $path]);
        }

        $packagingSolution = StorageSolution::create($request->all());
        session()->flash('message', 'Storage Solution created successfully.');

        return redirect()->route('storageSolution.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\StorageSolution $storageSolution
     * @return \Illuminate\Http\Response
     */
    public function show(StorageSolution $storageSolution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\StorageSolution $storageSolution
     * @return \Illuminate\Http\Response
     */
    public function edit(StorageSolution $storageSolution)
    {

        return view('logistic.storage_solution.edit', compact('storageSolution'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StorageSolution $storageSolution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StorageSolution $storageSolution)
    {
        $request->validate([
            'user_id' => 'required',
            'logistics_businesse_id' => 'required',
            'box_quantity_pieces' => 'required',
            'weight_piece' => 'required',
            'temprature_ctrl' => 'required',
            'temprature_ctrl_max' => 'required',
            'temprature_ctrl_min' => 'required',
            'length' => 'required',
            'width' => 'required',
            'height' => 'required',
            'per_day' => 'required|min:0',
            'per_week' => 'required|min:0',
            'month' => 'required|min:0',
            'quarter' => 'required|min:0',
            'half_year' => 'required|min:0',
            'one_year' => 'required|min:0',
            'commodity_type' => 'required',
            'commodity_information' => 'required',
            'msds_1' => 'mimes:jpeg,jpg,png,JPEG,JPG,PNG',
            'msds_information' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',

        ]);

        $request->merge(['user_id' => auth()->user()->id]);
        $request->merge(['logistics_businesse_id' => auth()->user()->logistics_business_id]);

        if ($request->has('msds_1')) {
            $path = $request->file('msds_1')->store('', 'public');
            $request->merge(['msds' => $path]);
        }

        $storageSolution->update($request->all());
        session()->flash('message', 'Storage solution info successfully updated...');
        return redirect()->route('storageSolution.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\StorageSolution $storageSolution
     * @return \Illuminate\Http\Response
     */
    public function destroy(StorageSolution $storageSolution)
    {
        //
    }
}
