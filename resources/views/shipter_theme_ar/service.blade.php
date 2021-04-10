@extends('shipterAr.layout')

@section('custom_header_image')

@endsection
@section('title','Services')
@section('custom-header')
@endsection
@section('custom-body-style')
    style="font-family: arabicFont;"
@endsection
@section('inside-body')
@section('breadcumb-title','What does it provide')
@section('breadcumb-text','What does it provide')
@section('main')

    @include('shipterAr.breadcumb-area')
    <!-- section-section start -->
    <div class="section-area section-style-2 section-style-3" style="direction: rtl">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-9 col-sm-12 col-d c-pd">
                    <div class="section-wrap">
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi flaticon-ship"></i>
                            </div>
                            <div class="section-content">
                                <p><a>القسم اللوجستي</a></p>
                                <span>التحكم بشكل أكبر في إدارة المخزون.
                                    إمكانية تتبع الطلب بشكل دقيق جدا.
                                    إمكانية الاستفادة من خدمة التخزين.</span>
                            </div>
                        </div>
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi flaticon-truck"></i>
                            </div>
                            <div class="section-content">
                                <p><a>المبيعات</a></p>
                                <span>سهولة إمكانية رفع معدل نسبة المبيعات.
                                    متابعة موظفين المبيعات بشكل دوري مباشر.
                                    إنشاء واعتماد عروض الأسعار إلكترونياً.</span>
                            </div>
                        </div>
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi flaticon-plane"></i>
                            </div>
                            <div class="section-content">
                                <p><a>المالية</a></p>
                                <span>منع الاختلاسات المالية.
                                    إمكانية الاستفادة من التحليل المالي للحسابات في نهاية كل فترة مالية.
                                    ضمان تحصيل الأموال في الوقت المحدد.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="tr-wrap">
                        <div class="t-text">
                            <h2>للموردين</h2>
                        </div>
                        <div class="tr-s">
                            <span>The ability to request electronic reports at any time.</span>
                            <span>Save all operations and documents in an electronic cloud as a reference.</span>
                            <span>Monitor and follow up the authority of the sales team and the existing transactions.</span>
                            <span>Enhancing and enabling the capabilities and expertise of employees with free training courses.</span>
                            <span>The ability to approve quotations electronically.</span>
                            <span>We guarantee you get the money on time</span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-4 col-md-9 col-sm-12 col-d c-pd">
                    <div class="section-wrap">
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi flaticon-ship"></i>
                            </div>
                            <div class="section-content">
                                <p><a>القسم اللوجستي</a></p>
                                <span>توفير مخزون للمنتجات المطلوبة بشكل مستمر ودوري
                                        إمكانية تتبع الطلب بشكل دقيق جدا
                                        إمكانية جدولة الطلبات </span>
                            </div>
                        </div>
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi flaticon-truck"></i>
                            </div>
                            <div class="section-content">
                                <p><a>المشتريات</a></p>
                                <span>إمكانية اعتماد أوامر الشراء إلكترونيا
                                        إمكانية طلب التقارير الإلكترونية في أي وقت
                                        إمكانية طلب أي منتج أو خدمة في أي وقت</span>
                            </div>
                        </div>
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi flaticon-plane"></i>
                            </div>
                            <div class="section-content">
                                <p><a>المالية/التكاليف</a></p>
                                <span>ضمان طلب عروض الأسعار من المورّد الموثوق
                                    إمكانية الدفع المقدم بالنقد أو الاجل لحساب بنكي واحد
                                    تقليل التكلفة الشرائية</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="tr-wrap">
                        <div class="t-text">
                            <h2>للمشترين</h2>
                        </div>
                        <div class="tr-s">
                            <span>The possibility of safe payment.</span>
                            <span>The possibility of tracking shipments.</span>
                            <span>The possibility of dealing in cash or on credit.</span>
                            <span>Guarantee of requesting quotations from the correct supplier.</span>
                            <span>The ability to register suppliers and deal with them directly.</span>
                            <span>Enhancing the search for an alternative or new product in an easy and fast way.</span>
                            <span>Prevent financial fraud and secret dealings between seller and buyer.</span>
                            <span>The ability to approve purchase orders electronically.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--section-section end -->
    <!-- service-area start-->
    <div class="service-area" style="direction: rtl">
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
                                <img src="{{url('Shipter/assets/images/service/1.jpg')}}" alt="">
                            </div>
                            <div class="service-content">
                                <h3>القسم اللوجستي</h3>
                                <p>More control over inventory management.Precise orders tracking.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-item">
                        <div class="service-single">
                            <div class="service-img">
                                <img src="{{url('Shipter/assets/images/service/2.jpg')}}" alt="">
                            </div>
                            <div class="service-content service-content2">
                                <h3>المبيعات</h3>
                                <p>Easy increase for average sales percentage.Follow up with sales officers regularly.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-item">
                        <div class="service-single">
                            <div class="service-img">
                                <img src="{{url('Shipter/assets/images/service/6.jpg')}}" alt="">
                            </div>
                            <div class="service-content service-content6">
                                <h3>المالية</h3>
                                <p>Prevention of misappropriation of funds.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-item">
                        <div class="service-single">
                            <div class="service-img">
                                <img src="{{url('Shipter/assets/images/service/3.jpg')}}" alt="">
                            </div>
                            <div class="service-content service-content3">
                                <h3>القسم اللوجستي</h3>
                                <p>A continuous stock of the required items.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-item">
                        <div class="service-single">
                            <div class="service-img">
                                <img src="{{url('Shipter/assets/images/service/4.jpg')}}" alt="">
                            </div>
                            <div class="service-content service-content4">
                                <h3>المشتريات</h3>
                                <p>Online purchase orders approval.Available online reports around the clock.</p>
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
