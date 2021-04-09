@extends('shipter.layout')
@section('title','Home')
@section('custom-header')
@endsection
@section('custom-body-style')
@endsection
@section('inside-body')
    <!-- header-area start -->
    <header>
        <div class="header-top">
            <div class="container">
                <div class="row">
                    @include('shipter.top-header')
                </div>
            </div>
        </div>
        <div class="header-top header-top-2">
            <div class="container">
                <div class="row">
                    @include('shipter.header-container')
                </div>
            </div>
        </div>
        <div class="header-area header-style-2">
            <div class="header-sub" id="sticky-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 d-none d-lg-block">
                            <div class="main-menu">
                               @include('shipter.menu')
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
                        <div class="col-xl-12 slide-caption">
{{--                            <h2><span>We Provide the Best Solution</span> <span>For Your Transport.</span></h2>--}}
                            <h3 class="text-warning">Emdad platform is an online platform established with high level of experience and knowledge to help both the supplier and buyer with the purchasing
                                , selling, supplying and warehousing process. Emdad provides the lowest costs yet the best technical and logistical standards.</h3>
                            <h3 class="text-warning">Our vision: <br>
                                To become the largest, reliable, online platform specialized in supply chains,
                                and to gain the biggest number of suppliers and the largest logistical fleet while assuring the best international quality standards.</h3>
                            <div class="btns">
                                <div class="btn-style"><a href="{{route('english.about')}}" style="background: #fd7e14">About us</a></div>
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
                            <h3 class="text-warning">Emdad platform is an online platform established with high level of experience and knowledge to help both the supplier and buyer with the purchasing
                                , selling, supplying and warehousing process. Emdad provides the lowest costs yet the best technical and logistical standards.</h3>
                            <h3 class="text-warning">Our vision: <br>
                                To become the largest, reliable, online platform specialized in supply chains,
                                and to gain the biggest number of suppliers and the largest logistical fleet while assuring the best international quality standards.</h3>
                            <div class="btns">
                                <div class="btn-style"><a href="{{route('english.about')}}" style="background: #fd7e14">About us</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of hero slider -->
    <!-- section-section start -->
    <div class="section-area section-style-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-d">
                    <div class="section-item-2">
                        <div class="section-icon">
                            <i class="fi flaticon-ship"></i>
                        </div>
                        <div class="section-content">
                            <p><a href="javascript:void(0)">Smart Map</a></p>
                            <span>One of Emdad’s great features is the smart map which is considered the first in its field.
                            It allows the user to be connected to the right resource within one minute in more than 500 available categories.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-d">
                    <div class="section-item-2">
                        <div class="section-icon">
                            <i class="fi flaticon-truck"></i>
                        </div>
                        <div class="section-content">
                            <p> <a href="javascript:void(0)">Saving Time and Effort</a></p>
                            <span>It is fundamental gauge the platform was built upon.Fast and smooth elictronic authorizations.
                            Quick quotations recieving from multible suppliers.
                            Easy access to the suitable supplier.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-d">
                    <div class="section-item-2">
                        <div class="section-icon">
                            <i class="fi flaticon-plane"></i>
                        </div>
                        <div class="section-content">
                            <p> <a href="javascript:void(0)">Privacy and Safety</a></p>
                            <span>All the transactions are saved in a cloud storage that cannot be removed.
                                The latest security technologies are applied to ensure that the user account is not tampered with.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-d">
                    <div class="section-item-2">
                        <div class="section-icon">
                            <i class="fi flaticon-plane"></i>
                        </div>
                        <div class="section-content">
                            <p> <a href="javascript:void(0)">Quality and Performance</a></p>
                            <span>Umong the basic standards Emdad cares to provide its partners with, and we guarantee you that.</span>
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
                        <h2>What is Emdad Platform?</h2>
                        <p>Is an online platform established with high level of experience and knowledge to help both the supplier and buyer with the purchasing, selling, supplying and warehousing process.</p>
                        <p>Emdad can provide the lowest costs yet the best technical and logistical standards.</p>
                        <span><strong>Our Vision:</strong> To become the largest, reliable online platform specialized in supply chains, and to gain the biggest
                            number of suppliers and the largest logistical fleet while assuring the best international quality standards.</span>
                        <span><strong>Our Goal:</strong> To remove all of the logistical obstacles and upgrade the service level of supply chain for all of Emdad's partners, and we will!</span>
                    </div>
                    <div class="signature-section">
                        <div class="si-text">
                            <p>Abdulaziz AlSinany</p>
                            <span>Founder and CEO</span>
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
    <!-- start track-section -->
{{--    <section class="track-section">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-9">--}}
{{--                    <div class="track">--}}
{{--                        <h3>Enter Your Email and Track Your Cargo</h3>--}}
{{--                        <div class="tracking-form">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-lg-4 col-md-4 col-sm-6">--}}
{{--                                    <form>--}}
{{--                                        <input type="text" class="form-control" placeholder="Email">--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-4 col-md-4 col-sm-6">--}}
{{--                                    <form>--}}
{{--                                        <input type="text" class="form-control" placeholder="Tracking Number">--}}
{{--                                    </form>--}}
{{--                                </div>--}}

{{--                                <div class="col-lg-3 col-md-4 col-sm-6">--}}
{{--                                    <button type="submit">Track Your Cargo</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- end container -->--}}
{{--    </section>--}}
    <!-- end track-section -->
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
                                    <h3>Smart Map</h3>
                                    <p>One of Emdad’s great features is the smart map which is considered the first in its field.
                                        It allows the user to be connected to the right resource within one minute in more than 500 available categories.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="feature-wrap">
                                <div class="features-icon feature-icon3">
                                    <i class="fi flaticon-truck"></i>
                                </div>
                                <div class="features-text">
                                    <h3>Privacy and Safety</h3>
                                    <p>All the transactions are saved in a cloud storage that cannot be removed.
                                        The latest security technologies are applied to ensure that the user account is not tampered with.</p>
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
                                    <h3>Saving Time and Effort</h3>
                                    <p>It is fundamental gauge the platform was built upon.Fast and smooth elictronic authorizations.
                                        Quick quotations recieving from multible suppliers. Easy access to the suitable supplier.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6 col-sm-12">
                            <div class="feature-wrap">
                                <div class="features-icon">
                                    <i class="fi flaticon-truck-1"></i>
                                </div>
                                <div class="features-text">
                                    <h3>Quality and Performance</h3>
                                    <p>Umong the basic standards Emdad cares to provide its partners with, and we guarantee you that.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- feature-area start -->
    <!-- counter-area start -->
{{--    <div class="counter-area counter-style-2">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-7 col-md-6 col-sm-12">--}}
{{--                    <div class="counter-content">--}}
{{--                        <h2>Our Some Important Things That will Satisfite You...</h2>--}}
{{--                        <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.Many desktop publishing packages and web page editors now</p>--}}
{{--                        <div class="btns">--}}
{{--                            <div class="btn-style btn-style-3"><a href="#">Learn More About Us...</a></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-5 col-md-6 col-sm-12">--}}
{{--                    <div class="counter-grids">--}}
{{--                        <div class="grid">--}}
{{--                            <div>--}}
{{--                                <h2><span class="odometer" data-count="4,012">00</span></h2>--}}
{{--                            </div>--}}
{{--                            <p>Delivered Packages</p>--}}
{{--                        </div>--}}
{{--                        <div class="grid">--}}
{{--                            <div>--}}
{{--                                <h2><span class="odometer" data-count="605">00</span></h2>--}}
{{--                            </div>--}}
{{--                            <p>Countries Covered</p>--}}
{{--                        </div>--}}
{{--                        <div class="grid">--}}
{{--                            <div>--}}
{{--                                <h2><span class="odometer" data-count="920">00</span></h2>--}}
{{--                            </div>--}}
{{--                            <p>Satisfied Clients</p>--}}
{{--                        </div>--}}
{{--                        <div class="grid">--}}
{{--                            <div>--}}
{{--                                <h2><span class="odometer" data-count="3,592">00</span></h2>--}}
{{--                            </div>--}}
{{--                            <p>Tons of Goods</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- counter-area end -->
    <!-- pice-area start -->
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
                                        <h5 style="color: #eb8e23">Free (if the user reaches 5 million RS)</h5>
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
    <!-- pice-area end -->
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
                    <h2>Meet the Team</h2>
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
                            <h4>Abdulaziz AlSinany</h4>
                            <span>Founder and CEO</span>
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
                            <h4>Ahsan Raza</h4>
                            <span>Business Development Manager</span>
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
                            <h4>Rayan Al Sinany</h4>
                            <span>Junior Accountant</span>
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
                            <h4>Muteb Al Buraikan</h4>
                            <span>Human Resources Specialist</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- populer-area end -->
    <!-- blog-area start -->
{{--    <div class="blog-area blog-style-2">--}}
{{--        <div class="container">--}}
{{--            <div class="col-l2">--}}
{{--                <div class="section-title section-title-3 text-center">--}}
{{--                    <span>Stay With Our Blog</span>--}}
{{--                    <h2>Our Latest News</h2>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-4 col-md-6 col-12">--}}
{{--                    <div class="blog-item">--}}
{{--                        <div class="blog-img">--}}
{{--                            <img src="{{url('Shipter/assets/images/blog/4.jpg')}}" alt="">--}}
{{--                            <div class="blog-s-text">--}}
{{--                                <div class="blog-content">--}}
{{--                                    <h3>We can ensure you about the safe delevery</h3>--}}
{{--                                </div>--}}
{{--                                <div class="blog-content-sub blog-content-sub-2">--}}
{{--                                    <ul>--}}
{{--                                        <li><a href="#">Business</a></li>--}}
{{--                                        <li>October 13, 2018</li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="blog-text">--}}
{{--                                <div class="blog-content blog-content2">--}}
{{--                                    <h3><a href="blog-details.html">We can ensure you about the safe delevery</a></h3>--}}
{{--                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration</p>--}}
{{--                                    <a href="blog-details.html">Read more...</a>--}}
{{--                                </div>--}}
{{--                                <div class="blog-content-sub blog-content-sub-2">--}}
{{--                                    <ul>--}}
{{--                                        <li><a href="#">Business</a></li>--}}
{{--                                        <li>October 13, 2018</li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-4 col-md-6 col-12">--}}
{{--                    <div class="blog-item">--}}
{{--                        <div class="blog-img">--}}
{{--                            <img src="{{url('Shipter/assets/images/blog/5.jpg')}}" alt="">--}}
{{--                            <div class="blog-s-text">--}}
{{--                                <div class="blog-content">--}}
{{--                                    <h3>We can ensure you about the safe delevery</h3>--}}
{{--                                </div>--}}
{{--                                <div class="blog-content-sub blog-content-sub-2">--}}
{{--                                    <ul>--}}
{{--                                        <li><a href="#">Business</a></li>--}}
{{--                                        <li>October 13, 2018</li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="blog-text">--}}
{{--                                <div class="blog-content blog-content2">--}}
{{--                                    <h3><a href="blog-details.html">We can ensure you about the safe delevery</a></h3>--}}
{{--                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration</p>--}}
{{--                                    <a href="blog-details.html">Read more...</a>--}}
{{--                                </div>--}}
{{--                                <div class="blog-content-sub blog-content-sub-2">--}}
{{--                                    <ul>--}}
{{--                                        <li><a href="#">Business</a></li>--}}
{{--                                        <li>October 13, 2018</li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-4 col-md-6 col-12">--}}
{{--                    <div class="blog-item">--}}
{{--                        <div class="blog-img">--}}
{{--                            <img src="{{url('Shipter/assets/images/blog/6.jpg')}}" alt="">--}}
{{--                            <div class="blog-s-text">--}}
{{--                                <div class="blog-content">--}}
{{--                                    <h3>We can ensure you about the safe delevery</h3>--}}
{{--                                </div>--}}
{{--                                <div class="blog-content-sub blog-content-sub-2">--}}
{{--                                    <ul>--}}
{{--                                        <li><a href="#">Business</a></li>--}}
{{--                                        <li>October 13, 2018</li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="blog-text">--}}
{{--                                <div class="blog-content blog-content2">--}}
{{--                                    <h3><a href="blog-details.html">We can ensure you about the safe delevery</a></h3>--}}
{{--                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration</p>--}}
{{--                                    <a href="blog-details.html">Read more...</a>--}}
{{--                                </div>--}}
{{--                                <div class="blog-content-sub blog-content-sub-2">--}}
{{--                                    <ul>--}}
{{--                                        <li><a href="#">Business</a></li>--}}
{{--                                        <li>October 13, 2018</li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- .footer-area start -->
@endsection
@section('custom-footer')
@endsection
