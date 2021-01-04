<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{config('app.name')}}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="../ficon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../ficon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../ficon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../ficon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../ficon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../ficon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../ficon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../ficon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../ficon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="ficon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../ficon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../ficon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../ficon/favicon-16x16.png">
    <link rel="manifest" href="../ficon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../ficon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../Presento/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Presento/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="../Presento/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../Presento/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../Presento/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../Presento/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="../Presento/assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../Presento/assets/css/style.css" rel="stylesheet">

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

    </style>
</head>

<body>
<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <h1 class="logo me-auto"><a href="{{ url('/en') }}"><img src="../../logo-full.png"></a></h1>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class=""><a href="{{url('/en')}}">Home</a></li>
                <li class="{{(request()->routeIs('aboutUs')?'active':'')}}"><a href="{{route('aboutUs')}}">About Us</a></li>
                <li class="{{(request()->routeIs('services')?'active':'')}}"><a href="{{route('services')}}">Services</a></li>
                <li class="{{(request()->routeIs('ourTeam')?'active':'')}}"><a href="{{route('ourTeam')}}">Our Team</a></li>
                <li class="{{(request()->routeIs('support')?'active':'')}}"><a href="{{route('support')}}">Support</a></li>
                <li class="drop-down"><a href="{{url('survey')}}">Survey</a>
                    <ul>
                        <li><a href="{{url('survey')}}">Buyer</a></li>
                        <li><a href="{{url('e-supplier/en')}}">Supplier</a></li>
                    </ul>
                </li>
                <li><a href="{{route('login')}}">Login</a></li>
                <li><a href="{{route('register')}}">Register</a></li>

            </ul>
        </nav><!-- .nav-menu -->
        <a href="{{url('/')}}" class="get-started-btn scrollto"><img alt="" src="{{url('sa.png')}}" style="margin-right: 2px;margin-top:-4px;">العربية</a>
    </div>
</header>

<!-- End Header -->

<!-- ======= Hero Section ======= -->

<main id="main" style="background-color: lightgray;">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container" style="margin-top: 40px;">
            <ol>
                <li><a href="{{config('app.url')}}">Home</a></li>
                <li>Survey</li>
            </ol>
        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">

        <form method="post" action="{{route('eBuyerEn')}}">
            @csrf
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <div class="container bg-white rounded p-4 mb-4">
                <h3 class="text-center">About your company</h3>
                <label for="question1212" class="form-label">Email address *</label>
                <input type="email" class="form-control" id="question1212" name="question45" required>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration <= 5)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_en}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="container bg-white rounded p-4 mb-4">
                <h3 class="text-center">Sales</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 6 && $loop->iteration <= 17)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_en}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="container bg-white rounded p-4 mb-4">
                <h3 class="text-center">Storage</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 18 && $loop->iteration <= 21)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_en}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="container bg-white rounded p-4 mb-4">
                <h3 class="text-center">Logistics</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 22 && $loop->iteration <= 29)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_en}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="container bg-white rounded p-4 mb-4">
                <h3 class="text-center">Products</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 30 && $loop->iteration <= 36)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_en}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="container bg-white rounded p-4 mb-4">
                <h3 class="text-center">Finance</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 37 && $loop->iteration <= 44)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_en}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach

                <input type="hidden" name="language" value="en_supplier">
                <button type="submit" class="btn btn-primary ml-2">Submit</button>
            </div>

        </form>
    </section>

</main><!-- End #main -->
<!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>{{config('app.name')}} <img src="../../logo-full.png" style="max-width: 70px;"></h3>
                    <p>
                        120 Aban Center, <br>
                        King Abdul Aziz Road, Exit 5,<br>
                        Riyadh - 13525, Kingdom of Saudi Arabia (KSA)<br>
                        <strong>Phone:</strong> <span style="font-family:tahoma;">+966 53 416 8874</span><br>
                        <strong>Contact:</strong> contact@emdad-chain.com<br>
                        <strong>Support:</strong> support@emdad-chain.com<br>
                        <strong>General:</strong> info@emdad-chain.com<br>
                    </p>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>Join Our Newsletter</h4>
                    <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                    <form action="" method="post">
                        <input type="email" name="email"><input type="submit" value="Subscribe">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-left">
            <div class="copyright">
                &copy; Copyright {{date('Y')}} - <strong><span>{{config('app.name')}}</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                {{--                Designed by <a href="#">Ali Raza Marchal</a>--}}
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="https://twitter.com/emdad_chain?s=21" class="twitter"><i class="bx bxl-twitter"></i></a>
{{--            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>--}}
            <a href="https://instagram.com/emdad_chain?igshid=ok4zahralc2t" class="instagram"><i class="bx bxl-instagram"></i></a>
{{--            <a href="#" class="google-plus"><i class="bx bxl-pinterest"></i></a>--}}
            <a href="https://www.linkedin.com/company/emdadchain" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
    </div>
</footer>

<!-- End Footer -->

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->
<script src="../Presento/assets/vendor/jquery/jquery.min.js"></script>
<script src="../Presento/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../Presento/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="../Presento/assets/vendor/php-email-form/validate.js"></script>
<script src="../Presento/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="../Presento/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="../Presento/assets/vendor/counterup/counterup.min.js"></script>
<script src="../Presento/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="../Presento/assets/vendor/venobox/venobox.min.js"></script>
<script src="../Presento/assets/vendor/aos/aos.js"></script>

<!-- Template Main JS File -->
<script src="Presento/assets/js/main.js"></script>

</body>

</html>
