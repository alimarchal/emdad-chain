<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\User\SendWelcomeNotificationToAdmin;
use App\Notifications\User\UserRegistration;
use App\Notifications\UserRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class WebsiteArabicController extends Controller
{
    public function index()
    {
//        User::find(5)->notify(new UserRegistration());
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

    public function suppliers()
    {
        return view('shipter_theme_ar.supplier');
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

    public function faq()
    {
        return view('shipter_theme_ar.FAQ');
    }
}
