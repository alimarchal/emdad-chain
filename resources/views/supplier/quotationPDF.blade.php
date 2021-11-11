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
            @if ($quote->qoute_status == 'Modified')
                Status: <span style="color: black; background-color: gray;">Modified.</span>
            @elseif($quote->qoute_status == 'Qouted')
                Status: <span style="color: black; background-color: #e3a008">Quoted.</span>
            @elseif($quote->qoute_status == 'Rejected')
                Status: <span style="color: black; background-color: red">Rejected.</span>
            @else
                Status: <span style="color: black; background-color: green">Accepted.</span>
            @endif
        </h3>
    </div>

    <br>

    <div class="center" style="width: 33.33%;float: left;">
        <h3><u>Requisition Information</u></h3><br>
        <strong>Buyer Name: </strong> @if($eOrderItem->company_name_check == 1) {{$eOrderItem->business->business_name}} @else N/A @endif<br>
        <strong>Requisition #: </strong> RFQ-{{$eOrderItem->id}}<br>
        <strong>Remarks: </strong> {{$eOrderItem->remarks}} SAR<br>
        <strong>Payment Mode: </strong>
        @if($eOrderItem->payment_mode == 'Cash') Cash
        @elseif($eOrderItem->payment_mode == 'Credit') Credit
        @elseif($eOrderItem->payment_mode == 'Credit30days') Credit (30 Days)
        @elseif($eOrderItem->payment_mode == 'Credit60days') Credit (60 Days)
        @elseif($eOrderItem->payment_mode == 'Credit90days') Credit (90 Days)
        @elseif($eOrderItem->payment_mode == 'Credit120days') Credit (120 Days)
        @endif <br>
    </div>

    <div class="center" style="width: 33.33%;float: left;">
        <h3><u>Item Information</u></h3><br>
        <strong>Category Name: </strong>
        @php
            $record = \App\Models\Category::where('id',$eOrderItem->item_code)->first();
            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
        @endphp
        {{ $record->name }} @if(isset($parent)), {{$parent->name}} @endif<br>
        <strong>Brand: </strong> @if(isset($eOrderItem->brand)) {{ $eOrderItem->brand }} @else N/A @endif <br>
        <strong>Quantity: </strong> {{ $eOrderItem->quantity }}<br>
        <strong>Unit of Measurement: </strong> {{ $eOrderItem->unit_of_measurement }}<br>
        <strong>Size: </strong> {{ $eOrderItem->size }}<br>
        <strong>Description: </strong> {{ $eOrderItem->description }}<br>
    </div>

    <div class="center" style="width: 33.33%;float: right;">
        <h3><u>Shipping Information</u></h3><br>
        <strong>Delivery Period: </strong>
        @if ($eOrderItem->delivery_period =='Immediately') Immediately @endif
        @if ($eOrderItem->delivery_period =='Within 30 Days') 30 Days @endif
        @if ($eOrderItem->delivery_period =='Within 60 Days') 60 Days @endif
        @if ($eOrderItem->delivery_period =='Within 90 Days') 90 Days @endif
        @if ($eOrderItem->delivery_period =='Standing Order - 2 per year' ) Standing Order - 2 times / year @endif
        @if ($eOrderItem->delivery_period =='Standing Order - 3 per year' ) Standing Order - 3 times / year @endif
        @if ($eOrderItem->delivery_period =='Standing Order - 4 per year' ) Standing Order - 4 times / year @endif
        @if ($eOrderItem->delivery_period =='Standing Order - 6 per year' ) Standing Order - 6 times / year @endif
        @if ($eOrderItem->delivery_period =='Standing Order - 12 per year' ) Standing Order - 12 times / year @endif
        @if ($eOrderItem->delivery_period =='Standing Order Open' ) Standing Order - Open @endif
        <br>
        @php $warehouse = \App\Models\BusinessWarehouse::where('id', $eOrderItem->warehouse_id)->first(); @endphp
        <strong>Delivery Address:</strong> {{ $warehouse->address }} <br>
        <strong>Required Sample: </strong>
        @if($eOrderItem->required_sample == 'Yes') Yes @endif
        @if($eOrderItem->required_sample == 'No') No @endif <br>
    </div>

    <br><br>

    <br>
    <br>
    <br><br>
    <br>
    <br><br>
    <br>
    <br>

    {{-- Retrieving Supplier Messages using e_order_items_id --}}
    @php
        $messages = \App\Models\QouteMessage::where('qoute_id', $eOrderItem->id )->get();
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
                        Message you send
                    </span>
                    : {{strip_tags(str_replace('&nbsp;', ' ',  $msg->message))}}
                </span>
                <br> <br>
            @endforeach
        </div>
        <br>
        <hr>
    @endif
    <br>
    <br>
    <br><br>
    <br>
    <br>
    {{-- Retrieving Buyer Messages using quote ID --}}
    @php
        $messages = \App\Models\QouteMessage::where('qoute_id', $quote->id )->get();
    @endphp
    @if(isset($messages) && $messages->isNotEmpty())
        <hr>
        <div style="border-style: solid;">
            @foreach ($messages as $msg)
                @php
                    $user = \App\Models\User::where('id', $msg->user_id)->first();
                    $business = \App\Models\Business::where('id', $user->business_id)->first();
                @endphp

                <span style="color: gray">
                    <span style="color: #6c66f2; text-align: left;">
                        Message from @if($quote->company_name_check == 1) {{$business->business_name}} @else Buyer @endif
                    </span>
                    : {{strip_tags(str_replace('&nbsp;', ' ',  $msg->message))}}
                </span>
                <br> <br>
            @endforeach
        </div>
        <hr>
    @endif

</div>

<div>
    <h3 style="text-align: center">You Quoted</h3>
</div>
<div class="center" style="width: 33.33%;">
    <strong>Quantity: </strong> {{ $quote->quote_quantity }}<br>
</div>
<div class="center" style="width: 33.33%;">
    <strong>Price Per Unit: </strong> {{ $quote->quote_price_per_quantity }} SAR<br>
    <br>
</div>
<div class="center" style="width: 33.33%;">
    <strong>Shipping Time(In Days): </strong> {{ $quote->shipping_time_in_days }}<br>
    <br>
</div>

<br><br><br><br>
<div class="center" style="width: 33.33%;">
    <strong>Note: </strong> @if(isset($quote->note_for_customer)) {{ $quote->note_for_customer }} @else N/A @endif <br>
</div>
<div class="center" style="width: 33.33%;">
    @php $subtotal = $quote->quote_quantity * $quote->quote_price_per_quantity; $subtotal += $quote->shipment_cost; @endphp
    <strong>VAT {{ number_format($quote->VAT) }}%: </strong>{{ number_format($subtotal * ($quote->VAT/100), 2) }} SAR<br>
    <br>
</div>
<div class="center" style="width: 33.33%;">
    <strong>Shipment Cost: </strong> {{ $quote->shipment_cost }} SAR<br>
    <br>
</div>


<br>
<br>
<br>
<br>
<br>
<div class="center" style="width: 33.33%;">
    <strong>Total Cost: </strong> {{ $quote->total_cost }} SAR<br>
    <br>
</div>

<br>
<br>
<br>
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
        <div>
            @php $img = asset('logo-full.png'); @endphp
            <img src="{{$img}}" style="height: 10px; width: auto; margin-left: auto; margin-right: auto;" >
        </div>
    </div>

</div>

</body>
