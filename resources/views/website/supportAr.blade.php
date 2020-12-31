
<!-- ======= Header ======= -->
@include('webLayout.header_ar')
<!-- End Header -->

<!-- ======= Hero Section ======= -->

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container" style="margin-top: 40px;">
            <ol>
                <li><a href="{{config('app.url')}}">الرئيسية</a></li>
                <li>&nbsp;&nbsp; الدعم</li>
            </ol>
            <h2>الدعم</h2>
        </div>
    </section>
    <!-- End Breadcrumbs -->


    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>الدعم</h2>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">

                <div class="col-lg-6">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="info-box">
                                <i class="bx bx-map"></i>
                                <h3>عنواننا</h3>
                                <p>120 Aban Center,<br>
                                    King Abdul Aziz Road, Exit 5,<br>
                                    Riyadh - 13525, Kingdom of Saudi Arabia (KSA)</p>
                                <h3>أوقات العمل</h3>
                                <p>من 9 ص - 5 م | الأحد إلى الخميس</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box mt-4">
                                <i class="bx bx-envelope"></i>
                                <h3>البريد الإلكتروني</h3>
                                <p>info@emdad-chain.com</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box mt-4">
                                <i class="bx bx-phone-call"></i>
                                <h3>هاتف</h3>
                                <p>+966 53 416 8874</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6">
                    <form action="#" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="الاسم" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                <div class="validate"></div>
                            </div>
                            <div class="col form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="البريد الالكتروني" data-rule="email" data-msg="Please enter a valid email" />
                                <div class="validate"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="رقم الجوال" />
                            <div class="validate"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                            <div class="validate"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="الرسالة"></textarea>
                            <div class="validate"></div>
                        </div>
                        <div class="mb-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section>
    <!-- End Contact Section -->

</main>
<!-- End #main -->
<!-- End #main -->

<!-- ======= Footer ======= -->
@include('webLayout.footer_ar')
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
