<nav class="nav_mobile_menu">
    <ul style="text-align: right">
        <li class="{{(request()->routeIs('arabic.index')?'active':'')}}"><a href="{{route('arabic.index')}}">الرئيسية</a></li>
        <li class="{{(request()->routeIs('arabic.about')?'active':'')}}"><a href="{{route('arabic.about')}}">ما هي إمداد</a></li>
        <li class="{{(request()->routeIs('arabic.service')?'active':'')}}"><a href="{{route('arabic.service')}}">مميزات إمداد</a></li>
        <li class="{{(request()->routeIs('arabic.team')?'active':'')}}"><a href="{{route('arabic.team')}}">فريق إمداد</a></li>
        <li class="{{(request()->routeIs('arabic.contact')?'active':'')}}"><a href="{{route('arabic.contact')}}">دعمكم هنا</a></li>
        <li class="{{(request()->routeIs('arabic.survey') || request()->routeIs('arabic.buyerSurvey')|| request()->routeIs('arabic.supplierSurvey')?'active':'')}}">
            <a href="{{route('arabic.survey')}}">الاستبيان</a>
            <ul class="submenu">
                <li class="{{(request()->routeIs('arabic.buyerSurvey')?'active':'')}}"><a href="{{route('arabic.buyerSurvey')}}">للمشتري</a></li>
                <li class="{{(request()->routeIs('arabic.supplierSurvey')?'active':'')}}"><a href="{{route('arabic.supplierSurvey')}}">للمورّد</a></li>
            </ul>
        </li>
{{--        <li><a href="javascript:void(0)">مركز التدريب</a></li>--}}
{{--        <li><a href="javascript:void(0)">كيف تعمل</a></li>--}}
        <li class="{{(request()->routeIs('arabic.suppliers')?'active':'')}}"><a href="{{route('arabic.suppliers')}}">الموردون</a></li>
    </ul>
</nav>
