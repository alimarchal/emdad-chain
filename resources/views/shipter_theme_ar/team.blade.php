@extends('shipterAr.layout')
@section('custom_header_image')
    background-image: url('images/Photo no.6.jpg');
@endsection
@section('title','الفريق')
@section('custom-header')
    <style>
        .header-area.header-style-2 .slicknav_btn
        {
            margin-top: 0px!important;
        }
    </style>
@endsection
@section('custom-body-style')
    style="font-family: arabicFont;"
@endsection
@section('inside-body')
@section('breadcumb-title','فريق إمداد')
@section('breadcumb-text','فريق إمداد')
@section('main')

@include('shipterAr.breadcumb-area')
<!-- team-area start -->
<div class="team-area team-area-2" style="direction: rtl">
    <div class="container">
        <div class="col-l2">
            <div class="section-title text-center">
                <span></span>
                <h2>فريق إمداد</h2>
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
                        <span>الرئيس التنفيذي</span>
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
                        <span>مدير مبيعات و تطوير أعمال</span>
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
                        <h4>غادة النجيدي</h4>
                        <span>مساعدة المدير التنفيذي</span>
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
                        <h4>مستحسن ريزفي</h4>
                        <span>مدير مكتب (باكستان)</span>
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
                        <h4>علي رضا مارشال</h4>
                        <span>مطور برمجيات</span>
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
                        <h4>أمير بيرفايز بوت</h4>
                        <span>مهندس برمجيات</span>
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
                        <h4>عديل شيما</h4>
                        <span>مطور تطبيقات الجوال</span>
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
                        <h4>علي ريزڤي</h4>
                        <span>محاسب و موظف موارد بشرية</span>
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
                        <h4>إنشا مراد</h4>
                        <span>مطورة تطبيقات الجوال</span>
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
