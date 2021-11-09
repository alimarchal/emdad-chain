<div class="col-md-6 col-sm-12 col-12 col-lg-6">
    <ul class="d-flex account_login-area">
        <li>
            {{--<a href="{{route('arabic.index')}}" class="btn btn-warning" style="background: #eb8e23;border-color: white;color: whitesmoke"><img alt="" src="{{url('sa.png')}}" style="margin-right: 2px;margin-top:-4px; font-family: arabicFont;">
                &nbsp;العربية
            </a>--}}
            <a href="{{route('arabic.index')}}" class="english rounded-pill" style="font-family: arabicFont;width: 120px;color: whitesmoke;">
                <img alt="" src="{{url('sa.png')}}" style="margin-right: 2px;">
                &nbsp;العربية
            </a>
        </li>
        <li>You can register now with Emdad for free.</li>
    </ul>
</div>
<div class="col-md-6 col-sm-12 col-12 col-lg-6">
    <div class="row">
        <div class="col-lg-9 col-md-6">
            <div class="flex" style="text-align: end">
                <div class="flex-row float-right ml-2">
                    <div class="btn-style">
                        <a href="{{route('login')}}" style="border-radius: 25px;border-color: orange;padding: 7px;">Login</a>
                    </div>
                </div>
                <div class="flex-row float-end mt-1">
                    <div class="a_hover_class">
                        <a href="{{route('register')}}" style="border-radius: 25px;color: whitesmoke">Register</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6" style="text-align: end">
            <li><img src="{{url('Shipter/assets/images/logo/logo-2030.png')}}" alt="Vision 2030" style="height: 30px; width: 50px;"></li>
        </div>
    </div>
</div>
