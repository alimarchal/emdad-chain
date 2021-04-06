<nav class="nav_mobile_menu">
    <ul>
        <li class="{{(request()->routeIs('english.index')?'active':'')}}"><a href="{{route('english.index')}}">Home</a></li>
        <li class="{{(request()->routeIs('english.about')?'active':'')}}"><a href="{{route('english.about')}}">About Us</a></li>
        <li class="{{(request()->routeIs('english.service')?'active':'')}}"><a href="{{route('english.service')}}">Services</a></li>
        <li class="{{(request()->routeIs('english.team')?'active':'')}}"><a href="{{route('english.team')}}">Our Team</a></li>
        <li class="{{(request()->routeIs('english.contact')?'active':'')}}"><a href="{{route('english.contact')}}">Support</a></li>
        <li class="{{(request()->routeIs('english.survey') || request()->routeIs('english.buyerSurvey')|| request()->routeIs('english.supplierSurvey')?'active':'')}}">
            <a href="{{route('english.survey')}}">Survey</a>
            <ul class="submenu">
                <li><a href="{{route('english.buyerSurvey')}}">Buyer</a></li>
                <li><a href="{{route('english.supplierSurvey')}}">Supplier</a></li>
            </ul>
        </li>
    </ul>
</nav>
