<?php

namespace App\Http\Controllers;

use App\Models\WebsiteEnglish;
use Illuminate\Http\Request;

class WebsiteEnglishController extends Controller
{
    public function index()
    {
        return view('shipter_theme.home');
    }


    public function about()
    {
        return view('shipter_theme.about');
    }

    public function service()
    {
        return view('shipter_theme.service');
    }

    public function team()
    {
        return view('shipter_theme.team');
    }

    public function contact()
    {
        return view('shipter_theme.contact');
    }

    public function survey()
    {
        return view('shipter_theme.survey.index');
    }

    public function suppliers()
    {
        return view('shipter_theme.supplier');
    }

    public function buyerSurvey()
    {
        return view('shipter_theme.survey.buyer');
    }

    public function supplierSurvey()
    {
        return view('shipter_theme.survey.supplier');
    }

    public function buyerPackage()
    {
        return view('shipter_theme.package.buyer');
    }

    public function supplierPackage()
    {
        return view('shipter_theme.package.supplier');
    }

    public function faq()
    {
        return view('shipter_theme.FAQ');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WebsiteEnglish  $websiteEnglish
     * @return \Illuminate\Http\Response
     */
    public function show(WebsiteEnglish $websiteEnglish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WebsiteEnglish  $websiteEnglish
     * @return \Illuminate\Http\Response
     */
    public function edit(WebsiteEnglish $websiteEnglish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WebsiteEnglish  $websiteEnglish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WebsiteEnglish $websiteEnglish)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WebsiteEnglish  $websiteEnglish
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebsiteEnglish $websiteEnglish)
    {
        //
    }
}
