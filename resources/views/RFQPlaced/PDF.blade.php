<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="http://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
    <style>
        table, td, th {
            border: 1px solid black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
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


        @php
    $url = config('app.url');
    $url = $url . '/Presento/assets/arabicfont/arabic_regular.ttf';
@endphp
@font-face {
            font-family: arabicFont;
            src: url({{$url}});
        }


        div {
            font-family: arabicFont;
        }



    </style>
</head>

<body style="font-family: arabicFont;">


<div class="header">

    <div style="margin: auto;">
        @php $logo_second = asset(Storage::url($collection[0]->business->business_photo_url)); @endphp
        <img src="{{ $logo_second }}" alt="{{ $logo_second }}" style="width: 85px;height: 65px;border-radius: 50%;margin-left: auto;margin-right: auto;display: block;" />
        <h3 style="text-align: center;">Requisition</h3>
    </div>



    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="center1">
        <strong>Buyer: </strong>{{ $collection[0]->business->business_name }}<br>
        <strong>Email: </strong>{{ $collection[0]->business->business_email }}<br>
        <strong>City: </strong>{{ $collection[0]->business->city }}<br>
        <strong>VAT Number: </strong> {{ $collection[0]->business->vat_reg_certificate_number }}<br><br>
        @if($collection[0]->rfq_type == 0)
            <strong>{{__('portal.Category Name')}}: </strong>
            <span style="color: royalblue">
            @php
                $category = \App\Models\Category::where('id',$collection[0]->category->id)->first();
                $parentCategory = \App\Models\Category::where('id',$category->parent_id)->first();
            @endphp
                {{ $category->name }}@if(isset($parentCategory->name)), {{ $parentCategory->name }} @endif
            </span><br>
        @endif
    </div>

    <div style="width: 40%;float: right;">
        <strong>Requisition Type: </strong>@if($collection[0]->rfq_type == 1) {{__('portal.Multiple Categories')}} @else {{__('portal.Single Category')}} @endif<br>
        <strong>Date: </strong>{{ $collection[0]->created_at }}<br>
        <strong>Requisition #: </strong>RFQ-{{ $collection[0]->id }}<br>
        <strong>Payment Terms: </strong>
        @if($collection[0]->payment_mode == 'Cash') Cash
        @elseif($collection[0]->payment_mode == 'Credit') Credit
        @elseif($collection[0]->payment_mode == 'Credit30days') Credit (30 Days)
        @elseif($collection[0]->payment_mode == 'Credit60days') Credit (60 Days)
        @elseif($collection[0]->payment_mode == 'Credit90days') Credit (90 Days)
        @elseif($collection[0]->payment_mode == 'Credit120days') Credit (120 Days)
        @endif
        <br>
        <strong>Contact #: </strong>{{ $collection[0]->warehouse->mobile }}<br>
        <strong>Warehouse for delivery: </strong>{{ $collection[0]->warehouse->warehouse_name }}<br>
    </div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<table class="min-w-full divide-y divide-black">
    <thead>

    <tr>
        <th style="text-align: center;background-color: #FCE5CD;font-weight: normal">#</th>
        @if($collection[0]->rfq_type == 1)
        <th style="text-align: center;background-color: #FCE5CD;font-weight: normal">CATEGORY NAME</th>
        @endif
        <th style="text-align: center;background-color: #FCE5CD;font-weight: normal">DESCRIPTION</th>
        <th style="text-align: center;background-color: #FCE5CD;font-weight: normal">BRAND</th>
        <th style="text-align: center;background-color: #FCE5CD;font-weight: normal">UOM</th>
        <th style="text-align: center;background-color: #FCE5CD;font-weight: normal">SIZE</th>
        <th style="text-align: center;background-color: #FCE5CD;font-weight: normal">DELIVERY PERIOD</th>
        <th style="text-align: center;background-color: #FCE5CD;font-weight: normal">LAST UP</th>
        <th style="text-align: center;background-color: #FCE5CD;font-weight: normal">QTY</th>
        <th style="text-align: center;background-color: #FCE5CD;font-weight: normal">REMARKS</th>
    </tr>

    </thead>
    <tbody class="bg-white divide-y divide-black border-1 border-black">
    @foreach ($collection as $rfp)
        <tr>
            <td  style="text-align: center">{{$loop->iteration}}</td>
            @php
                $category = \App\Models\Category::where('id',$rfp->category->id)->first();
                $parentCategory = \App\Models\Category::where('id',$category->parent_id)->first();
            @endphp
            @if($collection[0]->rfq_type == 1)
            <td  style="text-align: center"> {{ $rfp->item_name }}@if(isset($parentCategory->name)), {{ $parentCategory->name }} @endif </td>
            @endif
            <td  style="text-align: center">{{ strip_tags($rfp->description) }}</td>
            <td  style="text-align: center">@if(isset($rfp->brand)) {{ $rfp->brand }} @else -- @endif</td>
            <td  style="text-align: center">{{ $rfp->unit_of_measurement }}</td>
            <td  style="text-align: center">@if(isset($rfp->size)) {{ $rfp->size }} @else -- @endif </td>
            <td  style="text-align: center">
                @if($rfp->delivery_period =='Immediately') {{__('portal.Immediately')}}
                @elseif($rfp->delivery_period =='Within 30 Days') {{__('portal.30 Days')}}
                @elseif($rfp->delivery_period =='Within 60 Days') {{__('portal.60 Days')}}
                @elseif($rfp->delivery_period =='Within 90 Days') {{__('portal.90 Days')}}
                @elseif($rfp->delivery_period =='Standing Order - 2 per year') {{__('portal.Standing Order - 2 times / year')}}
                @elseif($rfp->delivery_period =='Standing Order - 3 per year') {{__('portal.Standing Order - 3 times / year')}}
                @elseif($rfp->delivery_period =='Standing Order - 4 per year') {{__('portal.Standing Order - 4 times / year')}}
                @elseif($rfp->delivery_period =='Standing Order - 6 per year') {{__('portal.Standing Order - 6 times / year')}}
                @elseif($rfp->delivery_period =='Standing Order - 12 per year') {{__('portal.Standing Order - 12 times / year')}}
                @elseif($rfp->delivery_period =='Standing Order Open') {{__('portal.Standing Order - Open')}}
                @else {{ $rfp->delivery_period }}
                @endif
            </td>
            <td  style="text-align: center">{{ number_format($rfp->last_price, 2) }} SR</td>
            <td  style="text-align: center">{{ $rfp->quantity }}</td>
            <td  style="text-align: center;word-wrap: break-word">@if(isset($rfp->remarks)){{ $rfp->remarks }} @else -- @endif</td>
        </tr>
    @endforeach
    </tbody>
</table>

<br>

<div class="header">

    <div class="center" style="width: 16.67%"></div>

    <div class="center" style="width: 66.66%">
        <div style="text-align: center;">Thank you for using Emdad platform as your business partner.</div><br><br>
    </div>

    <div class="center" style="width: 16.67%"></div>

</div>

<br>
<br>
<br>
<br>

<div class="header">

    <div class="flex" style="width: 100%;">
        <div class="flex-row" style="margin-top: 10px;float: right; margin-right: 8%;">Copied to Emdad records</div>
        <div class="flex-row" style="margin-left: 93%;">
            @php $img = asset('logo-full.png'); @endphp
            <img src="{{$img}}" style="height: 2.5rem; width: auto; margin-left: auto; margin-right: auto;">
        </div>
    </div>

</div>

</body>
