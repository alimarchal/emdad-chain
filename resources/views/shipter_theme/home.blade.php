@extends('shipter.layout')
@section('title','Home')
@section('custom-header')
    <style>
        .header-area.header-style-2 .slicknav_btn
        {
            margin-top: 0px!important;
        }
    </style>
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
                        <div class="col-lg-12 d-none d-lg-block">
                            <div class="main-menu">
                                @include('shipter.menu')
                            </div>
                        </div>

                        <div class="col-12 col-sm-11 col-md-9 d-block d-lg-none">
                            <div class="mobile_menu"></div>
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

                            <h3 class="text-white emdad_description">Emdad, is an online (B2B) platform, established by an ambitious and technical expert team, to transform the purchasing, selling, supplying,
                                and warehousing processes into one intelligent and unified platform. It offers the lowest costs, yet the best technical and logistical standards.
                                Emdad aims to make the local supply chain operations in the Kingdom of Saudi Arabia smarter, more advanced and sustainable, according to the Vision 2030.</h3>
                            <div>
{{--                                <div class="btn-style join_us"><a href="{{route('register')}}" class="join_us_font_size">Join us</a></div>--}}
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
                            <h3 class="text-white emdad_description">Emdad, is an online (B2B) platform, established by an ambitious and technical expert team, to transform the purchasing, selling, supplying,
                                and warehousing processes into one intelligent and unified platform. It offers the lowest costs, yet the best technical and logistical standards.
                                Emdad aims to make the local supply chain operations in the Kingdom of Saudi Arabia smarter, more advanced and sustainable, according to the Vision 2030.</h3>
                            <div>
{{--                                <div class="btn-style join_us"><a href="{{route('register')}}" class="join_us_font_size">Join us</a></div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of hero slider -->
    <!-- feature-area start -->
    <div class="features-area features-style-2">
        <div class="container">
            <div class="section-title text-center">
                <span>We Provide the Best</span>
                <h2 style="margin-bottom: 0px">Emdad Benefits</h2>
                <p style="padding-top: 15px; padding-bottom: 15px;color: red; font-weight: bold;font-size: 24px;">

                </p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="features-item features-item-2">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="feature-wrap">
                                <div class="features-icon features-icon2">
                                    <i><img src="{{url('Shipter/assets/images/icon/1.png')}}" alt="" style="width: 40px; transform: rotate(-45deg);"></i>
                                </div>
                                <div class="features-text">
                                    <h3>Smart Map</h3>
                                    <p>One of Emdad’s great features is the smart map which is considered the first in its field.
                                        It allows the <u></u>ser to be connected to the right resource within one minute in more than 500 available categories.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="feature-wrap">
                                <div class="features-icon feature-icon3">
                                    <i><img src="{{url('Shipter/assets/images/icon/2.png')}}" alt="" style="width: 40px;"></i>
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
                            <img src="{{url('Shipter/assets/images/features/3.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="features-item">
                        <div class="col-lg-12 col-md-6 col-sm-12">
                            <div class="feature-wrap">
                                <div class="features-icon">
                                    <i><img src="{{url('Shipter/assets/images/icon/3.png')}}" alt="" style="width: 40px;"></i>
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
                                    <i><img src="{{url('Shipter/assets/images/icon/4.png')}}" alt="" style="width: 40px;"></i>
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
                        <p>Is an online platform established with high level of experience and knowledge to help buyer with the purchasing, selling, supplying and warehousing process.</p>
                        <p>Emdad can provide the lowest costs yet the best technical and logistical standards.</p>
                        <span><strong>Our Vision:</strong> To become the largest, reliable online platform specialized in supply chains, to gain the biggest
                            number of suppliers and the largest logistical fleet while assuring the best international quality standards.</span>
                        <span><strong>Our Goal:</strong> To remove all of the logistical obstacles and upgrade the service level of supply chain for all of Emdad's partners, and we will!</span>
                    </div>
                    <div class="signature-section">
                        <div class="si-text">
                            <p>Abdulaziz AlSinany</p>
                            <span>Founder, CEO and SCM</span>
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
                                <img src="{{url('Shipter/assets/images/service/Photo no.4.jpg')}}" style="width: 350px; height: 236px;" alt="">
                            </div>
                            <div class="service-content">
                                <h3>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 172 172"
                                         style=" fill:#000000;
                                        position: absolute;
                                        left: -80px;
                                        top: -25px;
                                        transform: scale(1.5);
                                        block-size: 65px;
                                        color: #eb8e23;">
                                        <g transform=""><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="none"></path>
                                                <g fill="#eb8e23"><path d="M44.0916,44.71664c-4.23661,0 -7.69913,3.46252 -7.69913,7.69913v60.30984c0,1.40261 1.16377,2.56638 2.56638,2.56638h9.0575c0.63889,5.76933 5.53593,10.26801 11.47351,10.26801c5.93673,0 10.83349,-4.49736 11.47351,-10.26551h27.02214h6.49113c0.64002,5.76814 5.53678,10.26551 11.47351,10.26551c5.93673,0 10.83349,-4.49736 11.47351,-10.26551h3.92726c4.23661,0 7.69509,-3.46339 7.69662,-7.69913v-24.05978c0,-0.00167 0,-0.00334 0,-0.00501c-0.00462,-1.25985 -0.31399,-2.50489 -0.91477,-3.6215l-9.07003,-16.84184c-1.77002,-3.35425 -5.25143,-5.51137 -9.06001,-5.51871c-0.00084,0 -0.00167,0 -0.00251,0h-20.73151v-5.13275c0,-4.23661 -3.46252,-7.69913 -7.69913,-7.69913zM44.0916,47.28302h47.47796c2.84916,0 5.13275,2.28359 5.13275,5.13275v6.41594c0,0.00084 0,0.00167 0,0.00251v20.53101h-57.74347v-15.39826h39.13724c0.23138,0.00327 0.4466,-0.11829 0.56325,-0.31815c0.11665,-0.19985 0.11665,-0.44703 0,-0.64689c-0.11665,-0.19985 -0.33187,-0.32142 -0.56325,-0.31815h-39.13724v-10.26801c0,-2.84916 2.28359,-5.13275 5.13275,-5.13275zM97.98551,60.1149h22.0147c2.84337,0.00642 5.46526,1.62686 6.79689,4.15783c0.00248,0.00419 0.00499,0.00837 0.00752,0.01253l9.07004,16.84184c0.39673,0.73829 0.60341,1.56718 0.60651,2.4135v6.09013h-25.02217c-1.07148,0 -1.92478,-0.8533 -1.92478,-1.92478v-19.24782c0,-1.07148 0.8533,-1.92478 1.92478,-1.92478h6.41594c0.23138,0.00327 0.4466,-0.11829 0.56325,-0.31815c0.11665,-0.19985 0.11665,-0.44703 0,-0.64689c-0.11665,-0.19985 -0.33187,-0.32142 -0.56325,-0.31815h-6.41594c-1.76436,0 -3.20797,1.44361 -3.20797,3.20797v19.24782c0,1.76436 1.44361,3.20797 3.20797,3.20797h25.02217v8.98232h-4.49116c-1.76436,0 -3.20797,1.44361 -3.20797,3.20797v2.56638c0,1.76436 1.44361,3.20797 3.20797,3.20797h4.31322c-0.56783,2.21791 -2.54966,3.84956 -4.9523,3.84956h-3.92726c-0.64002,-5.76814 -5.53678,-10.26551 -11.47351,-10.26551c-5.93673,0 -10.83349,4.49736 -11.47351,10.26551h-6.49113v-32.61854c0.01131,-0.06888 0.01131,-0.13914 0,-0.20802zM81.94565,62.68378c-0.23138,-0.00327 -0.4466,0.11829 -0.56325,0.31815c-0.11665,0.19985 -0.11665,0.44703 0,0.64689c0.11665,0.19985 0.33187,0.32142 0.56325,0.31815h6.41594c0.23138,0.00327 0.4466,-0.11829 0.56325,-0.31815c0.11665,-0.19985 0.11665,-0.44703 0,-0.64689c-0.11665,-0.19985 -0.33187,-0.32142 -0.56325,-0.31815zM92.21116,62.68378c-0.23138,-0.00327 -0.4466,0.11829 -0.56325,0.31815c-0.11665,0.19985 -0.11665,0.44703 0,0.64689c0.11665,0.19985 0.33187,0.32142 0.56325,0.31815h1.28319c0.23138,0.00327 0.4466,-0.11829 0.56325,-0.31815c0.11665,-0.19985 0.11665,-0.44703 0,-0.64689c-0.11665,-0.19985 -0.33187,-0.32142 -0.56325,-0.31815zM120.4413,65.25016c-0.23138,-0.00327 -0.4466,0.11829 -0.56325,0.31815c-0.11665,0.19985 -0.11665,0.44703 0,0.64689c0.11665,0.19985 0.33187,0.32142 0.56325,0.31815h1.28319c0.23138,0.00327 0.4466,-0.11829 0.56325,-0.31815c0.11665,-0.19985 0.11665,-0.44703 0,-0.64689c-0.11665,-0.19985 -0.33187,-0.32142 -0.56325,-0.31815zM124.29086,65.25016c-0.23138,-0.00327 -0.4466,0.11829 -0.56325,0.31815c-0.11665,0.19985 -0.11665,0.44703 0,0.64689c0.11665,0.19985 0.33187,0.32142 0.56325,0.31815h1.28319c0.23138,0.00327 0.4466,-0.11829 0.56325,-0.31815c0.11665,-0.19985 0.11665,-0.44703 0,-0.64689c-0.11665,-0.19985 -0.33187,-0.32142 -0.56325,-0.31815zM38.95885,80.64841h57.74347v14.11507h-57.74347zM38.95885,96.04667h57.74347v16.68145h-25.73895c-0.64002,-5.76814 -5.53678,-10.26551 -11.47351,-10.26551c-5.93587,0 -10.83236,4.49605 -11.47351,10.263h-9.0575v-3.84706h4.49116c1.76436,0 3.20797,-1.44361 3.20797,-3.20797v-2.56638c0,-1.76436 -1.44361,-3.20797 -3.20797,-3.20797h-4.49116zM38.95885,101.17943h4.49116c1.07148,0 1.92478,0.8533 1.92478,1.92478v2.56638c0,1.07148 -0.8533,1.92478 -1.92478,1.92478h-4.49116zM131.98999,101.17943h4.49116v6.41594h-4.49116c-1.07148,0 -1.92478,-0.8533 -1.92478,-1.92478v-2.56638c0,-1.07148 0.8533,-1.92478 1.92478,-1.92478zM59.48986,103.7458c5.67709,0 10.26551,4.58842 10.26551,10.26551c0,5.67708 -4.58842,10.26551 -10.26551,10.26551c-5.67709,0 -10.26551,-4.58842 -10.26551,-10.26551c0,-5.67708 4.58842,-10.26551 10.26551,-10.26551zM115.95014,103.7458c5.67709,0 10.26551,4.58842 10.26551,10.26551c0,5.67708 -4.58842,10.26551 -10.26551,10.26551c-5.67709,0 -10.26551,-4.58842 -10.26551,-10.26551c0,-5.67708 4.58842,-10.26551 10.26551,-10.26551zM59.48986,108.87855c-1.65745,0 -2.98094,0.64465 -3.84706,1.61902c-0.86611,0.97438 -1.28569,2.24836 -1.28569,3.51373c0,1.26537 0.41958,2.53935 1.28569,3.51373c0.86611,0.97438 2.18961,1.61902 3.84706,1.61902c1.65745,0 2.98094,-0.64465 3.84706,-1.61902c0.86611,-0.97438 1.28569,-2.24836 1.28569,-3.51373c0,-1.26537 -0.41958,-2.53935 -1.28569,-3.51373c-0.86611,-0.97438 -2.18961,-1.61902 -3.84706,-1.61902zM115.95014,108.87855c-1.65745,0 -2.98094,0.64465 -3.84706,1.61902c-0.86611,0.97438 -1.28569,2.24836 -1.28569,3.51373c0,1.26537 0.41958,2.53935 1.28569,3.51373c0.86611,0.97438 2.18961,1.61902 3.84706,1.61902c1.65745,0 2.98094,-0.64465 3.84706,-1.61902c0.86611,-0.97438 1.28569,-2.24836 1.28569,-3.51373c0,-1.26537 -0.41958,-2.53935 -1.28569,-3.51373c-0.86611,-0.97438 -2.18961,-1.61902 -3.84706,-1.61902zM59.48986,110.16174c1.33665,0 2.25874,0.47814 2.88968,1.18795c0.63094,0.70981 0.95989,1.6814 0.95989,2.66161c0,0.98021 -0.32895,1.95181 -0.95989,2.66161c-0.63094,0.70981 -1.55303,1.18795 -2.88968,1.18795c-1.33665,0 -2.25874,-0.47814 -2.88968,-1.18795c-0.63094,-0.70981 -0.95989,-1.6814 -0.95989,-2.66161c0,-0.98021 0.32895,-1.95181 0.95989,-2.66161c0.63094,-0.70981 1.55303,-1.18795 2.88968,-1.18795zM115.95014,110.16174c1.33665,0 2.25874,0.47814 2.88968,1.18795c0.63094,0.70981 0.95989,1.6814 0.95989,2.66161c0,0.98021 -0.32895,1.95181 -0.95989,2.66161c-0.63094,0.70981 -1.55303,1.18795 -2.88968,1.18795c-1.33665,0 -2.25874,-0.47814 -2.88968,-1.18795c-0.63094,-0.70981 -0.95989,-1.6814 -0.95989,-2.66161c0,-0.98021 0.32895,-1.95181 0.95989,-2.66161c0.63094,-0.70981 1.55303,-1.18795 2.88968,-1.18795z"></path></g></g></g></svg>

                                    Logistics Department</h3>
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
                                <img src="{{url('Shipter/assets/images/service/Photo no.5.jpg')}}" style="width: 350px; height: 236px;" alt="">
                            </div>
                            <div class="service-content service-content2">
                                <h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                         width="80" height="80"
                                         viewBox="0 0 172 172"
                                         style=" fill:#000000;
                                         position: absolute;
                                        left: -95px;
                                        top: -20px;
                                        height: fit-content;
                                        block-size: 65px;">
                                        <g transform="translate(25.8,25.8) scale(0.7,0.7)"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path>
                                                <g id="original-icon" fill="#eb8e23"><path d="M10.75,27.95v2.15v88.15v6.45v2.15v8.6h2.15c62.13887,0 128.21895,25.65303 128.21895,25.65303l2.93105,1.14219v-20.36621c4.87761,1.21179 7.99111,2.08281 7.99111,2.08281l2.75889,0.81465v-26.52647h6.45v-90.3zM15.05,32.25h141.9v81.7h-141.9zM38.7,36.55c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM47.3,36.55c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM55.9,36.55c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM64.5,36.55c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM73.1,36.55c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM81.7,36.55c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM90.3,36.55c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM98.9,36.55c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM107.5,36.55c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM116.1,36.55c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM124.7,36.55c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM133.3,36.55c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM135.60117,45.1458c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM36.39463,45.1542c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM86,49.45c-13.03607,0 -23.65,10.61393 -23.65,23.65c0,13.03607 10.61393,23.65 23.65,23.65c13.03607,0 23.65,-10.61393 23.65,-23.65c0,-13.03607 -10.61393,-23.65 -23.65,-23.65zM30.0958,51.44463c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM141.8958,51.44883c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM21.5,53.75c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM86,53.75c10.71218,0 19.35,8.63782 19.35,19.35c0,10.71218 -8.63782,19.35 -19.35,19.35c-10.71218,0 -19.35,-8.63782 -19.35,-19.35c0,-10.71218 8.63782,-19.35 19.35,-19.35zM150.5,53.75c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM21.5,62.35c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM150.5,62.35c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM40.85,64.5c-4.72418,0 -8.6,3.87582 -8.6,8.6c0,4.72418 3.87582,8.6 8.6,8.6c4.72418,0 8.6,-3.87582 8.6,-8.6c0,-4.72418 -3.87582,-8.6 -8.6,-8.6zM129,64.5c-4.72418,0 -8.6,3.87582 -8.6,8.6c0,4.72418 3.87582,8.6 8.6,8.6c4.72418,0 8.6,-3.87582 8.6,-8.6c0,-4.72418 -3.87582,-8.6 -8.6,-8.6zM40.85,68.8c2.40029,0 4.3,1.89971 4.3,4.3c0,2.40029 -1.89971,4.3 -4.3,4.3c-2.40029,0 -4.3,-1.89971 -4.3,-4.3c0,-2.40029 1.89971,-4.3 4.3,-4.3zM129,68.8c2.40029,0 4.3,1.89971 4.3,4.3c0,2.40029 -1.89971,4.3 -4.3,4.3c-2.40029,0 -4.3,-1.89971 -4.3,-4.3c0,-2.40029 1.89971,-4.3 4.3,-4.3zM21.5,70.95c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM150.5,70.95c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM21.5,79.55c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM150.5,79.55c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM21.5,88.15c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM150.5,88.15c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM141.8958,90.45117c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM30.0958,90.45537c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM36.39043,96.7458c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM135.60117,96.7542c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM38.7,105.35c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM47.3,105.35c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM55.9,105.35c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM64.5,105.35c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM73.1,105.35c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM81.7,105.35c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM90.3,105.35c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM98.9,105.35c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM107.5,105.35c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM116.1,105.35c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM124.7,105.35c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM133.3,105.35c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM15.05,118.25h122.55h12.9v20.87432c-7.02,-1.97443 -60.2089,-16.2312 -135.45,-16.51972zM137.6,118.25c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM133.3,124.7c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15zM15.05,126.87939c46.67644,0.1763 85.40266,5.93363 109.65,10.729c0.00463,1.18413 0.96586,2.14161 2.15,2.1416c0.86592,-0.00028 1.64716,-0.52 1.98203,-1.31855c4.28182,0.88479 7.76082,1.67838 10.91797,2.41875v15.20117c-7.64726,-2.89064 -66.1197,-24.2641 -124.7,-24.80059zM122.55,141.9c-1.18741,0 -2.15,0.96259 -2.15,2.15c0,1.18741 0.96259,2.15 2.15,2.15c1.18741,0 2.15,-0.96259 2.15,-2.15c0,-1.18741 -0.96259,-2.15 -2.15,-2.15z"></path></g><path d="" fill="none"></path></g></g></svg>
                                    Sales Department</h3>
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
                                <img src="{{url('Shipter/assets/images/service/Photo no.6.jpg')}}" style="width: 350px; height: 236px;" alt="">
                            </div>
                            <div class="service-content service-content6">
                                <h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                         width="50" height="50"
                                         viewBox="0 0 172 172"
                                         style=" fill:#000000;
                                        position: absolute;
                                        left: -80px;
                                        top: -25px;
                                        block-size: 65px;">
                                        <g transform="">
                                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path>
                                                <g fill="#eb8e23"><path d="M154.8,6.88c-3.80281,0 -6.88,3.07719 -6.88,6.88c0,1.00781 0.25531,1.935 0.645,2.795l-27.52,38.485c-0.215,-0.01344 -0.43,0 -0.645,0c-1.37062,0 -2.6875,0.37625 -3.7625,1.075l-23.7575,-11.825c-0.22844,-3.60125 -3.225,-6.45 -6.88,-6.45c-3.80281,0 -6.88,3.07719 -6.88,6.88c0,0.36281 0.05375,0.72563 0.1075,1.075l-25.155,19.995c-0.76594,-0.29562 -1.59906,-0.43 -2.4725,-0.43c-3.44,0 -6.26187,2.51281 -6.7725,5.805l-23.435,9.46c-1.16906,-0.91375 -2.60687,-1.505 -4.1925,-1.505c-3.80281,0 -6.88,3.07719 -6.88,6.88c0,3.80281 3.07719,6.88 6.88,6.88c3.46688,0 6.30219,-2.56656 6.7725,-5.9125l23.435,-9.3525c1.16906,0.91375 2.60688,1.505 4.1925,1.505c3.80281,0 6.88,-3.07719 6.88,-6.88c0,-0.36281 -0.05375,-0.72562 -0.1075,-1.075l25.155,-19.995c0.76594,0.29563 1.59906,0.43 2.4725,0.43c1.37063,0 2.6875,-0.37625 3.7625,-1.075l23.7575,11.825c0.22844,3.60125 3.225,6.45 6.88,6.45c3.80281,0 6.88,-3.07719 6.88,-6.88c0,-1.00781 -0.25531,-1.935 -0.645,-2.795l27.52,-38.485c0.215,0.01344 0.43,0 0.645,0c3.80281,0 6.88,-3.07719 6.88,-6.88c0,-3.80281 -3.07719,-6.88 -6.88,-6.88zM141.04,51.6v120.4h27.52v-120.4zM147.92,58.48h13.76v106.64h-13.76zM72.24,82.56v89.44h27.52v-89.44zM79.12,89.44h13.76v75.68h-13.76zM106.64,99.76v72.24h27.52v-72.24zM113.52,106.64h13.76v58.48h-13.76zM37.84,110.08v61.92h27.52v-61.92zM44.72,116.96h13.76v48.16h-13.76zM3.44,123.84v48.16h27.52v-48.16zM10.32,130.72h13.76v34.4h-13.76z"></path></g><path d="" fill="none"></path><path d="" fill="none"></path></g></g></svg>
                                    Finance</h3>
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
                                <img src="{{url('Shipter/assets/images/service/Photo no.7.jpg')}}" style="width: 350px; height: 236px;" alt="">
                            </div>
                            <div class="service-content service-content3">
                                <h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                         width="50" height="50"
                                         viewBox="0 0 172 172"
                                         style=" fill:#000000;
                                        position: absolute;
                                        left: -80px;
                                        top: -25px;
                                        block-size: 65px;">
                                        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path>
                                            <g fill="#eb8e23"><path d="M92.77922,3.44c-0.31468,0.00885 -0.62665,0.06084 -0.92719,0.15453l-55.04,17.2c-1.43602,0.44979 -2.41308,1.78066 -2.41203,3.28547v127.28c-0.00062,1.57953 1.0744,2.95656 2.60687,3.33922l55.04,13.76c1.02781,0.25642 2.11645,0.02505 2.95114,-0.62721c0.83469,-0.65226 1.32235,-1.65269 1.32199,-2.71201v-158.24c0.0003,-0.93005 -0.37596,-1.8206 -1.04302,-2.46868c-0.66707,-0.64808 -1.56811,-0.99848 -2.49776,-0.97132zM89.44,11.56297v149.14953l-48.16,-12.04v-122.06625zM103.2,17.2v6.88h27.52v68.8h6.88v-72.24c-0.00019,-1.89978 -1.54022,-3.43981 -3.44,-3.44zM82.56,82.56c-1.89986,0 -3.44,2.31021 -3.44,5.16c0,2.84979 1.54014,5.16 3.44,5.16c1.89986,0 3.44,-2.31021 3.44,-5.16c0,-2.84979 -1.54014,-5.16 -3.44,-5.16zM106.64,99.76c-1.89978,0.00019 -3.43981,1.54022 -3.44,3.44v48.16c0.00019,1.89978 1.54022,3.43981 3.44,3.44h55.04c1.89978,-0.00019 3.43981,-1.54022 3.44,-3.44v-48.16c-0.00019,-1.89978 -1.54022,-3.43981 -3.44,-3.44zM110.08,106.64h48.16v41.28h-48.16zM127.28,113.52c-1.24059,-0.01754 -2.39452,0.63425 -3.01993,1.7058c-0.62541,1.07155 -0.62541,2.39684 0,3.46839c0.62541,1.07155 1.77935,1.72335 3.01993,1.7058h13.76c1.24059,0.01754 2.39452,-0.63425 3.01993,-1.7058c0.62541,-1.07155 0.62541,-2.39684 0,-3.46839c-0.62541,-1.07155 -1.77935,-1.72335 -3.01993,-1.7058z"></path></g></g></svg>
                                    Storage</h3>
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
                                <img src="{{url('Shipter/assets/images/service/Photo no.8.jpg')}}" style="width: 350px; height: 236px;" alt="">
                            </div>
                            <div class="service-content service-content4">
                                <h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                         width="64" height="64"
                                         viewBox="0 0 172 172"
                                         style=" fill:#000000;
                                        position: absolute;
                                        left: -95px;
                                        top: -10px;
                                        block-size: 45px;">
                                        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path>
                                            <g fill="#eb8e23"><path d="M67.1875,1.34375c-5.24063,0 -9.675,3.35938 -11.42187,8.0625h-23.51562c-1.74687,0 -3.3599,1.20833 -3.8974,2.9552l-12.4953,42.7323h-10.4823c-1.20937,0 -2.28333,0.5375 -2.9552,1.34375c-0.67187,0.80625 -1.21042,2.01615 -1.07605,3.22553l11.9599,95.67395c1.075,8.73438 8.60052,15.31927 17.3349,15.31927h110.58905c8.73438,0 16.2599,-6.5849 17.3349,-15.31927l11.9599,-95.67395c0.26875,-1.20938 -0.13595,-2.2849 -0.9422,-3.22553c-0.80625,-0.80625 -1.8802,-1.34375 -2.9552,-1.34375h-10.4823l-12.62915,-42.7323c-0.40312,-1.74687 -2.01667,-2.9552 -3.76355,-2.9552h-23.51562c-1.6125,-4.70312 -6.18125,-8.0625 -11.42187,-8.0625zM67.1875,9.40625h37.625c2.28437,0 4.03125,1.74688 4.03125,4.03125c0,2.28437 -1.74688,4.03125 -4.03125,4.03125h-37.625c-2.28437,0 -4.03125,-1.74688 -4.03125,-4.03125c0,-2.28437 1.74688,-4.03125 4.03125,-4.03125zM35.2052,17.46875h20.56042c1.6125,4.70313 6.18125,8.0625 11.42188,8.0625h37.625c5.24063,0 9.675,-3.35937 11.42188,-8.0625h20.56042l11.0177,37.625h-123.625zM9.94427,63.15625h152.11145l-11.42187,91.24115c-0.5375,4.70313 -4.56927,8.19635 -9.2724,8.19635h-110.7229c-4.70312,0 -8.7349,-3.49323 -9.2724,-8.19635zM72.5625,81.96875c-2.28437,0 -4.03125,1.74688 -4.03125,4.03125v53.75c0,2.28438 1.74688,4.03125 4.03125,4.03125c2.28437,0 4.03125,-1.74687 4.03125,-4.03125v-53.75c0,-2.28437 -1.74688,-4.03125 -4.03125,-4.03125zM99.4375,81.96875c-2.28437,0 -4.03125,1.74688 -4.03125,4.03125v53.75c0,2.28438 1.74688,4.03125 4.03125,4.03125c2.28437,0 4.03125,-1.74687 4.03125,-4.03125v-53.75c0,-2.28437 -1.74688,-4.03125 -4.03125,-4.03125zM39.36243,82.08685c-0.2614,-0.02257 -0.5291,-0.01785 -0.79785,0.01575c-2.15,0.26875 -3.76198,2.28543 -3.49323,4.43543l6.5849,53.75c0.26875,2.01563 2.01563,3.49323 4.03125,3.49323h0.53803c2.15,-0.26875 3.76197,-2.28542 3.49322,-4.43542l-6.71875,-53.75c-0.23516,-1.88125 -1.80776,-3.35098 -3.63757,-3.50897zM132.77142,82.08685c-1.82981,0.158 -3.40242,1.62772 -3.63757,3.50897l-6.71875,53.75c-0.40312,2.15 1.20938,4.16667 3.35938,4.43542h0.53803c2.01563,0 3.7625,-1.4776 4.03125,-3.49323l6.71875,-53.75c0.26875,-2.15 -1.34323,-4.16668 -3.49322,-4.43543c-0.26875,-0.03359 -0.53645,-0.03832 -0.79785,-0.01575z"></path></g></g></svg>
                                    Purchases Department</h3>
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
                                <img src="{{url('Shipter/assets/images/service/Photo no.8.jpg')}}" style="width: 350px; height: 236px;" alt="">
                            </div>
                            <div class="service-content service-content4">
                                <h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                         width="64" height="64"
                                         viewBox="0 0 172 172"
                                         style=" fill:#000000;
                                        position: absolute;
                                        left: -95px;
                                        top: -10px;
                                        block-size: 45px;">
                                        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path>
                                            <g fill="#eb8e23"><path d="M67.1875,1.34375c-5.24063,0 -9.675,3.35938 -11.42187,8.0625h-23.51562c-1.74687,0 -3.3599,1.20833 -3.8974,2.9552l-12.4953,42.7323h-10.4823c-1.20937,0 -2.28333,0.5375 -2.9552,1.34375c-0.67187,0.80625 -1.21042,2.01615 -1.07605,3.22553l11.9599,95.67395c1.075,8.73438 8.60052,15.31927 17.3349,15.31927h110.58905c8.73438,0 16.2599,-6.5849 17.3349,-15.31927l11.9599,-95.67395c0.26875,-1.20938 -0.13595,-2.2849 -0.9422,-3.22553c-0.80625,-0.80625 -1.8802,-1.34375 -2.9552,-1.34375h-10.4823l-12.62915,-42.7323c-0.40312,-1.74687 -2.01667,-2.9552 -3.76355,-2.9552h-23.51562c-1.6125,-4.70312 -6.18125,-8.0625 -11.42187,-8.0625zM67.1875,9.40625h37.625c2.28437,0 4.03125,1.74688 4.03125,4.03125c0,2.28437 -1.74688,4.03125 -4.03125,4.03125h-37.625c-2.28437,0 -4.03125,-1.74688 -4.03125,-4.03125c0,-2.28437 1.74688,-4.03125 4.03125,-4.03125zM35.2052,17.46875h20.56042c1.6125,4.70313 6.18125,8.0625 11.42188,8.0625h37.625c5.24063,0 9.675,-3.35937 11.42188,-8.0625h20.56042l11.0177,37.625h-123.625zM9.94427,63.15625h152.11145l-11.42187,91.24115c-0.5375,4.70313 -4.56927,8.19635 -9.2724,8.19635h-110.7229c-4.70312,0 -8.7349,-3.49323 -9.2724,-8.19635zM72.5625,81.96875c-2.28437,0 -4.03125,1.74688 -4.03125,4.03125v53.75c0,2.28438 1.74688,4.03125 4.03125,4.03125c2.28437,0 4.03125,-1.74687 4.03125,-4.03125v-53.75c0,-2.28437 -1.74688,-4.03125 -4.03125,-4.03125zM99.4375,81.96875c-2.28437,0 -4.03125,1.74688 -4.03125,4.03125v53.75c0,2.28438 1.74688,4.03125 4.03125,4.03125c2.28437,0 4.03125,-1.74687 4.03125,-4.03125v-53.75c0,-2.28437 -1.74688,-4.03125 -4.03125,-4.03125zM39.36243,82.08685c-0.2614,-0.02257 -0.5291,-0.01785 -0.79785,0.01575c-2.15,0.26875 -3.76198,2.28543 -3.49323,4.43543l6.5849,53.75c0.26875,2.01563 2.01563,3.49323 4.03125,3.49323h0.53803c2.15,-0.26875 3.76197,-2.28542 3.49322,-4.43542l-6.71875,-53.75c-0.23516,-1.88125 -1.80776,-3.35098 -3.63757,-3.50897zM132.77142,82.08685c-1.82981,0.158 -3.40242,1.62772 -3.63757,3.50897l-6.71875,53.75c-0.40312,2.15 1.20938,4.16667 3.35938,4.43542h0.53803c2.01563,0 3.7625,-1.4776 4.03125,-3.49323l6.71875,-53.75c0.26875,-2.15 -1.34323,-4.16668 -3.49322,-4.43543c-0.26875,-0.03359 -0.53645,-0.03832 -0.79785,-0.01575z"></path></g></g></svg>
                                    Training and Support</h3>
                                <p>.</p>
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
                <h2>Buyer Subscription Plan</h2>
            </div>
            <div class="row" style="padding-top: 20px;">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-3 col-l2 col-md-6 col-sm-6">
                            <div class="price-item">
                                <div class="pricing-header" style="border-color: #023989; border-style: groove; border-width: thin;">
                                    <h3>Basic</h3>
                                    <span style="color: black;">EB-0000567373</span>
                                </div>
                                <div class="pricing-table">
                                    <div class="price-sub-header">
                                        <h4>Free</h4>
                                    </div>
                                    <div class="pricing-footer">
                                        <div class="btns">
                                            <div class="btn-style btn-style-4"><a href="{{route('register')}}" style="border-radius: 25px;">Order Now</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-l2 col-md-6 col-sm-6">
                            <div class="price-item">
                                <div class="pricing-header1" style="border-color: #023989; border-style: groove; border-width: thin;">
                                    <h3 style="color: white;">Silver</h3>
                                    <span style="color: black;">EB-0000567373</span>
                                </div>
                                <div class="pricing-table">
                                    <div class="price-sub-header">
                                        <h4>5000 SAR</h4>
                                    </div>
                                    <div class="pricing-footer">
                                        <div class="btns">
                                            <div class="btn-style btn-style-4"><a href="{{route('register')}}" style="border-radius: 25px;">Order Now</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-l2 col-md-6 col-sm-6">
                            <div class="price-item">
                                <div class="pricing-header2" style="border-color: #023989; border-style: groove; border-width: thin;">
                                    <h3 style="color: white;">Gold</h3>
                                    <span style="color: black;">EB-0000567373</span>
                                </div>
                                <div class="pricing-table">
                                    <div class="price-sub-header">
                                        <h4>15000 SAR</h4>
                                    </div>
                                    <div class="pricing-footer">
                                        <div class="btns">
                                            <div class="btn-style btn-style-4"><a href="{{route('register')}}" style="border-radius: 25px;">Order Now</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-l2 col-md-6 col-sm-6">
                            <div class="price-item">
                                <div class="pricing-header3" style="border-color: #023989; border-style: groove; border-width: thin;">
                                    <h3 style="color: white;">Platinum</h3>
                                    <span style="color: black;">EB-0000567373</span>
                                </div>
                                <div class="pricing-table">
                                    <div class="price-sub-header">
                                        <h5 style="color: #eb8e23">Free (Purchases above SR 5 million/month)</h5>
                                    </div>
                                    <div class="pricing-footer">
                                        <div class="btns">
                                            <div class="btn-style btn-style-4"><a href="{{route('register')}}" style="border-radius: 25px;">Order Now</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btns">
{{--                <div class="btn-style">--}}
                    <a href="{{route('english.buyerPackage')}}" target="_blank" class="a_hover_class text-white">Details</a>
{{--                </div>--}}
            </div>
            {{--<div class="section-title text-center">
                <span>We Give You The Best</span>
                <h2>Supplier Subscription Plan</h2>
            </div>
            <div class="btns">
                <div class="btn-style"><a href="{{route('english.supplierPackage')}}" target="_blank">Details</a></div>
            </div>
            <div class="row" style="padding-top: 20px;">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-3 col-l2 col-md-6 col-sm-6">
                            <div class="price-item">
                                <div class="pricing-header" style="border-color: #023989; border-style: groove; border-width: thin;">
                                    <h3 style="color: white;">Basic</h3>
                                    <span style="color: black;">ES-0000567373</span>
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
                                <div class="pricing-header1" style="border-color: #023989; border-style: groove; border-width: thin;">
                                    <h3 style="color: white;">Silver</h3>
                                    <span style="color: black;">ES-0000567373</span>
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
                                <div class="pricing-header2" style="border-color: #023989; border-style: groove; border-width: thin;">
                                    <h3 style="color: white;">Gold</h3>
                                    <span style="color: black;">ES-0000567373</span>
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
            </div>--}}
        </div>
    </div>
    <!-- pice-area end -->

    <div class="section-area section-style-2">
        <div class="container mt-5 mb-5">

            <h3 class="text-center mb-4">FREQUENTLY ASKED QUESTIONS</h3>
            <div id="accordion">
                @foreach(\App\Models\FAQs::all() as $faq)
                    @if($faq->id == 1)
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#collapse{{$faq->id}}">
                                    {{$faq->question_en}}
                                </a>
                            </div>
                            <div id="collapse{{$faq->id}}" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    {{$faq->answer_en}}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#collapse{{$faq->id}}">
                                    {{$faq->question_en}}
                                </a>
                            </div>
                            <div id="collapse{{$faq->id}}" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    {{$faq->answer_en}}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>
    </div>

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
                            <span>Business Development & Sales Manager</span>
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
            <div class="btns text-center">
                <div class="btn-style"><a href="{{route('english.team')}}" style="border-radius: 25px;">More</a></div>
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
