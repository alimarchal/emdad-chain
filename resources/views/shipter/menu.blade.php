<nav class="nav_mobile_menu">
    <ul>
        <li class="{{(request()->routeIs('english.index')?'active':'')}}"><a href="{{route('english.index')}}">Home</a></li>
        <li class="{{(request()->routeIs('aboutUs')?'active':'')}}"><a href="about.html">About Us</a></li>
        <li class="{{(request()->routeIs('english.service')?'active':'')}}"><a href="{{route('english.service')}}">Services</a></li>
        <li class="{{(request()->routeIs('english.team')?'active':'')}}"><a href="{{route('english.team')}}">Our Team</a></li>
        <li class="{{(request()->routeIs('english.contact')?'active':'')}}"><a href="{{route('english.contact')}}">Support</a></li>
        <li class=""><a href="#">Survey</a>
            <ul class="submenu">
                <li><a href="blog.html">Buyer</a></li>
                <li><a href="blog-right.html">Supplier</a></li>
            </ul>
        </li>
    </ul>
</nav>
