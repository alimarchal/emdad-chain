@extends('shipter.layout')

@section('custom_header_image')
    background-image: url('images/Our sevices (photo no.4).jpg');
@endsection
@section('title','Suppliers')
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
@section('breadcumb-title','Suppliers')
@section('breadcumb-text','Suppliers')
@section('main')

    @include('shipter.breadcumb-area')
    <!-- section-section start -->
    <div class="section-area section-style-2 section-style-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-9 col-sm-12 col-d c-pd">
                    <div class="section-wrap" style="height: 100%">
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi" style="background-color: #505050; border-color: #c7e0f9">
{{--                                    <img src="{{url('images/15.png')}}" style="width: 40px; height: 40px;" alt="">--}}
                                    <img src="{{url('Shipter/assets/images/service/logistics_department.png')}}" style="width: 64px; height: 67px;" alt="">
                                </i>
                            </div>
                            <div class="section-content">
                                <p><a>Inventory</a></p>
                                <span>More control over inventory management.Precise orders tracking.
                                      Benefiting from the storage service.</span>
                            </div>
                        </div>
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi" style="background-color: #505050; border-color: #c7e0f9">
                                    <img src="{{url('images/16.png')}}" style="width: 40px; height: 40px;" alt="">
                                </i>
                            </div>
                            <div class="section-content">
                                <p><a>Sales</a></p>
                                <span>Easy increase for average sales percentage. Follow up with sales officers regularly. Quotations generating and approving online.</span>
                            </div>
                        </div>
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi" style="background-color: #505050; border-color: #c7e0f9">
{{--                                    <img src="{{url('images/20.png')}}" style="width: 40px; height: 40px;" alt="">--}}
                                    <img src="{{url('Shipter/assets/images/service/Payments.png')}}" style="width: 64px; height: 67px;" alt="">
                                </i>
                            </div>
                            <div class="section-content">
                                <p><a>Costs</a></p>
                                <span>Prevention of misappropriation of funds.Financial analysis of the accounts at the end of each financial period.
                                      Punctual funds collections.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="tr-wrap" style="padding-top: 45px;">
                        <div class="t-text">
                            <h2>Suppliers</h2>
                        </div>
                        <div class="tr-s ml-2">
                            Suppliers are the strategic partners of the Emdad platform. The main objective of the partnership is to enhance the quality level of supply for customers, and provide fast, professional and unique service in which Emdad platform was built on.
                            <ul style="list-style-type: disc;line-height: 4em;">
                                <li>Ensuring that all legal documents are valid.</li>
                                <li>Ensuring that a partner is an authorized agent or distributor.</li>
                                <li>Ensuring the eligibility and efficiency of the supply and adhering to the specified time.</li>
                                <li>The partner's commitment to supply all regions of the Kingdom.</li>
                                <li>The partner's commitment to provide the best and lowest price.</li>
                                <li>The partner's commitment to follow up with the requests and submitting offers quickly.</li>
                                <li>The partner's commitment to provide warranty for the products and abide by it.</li>
                            </ul>
                            All information provided in the registration form will be studied and within a maximum period of 48 hours, you will be contacted to complete the registration process.
                        </div>
                    </div>
                </div>
            </div>

            <!-- pricing-area start -->
            <div class="pricing-area pricing-area-2" style="margin-bottom: -25%">
                <div class="container">
                    <div class="btn-style join_us"><a href="{{route('register')}}" class="join_us_font_size" style="border-radius: 25px;">Partner registration</a></div>
                </div>
            </div>
            <!-- pricing-area end -->
        </div>
    </div>
    <!--section-section end -->
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
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="service-item">
                        <div class="service-single">
                            <div class="service-img">
                                <img src="{{url('Shipter/assets/images/service/Photo no.4.jpg')}}" style="width: 540px; height: 236px;" alt="">
                            </div>
                            <div class="service-content">
                                <h3>
                                    <img src="{{url('Shipter/assets/images/service/logistics_department.png')}}" style="width: 72px; height: 67px; left: -80px; top: -25px; position: absolute" alt="">
                                    Inventory
                                </h3>
                                <p>More control over inventory management.Precise orders tracking.</p>
                                <a href="{{route('english.service')}}">See More...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="service-item">
                        <div class="service-single">
                            <div class="service-img">
                                <img src="{{url('Shipter/assets/images/service/Photo no.5.jpg')}}" style="width: 540px; height: 236px;" alt="">
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
                                    Sales
                                </h3>
                                <p>Easy increase for average sales percentage.Follow up with sales officers regularly.</p>
                                <a href="{{route('english.service')}}">See More...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="service-item">
                        <div class="service-single">
                            <div class="service-img">
                                <img src="{{url('Shipter/assets/images/service/Photo no.6.jpg')}}" style="width: 540px; height: 236px;" alt="">
                            </div>
                            <div class="service-content service-content6">
                                <h3>
                                    <img src="{{url('Shipter/assets/images/service/Payments.png')}}" style="width: 72px; height: 67px; left: -80px; top: -21px; position: absolute" alt="">
                                    Costs
                                </h3>
                                <p>Prevention of misappropriation of funds.</p>
                                <a href="{{route('english.service')}}">See More...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="service-item">
                        <div class="service-single">
                            <div class="service-img">
                                <img src="{{url('Shipter/assets/images/service/Photo no.8.jpg')}}" style="width: 540px; height: 236px;" alt="">
                            </div>
                            <div class="service-content service-content4">
                                <h3 style="margin-left: -15px;">
                                    <img src="{{url('Shipter/assets/images/service/purchase_department.png')}}" style="width: 72px; height: 59px; left: -78px; top: -26px; position: absolute" alt="">
                                    Procurement
                                </h3>
                                <p style="margin-left: -15px;">Online purchase orders approval.Available online reports around the clock.</p>
                                <a style="margin-left: -15px;" href="{{route('english.service')}}">See More...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service-area end-->

@endsection
@endsection
@section('custom-footer')
@endsection
