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
                            <li>You can register now with Emdad for free
                                <a href="{{route('arabic.index')}}" class="scrollto btn btn-warning"><img alt="" src="{{url('sa.png')}}" style="margin-right: 2px;margin-top:-4px; font-family: arabicFont;">&nbsp;العربية</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-12 col-12 col-lg-6">
                        <div class="row">
                            <div class="col-lg-9 col-md-6">
                                <ul class="login-r">
                                    <li><a style="color: white" href="{{route('login')}}">Platform Login
                                        </a></li>
                                </ul>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <li><img src="{{url('Shipter/assets/images/logo/logo-2030.png')}}" alt="Vision 2030" style="height: 30px; width: 50px;"></li>
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

