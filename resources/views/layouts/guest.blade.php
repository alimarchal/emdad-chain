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
        <link rel="apple-touch-icon" sizes="57x57" href="ficon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="ficon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="ficon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="ficon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="ficon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="ficon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="ficon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="ficon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="ficon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="ficon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="ficon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="ficon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="ficon/favicon-16x16.png">
        <link rel="manifest" href="ficon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="ficon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>

        <style>
            table {
                font-size: 1em;
            }

            .ui-draggable, .ui-droppable {
                background-position: top;
            }
        </style>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $( function() {
                $( "#datepicker" ).datepicker();
            } );
        </script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
