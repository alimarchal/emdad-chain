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
            <img src="{{ $draftPurchaseOrder->buyer_business->business_photo_url }}" alt="{{ $draftPurchaseOrder->buyer_business->business_name }}" />
            <h5 style="text-align: center; margin:0px;">{{ $draftPurchaseOrder->buyer_business->business_name }}</h1>
        </div>

        <div class="center">
            <h3 style="text-align: center; margin:0px;">Draft Purchase Order</h1>
        </div>

        <div class="center">
            <img src="{{ $draftPurchaseOrder->supplier_business->business_photo_url }}" alt="{{ $draftPurchaseOrder->supplier_business->business_name }}" />
            <h5 style="text-align: center; margin:0px;">{{ $draftPurchaseOrder->supplier_business->business_name }}</h1>
        </div>


        <br>
        <br>
        <br>
        <br>
        <div class="center">
            <strong>Purchase From: </strong><br>
            <p>{{ $draftPurchaseOrder->buyer_business->business_name }}</p><br>
            <strong>ID: </strong> {{ $draftPurchaseOrder->buyer_business->user_id }}<br>
            <strong>City: </strong>{{ $draftPurchaseOrder->buyer_business->city }}<br>
        </div>

        <div class="center">
            <strong>Deliver From: </strong><br>
            <p>{{ $draftPurchaseOrder->supplier_business->business_name }}</p><br>
            <strong>ID: </strong>{{ $draftPurchaseOrder->supplier_business->user_id }}<br>
            <strong>City: </strong>{{ $draftPurchaseOrder->supplier_business->city }}<br>
        </div>

        <div class="center">
            <h3 class="text-2xl text-center"><strong>Draft P.O</strong></h3>
            <strong>D.P.O No#: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->id }}<br>
            <strong>Date: &nbsp;</strong>{{ $draftPurchaseOrder->created_at }}<br>
            <strong>RFQ#: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->rfq_no }}<br>
            <strong>Qoute#: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->qoute_no }}<br>
            <strong>Payment Terms#: &nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->payment_term }}<br>
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

    <table class="min-w-full divide-y divide-black ">
        <thead>
            <tr>
                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                    #
                </th>
                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                    Item Code
                </th>
                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                    Description
                </th>
                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                    Quantitiy
                </th>
                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                    UOM
                </th>
                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                    Packing
                </th>

                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                    Brand
                </th>

                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                    Unit Price
                </th>

                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                    Amount
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-black border-1 border-black">
            <tr>
                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                    1
                </td>
                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                    {{ $draftPurchaseOrder->item_code }}
                </td>
                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                    {{ $draftPurchaseOrder->item_name }}
                </td>
                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                    {{ $draftPurchaseOrder->quantity }}
                </td>
                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                    {{ $draftPurchaseOrder->uom }}
                </td>
                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                    {{ $draftPurchaseOrder->unit_price }}
                </td>
                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                    {{ $draftPurchaseOrder->brand }}
                </td>
                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                    {{ $draftPurchaseOrder->unit_price }}
                </td>
                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                    {{ number_format($draftPurchaseOrder->sub_total, 2) }}
                </td>
            </tr>
            <tr>
                <td colspan="7" rowspan="4">
                </td>
                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                    Sub Total
                </td>
                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                    {{ number_format($draftPurchaseOrder->sub_total, 2) }}
                </td>
            </tr>
            <tr>
                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                    VAT 15%
                </td>
                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                    {{ number_format($draftPurchaseOrder->sub_total * 0.15, 2) }}
                </td>
            </tr>
            <tr>
                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                    Shipment
                </td>
                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                    {{ number_format(0, 2) }}
                </td>
            </tr>
            <tr>
                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                    P.O Total
                </td>
                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                    {{ number_format($draftPurchaseOrder->sub_total * 0.15 + $draftPurchaseOrder->sub_total, 2) }}
                </td>
            </tr>
        </tbody>
    </table>


    <br>
    <br>


    <div class="flex flex-wrap overflow-hidden  p-4 mt-4">
        <div class="w-full overflow-hidden lg:w-1/2 xl:w-1/2">
            <strong>Remarks: </strong> {{ strip_tags($draftPurchaseOrder->remarks) }} <br>
            <strong>Warranty: </strong> {{ $draftPurchaseOrder->warranty }} <br>
            <strong>Terms & Conditions: </strong> None <br>
        </div>


        <br>
        <br>


        <div class="w-full overflow-hidden lg:w-1/2 xl:w-1/2">
            <strong>Delivery Information</strong><br>
            <strong>City: </strong><br>
            <strong>Warehouse:</strong><br>
            <strong>Delivery Status: </strong><br>
            <strong>Delivery Time: </strong><br>

        </div>
    </div>
    <br>
    <br>
    <br>

    <div class="flex justify-center">
        <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-10 w-auto" /></div>
    </div>

    <br>
    <br>
    <div class="flex justify-between px-2 py-2 mt-2 h-15">
        <div class="mt-3">Thanks for your Business</div><br><br>
        <img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-10 w-auto" />
    </div>

</body>