<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        table, td, th {
            border: 1px solid black;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

<body>


<div class="header">

    <div style="margin: auto;">
        <h3 style="text-align: center;margin-left: auto;margin-right: auto;display: block;">Delivery note</h3>
    </div>


    <br>
    <br>
    <br>

    <div style="width: 66.66%;float: left;">
        <strong>Delivery Note #: </strong> DN-{{ $deliveryNote->id }}<br>
        @if ($deliveryNote->status == 'completed')
        <strong>Invoice #: </strong> Inv-{{ $deliveryNote->delivery->invoice_id }}<br>
        @endif
        <strong>Purchase Order #: </strong> PO-{{ $deliveryNote->purchase_order->id }}<br>
        <strong>Category Name: </strong>
            @php
                $record = \App\Models\Category::where('id',$deliveryNote->purchase_order->item_code)->first();
                $parent= \App\Models\Category::where('id',$record->parent_id)->first();
            @endphp
            <span style="color: #145ea8;"> {{ $record->name }} , {{ $parent->name }} </span>
        <br>
        <strong>Date: </strong>{{ $deliveryNote->purchase_order->created_at }}<br>
        <strong>Quote #: </strong>Q-{{ $deliveryNote->purchase_order->qoute_no }}<br>
        <strong>Requisition #: </strong>RFQ-{{ $deliveryNote->purchase_order->rfq_no }}<br>
        <strong>Payment Terms: </strong>{{ $deliveryNote->purchase_order->payment_term }}<br>
    </div>

    <div style="width: 33.33%;float: right">
        @php
            $supplierBusiness = \App\Models\Business::where('id', $deliveryNote->supplier_business_id)->first();
        @endphp
        @php $logo_first = asset(Storage::url($supplierBusiness->business_photo_url)); @endphp
        <img src="{{ $logo_first }}" alt="{{ $logo_first }}" style="width: 5rem; height: 5rem; border-radius: 50%;"/>
    </div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>

<table class="min-w-full divide-y divide-black " style="margin-top: 4%;">
    <thead>
    <tr>
        <th style="background-color: #FCE5CD">
            #
        </th>
        <th style="background-color: #FCE5CD">
            Description
        </th>
        <th style="background-color: #FCE5CD">
            UOM
        </th>
        <th style="background-color: #FCE5CD">
            Quantity
        </th>
    </tr>
    </thead>

    <tbody class="bg-white divide-y divide-black border-1 border-black">
    <tr>
        <td style="text-align: center;">
            1
        </td>
        <td style="text-align: center;">
            {{ $deliveryNote->purchase_order->eOrderItem->description }}
        </td>
        <td style="text-align: center;">
            {{ $deliveryNote->purchase_order->uom }}
        </td>
        <td style="text-align: center;">
            {{ $deliveryNote->purchase_order->quantity }}
        </td>
    </tr>
    </tbody>
</table>


<br>
<br>
<br>
<br>

<div class="flex justify-between px-2 py-2 mt-2 h-15">
    <div style="text-align: center; margin: auto;">
        <p style="text-align: center; ">Thank you for using Emdad platform as your business partner </p>
        @php $img = asset('logo-full.png'); @endphp
        <img src="{{$img}}" width="100" >

    </div>

</div>

</body>
