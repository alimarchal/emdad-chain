@section('headerScripts')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        #datepicker {
            width: 100%;
            padding: 10px;
            cursor: default;
            /*text-transform: uppercase;*/
            font-size: 13px;
            background: #FFFFFF;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            border: solid 1px #d2d6dc;
            box-shadow: none;
        }
    </style>
@endsection
@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <style type="text/css">
            /* color for request for quotation heading*/
            .color-7f7f7f {
                color: #7f7f7f;
            }

            .color-1f3864 {
                color: #1f3864;
            }



            select:hover{
                cursor: pointer;
            }

            input ,
            .note
            {
                height: 35px;
            }
            .note {
                border: 1px solid #d2d6dc !important;
                resize: none;
                margin-top: 8px;
                padding: 2px 10px;
            }

            .note:focus {
                outline: none;
                box-shadow: 0 0 0 3px rgba(164, 202, 254, 0.45);
                border-color: #a4cafe;
            }


            @media screen and (max-width:360px) {
                .date {
                    margin-left: auto;
                    margin-right: auto;
                }
            }

        </style>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>

        @if (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @foreach ($errors->get('expiry_date') as $error)
            <div class="block mt-2 text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ $error }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endforeach
        @foreach ($errors->get('shipping_time_in_days') as $error)
            <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ $error }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endforeach

        <div class="-my-2 overflow-x-auto sm:overflow-hidden lg:-mx-8 scroll-bar-for-large-screen">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="flex flex-col bg-white rounded">
                    <div class="p-4"
                         style="background-color: #F3F3F3; border-top:20px solid #E69138; border-bottom: 20px solid #FCE5CD;">
                        <div class="d-block text-center">
                            <span class="text-2xl font-bold color-7f7f7f">{{__('portal.Requisition')}}</span>
                        </div>
                        <hr>
                        <div style=" min-height: 145px;" class="container-fluid px-4 flex bg-grey flex-wrap">
                            <div class="flex-1 py-5">
                                <div class="my-5 pl-5">
                                     <img src="{{ Storage::url(Auth::user()->business->business_photo_url) }}" alt="logo"
                                    style="height: 80px;width: 200px;" />
        {{--                            <img src="{{ url('imp_img.jpg') }}" alt="logo" style="height: 80px;width: 200px;" />--}}
                                </div>
                                @php
                                    $user_business_details=auth()->user()->business;
                                @endphp
                                <div class="my-5 pl-5 ">
                                    <h1 class="font-extrabold color-1f3864 text-xl ">{{$user_business_details->business_name}}</h1>
                                    {{-- <span>Location :
                                    <span class="font-bold">{{$user_business_details->city}}</span></span> <br>
                                    <span>Emdad Id : <span class="font-bold">{{Auth::user()->business_id}}</span></span> --}}
                                </div>
                            </div>

                            <div class="flex-1 ">
                                <div class="ml-auto date" style="width:150px; ">
                                    <br>
                                    <span class="color-1f3864 font-bold">{{__('portal.Date')}}:
                                        {{\Carbon\Carbon::today()->format('Y-m-d')}}</span><br>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=" mb-3">
                        <div>
                            <div style="background: #DEEAF6; min-height: 235px; padding-top: 1px;" class="flex ">

                                <div class="left-info_holder flex-1">
                                    <div class="my-5 pl-5 ">
                                        <span class="font-bold color-1f3864 text-lg">{{__('portal.Requisition Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5 ">
                                        <strong>{{__('portal.Buyer Name')}}:</strong> @if($eOrderItems->company_name_check == 1) {{$eOrderItems->business->business_name}} @else {{__('portal.N/A')}} @endif
                                        <br>
                                        <strong>{{__('portal.Requisition')}} #:</strong> {{__('portal.RFQ')}}-{{$eOrderItems->id}}
                                        <br>
                                        <strong>{{__('portal.Remarks')}}: </strong>{{$eOrderItems->remarks}}
                                        <br>
                                        <strong>{{__('portal.Payment Mode')}}: </strong>
                                            @if($eOrderItems->payment_mode == 'Cash') {{__('portal.Cash')}}
                                            @elseif($eOrderItems->payment_mode == 'Credit') {{__('portal.Credit')}}
                                            @elseif($eOrderItems->payment_mode == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                            @elseif($eOrderItems->payment_mode == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                            @elseif($eOrderItems->payment_mode == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                            @elseif($eOrderItems->payment_mode == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                            @endif
                                    </div>
                                </div>
                                <div class="center-info-holder flex-1">
                                    <div class="my-5 pl-5 ">
                                        <span class="font-bold text-lg color-1f3864">{{__('portal.Item Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5 ">
                                        <strong>{{__('portal.Category Name')}}: </strong> {{ $eOrderItems->item_name }} / {{ \App\Models\Category::where('id',(\App\Models\Category::where('id',$eOrderItems->item_code)->first()->parent_id))->first()->name }}
                                        <br>

                                        <strong>{{__('portal.Brand')}}: </strong> {{ $eOrderItems->brand }}
                                        <br>
                                        <strong>{{__('portal.Quantity')}}: </strong> {{ $eOrderItems->quantity }}
                                        <br>
                                        <strong>{{__('portal.Unit of Measurement')}}: </strong> {{ $eOrderItems->unit_of_measurement }}
                                        <br>
                                        <strong>{{__('portal.Size')}}: </strong> {{ $eOrderItems->size }}
                                        <br>

                                        <strong>{{__('portal.Description')}}:</strong> {{ strip_tags($eOrderItems->description) }}
                                    </div>
                                </div>
                                <div class="Right-info_holder flex-1">
                                    <div class="my-5 pl-5 ">
                                        <span class="font-bold text-lg color-1f3864">{{__('portal.Shipping Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5 ">

                                        <strong>{{__('portal.Delivery Period')}}: </strong>
                                            @if ($eOrderItems->delivery_period =='Immediately') {{__('portal.Immediately')}} @endif
                                            @if ($eOrderItems->delivery_period =='Within 30 Days') {{__('portal.30 Days')}} @endif
                                            @if ($eOrderItems->delivery_period =='Within 60 Days') {{__('portal.60 Days')}} @endif
                                            @if ($eOrderItems->delivery_period =='Within 90 Days') {{__('portal.90 Days')}} @endif
                                            @if ($eOrderItems->delivery_period =='Standing Order - 2 per year' ) {{__('portal.Standing Order - 2 times / year')}} @endif
                                            @if ($eOrderItems->delivery_period =='Standing Order - 3 per year' ) {{__('portal.Standing Order - 3 times / year')}} @endif
                                            @if ($eOrderItems->delivery_period =='Standing Order - 4 per year' ) {{__('portal.Standing Order - 4 times / year')}} @endif
                                            @if ($eOrderItems->delivery_period =='Standing Order - 6 per year' ) {{__('portal.Standing Order - 6 times / year')}} @endif
                                            @if ($eOrderItems->delivery_period =='Standing Order - 12 per year' ) {{__('portal.Standing Order - 12 times / year')}} @endif
                                            @if ($eOrderItems->delivery_period =='Standing Order Open' ) {{__('portal.Standing Order - Open')}} @endif
                                        <br>
                                        <strong>{{__('portal.Delivery Address')}}: </strong> {{ $eOrderItems->warehouse->address }}
                                        <br>

                                        <strong>{{__('portal.Required Sample')}}: </strong>
                                            @if($eOrderItems->required_sample == 'Yes') {{__('portal.Yes')}} @endif
                                            @if($eOrderItems->required_sample == 'No') {{__('portal.No')}} @endif
                                        <br>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p4 mb-5 overflow-x-auto">
                        <table class="table-fixed  min-w-full text-center ">
                            <thead style="background-color:#8EAADB" class="text-white">
                            <tr>

                                <th style="width:10%;">{{__('portal.Quantity')}} @include('misc.required')</th>
                                <th style="width:10%;">{{__('portal.Price Per Unit')}} @include('misc.required') </th>
                                <th style="width:11%;">{{__('portal.Shipping Time')}} @include('misc.required') </th>
                                <th style="width:20%;">{{__('portal.Note')}}</th>
                                <th style="width:10%;">{{__('portal.VAT')}} % @include('misc.required') </th>
                                <th style="width:10%;">{{__('portal.Shipment Cost')}} @include('misc.required')</th>

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
        {{--                    this will show the information if user has some previous quotes--}}
                            @if($collection)

                                <tr>
                                    <td>
                                        {{$collection->quote_quantity}}
                                    </td>
                                    <td>
                                        {{$collection->quote_price_per_quantity}} {{__('portal.SAR')}}
                                    </td>
                                    <td>
                                        {{$collection->shipping_time_in_days}}
                                    </td>
                                    <td>
                                        {{$collection->note_for_customer}}
                                    </td>
                                    <td>
                                        {{$collection->VAT}}%
                                    </td>
                                    <td>
                                        {{$collection->shipment_cost}} {{__('portal.SAR')}}
                                    </td>
                                </tr>
                            @endif
                            @if ($collection && $collection->qoute_status == 'Qouted')

                                <h2 class="text-center text-2xl">{{__('portal.You have already quoted.')}}</h2>

                            @elseif($collection && $collection->qoute_status == 'ModificationNeeded')

                                {{-- Retrieving Supplier Messages using e_order_items_id --}}
                                @php
                                    $quote = \App\Models\QouteMessage::where('qoute_id', $eOrderItems->id )->get();
                                @endphp
                                @if(isset($quote) && $quote->isNotEmpty())

                                    <div class="border-2 p-2 m-2">
                                        @foreach ($quote as $msg)
                                            {{--@php $business = \App\Models\Business::where('user_id', $msg->user_id)->first(); @endphp--}}
                                            @php
                                                $user = \App\Models\User::where('id', $msg->user_id)->first();
                                                $business = \App\Models\Business::where('id', $user->business_id)->first();
                                            @endphp

                                            <span class="text-gray-600">
                                                <span class="text-blue-700 text-left">
                                                    {{__('portal.Message you send')}}
                                                </span>
                                                : {{strip_tags(str_replace('&nbsp;', ' ',  $msg->message))}}
                                            </span>
                                            <br> <br>
                                        @endforeach
                                    </div>
                                    <br>
                                @endif

                                {{-- Retrieving Buyer Messages using quote ID --}}
                                @php
                                    $quote = \App\Models\QouteMessage::where('qoute_id', $collection->id )->get();
                                @endphp
                                @if(isset($quote) && $quote->isNotEmpty())

                                    <div class="border-2 p-2 m-2">
                                        @foreach ($quote as $msg)
                                        {{--@php $business = \App\Models\Business::where('user_id', $msg->user_id)->first(); @endphp--}}
                                            @php
                                                $user = \App\Models\User::where('id', $msg->user_id)->first();
                                                $business = \App\Models\Business::where('id', $user->business_id)->first();
                                            @endphp

                                            <span class="text-gray-600">
                                                <span class="text-blue-700 text-left">
                                                    {{__('portal.Message from')}} @if($eOrderItems->company_name_check == 1) {{$business->business_name}} @else {{__('portal.Buyer')}} @endif
                                                </span>
                                                : {{strip_tags(str_replace('&nbsp;', ' ',  $msg->message))}}
                                            </span>
                                            <br> <br>
                                        @endforeach
                                    </div>
                                    <br>
                                @endif

                                <hr>
                                {{-- Inserting eOrderItemsID in qoute_id while Storing Supplier message and Inserting QuoteID in qoute_id while storing Buyer message --}}
                                <form action="{{ route('QuotationMessage.store') }}" class="rounded shadow-md" method="post">
                                    @csrf
                                    @php $business = \App\Models\Business::where('user_id', $eOrderItems->user_id)->first(); @endphp
                                    <h1 class="text-center text-2xl mt-4">{{__('portal.Message to')}}
                                        <span class="text-blue-600">@if($eOrderItems->company_name_check == 1) {{$business->business_name}} @else {{__('portal.Buyer')}} @endif</span>
                                        <span style="font-size: 20px;">({{__('portal.Buyer')}})</span></h1>
                                    <textarea name="message" id="message" class="w-full" style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Message')}}..." required></textarea>
                                    <x-jet-input-error for="message" class="mt-2" />
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="qoute_id" value="{{ $eOrderItems->id }}">
                                    <input type="hidden" name="usertype" value="{{ auth()->user()->business->business_type }}">

                                    <br>

                                    <div class="justify-between p-2 m-2">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
                                            {{__('portal.Send')}}
                                        </button>
                                        {{-- <a href="{{ route('updateQoute', $QouteItem->id) }}" style="margin-left: 70px;"
                                            class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-800 transition ease-in-out duration-150">
                                             Qoute Again
                                         </a>

                                         <a href="{{ route('updateRejected', $QouteItem->id) }}" style="margin-left: 70px;"
                                            class="inline-flex items-center justify-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-800 transition ease-in-out duration-150">Reject
                                             Request</a>--}}
                                    </div>
                                    <br>
                                </form>

                                <div class="text-center">
                                    <span class="text-2xl font-bold text-red-700">{{__('portal.Modification Needed')}}</span>
                                </div>
                                <br>
                                <form method="POST" action="{{ route('qoute.update', $collection->id) }}" enctype="multipart/form-data" class="rounded bg-white mt-4">
                                    @csrf
                                    @method('PUT')

                                    <tr>
                                        <div class="hidden_fields">
                                            <input type="hidden" name="e_order_items_id" value="{{ $eOrderItems->id }}">
                                            <input type="hidden" name="e_order_id" value="{{ $eOrderItems->e_order_id }}">
                                            <input type="hidden" name="business_id" value="{{ $eOrderItems->business_id }}">
                                            <input type="hidden" name="supplier_business_id" value="{{ $user_business_id }}">
                                            <input type="hidden" name="supplier_user_id" value="{{ auth()->user()->id }}">
                                        </div>
                                        <td>
                                            <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                                   name="quote_quantity" value="{{ $collection->quote_quantity }}" min="0" step="any" autocomplete="quantity" required  placeholder="{{__('portal.Qty')}}" readonly>
                                        </td>

                                        <td>
                                            <input class="form-input rounded-md shadow-sm w-full price_per_unit" id="price_per_unit" type="number"
                                                   name="quote_price_per_quantity" value="{{ $collection->quote_price_per_quantity }}" min="0.01" step="any" autocomplete="price_per_unit" required placeholder="{{__('portal.Price Per Unit')}}">
                                        </td>
                                        <td>
                                            <input type="text" id="datepicker1" class="form-input rounded-md shadow-sm block w-full" name="shipping_time_in_days" value="{{\Carbon\Carbon::createFromFormat('Y-m-d', $collection->shipping_time_in_days)->format('m/d/Y')}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)" required>
{{--                                            <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" value="{{ $collection->shipping_time_in_days }}" name="shipping_time_in_days" min="0" autocomplete="size" required placeholder="{{__('portal.Shipment(Days)')}}">--}}
                                        </td>

                                        <td>
                                            <textarea name="note_for_customer" id="note_for_customer" class="w-full note " style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Note (if any)')}}"></textarea>
                                        </td>

                                        <td>
                                            <input class="form-input rounded-md shadow-sm block w-full VAT" id="VAT" type="number" name="VAT" min="0" max="15" value="{{$collection->VAT}}" autocomplete="size" required placeholder="{{__('portal.VAT')}}">
                                        </td>

                                        <td>
                                            <input class="form-input rounded-md shadow-sm block w-full shipment_cost" id="ship_cost" type="number" name="shipment_cost" value="{{$collection->shipment_cost}}" min="0" step="any" autocomplete="size" required placeholder="{{__('portal.Shipment Cost')}}">
                                        </td>

                                    </tr>

                                    <tr class="mt-2">
                                        <td colspan="2" class="" >

                                            <input class="form-input rounded-md shadow-sm block w-full" id="total_cost" type="number" name="total_cost" autocomplete="size" value="{{$collection->total_cost}}" readonly placeholder="{{__('portal.Total Cost')}}">

                                        </td>
                                        <td colspan="2" class="text-left">
                                            <a style="cursor: pointer" id="totalCost" onclick="calculateCost()" class="ml-2 px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ">
                                                {{__('portal.Calculate Total Cost')}}
                                            </a>
                                        </td>

                                    </tr>

                                    <tr class="mt-2">
                                        <td colspan="12">
                                            <h1 class="text-xl text-center font-bold mb-2 mt-2 text-red-700">{{__('portal.Minimum expiry date for quotation will be 5 days from the date of quotation quoted.')}}</h1>
                                        </td>
                                    </tr>
                                    <tr class="mt-2">
                                        <td colspan="2">
                                            <label class="block font-medium text-sm text-gray-700" for="datepicker">
                                                {{__('portal.Quotation valid upto')}} @include('misc.required')
                                            </label>
                                            <input type="text" id="datepicker" class="block mt-1 w-full" name="expiry_date" value="{{$collection->expiry_date}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="6">
                                            <div class="my-4">
                                                <button
                                                    class=" px-4 float-right py-2 mt-4 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none active:bg-blue-600 transition ease-in-out duration-150">
                                                    {{__('portal.Send Updated Quotation')}}
                                                </button>
                                            </div>
                                        </td>

                                    </tr>
                                </form>
                            @else

                                {{-- Retrieving Supplier Messages using e_order_items_id --}}
                                @php
                                    $quote = \App\Models\QouteMessage::where('qoute_id', $eOrderItems->id )->get();
                                @endphp
                                @if(isset($quote) && $quote->isNotEmpty())

                                    <div class="border-2 p-2 m-2">
                                        @foreach ($quote as $msg)
                                            {{--@php $business = \App\Models\Business::where('user_id', $msg->user_id)->first(); @endphp--}}
                                            @php
                                                $user = \App\Models\User::where('id', $msg->user_id)->first();
                                                $business = \App\Models\Business::where('id', $user->business_id)->first();
                                            @endphp

                                            <span class="text-gray-600">
                                                <span class="text-blue-700 text-left">
                                                    {{__('portal.Message you send')}}
                                                </span>
                                                : {{strip_tags(str_replace('&nbsp;', ' ',  $msg->message))}}
                                            </span>
                                            <br> <br>
                                        @endforeach
                                    </div>
                                    <br>
                                @endif
                                <hr>
                                {{-- Inserting eOrderItemsID in qoute_id while Storing Supplier message and Inserting QuoteID in qoute_id while storing Buyer message --}}
                                <form action="{{ route('QuotationMessage.store') }}" class="rounded shadow-md" method="post">
                                    @csrf
                                    @php $business = \App\Models\Business::where('user_id', $eOrderItems->user_id)->first(); @endphp
                                    <h1 class="text-center text-2xl mt-4">
                                        {{__('portal.Message to')}}
                                        <span class="text-blue-600">@if($eOrderItems->company_name_check == 1) {{$business->business_name}} @else {{__('portal.Buyer')}} @endif</span>
                                        <span style="font-size: 20px;">({{__('portal.Buyer')}})</span></h1>
                                    <textarea name="message" id="message" class="w-full" style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Message')}}..." required></textarea>
                                    <x-jet-input-error for="message" class="mt-2" />
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="qoute_id" value="{{ $eOrderItems->id }}">
                                    <input type="hidden" name="usertype" value="{{ auth()->user()->business->business_type }}">

                                    <br>

                                    <div class="justify-between p-2 m-2">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
                                            {{__('portal.Send')}}
                                        </button>
                                        {{-- <a href="{{ route('updateQoute', $QouteItem->id) }}" style="margin-left: 70px;"
                                            class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-800 transition ease-in-out duration-150">
                                             Qoute Again
                                         </a>

                                         <a href="{{ route('updateRejected', $QouteItem->id) }}" style="margin-left: 70px;"
                                            class="inline-flex items-center justify-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-800 transition ease-in-out duration-150">Reject
                                             Request</a>--}}
                                    </div>
                                    <br>
                                </form>

                                <form method="POST" action="{{ route('qoute.store') }}" enctype="multipart/form-data" class="rounded bg-white mt-4">
                                    @csrf
                                    <tr>
                                        <div class="hidden_fields">
                                            <input type="hidden" name="e_order_items_id" value="{{ $eOrderItems->id }}">
                                            <input type="hidden" name="e_order_id" value="{{ $eOrderItems->e_order_id }}">
                                            <input type="hidden" name="business_id" value="{{ $eOrderItems->business_id }}">
                                            <input type="hidden" name="supplier_business_id" value="{{ $user_business_id }}">
                                            <input type="hidden" name="supplier_user_id" value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="warehouse_id" value="{{ $eOrderItems->warehouse->id }}">
                                        </div>
                                        <td>
                                            <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                                   name="quote_quantity" min="0" step="any" autocomplete="quantity" required  placeholder="{{__('portal.Qty')}}" value="{{$eOrderItems->quantity}}" readonly>
                                        </td>

                                        <td>
                                            <input class="form-input rounded-md shadow-sm  w-full price_per_unit" id="price_per_unit" type="number"
                                                   name="quote_price_per_quantity"  min="0.01" step="any" autocomplete="price_per_unit" value="{{old('quote_price_per_quantity')}}" required placeholder="{{__('portal.Price Per Unit')}}">
                                        </td>
                                        <td>
                                            <input type="text" id="datepicker1" class="form-input rounded-md shadow-sm block w-full" name="shipping_time_in_days" value="{{old('shipping_time_in_days')}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)" required>
{{--                                            <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  name="shipping_time_in_days" min="0" autocomplete="size" value="{{old('shipping_time_in_days')}}" required placeholder="{{__('portal.Shipment(Days)')}}">--}}
                                        </td>

                                        <td>
                                            <textarea name="note_for_customer" id="note_for_customer" class="w-full note " style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Note (if any)')}}">{{old('note_for_customer')}}</textarea>
                                        </td>

                                        <td>
                                            <input class="form-input rounded-md shadow-sm block w-full VAT" id="VAT" type="number" name="VAT" min="0" max="15" value="{{old('VAT')}}" autocomplete="size" required placeholder="{{__('portal.VAT')}}">
                                        </td>

                                        <td>
                                            <input class="form-input rounded-md shadow-sm block w-full shipment_cost" id="ship_cost" type="number" name="shipment_cost"  min="0" step="any" value="{{old('shipment_cost')}}" autocomplete="size" required placeholder="{{__('portal.Shipment Cost')}}" >
                                        </td>

                                    </tr>

                                    <tr class="mt-2">
                                        <td colspan="2">
                                            <input class="form-input rounded-md shadow-sm block w-full" id="total_cost" type="number" name="total_cost" autocomplete="size" readonly placeholder="Total Cost">
                                        </td>
                                        <td colspan="2" class="text-left">
                                            <a style="cursor: pointer" id="totalCost" onclick="calculateCost()" class="ml-2 px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ">
                                                {{__('portal.Calculate Total Cost')}}
                                            </a>
                                        </td>

                                    </tr>

                                    <tr class="mt-2">
                                        <td colspan="12">
                                            <h1 class="text-xl text-center font-bold mb-2 mt-2 text-red-700">{{__('portal.Minimum expiry date for quotation will be 5 days from the date of quotation quoted.')}}</h1>
                                        </td>
                                    </tr>
                                    <tr class="mt-2">
                                        <td colspan="2">
                                            <label class="block font-medium text-sm text-gray-700" for="datepicker">
                                                {{__('portal.Quotation valid upto')}} @include('misc.required')
                                            </label>
                                            <input type="text" id="datepicker" class="block mt-1 w-full" name="expiry_date" value="{{old('expiry_date')}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)">
                                        </td>
                                    </tr>

                                    <tr style="border: none !important;">
                                        <td colspan="6" class="px-10 text-left"  >
                                            <button
                                                class=" px-4 float-right py-2 mt-6 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 active:bg-green-600 transition ease-in-out duration-150">
                                                {{__('portal.Send Quote')}}
                                            </button>
                                            <br>
                                            <a href="{{ route('viewRFQs') }}" style="background-color: #145EA8"
                                               class="inline-flex items-center px-4 mr-2 py-2 mb-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                                {{__('portal.Back')}}
                                            </a>

                                        </td>

                                    </tr>

                                </form>

                            </tbody>

                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script>
        $('#reject').on('click', function (e) {
            if(!confirm('Are you sure?')){
                e.preventDefault();
            }
        });
    </script>
@else
    <x-app-layout>
        <style type="text/css">
            /* color for request for quotation heading*/
            .color-7f7f7f {
                color: #7f7f7f;
            }

            .color-1f3864 {
                color: #1f3864;
            }



            select:hover{
                cursor: pointer;
            }

            input ,
            .note
            {
                height: 35px;
            }
            .note {
                border: 1px solid #d2d6dc !important;
                resize: none;
                margin-top: 8px;
                padding: 2px 10px;
            }

            .note:focus {
                outline: none;
                box-shadow: 0 0 0 3px rgba(164, 202, 254, 0.45);
                border-color: #a4cafe;
            }


            @media screen and (max-width:360px) {
                .date {
                    margin-left: auto;
                    margin-right: auto;
                }
            }

        </style>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>

        @if (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @foreach ($errors->get('expiry_date') as $error)
            <div class="block mt-2 text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-3">{{ $error }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endforeach
        @foreach ($errors->get('shipping_time_in_days') as $error)
            <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-3">{{ $error }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endforeach

        <div class="-my-2 overflow-x-auto sm:overflow-hidden lg:-mx-8 scroll-bar-for-large-screen">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="flex flex-col bg-white rounded">
                    <div class="p-4"
                         style="background-color: #F3F3F3; border-top:20px solid #E69138; border-bottom: 20px solid #FCE5CD;">
                        <div class="d-block text-center">
                            <span class="text-2xl font-bold color-7f7f7f">{{__('portal.Requisition')}}</span>
                        </div>
                        <hr>
                        <div style=" min-height: 145px;" class="container-fluid px-4 flex bg-grey flex-wrap">
                            <div class="flex-1 py-5">
                                <div class="my-5 pl-5">
                                    <img src="{{ Storage::url(Auth::user()->business->business_photo_url) }}" alt="logo"
                                         style="height: 80px;width: 200px;" />
                                    {{--                            <img src="{{ url('imp_img.jpg') }}" alt="logo" style="height: 80px;width: 200px;" />--}}
                                </div>
                                @php
                                    $user_business_details=auth()->user()->business;
                                @endphp
                                <div class="my-5 pl-5 ">
                                    <h1 class="font-extrabold color-1f3864 text-xl ">{{$user_business_details->business_name}}</h1>
                                    {{-- <span>Location :
                                    <span class="font-bold">{{$user_business_details->city}}</span></span> <br>
                                    <span>Emdad Id : <span class="font-bold">{{Auth::user()->business_id}}</span></span> --}}
                                </div>
                            </div>

                            <div class="flex-1 ">
                                <div class="ml-auto date" style="width:150px; float: left">
                                    <br>
                                    <span class="color-1f3864 font-bold">{{__('portal.Date')}}:
                                {{\Carbon\Carbon::today()->format('Y-m-d')}}</span><br>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=" mb-3">
                        <div>
                            <div style="background: #DEEAF6; min-height: 235px; padding-top: 1px;" class="flex ">

                                <div class="left-info_holder flex-1 mr-2">
                                    <div class="my-5 pl-5 ">
                                        <span class="font-bold color-1f3864 text-lg">{{__('portal.Requisition Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5 ">
                                        <strong>{{__('portal.Buyer Name')}}:</strong> @if($eOrderItems->company_name_check == 1) {{$eOrderItems->business->business_name}} @else {{__('portal.N/A')}} @endif
                                        <br>
                                        <strong>{{__('portal.Requisition')}} #:</strong> {{__('portal.RFQ')}}-{{$eOrderItems->id}}
                                        <br>
                                        <strong>{{__('portal.Remarks')}}: </strong>{{$eOrderItems->remarks}}
                                        <br>
                                        <strong>{{__('portal.Payment Mode')}}: </strong>
                                        @if($eOrderItems->payment_mode == 'Cash') {{__('portal.Cash')}}
                                        @elseif($eOrderItems->payment_mode == 'Credit') {{__('portal.Credit')}}
                                        @elseif($eOrderItems->payment_mode == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                        @elseif($eOrderItems->payment_mode == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                        @elseif($eOrderItems->payment_mode == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                        @elseif($eOrderItems->payment_mode == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                        @endif
                                        {{--                                    {{$eOrderItems->payment_mode}}--}}
                                    </div>
                                </div>
                                <div class="center-info-holder flex-1">
                                    <div class="my-5 pl-5 ">
                                        <span class="font-bold text-lg color-1f3864">{{__('portal.Item Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5 ">
                                        <strong>{{__('portal.Category Name')}}: </strong> {{ \App\Models\Category::where('id', $eOrderItems->item_code)->first()->name_ar }} / {{ \App\Models\Category::where('id',(\App\Models\Category::where('id',$eOrderItems->item_code)->first()->parent_id))->first()->name_ar }}
                                        <br>

                                        <strong>{{__('portal.Brand')}}: </strong> {{ $eOrderItems->brand }}
                                        <br>
                                        <strong>{{__('portal.Quantity')}}: </strong> {{ $eOrderItems->quantity }}
                                        <br>
                                        <strong>{{__('portal.Unit of Measurement')}}: </strong> {{ $eOrderItems->unit_of_measurement }}
                                        <br>
                                        <strong>{{__('portal.Size')}}: </strong> {{ $eOrderItems->size }}
                                        <br>

                                        <strong>{{__('portal.Description')}}:</strong> {{ strip_tags($eOrderItems->description) }}
                                    </div>
                                </div>
                                <div class="Right-info_holder flex-1">
                                    <div class="my-5 pl-5 ">
                                        <span class="font-bold text-lg color-1f3864">{{__('portal.Shipping Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5 ">

                                        <strong>{{__('portal.Delivery Period')}}: </strong>
                                        @if ($eOrderItems->delivery_period =='Immediately') {{__('portal.Immediately')}} @endif
                                        @if ($eOrderItems->delivery_period =='Within 30 Days') {{__('portal.30 Days')}} @endif
                                        @if ($eOrderItems->delivery_period =='Within 60 Days') {{__('portal.60 Days')}} @endif
                                        @if ($eOrderItems->delivery_period =='Within 90 Days') {{__('portal.90 Days')}} @endif
                                        @if ($eOrderItems->delivery_period =='Standing Order - 2 per year' ) {{__('portal.Standing Order - 2 times / year')}} @endif
                                        @if ($eOrderItems->delivery_period =='Standing Order - 3 per year' ) {{__('portal.Standing Order - 3 times / year')}} @endif
                                        @if ($eOrderItems->delivery_period =='Standing Order - 4 per year' ) {{__('portal.Standing Order - 4 times / year')}} @endif
                                        @if ($eOrderItems->delivery_period =='Standing Order - 6 per year' ) {{__('portal.Standing Order - 6 times / year')}} @endif
                                        @if ($eOrderItems->delivery_period =='Standing Order - 12 per year' ) {{__('portal.Standing Order - 12 times / year')}} @endif
                                        @if ($eOrderItems->delivery_period =='Standing Order Open' ) {{__('portal.Standing Order - Open')}} @endif
                                        {{--                                    {{ $eOrderItems->delivery_period }}--}}
                                        <br>
                                        <strong>{{__('portal.Delivery Address')}}: </strong> {{ $eOrderItems->warehouse->address }}
                                        <br>

                                        <strong>{{__('portal.Required Sample')}}: </strong>
                                        @if($eOrderItems->required_sample == 'Yes') {{__('portal.Yes')}} @endif
                                        @if($eOrderItems->required_sample == 'No') {{__('portal.No')}} @endif
                                        <br>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p4 mb-5 overflow-x-auto">
                        <table class="table-fixed  min-w-full text-center ">
                            <thead style="background-color:#8EAADB" class="text-white">
                            <tr>

                                <th style="width:10%;">{{__('portal.Quantity')}} @include('misc.required')</th>
                                <th style="width:10%;">{{__('portal.Price Per Unit')}} @include('misc.required') </th>
                                <th style="width:11%;">{{__('portal.Shipping Time')}} @include('misc.required') </th>
                                <th style="width:20%;">{{__('portal.Note')}}</th>
                                <th style="width:12%;">{{__('portal.VAT')}} % @include('misc.required') </th>
                                <th style="width:10%;">{{__('portal.Shipment Cost')}} @include('misc.required')</th>

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            {{--                    this will show the information if user has some previous quotes--}}
                            @if($collection)

                                <tr>
                                    <td>
                                        {{$collection->quote_quantity}}
                                    </td>
                                    <td>
                                        {{$collection->quote_price_per_quantity}} {{__('portal.SAR')}}
                                    </td>
                                    <td>
                                        {{$collection->shipping_time_in_days}}
                                    </td>
                                    <td>
                                        {{$collection->note_for_customer}}
                                    </td>
                                    <td>
                                        {{$collection->VAT}}%
                                    </td>
                                    <td>
                                        {{$collection->shipment_cost}} {{__('portal.SAR')}}
                                    </td>
                                </tr>
                            @endif
                            @if ($collection && $collection->qoute_status == 'Qouted')

                                <h2 class="text-center text-2xl">{{__('portal.You have already quoted.')}}</h2>

                            @elseif($collection && $collection->qoute_status == 'ModificationNeeded')

                                {{-- Retrieving Supplier Messages using e_order_items_id --}}
                                @php
                                    $quote = \App\Models\QouteMessage::where('qoute_id', $eOrderItems->id )->get();
                                @endphp
                                @if(isset($quote) && $quote->isNotEmpty())

                                    <div class="border-2 p-2 m-2">
                                        @foreach ($quote as $msg)
                                            {{--@php $business = \App\Models\Business::where('user_id', $msg->user_id)->first(); @endphp--}}
                                            @php
                                                $user = \App\Models\User::where('id', $msg->user_id)->first();
                                                $business = \App\Models\Business::where('id', $user->business_id)->first();
                                            @endphp

                                            <span class="text-gray-600">
                                        <span class="text-blue-700 text-left">
                                            {{__('portal.Message you send')}}
                                        </span>
                                        : {{strip_tags(str_replace('&nbsp;', ' ',  $msg->message))}}
                                    </span>
                                            <br> <br>
                                        @endforeach
                                    </div>
                                    <br>
                                @endif

                                {{-- Retrieving Buyer Messages using quote ID --}}
                                @php
                                    $quote = \App\Models\QouteMessage::where('qoute_id', $collection->id )->get();
                                @endphp
                                @if(isset($quote) && $quote->isNotEmpty())

                                    <div class="border-2 p-2 m-2">
                                        @foreach ($quote as $msg)
                                            {{--@php $business = \App\Models\Business::where('user_id', $msg->user_id)->first(); @endphp--}}
                                            @php
                                                $user = \App\Models\User::where('id', $msg->user_id)->first();
                                                $business = \App\Models\Business::where('id', $user->business_id)->first();
                                            @endphp

                                            <span class="text-gray-600">
                                        <span class="text-blue-700 text-left">
                                            {{__('portal.Message from')}} @if($eOrderItems->company_name_check == 1) {{$business->business_name}} @else {{__('portal.Buyer')}} @endif
                                        </span>
                                        : {{strip_tags(str_replace('&nbsp;', ' ',  $msg->message))}}
                                    </span>
                                            <br> <br>
                                        @endforeach
                                    </div>
                                    <br>
                                @endif
                                <div class="text-center">
                                    <span class="text-2xl font-bold text-red-700">{{__('portal.Modification Needed')}}</span>
                                </div>
                                <br>
                                <form method="POST" action="{{ route('qoute.update', $collection->id) }}" enctype="multipart/form-data" class="rounded bg-white mt-4">
                                    @csrf
                                    @method('PUT')

                                    <tr>
                                        <div class="hidden_fields">
                                            <input type="hidden" name="e_order_items_id" value="{{ $eOrderItems->id }}">
                                            <input type="hidden" name="e_order_id" value="{{ $eOrderItems->e_order_id }}">
                                            <input type="hidden" name="business_id" value="{{ $eOrderItems->business_id }}">
                                            <input type="hidden" name="supplier_business_id" value="{{ $user_business_id }}">
                                            <input type="hidden" name="supplier_user_id" value="{{ auth()->user()->id }}">
                                        </div>
                                        <td>
                                            <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                                   name="quote_quantity" min="0" value="{{ $collection->quote_quantity }}" step="any" autocomplete="quantity" required  placeholder="{{__('portal.Qty')}}" readonly>
                                        </td>

                                        <td>
                                            <input class="form-input rounded-md shadow-sm  w-full" id="price_per_unit" type="number"
                                                   name="quote_price_per_quantity" value="{{ $collection->quote_price_per_quantity }}" min="0.01" step="any" autocomplete="price_per_unit" required placeholder="{{__('portal.Price Per Unit')}}">
                                        </td>
                                        <td>
                                            <input type="text" id="datepicker1" class="form-input rounded-md shadow-sm block w-full" name="shipping_time_in_days" value="{{$collection->shipping_time_in_days}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)" required>
{{--                                            <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" value="{{ $collection->shipping_time_in_days }}" name="shipping_time_in_days" min="0" autocomplete="size" required placeholder="{{__('portal.Shipment(Days)')}}">--}}
                                        </td>

                                        <td>
                                            <textarea name="note_for_customer" id="note_for_customer" class="w-full note " style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Note (if any)')}}"></textarea>
                                        </td>

                                        <td>
                                            <input class="form-input rounded-md shadow-sm block w-full VAT" id="VAT" type="number" name="VAT" min="0" max="15" value="{{$collection->VAT}}" autocomplete="size" required placeholder="{{__('portal.VAT')}}">
                                        </td>

                                        <td>
                                            <input class="form-input rounded-md shadow-sm block w-full shipment_cost" id="ship_cost" type="number" name="shipment_cost" value="{{$collection->shipment_cost}}" min="0" step="any" autocomplete="size" required placeholder="{{__('portal.Shipment Cost')}}">
                                        </td>

                                    </tr>

                                    <tr class="mt-2">
                                        <td colspan="2" class="" >

                                            <input class="form-input rounded-md shadow-sm block w-full" id="total_cost" type="number" name="total_cost" autocomplete="size" readonly value="{{$collection->total_cost}}" placeholder="{{__('portal.Total Cost')}}">

                                        </td>
                                        <td colspan="2" class="text-right">
                                            <a style="cursor: pointer" id="totalCost" onclick="calculateCost()" class="mr-2 px-4 py-1 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 hover:text-white active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ">
                                                {{__('portal.Calculate Total Cost')}}
                                            </a>
                                        </td>

                                    </tr>

                                    <tr class="mt-2">
                                        <td colspan="12">
                                            <h1 class="text-xl text-center font-bold mb-2 mt-2 text-red-700">{{__('portal.Minimum expiry date for quotation will be 5 days from the date of quotation quoted.')}}</h1>
                                        </td>
                                    </tr>
                                    <tr class="mt-2">
                                        <td colspan="2">
                                            <label class="block font-medium text-sm text-gray-700" for="datepicker">
                                                {{__('portal.Quotation valid upto')}} @include('misc.required')
                                            </label>
                                            <input type="text" id="datepicker" class="block mt-1 w-full" name="expiry_date" value="{{$collection->expiry_date}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="6">
                                            <div class="my-4">
                                                <button
                                                    class=" px-4 float-right py-2 mt-4 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none focus:border-blue-700 active:bg-blue-600 transition ease-in-out duration-150">
                                                    {{__('portal.Send Updated Quotation')}}
                                                </button>
                                            </div>
                                        </td>

                                    </tr>
                                </form>
                            @else

                                <form method="POST" action="{{ route('qoute.store') }}" enctype="multipart/form-data" class="rounded bg-white mt-4">
                                    @csrf
                                    <tr>
                                        <div class="hidden_fields">
                                            <input type="hidden" name="e_order_items_id" value="{{ $eOrderItems->id }}">
                                            <input type="hidden" name="e_order_id" value="{{ $eOrderItems->e_order_id }}">
                                            <input type="hidden" name="business_id" value="{{ $eOrderItems->business_id }}">
                                            <input type="hidden" name="supplier_business_id" value="{{ $user_business_id }}">
                                            <input type="hidden" name="supplier_user_id" value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="warehouse_id" value="{{ $eOrderItems->warehouse->id }}">
                                        </div>
                                        <td>
                                            <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                                   name="quote_quantity" min="0" step="any" autocomplete="quantity" required  placeholder="{{__('portal.Qty')}}"  value="{{$eOrderItems->quantity}}" readonly>
                                        </td>

                                        <td>
                                            <input class="form-input rounded-md shadow-sm  w-full" id="price_per_unit" type="number"
                                                   name="quote_price_per_quantity"  min="0.01" step="any" autocomplete="price_per_unit" required placeholder="{{__('portal.Price Per Unit')}}">
                                        </td>
                                        <td>
                                            <input type="text" id="datepicker1" class="form-input rounded-md shadow-sm block w-full" name="shipping_time_in_days" value="{{old('shipping_time_in_days')}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)" required>
{{--                                            <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  name="shipping_time_in_days" min="0" autocomplete="size" required placeholder="{{__('portal.Shipment(Days)')}}">--}}
                                        </td>

                                        <td>
                                            <textarea name="note_for_customer" id="note_for_customer" class="w-full note " style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Note (if any)')}}">{{old('note_for_customer')}}</textarea>
                                        </td>

                                        <td>
                                            <input class="form-input rounded-md shadow-sm block w-full VAT" id="VAT" type="number" name="VAT" value="{{old('VAT')}}" min="0" max="15"  autocomplete="size" required placeholder="{{__('portal.VAT')}}">
                                        </td>

                                        <td>
                                            <input class="form-input rounded-md shadow-sm block w-full shipment_cost" id="ship_cost" type="number" name="shipment_cost"  min="0" step="any" value="{{old('shipment_cost')}}" autocomplete="size" required placeholder="{{__('portal.Shipment Cost')}}" >
                                        </td>

                                    </tr>

                                    <tr class="mt-2">
                                        <td colspan="2">
                                            <input class="form-input rounded-md shadow-sm block w-full" id="total_cost" type="number" name="total_cost" autocomplete="size" readonly placeholder="Total Cost">
                                        </td>
                                        <td colspan="2" class="text-right">
                                            <a style="cursor: pointer" id="totalCost" onclick="calculateCost()" class="mr-2 px-4 py-1 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 hover:text-white active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ">
                                                {{__('portal.Calculate Total Cost')}}
                                            </a>
                                        </td>

                                    </tr>

                                    <tr class="mt-2">
                                        <td colspan="12">
                                            <h1 class="text-xl text-center font-bold mb-2 mt-2 text-red-700">{{__('portal.Minimum expiry date for quotation will be 5 days from the date of quotation quoted.')}}</h1>
                                        </td>
                                    </tr>
                                    <tr class="mt-2">
                                        <td colspan="2">
                                            <label class="block font-medium text-sm text-gray-700" for="datepicker">
                                                {{__('portal.Quotation valid upto')}} @include('misc.required')
                                            </label>
                                            <input type="text" id="datepicker" class="block mt-1 w-full" name="expiry_date" value="{{old('expiry_date')}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)">
                                        </td>
                                    </tr>

                                    <tr style="border: none !important;">
                                        <td colspan="6" class="px-10 text-left"  >
                                            <button
                                                class=" px-4 float-right py-2 mt-6 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 active:bg-green-600 transition ease-in-out duration-150">
                                                {{__('portal.Send Quote')}}
                                            </button>
                                            <br>
                                            <a href="{{ route('viewRFQs') }}" style="background-color: #145EA8"
                                               class="inline-flex items-center px-4 mr-2 py-2 mb-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700  hover:text-white active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                                {{__('portal.Back')}}
                                            </a>

                                        </td>

                                    </tr>

                                </form>

                            </tbody>

                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script>
        $('#reject').on('click', function (e) {
            if(!confirm('Are you sure?')){
                e.preventDefault();
            }
        });
    </script>
@endif

<script>

    function calculateCost()
    {

        let quantity =$('#quantity').val();

        let ppu= $("#price_per_unit").val();
        let ship_cost= $("#ship_cost").val();
        let VAT= $("#VAT").val();
        $.ajax({
            type : 'GET',
            url:"{{ route('totalCost') }}",
            data:{
                {{--"_token": "{{ csrf_token() }}",--}}
                'quote_quantity':quantity,
                'quote_price_per_quantity':ppu,
                'VAT':VAT,
                'shipment_cost':ship_cost,
            },
            success: function (response) {
                console.log(response);
                $('#total_cost').val(response.data);
            }
        });

    // Clearing Total Cost Field on any mentioned fields changed
    $(document).on('keydown', '.quantity, .price_per_unit, .VAT, .shipment_cost', function(){

        $('#total_cost').val('');
    });

    }

    $( function() {
        $( "#datepicker" ).datepicker({
            dateFormat: 'mm/dd/yy',
            changeMonth: true,
            changeYear: true,
            minDate: +5,
            maxDate: +90,
            clear: true,
        }).attr('readonly', 'readonly');
    } );
    $( function() {
        $( "#datepicker1" ).datepicker({
            dateFormat: 'mm/dd/yy',
            changeMonth: true,
            changeYear: true,
            minDate: +5,
            maxDate: +90,
            clear: true,
        }).attr('readonly', 'readonly');
    } );
</script>
