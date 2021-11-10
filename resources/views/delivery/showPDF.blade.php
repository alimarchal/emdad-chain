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

    </div>

    <div class="center">
        @php $logo_second = asset(Storage::url($deliveries[0]->supplier->business->business_photo_url)); @endphp
        <img src="{{ $logo_second }}" alt="{{ $logo_second }}" style="width: 5rem;border-radius: 50%;;margin-left: 75px;" />
        <h3 style="text-align: center; margin:0px;">Delivery Note</h3>
    </div>

    <div class="center">

    </div>


    <br>
    <br>
    <br>
    <br>
    <div class="center">
        <strong>Delivery Note: </strong>{{ $deliveries[0]->delivery_note_id }}<br>
        @if(isset($deliveries[0]->invoice))
        <strong>Invoice #: </strong>{{ $deliveries[0]->invoice->id }}<br>
        @endif
        <strong>Purchase Order #: </strong>PO-{{ $deliveries[0]->draft_purchase_order_id }}<br>
        <strong>Date: </strong>{{ $deliveries[0]->created_at }}<br>
        <strong>Requisition #: </strong>RFQ-{{ $deliveries[0]->rfq_no }}<br>
        <strong>Quotation #: </strong>Q-{{ $deliveries[0]->qoute_no }}<br>
        <strong>Payment Terms : </strong>
        @if($deliveries[0]->payment_term == 'Cash') {{__('portal.Cash')}}
        @elseif($deliveries[0]->payment_term == 'Credit') {{__('portal.Credit')}}
        @elseif($deliveries[0]->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
        @elseif($deliveries[0]->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
        @elseif($deliveries[0]->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
        @elseif($deliveries[0]->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
        @endif
        <br>
    </div>

    <div class="center">
        <strong></strong><br>
        <p>{{ $deliveries[0]->supplier->business->business_name }}</p><br>
        <strong>City: </strong>{{ $deliveries[0]->supplier->business->city }}<br>
        <strong>VAT Number: </strong> {{ $deliveries[0]->supplier->business->vat_reg_certificate_number }}<br>
    </div>

    <div class="center">
        <strong>Buyer: </strong><br>
        <div class="flex">
            <div class="flex-row">
                <p>{{ $deliveries[0]->buyer->business->business_name }}</p><br>
            </div>
            <div class="flex-row">
                @php $logo_first = asset(Storage::url($deliveries[0]->buyer->business->business_photo_url)); @endphp
                <img src="{{ $logo_first }}" alt="{{ $logo_first }}" style="width: 40px;height: 40px;border-radius: 25px;"/>
            </div>
        </div>
        <strong>City: </strong>{{ $deliveries[0]->buyer->business->city }}<br>
        <strong>VAT Number: </strong>{{ $deliveries[0]->buyer->business->vat_reg_certificate_number }}<br>
        <strong>Contact # </strong>{{ $deliveries[0]->otp_mobile_number }}<br>
        <strong>Delivery Address: </strong>{{ $deliveries[0]->delivery_address }}<br>
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

<table class="min-w-full divide-y divide-black">
    <thead>

    <tr>
        <th style="text-align: center;background-color: #FCE5CD">#</th>
        <th style="text-align: center;background-color: #FCE5CD">CATEGORY NAME</th>
        <th style="text-align: center;background-color: #FCE5CD">DESCRIPTION</th>
        <th style="text-align: center;background-color: #FCE5CD">UOM</th>
        <th style="text-align: center;background-color: #FCE5CD">QUANTITY</th>
    </tr>

    </thead>
    <tbody class="bg-white divide-y divide-black border-1 border-black">
    @foreach($deliveries as $delivery)
        <tr>
            <td  style="text-align: center">{{$loop->iteration}}</td>
            @php
                $record = \App\Models\Category::where('id',$deliveries[0]->item_code)->first();
                $parent = \App\Models\Category::where('id',$record->parent_id)->first();
            @endphp
            <td  style="text-align: center">{{ $record->name }} @if(isset($parent)) , {{ $parent->name }} @endif</td>
            <td  style="text-align: center">{{ $delivery->eOrderItems->description }}</td>
            <td  style="text-align: center">{{ $delivery->eOrderItems->unit_of_measurement }}</td>
            <td  style="text-align: center">{{ $delivery->quantity }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<br>
<br>
<br>

<div class="flex justify-between px-2 py-2 mt-2 h-15">
    <div style="text-align: center; margin: auto;">
        <p style="text-align: center; ">Thank you for using Emdad platform as your business partner </p>
    <!--<img src="{{ url(Storage::url('logo-full.png')) }}" />-->
        @php $img = asset('logo-full.png'); @endphp

        <img src="@php echo $img @endphp" width="100" >

    </div>

</div>

</body>
