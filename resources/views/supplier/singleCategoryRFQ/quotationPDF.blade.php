<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>

        .header {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .center {
            width: 33.33%;
            float: left;
        }
        .font-style{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            @if ($quotes[0]->qoute_status == 'Modified')
                Status: <span style="color: black; background-color: gray;">Modified.</span>
            @elseif($quotes[0]->qoute_status == 'Qouted')
                Status: <span style="color: black; background-color: #e3a008">Quoted.</span>
            @elseif($quotes[0]->qoute_status == 'Rejected')
                Status: <span style="color: black; background-color: red">Rejected.</span>
            @else
                Status: <span style="color: black; background-color: green">Accepted.</span>
            @endif
        </h3>
    </div>

    <br>

    <div class="center" style="width: 50%;float: left;">
        <h3><u>Requisition Information</u></h3><br>
        <strong>Buyer Name: </strong> @if($quotes[0]->company_name_check == 1) {{$quotes[0]->business->business_name}} @else N/A @endif<br>
        <strong>Requisition #: </strong> RFQ-{{$quotes[0]->e_order_items_id}}<br>
        <strong>Category Name: </strong>
        @php
            $record = \App\Models\Category::where('id',$quotes[0]->orderItem->item_code)->first();
            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
        @endphp
        {{ $record->name }} @if(isset($parent)), {{$parent->name}} @endif<br>
        <strong>Payment Mode: </strong>
        @if($quotes[0]->orderItem->payment_mode == 'Cash') Cash
        @elseif($quotes[0]->orderItem->payment_mode == 'Credit') Credit
        @elseif($quotes[0]->orderItem->payment_mode == 'Credit30days') Credit (30 Days)
        @elseif($quotes[0]->orderItem->payment_mode == 'Credit60days') Credit (60 Days)
        @elseif($quotes[0]->orderItem->payment_mode == 'Credit90days') Credit (90 Days)
        @elseif($quotes[0]->orderItem->payment_mode == 'Credit120days') Credit (120 Days)
        @endif <br>
    </div>

    <div class="center" style="width: 50%;float: right;">
        <h3><u>Shipping Information</u></h3><br>
        <strong>Delivery Period: </strong>
        @if ($quotes[0]->orderItem->delivery_period =='Immediately') Immediately @endif
        @if ($quotes[0]->orderItem->delivery_period =='Within 30 Days') 30 Days @endif
        @if ($quotes[0]->orderItem->delivery_period =='Within 60 Days') 60 Days @endif
        @if ($quotes[0]->orderItem->delivery_period =='Within 90 Days') 90 Days @endif
        @if ($quotes[0]->orderItem->delivery_period =='Standing Order - 2 per year' ) Standing Order - 2 times / year @endif
        @if ($quotes[0]->orderItem->delivery_period =='Standing Order - 3 per year' ) Standing Order - 3 times / year @endif
        @if ($quotes[0]->orderItem->delivery_period =='Standing Order - 4 per year' ) Standing Order - 4 times / year @endif
        @if ($quotes[0]->orderItem->delivery_period =='Standing Order - 6 per year' ) Standing Order - 6 times / year @endif
        @if ($quotes[0]->orderItem->delivery_period =='Standing Order - 12 per year' ) Standing Order - 12 times / year @endif
        @if ($quotes[0]->orderItem->delivery_period =='Standing Order Open' ) Standing Order - Open @endif
        <br>
        @php $warehouse = \App\Models\BusinessWarehouse::where('id', $quotes[0]->orderItem->warehouse_id)->first(); @endphp
        <strong>Delivery Address:</strong> {{ $warehouse->address }} <br>
        <strong>Required Sample: </strong>
        @if($quotes[0]->orderItem->required_sample == 'Yes') Yes @endif
        @if($quotes[0]->orderItem->required_sample == 'No') No @endif <br>
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
        $messages = \App\Models\QouteMessage::where('qoute_id', $quotes[0]->orderItem->id )->get();
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

    {{-- Retrieving Buyer Messages using quote ID --}}
    @php
        $messages = \App\Models\QouteMessage::where('qoute_id', $quotes[0]->id )->get();
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
                        Message from @if($quotes[0]->company_name_check == 1) {{$business->business_name}} @else Buyer @endif
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
@foreach($quotes as $quote)
    <div>
        <h4 style="text-align: center;">{{ $loop->iteration }}</h4>
    </div>
    <hr>
        <span class="font-style"> <strong>Brand: </strong> @if(isset($quote->orderItem->brand)) {{ $quote->orderItem->brand }} @else N/A @endif <br> </span>
        <span class="font-style"> <strong>Remarks: </strong> {{ $quote->orderItem->remarks }}<br> </span>
        <span class="font-style"> <strong>UMO: </strong> {{ $quote->orderItem->unit_of_measurement }}<br> </span>
        <span class="font-style"> <strong>Size: </strong> {{ $quote->orderItem->size }}<br> </span>
        <span class="font-style"> <strong>Description: </strong> {{ $quote->orderItem->description }}<br> </span>
        <span class="font-style"> <strong>Quantity: </strong> {{ $quote->orderItem->quantity }}<br> </span>
        <span class="font-style"> <strong>Price Per Unit: </strong> {{ $quote->quote_price_per_quantity }}<br> </span>
        <span class="font-style"> <strong>Note: </strong> @if(isset($quote->note_for_customer)) {{ $quote->note_for_customer }} @else N/A @endif <br> </span>
    <hr>
@endforeach

    <span class="font-style"> <strong>Shipment Time (In Days): </strong> {{ $quotes[0]->shipping_time_in_days }}<br> </span>
    <span class="font-style"> <strong>Shipment Cost: </strong> {{ $quotes[0]->shipment_cost }} SAR<br> </span>
    @php
        $subtotal = 0;
            foreach($quotes as $quote)
            {
                $subtotal += $quote->quote_quantity * $quote->quote_price_per_quantity;
            }
    @endphp
    <span class="font-style"> <strong>VAT: {{ number_format($quotes[0]->VAT) }}%: </strong>{{ number_format(($subtotal + $quotes[0]->shipment_cost) * ($quotes[0]->VAT/100), 2) }} SAR </span> <br>
    <span class="font-style"> <strong>Total Cost: </strong> {{ $quotes[0]->total_cost }} SAR<br> </span>

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
