

<!-- ======= Header ======= -->
@include('webLayout.header_ar')
<!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <div class="container" data-aos="zoom-in" data-aos-delay="100" style="direction: rtl">
        <div class="row">
            <div class="col-xl-12">
                <h5 class="text-warning mainColor">تعمل منصة إمداد على تسهيل عمليات سلاسل الإمداد المحلية في المملكة العربية السعودية إلى عمليات أكثر ذكاءً واستدامة وفقًا لرؤية  2030.
                </h5>
                <h5 class="text-warning mainColor">فريق إمداد يشكركم لزيارتكم للمنصة, يمكنك اختيارنا لنشاركك قوة منصتنا وخبرتنا في إدارة سلاسل الإمداد
                </h5>
            </div>
            <div class="col-xl-6 d-none d-lg-block">
                <p class="text-white font-bold">بصفتك المشتري، نمكنك من تحقيق إستراتيجية عمل المشتريات بطريقة أكثر كفاءة و إحترافيةومن الأمثلة على ذلك:
                    <br>
                </p>
                <ol class="text-white">
                    <li>التحكم في تكلفة المشتريات
                    </li>
                    <li>

                        رفع مستوى جودة استلام الشحنات</li>
                    <li>

                        كفاءة تنظيم العمليات الشرائية</li>
                    <li>

                        خدمات احترافية مبتكرة</li>
                    <li>

                        مصادر معتمدة</li>
                    <li>
                        تطوير المهارات
                    </li>
                </ol>
                {{--                <a href="#about" class="btn-get-started scrollto">Get Started</a>--}}
            </div>
            <div class="col-xl-6 d-none d-lg-block">
                <p class="text-white font-bold">وكصفتك المورد، يمكنك تحقيق إستراتيجية عمل المبيعات بطريقة أكثر كفاءة و إحترافية ، ومن الأمثلة على ذلك:
                </p>
                <ol class="text-white">
                    <li>بناء علاقات قوية مع العملاء</li>
                    <li>

                        سهولة التواصل المباشر مع العميل</li>
                    <li>

                        تحسين رضا العميل</li>
                    <li>

                        تسليم الشحنات بشكل موثوق</li>
                    <li>

                        تطوير الاعمال على المدى البعيد

                    </li>
                </ol>
                {{--                <a href="#about" class="btn-get-started scrollto">Get Started</a>--}}
            </div>
        </div>
    </div>

</section><!-- End Hero -->

<main id="main">


    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg" style="direction: rtl;">
        <div class="container" data-aos="fade-up">

            <div class="row no-gutters">
                <div class="content col-xl-5 d-flex align-items-stretch">
                    <div class="content">
                        <h3 class="mainColor">ماهي منصة إمداد</h3>
                        <p>
                            هي أضخم منصة الكترونية بنيت بخبرة عالية لتخدم البائع والمشتري في عمليات الشراء والبيع والتوريد والتخزين، بأقل التكاليف وأفضل المعايير التقنية واللوجستية.
                        </p>
                        <a href="{{route('aboutUsAr')}}" class="about-btn"><span>من نحن</span> <i class="bx bx-chevron-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-7 d-flex align-items-stretch">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                                <i class="bx bx-receipt"></i>
                                <h4>الرؤية</h4>
                                <p>
                                    أضخم منصة تقنية موثوقة تخدم سلاسل الإمداد وتمتلك اكبر عدد من الموردين وأضخم اسطول لوجستي بأفضل معايير الجودة العالمية.
                                </p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                                <i class="bx bx-cube-alt"></i>
                                <h4>الهدف</h4>
                                <p>أن يكون إمداد اسماً موثوقاً به كمنصة لسلاسل الامداد في العالم.</p>
                            </div>
                        </div>
                    </div><!-- End .content-->
                </div>
            </div>

        </div>
    </section><!-- End About Section -->


    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg ">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>بماذا تتميز منصة إمداد؟</h2>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                        <i class="icofont-computer"></i>
                        <h4><a href="#">الخارطة الذكية
                            </a></h4>
                        <p>من أعظم انجازات المنصة هو عمل الخريطة الذكية وتعتبر الأولى في مجالها والرائدة لتمكن المستخدم من الموصول للمورد الصحيح خلال دقيقة واحدة في أكثر من ٥٠٠ فئه متاحة.
                        </p><br>
                    </div>
                </div>

                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="500">
                        <i class="icofont-earth"></i>
                        <h4><a href="#">توفير الوقت والجهد</a></h4>
                        <ol>
                            <li>هي المقياس الأساسي التي بنيت عليه المنصة.</li>
                            <li>سرعة وسهولة الاعتمادات الإلكترونية.
                            </li>
                            <li>سرعة الحصول على عروض اسعار من عدة موردين.
                            </li>
                            <li>سرعة وسهولة الوصول للمورد الصحيح.
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                        <i class="icofont-chart-bar-graph"></i>
                        <h4><a href="#">الأمان</a></h4>
                        <ol>
                            <li>جميع العمليات محفوظة في سحابة مرجعية ولا يتم ازالتها بتاتاً.</li>
                            <li>
                                تم استخدام أحدث تِقنيات الأمان لضمانة عدم التلاعب او العبث بحساب المستخدم.
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                        <i class="icofont-settings"></i>
                        <h4><a href="#">الجودة
                            </a></h4>
                        <p>من أساسيات عملنا في المنصة هي ضمانة جودة عمليات المستخدمين.
                        </p>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- End Services Section -->


    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>أسئلة مكررة</h2>
            </div>

            <ul class="faq-list accordion" data-aos="fade-up">
                @foreach(\App\Models\FAQs::all() as $faq)
                    <li>
                        <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq{{$faq->id}}">{{$faq->question_ar}}<i class="bx bx-chevron-down icon-show"></i><i
                                class="bx bx-x icon-close"></i></a>
                        <div id="faq{{$faq->id}}" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                {{$faq->answer_ar}}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>

        </div>
    </section><!-- End Frequently Asked Questions Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>فريق العمل
                </h2>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="{{url('webmainimages/male.jpeg')}}" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>عبدالعزيز السناني
                            </h4>
                            <span>مؤسس ومدير مجلس الإدارة
</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="400">
                        <div class="member-img">
                            <img src="{{url('webmainimages/male.jpeg')}}" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>احسن رضا</h4>
                            <span>مدير تطوير الأعمال</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="200">
                        <div class="member-img">
                            <img src="{{url('webmainimages/male.jpeg')}}" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>ريان السناني</h4>
                            <span>محاسب أول</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="300">
                        <div class="member-img">
                            <img src="{{url('webmainimages/male.jpeg')}}" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>متعب البريكان</h4>
                            <span>مسؤول الموارد البشرية</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5"></div>
                <div class="col-lg-2">
                    <div align="center"><a href="{{route('ourTeamAr')}}"  class="get-started-btn" style="font-family: arabicFont;">مزید</a></div>
                </div>
                <div class="col-lg-5"></div>
            </div>

        </div>
    </section>
    <!-- End Team Section -->

</main><!-- End #main -->

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
