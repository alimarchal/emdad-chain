<!DOCTYPE html>
<html lang="en">

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
    <link rel="icon" type="image/png" sizes="192x192"  href="ficon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="ficon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="ficon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="ficon/favicon-16x16.png">
    <link rel="manifest" href="ficon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="ficon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <h1 class="logo me-auto"><a href="{{ config('app.url') }}"><img src="logo-full.png"></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt=""></a>-->

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active"><a href="#header">الصفحة الرئيسية</a></li>
                <li><a href="#about">كيف تبدأ</a></li>
                <li><a href="#services">معلومات عنا</a></li>
                <li><a href="#portfolio">الدعم</a></li>
                <li><a href="{{route('login')}}">تسجيل الدخول</a></li>
                <li><a href="{{route('register')}}">تسجيل</a></li>
                <li class="drop-down"><a href="#">الدراسة الاستقصائية</a>
                    <ul>
                        <li><a href="{{url('e-buyer/ar')}}">مشتر</a></li>
                        <li><a href="#">المورد</a></li>
                        <li><a href="#">آخر</a></li>
                    </ul>
                </li>

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

        <a href="{{config('app.url')}}" class="get-started-btn scrollto">English</a>
    </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container" data-aos="zoom-out" data-aos-delay="100">
        <div class="row">
            <div class="col-xl-6">
                <h1>{{config('app.name')}}</h1>
                <h2>The lead generation process starts by finding out where your target market ‘lives’ on the web.</h2>
                <a href="#about" class="btn-get-started scrollto">Get Started</a>
            </div>
        </div>
    </div>

</section><!-- End Hero -->

<main id="main">

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
        <div class="container" data-aos="zoom-in">
            <div class="owl-carousel clients-carousel">
                <img src="Presento//img/clients/client-1.png" alt="">
                <img src="Presento/assets/img/clients/client-2.png" alt="">
                <img src="Presento/assets/img/clients/client-3.png" alt="">
                <img src="Presento/assets/img/clients/client-4.png" alt="">
                <img src="Presento/assets/img/clients/client-5.png" alt="">
                <img src="Presento/assets/img/clients/client-6.png" alt="">
                <img src="Presento/assets/img/clients/client-7.png" alt="">
                <img src="Presento/assets/img/clients/client-8.png" alt="">
            </div>
        </div>
    </section><!-- End Clients Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container" data-aos="fade-up">

            <div class="row no-gutters">
                <div class="content col-xl-5 d-flex align-items-stretch">
                    <div class="content">
                        <h3>Voluptatem dignissimos provident quasi</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                        </p>
                        <a href="#" class="about-btn"><span>About us</span> <i class="bx bx-chevron-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-7 d-flex align-items-stretch">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                                <i class="bx bx-receipt"></i>
                                <h4>Corporis voluptates sit</h4>
                                <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                                <i class="bx bx-cube-alt"></i>
                                <h4>Ullamco laboris nisi</h4>
                                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                                <i class="bx bx-images"></i>
                                <h4>Labore consequatur</h4>
                                <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                                <i class="bx bx-shield"></i>
                                <h4>Beatae veritatis</h4>
                                <p>Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta</p>
                            </div>
                        </div>
                    </div><!-- End .content-->
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="icofont-simple-smile"></i>
                        <span data-toggle="counter-up">232</span>
                        <p>Happy Clients</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                    <div class="count-box">
                        <i class="icofont-document-folder"></i>
                        <span data-toggle="counter-up">521</span>
                        <p>Projects</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <i class="icofont-live-support"></i>
                        <span data-toggle="counter-up">1,463</span>
                        <p>Hours Of Support</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <i class="icofont-users-alt-5"></i>
                        <span data-toggle="counter-up">15</span>
                        <p>Hard Workers</p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg ">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Services</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea.</p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                        <i class="icofont-computer"></i>
                        <h4><a href="#">Lorem Ipsum</a></h4>
                        <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                        <i class="icofont-chart-bar-graph"></i>
                        <h4><a href="#">Dolor Sitema</a></h4>
                        <p>Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                        <i class="icofont-image"></i>
                        <h4><a href="#">Sed ut perspiciatis</a></h4>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                        <i class="icofont-settings"></i>
                        <h4><a href="#">Nemo Enim</a></h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="500">
                        <i class="icofont-earth"></i>
                        <h4><a href="#">Magni Dolore</a></h4>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="600">
                        <i class="icofont-tasks-alt"></i>
                        <h4><a href="#">Eiusmod Tempor</a></h4>
                        <p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Services Section -->


    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Testimonials</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea.</p>
            </div>

            <div class="owl-carousel testimonials-carousel">

                <div class="testimonial-wrap">
                    <div class="testimonial-item">
                        <img src="Presento/assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                        <h3>Saul Goodman</h3>
                        <h4>Ceo &amp; Founder</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div>

                <div class="testimonial-wrap">
                    <div class="testimonial-item">
                        <img src="Presento/assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                        <h3>Sara Wilsson</h3>
                        <h4>Designer</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div>

                <div class="testimonial-wrap">
                    <div class="testimonial-item">
                        <img src="Presento/assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                        <h3>Jena Karlis</h3>
                        <h4>Store Owner</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div>

                <div class="testimonial-wrap">
                    <div class="testimonial-item">
                        <img src="Presento/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                        <h3>Matt Brandon</h3>
                        <h4>Freelancer</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div>

                <div class="testimonial-wrap">
                    <div class="testimonial-item">
                        <img src="Presento/assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                        <h3>John Larson</h3>
                        <h4>Entrepreneur</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat esse veniam culpa fore nisi cillum quid.
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Pricing Section ======= -->
{{--    <section id="pricing" class="pricing section-bg">--}}
{{--        <div class="container" data-aos="fade-up">--}}

{{--            <div class="section-title">--}}
{{--                <h2>Pricing</h2>--}}
{{--                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea.</p>--}}
{{--            </div>--}}

{{--            <div class="row">--}}

{{--                <div class="col-lg-4 col-md-6">--}}
{{--                    <div class="box" data-aos="fade-up" data-aos-delay="100">--}}
{{--                        <h3>Free</h3>--}}
{{--                        <h4><sup>$</sup>0<span> / month</span></h4>--}}
{{--                        <ul>--}}
{{--                            <li>Aida dere</li>--}}
{{--                            <li>Nec feugiat nisl</li>--}}
{{--                            <li>Nulla at volutpat dola</li>--}}
{{--                            <li class="na">Pharetra massa</li>--}}
{{--                            <li class="na">Massa ultricies mi</li>--}}
{{--                        </ul>--}}
{{--                        <div class="btn-wrap">--}}
{{--                            <a href="#" class="btn-buy">Buy Now</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-lg-4 col-md-6 mt-4 mt-md-0">--}}
{{--                    <div class="box featured" data-aos="fade-up" data-aos-delay="200">--}}
{{--                        <h3>Business</h3>--}}
{{--                        <h4><sup>$</sup>19<span> / month</span></h4>--}}
{{--                        <ul>--}}
{{--                            <li>Aida dere</li>--}}
{{--                            <li>Nec feugiat nisl</li>--}}
{{--                            <li>Nulla at volutpat dola</li>--}}
{{--                            <li>Pharetra massa</li>--}}
{{--                            <li class="na">Massa ultricies mi</li>--}}
{{--                        </ul>--}}
{{--                        <div class="btn-wrap">--}}
{{--                            <a href="#" class="btn-buy">Buy Now</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">--}}
{{--                    <div class="box" data-aos="fade-up" data-aos-delay="300">--}}
{{--                        <h3>Developer</h3>--}}
{{--                        <h4><sup>$</sup>29<span> / month</span></h4>--}}
{{--                        <ul>--}}
{{--                            <li>Aida dere</li>--}}
{{--                            <li>Nec feugiat nisl</li>--}}
{{--                            <li>Nulla at volutpat dola</li>--}}
{{--                            <li>Pharetra massa</li>--}}
{{--                            <li>Massa ultricies mi</li>--}}
{{--                        </ul>--}}
{{--                        <div class="btn-wrap">--}}
{{--                            <a href="#" class="btn-buy">Buy Now</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}
{{--    </section>--}}

<!-- End Pricing Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Frequently Asked Questions</h2>
            </div>

            <ul class="faq-list accordion" data-aos="fade-up">

                <li>
                    <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq1">Non consectetur a erat nam at lectus urna duis? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
                    <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                        </p>
                    </div>
                </li>

                <li>
                    <a data-bs-toggle="collapse" data-bs-target="#faq2" class="collapsed">Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
                    <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                        </p>
                    </div>
                </li>

                <li>
                    <a data-bs-toggle="collapse" data-bs-target="#faq3" class="collapsed">Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
                    <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                        </p>
                    </div>
                </li>

                <li>
                    <a data-bs-toggle="collapse" data-bs-target="#faq4" class="collapsed">Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
                    <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                        </p>
                    </div>
                </li>

                <li>
                    <a data-bs-toggle="collapse" data-bs-target="#faq5" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
                    <div id="faq5" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
                        </p>
                    </div>
                </li>

                <li>
                    <a data-bs-toggle="collapse" data-bs-target="#faq6" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
                    <div id="faq6" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.
                        </p>
                    </div>
                </li>

            </ul>

        </div>
    </section><!-- End Frequently Asked Questions Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Team</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea.</p>
            </div>

            <div class="row">

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="Presento/assets/img/team/team-1.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Walter White</h4>
                            <span>Chief Executive Officer</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="200">
                        <div class="member-img">
                            <img src="Presento/assets/img/team/team-2.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Sarah Jhonson</h4>
                            <span>Product Manager</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="300">
                        <div class="member-img">
                            <img src="Presento/assets/img/team/team-3.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>William Anderson</h4>
                            <span>CTO</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="400">
                        <div class="member-img">
                            <img src="Presento/assets/img/team/team-4.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Amanda Jepson</h4>
                            <span>Accountant</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- End Team Section -->


</main>
<!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>{{config('app.name')}} <img src="logo.png" style="max-width: 40px;"> </h3>
                    <p>
                        A108 Adam Street <br>
                        New York, NY 13100<br>
                        Kingdon of Saudia Arabia (KSA) <br><br>
                        <strong>Phone:</strong> +97 123-4567<br>
                        <strong>Email:</strong> info@emdad-chain.com<br>
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
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="https://instagram.com/emdad_chain?igshid=ok4zahralc2t" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="https://www.linkedin.com/company/emdadchain" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->
<script src="Presento/assets/vendor/jquery/jquery.min.js"></script>
<script src="Presento/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="Presento/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="Presento/assets/vendor/php-email-form/validate.js"></script>
<script src="Presento/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="Presento/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="Presento/assets/vendor/counterup/counterup.min.js"></script>
<script src="Presento/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="Presento/assets/vendor/venobox/venobox.min.js"></script>
<script src="Presento/assets/vendor/aos/aos.js"></script>

<!-- Template Main JS File -->
<script src="Presento/assets/js/main.js"></script>

</body>

</html>
