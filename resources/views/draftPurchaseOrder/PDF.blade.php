<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="http://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table, td, th {
            border: 1px solid black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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



    </style>
</head>

<body>


<div class="header">
    <div class="center">
{{--        @php $logo_first = asset(Storage::url($draftPurchaseOrder->buyer_business->business_photo_url)); @endphp--}}
{{--        <img src="{{ $logo_first }}" alt="{{ $logo_first }}" style="width: 5rem;"/>--}}
{{--        <h5 style="text-align: center; margin:0px;">{{ $draftPurchaseOrder->buyer_business->business_name }}</h5>--}}
    </div>

    <div class="center">
        @php $logo_second = asset(Storage::url($draftPurchaseOrder->buyer_business->business_photo_url)); @endphp
        <img src="{{ $logo_second }}" alt="{{ $logo_second }}" style="width: 5rem;height: 89px;border-radius: 50%;;margin-left: 75px;" />
        <h3 style="text-align: center; margin:0px;">Purchase Order</h3>
    </div>

    <div class="center">
{{--        @php $logo_second = asset(Storage::url($draftPurchaseOrder->supplier_business->business_photo_url)); @endphp--}}
{{--        <img src="{{ $logo_second }}" alt="{{ $logo_second }}" style="width: 5rem;" />--}}
{{--        <h5 style="text-align: center; margin:0px;">{{ $draftPurchaseOrder->supplier_business->business_name }}</h5>--}}
    </div>


    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="center1">
        <strong>Buyer: </strong>{{ $draftPurchaseOrder->buyer_business->business_name }}<br>
        <strong>City: </strong>{{ $draftPurchaseOrder->buyer_business->city }}<br>
        <strong>VAT Number: </strong> {{ $draftPurchaseOrder->buyer_business->vat_reg_certificate_number }}<br>
        <strong>Contact #: </strong> {{ $draftPurchaseOrder->otp_mobile_number }}<br>
        <strong>Delivery Address: </strong> {{ $draftPurchaseOrder->delivery_address }}<br><br>

        <strong>P.O. #: </strong>PO-{{ $draftPurchaseOrder->id }}<br>
        <strong>Date: </strong>{{ $draftPurchaseOrder->created_at }}<br>
        <strong>Quotation #: </strong>Q-{{ $draftPurchaseOrder->qoute_no }}<br>
        <strong>Requisition #: </strong>RFQ-{{ $draftPurchaseOrder->eOrderItem->id }}<br>
        <strong>Payment Terms: </strong>
        @if($draftPurchaseOrder->payment_term == 'Cash') Cash
        @elseif($draftPurchaseOrder->payment_term == 'Credit') Credit
        @elseif($draftPurchaseOrder->payment_term == 'Credit30days') Credit (30 Days)
        @elseif($draftPurchaseOrder->payment_term == 'Credit60days') Credit (60 Days)
        @elseif($draftPurchaseOrder->payment_term == 'Credit90days') Credit (90 Days)
        @elseif($draftPurchaseOrder->payment_term == 'Credit120days') Credit (120 Days)
        @endif
        <br>
    </div>

{{--    <div class="center">--}}

{{--    </div>--}}

    <div style="width: 40%;float: right;">
        @php $logo_first = asset(Storage::url($draftPurchaseOrder->supplier_business->business_photo_url)); @endphp
        <img src="{{ $logo_first }}" alt="{{ $logo_first }}" style="width: 150px;height: 80px;border-radius: 25px;"/><br><br><br>
        <strong>Supplier: </strong>{{ $draftPurchaseOrder->supplier_business->business_name }}<br>
        <strong>City: </strong>{{ $draftPurchaseOrder->supplier_business->city }}<br>
        <strong>VAT Number: </strong>{{ $draftPurchaseOrder->supplier_business->vat_reg_certificate_number }}<br>
        <strong>Email: </strong>{{ $draftPurchaseOrder->supplier_business->business_email }}<br>
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

{{--<div style="width: 100%; text-align: left">
    <strong>Category Name: </strong>
    @php
            $record = \App\Models\Category::where('id',$draftPurchaseOrder->item_code)->first();
            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
    @endphp
    <span style="color: #145ea8;"> {{ $record->name }} @if(isset($parent)), {{$parent->name}} @endif </span>
</div>

<div style="width: 100%; text-align: left">
    <strong>Item Description: </strong><span>{{ strip_tags($draftPurchaseOrder->eOrderItem->description) }}</span>
</div>--}}



<table class="min-w-full divide-y divide-black">
    <thead>

    <tr>
        <th style="text-align: center;background-color: #FCE5CD">#</th>
        <th style="text-align: center;font-weight: normal;background-color: #FCE5CD">CATEGORY NAME</th>
        <th style="text-align: center;font-weight: normal;background-color: #FCE5CD">DESCRIPTION</th>
        <th style="text-align: center;font-weight: normal;background-color: #FCE5CD">BRAND</th>
        <th style="text-align: center;font-weight: normal;background-color: #FCE5CD">UOM</th>
        <th style="text-align: center;font-weight: normal;background-color: #FCE5CD">REMARKS</th>
        <th style="text-align: center;font-weight: normal;background-color: #FCE5CD">UNIT PRICE</th>
        <th style="text-align: center;font-weight: normal;background-color: #FCE5CD">QUANTITY</th>
        <th style="text-align: center;font-weight: normal;background-color: #FCE5CD">AMOUNT</th>
    </tr>

    </thead>
    <tbody class="bg-white divide-y divide-black border-1 border-black">

    <tr>
        <td  style="text-align: center">1</td>
        @php
                $record = \App\Models\Category::where('id',$draftPurchaseOrder->item_code)->first();
                $parent= \App\Models\Category::where('id',$record->parent_id)->first();
        @endphp
        <td  style="text-align: center"> {{ $record->name }}@if(isset($parent)), {{$parent->name}} @endif </td>
        <td  style="text-align: center">{{ strip_tags($draftPurchaseOrder->eOrderItem->description) }}</td>
        <td  style="text-align: center">@if(isset($draftPurchaseOrder->brand)){{ strip_tags($draftPurchaseOrder->brand) }} @else N/A @endif</td>
        <td  style="text-align: center">{{ $draftPurchaseOrder->uom }}</td>
        <td  style="text-align: center">@if(isset($draftPurchaseOrder->remarks)){{ $draftPurchaseOrder->remarks }} @else N/A @endif</td>
        <td  style="text-align: center">{{ $draftPurchaseOrder->unit_price }} SAR</td>
        <td  style="text-align: center">{{ $draftPurchaseOrder->quantity }}</td>
        <td  style="text-align: center">{{ number_format($draftPurchaseOrder->sub_total) }} SAR</td>
    </tr>
    </tbody>
</table>


<br>
<div class="header">

    <div style="width: 66.66%;float: left;"></div>

    <div style="width: 33.33%;float: right">
        <strong>Sub-total: </strong> {{ number_format($draftPurchaseOrder->sub_total, 2) }} SAR<br>
        @php $subtotal = $draftPurchaseOrder->sub_total; $subtotal += $draftPurchaseOrder->shipment_cost; @endphp
        <strong>Shipment cost: </strong> {{ number_format($draftPurchaseOrder->shipment_cost, 2) }} SAR<br>
        <strong>VAT {{ number_format($draftPurchaseOrder->vat) }}%: </strong>{{ number_format($subtotal * ($draftPurchaseOrder->vat/100), 2) }} SAR<br>
        <hr>
        <strong>Total: </strong> {{ number_format($draftPurchaseOrder->total_cost, 2) }} SAR<br>
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
            <strong>Mobile Number (for one time password): </strong> {{ strip_tags($draftPurchaseOrder->otp_mobile_number) }} <br>
            <strong>Delivery Address: </strong> {{ strip_tags($draftPurchaseOrder->delivery_address) }} <br>
        </div>
    </div>
</div>
<br>
<br>
<br>

<div style="width: 100%; text-align: left">
    @if ($draftPurchaseOrder->status == 'approved')
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
