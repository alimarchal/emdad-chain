<!DOCTYPE html>
<html lang="ar">

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
        .form-check-input[type=radio] {
            border-radius: 50%;
            float: right;
            margin-left: 10px;
        }

        input[type=text], [type=email] {
            direction: rtl;
        }

        .inner-page {
            direction: rtl;
        }

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
    </style>
</head>

<body>
<!-- ======= Header ======= -->
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
                <li class="drop-down"><a href="{{url('survey')}}">الاستبيان</a>
                    <ul>
                        <li><a href="{{url('e-buyer/ar')}}">للمشترين</a></li>
                        <li><a href="#">للموردين</a></li>
                    </ul>
                </li>
                <li><a href="{{route('login')}}">دخول</a></li>
                <li><a href="{{route('register')}}">دخول</a></li>


            </ul>
        </nav><!-- .nav-menu -->
        <a href="{{url('/en')}}" class="get-started-btn scrollto"><img alt="" src="{{url('us.png')}}" style="margin-right: 2px;margin-top:-4px;">English</a>
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

            <div class="container bg-white rounded p-4 mt-4 mb-4 ">

                <div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                <h3 class="text-center">About your company</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)

                    <div class="mb-3">

                        @if($loop->iteration == 1)
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                            <input type="email" class="form-control" id="question{{$q->id}}" name="question{{$q->id}}">
                        @elseif($loop->iteration == 5)
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question{{$q->id}}" id="The owner" value="The owner" name="question{{$q->id}}">
                                <label class="form-check-label" for="The owner">
                                    صاحب المنشأة
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Chief Executive Officer" value="Chief Executive Officer">
                                <label class="form-check-label" for="Chief Executive Officer" name="question{{$q->id}}">
                                    الرئيس التنفيذي

                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Chief Financial Officer" value="Chief Financial Officer">
                                <label class="form-check-label" for="Chief Financial Officer" name="question{{$q->id}}">
                                    المدير المالي

                                </label>
                            </div>


                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Supply Chain Manager" value="Supply Chain Manager">
                                <label class="form-check-label" for="Supply Chain Manager" name="question{{$q->id}}">
                                    مدير سلاسل الامداد

                                </label>
                            </div>


                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Business development Manager" value="Business development Manager" required>
                                <label class="form-check-label" for="Business development Manager" name="question{{$q->id}}">
                                    مدير تطوير الاعمال

                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question{{$q->id}}" id="other{{$q->id}}" value="Other" required>
                                <label class="form-check-label" for="other{{$q->id}}" name="question{{$q->id}}">
                                    اخرى
                                </label>
                            </div>


                        @elseif($loop->iteration == 6)
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Hospitals and health clinics" value="Hospitals and health clinics" required>
                                <label class="form-check-label" for="Hospitals and health clinics">
                                    المستشفيات و العيادات الصحية
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Pharmacies" value="Pharmacies" required>
                                <label class="form-check-label" for="Pharmacies">
                                    الصيدليات
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Government sector" value="Government sector" required>
                                <label class="form-check-label" for="Government sector">
                                    القطاع الحكومي
                                </label>
                            </div>


                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Hotels" value="Hotels" required>
                                <label class="form-check-label" for="Hotels">
                                    الفنادق
                                </label>
                            </div>


                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Institutions and companies" value="Institutions and companies" required>
                                <label class="form-check-label" for="Institutions and companies">
                                    المؤسسات و الشركات
                                </label>
                            </div>


                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Restaurants and cafes" value="Restaurants and cafes" required>
                                <label class="form-check-label" for="Restaurants and cafes">
                                    المطاعم و الكافيهات
                                </label>
                            </div>


                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Catering" value="Catering" required>
                                <label class="form-check-label" for="Catering">
                                    التموين
                                </label>
                            </div>


                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Industry" value="Industry" required>
                                <label class="form-check-label" for="Industry">
                                    الصناعة
                                </label>
                            </div>


                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Furniture and library" value="Furniture and library" required>
                                <label class="form-check-label" for="Furniture and library">
                                    الأثاث و المكتبة
                                </label>
                            </div>


                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Electronic devices" value="Electronic devices">
                                <label class="form-check-label" for="Electronic devices">
                                    الأجهزة الألكترونية
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question{{$q->id}}" id="other{{$q->id}}" value="Electronic devices">
                                <label class="form-check-label" for="other{{$q->id}}">
                                    اخرى
                                </label>
                            </div>
                        @else
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                            <input type="text" class="form-control" id="question{{$q->id}}" name="question{{$q->id}}">
                        @endif
                    </div>
                    @php if($loop->iteration == 6) break; @endphp
                @endforeach
            </div>

            <div class="container bg-white rounded p-4 mt-4 mb-4 float-right">
                <h3 class="text-center">Supply Chain Management</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 7 && $loop->iteration <= 14)
                        <div class="mb-3">

                            @if($loop->iteration == 7)

                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="B2B" value="B2B">
                                    <label class="form-check-label" for="B2B">
                                        B2B (منشأة الي منشأة)
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="B2C" value="B2B">
                                    <label class="form-check-label" for="B2C">
                                        B2C (منشأة الي مستهلك)
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Both" value="B2B">
                                    <label class="form-check-label" for="Both">
                                        كلاهما

                                    </label>
                                </div>
                            @elseif($loop->iteration == 8)

                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="1-5 employees" value="1-5 employees">
                                    <label class="form-check-label" for="1-5 employees">
                                        1-5 موظف

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="5-10 employees" value="5-10 employees">
                                    <label class="form-check-label" for="5-10 employees">
                                        5-10 موظفين

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="More the 10 employees" value="More the 10 employees">
                                    <label class="form-check-label" for="More the 10 employees">
                                        اكثر من 10 موظفين

                                    </label>
                                </div>
                            @elseif($loop->iteration == 9)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Yes. Satisfied with productivity and number"
                                           value="Yes. Satisfied with productivity and number">
                                    <label class="form-check-label" for="Yes. Satisfied with productivity and number">
                                        نعم. راضٍ عن الانتاجية و العدد

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Yes. Satisfied with productivity" value="Yes. Satisfied with productivity">
                                    <label class="form-check-label" for="Yes. Satisfied with productivity">
                                        نعم. راضٍ عن الانتاجية

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="Yes. Satisfied with the number" value="Yes. Satisfied with the number">
                                    <label class="form-check-label" for="Yes. Satisfied with the number">
                                        نعم راضٍ عن العدد

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="No" value="No. I am not satisfied with the productivity and the number">
                                    <label class="form-check-label" for="No">
                                        لا. لست راضٍ عن الانتاجية و العدد

                                    </label>
                                </div>
                            @elseif($loop->iteration == 10)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <input type="text" class="form-control" id="question{{$q->id}}" name="question{{$q->id}}">
                            @elseif($loop->iteration == 11)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <br>
                                @for($count = 1; $count <= 5; $count++)
                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}{{$count}}" value="{{$count}}">
                                        <label class="form-check-label" for="question{{$q->id}}{{$count}}">
                                            {{$count}}
                                        </label>
                                    </div>
                                @endfor

                            @elseif($loop->iteration == 12)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}Yes" value="Yes">
                                    <label class="form-check-label" for="question{{$q->id}}Yes">
                                        نعم
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}No" value="No">
                                    <label class="form-check-label" for="question{{$q->id}}No">
                                        لا
                                    </label>
                                </div>


                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}Maybe" value="Maybe">
                                    <label class="form-check-label" for="question{{$q->id}}Maybe">
                                        احيانا
                                    </label>
                                </div>
                            @elseif($loop->iteration == 13)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="No, we don't have any formal training.">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        نعم. لدينا تدريب رسمي

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="Yes, we have our formal training.">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        لا. ليس لدينا أي تدريب رسمي
                                    </label>
                                </div>


                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}3" value="They get the training from our staff how to do things.">
                                    <label class="form-check-label" for="question{{$q->id}}3">
                                        يتلقون التدريب من موظفينا على كيفية القيام بالعمل
                                    </label>
                                </div>


                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}4" value="They learn it on the flight.">
                                    <label class="form-check-label" for="question{{$q->id}}4">
                                        يستطيع التعلم بنفسة مع مرور الوقت
                                    </label>
                                </div>


                            @elseif($loop->iteration == 14)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label><br>
                                @for($count = 1; $count <= 5; $count++)
                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}{{$count}}" value="{{$count}}">
                                        <label class="form-check-label" for="question{{$q->id}}{{$count}}">
                                            {{$count}}
                                        </label>
                                    </div>
                                @endfor
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="container bg-white rounded p-4 mt-4 mb-4">
                <h3 class="text-center">Warehouse Info.</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 15 && $loop->iteration <= 16)
                        <div class="mb-3">

                            @if($loop->iteration == 15)

                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="One warehouse">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        مستودع واحد
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="2-5 warehouses">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        2-5 مستودع

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}3" value="5-10 warehouses">
                                    <label class="form-check-label" for="question{{$q->id}}3">
                                        5-10 مستودع

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}4" value="More than 10 warehouses">
                                    <label class="form-check-label" for="question{{$q->id}}4">
                                        اكثر من 10 مستودعات
                                    </label>
                                </div>
                            @elseif($loop->iteration == 16)

                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="1-3 years">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        سنة الى 3 سنوات
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="3-5 years">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        3 -5 سنوات
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}3" value="5-10 years">
                                    <label class="form-check-label" for="question{{$q->id}}3">
                                        5-10 سنوات
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}4" value="Other">
                                    <label class="form-check-label" for="question{{$q->id}}4">
                                        لا يتم إزالتها نهائياً
                                    </label>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="container bg-white rounded p-4 mt-4 mb-4">
                <h3 class="text-center">Products</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 17 && $loop->iteration <= 22)
                        <div class="mb-3">

                            @if($loop->iteration == 17)

                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="Yes">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        نعم
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="No">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        لا
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}3" value="Sometime">
                                    <label class="form-check-label" for="question{{$q->id}}3">
                                        احيانا
                                    </label>
                                </div>

                            @elseif($loop->iteration == 18)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="Yes">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        نعم

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="No">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        لا

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}3" value="Sometime">
                                    <label class="form-check-label" for="question{{$q->id}}3">
                                        احيانا

                                    </label>
                                </div>

                            @elseif($loop->iteration == 19)

                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-input">
                                    <input type="text" class="form-control" id="question{{$q->id}}1" name="question{{$q->id}}">
                                </div>
                            @elseif($loop->iteration == 20)

                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="4 to 10 days.">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        4 الي 10 ايام

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="10 to 20 days.">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        10 الي 20 يوم

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}3" value="20 to 30 days.">
                                    <label class="form-check-label" for="question{{$q->id}}3">
                                        20 الي 30 يوم

                                    </label>
                                </div>


                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}4" value="30 to 60 days.">
                                    <label class="form-check-label" for="question{{$q->id}}4">
                                        30 الي 60 يوم

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}5" value="More than 60 days">
                                    <label class="form-check-label" for="question{{$q->id}}5">
                                        اكثر من 60 يوم

                                    </label>
                                </div>

                            @elseif($loop->iteration == 21)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="Yes">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        نعم

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="No">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        No
                                    </label>
                                </div>
                            @elseif($loop->iteration == 22)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="No">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        لا

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="Yes">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        نعم

                                    </label>
                                </div>


                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}3" value="Sometime">
                                    <label class="form-check-label" for="question{{$q->id}}3">
                                        احيانا

                                    </label>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="container bg-white rounded p-4 mt-4 mb-4">
                <h3 class="text-center">Purchases</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 23 && $loop->iteration <= 30)
                        <div class="mb-3">

                            @if($loop->iteration == 23)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="Yes">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        نعم

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="No">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        لا

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}3" value="Sometime">
                                    <label class="form-check-label" for="question{{$q->id}}3">
                                        احيانا

                                    </label>
                                </div>


                            @elseif($loop->iteration == 24)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-input">
                                    <input type="text" class="form-control" id="question{{$q->id}}1" name="question{{$q->id}}">
                                </div>

                            @elseif($loop->iteration == 25)

                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="1-50 suppliers">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        1-50 مورد

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="50-200 suppliers">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        50-200 مورد

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}3" value="200-500 suppliers">
                                    <label class="form-check-label" for="question{{$q->id}}3">
                                        200 - 500 مورد

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}4" value="More than 500 suppliers">
                                    <label class="form-check-label" for="question{{$q->id}}4">
                                        500 او اكثر

                                    </label>
                                </div>


                            @elseif($loop->iteration == 26)

                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="Yes, always.">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        نعم. دائماً

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="No, never.">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        لا. ابداُ

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}3" value="Sometimes by some suppliers, only if I ask for it">
                                    <label class="form-check-label" for="question{{$q->id}}3">
                                        في بعض الأحيان من قبل بعض الموردين فقط اذا طلبت ذلك

                                    </label>
                                </div>

                            @elseif($loop->iteration == 27)

                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="Yes">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        لا


                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="No">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        نعم

                                    </label>
                                </div>

                            @elseif($loop->iteration == 28)

                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label><br>
                                @for($count = 1; $count <= 5; $count++)
                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}{{$count}}" value="{{$count}}">
                                        <label class="form-check-label" for="question{{$q->id}}{{$count}}">
                                            {{$count}}
                                        </label>
                                    </div>
                                @endfor
                            @elseif($loop->iteration == 29)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="1 to 3 days.">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        1 الي 3 ايام

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="1 week.">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        اسبوع
                                    </label>
                                </div>


                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}3" value="2 weeks.">
                                    <label class="form-check-label" for="question{{$q->id}}3">
                                        اسبوعين
                                    </label>
                                </div>


                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}4" value="More than 2 weeks.">
                                    <label class="form-check-label" for="question{{$q->id}}4">
                                        اكثر من اسبوعين
                                    </label>
                                </div>

                            @elseif($loop->iteration == 30)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="No">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        لا
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="Yes">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        نعم
                                    </label>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="container bg-white rounded p-4 mt-4 mb-4">
                <h3 class="text-center">The Market</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 31 && $loop->iteration <= 38)
                        <div class="mb-3">

                            @if($loop->iteration == 31)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="Yes">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        نعم

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="No">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        لا

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}3" value="May be.">
                                    <label class="form-check-label" for="question{{$q->id}}3">
                                        ممكن

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}4" value="Don't know.">
                                    <label class="form-check-label" for="question{{$q->id}}4">
                                        لا اعلم

                                    </label>
                                </div>


                            @elseif($loop->iteration == 32)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="Yes">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        نعم

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="No">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        لا

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}3" value="Don't know.">
                                    <label class="form-check-label" for="question{{$q->id}}3">
                                        لا اعلم

                                    </label>
                                </div>

                            @elseif($loop->iteration == 33)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="Yes">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        نعم

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="No">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        لا

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}3" value="Don't know.">
                                    <label class="form-check-label" for="question{{$q->id}}3">
                                        لا اعلم

                                    </label>
                                </div>


                            @elseif($loop->iteration == 34)
                                <label for="question{{$q->id}}1" class="form-label">{{$q->question_ar}}</label>
                                <input type="text" class="form-control" id="question{{$q->id}}1" name="question{{$q->id}}">
                            @elseif($loop->iteration == 35)

                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="Yes">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        نعم
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="No">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        لا
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}3" value="May be.">
                                    <label class="form-check-label" for="question{{$q->id}}3">
                                        ممكن
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}4" value="Don't know.">
                                    <label class="form-check-label" for="question{{$q->id}}4">
                                        لا اعلم
                                    </label>
                                </div>

                            @elseif($loop->iteration == 36)

                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="Yes">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        نعم
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="No">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        لا
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}3" value="May be.">
                                    <label class="form-check-label" for="question{{$q->id}}3">
                                        ممكن
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}4" value="Don't know.">
                                    <label class="form-check-label" for="question{{$q->id}}4">
                                        لا اعلم

                                    </label>
                                </div>
                            @elseif($loop->iteration == 37)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}1" value="Yes">
                                    <label class="form-check-label" for="question{{$q->id}}1">
                                        نعم

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}2" value="No">
                                    <label class="form-check-label" for="question{{$q->id}}2">
                                        لا

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}3" value="May be.">
                                    <label class="form-check-label" for="question{{$q->id}}3">
                                        ممكن

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}4" value="Don't know.">
                                    <label class="form-check-label" for="question{{$q->id}}4">
                                        لا اعلم

                                    </label>
                                </div>
                            @elseif($loop->iteration == 38)
                                <label for="question{{$q->id}}" class="form-label">{{$q->question_ar}}</label>
                                <br>
                                @for($count = 1; $count <= 10; $count++)
                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="question{{$q->id}}" id="question{{$q->id}}{{$count}}" value="{{$count}}">
                                        <label class="form-check-label" for="question{{$q->id}}{{$count}}">
                                            {{$count}}
                                        </label>
                                    </div>
                                @endfor


                            @endif
                        </div>
                    @endif
                @endforeach
                <input type="hidden" name="language" value="ar">
                <button type="submit" class="btn btn-primary ml-2">إرسال / Submit</button>
            </div>

        </form>
        <!-- Optional JavaScript; choose one of the two! -->
    </section>

</main><!-- End #main -->
<!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" style="direction: rtl">

    <div class="footer-top" >
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6 footer-contact">
                    <h3>{{config('app.name')}} <img src="../logo-full.png" style="max-width: 70px;"></h3>
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


                <div class="col-lg-4 col-md-6 footer-links ">
                    <h4>Useful Links</h4>
                    <ul style="list-style-type: none; padding: 0px;margin:0px;">
                        <li><i class="bx bx-chevron-right"></i> <a href="{{config('app.url')}}">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('aboutUs')}}">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('services')}}">Services</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('ourTeam')}}">Our Team</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('support')}}">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                {{--                <div class="col-lg-4 col-md-6 footer-newsletter">--}}
                {{--                    <h4>Join Our Newsletter</h4>--}}
                {{--                    <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>--}}
                {{--                    <form action="" method="post">--}}
                {{--                        <input type="email" name="email"><input type="submit" value="Subscribe">--}}
                {{--                    </form>--}}
                {{--                </div>--}}

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
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="https://instagram.com/emdad_chain?igshid=ok4zahralc2t" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-pinterest"></i></a>
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
