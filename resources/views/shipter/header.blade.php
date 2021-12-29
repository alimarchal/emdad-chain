<!DOCTYPE html>
<html lang="en">

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

</head>

<body @yield('custom-body-style','')>
<!-- start page-loader -->
<div class="page-loader">
    <div class="page-loader-inner">
        <div class="inner"></div>
    </div>
</div>
<!-- end page-loader -->

@if(!request()->routeIs('english.index'))
    <header>
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-12 col-lg-6">
                        <ul class="d-flex account_login-area">
                            <li>
                                {{--<a href="{{route('arabic.index')}}" class="btn btn-warning" style="background: #eb8e23;border-color: white;color: whitesmoke"><img alt="" src="{{url('sa.png')}}" style="margin-right: 2px;margin-top:-4px; font-family: arabicFont;">
                                    &nbsp;العربية
                                </a>--}}
                                <a href="{{route('arabic.index')}}" class="english rounded-pill" style="font-family: arabicFont;width: 137px;color: whitesmoke;font-weight: normal">
                                    <img alt="" src="{{url('sa.png')}}" style="margin-right: 2px;width: 19px;">
                                    &nbsp;العربية
                                </a>
                            </li>
                            <li style="margin-top: 10px;">You can register now with Emdad digital platform.</li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-12 col-12 col-lg-6">
                        <div class="row">
                            <div class="col-lg-9 col-md-6">
                                <div class="flex" style="text-align: end">
                                    <div class="flex-row float-right ml-2">
                                        <div class="btn-style login_button_nav_bar">
                                            <a href="{{route('login')}}" style="border-radius: 25px;border-color: orange;padding: 7px;font-weight: normal;width: 70px;text-align: center">Login</a>
                                        </div>
                                    </div>
                                    <div class="flex-row float-end mt-1">
                                        <div class="a_hover_class register_button_nav_bar">
                                            <a href="{{route('register')}}" style="border-radius: 25px;color: whitesmoke">Register</a>
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
            <div class="container">
                <div class="row">
                    @include('shipter.header-container')
                </div>
            </div>
        </div>
        <div class="header-area header-style-2">
            <div class="header-sub" id="sticky-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 d-none d-lg-block">
                            <div class="main-menu">
                                @include('shipter.menu')
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

