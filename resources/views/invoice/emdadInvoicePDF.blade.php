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
        <h3 style="text-align: center; margin:0;">Emdad Invoice for invoice # {{ $emdadInvoice->invoice->id }} </h3>
    </div>

    <div class="center"></div>

</div>

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
            DELIVERY ITEM
        </th>
        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
            PAYMENT TYPE
        </th>
        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
            AMOUNT W/O VAT
        </th>
        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
            EMDAD INVOICE AMOUNT (1.5 %)
        </th>
    </tr>
    </thead>

    @php $dpo = \App\Models\DraftPurchaseOrder::where('id', $emdadInvoice->invoice->purchase_order->id)->first(); @endphp
    <tbody class="bg-white divide-y divide-black border-1 border-black">
    <tr>
        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="text-align: center;">
            #
        </td>
        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="text-align: center;">
            @php
                $record = \App\Models\Category::where('id',$dpo->item_code)->first();
                $parent= \App\Models\Category::where('id',$record->parent_id)->first();
            @endphp
            {{ $record->name }} @if(isset($parent->name)) , {{ $parent->name }} @endif
        </td>
        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="text-align: center;">
            @if($dpo->payment_term == 'Cash') Cash
            @elseif($dpo->payment_term == 'Credit') {{__('portal.Credit')}}
            @elseif($dpo->payment_term == 'Credit30days') Credit (30 Days)
            @elseif($dpo->payment_term == 'Credit60days') Credit (60 Days)
            @elseif($dpo->payment_term == 'Credit90days') Credit (90 Days)
            @elseif($dpo->payment_term == 'Credit120days') Credit (120 Days)
            @endif
        </td>
        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="text-align: center;">
            @php
                $quote = \App\Models\Qoute::where('id', $emdadInvoice->invoice->quote->id)->first();
                $totalCost = ($quote->quote_quantity * $quote->quote_price_per_quantity) + $quote->shipment_cost;
                $totalEmdadCharges = $totalCost * (1.5 / 100);
            @endphp
            {{ number_format($totalCost,2) }} SAR
        </td>
        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="text-align: center;">
            {{ number_format($totalEmdadCharges,2) }} SAR
        </td>
    </tr>
    </tbody>
</table>

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
        <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" style="height: 10px; width: auto; margin-left: auto; margin-right: auto;"/></div>
    </div>

</div>

</body>
