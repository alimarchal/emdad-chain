@extends('shipter.layout')

@section('custom_header_image')
background-image: url('images/Our sevices (photo no.4).jpg');
@endsection
@section('title','Services')
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
@section('breadcumb-title','What does it provide')
@section('breadcumb-text','What does it provide')
@section('main')

    @include('shipter.breadcumb-area')
    <!-- section-section start -->
    <div class="section-area section-style-2 section-style-3">
        <div class="container">
            {{--<div class="row">
                <div class="col-lg-4 col-md-9 col-sm-12 col-d c-pd">
                    <div class="section-wrap">
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi">
                                    <img src="{{url('images/15.png')}}" style="width: 40px; height: 40px;" alt="">
                                </i>
                            </div>
                            <div class="section-content">
                                <p><a>Logistics Department</a></p>
                                <span>More control over inventory management.Precise orders tracking.
                                      Benefiting from the storage service.</span>
                            </div>
                        </div>
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi">
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
                                <i class="fi">
                                    <img src="{{url('images/20.png')}}" style="width: 40px; height: 40px;" alt="">
                                </i>
                            </div>
                            <div class="section-content">
                                <p><a>Finance</a></p>
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
                        <div class="tr-s">
                            <ul style="list-style-type: disc;line-height: 4em;">
                                <li>The ability to request electronic reports at any time.</li>
                                <li>Save all operations and documents in an electronic cloud as a reference.</li>
                                <li>Monitor and follow up the authority of the sales team and the existing transactions.</li>
                                <li>Enhancing and enabling the capabilities and expertise of employees with free training courses.</li>
                                <li>The ability to approve quotations electronically.</li>
                                <li>We guarantee you get the money on time</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>--}}


            <div class="row">
                <div class="col-lg-4 col-md-9 col-sm-12 col-d c-pd">
                    <div class="section-wrap">
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi" style="background-color: #505050; border-color: #c7e0f9">
{{--                                    <img src="{{url('images/18.png')}}" style="width: 40px; height: 40px;" alt="">--}}
                                    <img src="{{url('Shipter/assets/images/service/logistics_department.png')}}" style="width: 64px; height: 67px;" alt="">
                                </i>
                            </div>
                            <div class="section-content">
                                <p><a>Logistics Department</a></p>
                                <span>A continuous stock of the required items.Precise orders tracking.Orders scheduling.</span>
                            </div>
                        </div>
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi" style="background-color: #505050; border-color: #c7e0f9">
{{--                                    <img src="{{url('images/19.png')}}" style="width: 40px; height: 40px;" alt="">--}}
                                    <img src="{{url('Shipter/assets/images/service/purchase_department.png')}}" style="width: 64px; height: 67px;" alt="">
                                </i>
                            </div>
                            <div class="section-content">
                                <p><a>Procurement Department</a></p>
                                <span>Online purchase orders approval.Available online reports around the clock.
                                      Online requests for orders or services at any time.</span>
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
                                <p><a>Financial Department</a></p>
                                <span>Quotations received from reliable suppliers.Credit or cash payments are available for every bank account.
                                      Decrease costs.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="tr-wrap ml-2" style="padding-top: 45px;">
                        <div class="t-text">
                            <h2>For companies and facilities</h2>
                        </div>
                        <div class="tr-s">
                            <ul style="list-style-type: disc;line-height: 4em;">
                            <li>The possibility of safe payment.</li>
                            <li>The possibility of tracking shipments.</li>
                            <li>The possibility of dealing in cash or on credit.</li>
                            <li>Guarantee of requesting quotations from the correct supplier.</li>
                            <li>The ability to register suppliers and deal with them directly.</li>
                            <li>Enhancing the search for an alternative or new product in an easy and fast way.</li>
                            <li>Prevent financial fraud and secret dealings between seller and buyer.</li>
                            <li>The ability to approve purchase orders electronically.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
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
                                <img src="{{url('Shipter/assets/images/service/Photo no.8.jpg')}}" style="width: 540px; height: 236px;" alt="">
                            </div>
                            <div class="service-content service-content4">
                                <h3 style="margin-left: -15px">
                                    {{--<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                         width="64" height="64"
                                         viewBox="0 0 172 172"
                                         style=" fill:#000000;
                                        position: absolute;
                                        left: -95px;
                                        top: -10px;
                                        block-size: 45px;">
                                        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path>
                                            <g fill="#eb8e23"><path d="M67.1875,1.34375c-5.24063,0 -9.675,3.35938 -11.42187,8.0625h-23.51562c-1.74687,0 -3.3599,1.20833 -3.8974,2.9552l-12.4953,42.7323h-10.4823c-1.20937,0 -2.28333,0.5375 -2.9552,1.34375c-0.67187,0.80625 -1.21042,2.01615 -1.07605,3.22553l11.9599,95.67395c1.075,8.73438 8.60052,15.31927 17.3349,15.31927h110.58905c8.73438,0 16.2599,-6.5849 17.3349,-15.31927l11.9599,-95.67395c0.26875,-1.20938 -0.13595,-2.2849 -0.9422,-3.22553c-0.80625,-0.80625 -1.8802,-1.34375 -2.9552,-1.34375h-10.4823l-12.62915,-42.7323c-0.40312,-1.74687 -2.01667,-2.9552 -3.76355,-2.9552h-23.51562c-1.6125,-4.70312 -6.18125,-8.0625 -11.42187,-8.0625zM67.1875,9.40625h37.625c2.28437,0 4.03125,1.74688 4.03125,4.03125c0,2.28437 -1.74688,4.03125 -4.03125,4.03125h-37.625c-2.28437,0 -4.03125,-1.74688 -4.03125,-4.03125c0,-2.28437 1.74688,-4.03125 4.03125,-4.03125zM35.2052,17.46875h20.56042c1.6125,4.70313 6.18125,8.0625 11.42188,8.0625h37.625c5.24063,0 9.675,-3.35937 11.42188,-8.0625h20.56042l11.0177,37.625h-123.625zM9.94427,63.15625h152.11145l-11.42187,91.24115c-0.5375,4.70313 -4.56927,8.19635 -9.2724,8.19635h-110.7229c-4.70312,0 -8.7349,-3.49323 -9.2724,-8.19635zM72.5625,81.96875c-2.28437,0 -4.03125,1.74688 -4.03125,4.03125v53.75c0,2.28438 1.74688,4.03125 4.03125,4.03125c2.28437,0 4.03125,-1.74687 4.03125,-4.03125v-53.75c0,-2.28437 -1.74688,-4.03125 -4.03125,-4.03125zM99.4375,81.96875c-2.28437,0 -4.03125,1.74688 -4.03125,4.03125v53.75c0,2.28438 1.74688,4.03125 4.03125,4.03125c2.28437,0 4.03125,-1.74687 4.03125,-4.03125v-53.75c0,-2.28437 -1.74688,-4.03125 -4.03125,-4.03125zM39.36243,82.08685c-0.2614,-0.02257 -0.5291,-0.01785 -0.79785,0.01575c-2.15,0.26875 -3.76198,2.28543 -3.49323,4.43543l6.5849,53.75c0.26875,2.01563 2.01563,3.49323 4.03125,3.49323h0.53803c2.15,-0.26875 3.76197,-2.28542 3.49322,-4.43542l-6.71875,-53.75c-0.23516,-1.88125 -1.80776,-3.35098 -3.63757,-3.50897zM132.77142,82.08685c-1.82981,0.158 -3.40242,1.62772 -3.63757,3.50897l-6.71875,53.75c-0.40312,2.15 1.20938,4.16667 3.35938,4.43542h0.53803c2.01563,0 3.7625,-1.4776 4.03125,-3.49323l6.71875,-53.75c0.26875,-2.15 -1.34323,-4.16668 -3.49322,-4.43543c-0.26875,-0.03359 -0.53645,-0.03832 -0.79785,-0.01575z"></path></g></g>
                                    </svg>--}}
                                    <img src="{{url('Shipter/assets/images/service/purchase_department.png')}}" style="width: 72px; height: 59px; left: -78px; top: -26px; position: absolute" alt="">
                                    Procurement Department
                                </h3>
                                <p>Online purchase orders approval.Available online reports around the clock.</p>
                                <a href="{{route('english.service')}}">See More...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="service-item">
                        <div class="service-single">
                            <div class="service-img">
                                <img src="{{url('Shipter/assets/images/service/Photo no.4.jpg')}}" style="width: 540px; height: 236px;" alt="">
                            </div>
                            <div class="service-content">
                                <h3>
                                    <img src="{{url('Shipter/assets/images/service/logistics_department.png')}}" style="width: 72px; height: 67px; left: -80px; top: -25px; position: absolute" alt="">
                                    {{--<svg xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 172 172"
                                         style=" fill:#000000;
                                        position: absolute;
                                        left: -80px;
                                        top: -25px;
                                        transform: scale(1.5);
                                        block-size: 65px;
                                        color: #eb8e23;">
                                        <g transform=""><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="none"></path>
                                                <g fill="#eb8e23"><path d="M44.0916,44.71664c-4.23661,0 -7.69913,3.46252 -7.69913,7.69913v60.30984c0,1.40261 1.16377,2.56638 2.56638,2.56638h9.0575c0.63889,5.76933 5.53593,10.26801 11.47351,10.26801c5.93673,0 10.83349,-4.49736 11.47351,-10.26551h27.02214h6.49113c0.64002,5.76814 5.53678,10.26551 11.47351,10.26551c5.93673,0 10.83349,-4.49736 11.47351,-10.26551h3.92726c4.23661,0 7.69509,-3.46339 7.69662,-7.69913v-24.05978c0,-0.00167 0,-0.00334 0,-0.00501c-0.00462,-1.25985 -0.31399,-2.50489 -0.91477,-3.6215l-9.07003,-16.84184c-1.77002,-3.35425 -5.25143,-5.51137 -9.06001,-5.51871c-0.00084,0 -0.00167,0 -0.00251,0h-20.73151v-5.13275c0,-4.23661 -3.46252,-7.69913 -7.69913,-7.69913zM44.0916,47.28302h47.47796c2.84916,0 5.13275,2.28359 5.13275,5.13275v6.41594c0,0.00084 0,0.00167 0,0.00251v20.53101h-57.74347v-15.39826h39.13724c0.23138,0.00327 0.4466,-0.11829 0.56325,-0.31815c0.11665,-0.19985 0.11665,-0.44703 0,-0.64689c-0.11665,-0.19985 -0.33187,-0.32142 -0.56325,-0.31815h-39.13724v-10.26801c0,-2.84916 2.28359,-5.13275 5.13275,-5.13275zM97.98551,60.1149h22.0147c2.84337,0.00642 5.46526,1.62686 6.79689,4.15783c0.00248,0.00419 0.00499,0.00837 0.00752,0.01253l9.07004,16.84184c0.39673,0.73829 0.60341,1.56718 0.60651,2.4135v6.09013h-25.02217c-1.07148,0 -1.92478,-0.8533 -1.92478,-1.92478v-19.24782c0,-1.07148 0.8533,-1.92478 1.92478,-1.92478h6.41594c0.23138,0.00327 0.4466,-0.11829 0.56325,-0.31815c0.11665,-0.19985 0.11665,-0.44703 0,-0.64689c-0.11665,-0.19985 -0.33187,-0.32142 -0.56325,-0.31815h-6.41594c-1.76436,0 -3.20797,1.44361 -3.20797,3.20797v19.24782c0,1.76436 1.44361,3.20797 3.20797,3.20797h25.02217v8.98232h-4.49116c-1.76436,0 -3.20797,1.44361 -3.20797,3.20797v2.56638c0,1.76436 1.44361,3.20797 3.20797,3.20797h4.31322c-0.56783,2.21791 -2.54966,3.84956 -4.9523,3.84956h-3.92726c-0.64002,-5.76814 -5.53678,-10.26551 -11.47351,-10.26551c-5.93673,0 -10.83349,4.49736 -11.47351,10.26551h-6.49113v-32.61854c0.01131,-0.06888 0.01131,-0.13914 0,-0.20802zM81.94565,62.68378c-0.23138,-0.00327 -0.4466,0.11829 -0.56325,0.31815c-0.11665,0.19985 -0.11665,0.44703 0,0.64689c0.11665,0.19985 0.33187,0.32142 0.56325,0.31815h6.41594c0.23138,0.00327 0.4466,-0.11829 0.56325,-0.31815c0.11665,-0.19985 0.11665,-0.44703 0,-0.64689c-0.11665,-0.19985 -0.33187,-0.32142 -0.56325,-0.31815zM92.21116,62.68378c-0.23138,-0.00327 -0.4466,0.11829 -0.56325,0.31815c-0.11665,0.19985 -0.11665,0.44703 0,0.64689c0.11665,0.19985 0.33187,0.32142 0.56325,0.31815h1.28319c0.23138,0.00327 0.4466,-0.11829 0.56325,-0.31815c0.11665,-0.19985 0.11665,-0.44703 0,-0.64689c-0.11665,-0.19985 -0.33187,-0.32142 -0.56325,-0.31815zM120.4413,65.25016c-0.23138,-0.00327 -0.4466,0.11829 -0.56325,0.31815c-0.11665,0.19985 -0.11665,0.44703 0,0.64689c0.11665,0.19985 0.33187,0.32142 0.56325,0.31815h1.28319c0.23138,0.00327 0.4466,-0.11829 0.56325,-0.31815c0.11665,-0.19985 0.11665,-0.44703 0,-0.64689c-0.11665,-0.19985 -0.33187,-0.32142 -0.56325,-0.31815zM124.29086,65.25016c-0.23138,-0.00327 -0.4466,0.11829 -0.56325,0.31815c-0.11665,0.19985 -0.11665,0.44703 0,0.64689c0.11665,0.19985 0.33187,0.32142 0.56325,0.31815h1.28319c0.23138,0.00327 0.4466,-0.11829 0.56325,-0.31815c0.11665,-0.19985 0.11665,-0.44703 0,-0.64689c-0.11665,-0.19985 -0.33187,-0.32142 -0.56325,-0.31815zM38.95885,80.64841h57.74347v14.11507h-57.74347zM38.95885,96.04667h57.74347v16.68145h-25.73895c-0.64002,-5.76814 -5.53678,-10.26551 -11.47351,-10.26551c-5.93587,0 -10.83236,4.49605 -11.47351,10.263h-9.0575v-3.84706h4.49116c1.76436,0 3.20797,-1.44361 3.20797,-3.20797v-2.56638c0,-1.76436 -1.44361,-3.20797 -3.20797,-3.20797h-4.49116zM38.95885,101.17943h4.49116c1.07148,0 1.92478,0.8533 1.92478,1.92478v2.56638c0,1.07148 -0.8533,1.92478 -1.92478,1.92478h-4.49116zM131.98999,101.17943h4.49116v6.41594h-4.49116c-1.07148,0 -1.92478,-0.8533 -1.92478,-1.92478v-2.56638c0,-1.07148 0.8533,-1.92478 1.92478,-1.92478zM59.48986,103.7458c5.67709,0 10.26551,4.58842 10.26551,10.26551c0,5.67708 -4.58842,10.26551 -10.26551,10.26551c-5.67709,0 -10.26551,-4.58842 -10.26551,-10.26551c0,-5.67708 4.58842,-10.26551 10.26551,-10.26551zM115.95014,103.7458c5.67709,0 10.26551,4.58842 10.26551,10.26551c0,5.67708 -4.58842,10.26551 -10.26551,10.26551c-5.67709,0 -10.26551,-4.58842 -10.26551,-10.26551c0,-5.67708 4.58842,-10.26551 10.26551,-10.26551zM59.48986,108.87855c-1.65745,0 -2.98094,0.64465 -3.84706,1.61902c-0.86611,0.97438 -1.28569,2.24836 -1.28569,3.51373c0,1.26537 0.41958,2.53935 1.28569,3.51373c0.86611,0.97438 2.18961,1.61902 3.84706,1.61902c1.65745,0 2.98094,-0.64465 3.84706,-1.61902c0.86611,-0.97438 1.28569,-2.24836 1.28569,-3.51373c0,-1.26537 -0.41958,-2.53935 -1.28569,-3.51373c-0.86611,-0.97438 -2.18961,-1.61902 -3.84706,-1.61902zM115.95014,108.87855c-1.65745,0 -2.98094,0.64465 -3.84706,1.61902c-0.86611,0.97438 -1.28569,2.24836 -1.28569,3.51373c0,1.26537 0.41958,2.53935 1.28569,3.51373c0.86611,0.97438 2.18961,1.61902 3.84706,1.61902c1.65745,0 2.98094,-0.64465 3.84706,-1.61902c0.86611,-0.97438 1.28569,-2.24836 1.28569,-3.51373c0,-1.26537 -0.41958,-2.53935 -1.28569,-3.51373c-0.86611,-0.97438 -2.18961,-1.61902 -3.84706,-1.61902zM59.48986,110.16174c1.33665,0 2.25874,0.47814 2.88968,1.18795c0.63094,0.70981 0.95989,1.6814 0.95989,2.66161c0,0.98021 -0.32895,1.95181 -0.95989,2.66161c-0.63094,0.70981 -1.55303,1.18795 -2.88968,1.18795c-1.33665,0 -2.25874,-0.47814 -2.88968,-1.18795c-0.63094,-0.70981 -0.95989,-1.6814 -0.95989,-2.66161c0,-0.98021 0.32895,-1.95181 0.95989,-2.66161c0.63094,-0.70981 1.55303,-1.18795 2.88968,-1.18795zM115.95014,110.16174c1.33665,0 2.25874,0.47814 2.88968,1.18795c0.63094,0.70981 0.95989,1.6814 0.95989,2.66161c0,0.98021 -0.32895,1.95181 -0.95989,2.66161c-0.63094,0.70981 -1.55303,1.18795 -2.88968,1.18795c-1.33665,0 -2.25874,-0.47814 -2.88968,-1.18795c-0.63094,-0.70981 -0.95989,-1.6814 -0.95989,-2.66161c0,-0.98021 0.32895,-1.95181 0.95989,-2.66161c0.63094,-0.70981 1.55303,-1.18795 2.88968,-1.18795z"></path></g></g></g></svg>--}}
                                    Logistics Department
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
                                <img src="{{url('Shipter/assets/images/service/Photo no.6.jpg')}}" style="width: 540px; height: 236px;" alt="">
                            </div>
                            {{--<div class="service-content service-content6">
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
                                    Finance
                                </h3>
                                <p>Prevention of misappropriation of funds.</p>
                                <a href="{{route('english.service')}}">See More...</a>
                            </div>--}}
                            <div class="service-content service-content6">
                                <h3>
                                    <img src="{{url('Shipter/assets/images/service/Payments.png')}}" style="width: 72px; height: 67px; left: -80px; top: -21px; position: absolute" alt="">
                                    Finance
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
                                <h3>
                                    <img src="{{url('Shipter/assets/images/service/training.png')}}" style="width: 72px; height: 58px; left: -80px; top: -26px; position: absolute" alt="">
                                    {{--<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                         width="64" height="64"
                                         viewBox="0 0 172 172"
                                         style=" fill:#000000;
                                        position: absolute;
                                        left: -95px;
                                        top: -10px;
                                        block-size: 45px;">
                                        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path>
                                            <g fill="#eb8e23"><path d="M67.1875,1.34375c-5.24063,0 -9.675,3.35938 -11.42187,8.0625h-23.51562c-1.74687,0 -3.3599,1.20833 -3.8974,2.9552l-12.4953,42.7323h-10.4823c-1.20937,0 -2.28333,0.5375 -2.9552,1.34375c-0.67187,0.80625 -1.21042,2.01615 -1.07605,3.22553l11.9599,95.67395c1.075,8.73438 8.60052,15.31927 17.3349,15.31927h110.58905c8.73438,0 16.2599,-6.5849 17.3349,-15.31927l11.9599,-95.67395c0.26875,-1.20938 -0.13595,-2.2849 -0.9422,-3.22553c-0.80625,-0.80625 -1.8802,-1.34375 -2.9552,-1.34375h-10.4823l-12.62915,-42.7323c-0.40312,-1.74687 -2.01667,-2.9552 -3.76355,-2.9552h-23.51562c-1.6125,-4.70312 -6.18125,-8.0625 -11.42187,-8.0625zM67.1875,9.40625h37.625c2.28437,0 4.03125,1.74688 4.03125,4.03125c0,2.28437 -1.74688,4.03125 -4.03125,4.03125h-37.625c-2.28437,0 -4.03125,-1.74688 -4.03125,-4.03125c0,-2.28437 1.74688,-4.03125 4.03125,-4.03125zM35.2052,17.46875h20.56042c1.6125,4.70313 6.18125,8.0625 11.42188,8.0625h37.625c5.24063,0 9.675,-3.35937 11.42188,-8.0625h20.56042l11.0177,37.625h-123.625zM9.94427,63.15625h152.11145l-11.42187,91.24115c-0.5375,4.70313 -4.56927,8.19635 -9.2724,8.19635h-110.7229c-4.70312,0 -8.7349,-3.49323 -9.2724,-8.19635zM72.5625,81.96875c-2.28437,0 -4.03125,1.74688 -4.03125,4.03125v53.75c0,2.28438 1.74688,4.03125 4.03125,4.03125c2.28437,0 4.03125,-1.74687 4.03125,-4.03125v-53.75c0,-2.28437 -1.74688,-4.03125 -4.03125,-4.03125zM99.4375,81.96875c-2.28437,0 -4.03125,1.74688 -4.03125,4.03125v53.75c0,2.28438 1.74688,4.03125 4.03125,4.03125c2.28437,0 4.03125,-1.74687 4.03125,-4.03125v-53.75c0,-2.28437 -1.74688,-4.03125 -4.03125,-4.03125zM39.36243,82.08685c-0.2614,-0.02257 -0.5291,-0.01785 -0.79785,0.01575c-2.15,0.26875 -3.76198,2.28543 -3.49323,4.43543l6.5849,53.75c0.26875,2.01563 2.01563,3.49323 4.03125,3.49323h0.53803c2.15,-0.26875 3.76197,-2.28542 3.49322,-4.43542l-6.71875,-53.75c-0.23516,-1.88125 -1.80776,-3.35098 -3.63757,-3.50897zM132.77142,82.08685c-1.82981,0.158 -3.40242,1.62772 -3.63757,3.50897l-6.71875,53.75c-0.40312,2.15 1.20938,4.16667 3.35938,4.43542h0.53803c2.01563,0 3.7625,-1.4776 4.03125,-3.49323l6.71875,-53.75c0.26875,-2.15 -1.34323,-4.16668 -3.49322,-4.43543c-0.26875,-0.03359 -0.53645,-0.03832 -0.79785,-0.01575z"></path></g></g></svg>--}}
                                    Training and Support
                                </h3>
                                <p>.</p>
                                <a href="{{route('english.service')}}">See More...</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="col-lg-4 col-md-6 col-sm-12">
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
                </div>--}}
            </div>
        </div>
    </div>
    <!-- service-area end-->



@endsection
@endsection
@section('custom-footer')
@endsection
