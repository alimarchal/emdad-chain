<!-- .breadcumb-area start -->
<div class="breadcumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>@yield('breadcumb-title','')</h2>
                    <ul>
                        <li><a href="{{route('english.index')}}">Home</a></li>
                        <li><span>@yield('breadcumb-text','')</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
