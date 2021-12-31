@extends('shipter.layout')
@section('custom_header_image')
    background-image: url('photo6.jpg');
@endsection
@section('title','Contact Us')
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
@section('breadcumb-title','Contact Us')
@section('breadcumb-text','Contact Us')
@section('main')

    @include('shipter.breadcumb-area')
    <!-- .contact-page-area start -->

        <div class="contact-page-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <div class="contact-page-item">
                            <h2>CONTACT DETAILS</h2>
                            <p>Give us a call or drop by anytime, we endeavour to answer all enquiries within 24 hours on business days. We will be happy to answer your questions.</p>
                            <div class="adress">
                                <h3>Address</h3>
                                <span>120 Aban Center, King Abdul Aziz Road, Exit 5, <br>Riyadh - 13525, Kingdom of Saudi Arabia (KSA)</span>
                            </div>
                            <div class="phone">
                                <h3>Phone</h3>
                                <span>+9200 12057</span>
                            </div>
                            <div class="email">
                                <h3>Email</h3>
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
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Your Name *">
                                    </div>
                                    <div class="half-col">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Your Email *">
                                    </div>
                                    <div class="half-col">
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone *">
                                    </div>
                                    <div class="half-col">
                                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject *">
                                    </div>
                                    <div>
                                        <textarea class="form-control" name="message"  id="message" placeholder="Your Message... *"></textarea>
                                    </div>
                                    <div class="submit-btn-wrapper">
                                        <button type="submit" class="btn-primary" style="border-radius: 25px;">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="contact-map">
{{--                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d927764.3550487261!2d46.26206159131756!3d24.724150391445495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d489399%3A0xba974d1c98e79fd5!2sRiyadh%2011564%2C%20Saudi%20Arabia!5e0!3m2!1sen!2s!4v1617639278154!5m2!1sen!2s" allowfullscreen></iframe>--}}
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3622.6660168379744!2d46.66617147624493!3d24.77263780652448!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2ee2d3da825d23%3A0x9f763b1e7978766c!2zNzMyOSDZiNin2K_ZiiDYrdio2KfZhtiMIEFsIEdoYWRpciwgUml5YWRoIDEzMzExwqA0NzUzLCBTYXVkaSBBcmFiaWE!5e0!3m2!1sen!2s!4v1640957190186!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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
