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
                            <li><i class="fa fa-clock-o" aria-hidden="true"></i></i>Mon - Tues : 6.00 am - 10.00 pm, Sunday Closed</li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-12 col-12 col-lg-6">
                        <div class="row">
                            <div class="col-lg-7 col-md-6">
                                <ul class="d-flex header-social">
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="https://instagram.com/emdad_chain?igshid=ok4zahralc2t"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    <li><a href="https://twitter.com/emdad_chain?s=21"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="https://www.linkedin.com/company/emdadchain"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <div class="col-lg-5 col-md-6">
                                <ul class="login-r">
                                    <li><a href="{{route('login')}}">Login</a></li>
                                    <li><a href="{{route('register')}}">Register</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-top header-top-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="logo">
                            <a href="{{route('english.index')}}"><img src="{{url('logo-full.png')}}" alt="" style="max-height: 60px"></a>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12 col-12 col-lg-9">
                        <ul class="d-flex account_login-area">
                            <li class="account-item">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <h5><span>Call Us Now</span>Tel: +966 53 416 8874</h5>
                            </li>
                            <li class="account-item account-item-2">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                <h5><span>Mail Us Today</span>info@emdad-chain.com<br>support@emdad-chain.com</h5>
                            </li>
                            <li class="account-item">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <h5><span>Company Location</span>King Abdul Aziz Road, Exit 5, <br>Riyadh - 13525, KSA</h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-area header-style-2">
            <div class="header-sub" id="sticky-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 d-none d-lg-block">
                            <div class="main-menu">
                                <nav class="nav_mobile_menu">
                                    <ul>
                                        <li class="{{(request()->routeIs('english.index')?'active':'')}}"><a href="{{route('english.index')}}">Home</a></li>
                                        <li class="{{(request()->routeIs('english.about')?'active':'')}}"><a href="{{route('english.about')}}">About Us</a></li>
                                        <li class="{{(request()->routeIs('english.buyerService') || request()->routeIs('english.supplierService')?'active':'')}}"><a href="javascript:void(0)">Services</a>
                                            <ul class="submenu">
                                                <li class="{{(request()->routeIs('english.buyerService') ?'active':'')}}"><a href="{{route('english.buyerService')}}">Buyer</a></li>
                                                <li class="{{(request()->routeIs('english.supplierService') ?'active':'')}}"><a href="{{route('english.supplierService')}}">Supplier</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{(request()->routeIs('english.team')?'active':'')}}"><a href="{{route('english.team')}}">Our Team</a></li>
                                        <li class="{{(request()->routeIs('english.support')?'active':'')}}"><a href="{{route('english.support')}}">Support</a></li>
                                        <li class="{{(request()->routeIs('english.buyerSurvey') || request()->routeIs('english.supplierSurvey') ?'active':'')}}"><a href="javascript:void(0)">Survey</a>
                                            <ul class="submenu">
                                                <li class="{{(request()->routeIs('english.buyerSurvey') ?'active':'')}}"><a href="{{route('english.buyerSurvey')}}">Buyer</a></li>
                                                <li class="{{(request()->routeIs('english.supplierSurvey') ?'active':'')}}"><a href="{{route('english.supplierSurvey')}}">Supplier</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-area end -->
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>@yield('breadcumb-title','')</h2>
                        <ul>
                            <li><a href="{{route('english.index')}}">Home</a></li>
                            <li><span>@yield('breadcumb-text','')</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->

    <!-- section-section start -->
    <div class="contact-page-area section-padding">
        <div class="container">
            @yield('main')
        </div>
    </div>
    <!--section-section end -->
@endif

