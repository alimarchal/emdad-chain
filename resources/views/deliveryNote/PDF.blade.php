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
        <strong>Invoice #: </strong> Inv. -{{ $deliveryNote->delivery->invoice_id }}<br>
        <strong>Purchase Order #: </strong> P.O. -{{ $deliveryNote->purchase_order->id }}<br>
        <strong>Category Name: </strong>
            @php
                $record = \App\Models\Category::where('id',$deliveryNote->purchase_order->item_code)->first();
                $parent= \App\Models\Category::where('id',$record->parent_id)->first();
            @endphp
            {{ $record->name }} , {{ $parent->name }}
        <br>
        <strong>Date: </strong>{{ $deliveryNote->purchase_order->created_at }}<br>
        <strong>Requisition #: </strong>RFQ-{{ $deliveryNote->purchase_order->rfq_no }}<br>
        <strong>Quote #: </strong>Q-{{ $deliveryNote->purchase_order->qoute_no }}<br>
        <strong>Payment Terms: </strong>{{ $deliveryNote->purchase_order->payment_term }}<br>
    </div>

    <div style="width: 33.33%;float: right">
        @php
            $supplierBusiness = \App\Models\Business::where('id', $deliveryNote->supplier_business_id)->first();
        @endphp
        <img src="{{(isset($supplierBusiness->business_photo_url) ? Storage::url($supplierBusiness->business_photo_url):' ')}}" alt="{{$supplierBusiness->business_name}}" style="height: 80px;width: 200px;"/>
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
        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
            #
        </th>
        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
            Description
        </th>
        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
            UOM
        </th>
        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
            Quantity
        </th>
    </tr>
    </thead>
{{--    @foreach($deliveryNote as $dn)--}}
        <tbody class="bg-white divide-y divide-black border-1 border-black">
        <tr>
            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="text-align: center;">
                #
            </td>
            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="text-align: center;">
                {{ $deliveryNote->purchase_order->eOrderItem->description }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="text-align: center;">
                {{ $deliveryNote->purchase_order->uom }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="text-align: center;">
                {{ $deliveryNote->purchase_order->quantity }}
            </td>
        </tr>
        </tbody>
{{--    @endforeach--}}
</table>


<br>
<br>
<br>
<br>
<div style="vertical-align: middle;">
    <div style="text-align: center;">Thank you for using Emdad platform as your business partner.</div><br><br>
</div>

</body>
