@extends('shipter.layout')
@section('title','About Emdad')
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
{{--@section('inside-body')--}}
@section('breadcumb-title','as')
@section('breadcumb-text','de')
@section('main')

    <!-- team-area start -->
    <div class="about-area about-style-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6  offset-lg-6 about-wrap">
                    <div class="about-content">
                        <div class="about-icon">
                            <i class="fi flaticon-travel"></i>
                        </div>
                        <h2>What is Emdad Platform?</h2>
                        <p>It is a digital platform built with high expertise to serve small medium and large companies in procurement management, with the lowest costs and the best digital and logistical standards.</p>
                        <span><strong>Our Vision:</strong> To become the largest, reliable digital platform to serve the small, medium and large companies,
                            and to gain the biggest number of suppliers and the largest logistical fleet while assuring the best international quality standards..</span>
                        <span><strong>Our Goal:</strong> To remove all of the logistical obstacles and upgrade the quality level of procurement management for all of Emdad's partners, and we will!</span>
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
    <!-- team-area end -->
    <div class="section-area section-style-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 col-d">
                    <div class="section-item-2">
                        <div class="section-icon">
                            <i class="fi" style="background-color: #505050; border-color: #c7e0f9">
                                <img src="{{url('Shipter/assets/images/about-page/safe_payments.png')}}" style="height: 55px; width: 60px">
                            </i>
                        </div>
                        <div class="section-content" style="padding-top: 50px;">
                            <span>Provides safe payments</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-d">
                    <div class="section-item-2">
                        <div class="section-icon">
                            <i class="fi" style="background-color: #505050; border-color: #c7e0f9">
                                <img src="{{url('Shipter/assets/images/about-page/fast_process.png')}}" style="height: 55px; width: 60px">
                            </i>
                        </div>
                        <div class="section-content" style="padding-top: 50px;">
                            <span>Assures an organised and fast process</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-d">
                    <div class="section-item-2">
                        <div class="section-icon">
                            <i class="fi" style="background-color: #505050; border-color: #c7e0f9">
                                <img src="{{url('Shipter/assets/images/about-page/lowest_costs.png')}}" style="height: 55px; width: 65px">
                            </i>
                        </div>
                        <div class="section-content" style="padding-top: 50px;">
                            <span>Offers  the lowest costs</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 col-d">
                    <div class="section-item-2">
                        <div class="section-icon">
                            <i class="fi" style="background-color: #505050; border-color: #c7e0f9">
                                <img src="{{url('Shipter/assets/images/about-page/logistical_obstacles.png')}}" style="height: 55px; width: 60px">
                            </i>
                        </div>
                        <div class="section-content" style="padding-top: 50px;">
                            <span>Removes the logistical obstacles</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- team-area start -->
{{--    <div class="team-area team-area-3" style="padding-top: 0px;">--}}
{{--        <div class="container">--}}
{{--            <div class="col-l2">--}}
{{--                <div class="section-title text-center">--}}
{{--                    <h2>Our Team</h2>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-3 col-md-6 col-12">--}}
{{--                    <div class="team-single">--}}
{{--                        <div class="team-img">--}}
{{--                            <img src="{{url('Shipter/assets/images/team/male.jpeg')}}" alt="">--}}
{{--                            <div class="social-1st">--}}
{{--                                <ul>--}}
{{--                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>--}}
{{--                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>--}}
{{--                                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="team-content">--}}
{{--                            <h4>Abdulaziz AlSinany</h4>--}}
{{--                            <span>Founder and CEO</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-md-6 col-12">--}}
{{--                    <div class="team-single">--}}
{{--                        <div class="team-img">--}}
{{--                            <img src="{{url('Shipter/assets/images/team/male.jpeg')}}" alt="">--}}
{{--                            <div class="social-1st">--}}
{{--                                <ul>--}}
{{--                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>--}}
{{--                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>--}}
{{--                                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="team-content">--}}
{{--                            <h4>Ahsan Raza</h4>--}}
{{--                            <span>Business Development & Sales Manager</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-md-6 col-12">--}}
{{--                    <div class="team-single">--}}
{{--                        <div class="team-img">--}}
{{--                            <img src="{{url('Shipter/assets/images/team/male.jpeg')}}" alt="">--}}
{{--                            <div class="social-1st">--}}
{{--                                <ul>--}}
{{--                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>--}}
{{--                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>--}}
{{--                                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="team-content">--}}
{{--                            <h4>Rayan Al Sinany</h4>--}}
{{--                            <span>Junior Accountant</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-md-6 col-12">--}}
{{--                    <div class="team-single">--}}
{{--                        <div class="team-img">--}}
{{--                            <img src="{{url('Shipter/assets/images/team/male.jpeg')}}" alt="">--}}
{{--                            <div class="social-1st">--}}
{{--                                <ul>--}}
{{--                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>--}}
{{--                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>--}}
{{--                                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="team-content">--}}
{{--                            <h4>Muteb Al Buraikan</h4>--}}
{{--                            <span>Human Resources Specialist</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- team-area end -->

@endsection
{{--@endsection--}}
@section('custom-footer')
@endsection
