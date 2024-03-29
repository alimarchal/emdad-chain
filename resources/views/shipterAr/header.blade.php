<!DOCTYPE html>
<html lang="ar">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{url('ficon/apple-icon-180x180.png')}}">
    <!-- Page Title -->
    <title> @yield('title',config('app.name'))</title>
    <!-- Icon fonts -->
    <link href="{{url('Shipter/assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{url('Shipter/assets/css/flaticon.css')}}" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{url('Shipter/assets/css/bootstrap.min.css')}}" rel="stylesheet">
{{--    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" >--}}
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
    <!-- Plugins for this template -->
    <link href="{{url('Shipter/assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{url('Shipter/assets/css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{url('Shipter/assets/css/odometer-theme-default.css')}}" rel="stylesheet">
    <link href="{{url('Shipter/assets/css/slick.css')}}" rel="stylesheet">
    <link href="{{url('Shipter/assets/css/slick-theme.css')}}" rel="stylesheet">
    <link href="{{url('Shipter/assets/css/slicknav.min.css')}}" rel="stylesheet">
    <link href="{{url('Shipter/assets/css/jquery.fancybox.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{url('Shipter/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{url('Shipter/assets/css/responsive.css')}}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('custom-header')

<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-196168704-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-196168704-1');
    </script>

    <style>
        body {
            direction: rtl;
            text-align: right;
        }
    </style>

</head>

<body @yield('custom-body-style','')>
<!-- start page-loader -->
<div class="page-loader">
    <div class="page-loader-inner" style="right: 50%;!important;">
        <div class="inner"></div>
    </div>
</div>
<!-- end page-loader -->

@if(!request()->routeIs('arabic.index'))
    <header>
        <div class="header-top">
            <div class="container" style="direction: rtl">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-12 col-lg-7">
                        <ul class="d-flex account_login-area">
                            {{--<li>باستطاعتك الآن التسجيل في منصة إمداد مجاناً
                                <a href="{{route('english.index')}}" class="btn btn-warning" style="background: #eb8e23;border-color: white;"><img alt="" src="{{url('us.png')}}" style="font-family: 'Raleway', sans-serif;margin-right: 2px;margin-top: 4px;">&nbsp;English</a>
                            </li>--}}
                            <li>
                                <a href="{{route('english.index')}}" class="english rounded-pill" style="width: 120px;font-family: sans-serif;color: whitesmoke;font-weight: normal">
                                    <img alt="" src="{{url('us.png')}}" style="margin-bottom: 4px;">
                                    &nbsp;English
                                </a>
                            </li>
                            <li style="margin-top: 10px;">
                                باستطاعتك الآن تسجيل منشأتك في منصة إمداد الرقميةً
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-12 col-12 col-lg-5">
                        <div class="row">
                            <div class="col-lg-9 col-md-6">
                                <div class="flex" style="text-align: end">
                                    <div class="flex-row float-right ml-2">
                                        <div class="btn-style login_button_nav_bar">
                                            <a href="{{route('loginAr', 'ar')}}" style="border-radius: 25px;border-color: orange;padding: 7px;width: 70px;text-align: center;font-weight: normal">الدخول</a>
                                        </div>
                                    </div>
                                    <div class="flex-row float-end mt-1">
                                        <div class="a_hover_class register_button_nav_bar">
                                            <a href="{{route('registerAr', 'ar')}}" style="border-radius: 25px;color: whitesmoke">تسجيل</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6" style="text-align: end">
                                <li><img src="{{url('Shipter/assets/images/logo/logo-2030.png')}}" alt="Vision 2030" style="height: 30px; width: 50px;margin-top: 6px;"></li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-top header-top-2">
            <div class="container" style="text-align: right; direction: ltr;">
                <div class="row">
                    @include('shipterAr.header-container')
                </div>
            </div>
        </div>
        <div class="header-area header-style-2" style="direction: rtl">
            <div class="header-sub" id="sticky-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 d-none d-lg-block">
                            <div class="main-menu">
                                @include('shipterAr.menu')
                            </div>
                        </div>

                        <div class="col-12 col-sm-11 col-md-9 d-block d-lg-none">
                            <div class="mobile_menu"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-area end -->

    <!-- section-section start -->
    {{--    <div class="contact-page-area section-padding">--}}
    {{--        <div class="container">--}}
    @yield('main')
    {{--        </div>--}}
    {{--    </div>--}}
    <!--section-section end -->
@endif

