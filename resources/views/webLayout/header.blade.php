<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <h1 class="logo me-auto"><a href="{{ config('app.url') }}"><img src="logo-full.png"></a></h1>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active"><a href="{{config('app.url')}}">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Our Team</a></li>
                <li><a href="#">Support</a></li>
                <li class="drop-down"><a href="{{url('survey')}}">Survey</a>
                    <ul>
                        <li><a href="{{url('survey')}}">Buyer</a></li>
                        <li><a href="#">Supplier</a></li>
                        <li><a href="#">Other</a></li>
                    </ul>
                </li>
                <li><a href="{{route('login')}}">Login</a></li>
                <li><a href="{{route('register')}}">Register</a></li>


                {{--                <li class="drop-down"><a href="">Survey</a>--}}
                {{--                    <ul>--}}
                {{--                        <li><a href="#">Drop Down 1</a></li>--}}
                {{--                        <li class="drop-down"><a href="#">Deep Drop Down</a>--}}
                {{--                            <ul>--}}
                {{--                                <li><a href="#">Deep Drop Down 1</a></li>--}}
                {{--                                <li><a href="#">Deep Drop Down 2</a></li>--}}
                {{--                                <li><a href="#">Deep Drop Down 3</a></li>--}}
                {{--                                <li><a href="#">Deep Drop Down 4</a></li>--}}
                {{--                                <li><a href="#">Deep Drop Down 5</a></li>--}}
                {{--                            </ul>--}}
                {{--                        </li>--}}
                {{--                        <li><a href="#">Drop Down 2</a></li>--}}
                {{--                        <li><a href="#">Drop Down 3</a></li>--}}
                {{--                        <li><a href="#">Drop Down 4</a></li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
            </ul>
        </nav><!-- .nav-menu -->
                <a href="{{url('ar')}}" class="get-started-btn scrollto"><img alt="" src="{{url('sa.png')}}" style="margin-right: 2px;margin-top:-4px;">العربية</a>
    </div>
</header>
