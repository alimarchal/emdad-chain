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
                                <p><a>Inventory</a></p>
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
                                <p><a>Procurement</a></p>
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
                                <p><a>Costs</a></p>
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

@endsection
@endsection
@section('custom-footer')
@endsection
