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

    <div>
        <h3 style="text-align: center">Quotation</h3>
    </div>

    <div>
        <h3>
            Status:
            @if ($quotes[0]->qoute_status == 'Modified')
                <span class="overflow-hidden xl:-mx-1 rounded shadow-md bg-gray-400" style="color: black; background-color: gray;">You have asked for a modification for this quotation.</span>
            @elseif($quotes[0]->qoute_status == 'Qouted')
                <span style="color: black; background-color: #e3a008">Waiting for response.</span>
            @elseif($quotes[0]->qoute_status == 'Rejected')
                <span style="color: black; background-color: darkred">You have rejected this quotation.</span>
            @endif
        </h3>
    </div>

    <br>

    <div class="center" style="width: 33.33%;float: left;">
        <strong>Category Name: </strong>
        @php
            $record = \App\Models\Category::where('id',$quotes[0]->orderItem->item_code)->first();
            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
        @endphp
        {{ $record->name }} @if(isset($parent)), {{$parent->name}} @endif<br>
        <strong>VAT (%): </strong> {{ $quotes[0]->VAT }}<br>
    </div>

    <div class="center" style="width: 33.33%;float: left;">
        <strong>Shipment Cost: </strong> {{ $quotes[0]->shipment_cost }} SAR<br>
    </div>

    <div class="center" style="width: 33.33%;float: right;">
        <strong>Shipping Time In Days: </strong> {{ $quotes[0]->shipping_time_in_days }}<br>
        <strong>Total Cost: </strong> {{ $quotes[0]->total_cost }} SAR<br>
    </div>

    <br><br>
    <br><br>

    @foreach($quotes as $quote)
        <div class="center" style="width: 33.33%;float: left;">
            <strong>#: </strong> {{ $loop->iteration }}<br>
            <strong>Quote Description: </strong> {{ $quote->orderItem->description }}<br>
        </div>

        <div class="center" style="width: 33.33%;float: left;">
            <strong>Quote Quantity: </strong> {{ $quote->quote_quantity }}<br>
            <strong>Note:</strong> {{ $quote->note_for_customer }}<br>
        </div>

        <div class="center" style="width: 33.33%;float: right;">
            <strong>Quote Price Per Quantity: </strong> {{ $quote->quote_price_per_quantity }}<br>
            <br>
        </div>
        <br>
        <br>
        <br><br>
        <br>
        <br><br>
        <br>
        <br>
    @endforeach

    @php
        $quote = \App\Models\QouteMessage::where('qoute_id', $quotes[0]->e_order_items_id)->where('user_id', '!=', auth()->id())->get();
    @endphp
    @if(isset($quote) && $quote->isNotEmpty())
        <hr>
        <div style="border-style: solid;">
            @foreach ($quote as $msg)
                {{--@php $business = \App\Models\Business::where('user_id', $msg->user_id)->first(); @endphp--}}
                @php
                    $user = \App\Models\User::where('id', $msg->user_id)->first();
                    $business = \App\Models\Business::where('id', $user->business_id)->first();
                @endphp

                <span style="color: gray">
                    <span style="color: #6c66f2; text-align: left;">
                        Message from {{$business->business_name}}
                    </span>
                    : {{strip_tags(str_replace('&nbsp;', ' ',  $msg->message))}}
                </span>
                <br> <br>
            @endforeach
        </div>
        <br>
        <hr>
    @endif

    @if($quotes[0]->messages->isNotEmpty())
        <div style="border-style: solid;">
            @foreach ($quotes[0]->messages as $msg)
                <span style="color: gray"> <span style="color: #6c66f2;">Message you send</span>  : {{ strip_tags(str_replace('&nbsp;', ' ',  $msg->message)) }} </span> <br> <br>
            @endforeach
        </div>
        <hr>
    @endif

</div>

<br>
<br>

<div class="center" style="width: 33.33%;">
    @php
        $orderItemID =  \App\Models\EOrderItems::where('id', $quotes[0]->e_order_items_id)->first();
        $warehouseAddress = \App\Models\BusinessWarehouse::where('id', $orderItemID->warehouse_id)->first();
    @endphp
    <strong>Warehouse delivery address: </strong> {{ $warehouseAddress->address }}<br>
</div>
<div class="center" style="width: 33.33%;">
    <strong>Mobile #: </strong> {{ $warehouseAddress->mobile }}<br>
    <br>
</div>
<div class="center" style="width: 33.33%;">
    <strong>Payment Term: </strong> {{ $quotes[0]->orderItem->payment_mode }}<br>
    <br>
</div>

<br>
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
        <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" style="height: 10px; width: auto; margin-left: auto; margin-right: auto;"/></div>
    </div>

</div>

</body>
