<?php

namespace App\Http\Controllers;

use App\Exports\BuyerSurveyExport;
use App\Exports\SupplierSurveyExport;
use App\Models\EBuyerSurveyAnswer;
use Illuminate\Http\Request;
use App\Exports\AnswersExport;
use Maatwebsite\Excel\Facades\Excel;

class EBuyerSurveyAnswerController extends Controller
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
//        dd($request->all());
        session()->flash('message', 'Survey information successfully submitted. Thank You!');
        EBuyerSurveyAnswer::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EBuyerSurveyAnswer  $eBuyerSurveyAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(EBuyerSurveyAnswer $eBuyerSurveyAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EBuyerSurveyAnswer  $eBuyerSurveyAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(EBuyerSurveyAnswer $eBuyerSurveyAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EBuyerSurveyAnswer  $eBuyerSurveyAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EBuyerSurveyAnswer $eBuyerSurveyAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EBuyerSurveyAnswer  $eBuyerSurveyAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(EBuyerSurveyAnswer $eBuyerSurveyAnswer)
    {
        //
    }

    public function export()
    {
        return Excel::download(new AnswersExport, 'answers.xlsx');
    }

    public function supplier()
    {
        return Excel::download(new SupplierSurveyExport, 'supplier.xlsx');
    }

    public function buyer()
    {
        return Excel::download(new BuyerSurveyExport, 'buyer.xlsx');
    }
}