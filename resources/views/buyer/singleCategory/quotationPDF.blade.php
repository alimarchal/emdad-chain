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

    </style>
</head>

<body>


<div class="header">
    <div class="center">
{{--        @php $logo_first = asset(Storage::url($quotes[0]->buyer_business->business_photo_url)); @endphp--}}
{{--        <img src="{{ $logo_first }}" alt="{{ $logo_first }}" style="width: 5rem; height: 5rem; border-radius: 50%;"/>--}}
{{--        <h5 style="text-align: center; margin:0px;">{{ $quotes[0]->buyer_business->business_name }}</h5>--}}
    </div>

    <div class="center">
        @php $logo_second = asset(Storage::url($quotes[0]->supplier_business->business_photo_url)); @endphp
        <img src="{{ $logo_second }}" alt="{{ $logo_second }}" style="width: 5rem;border-radius: 50%;;margin-left: 75px;" />
        <h3 style="text-align: center; margin:0px;">Quotation</h3>
    </div>

    <div class="center">
{{--        @php $logo_second = asset(Storage::url($quotes[0]->supplier_business->business_photo_url)); @endphp--}}
{{--        <img src="{{ $logo_second }}" alt="{{ $logo_second }}" style="width: 5rem; height: 5rem; border-radius: 50%;" />--}}
{{--        <h5 style="text-align: center; margin:0px;">{{ $quotes[0]->supplier_business->business_name }}</h5>--}}
    </div>

    <br><br><br><br><br><br>

    <div style="width: 100%; text-align: center">
        <h3 style="text-align: center; margin: 0px;">
            @if ($quotes[0]->qoute_status == 'Modified')
                Status: <span style="background-color: gray">You have asked for a modification for this quotation.</span>
            @elseif($quotes[0]->qoute_status == 'Qouted')
                Status: <span style="background-color: #e3a008">Waiting for response.</span>
            @elseif($quotes[0]->qoute_status == 'Rejected')
                Status: <span style="background-color: red">You have rejected this quotation.</span>
            @endif
        </h3>
    </div>



    <br>
    <br>
    <div class="center1">
        <strong>Supplier: </strong>{{ $quotes[0]->supplier_business->business_name }}<br>
        <strong>City: </strong>{{ $quotes[0]->supplier_business->city }}<br>
        <strong>VAT Number: </strong>{{ $quotes[0]->supplier_business->vat_reg_certificate_number }}<br>
        <strong>Email: </strong>{{ $quotes[0]->supplier_business->business_email }}<br><br>

        <strong>Quotation #: </strong> Q-{{ $quotes[0]->id }}<br>
        <strong>Requisition #: </strong> RFQ-{{ $quotes[0]->orderItem->id }}<br>
        <strong>Shipping Time: </strong> {{ $quotes[0]->shipping_time_in_days }}<br>
        <strong>Payment Term: </strong>
        @if($quotes[0]->orderItem->payment_mode == 'Cash') Cash
        @elseif($quotes[0]->orderItem->payment_mode == 'Credit') Credit
        @elseif($quotes[0]->orderItem->payment_mode == 'Credit30days') Credit (30 Days)
        @elseif($quotes[0]->orderItem->payment_mode == 'Credit60days') Credit (60 Days)
        @elseif($quotes[0]->orderItem->payment_mode == 'Credit90days') Credit (90 Days)
        @elseif($quotes[0]->orderItem->payment_mode == 'Credit120days') Credit (120 Days)
        @endif
        <br>
    </div>

    {{--<div class="center">

    </div>--}}

    <div style="width: 40%;float: right;">
        @php $logo_first = asset(Storage::url($quotes[0]->buyer_business->business_photo_url)); @endphp
        <img src="{{ $logo_first }}" alt="{{ $logo_first }}" style="width: 150px;height: 80px;border-radius: 25px;"/><br>
        <strong>Buyer: </strong>{{ $quotes[0]->buyer_business->business_name }}<br>
        <strong>City: </strong>{{ $quotes[0]->buyer_business->city }}<br>
        <strong>VAT Number: </strong> {{ $quotes[0]->buyer_business->vat_reg_certificate_number }}<br>
        @php
            $warehouse = \App\Models\BusinessWarehouse::where('id', $quotes[0]->warehouse_id)->first()->only('mobile', 'warehouse_name');
        @endphp
        <strong>Contact #: </strong> {{ $warehouse['mobile'] }}<br>
        <strong>Warehouse for delivery: </strong> {{ $warehouse['warehouse_name'] }}<br>
    </div>

    <div class="center"></div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>


    <table class="divide-y divide-black " style="margin-top: 4%;width: 100%;">
        <thead>
        <tr>
            <th style="text-align: center;font-weight: normal; background-color: #FCE5CD">
                #
            </th>
            <th style="text-align: center;font-weight: normal; background-color: #FCE5CD">
               CATEGORY NAME
            </th>
            <th style="text-align: center;font-weight: normal; background-color: #FCE5CD">
               DESCRIPTION
            </th>
            <th style="text-align: center;font-weight: normal; background-color: #FCE5CD">
               NOTE
            </th>
            <th style="text-align: center;font-weight: normal; background-color: #FCE5CD">
               UOM
            </th>
            <th style="text-align: center;font-weight: normal; background-color: #FCE5CD">
                UNIT PRICE
            </th>
            <th style="text-align: center;font-weight: normal; background-color: #FCE5CD">
                QUANTITY
            </th>
            <th style="text-align: center;font-weight: normal; background-color: #FCE5CD">
                AMOUNT
            </th>
        </tr>
        </thead>

        <tbody class="bg-white divide-y divide-black border-1 border-black">
        @foreach($quotes as $quote)
        <tr>
            <td style="text-align: center;">
                {{$loop->iteration}}
            </td>
            <td style="text-align: center;">
                @php
                    $record = \App\Models\Category::where('id',$quote->orderItem->item_code)->first();
                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                @endphp
                {{ $record->name }}@if(isset($parent)), {{$parent->name}} @endif
            </td>
            <td style="text-align: center;">
               {{ $quote->orderItem->description }}
            </td>
            <td style="text-align: center;">
                @if(isset($quote->note_for_customer)) {{ $quote->note_for_customer }} @else N/A @endif
            </td>
            <td style="text-align: center;">
               {{ $quote->orderItem->unit_of_measurement }}
            </td>
            <td style="text-align: center;">
               {{ number_format($quote->quote_price_per_quantity, 2) }} SR
            </td>
            <td style="text-align: center;">
               {{ number_format($quote->quote_quantity) }}
            </td>
            <td style="text-align: center;">
                {{ number_format($quote->quote_price_per_quantity * $quote->quote_quantity,2) }} SR
            </td>

        </tr>
        @endforeach
        </tbody>
    </table>


    <br>

    <div class="header">

        <div style="width: 66.66%;float: left;"></div>

        <div style="width: 33.33%;float: right">
            @php
                $subtotal = 0;
                    foreach($quotes as $quote)
                    {
                        $subtotal += $quote->quote_quantity * $quote->quote_price_per_quantity;
                    }
            @endphp
            <strong>Sub-total: </strong> {{ number_format($subtotal, 2) }} SR<br>
            <strong>Shipment cost: </strong> {{ number_format($quotes[0]->shipment_cost, 2) }} SR<br>
            <strong>VAT: {{ number_format($quotes[0]->VAT) }}%: </strong>{{ number_format(($subtotal + $quotes[0]->shipment_cost) * ($quotes[0]->VAT/100), 2) }} SR<br>
            <hr>
            <strong>Total: </strong> {{ number_format($quotes[0]->total_cost) }} SR<br>
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

<div class="header">
    <div class="flex flex-wrap overflow-hidden  p-4 mt-4">
        <div class="w-full overflow-hidden lg:w-1/2 xl:w-1/2">
            <strong>Warehouse for delivery: </strong> {{ $warehouse['warehouse_name'] }}<br>
            <strong>Mobile #: </strong> {{ $warehouse['mobile'] }}
        </div>
    </div>
</div>

<div class="flex justify-between px-2 py-2 mt-2 h-15">
    <div style="text-align: center; margin: auto;">
        <p style="text-align: center; ">Thank you for using Emdad platform as your business partner </p>
        @php $img = asset('logo-full.png'); @endphp
        <img src="{{$img}}" width="100" >

    </div>

</div>

</body>
