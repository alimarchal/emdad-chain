@extends('shipterAr.layout')
@section('title','دعمكم هنا')
@section('custom-header')
@endsection
@section('custom-body-style')
    style="font-family: arabicFont;"
@endsection
@section('inside-body')
@section('breadcumb-title','Contact Us')
@section('breadcumb-text','Contact Us')
@section('main')

    @include('shipterAr.breadcumb-area')
    <!-- .contact-page-area start -->

        <div class="contact-page-area section-padding" style="direction: rtl">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <div class="contact-page-item">
                            <h2>CONTACT DETAILS</h2>
                            <p>Give us a call or drop by anytime, we endeavour to answer all enquiries within 24 hours on business days. We will be happy to answer your questions.</p>
                            <div class="adress">
                                <h3>العنوان</h3>
                                <span>مركز ابان ١٢٠،
طريق الملك عبد العزيز، مخرج ٥
المملكة العربية السعودية، الرياض - ١٣٥٢٥</span>
                            </div>
                            <div class="phone">
                                <h3>Phone</h3>
                                <span>+966 53 416 8874</span>
                            </div>
                            <div class="email">
                                <h3>البريد الإلكتروني:</h3>
                                <span>info@emdad-chain.com</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="contact-area">
                            <h2>Ready to Get Started?</h2>
                            <p>Your email address will not be published. Required fields are marked *</p>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(Session::has('message'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                            @endif
                            <div class="contact-form">
                                <form action="{{route('contact.store')}}" method="post" >
                                    @csrf
                                    <div class="half-col">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="الاسم *">
                                    </div>
                                    <div class="half-col">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="البريد الإلكتروني *">
                                    </div>
                                    <div class="half-col">
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="رقم الجوال *">
                                    </div>
                                    <div class="half-col">
                                        <input type="text" name="subject" id="subject" class="form-control" placeholder="الموضوع *">
                                    </div>
                                    <div>
                                        <textarea class="form-control" name="message"  id="message" placeholder="الرسالة... *"></textarea>
                                    </div>
                                    <div class="submit-btn-wrapper">
                                        <button type="submit" class="btn-primary">إرسال</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="contact-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d927764.3550487261!2d46.26206159131756!3d24.724150391445495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d489399%3A0xba974d1c98e79fd5!2sRiyadh%2011564%2C%20Saudi%20Arabia!5e0!3m2!1sen!2s!4v1617639278154!5m2!1sen!2s" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- .contact-page-area end -->

@endsection
@endsection
@section('custom-footer')
@endsection
