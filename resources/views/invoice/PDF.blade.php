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
        <h3 style="text-align: center; margin:0;">Invoice</h3>
    </div>

    <div class="center">
        @php
            $supplierBusiness = \App\Models\Business::where('id', $invoice->supplier_business_id)->first();
            $buyerBusiness = \App\Models\Business::where('id', $invoice->buyer_business_id)->first();
        @endphp
{{--        <img src="{{(isset($supplierBusiness->business_photo_url)?Storage::url($supplierBusiness->business_photo_url):'#')}}" alt="{{$supplierBusiness->business_name}}" style="height: 80px;width: 200px;"/>--}}
        @php $logo_first = asset(Storage::url($supplierBusiness->business_photo_url)); @endphp
        <img src="{{ $logo_first }}" alt="{{ $logo_first }}" style="width: 5rem; height: 5rem; border-radius: 50%;"/>

        <h5 style="text-align: center; margin:0px;">{{ $quote->buyer_business->business_name }}</h5>
    </div>

    <br>
    <br>
    <br>

    <div class="center" style="width: 60%;float: left;">
        <strong>Supplier Business Name: </strong> {{ $supplierBusiness->business_name }}<br>
        <strong>Email: </strong> {{ $supplierBusiness->business_email }}<br>
        <strong>Phone: </strong> {{ $supplierBusiness->phone }}<br>
        <strong>Address: </strong> {{ $supplierBusiness->address }}<br>
    </div>

{{--    <div class="center" style="width: 33.33%;float: left"></div>--}}

    <div class="center" style="width: 40%;float: right">
        <strong>Invoice #: </strong> Inv. -{{ $invoice->id }}<br>
        <strong>Date: </strong> {{ $invoice->created_at }}<br>
    </div>

    <br><br>
    <br><br><br>
    <br>

    <div class="center" style="width: 60%;float: left;">
        <strong>Buyer Business Name: </strong> {{ $buyerBusiness->business_name }}<br>
        <strong>Email: </strong> {{ $buyerBusiness->business_email }}<br>
        <strong>Phone: </strong> {{ $buyerBusiness->phone }}<br>
        <strong>Address: </strong> {{ $buyerBusiness->address }}<br>

    </div>

{{--    <div class="center" style="width: 33.33%;float: left;"></div>--}}

    <div class="center" style="width: 40%;float: right">

        <strong>Purchase Order #: </strong> PO-{{ $invoice->purchase_order->id }}<br>
        <strong>Category Name: </strong>
        @php
            $record = \App\Models\Category::where('id',$invoice->purchase_order->item_code)->first();
            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
        @endphp
        {{ $record->name }} , {{ $parent->name }}
        <br>
        <strong>Requisition #: </strong>RFQ-{{ $invoice->purchase_order->rfq_no }}<br>
        <strong>Quote #: </strong>Q-{{ $invoice->purchase_order->qoute_no }}<br>
        <strong>Payment Terms: </strong>
        @if($invoice->purchase_order->payment_term == 'Cash') {{__('portal.Cash')}}
        @elseif($invoice->purchase_order->payment_term == 'Credit') {{__('portal.Credit')}}
        @elseif($invoice->purchase_order->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
        @elseif($invoice->purchase_order->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
        @elseif($invoice->purchase_order->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
        @elseif($invoice->purchase_order->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
        @endif

        <br>
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
        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
            UNIT PRICE
        </th>
        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
            TOTAL
        </th>
    </tr>
    </thead>
    {{--    @foreach($invoice as $dn)--}}
    <tbody class="bg-white divide-y divide-black border-1 border-black">
    <tr>
        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="text-align: center;">
            1
        </td>
        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="text-align: center;">
            {{ $invoice->eOrderItem->description }}
        </td>
        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="text-align: center;">
            {{ $invoice->purchase_order->uom }}
        </td>
        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="text-align: center;">
            {{ $invoice->purchase_order->quantity }}
        </td>
        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="text-align: center;">
            {{ $invoice->purchase_order->unit_price }} SAR
        </td>
        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="text-align: center;">
            {{ number_format(($invoice->purchase_order->quantity * $invoice->purchase_order->unit_price), 2) }}  SAR
        </td>
    </tr>
    </tbody>
    {{--    @endforeach--}}
</table>


<br>
<br>
<br>
<br>

<div class="header">

    <div style="width: 66.66%;float: left;"></div>

    <div style="width: 33.33%;float: right">
        <strong>Sub-total: </strong> {{ number_format(($invoice->purchase_order->quantity * $invoice->purchase_order->unit_price), 2) }} SAR<br>
        <strong>VAT: </strong> {{ $invoice->vat }} %<br>
        <strong>Shipment cost: </strong> {{ $invoice->purchase_order->shipment_cost }} SAR<br>
        <hr>
        <strong>Total: </strong> {{ number_format($invoice->total_cost, 2) }} SAR<br>
        <hr>
        <br>
        <br>
        <br>
        <br>
    </div>

</div>
<br>
<br>
<br>
<br><br>
<br>
<br>
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

<div class="header">

    <div class="center" style="width: 33.33%"></div>

    <div class="center" style="width: 33.33%"></div>

    <div class="center" style="width: 33.33%; float: right">
        <div style="margin-top: 2px;">Copied to Emdad records</div>
        <div>
            @php $img = asset('logo-full.png'); @endphp
            <img src="{{$img}}" style="height: 10px; width: auto; margin-left: auto; margin-right: auto;"></div>
    </div>

</div>

</body>
