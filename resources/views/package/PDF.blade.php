<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>

        .header {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .center {
            width: 33.33%;
            float: left;
        }

        .center1 {
            width: 50%;
            float: left;
        }

        div {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

    </style>
</head>

<body>


<div class="header">
    <div class="center">
    </div>

    <div class="center">
        <h3 style="text-align: center; margin:0px;">Subscription Invoice</h3>
    </div>

    <div class="center">
        @php
            $path = 'logo-full.png';
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        @endphp
        <img src="{{ $base64 }}" alt="EMDAD CHAIN LOGO" class="block h-10 w-auto" style="margin-left: 40%; width: 50px; "/>
    </div>


    <br>
    <br>
    <br>
    <br>
    <div class="center1">
        <strong>Subscriber Name:  </strong> {{ auth()->user()->name }} <br>
        <strong>Subscriber Business Name:  </strong> {{ auth()->user()->business_name_get->business_name }} <br>
    </div>

    <div class="center1">
        @if(auth()->user()->registration_type == 'Buyer')
            <strong>ID #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>SB {{ $businessPackage->id }}<br>
        @elseif(auth()->user()->registration_type == 'Supplier')
            <strong>ID #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>SS {{ $businessPackage->id }}<br>
        @endif
        <strong>Starting Date: &nbsp;</strong>{{ $businessPackage->subscription_start_date }}<br>
        <strong>Ending Date: &nbsp; </strong>{{ $businessPackage->subscription_end_date }}<br>
    </div>
</div>

<br>
<br>
<br>
<br>
<br>


<div class="flex flex-wrap overflow-hidden  p-4 mt-4">
    <div class="w-full overflow-hidden lg:w-1/2 xl:w-1/2">
        <strong>Package Type: </strong> {{ $businessPackage->package->package_type}} <br>
        <strong>Package Charges (VAT included): </strong> {{ $businessPackage->package->charges}} SAR/year <br>
    </div>

    <br>
    <br>
</div>

<br>
<br>
<div class="flex justify-between px-2 py-2 mt-2 h-15">
    <div class="mt-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Thank you for using Emdad platform for your business.</div><br><br>
</div>

</body>
