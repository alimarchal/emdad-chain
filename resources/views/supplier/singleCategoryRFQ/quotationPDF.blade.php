<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        table, td, th {
            border: 1px solid black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .center {
            width: 33.33%;
            float: left;
        }

        .center1 {
            width: 50%;
            float: left;
        }

        @php
$url = config('app.url');
$url = $url . '/Presento/assets/arabicfont/arabic_regular.ttf';
@endphp
@font-face {
            font-family: arabicFont;
            src: url({{$url}});
        }


        div {
            font-family: arabicFont;
        }

    </style>

    </style>
</head>

<body style="font-family: arabicFont;">


<div class="header">
    <div class="center"></div>

    <div style="margin: auto;">
        @php $logo_second = asset(Storage::url($quotes[0]->supplier_business->business_photo_url)); @endphp
        <img src="{{ $logo_second }}" alt="{{ $logo_second }}" style="width: 5rem;border-radius: 50%;margin-left: auto;margin-right: auto;display: block;"" />
        <h3 style="text-align: center; margin:0px;">Quotation</h3>
    </div>

    <div class="center"></div>

    <br><br>


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

    <div style="width: 40%;float: right;">
        @php $logo_first = asset(Storage::url($quotes[0]->buyer_business->business_photo_url)); @endphp
        <img src="{{ $logo_first }}" alt="{{ $logo_first }}" style="width: 150px;height: 80px;border-radius: 25px;"/><br>
        <strong>Buyer: </strong> @if($quotes[0]->orderItem->company_name_check == 1) {{ $quotes[0]->buyer_business->business_name }} @else N/A @endif <br>
        <strong>City: </strong>{{ $quotes[0]->buyer_business->city }}<br>
        <strong>VAT Number: </strong> {{ $quotes[0]->buyer_business->vat_reg_certificate_number }}<br>
        @php
            $warehouse = \App\Models\BusinessWarehouse::where('id', $quotes[0]->warehouse_id)->first()->only('mobile', 'address');
        @endphp
        <strong>Contact #: </strong> {{ $warehouse['mobile'] }}<br>
        <strong>Delivery Address: </strong> {{ $warehouse['address'] }}<br>
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
                    {{ $quote->quote_price_per_quantity }} SR
                </td>
                <td style="text-align: center;">
                    {{ $quote->quote_quantity }}
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

<div class="flex justify-between px-2 py-2 mt-2 h-15">
    <div style="text-align: center; margin: auto;">
        <p style="text-align: center; ">Thank you for using Emdad platform as your business partner </p>
        @php $img = asset('logo-full.png'); @endphp
        <img src="{{$img}}" width="100" >

    </div>

</div>

</body>
