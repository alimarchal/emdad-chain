<nav class="nav_mobile_menu" >
    <ul>
        <li class="{{(request()->routeIs('arabic.index')?'active':'')}}"><a href="{{route('arabic.index')}}">الرئيسية</a></li>
        <li class="{{(request()->routeIs('arabic.about')?'active':'')}}"><a href="{{route('arabic.about')}}">من إمداد</a></li>
        <li class="{{(request()->routeIs('arabic.service')?'active':'')}}"><a href="{{route('arabic.service')}}">ماذا تقدم</a></li>
        <li class="{{(request()->routeIs('arabic.team')?'active':'')}}"><a href="{{route('arabic.team')}}">الفريق</a></li>
        <li class="{{(request()->routeIs('arabic.contact')?'active':'')}}"><a href="{{route('arabic.contact')}}">دعمكم هنا</a></li>
        <li class="{{(request()->routeIs('arabic.survey') || request()->routeIs('arabic.buyerSurvey')|| request()->routeIs('arabic.supplierSurvey')?'active':'')}}">
            <a href="{{route('arabic.survey')}}">الاستبيان</a>
            <ul class="submenu">
                <li><a href="{{route('arabic.buyerSurvey')}}">للمشترين</a></li>
                <li><a href="{{route('arabic.supplierSurvey')}}">للموردين</a></li>
            </ul>
        </li>
    </ul>
</nav>
