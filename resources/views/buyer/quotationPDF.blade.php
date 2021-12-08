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
    <div class="center">
        {{--@php $logo_first = asset(Storage::url($quote->buyer_business->business_photo_url)); @endphp
        <img src="{{ $logo_first }}" alt="{{ $logo_first }}" style="width: 5rem; height: 5rem; border-radius: 50%;"/>

        <h5 style="text-align: center; margin:0px;">{{ $quote->buyer_business->business_name }}</h5>--}}

    </div>

    <div class="center">
        @php $logo_second = asset(Storage::url($quote->supplier_business->business_photo_url)); @endphp
        <img src="{{ $logo_second }}" alt="{{ $logo_second }}" style="width: 5rem;border-radius: 50%;;margin-left: 75px;" />
        <h3 style="text-align: center; margin:0px;">Quotation</h3>
    </div>

    <div class="center">
        {{--        @php $logo_second = asset(Storage::url($quote->supplier_business->business_photo_url)); @endphp--}}
        {{--        <img src="{{ $logo_second }}" alt="{{ $logo_second }}" style="width: 5rem; height: 5rem; border-radius: 50%;" />--}}
        {{--        <h5 style="text-align: center; margin:0px;">{{ $quote->supplier_business->business_name }}</h5>--}}

    </div>

    <br><br>
    <br><br>
    <br><br>

    <div style="width: 100%; text-align: center">
        <h3 style="text-align: center; margin: 0px;">
            @if ($quote->qoute_status == 'Modified')
                Status: <span style="background-color: gray">You have asked for a modification for this quotation.</span>
            @elseif($quote->qoute_status == 'Qouted')
                Status: <span style="background-color: #e3a008">Waiting for response.</span>
            @elseif($quote->qoute_status == 'Rejected')
                Status: <span style="background-color: red">You have rejected this quotation.</span>
            @endif
        </h3>
    </div>



    <br>
    <br>
    <div class="center1">
        <strong>Supplier: </strong>{{ $quote->supplier_business->business_name }}<br>
        <strong>City: </strong>{{ $quote->supplier_business->city }}<br>
        <strong>VAT Number: </strong>{{ $quote->supplier_business->vat_reg_certificate_number }}<br>
        <strong>Email: </strong>{{ $quote->supplier_business->business_email }}<br><br>

        <strong>Quotation #: </strong> Q-{{ $quote->id }}<br>
        <strong>Requisition #: </strong> RFQ-{{ $quote->orderItem->id }}<br>
        <strong>Shipping Time: </strong> {{ $quote->shipping_time_in_days }}<br>
        <strong>Payment Term: </strong>
        @if($quote->orderItem->payment_mode == 'Cash') Cash
        @elseif($quote->orderItem->payment_mode == 'Credit') Credit
        @elseif($quote->orderItem->payment_mode == 'Credit30days') Credit (30 Days)
        @elseif($quote->orderItem->payment_mode == 'Credit60days') Credit (60 Days)
        @elseif($quote->orderItem->payment_mode == 'Credit90days') Credit (90 Days)
        @elseif($quote->orderItem->payment_mode == 'Credit120days') Credit (120 Days)
        @endif
        <br>
    </div>

    {{--    <div class="center">--}}
    {{--        --}}
    {{--    </div>--}}

    <div style="width: 40%;float: right;">
        @php $logo_first = asset(Storage::url($quote->buyer_business->business_photo_url)); @endphp
        <img src="{{ $logo_first }}" alt="{{ $logo_first }}" style="width: 150px;height: 80px;border-radius: 25px;"/><br>
        <strong>Buyer: </strong>{{ $quote->buyer_business->business_name }}<br>
        <strong>City: </strong>{{ $quote->buyer_business->city }}<br>
        <strong>VAT Number: </strong> {{ $quote->buyer_business->vat_reg_certificate_number }}<br>
        @php
            $warehouse = \App\Models\BusinessWarehouse::where('id', $quote->warehouse_id)->first()->only('mobile', 'address');
        @endphp
        <strong>Contact #: </strong> {{ $warehouse['mobile'] }}<br>
        <strong>Delivery Address: </strong> {{ $warehouse['address'] }}<br>
    </div>

    <div class="center"></div>

    <br><br><br><br><br><br><br><br><br><br><br>

    {{--<div style="width: 100%; text-align: left">
        <strong>Item Description: </strong><br>
        <p>{{ strip_tags($quote->orderItem->description) }}</p>
    </div>--}}

    <table class="divide-y divide-black" style="width: 100%">
        <thead>

        <tr>
            <th style="text-align: center;font-weight: normal; background-color: #FCE5CD">#</th>
            <th style="text-align: center;font-weight: normal; background-color: #FCE5CD">CATEGORY NAME</th>
            <th style="text-align: center;font-weight: normal; background-color: #FCE5CD">DESCRIPTION</th>
            <th style="text-align: center;font-weight: normal; background-color: #FCE5CD">NOTE</th>
            <th style="text-align: center;font-weight: normal; background-color: #FCE5CD">UNIT PRICE</th>
            <th style="text-align: center;font-weight: normal; background-color: #FCE5CD">QUANTITY</th>
            <th style="text-align: center;font-weight: normal; background-color: #FCE5CD">AMOUNT</th>
        </tr>

        </thead>
        <tbody class="bg-white divide-y divide-black border-1 border-black">

        <tr>
            <td  style="text-align: center">1</td>
            <td  style="text-align: center">
                @php
                    $record = \App\Models\Category::where('id',$quote->orderItem->item_code)->first();
                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                @endphp
                {{ $record->name }}@if(isset($parent)), {{$parent->name}} @endif
            </td>
            <td  style="text-align: center"> {{strip_tags($quote->orderItem->description)}} </td>
            <td  style="text-align: center"> @if(isset($quote->note_for_customer)) {{ $quote->note_for_customer }} @else N/A @endif </td>
            <td  style="text-align: center">{{ $quote->quote_price_per_quantity }} SR</td>
            <td  style="text-align: center">{{ $quote->quote_quantity }}</td>
            <td  style="text-align: center">{{ number_format($quote->quote_price_per_quantity * $quote->quote_quantity,2) }} SR</td>
        </tr>
        </tbody>
    </table>


    <br>

    <div class="header">

        <div style="width: 66.66%;float: left;"></div>

        <div style="width: 33.33%;float: right">
            <strong>Sub-total: </strong> {{ number_format($quote->quote_quantity * $quote->quote_price_per_quantity, 2) }} SR<br>
            @php $subtotal = $quote->quote_quantity * $quote->quote_price_per_quantity; $subtotal += $quote->shipment_cost; @endphp
            <strong>Shipment cost: </strong> {{ number_format($quote->shipment_cost, 2) }} SR<br>
            <strong>VAT {{ number_format($quote->VAT) }}%: </strong>{{ number_format($subtotal * ($quote->VAT/100), 2) }} SR<br>
            <hr>
            <strong>Total: </strong> {{$quote->total_cost }} SR<br>
            <hr>
            <br>
            <br>
            <br>
            <br>
        </div>

    </div>

    <br><br>
    <br>
    <br><br>
    <br>
    <br>

    {{-- Retrieving eOrderItemsID in qoute_id while Storing Supplier message and Retrieving QuoteID in qoute_id while storing Buyer message --}}
    @php
        $messages = \App\Models\QouteMessage::where('qoute_id', $quote->e_order_items_id)->where('user_id', '!=', auth()->id())->get();
    @endphp
    @if(count($messages) > 0 && $messages->isNotEmpty())
        <hr>
        <div style="border-style: solid;">
            @foreach ($messages as $msg)
                @php
                    $user = \App\Models\User::where('id', $msg->user_id)->first();
                    $business = \App\Models\Business::where('id', $user->business_id)->first();
                @endphp

                <span style="color: gray">
                    <span style="color: #6c66f2; text-align: left;">
                        {{__('portal.Message from')}} {{$business->business_name}}
                    </span>
                    : {{strip_tags(str_replace('&nbsp;', ' ',  $msg->message))}}
                </span>
                <br> <br>
            @endforeach
        </div>
        <br>
        <hr>
    @endif

    @if($quote->messages->isNotEmpty())
        <div style="border-style: solid;">
            @foreach ($quote->messages as $msg)
                <span style="color: gray"> <span style="color: #6c66f2;">Message you send</span>  : {{ strip_tags(str_replace('&nbsp;', ' ',  $msg->message)) }} </span> <br> <br>
            @endforeach
        </div>
        <hr>
    @endif

</div>

<br>
<br>

<div class="header">
    <div class="flex flex-wrap overflow-hidden  p-4 mt-4">
        <div class="w-full overflow-hidden lg:w-1/2 xl:w-1/2">
            <strong>Warehouse delivery address: </strong> {{ $warehouse['address'] }}<br>
            <strong>Mobile #: </strong> {{ $warehouse['mobile'] }}
        </div>
    </div>
</div>

<br>
<br>

<div class="flex justify-between px-2 py-2 mt-2 h-15">
    <div style="text-align: center; margin: auto;">
        <p style="text-align: center; ">Thank you for using Emdad platform as your business partner </p>
    <!--<img src="{{ url(Storage::url('logo-full.png')) }}" />-->
        @php $img = asset('logo-full.png'); @endphp
        <img src="{{$img}}" width="100" >

    </div>

</div>

</body>
