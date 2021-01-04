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
                <li>About Us</li>
            </ol>
            <h2 class="mainColor">About Us</h2>
        </div>
    </section>
    <!-- End Breadcrumbs -->

    <section class="inner-page" style="font-family: tahoma;">


        <div class="container" data-aos="fade-in">
            <h1 style="font-weight: bold;" class="mainColor">What is Emdad Platform?</h1>
            <p>
                It is one of the largest electronic platform incorporating high level of experiences and cutting technologies to serve the seller and the buyer in buying, selling, supply and storage
                operations, at the lowest costs while providing the best logistic standards.
            </p>
        </div>
        <hr>
        <div class="container mainColor" data-aos="fade-in">
            <h1 class="" style="font-weight: bold">Vision</h1>
            <p>
                To be the largest supply chain platform that has the largest number of suppliers and the largest logistical fleet in high quality standards.
            </p>
        </div>
        <hr>
        <div class="container mt-4" data-aos="fade-in">
            <h1 class="mainColor" style="font-weight: bold">Mission</h1>
            <p>
                Our Mission We are able and ready to endure the difficulties of all technical developments in the world and keep abreast of the technical development in order to become the first in
                innovation and development and if we get the opportunity to serve other planets, we will!
            </p>
        </div>
        <hr>
        <div class="container mt-4" data-aos="fade-in">
            <h1 class="mainColor" style="font-weight: bold">Goal</h1>
            <p>
                Goal Emdad to be a trustable name as a supply chain platform.
            </p>
        </div>
        <hr>
        <div class="container mt-4" data-aos="fade-in">
            <h1 class="text-center" style="font-weight: bold">Platform capabilities</h1>
            <p>
                <img src="{{url('webmainimages/platformCapibalities.png')}}" class="img-fluid rounded " alt="">
            </p>
        </div>


    </section>

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
