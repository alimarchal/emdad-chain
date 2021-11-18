@extends('shipter.layout')
@section('custom_header_image')
    background-image: url('images/Photo no.6.jpg');
@endsection
@section('title','Team')
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
@section('breadcumb-title','Emdad\'s Team')
@section('breadcumb-text','Emdad\'s Team')
@section('main')

    @include('shipter.breadcumb-area')
<!-- team-area start -->
<div class="team-area team-area-2">
    <div class="container">
        <div class="col-l2">
            <div class="section-title text-center">
                <span>We Are With You</span>
                <h2>Our Team Members</h2>
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
                        <h4>Abdulaziz AlSinany</h4>
                        <span>Founder and CEO/SCM </span>
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
                        <h4>Ahsan Raza</h4>
                        <span>BD/Sales Manager</span>
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
                        <h4>Rayan Al Sinany</h4>
                        <span>Juniour Accountant</span>
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
                        <h4>Muteb Al Buraikan</h4>
                        <span>Human Resources Specialist</span>
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
                        <h4>Ala'a Al Hamzy</h4>
                        <span>Sales Supervisor</span>
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
                        <h4>Rawan Al Shahrani</h4>
                        <span>Digital Marketing Specialist</span>
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
                        <h4>Amjaad Shahri</h4>
                        <span>Supply Chain Specialist</span>
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
                        <h4>Maryam Al Hajji</h4>
                        <span>Graphic Designer</span>
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
                        <h4>Ghada</h4>
                        <span>CEO Assistant</span>
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
                        <h4>Mustahsan Rizvi</h4>
                        <span>Office Administrator (Pakistan)</span>
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
                        <h4>Shahad</h4>
                        <span>Sales Officer</span>
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
                        <h4>Ali Raza Marchal</h4>
                        <span>Software Developer</span>
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
                        <h4>Umair Pervaiz Butt</h4>
                        <span>Software Engineer</span>
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
                        <h4>Ahmad</h4>
                        <span>Sales Specialist</span>
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
                        <h4>Noura</h4>
                        <span>Supply Chain Specialist</span>
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
                        <h4>Elham</h4>
                        <span>Supply Chain Specialist</span>
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
                        <h4>Adeel Cheema</h4>
                        <span>Mobile App Developer</span>
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
                        <h4>Insha Murad</h4>
                        <span>Mobile App Developer</span>
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
                        <h4>Ali Rizvi </h4>
                        <span>Accounts & HR Officer</span>
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
