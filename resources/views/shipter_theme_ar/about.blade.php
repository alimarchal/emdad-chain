@extends('shipterAr.layout')
@section('title','من إمداد')
@section('custom-header')
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
                <div class="col-lg-6  offset-lg-6 about-wrap">
                    <div class="about-content">
                        <div class="about-icon">
                            <i class="fi flaticon-travel"></i>
                        </div>
                        <h2>من إمداد؟</h2>
                        <p>منصة إمداد هي منصة إلكترونية بنيت بخبرة عالية لتخدم البائع والمشتري في عمليات الشراء والبيع والتوريد والتخزين،</p>
                        <p> بأقل التكاليف وأفضل المعايير التقنية واللوجستية.</p>
                        <span><strong>رؤيتنا لمستقبلنا:</strong> أضخم منصة إلكترونية موثوقة تقدم خدمات سلاسل الإمداد وتمتلك اكبر عدد من الموردين وأضخم أسطول لوجستي بأفضل معايير الجودة العالمية.</span>

                        <span><strong>رسالتنا للمستقبل:</strong> نحن قادرون بل ومستعدون على تحمل صعوبة جميع التطورات التقنية في العالم ومواكبة الأحداث الجديدة حتى نصبح الأسبق في الابتكار والتطور وإذا سنحت لنا الفرصة يوماً في خدمة كواكب خارج الأرض، سنفعل!</span>
                        <span><strong>هدفنا:</strong> إزالة جميع المعوقات اللوجستية ورفع مستوى خدمة سلاسل الإمداد لجميع شركاء إمداد، وسنفعل!</span>
                    </div>
                    <div class="signature-section">
                        <div class="si-text">
                            <p>عبد العزيز السناني</p>
                            <span>المؤسس والرئيس التنفيذي و<br>مدير سلسلة التوريد</span>
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
                            <i class="fi flaticon-ship"></i>
                        </div>
                        <div class="section-content">
                            <span>Provides safe payments</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-d">
                    <div class="section-item-2">
                        <div class="section-icon">
                            <i class="fi flaticon-truck"></i>
                        </div>
                        <div class="section-content">
                            <span>Assures an organised and fast process</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-d">
                    <div class="section-item-2">
                        <div class="section-icon">
                            <i class="fi flaticon-travel"></i>
                        </div>
                        <div class="section-content">
                            <span>Offers  the lowest costs</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 col-d">
                    <div class="section-item-2">
                        <div class="section-icon">
                            <i class="fi flaticon-delivery"></i>
                        </div>
                        <div class="section-content">
                            <span>Removes the logistical obstacles</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- team-area start -->
    <div class="team-area team-area-3" style="padding-top: 0px; direction: rtl">
        <div class="container">
            <div class="col-l2">
                <div class="section-title text-center">
                    <h2>الفريق</h2>
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
{{--@endsection--}}
@section('custom-footer')
@endsection
