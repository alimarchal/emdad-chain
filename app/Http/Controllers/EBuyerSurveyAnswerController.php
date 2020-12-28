<?php

namespace App\Http\Controllers;

use App\Models\EBuyerSurveyAnswer;
use Illuminate\Http\Request;

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
        session()->flash('message', 'E-Buyer Survey information successfully submitted.');
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
}
