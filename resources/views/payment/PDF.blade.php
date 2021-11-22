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
        @php
            $supplierBusiness = \App\Models\Business::where('id', $invoice->supplier_business_id)->first();
            $buyerBusiness = \App\Models\Business::where('id', $invoice->buyer_business_id)->first();
        @endphp
        @php $logo_first = asset(Storage::url($supplierBusiness->business_photo_url)); @endphp
        <img src="{{ $logo_first }}" alt="{{ $logo_first }}" style="width: 5rem;border-radius: 50%;;margin-left: 75px;" />
        <h3 style="text-align: center; margin:0;">Invoice</h3>
    </div>

    <div class="center">
        {{--@php
            $supplierBusiness = \App\Models\Business::where('id', $invoice->supplier_business_id)->first();
            $buyerBusiness = \App\Models\Business::where('id', $invoice->buyer_business_id)->first();
        @endphp
        @php $logo_first = asset(Storage::url($supplierBusiness->business_photo_url)); @endphp
        <img src="{{ $logo_first }}" alt="{{ $logo_first }}" style="width: 5rem; height: 5rem; border-radius: 50%;"/>--}}
{{--        <img src="{{(isset($supplierBusiness->business_photo_url)?Storage::url($supplierBusiness->business_photo_url):'#')}}" alt="{{$supplierBusiness->business_name}}" style="height: 80px;width: 200px;"/>--}}
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="center1">
        <strong>Supplier Business Name: </strong> {{ $supplierBusiness->business_name }}<br>
        <strong>Email: </strong> {{ $supplierBusiness->business_email }}<br>
        <strong>Phone: </strong> {{ $supplierBusiness->phone }}<br>
        <strong>VAT Number: </strong> {{ $supplierBusiness->vat_reg_certificate_number }}<br>
        <strong>Address: </strong> {{ $supplierBusiness->address }}<br><br>

        @if(isset($invoice->deliveryNote->id))
            <strong>Delivery Note #: </strong>DN-{{ $invoice->deliveryNote->id }}<br>
        @endif
        <strong>Invoice #: </strong> Inv-{{ $invoice->id }}<br>
        <strong>Date: </strong> {{ $invoice->created_at }}<br>
        <strong>Purchase Order #: </strong> PO-{{ $invoice->purchase_order->id }}<br>
        <strong>Quote #: </strong>Q-{{ $invoice->purchase_order->qoute_no }}<br>
        <strong>Requisition #: </strong>RFQ-{{ $invoice->purchase_order->rfq_item_no }}<br>
        <strong>Payment Terms: </strong>
        @if($invoice->purchase_order->payment_term == 'Cash') Cash
        @elseif($invoice->purchase_order->payment_term == 'Credit') Credit
        @elseif($invoice->purchase_order->payment_term == 'Credit30days') Credit (30 Days)
        @elseif($invoice->purchase_order->payment_term == 'Credit60days') Credit (60 Days)
        @elseif($invoice->purchase_order->payment_term == 'Credit90days') Credit (90 Days)
        @elseif($invoice->purchase_order->payment_term == 'Credit120days') Credit (120 Days)
        @endif

        <br>
    </div>

    <div style="width: 40%;float: right;">
        @php $buyer_logo = asset(Storage::url($buyerBusiness->business_photo_url)); @endphp
        <img src="{{ $buyer_logo }}" alt="{{ $buyer_logo }}" style="width: 150px;height: 80px;border-radius: 25px;"/><br><br><br>
        <strong>Buyer Business Name: </strong> {{ $buyerBusiness->business_name }}<br>
        <strong>Email: </strong> {{ $buyerBusiness->business_email }}<br>
        <strong>Phone: </strong> {{ $buyerBusiness->phone }}<br>
        <strong>VAT Number: </strong> {{ $buyerBusiness->vat_reg_certificate_number }}<br>
        <strong>Address: </strong> {{ $buyerBusiness->address }}<br>

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
            Category Name
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
        <th style="background-color: #FCE5CD">
            UNIT PRICE
        </th>
        <th style="background-color: #FCE5CD">
            TOTAL
        </th>
    </tr>
    </thead>
    <tbody class="bg-white divide-y divide-black border-1 border-black">
    <tr>
        <td style="text-align: center;">
            1
        </td>
        <td style="text-align: center;">
            @php
                $record = \App\Models\Category::where('id',$invoice->purchase_order->item_code)->first();
                $parent= \App\Models\Category::where('id',$record->parent_id)->first();
            @endphp
            {{ $record->name }} @if(isset($parent)) , {{ $parent->name }} @endif
        </td>

        <td style="text-align: center;">
            {{ $invoice->eOrderItem->description }}
        </td>
        <td style="text-align: center;">
            {{ $invoice->purchase_order->uom }}
        </td>
        <td style="text-align: center;">
            {{ $invoice->purchase_order->quantity }}
        </td>
        <td style="text-align: center;">
            {{ $invoice->purchase_order->unit_price }} SAR
        </td>
        <td style="text-align: center;">
            {{ number_format(($invoice->purchase_order->quantity * $invoice->purchase_order->unit_price), 2) }}  SAR
        </td>
    </tr>
    </tbody>
</table>


<br>
<br>

<div class="header">

    <div style="width: 66.66%;float: left;"></div>

    <div style="width: 33.33%;float: right">
        <strong>Sub-total: </strong> {{ number_format(($invoice->purchase_order->quantity * $invoice->purchase_order->unit_price), 2) }} SAR<br>
        @php $subtotal = $invoice->purchase_order->quantity * $invoice->purchase_order->unit_price; $subtotal += $invoice->purchase_order->shipment_cost; @endphp
        <strong>Shipment cost: </strong> {{ $invoice->purchase_order->shipment_cost }} SAR<br>
        <strong>VAT {{ number_format($invoice->vat) }}%: </strong>{{ number_format($subtotal * ($invoice->vat/100), 2) }} SAR<br>
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
<br>
<br>
<br>
<br>
<br>

<div class="w-full overflow-hidden mt-2 lg:w-1/2 xl:w-2/3">
    <div style="text-align: left;color: #145EA8;font-size: small">{{__('portal.General note')}}:</div>
</div>
<div class="w-full overflow-hidden mt-2 lg:w-1/2 xl:w-2/3">
    <div style="text-align: left;">
        <li style="color: #145EA8;font-size: small">{{__('portal.Emdad is a neutral Platform.')}}</li>
    </div>
</div>
<div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
    <div style="text-align: left;">
        <li style="color: #145EA8;font-size: small">{{__('portal.Legality of the source of this payment is buyer\'s responsibility.')}}</li>
    </div>
</div>
<div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
    <div style="text-align: left;">
        <li style="color: #145EA8;font-size: small">{{__('portal.Total amount of VAT, according to its category, is collectable at the supplier\'s end.')}}</li>
    </div>
</div>
<br>
<br>

@if((auth()->user()->registration_type == "Buyer" || auth()->user()->hasAnyRole(['Buyer Payment Admin', 'Buyer Purchaser', 'Buyer Purchase Admin'])) && $invoice->invoice_status == 3)
<div class="header">

    <div style="width: 66.66%;float: left;">
        @php $paid = asset('images/stamps/Artboard-6@8x.png'); @endphp
        <img src="{{$paid}}" width="100" >
        <br>
        <br>
        <br>
        <br>
    </div>

    <div style="width: 33.33%;float: right"></div>

</div>
<br>
<br>
<br>
<br>
<br>
<br>
@endif

<div class="header">

    <div class="center" style="width: 100%">
        <div style="text-align: center;">Thank you for using Emdad platform as your digital procurement solution</div><br><br>
    </div>

</div>

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
