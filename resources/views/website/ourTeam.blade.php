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
                            <img src="{{url('webmainimages/male.jpeg')}}" class="img-fluid" alt=""    >
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
                            <img src="{{url('webmainimages/male.jpeg')}}" class="img-fluid" alt=""    >
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
                                Educational background in IT Over 32 years of experience in the related field.<br>
                                1 - Software development<br>
                                2 - Training<br>
                                3 - System analysis & design<br>
                                Now I want to bring the cutting edge technologies of AI, IOT and Blockchain to this organization.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="200">
                        <div class="member-img">
                            <img src="{{url('webmainimages/male.jpeg')}}" class="img-fluid" alt=""    >
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
                            <p>Specialized in financial accounting, my goal is to develop the company and develop it with innovative ideas to facilitate financial transactions and make Emdad confident in the focus of attention of companies who want to deal with us. I joined Emdad because its idea is distinctive, its field of work is wide and can be fully developed.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="300">
                        <div class="member-img">
                            <img src="{{url('webmainimages/male.jpeg')}}" class="img-fluid" alt=""    >
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
                            <p>I am seeking an opportunity to lead the business with innovative ideas and being capable of developing the path of Emdad to reach great achievements and to recruit my capabilities to develop human resource strategies in entrepreneurship to keep pace with the speed of development of the modern world. Emdad is a mighty idea that can develop every company’s ambitions to the highest possible limits, Also Emdad is the magic gateway capable of transforming a company from any stage into a great success.
                            </p>
                        </div>
                    </div>
                </div>


            </div>

            <div class="row">

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="{{url('webmainimages/female.jpeg')}}" class="img-fluid" alt=""    >
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
                            <p>
                                I aspire to make the utmost effort to reach the best positions and the highest levels by operating my skills and energy in my work and to reach my goal and the position that I aspire to reach. A new supply direction for me, and also in line with Vision 2030. The platform is based on high technology and I want to develop myself and be part of this development.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="200">
                        <div class="member-img">
                            <img src="{{url('webmainimages/female.jpeg')}}" class="img-fluid" alt=""    >
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
                            <p>One of my biggest ambitions is to gain professional experiences from various fields, especially in the field of technology and development, because this field is the future. I chose Emdad because the vision and goals of the platform are very clear and challenging! Also, the platform uses the highest technologies in its system, I am proud of this Saudi work and I see that it has a very big future.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="200">
                        <div class="member-img">
                            <img src="{{url('webmainimages/female.jpeg')}}" class="img-fluid" alt=""    >
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
                            <img src="{{url('webmainimages/male.jpeg')}}" class="img-fluid" alt=""    >
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Mustahsan Rizvi</h4>
                            <span>Office Administrator (Pakistan)</span>
                            <p>
                                Educational background<br>
                                1 - Master in Business Administration With specialization in Management and Finance<br>
                                2 - Masters in Economics with major in Econometrics and International trade<br>
                                3 - Post graduate diploma in IT<br>
                                Over 20 years experience in office administration and business management
                                Now committed to put best efforts to achieve organizational goals.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="200">
                        <div class="member-img">
                            <img src="{{url('webmainimages/alirazamarchal.jpg')}}" class="img-fluid" alt=""    >
                            <div class="social">
                                <a href="https://www.twitter.com/alirazamarchal"><i class="icofont-twitter"></i></a>
                                <a href="https://www.facebook.com/razamarchal"><i class="icofont-facebook"></i></a>
                                <a href="https://www.instagram.com/alirazamarchal/"><i class="icofont-instagram"></i></a>
                                <a href="https://www.linkedin.com/in/alirazamarchal"><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Ali Raza Marchal</h4>
                            <span>Software Developer</span>
                            <p>Software Developer with over 6 years of experience. I have expertise in web based software, database driven applications. I have worked with different industries Schools, Tourism, Health, Government, and Banks.
                                Strong experience in developing web-based applications using the Full Stack.</p>
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
