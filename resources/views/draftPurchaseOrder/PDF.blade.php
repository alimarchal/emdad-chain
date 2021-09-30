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
        {{--            <img src="{{ $draftPurchaseOrder->buyer_business->business_photo_url }}" alt="{{ $draftPurchaseOrder->buyer_business->business_name }}" />--}}
        <h5 style="text-align: center; margin:0px;">{{ $draftPurchaseOrder->buyer_business->business_name }}</h5>
    </div>

    <div class="center">
        <h3 style="text-align: center; margin:0px;">Purchase Order</h3>
    </div>

    <div class="center">
        {{--        <img src="{{ $draftPurchaseOrder->supplier_business->business_photo_url }}" alt="{{ $draftPurchaseOrder->supplier_business->business_name }}" />--}}
        <h5 style="text-align: center; margin:0px;">{{ $draftPurchaseOrder->supplier_business->business_name }}</h5>
    </div>


    <br>
    <br>
    <br>
    <br>
    <div class="center">
        <strong>Generated By: </strong><br>
        <p>{{ $draftPurchaseOrder->buyer_business->business_name }}</p><br>
        <strong>ID: </strong> {{ $draftPurchaseOrder->buyer_business->user_id }}<br>
        <strong>City: </strong>{{ $draftPurchaseOrder->buyer_business->city }}<br>
    </div>

    <div class="center">
        <strong>Purchased From: </strong><br>
        <p>{{ $draftPurchaseOrder->supplier_business->business_name }}</p><br>
        <strong>ID: </strong>{{ $draftPurchaseOrder->supplier_business->user_id }}<br>
        <strong>City: </strong>{{ $draftPurchaseOrder->supplier_business->city }}<br>
    </div>

    <div class="center">
        <h3 class="text-2xl text-center"><strong>P.O.</strong></h3>
        <strong>P.O. #: </strong>P.O. -{{ $draftPurchaseOrder->id }}<br>
        <strong>Date: </strong>{{ $draftPurchaseOrder->created_at }}<br>
        <strong>Requisition #: </strong>RFQ-{{ $draftPurchaseOrder->rfq_no }}<br>
        <strong>Quotation #: </strong>Q-{{ $draftPurchaseOrder->qoute_no }}<br>
        <strong>Payment Terms: </strong>{{ $draftPurchaseOrder->payment_term }}<br>
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
<br>


<table class="min-w-full divide-y divide-black">
    <thead>

    <tr>
        <th>#</th>
        <th>BRAND</th>
        <th>UOM</th>
        <th>REMARKS</th>
        <th>UNIT PRICE</th>
        <th>QUANTITY</th>
        <th>AMOUNT</th>
    </tr>

    </thead>
    <tbody class="bg-white divide-y divide-black border-1 border-black">

    <tr>
        <td  style="text-align: center">1</td>
        <td  style="text-align: center">{{ $draftPurchaseOrder->brand }}</td>
        <td  style="text-align: center">{{ $draftPurchaseOrder->uom }}</td>
        <td  style="text-align: center">{{ $draftPurchaseOrder->remarks }}</td>
        <td  style="text-align: center">{{ $draftPurchaseOrder->unit_price }} SAR</td>
        <td  style="text-align: center">{{ $draftPurchaseOrder->quantity }}</td>
        <td  style="text-align: center">{{ number_format($draftPurchaseOrder->sub_total, 2) }} SAR</td>
    </tr>
    </tbody>
</table>


<br>
<div class="header">

    <div style="width: 66.66%;float: left;"></div>

    <div style="width: 33.33%;float: right">
        <strong>Sub-total: </strong> {{ number_format($draftPurchaseOrder->sub_total, 2) }} SAR<br>
        <strong>VAT %: </strong> {{ number_format($draftPurchaseOrder->sub_total * 0.15, 2) }}<br>
        <strong>Shipment cost: </strong> {{ number_format($draftPurchaseOrder->shipment_cost, 2) }} SAR<br>
        <hr>
        <strong>P.O Total: </strong> {{ number_format($draftPurchaseOrder->sub_total * 0.15 + $draftPurchaseOrder->sub_total + $draftPurchaseOrder->shipment_cost, 2) }} SAR<br>
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
        <strong>Remarks: </strong> {{ strip_tags($draftPurchaseOrder->remarks) }} <br>
        <strong>Warranty: </strong> {{ $draftPurchaseOrder->warranty }} <br>
        <strong>Terms & Conditions: </strong> None <br>
    </div>


    <br>
    <br>


    <div class="w-full overflow-hidden lg:w-1/2 xl:w-1/2">
        <strong>Delivery Information: </strong><br>
        <strong>City: </strong> {{ $draftPurchaseOrder->buyer_business->city }}<br>
        @php $warehouse = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrder->warehouse_id)->first(); @endphp
        <strong>Warehouse:</strong> {{ $warehouse->address}} <br>
        {{--            <strong>Delivery Status: </strong><br>--}}
        {{--            <strong>Delivery Time: </strong><br>--}}

    </div>
</div>
</div>
<br>
<br>
<br>

<div class="flex justify-center">
    {{--        <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-10 w-auto" /></div>--}}
</div>

<div class="flex justify-between px-2 py-2 mt-2 h-15">
    <div style="text-align: center; margin: auto;">
        <p style="text-align: center; ">Thank you for using Emdad platform as your business partner </p>
    <!--<img src="{{ url(Storage::url('logo-full.png')) }}" />-->
        @php $img = asset('logo-full.png'); @endphp

        <img src="@php echo $img @endphp" width="100" >

    </div>

</div>

</body>
