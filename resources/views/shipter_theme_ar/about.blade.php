@extends('shipterAr.layout')
@section('title','ما هي إمداد')
@section('custom-header')
    <style>
        #about-h2:before {
            right: 0;
        }
        .header-area.header-style-2 .slicknav_btn
        {
            margin-top: 0px!important;
        }
    </style>
@endsection
@section('custom-body-style')
    style="font-family: arabicFont;"
@endsection
{{--@section('inside-body')--}}
@section('breadcumb-title','as')
@section('breadcumb-text','de')
@section('main')

    <!-- team-area start -->
    <div class="about-area about-style-2" style="direction: rtl">
        <div class="container">
            <div class="row">
                <div class="col-lg-6   about-wrap">
                    <div class="about-content">
                        <div class="about-icon">
                            <i class="fi flaticon-travel"></i>
                        </div>
                        <h2 id="about-h2">من إمداد؟</h2>
                        <p>هي منصة رقمية بنيت بخبرة عالية لتخدم المنشآت الصغيرة والمتوسطة والكبيرة في إدارة المشتريات، بأقل التكاليف وأفضل المعايير الرقمية واللوجستية.</p>
{{--                        <p><strong>رؤيتنا لمستقبلنا:</strong> أضخم منصة إلكترونية موثوقة تقدم خدمات سلاسل الإمداد وتمتلك اكبر عدد من الموردين وأضخم أسطول لوجستي بأفضل معايير الجودة العالمية.</p>--}}

{{--                        <p><strong>رسالتنا للمستقبل:</strong> نحن قادرون بل ومستعدون على تحمل صعوبة جميع التطورات التقنية في العالم ومواكبة الأحداث الجديدة حتى نصبح الأسبق في الابتكار والتطور وإذا سنحت لنا الفرصة يوماً في خدمة كواكب خارج الأرض، سنفعل!</p>--}}
{{--                        <p><strong>هدفنا:</strong> إزالة جميع المعوقات اللوجستية ورفع مستوى خدمة سلاسل الإمداد لجميع شركاء إمداد، وسنفعل!</p>--}}
                        <ul style="list-style-type: square; color: #eb8e23; direction: rtl;">
                            <li class="mb-4"><strong style="color: white">رؤيتنا لمستقبلنا:</strong><a style="color: white"> أضخم منصة رقمية موثوقة تخدم المنشآت الصغيرة والمتوسطة والكبيرة وتمتلك اكبر عدد من الموردين وأضخم اسطول لوجستي بأفضل معايير الجودة العالمية. </a></li>
                            <li><strong style="color: white">هدفنا:</strong><a style="color: white"> إزالة جميع المعوقات اللوجستية ورفع مستوى جودة إدارة المشتريات لجميع شركاء إمداد، وسنفعل! </a></li>
                        </ul>
                    </div>
                    <div class="signature-section">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="si-text">
                                    <p>عبد العزيز السناني</p>
                                    <span>الرئيس التنفيذي</span>
                                </div>
                            </div>
                            <div class="col-md-6"><img src="{{url('Shipter/assets/images/about/ceo_sign.png')}}" style="width: 200px;" alt=""></div>
                        </div>
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
                            <span>تقديم الدفع الآمن</span>
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
                            <span>عمليات سريعة ومنظمة</span>
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
                            <span>توفر لكم أقل الأسعار</span>
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
                            <span>إزالة المعوقات اللوجستية</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- team-area start -->
{{--    <div class="team-area team-area-3" style="padding-top: 0px; direction: rtl">--}}
{{--        <div class="container">--}}
{{--            <div class="col-l2">--}}
{{--                <div class="section-title text-center">--}}
{{--                    <h2>الفريق</h2>--}}
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
{{--                            <h4>عبد العزيز السناني</h4>--}}
{{--                            <span>مؤسس ومدير مجلس الإدارة</span>--}}
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
{{--                            <h4>أحسن رضا</h4>--}}
{{--                            <span>--}}
{{--                                مدير مبيعات و تطوير أعمال--}}
{{--                            </span>--}}
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
{{--                            <h4>ريان السناني</h4>--}}
{{--                            <span>محاسب إداري</span>--}}
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
{{--                            <h4>متعب البريكان</h4>--}}
{{--                            <span>مسؤول الموارد البشرية</span>--}}
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
