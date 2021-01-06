<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{config('app.name')}}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="ficon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="ficon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="ficon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="ficon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="ficon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="ficon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="ficon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="ficon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="ficon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="ficon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="ficon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="ficon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="ficon/favicon-16x16.png">
    <link rel="manifest" href="ficon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="ficon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="Presento/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="Presento/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="Presento/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="Presento/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="Presento/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="Presento/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="Presento/assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="Presento/assets/css/style.css" rel="stylesheet">

    <style>
        .goog-logo-link {
            display: none !important;
        }

        .goog-te-gadget {
            line-height: 1px !important;
            color: transparent;
        }

        .goog-te-gadget .goog-te-combo {
            color: black !important;
        }

        div.goog-te-gadget {
            color: transparent !important;
        }

        nav, #main, .inner-page {
            direction: rtl;
        }

        body, #main, div, header, nav, footer, .inner-page, .nav-menu a, h1,h2,h3,h4,h5,h6,p, button {
            font-family: arabicFont;
        }


    </style>
</head>

<body>
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <h1 class="logo me-auto"><a href="{{ url('/') }}">
                <img src="../logo-full.png"></a>
        </h1>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class=""><a href="{{url('/')}}">الرئيسية</a></li>
                <li class="{{(request()->routeIs('aboutUsAr')?'active':'')}}"><a href="{{route('aboutUsAr')}}">من نحن</a></li>
                <li class="{{(request()->routeIs('servicesAr')?'active':'')}}"><a href="{{route('servicesAr')}}">خدماتنا</a></li>
                <li class="{{(request()->routeIs('ourTeamAr')?'active':'')}}"><a href="{{route('ourTeamAr')}}">فريق العمل</a></li>
                <li class="{{(request()->routeIs('supportAr')?'active':'')}}"><a href="{{route('supportAr')}}">الدعم</a></li>
                <li class="drop-down"><a href="{{url('survey/ar')}}">الاستبيان</a>
                    <ul>
                        <li><a href="{{url('survey/ar')}}">للمشتري</a></li>
                        <li><a href="{{url('e-supplier/ar')}}">للمورد</a></li>
                    </ul>
                </li>
                <li><a href="{{route('login')}}">دخول</a></li>
                <li><a href="{{route('register')}}">تسجيل</a></li>

                {{--                <li class="drop-down"><a href="">Survey</a>--}}
                {{--                    <ul>--}}
                {{--                        <li><a href="#">Drop Down 1</a></li>--}}
                {{--                        <li class="drop-down"><a href="#">Deep Drop Down</a>--}}
                {{--                            <ul>--}}
                {{--                                <li><a href="#">Deep Drop Down 1</a></li>--}}
                {{--                                <li><a href="#">Deep Drop Down 2</a></li>--}}
                {{--                                <li><a href="#">Deep Drop Down 3</a></li>--}}
                {{--                                <li><a href="#">Deep Drop Down 4</a></li>--}}
                {{--                                <li><a href="#">Deep Drop Down 5</a></li>--}}
                {{--                            </ul>--}}
                {{--                        </li>--}}
                {{--                        <li><a href="#">Drop Down 2</a></li>--}}
                {{--                        <li><a href="#">Drop Down 3</a></li>--}}
                {{--                        <li><a href="#">Drop Down 4</a></li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}

            </ul>
        </nav><!-- .nav-menu -->
        <a href="{{url('/en')}}" class="get-started-btn scrollto"><img alt="" src="{{url('us.png')}}" style="margin-right: 2px;margin-top: 4px;">English</a>
    </div>
</header>
