@extends('shipterAr.layout')

@section('custom_header_image')
    background-image: url('images/Our sevices (photo no.4).jpg');
@endsection
@section('title','مميزات إمداد')
@section('custom-header')
    <style>
        .header-area.header-style-2 .slicknav_btn {
            margin-top: 0px !important;
        }

        .section-area.section-style-2 .section-content {
            text-align: right;
        }


    </style>
@endsection
@section('custom-body-style')
    style="font-family: arabicFont;"
@endsection
@section('inside-body')
@section('breadcumb-title','مميزات إمداد')
@section('breadcumb-text','مميزات إمداد')
@section('main')

    @include('shipterAr.breadcumb-area')
    <!-- section-section start -->
    <div class="section-area section-style-2 section-style-3" style="direction: rtl">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-9 col-sm-12 col-d c-pd">
                    <div class="section-wrap" style="height: 100%">
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi" style="background-color: #505050; border-color: #c7e0f9">
                                    <img src="{{url('Shipter/assets/images/service/logistics_department.png')}}" style="width: 64px; height: 67px;" alt="">
                                </i>
                            </div>
                            <div class="section-content">
                                <p><a>التوريد والتخزين</a></p>
                                <span>
                                تحكم أكبر بإدارة المخزون. تتبع دقيق للطلبات.

                                </span>
                            </div>
                        </div>
                        <div class="section-item-2 mt-5">
                            <div class="section-icon">
                                <i class="fi" style="background-color: #505050; border-color: #c7e0f9">
                                    <img src="{{url('Shipter/assets/images/service/purchase_department.png')}}" style="width: 64px; height: 67px;" alt="">
                                </i>
                            </div>
                            <div class="section-content">
                                <p><a>المشتريات</a></p>
                                <span>
                                    عمليات شراء إلكترونية سريعة ومنظمة بدءً من إرسال الطلبات وحتى استلامها.
                                </span>
                            </div>
                        </div>
                        <div class="section-item-2 mt-5">
                            <div class="section-icon">
                                <i class="fi" style="background-color: #505050; border-color: #c7e0f9">
                                    <img src="{{url('Shipter/assets/images/service/Payments.png')}}" style="width: 64px; height: 67px;" alt="">
                                </i>
                            </div>
                            <div class="section-content">
                                <p><a>المالية </a></p>
                                <span>
                                    توفر خيارات دفع آمن بالمقدم والآجل وضمان تكاليف شرائية أقل.
                                </span>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="tr-wrap" style="padding-top: 45px;">
                        <div class="t-text">
                            <h2>للشركات والمنشآت</h2>
                        </div>
                        <div class="tr-s">

                            <ul style="list-style-type: disc;line-height: 4em">
                                <li>ضمان عمليات دفع آمنة.</li>
                                <li>تقنية تتبع الشحنات.</li>
                                <li>إمكانية التعامل بالمقدم والآجل.</li>
                                <li>ضمان طلب عروض الأسعار من المورد المناسب.</li>
                                <li>إمكانية تسجيل الموردين والتعامل معهم بطريقة مباشرة.</li>
                                <li>تعزيز البحث عن منتج بديل او جديد بطريقه سهله وسريعة.</li>
                                <li>منع الاختلاسات المالية والتعامل السري بين البائع والمشتري.</li>
                                <li>إمكانية اعتماد أوامر الشراء الكترونياً.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--section-section end -->

@endsection
@endsection
@section('custom-footer')
@endsection
