@extends('shipterAr.layout')
@section('title','الرئيسية')
@section('custom-header')
@endsection
@section('custom-body-style')
    style="font-family: arabicFont;"
@endsection
@section('inside-body')
    <!-- header-area start -->
    <header>
        <div class="header-top">
            <div class="container">
                <div class="row">
                    @include('shipterAr.top-header')
                </div>
            </div>
        </div>
        <div class="header-top header-top-2">
            <div class="container">
                <div class="row">
                    @include('shipterAr.header-container')
                </div>
            </div>
        </div>
        <div class="header-area header-style-2" style="direction: rtl">
            <div class="header-sub" id="sticky-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 d-none d-lg-block">
                            <div class="main-menu">
                               @include('shipterAr.menu')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-area end -->

    <!-- start of hero -->
    <section class="hero hero-slider-wrapper hero-style-1 hero-style-2">
        <div class="hero-slider">
            <div class="slide">
                <img src="{{url('images/hero-bg.jpg')}}" alt class="slider-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 slide-caption" >
{{--                            <h2><span>We Provide the Best Solution</span> <span>For Your Transport.</span></h2>--}}
                            <h3 class="text-warning" style="font-family: arabicFont;direction: rtl;">منصة إمداد هي منصة إلكترونية بنيت بخبرة عالية لتخدم البائع والمشتري في عمليات الشراء والبيع والتوريد والتخزين، بأقل التكاليف وأفضل المعايير التقنية واللوجستية.</h3>
                            <h3 class="text-warning" style="font-family: arabicFont;direction: rtl;">ؤيتنا لمستقبلنا:<br>
                                أضخم منصة تقنية موثوقة تخدم سلاسل الإمداد وتمتلك اكبر عدد من الموردين وأضخم اسطول لوجستي بأفضل معايير الجودة العالمية.</h3>
                            <div class="btns">
                                <div class="btn-style"><a href="{{route('arabic.about')}}" style="background: #fd7e14">من إمداد</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide">
                <img src="{{url('images/1.jpg')}}" alt class="slider-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 slide-caption">
                            {{--                            <h2><span>We Provide the Best Solution</span> <span>For Your Transport.</span></h2>--}}
                            <h3 class="text-warning" style="font-family: arabicFont;direction: rtl;">منصة إمداد هي منصة إلكترونية بنيت بخبرة عالية لتخدم البائع والمشتري في عمليات الشراء والبيع والتوريد والتخزين، بأقل التكاليف وأفضل المعايير التقنية واللوجستية.</h3>
                            <h3 class="text-warning" style="font-family: arabicFont;direction: rtl;">ؤيتنا لمستقبلنا:<br>
                                أضخم منصة تقنية موثوقة تخدم سلاسل الإمداد وتمتلك اكبر عدد من الموردين وأضخم اسطول لوجستي بأفضل معايير الجودة العالمية.</h3>
                            <div class="btns" style="font-family: arabicFont;direction: rtl;">
                                <div class="btn-style"><a href="{{route('arabic.about')}}" style="background: #fd7e14">من إمداد</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of hero slider -->
    <!-- section-section start -->
    <div class="section-area section-style-2" style="direction: rtl">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-d">
                    <div class="section-item-2">
                        <div class="section-icon">
                            <i class="fi flaticon-ship"></i>
                        </div>
                        <div class="section-content">
                            <p><a href="javascript:void(0)">الخارطة الذكية:</a></p>
                            <span>من أعظم انجازات إمداد هو عمل الخريطة الذكية وتعتبر الأولى في مجالها والرائدة لتمكن المستخدم من الوصول للمورد الصحيح خلال دقيقة واحدة في أكثر من ٥٠٠ فئه متاحة.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-d">
                    <div class="section-item-2">
                        <div class="section-icon">
                            <i class="fi flaticon-truck"></i>
                        </div>
                        <div class="section-content">
                            <p> <a href="javascript:void(0)">توفير الوقت والجهد:</a></p>
                            <span>هو المقياس الأساسي الذي بنيت عليه المنصة.
                                    سرعة وسهولة الاعتمادات الإلكترونية.
                                    سرعة الحصول على عروض اسعار من عدة موردين.
                                    سرعة وسهولة الوصول للمورد الصحيح.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-d">
                    <div class="section-item-2">
                        <div class="section-icon">
                            <i class="fi flaticon-plane"></i>
                        </div>
                        <div class="section-content">
                            <p> <a href="javascript:void(0)">الحماية والأمان:</a></p>
                            <span>جميع العمليات محفوظة في سحابة مرجعية ولا يتم إزالتها بتاتاً.
تم استخدام أحدث تِقنيات الأمان لضمانة عدم التلاعب او العبث بحساب المستخدم.                                </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-d">
                    <div class="section-item-2">
                        <div class="section-icon">
                            <i class="fi flaticon-plane"></i>
                        </div>
                        <div class="section-content">
                            <p> <a href="javascript:void(0)">الجودة والأداء:</a></p>
                            <span>من المعايير الأساسية التي تهتم إمداد بتقديمها لمستخدميها، ونضمن لكم ذلك.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--section-section end -->
    <!-- .about-area start -->
    <div class="about-area about-style-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6  offset-lg-6 about-wrap">
                    <div class="about-content">
                        <div class="about-icon">
                            <i class="fi flaticon-travel"></i>
                        </div>
                        <h2>ماهي منصة إمداد؟</h2>
                        <p>هي منصة إلكترونية بنيت بخبرة عالية لتخدم البائع والمشتري في عمليات الشراء والبيع والتوريد والتخزين،</p>
                        <p>بأقل التكاليف وأفضل المعايير التقنية واللوجستية.</p>
                        <span><strong>رؤيتنا لمستقبلنا:</strong> أضخم منصة تقنية موثوقة تخدم سلاسل الإمداد وتمتلك اكبر عدد من الموردين وأضخم اسطول لوجستي بأفضل معايير الجودة العالمية.</span>
                    </div>
                    <div class="signature-section">
                        <div class="si-text">
                            <p>عبدالعزيز السناني</p>
                            <span>مؤسس ومدير مجلس الإدارة</span>
                        </div>
                        <img src="{{url('Shipter/assets/images/about/ceo_sign.png')}}" style="width: 200px;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about-area end -->
    <!-- service-area start-->
    <div class="service-area">
        <div class="container">
            <div class="col-l2">
                <div class="section-title text-center">
                    <span>We Provide the Best</span>
                    <h2>Our Service</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-item">
                        <div class="service-single">
                            <div class="service-img">
                                <img src="{{url('Shipter/assets/images/service/1.jpg')}}" alt="">
                            </div>
                            <div class="service-content">
                                <h3>Logistics Department</h3>
                                <p>More control over inventory management.Precise orders tracking.</p>
                                <a href="{{route('english.service')}}">See More...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-item">
                        <div class="service-single">
                            <div class="service-img">
                                <img src="{{url('Shipter/assets/images/service/2.jpg')}}" alt="">
                            </div>
                            <div class="service-content service-content2">
                                <h3>Sales Department</h3>
                                <p>Easy increase for average sales percentage.Follow up with sales officers regularly.</p>
                                <a href="{{route('english.service')}}">See More...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-item">
                        <div class="service-single">
                            <div class="service-img">
                                <img src="{{url('Shipter/assets/images/service/6.jpg')}}" alt="">
                            </div>
                            <div class="service-content service-content6">
                                <h3>Financial Department</h3>
                                <p>Prevention of misappropriation of funds.</p>
                                <a href="{{route('english.service')}}">See More...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-item">
                        <div class="service-single">
                            <div class="service-img">
                                <img src="{{url('Shipter/assets/images/service/3.jpg')}}" alt="">
                            </div>
                            <div class="service-content service-content3">
                                <h3>Logistics Department</h3>
                                <p>A continuous stock of the required items.</p>
                                <a href="{{route('english.service')}}">See More...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-item">
                        <div class="service-single">
                            <div class="service-img">
                                <img src="{{url('Shipter/assets/images/service/4.jpg')}}" alt="">
                            </div>
                            <div class="service-content service-content4">
                                <h3>Purchases Department</h3>
                                <p>Online purchase orders approval.Available online reports around the clock.</p>
                                <a href="{{route('english.service')}}">See More...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-item">
                        <div class="service-single">
                            <div class="service-img">
                                <img src="{{url('Shipter/assets/images/service/5.jpg')}}" alt="">
                            </div>
                            <div class="service-content service-content5">
                                <h3>Financial Department</h3>
                                <p>Quotations received from reliable suppliers.</p>
                                <a href="{{route('english.service')}}">See More...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service-area end-->
    <!-- feature-area start -->
    <div class="features-area features-style-2">
        <div class="container">
            <div class="section-title text-center">
                <span>We Provide the Best</span>
                <h2>Our Awesome Features</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="features-item features-item-2">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="feature-wrap">
                                <div class="features-icon features-icon2">
                                    <i class="fi flaticon-plane"></i>
                                </div>
                                <div class="features-text">
                                    <h3>الخارطة الذكية:</h3>
                                    <p>من أعظم انجازات إمداد هو عمل الخريطة الذكية وتعتبر الأولى في مجالها والرائدة لتمكن المستخدم من الوصول للمورد الصحيح خلال دقيقة واحدة في أكثر من ٥٠٠ فئه متاحة.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="feature-wrap">
                                <div class="features-icon feature-icon3">
                                    <i class="fi flaticon-truck"></i>
                                </div>
                                <div class="features-text">
                                    <h3>الحماية والأمان:</h3>
                                    <p>جميع العمليات محفوظة في سحابة مرجعية ولا يتم إزالتها بتاتاً.
                                        تم استخدام أحدث تِقنيات الأمان لضمانة عدم التلاعب او العبث بحساب المستخدم.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="features-item">
                        <div class="feature-img">
                            <img src="{{url('Shipter/assets/images/features/1.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="features-item">
                        <div class="col-lg-12 col-md-6 col-sm-12">
                            <div class="feature-wrap">
                                <div class="features-icon">
                                    <i class="fi flaticon-ship"></i>
                                </div>
                                <div class="features-text">
                                    <h3>توفير الوقت والجهد:</h3>
                                    <p>هو المقياس الأساسي الذي بنيت عليه المنصة.
                                        سرعة وسهولة الاعتمادات الإلكترونية.
                                        سرعة الحصول على عروض اسعار من عدة موردين.
                                        سرعة وسهولة الوصول للمورد الصحيح.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6 col-sm-12">
                            <div class="feature-wrap">
                                <div class="features-icon">
                                    <i class="fi flaticon-truck-1"></i>
                                </div>
                                <div class="features-text">
                                    <h3>الجودة والأداء:</h3>
                                    <p>من المعايير الأساسية التي تهتم إمداد بتقديمها لمستخدميها، ونضمن لكم ذلك.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- feature-area start -->
    <!-- price-area start -->
    <div class="pricing-area pricing-area-2">
        <div class="container">
            <div class="section-title text-center">
                <span>We Give You The Best</span>
                <h2>Our Pricing Plan For Buyer</h2>
            </div>
            <div class="btns">
                <div class="btn-style"><a href="{{route('english.buyerPackage')}}" target="_blank" style="background: #fd7e14">Details</a></div>
            </div>
            <div class="row" style="padding-top: 20px;">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-3 col-l2 col-md-6 col-sm-6">
                            <div class="price-item">
                                <div class="pricing-header">
                                    <h3>Basic</h3>
                                    <span>Buyer</span>
                                </div>
                                <div class="pricing-table">
                                    <div class="price-sub-header">
                                        <h4>Free</h4>
                                    </div>
                                    <div class="pricing-footer">
                                        <div class="btns">
                                            <div class="btn-style btn-style-4"><a href="{{route('register')}}">Order Now</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-l2 col-md-6 col-sm-6">
                            <div class="price-item">
                                <div class="pricing-header">
                                    <h3>Silver</h3>
                                    <span>Buyer</span>
                                </div>
                                <div class="pricing-table">
                                    <div class="price-sub-header">
                                        <h4>5000 SAR</h4>
                                    </div>
                                    <div class="pricing-footer">
                                        <div class="btns">
                                            <div class="btn-style btn-style-4"><a href="{{route('register')}}">Order Now</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-l2 col-md-6 col-sm-6">
                            <div class="price-item">
                                <div class="pricing-header">
                                    <h3>Gold</h3>
                                    <span>Buyer</span>
                                </div>
                                <div class="pricing-table">
                                    <div class="price-sub-header">
                                        <h4>15000 SAR</h4>
                                    </div>
                                    <div class="pricing-footer">
                                        <div class="btns">
                                            <div class="btn-style btn-style-4"><a href="{{route('register')}}">Order Now</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-l2 col-md-6 col-sm-6">
                            <div class="price-item">
                                <div class="pricing-header">
                                    <h3>Platinum</h3>
                                    <span>Buyer</span>
                                </div>
                                <div class="pricing-table">
                                    <div class="price-sub-header">
                                        <h5 style="color: #eb8e23">Free (5 million purchases/month)</h5>
                                    </div>
                                    <div class="pricing-footer">
                                        <div class="btns">
                                            <div class="btn-style btn-style-4"><a href="{{route('register')}}">Order Now</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-title text-center">
                <span>We Give You The Best</span>
                <h2>Our Pricing Plan For Supplier</h2>
            </div>
            <div class="btns">
                <div class="btn-style"><a href="{{route('english.supplierPackage')}}" target="_blank" style="background: #fd7e14">Details</a></div>
            </div>
            <div class="row" style="padding-top: 20px;">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-3 col-l2 col-md-6 col-sm-6">
                            <div class="price-item">
                                <div class="pricing-header">
                                    <h3>Basic</h3>
                                    <span>Supplier</span>
                                </div>
                                <div class="pricing-table">
                                    <div class="price-sub-header">
                                        <h4>Free</h4>
                                    </div>
                                    <div class="pricing-footer">
                                        <div class="btns">
                                            <div class="btn-style btn-style-4"><a href="{{route('register')}}">Order Now</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-l2 col-md-6 col-sm-6">
                            <div class="price-item">
                                <div class="pricing-header">
                                    <h3>Silver</h3>
                                    <span>Supplier</span>
                                </div>
                                <div class="pricing-table">
                                    <div class="price-sub-header">
                                        <h4>1500 SAR</h4>
                                    </div>
                                    <div class="pricing-footer">
                                        <div class="btns">
                                            <div class="btn-style btn-style-4"><a href="{{route('register')}}">Order Now</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-l2 col-md-6 col-sm-6">
                            <div class="price-item">
                                <div class="pricing-header">
                                    <h3>Gold</h3>
                                    <span>Supplier</span>
                                </div>
                                <div class="pricing-table">
                                    <div class="price-sub-header">
                                        <h4>5000 SAR</h4>
                                    </div>
                                    <div class="pricing-footer">
                                        <div class="btns">
                                            <div class="btn-style btn-style-4"><a href="{{route('register')}}">Order Now</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- price-area end -->
    <!-- testimonial-area start -->
    <div class="testimonial-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="testimonial-active owl-carousel">
                        <div class="testimonial-wrap">
                            <div class="testimonial-img">
                                <img src="{{url('Shipter/assets/images/testimonial/2.jpg')}}" alt="">
                            </div>
                            <div class="testimonial-item">
                                <div class="testimonial-content">
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some</p>
                                    <h4>Manela Watson</h4>
                                    <span>Derector of ATV</span>
                                </div>
                            </div>
                            <div class="test-c d-none d-lg-block"></div>
                            <div class="test-b d-none d-lg-block"></div>
                        </div>
                        <div class="testimonial-wrap">
                            <div class="testimonial-img">
                                <img src="{{url('Shipter/assets/images/testimonial/2.jpg')}}" alt="">
                            </div>
                            <div class="testimonial-item">
                                <div class="testimonial-content">
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some</p>
                                    <h4>Manela Watson</h4>
                                    <span>Derector of ATV</span>
                                </div>
                            </div>
                            <div class="test-c d-none d-lg-block"></div>
                            <div class="test-b d-none d-lg-block"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testimonial-area end -->
    <!-- team-area start -->
    <div class="team-area team-area-2">
        <div class="container">
            <div class="col-l2">
                <div class="section-title text-center">
                    <h2>فريق العمل</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="team-single">
                        <div class="team-img">
                            <img src="{{url('Shipter/assets/images/team/male.jpeg')}}" alt="">
                            <div class="social-1st">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-content">
                            <h4>عبد العزيز السناني</h4>
                            <span>مؤسس ومدير مجلس الإدارة</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="team-single">
                        <div class="team-img">
                            <img src="{{url('Shipter/assets/images/team/male.jpeg')}}" alt="">
                            <div class="social-1st">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-content">
                            <h4>أحسن رضا</h4>
                            <span>مدير تطوير الأعمال</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="team-single">
                        <div class="team-img">
                            <img src="{{url('Shipter/assets/images/team/male.jpeg')}}" alt="">
                            <div class="social-1st">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-content">
                            <h4>ريان السناني</h4>
                            <span>محاسب إداري</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="team-single">
                        <div class="team-img">
                            <img src="{{url('Shipter/assets/images/team/male.jpeg')}}" alt="">
                            <div class="social-1st">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-content">
                            <h4>متعب البريكان</h4>
                            <span>مسؤول الموارد البشرية</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- team-area end -->
@endsection
@section('custom-footer')
@endsection
