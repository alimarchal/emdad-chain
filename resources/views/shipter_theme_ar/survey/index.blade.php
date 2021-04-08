@extends('shipterAr.layout')
@section('title','Survey')
@section('custom-header')
    <style>
        .survey {
            background-color: black;
            color: white; !important;
            padding: 14px 25px; !important;
            text-align: center; !important;
            text-decoration: none; !important;
            display: inline-block; !important;
        }
        .survey:hover {
            background-color: #fd7e14;
            color: white;
        }
    </style>
@endsection
@section('custom-body-style')
@endsection

@section('main')
    <!-- ======= Buttons ======= -->
    <section class="breadcrumbs">
        <div class="container" style="margin-top: 40px;" >
            <div class="btns mx-auto" align="center">
                <a class="btn-style survey col-lg-3 col-md-3" href="{{route('english.buyerSurvey')}}">Survey for Buyer</a> &nbsp;
                <a class="btn-style survey col-lg-3 col-md-6" href="{{route('english.supplierSurvey')}}">Survey for Supplier</a>
            </div>
        </div>
    </section><!-- End Buttons --><br>

    <section class="inner-page">
        <div class="container" data-aos="fade-up">
            <p class="text-center"><strong>For buyers and suppliers survey</strong></p>
            <p><strong>Introduction</strong><br>
                Dear owner of the organization:<br>
                In order for us to provide our service at the best level for you, this questionnaire was conducted to challenge us to raise the level of quality of your supply chains, especially in the current conditions with the COVID 19 pandemic, and in pursuit of us to achieve the vision of the Kingdom of Saudi Arabia 2030</p>

            <p><strong>Definition of the questionnaire</strong><br>
                This questionnaire is for establishments and companies and cannot be filled out by an individual or person.<br>
                Answers in this questionnaire will be dealt with for each facility separately to provide the required service.<br>
                The duration of this questionnaire is from 8 to 10 minutes.</p>

            <p><strong>Short message</strong><br>
                We appreciate the time you spent on filling out this questionnaire, which aims to develop and improve the level of your supply chains in the future. Thank you!</p>
        </div>

    </section> <br>
@endsection

@section('custom-footer')
@endsection
