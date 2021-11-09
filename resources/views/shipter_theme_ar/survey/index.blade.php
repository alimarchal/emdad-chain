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
    <!-- ======= Buttons ======= -->
    <section class="breadcrumbs" style="direction: rtl">
        <div class="container" style="margin-top: 40px;">
            <div class="btns mx-auto" align="center">
                <a class="btn-style survey col-lg-3 col-md-3" href="{{route('arabic.buyerSurvey')}}" style="border-radius: 25px;">استطلاع بياني للمشتري</a> &nbsp;
                <a class="btn-style survey col-lg-3 col-md-6" href="{{route('arabic.supplierSurvey')}}" style="border-radius: 25px;">استطلاع بياني للمورد</a>
            </div>
        </div>
    </section><!-- End Buttons --><br>

    <section class="inner-page" style="direction: rtl">
        <div class="container" data-aos="fade-up">
            <p class="text-center"><strong>هدف الاستبيان</strong></p>
            <p><strong>عزيزي صاحب المنشأة:</strong><br>
                حرصاً منا على تقديم خدمتنا بالمستوى الأفضل لكم تم عمل هذا الاستبيان تحدياً منا لرفع مستوى جودة سلاسل الامداد لديكم و خاصةً في ظل الظروف الحالية لجائحة COVID 19 و سعياً منا لتحقيق رؤية المملكة العربية السعودية 2030
            </p>

            <p><strong>تعريف عن الاستبيان</strong><br>
                هذا الاستبيان خاص بالمنشأت و الشركات ولا يمكن تعبئته من خلال فرد أو شخص.
                الإجابات على هذا الاستبيان سيتم التعامل معها لكل منشأة على حِدة لتقديم الخدمة اللازمة.
                مدة هذا الاستبيان من 8 الي 10 دقائق.</p>

            <p><strong>رسالة قصيرة</strong><br>
                نسعد بتعبئتكم لهذا الاستبيان الذي يهدف إلى تطوير و تحسين مستوى سلاسل الإمداد لديكم في المستقبل .. شكراً لكم.</p>
        </div>

    </section> <br>
@endsection

@section('custom-footer')
@endsection
