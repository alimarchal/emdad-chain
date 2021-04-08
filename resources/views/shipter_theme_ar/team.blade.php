@extends('shipterAr.layout')
@section('title','الفريق')
@section('custom-header')
@endsection
@section('custom-body-style')
@endsection
@section('inside-body')
@section('breadcumb-title','الفريق')
@section('breadcumb-text','الفريق')
@section('main')

@include('shipterAr.breadcumb-area')
<!-- team-area start -->
<div class="team-area team-area-2">
    <div class="container">
        <div class="col-l2">
            <div class="section-title text-center">
                <span>We Are With You</span>
                <h2>Our Team Members</h2>
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
                        <span>مؤسس ورئيس مجلس الإدارة </span>
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


            <div class="col-lg-3 col-md-6 col-12">
                <div class="team-single">
                    <div class="team-img">
                        <img src="{{url('Shipter/assets/images/team/female.jpeg')}}" alt="">
                        <div class="social-1st">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-content">
                        <h4>آلاء الحمزي</h4>
                        <span>مديرة مشتريات</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="team-single">
                    <div class="team-img">
                        <img src="{{url('Shipter/assets/images/team/female.jpeg')}}" alt="">
                        <div class="social-1st">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-content">
                        <h4>روان الشهراني</h4>
                        <span>أخصائية تسويق أول</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="team-single">
                    <div class="team-img">
                        <img src="{{url('Shipter/assets/images/team/female.jpeg')}}" alt="">
                        <div class="social-1st">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-content">
                        <h4>Sara Al Wallan</h4>
                        <span>Public relations and Marketing Specials</span>
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
                        <h4>أمجاد الشهري</h4>
                        <span>أخصائي سلاسل إمداد أول</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="team-single">
                    <div class="team-img">
                        <img src="{{url('Shipter/assets/images/team/female.jpeg')}}" alt="">
                        <div class="social-1st">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-content">
                        <h4>Maryam Al Hajji</h4>
                        <span>Graphic Designer</span>
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
                        <h4>Mustahsan Rizvi</h4>
                        <span>Office Administrator (Pakistan)</span>
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
                        <h4>Ali Raza Marchal</h4>
                        <span>Software Developer</span>
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
                        <h4>Umair Pervaiz Butt</h4>
                        <span>Software Engineer</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- populer-area end -->

@endsection
@endsection
@section('custom-footer')
@endsection
