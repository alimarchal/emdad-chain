@extends('shipterAr.layout')
@section('title','هدف الاستبيان')
@section('custom-header')
    <style>
        .survey {
            background-color: black;
            color: white;
        !important;
            padding: 14px 25px;
        !important;
            text-align: center;
        !important;
            text-decoration: none;
        !important;
            display: inline-block;
        !important;
        }

        .survey:hover {
            background-color: #fd7e14;
            color: white;
        }

        .header-area.header-style-2 .slicknav_btn {
            margin-top: 0px !important;
        }
    </style>


@endsection
@section('custom-body-style')
    style="font-family: arabicFont;"
    style="direction:rtl;"
@endsection

@section('main')
    <!-- FAQs-area start -->
    <div class="section-area section-style-2">
        <div class="container mt-5 mb-5">
            <h3 class="text-center mb-4">أسئلة مكررة</h3>
            <div id="accordion">
                @foreach(\App\Models\FAQs::all() as $faq)
                    @if($faq->id == 1)
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#collapse{{$faq->id}}">
                                    {{$faq->question_ar}}
                                </a>
                            </div>
                            <div id="collapse{{$faq->id}}" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    {{$faq->answer_ar}}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#collapse{{$faq->id}}">
                                    {{$faq->question_ar}}
                                </a>
                            </div>
                            <div id="collapse{{$faq->id}}" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    {{$faq->answer_ar}}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>
    </div>
    <!-- FAQs-area end -->
@endsection

@section('custom-footer')
@endsection
