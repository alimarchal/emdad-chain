@extends('shipter.layout')
@section('title','Supplier Survey')
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
@section('main')

    <section class="inner-page" style="background-color: lightgray; padding-top: 30px;" >

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
                <h3 class="text-center">About your company</h3>
                <label for="question1212" class="form-label">Email address *</label>
                <input type="email" class="form-control" id="question1212" name="question45" required>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration <= 5)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_en}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="container bg-white rounded p-4 mb-4">
                <h3 class="text-center">Sales</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 6 && $loop->iteration <= 17)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_en}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="container bg-white rounded p-4 mb-4">
                <h3 class="text-center">Storage</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 18 && $loop->iteration <= 21)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_en}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="container bg-white rounded p-4 mb-4">
                <h3 class="text-center">Logistics</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 22 && $loop->iteration <= 29)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_en}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="container bg-white rounded p-4 mb-4">
                <h3 class="text-center">Products</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 30 && $loop->iteration <= 36)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_en}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="container bg-white rounded p-4 mb-4">
                <h3 class="text-center">Finance</h3>
                @foreach(\App\Models\EBuyerSurvey::all() as $q)
                    @if($loop->iteration >= 37 && $loop->iteration <= 44)
                        <div class="mb-3">
                            <label for="question{{$q->id}}" class="form-label">{{$q->question_s_en}}</label>
                            @foreach($q->answers as $key => $value)
                                @if($value->type == "text")
                                    <input type="text" class="form-control" id="question{{$value->id}}" name="question{{$q->id}}" required>
                                @elseif($value->type == "radio" || $value->type == "CHECKBOX")
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="question{{$q->id}}" id="question{{$value->id}}" value="{{$value->option}}"
                                               name="question{{$q->id}}">
                                        <label class="form-check-label" for="question{{$value->id}}">
                                            {{$value->option}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach

                <input type="hidden" name="language" value="en_supplier">
                <button type="submit" class="btn btn-primary ml-2" style="border-radius: 25px;">Submit</button>
            </div>

        </form>
    </section>

@endsection
@section('custom-footer')
@endsection
