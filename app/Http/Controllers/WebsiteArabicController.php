<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteArabicController extends Controller
{
    public function index()
    {
        return view('shipter_theme_ar.home');
    }

    public function about()
    {
        return view('shipter_theme_ar.about');
    }

    public function service()
    {
        return view('shipter_theme_ar.service');
    }

    public function team()
    {
        return view('shipter_theme_ar.team');
    }

    public function contact()
    {
        return view('shipter_theme_ar.contact');
    }

    public function survey()
    {
        return view('shipter_theme_ar.survey.index');
    }

    public function buyerSurvey()
    {
        return view('shipter_theme_ar.survey.buyer');
    }

    public function supplierSurvey()
    {
        return view('shipter_theme_ar.survey.supplier');
    }

    public function buyerPackage()
    {
        return view('shipter_theme_ar.package.buyer');
    }

    public function supplierPackage()
    {
        return view('shipter_theme_ar.package.supplier');
    }
}
