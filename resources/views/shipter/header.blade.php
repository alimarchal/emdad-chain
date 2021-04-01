<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{url('Shipter/assets/images/icon.png')}}">
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

</head>

<body>
<!-- start page-loader -->
<div class="page-loader">
    <div class="page-loader-inner">
        <div class="inner"></div>
    </div>
</div>
<!-- end page-loader -->
<!-- header-area start -->
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
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <ul class="login-r">
                                <li><a href="#">Login</a></li>
                                <li><a href="#">Register</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-area"  id="sticky-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-9 col-sm-9 col-9">
                    <div class="logo">
                        <a href="index.html"><img src="{{url('Shipter/assets/images/logo/logo.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-8 d-none d-lg-block">
                    <div class="main-menu">
                        <nav class="nav_mobile_menu">
                            <ul>
                                <li class="active"><a href="#">Home</a>
                                    <ul class="submenu">
                                        <li class="active"><a href="index.html">Home One</a></li>
                                        <li><a href="index-2.html">Home Two</a></li>
                                        <li><a href="index-3.html">Home Three</a></li>
                                    </ul>
                                </li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="#">Services</a>
                                    <ul class="submenu">
                                        <li><a href="service.html">service single</a></li>
                                        <li><a href="Freight.html">Air Freight</a></li>
                                        <li><a href="road.html">Road Freight</a></li>
                                        <li><a href="ocean.html">Ocean Freight</a></li>
                                    </ul>
                                </li>
                                <li><a href="case.html">Pages</a>
                                    <ul class="submenu">
                                        <li><a href="pricing.html">pricing table</a></li>
                                        <li><a href="team.html">Team</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="#">Blog</a>
                                    <ul class="submenu">
                                        <li><a href="blog.html">Blog with right sidebar</a></li>
                                        <li><a href="blog-right.html">Blog with Left sidebar</a></li>
                                        <li><a href="blog-fullwidth.html">Blog full width</a></li>
                                        <li><a href="blog-details.html">Blog single right sidebar</a></li>
                                        <li><a href="blog-details-right.html">Blog single left sidebar</a></li>
                                        <li><a href="blog-details-fullwidth.html">Blog single fullwidth</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3 col-3 search">
                    <ul>
                        <li><a href="javascript:void(0);"><i class="fa fa-search"></i></a>
                            <ul>
                                <li>
                                    <form action="search">
                                        <input type="text" placeholder="search here..">
                                        <button><i class="fa fa-search"></i></button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-12 d-block d-lg-none">
                    <div class="mobile_menu"></div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-area end -->
