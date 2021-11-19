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
            $supplierBusiness = \App\Models\Business::where('id', $invoices[0]->supplier_business_id)->first();
            $buyerBusiness = \App\Models\Business::where('id', $invoices[0]->buyer_business_id)->first();
        @endphp
        @php $logo_first = asset(Storage::url($supplierBusiness->business_photo_url)); @endphp
        <img src="{{ $logo_first }}" alt="{{ $logo_first }}" style="width: 5rem;border-radius: 50%;;margin-left: 75px;" />
        <h3 style="text-align: center; margin:0;">Invoice</h3>
    </div>

    <div class="center">
        {{--@php
            $supplierBusiness = \App\Models\Business::where('id', $invoices[0]->supplier_business_id)->first();
            $buyerBusiness = \App\Models\Business::where('id', $invoices[0]->buyer_business_id)->first();
        @endphp
        @php $logo_first = asset(Storage::url($supplierBusiness->business_photo_url)); @endphp
        <img src="{{ $logo_first }}" alt="{{ $logo_first }}" style="width: 5rem; height: 5rem; border-radius: 50%;"/>--}}
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

        @if(isset($invoices[0]->deliveryNote->id))
            <strong>Delivery Note #: </strong>DN-{{ $invoices[0]->deliveryNote->id }}<br>
        @endif
        <strong>Invoice #: </strong> Inv-{{ $invoices[0]->id }}<br>
        <strong>Date: </strong> {{ $invoices[0]->created_at }}<br>
        <strong>Purchase Order #: </strong> PO-{{ $invoices[0]->purchase_order->id }}<br>
        <strong>Quotation #: </strong>Q-{{ $invoices[0]->purchase_order->qoute_no }}<br>
        <strong>Requisition #: </strong>RFQ-{{ $invoices[0]->purchase_order->rfq_item_no }}<br>
        <strong>Payment Terms: </strong>
        @if($invoices[0]->purchase_order->payment_term == 'Cash') Cash
        @elseif($invoices[0]->purchase_order->payment_term == 'Credit') Credit
        @elseif($invoices[0]->purchase_order->payment_term == 'Credit30days') Credit (30 Days)
        @elseif($invoices[0]->purchase_order->payment_term == 'Credit60days') Credit (60 Days)
        @elseif($invoices[0]->purchase_order->payment_term == 'Credit90days') Credit (90 Days)
        @elseif($invoices[0]->purchase_order->payment_term == 'Credit120days') Credit (120 Days)
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

<table class="min-w-full divide-y divide-black " style="margin-top: 4%;width: 100%">
    <thead>
    <tr>
        <th style="text-align: center;background-color: #FCE5CD">
            #
        </th>
        <th style="text-align: center;background-color: #FCE5CD">
            Category Name
        </th>
        <th style="text-align: center;background-color: #FCE5CD">
            Description
        </th>
        <th style="text-align: center;background-color: #FCE5CD">
            UOM
        </th>
        <th style="text-align: center;background-color: #FCE5CD">
            Quantity
        </th>
        <th style="text-align: center;background-color: #FCE5CD">
            UNIT PRICE
        </th>
        <th style="text-align: center;background-color: #FCE5CD">
            TOTAL
        </th>
    </tr>
    </thead>
    <tbody class="bg-white divide-y divide-black border-1 border-black">
        @foreach($invoices as $invoice)
            <tr>
                <td style="text-align: center;">
                    {{$loop->iteration}}
                </td>
                <td style="text-align: center;">
                    @php
                        $record = \App\Models\Category::where('id',$invoice->purchase_order->item_code)->first();
                        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                    @endphp
                    {{ $record->name }} @if(isset($parent->name)), {{ $parent->name }} @endif
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
        @endforeach
    </tbody>
</table>


<br>
<br>

<div class="header">

    <div style="width: 60%;float: left;"></div>

    <div style="width: 40%;float: right">
        @php $subtotal = 0;
            foreach ($invoices as $invoice)
            {
                $subtotal += $invoice->purchase_order->quantity * $invoice->purchase_order->unit_price;
            }
        @endphp
        <strong>Sub-total: </strong> {{ number_format(($subtotal), 2) }} SAR<br>
        <strong>Shipment cost: </strong> {{ $invoices[0]->purchase_order->shipment_cost }} SAR<br>
        <strong>VAT {{ number_format($invoices[0]->vat) }}%: </strong>{{ number_format(($subtotal + $invoices[0]->purchase_order->shipment_cost) * ($invoices[0]->vat/100), 2) }} SAR<br>
        <hr>
        <strong>Total: </strong> {{ number_format($invoices[0]->total_cost, 2) }} SAR<br>
        <hr>
        {{--<br>
        <br>
        <br>
        <br>--}}
    </div>

</div>

<br><br><br><br><br><br><br><br>

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
    <br><br>
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

    <div class="center" style="width: 33.33%"></div>

    <div class="center" style="width: 33.33%"></div>

    <div class="center" style="width: 33.33%; float: right">
        <div style="margin-top: 2px;">Copied to Emdad records</div>
        @php $img = asset('logo-full.png'); @endphp
        <img src="{{$img}}" width="40" style="float: right">
    </div>

</div>

</body>
