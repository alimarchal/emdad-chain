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

</head>

<body>

<!-- ======= Header ======= -->
@include('webLayout.header')
<!-- End Header -->

<!-- ======= Hero Section ======= -->

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container" style="margin-top: 40px;">
            <ol>
                <li><a href="{{config('app.url')}}">Home</a></li>
                <li>Our Team</li>
            </ol>
            <h2 class="mainColor">Our Team</h2>
        </div>
    </section>
    <!-- End Breadcrumbs -->


    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2 class="mainColor">Our Team</h2>
            </div>

            <div class="row">

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="{{url('webmainimages/male.jpeg')}}" class="img-fluid" alt="" height="224" width="224">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Abdulaziz AlSinany</h4>
                            <span>Founder and CEO</span>
                            <p>I am completely confident that the Arabian Island is the orign of trade and the greatest throughout history, and what happened in the last elapsed time and its shift to
                                the West and the East is nothing but a passing period of time, and the Arabian Island will return as it was and better, God willing, we are able and we are can change
                                that and we will
                                <br>And I can prove it before 2030!</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="400">
                        <div class="member-img">
                            <img src="{{url('webmainimages/male.jpeg')}}" class="img-fluid" alt="" height="224" width="224">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Ahsan Raza </h4>
                            <span>Business Development Manager </span>
                            <p>
                                - Educational background in IT<br>
                                - Over 32 years of experience the related field.<br>
                                1 - Software development.<br>
                                2 - Training<br>
                                3 - System analysis<br>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="200">
                        <div class="member-img">
                            <img src="{{url('webmainimages/male.jpeg')}}" class="img-fluid" alt="" height="224" width="224">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Rayan Al Sinany </h4>
                            <span>Juniour Accountant</span>
                            <p>25 years. I study accounting and I love math operations. Innovative person and I love organizing and making plans for every business to start with. I like fishing and
                                swimming. I hope to make the company very organized and professional.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="300">
                        <div class="member-img">
                            <img src="{{url('webmainimages/male.jpeg')}}" class="img-fluid" alt="" height="224" width="224">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Muteb Al Buraikan</h4>
                            <span>Human Resources Specialist</span>
                            <p>Human resources specialist, lover of reading and art. Lover of horses, where the origin of pleasure and the basis of beauty. One of my most important achievements is
                                obtaining the Order of the Custodian of the Two Holy Mosques for contributing to the success of 8 consecutive seasons of Hajj.</p>
                        </div>
                    </div>
                </div>


            </div>

            <div class="row">

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="{{url('webmainimages/female.jpeg')}}" class="img-fluid" alt="" height="224" width="224">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Ala'a Al Hamzy</h4>
                            <span>Administrative Assistant </span>
                            <p>29 years. I'm specialized in educational curriculum methods, but I discovered that my tendencies are administrative, so I developed myself in this field for more than 5
                                years, I always make every effort to reach the best positions and the highest levels by operating my skills and energy in my work and to reach my goal and the position
                                that I aspire to reach. </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="200">
                        <div class="member-img">
                            <img src="{{url('webmainimages/female.jpeg')}}" class="img-fluid" alt="" height="224" width="224">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Rawan Al Shahrani</h4>
                            <span>Digital Marketing Specialist</span>
                            <p>23 years ago, I got interested in the field of marketing after opening my own website specializing in the manufacture of local handmade accessories in 2014, and one of
                                my goals is to open the largest website for handmade accessories. I always aspire for the best, be optimistic, and love to plan and accomplish. </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="200">
                        <div class="member-img">
                            <img src="{{url('webmainimages/female.jpeg')}}" class="img-fluid" alt="" height="224" width="224">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Sara Al Wallan </h4>
                            <span>Public relations and Marketing Specials </span>
                            <p><small>28 years.</small> I'm specialized in Business Administration, I worked in the field of Human Resources and as an Executive Assistant to the Chairman of the Board
                                of Directors.
                                I participated in a lot of volunteer fields. One of my future plans is to be successful, have an impact, and achieve achievement that benefits society. </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="200">
                        <div class="member-img">
                            <img src="{{url('webmainimages/male.jpeg')}}" class="img-fluid" alt="" width="224" height="224">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Mustahsan Rizvi</h4>
                            <span>Admin InCharge Pakistan Office</span>
                            <p>28 years. I'm specialized in Business Administration, I worked in the field of Human Resources and as an Executive Assistant to the Chairman of the Board of Directors.
                                I participated in a lot of volunteer fields. One of my future plans is to be successful, have an impact, and achieve achievement that benefits society. </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="200">
                        <div class="member-img">
                            <img src="{{url('webmainimages/male.jpeg')}}" class="img-fluid" alt="" width="224" height="224">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Ali Raza Marchal</h4>
                            <span>Web Developer</span>
                            <p>28 years. I'm specialized in Business Administration, I worked in the field of Human Resources and as an Executive Assistant to the Chairman of the Board of Directors.
                                I participated in a lot of volunteer fields. One of my future plans is to be successful, have an impact, and achieve achievement that benefits society. </p>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </section>
    <!-- End Team Section -->

</main>
<!-- End #main -->
<!-- End #main -->

<!-- ======= Footer ======= -->
@include('webLayout.footer')
<!-- End Footer -->

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
