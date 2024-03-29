<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        table,
        td,
        th {
            border: 1px solid bredlarck;
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

        div {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

    </style>
</head>

<body>


<div class="header">
    <div class="center"></div>

    <div class="center">
        <h3 style="text-align: center; margin:0;">Delivery note</h3>
    </div>

    <div class="center"></div>

    <br>
    <br>
    <br>

    <div style="width: 66.66%;float: left;">
        <strong>Delivery Note #: </strong> DN-{{ $deliveryNotes[0]->id }}<br>
        @if ($deliveryNotes[0]->status == 'completed')
        <strong>Invoice #: </strong> Inv-{{ $deliveryNotes[0]->delivery->invoice_id }}<br>
        @endif
        <strong>Purchase Order #: </strong> PO-{{ $deliveryNotes[0]->purchase_order->id }}<br>
        <strong>Category Name: </strong>
            @php
                $record = \App\Models\Category::where('id',$deliveryNotes[0]->purchase_order->item_code)->first();
                $parent= \App\Models\Category::where('id',$record->parent_id)->first();
            @endphp
            <span style="color: #145ea8;">{{ $record->name }}, {{ $parent->name }}</span>
        <br>
        <strong>Date: </strong>{{ $deliveryNotes[0]->purchase_order->created_at }}<br>
        <strong>Requisition #: </strong>RFQ-{{ $deliveryNotes[0]->purchase_order->rfq_no }}<br>
        <strong>Quote #: </strong>Q-{{ $deliveryNotes[0]->purchase_order->qoute_no }}<br>
        <strong>Payment Terms: </strong>{{ $deliveryNotes[0]->purchase_order->payment_term }}<br>
    </div>

    <div style="width: 33.33%;float: right">
        @php
            $supplierBusiness = \App\Models\Business::where('id', $deliveryNotes[0]->supplier_business_id)->first();
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

<table class="min-w-full divide-y divide-black " style="margin-top: 4%;width: 100%">
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
        @foreach($deliveryNotes as $deliveryNote)
            <tr>
                <td style="text-align: center;">
                    {{$loop->iteration}}
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
        @endforeach
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
