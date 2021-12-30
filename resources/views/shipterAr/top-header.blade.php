<div class="col-md-6 col-sm-12 col-12 col-lg-7">
    <ul class="d-flex account_login-area">
        <li>
            {{--<a href="{{route('english.index')}}" class="btn btn-warning" style="background: #eb8e23;border-color: white;width: 100px;font-family: sans-serif;color: whitesmoke;">
                <img alt="" src="{{url('us.png')}}" style="margin-bottom: 4px;">
                &nbsp;English
            </a>--}}
            <a href="{{route('english.index')}}" class="english rounded-pill" style="width: 120px;font-family: sans-serif;color: whitesmoke;font-weight: normal">
                <img alt="" src="{{url('us.png')}}" style="margin-bottom: 4px;">
                &nbsp;English
            </a>
        </li>
        <li style="margin-top: 10px;">
            باستطاعتك الآن تسجيل منشأتك في منصة إمداد الرقميةً
        </li>
    </ul>
</div>
{{--<div class="col-md-6 col-sm-12 col-12 col-lg-6">
    <div class="row">
        <div class="col-lg-9 col-md-6">
            <ul class="login-r login_link">
                <li><a style="color: white;" href="{{route('login')}}">
                        الدخول إلى المنصة
                    </a> </li>
            </ul>
        </div>
        <div class="col-lg-3 col-md-6" style="text-align: end">
            <li><img src="{{url('Shipter/assets/images/logo/logo-2030.png')}}" alt="Vision 2030" style="height: 30px; width: 50px;"></li>
        </div>
    </div>
</div>--}}
<div class="col-md-6 col-sm-12 col-12 col-lg-5">
    <div class="row">
        <div class="col-lg-9 col-md-6">
            <div class="flex" style="text-align: end">
                <div class="flex-row float-right ml-2">
                    <div class="btn-style login_button_nav_bar">
                        <a href="{{route('loginAr', 'ar')}}" style="border-radius: 25px;border-color: orange;padding: 7px;width: 70px;text-align: center;font-weight: normal">الدخول</a>
                    </div>
                </div>
                <div class="flex-row float-end mt-1">
                    <div class="a_hover_class register_button_nav_bar">
                        <a href="{{route('registerAr', 'ar')}}" style="border-radius: 25px;color: whitesmoke">تسجيل</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6" style="text-align: end">
            <li><img src="{{url('Shipter/assets/images/logo/logo-2030.png')}}" alt="Vision 2030" style="height: 30px; width: 50px;margin-top: 6px;"></li>
        </div>
    </div>
</div>
