<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{config('app.name')}}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

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
                <li>Services</li>
            </ol>
            <h2>Services</h2>
        </div>
    </section>
    <!-- End Breadcrumbs -->

    <section class="inner-page" style="font-family: tahoma;">

        <h1 class="text-center" style="font-weight: bold">Services</h1>
        <div class="container mt-4" data-aos="zoom-in">
            <div class="row">
                <div class="col-sm">
                        <img src="{{url('webmainimages/1.jpeg')}}" width="100" height="100" class="img-fluid rounded" alt="our services">
                    <h3>Smart Map</h3>
                    One of the platform's greatest achievements is the work of the smart map and it is considered the first in its field and pioneering to enable the user to connect to the right
                    resource with one minute in more than 500 available categories.
                </div>
                <div class="col-sm">
                    <img src="{{url('webmainimages/2.jpeg')}}"  width="100" height="100"  class="img-fluid rounded" alt="our services">
                    <h3>Safety</h3>

                    <ul>
                        <li>All operations are saved in a reference cloud and are never removed
                        </li>
                        <li>The latest security technologies are used to ensure that the user account is not tampered with</li>
                    </ul>
                </div>
                <div class="col-sm">
                    <img src="{{url('webmainimages/3.jpeg')}}" width="100" height="100" class="img-fluid rounded" alt="our services">
                    <h3>Quality</h3>

                    One of the basic of our work in the platform is to ensure the quality of users' operations.
                </div>
                <div class="col-sm">
                    <img src="{{url('webmainimages/4.jpeg')}}"  width="100" height="100"  class="img-fluid rounded" alt="our services">
                    <h3>Saving time and effort</h3>
                    <ul>
                        <li>It is the primary measure on which the platform is built.
                        </li>
                        <li>Fast and easy electronic accreditation.
                        </li>
                        <li>Quickly obtaining quotations from several suppliers.
                        </li>
                        <li>Quick and easy access to the right resource.</li>
                    </ul>
                </div>
            </div>
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
