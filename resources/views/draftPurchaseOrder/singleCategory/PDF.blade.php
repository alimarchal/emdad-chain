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
{{--        @php $logo_first = asset(Storage::url($draftPurchaseOrders[0]->buyer_business->business_photo_url)); @endphp--}}
{{--        <img src="{{ $logo_first }}" alt="{{ $logo_first }}" style="width: 5rem;"/>--}}
{{--        <h5 style="text-align: center; margin:0px;">{{ $draftPurchaseOrders[0]->buyer_business->business_name }}</h5>--}}
    </div>

    <div class="center">
        @php $logo_second = asset(Storage::url($draftPurchaseOrders[0]->buyer_business->business_photo_url)); @endphp
        <img src="{{ $logo_second }}" alt="{{ $logo_second }}" style="width: 5rem;height: 89px;border-radius: 50%;;margin-left: 75px;" />
        <h3 style="text-align: center; margin:0px;">Purchase Order</h3>
    </div>

    <div class="center">
{{--        @php $logo_second = asset(Storage::url($draftPurchaseOrders[0]->supplier_business->business_photo_url)); @endphp--}}
{{--        <img src="{{ $logo_second }}" alt="{{ $logo_second }}" style="width: 5rem;" />--}}
{{--        <h5 style="text-align: center; margin:0px;">{{ $draftPurchaseOrders[0]->supplier_business->business_name }}</h5>--}}
    </div>


    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="center1">
        <strong>Buyer: </strong>{{ $draftPurchaseOrders[0]->buyer_business->business_name }}<br>
        <strong>City: </strong>{{ $draftPurchaseOrders[0]->buyer_business->city }}<br>
        <strong>VAT Number: </strong> {{ $draftPurchaseOrders[0]->buyer_business->vat_reg_certificate_number }}<br>
        <strong>Contact #: </strong> {{ $draftPurchaseOrders[0]->otp_mobile_number }}<br>
        <strong>Delivery Address: </strong> {{ $draftPurchaseOrders[0]->delivery_address }}<br><br>

        <strong>P.O. #: </strong>PO-{{ $draftPurchaseOrders[0]->id }}<br>
        <strong>Date: </strong>{{ $draftPurchaseOrders[0]->created_at }}<br>
        <strong>Quotation #: </strong>Q-{{ $draftPurchaseOrders[0]->qoute_no }}<br>
        <strong>Requisition #: </strong>RFQ-{{ $draftPurchaseOrders[0]->eOrderItem->id }}<br>
        <strong>Payment Terms: </strong>{{ $draftPurchaseOrders[0]->payment_term }}<br>
    </div>

{{--    <div class="center">--}}
{{--        --}}
{{--    </div>--}}

    <div style="width: 40%;float: right;">
        @php $logo_first = asset(Storage::url($draftPurchaseOrders[0]->supplier_business->business_photo_url)); @endphp
        <img src="{{ $logo_first }}" alt="{{ $logo_first }}" style="width: 150px;height: 80px;border-radius: 25px;"/><br><br><br>
        <strong>Supplier: </strong>{{ $draftPurchaseOrders[0]->supplier_business->business_name }}<br>
        <strong>City: </strong>{{ $draftPurchaseOrders[0]->supplier_business->city }}<br>
        <strong>VAT Number: </strong>{{ $draftPurchaseOrders[0]->supplier_business->vat_reg_certificate_number }}<br>
        <strong>Email: </strong>{{ $draftPurchaseOrders[0]->supplier_business->business_email }}<br>
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

{{--<div style="width: 100%; text-align: left">
    <strong>Category Name: </strong>
    @php
        $record = \App\Models\Category::where('id',$draftPurchaseOrders[0]->item_code)->first();
        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
    @endphp
    <span style="color: #145ea8;"> {{ $record->name }} @if(isset($parent)), {{$parent->name}} @endif </span>
</div>--}}

<table style="margin-top: 4%;width: 100%">
    <thead>
    <tr>
        <th scope="col" style="text-align: center; background-color: #FCE5CD">
            #
        </th>
        <th scope="col" style="text-align: center; background-color: #FCE5CD">
            Category Name
        </th>
        <th scope="col" style="text-align: center; background-color: #FCE5CD">
            Brand
        </th>
        <th scope="col" style="text-align: center; background-color: #FCE5CD">
            Description
        </th>
        <th scope="col" style="text-align: center; background-color: #FCE5CD">
            UOM
        </th>
        <th scope="col" style="text-align: center; background-color: #FCE5CD">
            Remarks
        </th>
        <th scope="col" style="text-align: center; background-color: #FCE5CD">
            Unit Price
        </th>
        <th scope="col" style="text-align: center; background-color: #FCE5CD">
            Quantity
        </th>
        <th scope="col" style="text-align: center; background-color: #FCE5CD">
            Amount
        </th>
    </tr>
    </thead>
    @foreach($draftPurchaseOrders as $draftPurchaseOrder)
        <tbody class="bg-white divide-y divide-black border-1 border-black">
        <tr>
            <td style="text-align: center">
                {{$loop->iteration}}
            </td>
            <td style="text-align: center">
                @php
                    $record = \App\Models\Category::where('id',$draftPurchaseOrders[0]->item_code)->first();
                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                @endphp
                {{ $record->name }}@if(isset($parent)), {{$parent->name}} @endif
            </td>
            <td style="text-align: center">
                @if(isset($draftPurchaseOrder->brand)){{ strip_tags($draftPurchaseOrder->brand) }} @else N/A @endif
            </td>
            <td style="text-align: center">
                {{ $draftPurchaseOrder->eOrderItem->description }}
            </td>
            <td style="text-align: center">
                {{ $draftPurchaseOrder->uom }}
            </td>
            <td style="text-align: center">
                @if(isset($draftPurchaseOrder->remarks)){{ strip_tags($draftPurchaseOrder->remarks) }} @else N/A @endif
            </td>
            <td style="text-align: center">
                {{ $draftPurchaseOrder->unit_price }}
            </td>

            <td style="text-align: center">
                {{ $draftPurchaseOrder->quantity }}
            </td>
            <td style="text-align: center">
                {{ number_format($draftPurchaseOrder->sub_total, 2) }}
            </td>
        </tr>
        </tbody>
    @endforeach
</table>


<br>
<div class="header">

    <div style="width: 66.66%;float: left;"></div>

    <div style="width: 33.33%;float: right">
        @php
            $subtotal = 0;
                foreach($draftPurchaseOrders as $draftPurchaseOrder)
                {
                    $subtotal += $draftPurchaseOrder->sub_total;
                }
        @endphp
        <strong>Sub-total: </strong> {{ number_format($subtotal, 2) }} SAR<br>
        <strong>Shipment cost: </strong> {{ number_format($draftPurchaseOrders[0]->shipment_cost, 2) }} SAR<br>
        <strong>VAT {{ number_format($draftPurchaseOrders[0]->vat) }}%: </strong>{{ number_format(($subtotal + $draftPurchaseOrders[0]->shipment_cost) * ($draftPurchaseOrders[0]->vat/100), 2) }} SAR<br>
        {{--        <strong>VAT: </strong> {{ number_format($draftPurchaseOrders[0]->vat)}} %<br>--}}
        <hr>
        <strong>Total: </strong> {{ number_format($draftPurchaseOrders[0]->total_cost, 2) }} SAR<br>
        <hr>
        <br>
        <br>
        <br>
        <br>
    </div>

</div>
<br>
<br><br>
<br><br>
<br><br>

<div class="header">
    <div class="flex flex-wrap overflow-hidden  p-4 mt-4">
        <div class="w-full overflow-hidden lg:w-1/2 xl:w-1/2">
            <strong>Mobile Number (for one time password): </strong> {{ strip_tags($draftPurchaseOrders[0]->otp_mobile_number) }} <br>
            <strong>Delivery Address: </strong> {{ strip_tags($draftPurchaseOrders[0]->delivery_address) }} <br>
        </div>
    </div>
</div>
<br>
<br>
<br>

<div style="width: 100%; text-align: left">
    @if ($draftPurchaseOrders[0]->status == 'approved')
        <img src="{{url('images/stamps/Artboard-9@8x.png')}}" alt="P.O. APPROVED" style="width: 85px;height: 40px;"/>
    @endif
</div>

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
