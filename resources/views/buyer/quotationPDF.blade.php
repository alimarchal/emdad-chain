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
        @php $logo_first = asset(Storage::url($quote->buyer_business->business_photo_url)); @endphp
        <img src="{{ $logo_first }}" alt="{{ $logo_first }}" style="width: 5rem; height: 5rem; border-radius: 50%;"/>

        <h5 style="text-align: center; margin:0px;">{{ $quote->buyer_business->business_name }}</h5>

    </div>

    <div class="center">
        <h3 style="text-align: center; margin:0px;">Quotation</h3>
    </div>

    <div class="center">
        @php $logo_second = asset(Storage::url($quote->supplier_business->business_photo_url)); @endphp
        <img src="{{ $logo_second }}" alt="{{ $logo_second }}" style="width: 5rem; height: 5rem; border-radius: 50%;" />
        <h5 style="text-align: center; margin:0px;">{{ $quote->supplier_business->business_name }}</h5>

    </div>

    <br><br>
    <br><br>
    <br><br>

    <div style="width: 100%; text-align: center">
        <h3 style="text-align: center; margin: 0px;">Status:
            @if ($quote->qoute_status == 'Modified')
                <span style="background-color: gray">You have asked for a modification for this quotation.</span>
            @elseif($quote->qoute_status == 'Qouted')
                <span style="background-color: #e3a008">Waiting for response.</span>
            @elseif($quote->qoute_status == 'Rejected')
                <span style="background-color: red">You have rejected this quotation.</span>
            @endif
        </h3>
    </div>



    <br>
    <br>
    <div class="center">
        <strong>Requested By: </strong><br>
        <p>{{ $quote->buyer_business->business_name }}</p><br>
        <strong>City: </strong>{{ $quote->buyer_business->city }}<br>
        <strong>VAT Number: </strong> {{ $quote->buyer_business->vat_reg_certificate_number }}<br>
    </div>

    <div class="center">
        <strong>Supplier: </strong><br>
        <p>{{ $quote->supplier_business->business_name }}</p><br>
        <strong>City: </strong>{{ $quote->supplier_business->city }}<br>
        <strong>VAT Number: </strong>{{ $quote->supplier_business->vat_reg_certificate_number }}<br>
    </div>

    <div class="center">
        <strong>Quotation #: </strong> Q-{{ $quote->id }}<br>
        <strong>Category Name: </strong>@php
            $record = \App\Models\Category::where('id',$quote->orderItem->item_code)->first();
            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
        @endphp
        <span style="color: #145ea8;"> {{ $record->name }} @if(isset($parent)), {{$parent->name}} @endif </span> <br>
        <strong>Payment Term: </strong>{{ $quote->orderItem->payment_mode }}<br>
    </div>

    <div class="center"></div>

    <br><br><br><br><br><br><br><br><br>

    <div style="width: 100%; text-align: left">
        <strong>Quote Description: </strong><br>
        <p>{{ strip_tags($quote->orderItem->description) }}</p>
    </div>

    <table class="min-w-full divide-y divide-black">
        <thead>

        <tr>
            <th>#</th>
            <th>NOTE</th>
            <th>UNIT PRICE</th>
            <th>QUANTITY</th>
            <th>AMOUNT</th>
        </tr>

        </thead>
        <tbody class="bg-white divide-y divide-black border-1 border-black">

        <tr>
            <td  style="text-align: center">1</td>
            <td  style="text-align: center"> @if(isset($quote->note_for_customer)) {{ $quote->note_for_customer }} @else N/A @endif </td>
            <td  style="text-align: center">{{ $quote->quote_price_per_quantity }} SAR</td>
            <td  style="text-align: center">{{ $quote->quote_quantity }}</td>
            <td  style="text-align: center">{{ number_format($quote->quote_price_per_quantity * $quote->quote_quantity,2) }} SAR</td>
        </tr>
        </tbody>
    </table>


    <br>

    <div class="header">

        <div style="width: 66.66%;float: left;"></div>

        <div style="width: 33.33%;float: right">
            <strong>Sub-total: </strong> {{ number_format($quote->quote_quantity * $quote->quote_price_per_quantity, 2) }} SAR<br>
            <strong>VAT %: </strong> {{ $quote->VAT }}<br>
            <strong>Shipment cost: </strong> {{ number_format($quote->shipment_cost, 2) }} SAR<br>
            <hr>
            <strong>Total: </strong> {{$quote->total_cost }} SAR<br>
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
            @php
                $orderItemID =  \App\Models\EOrderItems::firstWhere('id', $quote->e_order_items_id);
                $warehouseAddress = \App\Models\BusinessWarehouse::firstWhere('id', $orderItemID->warehouse_id);
            @endphp
            <strong>Warehouse delivery address: </strong> {{ $warehouseAddress->address }}<br>
            <strong>Mobile #: </strong> {{ $warehouseAddress->mobile }}
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
