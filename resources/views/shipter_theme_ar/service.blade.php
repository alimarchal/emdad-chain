@extends('shipterAr.layout')

@section('custom_header_image')

@endsection
@section('title','Services')
@section('custom-header')
@endsection
@section('custom-body-style')
@endsection
@section('inside-body')
@section('breadcumb-title','Services')
@section('breadcumb-text','Services')
@section('main')

    @include('shipterAr.breadcumb-area')
    <!-- section-section start -->
    <div class="section-area section-style-2 section-style-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-9 col-sm-12 col-d c-pd">
                    <div class="section-wrap">
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi flaticon-ship"></i>
                            </div>
                            <div class="section-content">
                                <p><a>Logistics Department</a></p>
                                <span>More control over inventory management.Precise orders tracking.
                                      Benefiting from the storage service.</span>
                            </div>
                        </div>
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi flaticon-truck"></i>
                            </div>
                            <div class="section-content">
                                <p><a>Sales Department</a></p>
                                <span>Easy increase for average sales percentage.Follow up with sales officers regularly.
                                      Quotations generating and approving online.</span>
                            </div>
                        </div>
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi flaticon-plane"></i>
                            </div>
                            <div class="section-content">
                                <p><a>Financial Department</a></p>
                                <span>Prevention of misappropriation of funds.Financial analysis of the accounts at the end of each financial period.
                                      Punctual funds collections.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="tr-wrap">
                        <div class="t-text">
                            <h2>Suppliers</h2>
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
                                <p><a>Logistics Department</a></p>
                                <span>A continuous stock of the required items.Precise orders tracking.Orders scheduling.</span>
                            </div>
                        </div>
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi flaticon-truck"></i>
                            </div>
                            <div class="section-content">
                                <p><a>Purchases Department</a></p>
                                <span>Online purchase orders approval.Available online reports around the clock.
                                      Online requests for orders or services at any time.</span>
                            </div>
                        </div>
                        <div class="section-item-2">
                            <div class="section-icon">
                                <i class="fi flaticon-plane"></i>
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
                    <div class="tr-wrap">
                        <div class="t-text">
                            <h2>Buyers</h2>
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
    <div class="service-area">
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
                                <h3>Logistics Department</h3>
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
                                <h3>Sales Department</h3>
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
                                <h3>Financial Department</h3>
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
                                <h3>Logistics Department</h3>
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
                                <h3>Purchases Department</h3>
                                <p>Online purchase orders approval.Available online reports around the clock.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-item">
                        <div class="service-single">
                            <div class="service-img">
                                <img src="{{url('Shipter/assets/images/service/5.jpg')}}" alt="">
                            </div>
                            <div class="service-content service-content5">
                                <h3>Financial Department</h3>
                                <p>Quotations received from reliable suppliers.</p>
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
