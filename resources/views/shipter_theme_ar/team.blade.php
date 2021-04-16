@extends('shipterAr.layout')
@section('custom_header_image')
    background-image: url('images/Photo no.6.jpg');
@endsection
@section('title','الفريق')
@section('custom-header')
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
                        <h4>مريم الحاجي</h4>
                        <span>مصممة جرافيك</span>
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
                        <h4>شهد الشهراني</h4>
                        <span>أخصائية مبيعات</span>
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
        </div>
    </div>
</div>
<!-- populer-area end -->

@endsection
@endsection
@section('custom-footer')
@endsection
