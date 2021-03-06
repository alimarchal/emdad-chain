<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{url('ficon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{url('ficon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{url('ficon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('ficon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{url('ficon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('ficon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{url('ficon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('ficon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{url('ficon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{url('ficon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('ficon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{url('ficon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('ficon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{url('ficon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{url('ficon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    <script src="https://cdn.tiny.cloud/1/izbyerk8x92uls8z2ulnezm5uaudhf41lw0lebop5ba724o5/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
                    {{--    Count down script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"
            integrity="sha512-lteuRD+aUENrZPTXWFRPTBcDDxIGWe5uu0apPEn+3ZKYDwDaEErIK9rvR0QzUGmUQ55KFE2RqGTVoZsKctGMVw=="
            crossorigin="anonymous"></script>
@livewireStyles

{{--    @if (auth()->user()->rtl == 1)--}}

<!-- Template Main CSS File -->
        <link href="Presento/assets/css/style.css" rel="stylesheet">
        <style>
            nav, #side-bar, #main, .inner-page {
                direction: rtl;
            }

            body, #main, div, header, nav, footer, .inner-page, .nav-menu a, h1,h2,h3,h4,h5,h6,p, button {
                font-family: arabicFont;
            }

        </style>
{{--    @endif--}}

<!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    @yield('headerScripts')
</head>

<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto" id="side-bar">
        @include('ire.arabic.layout.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
        @include('ire.arabic.layout.navigation-dropdown')
        <!-- Page Heading -->
            {{--            <div class="bg-white shadow">--}}
            {{--                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 ">--}}
            {{--                    {{ $header }}--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container mx-auto px-6 pb-8">
                    @yield('body')
                </div>
            </main>
        </div>
    </div>
    {{--            <!-- Page Content -->--}}
    {{--            <main>--}}
    {{--                {{ $slot }}--}}
    {{--            </main>--}}
</div>

@stack('modals')

@livewireScripts
<script>
    $('[data-countdown]').each(function () {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function (event) {
            $this.html(event.strftime('%D'));
        });
    });
</script>

</body>

</html>
