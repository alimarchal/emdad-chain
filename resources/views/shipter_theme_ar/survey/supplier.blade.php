@extends('shipterAr.layout')
@section('title','الاستبيان')
@section('custom-header')
    <style>
        .header-area.header-style-2 .slicknav_btn
        {
            margin-top: 0px!important;
        }
    </style>
@endsection
@section('custom-body-style')
    style="font-family: arabicFont;"
    style="direction:rtl;"
@endsection
@section('main')

    <section class="inner-page" style="background-color: lightgray; padding-top: 30px; padding-bottom: 30px; direction: rtl" >

        <form method="post" action="{{route('eBuyerEn')}}">
            @csrf
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <div class="container bg-white rounded p-4 mb-4">
                <h3 class="text-center">عن منشأتك</h3>
                <label for="question1212" class="form-label">عنوان البريد الالكترونى *</label>
                <input type="email" class="form-control" id="question1212" name="question45" required>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration <= 5)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_ar}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option_ar}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="container bg-white rounded p-4 mb-4">
                <h3 class="text-center">المبيعات</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 6 && $loop->iteration <= 17)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_ar}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option_ar}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="container bg-white rounded p-4 mb-4">
                <h3 class="text-center">المخزن</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 18 && $loop->iteration <= 21)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_ar}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option_ar}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="container bg-white rounded p-4 mb-4">
                <h3 class="text-center">القسم اللوجستي</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 22 && $loop->iteration <= 29)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_ar}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option_ar}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="container bg-white rounded p-4 mb-4">
                <h3 class="text-center">المنتجات</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 30 && $loop->iteration <= 36)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_ar}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option_ar}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="container bg-white rounded p-4 mb-4">
                <h3 class="text-center">المالية</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 37 && $loop->iteration <= 44)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_ar}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option_ar}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach

                <input type="hidden" name="language" value="en_supplier">
                <button type="submit" class="btn btn-primary ml-2 rounded-pill">إرسال</button>
            </div>

        </form>
    </section>

@endsection
@section('custom-footer')
@endsection
