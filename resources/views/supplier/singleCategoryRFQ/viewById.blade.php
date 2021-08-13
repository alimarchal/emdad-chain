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

            input ,.note
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
                            {{-- <img src="{{ Storage::url(Auth::user()->business->business_photo_url) }}" alt="logo"
                            style="height: 80px;width: 200px;" /> --}}
                            <img src="{{ url('imp_img.jpg') }}" alt="logo" style="height: 80px;width: 200px;" />
                        </div>
                        @php
                            $user_business_details=auth()->user()->business;
                        @endphp
                        <div class="my-5 pl-5 ">
                            <h1 class="font-extrabold color-1f3864 text-xl ">{{$user_business_details->business_name}}</h1>
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
                                <strong>{{__('portal.Buyer Name')}}:</strong> {{$eOrderItems[0]->business->business_name}}
                                <br>
                                <strong>{{__('portal.Requisition')}} #:</strong> {{__('portal.Emdad')}}-{{$eOrderItems[0]->e_order_id}}
                                <br>
                                <strong>{{__('portal.User Quoted')}}:</strong> {{$eOrderItems[0]->user->name}}
                                <br>
                                <strong>{{__('portal.Category Code')}}: </strong> {{$eOrderItems[0]->item_code}}
                                <br>
                                <strong>{{__('portal.Category Name')}}: </strong> {{ $eOrderItems[0]->item_name }} / {{ \App\Models\Category::where('id',(\App\Models\Category::where('id',$eOrderItems[0]->item_code)->first()->parent_id))->first()->name }}
                                <br>
                                <strong>{{__('portal.Payment Mode')}}: </strong>
                                    @if($eOrderItems[0]->payment_mode == 'Cash') {{__('portal.Cash')}}
                                    @elseif($eOrderItems[0]->payment_mode == 'Credit') {{__('portal.Credit')}}
                                    @elseif($eOrderItems[0]->payment_mode == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                    @elseif($eOrderItems[0]->payment_mode == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                    @elseif($eOrderItems[0]->payment_mode == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                    @elseif($eOrderItems[0]->payment_mode == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                    @endif
{{--                                    {{$eOrderItems[0]->payment_mode}}--}}
                            </div>
                        </div>
                        <div class="Right-info_holder flex-1">
                            <div class="my-5 pl-5 ">
                                <span class="font-bold text-lg color-1f3864">{{__('portal.Shipping Information')}}</span>
                                <hr style="border-top: 1px solid gray;width: 25%;">
                            </div>
                            <div class="my-5 pl-5 ">

                                <strong>{{__('portal.Delivery Period')}}: </strong>
                                    @if ($eOrderItems[0]->delivery_period =='Immediately') {{__('portal.Immediately')}} @endif
                                    @if ($eOrderItems[0]->delivery_period =='Within 30 Days') {{__('portal.30 Days')}} @endif
                                    @if ($eOrderItems[0]->delivery_period =='Within 60 Days') {{__('portal.60 Days')}} @endif
                                    @if ($eOrderItems[0]->delivery_period =='Within 90 Days') {{__('portal.90 Days')}} @endif
                                    @if ($eOrderItems[0]->delivery_period =='Standing Order - 2 per year' ) {{__('portal.Standing Order - 2 times / year')}} @endif
                                    @if ($eOrderItems[0]->delivery_period =='Standing Order - 3 per year' ) {{__('portal.Standing Order - 3 times / year')}} @endif
                                    @if ($eOrderItems[0]->delivery_period =='Standing Order - 4 per year' ) {{__('portal.Standing Order - 4 times / year')}} @endif
                                    @if ($eOrderItems[0]->delivery_period =='Standing Order - 6 per year' ) {{__('portal.Standing Order - 6 times / year')}} @endif
                                    @if ($eOrderItems[0]->delivery_period =='Standing Order - 12 per year' ) {{__('portal.Standing Order - 12 times / year')}} @endif
                                    @if ($eOrderItems[0]->delivery_period =='Standing Order Open' ) {{__('portal.Standing Order - Open')}} @endif
{{--                                    {{ $eOrderItems[0]->delivery_period }}--}}
                                <br>
                                <strong>{{__('portal.Delivery Address')}}: </strong> {{ $eOrderItems[0]->warehouse->address }}
                                <br>

                                <strong>{{__('portal.Required Sample')}}: </strong>
                                @if($eOrderItems[0]->required_sample == 'Yes') {{__('portal.Yes')}} @endif
                                @if($eOrderItems[0]->required_sample == 'No') {{__('portal.No')}} @endif
{{--                                {{ $eOrderItems[0]->required_sample }}--}}
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
                        <th style="width:2%;">#</th>
                        <th style="width:11%;">{{__('portal.Brand')}} @include('misc.required') </th>
                        <th style="width:11%;">{{__('portal.Remarks')}} @include('misc.required') </th>
                        <th style="width:9%;">{{__('portal.UOM')}} @include('misc.required') </th>
                        <th style="width:7%;">{{__('portal.Size')}} @include('misc.required') </th>
                        <th style="width:11%;">{{__('portal.Description')}} @include('misc.required') </th>
                        <th style="width:3%;">{{__('portal.Attachments')}}</th>
                        <th style="width:7%;">{{__('portal.Quantity')}} @include('misc.required')</th>
                        <th style="width:7%;">{{__('portal.Price Per Unit')}} @include('misc.required') </th>
                        <th style="width:20%;">{{__('portal.Note')}}</th>

                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                    @if ($collection && $collection->qoute_status == 'Qouted')

                        <h2 class="text-center text-2xl">{{__('portal.You have already quoted.')}}</h2>

                    @elseif($collection && $collection->qoute_status == 'ModificationNeeded')
                        @php
                            $quote = \App\Models\QouteMessage::where('qoute_id', $collection->id )->get();
                        @endphp
                        @if(isset($quote) && $quote->isNotEmpty())

                            <div class="border-2 p-2 m-2">
                                @foreach ($quote as $msg)
                                    @php $business = \App\Models\Business::where('user_id', $msg->user_id)->first(); @endphp
                                    @php
                                        $user = \App\Models\User::where('id', $msg->user_id)->first();
                                        $business = \App\Models\Business::where('id', $user->business_id)->first();
                                    @endphp

                                    <span class="text-blue-700">
                                            <span class="text-gray-600 text-left">
                                                {{__('portal.Message from')}} {{$business->business_name}}
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
                        <form name="form" method="POST" action="{{ route('singleRFQQuotationUpdate') }}" enctype="multipart/form-data" class="rounded bg-white mt-4">
                            @csrf

                            @foreach($eOrderItems as $eOrderItem)
                                <tr>
                                    <div class="hidden_fields">
                                        <input type="hidden" name="e_order_items_id[]" value="{{ $eOrderItem->id }}">
                                        <input type="hidden" name="e_order_id" value="{{ $eOrderItem->e_order_id }}">
                                        <input type="hidden" name="business_id" value="{{ $eOrderItem->business_id }}">
                                        <input type="hidden" name="supplier_business_id" value="{{ auth()->user()->business_id }}">
                                        <input type="hidden" name="supplier_user_id" value="{{ auth()->id() }}">
                                    </div>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  min="0" autocomplete="size" required readonly value="{{$eOrderItem->brand}}">
                                    </td>
                                    <td>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  min="0" autocomplete="size" required readonly value="{{$eOrderItem->remarks}}">
                                    </td>
                                    <td>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  min="0" autocomplete="size" required readonly value="{{$eOrderItem->unit_of_measurement}}">
                                    </td>
                                    <td>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  min="0" autocomplete="size" required readonly value="{{$eOrderItem->size}}">
                                    </td>
                                    <td>
                                        <textarea class="w-full note " style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" rows="3" readonly>{{$eOrderItem->description}}</textarea>
                                    </td>

                                    <td>
                                        @if ($eOrderItem->file_path)
                                            <a href="{{ Storage::url($eOrderItem->file_path) }}" target="_blank">
                                                <svg class="w-6 h-6 ml-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                    </path>
                                                </svg>
                                            </a>
                                        @else
                                            {{__('portal.N/A')}}
                                        @endif
                                    </td>

                                    <td>
                                        <input class="form-input rounded-md shadow-sm  w-full quantity" id="quantity_id" type="number"
                                               name="quote_quantity[]" min="0" step="any" autocomplete="quantity" required readonly placeholder="{{__('portal.Qty')}}" value="{{$eOrderItem->quantity}}" >
                                    </td>

                                    <td>
                                        @php $quoteInfo = \App\Models\Qoute::where('e_order_items_id', $eOrderItem->id)->first(); @endphp
                                        <input class="form-input rounded-md shadow-sm  w-full price_per_unit" id="price_per_unit_id" type="number"
                                               name="quote_price_per_quantity[]"  min="0" step="any" autocomplete="price_per_unit" value="{{$quoteInfo->quote_price_per_quantity}}" required>
                                    </td>

                                    <td>
                                        <textarea name="note_for_customer[]" id="note_for_customer" class="w-full note " style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Note (if any)')}}">{{$quoteInfo->note_for_customer}}</textarea>
                                    </td>

                                </tr>

                                {{--@if($eOrderItem->required_sample == 'Yes')
                                    <tr>
                                        <td colspan="9">
                                            <p class="py-2 font-bold text-center text-2xl">Sample Information {{$loop->iteration}}</p>
                                            <div class="flex flex-wrap overflow-hidden xl:-mx-1">
                                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                        Samples
                                                    </label>
                                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="sample_information[]"  min="0" step="any" autocomplete="size" value="{{$quoteInfo->sample_information}}" required>
                                                </div>
                                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                        Sample Unit
                                                    </label>
                                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_unit[]"  min="0" autocomplete="size" value="{{$quoteInfo->sample_unit}}" required>
                                                </div>
                                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                        Quantity
                                                    </label>
                                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_security_charges[]"  min="0" autocomplete="size" value="{{$quoteInfo->sample_security_charges}}" required>
                                                </div>
                                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                        Sample Charges Per Unit
                                                    </label>
                                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_charges_per_unit[]"  min="0" autocomplete="size" value="{{$quoteInfo->sample_charges_per_unit}}" required>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endif--}}
                            @endforeach
                            <tr class="mt-2">
                                <td colspan="9">
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">{{__('portal.Shipment Time (In Days)')}}</label>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="shipping_time_in_days" type="number" name="shipping_time_in_days"  min="0" step="any" autocomplete="size" required value="{{$collection->shipping_time_in_days}}" placeholder="Shipment Time" >
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">{{__('portal.Shipment Cost')}}</label>
                                        <input class="form-input rounded-md shadow-sm block w-full shipment_cost" id="ship_cost" type="number" name="shipment_cost"  min="0" step="any" autocomplete="size" value="{{$collection->shipment_cost}}" required placeholder="Shipment Cost" >
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">{{__('portal.VAT (in %)')}}</label>
                                        <input class="form-input rounded-md shadow-sm block w-full VAT" id="VAT" type="number" name="VAT" min="0" max="15"  autocomplete="size" required value="{{$collection->VAT}}" placeholder="VAT (%)">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">{{__('portal.Total Cost')}}</label>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="total_cost" type="number" name="total_cost" autocomplete="size" readonly placeholder="Total Cost">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <a style="cursor: pointer" id="totalCost" @if(count($eOrderItems) == 1) onclick="calculateCostForSingleItemInSingleCategory()" @else onclick="calculateCost()" @endif class="ml-2 px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ">
                                            {{__('portal.Calculate Total Cost')}}
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <tr style="border: none !important;">
                                <td colspan="12" class="px-10 text-left">
                                    <div class="my-4">
                                        <button class=" px-4 float-right py-2 mt-4 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                            {{__('portal.Send Updated Quotation')}}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </form>
                    @else

                        <form name="form" method="POST" action="{{ route('singleRFQQuotationStore') }}" enctype="multipart/form-data" class="rounded bg-white mt-4">
                            @csrf
                            @foreach($eOrderItems as $eOrderItem)
                                <tr>
                                    <div class="hidden_fields">
                                        <input type="hidden" name="e_order_items_id[]" value="{{ $eOrderItem->id }}">
                                        <input type="hidden" name="e_order_id" value="{{ $eOrderItem->e_order_id }}">
                                        <input type="hidden" name="business_id" value="{{ $eOrderItem->business_id }}">
                                        <input type="hidden" name="supplier_business_id" value="{{ auth()->user()->business_id}}">
                                        <input type="hidden" name="supplier_user_id" value="{{ auth()->id() }}">
                                        <input type="hidden" name="warehouse_id" value="{{ $eOrderItem->warehouse->id }}">
                                    </div>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  min="0" autocomplete="size" required readonly value="{{$eOrderItem->brand}}">
                                    </td>
                                    <td>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  min="0" autocomplete="size" required readonly value="{{$eOrderItem->remarks}}">
                                    </td>
                                    <td>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  min="0" autocomplete="size" required readonly value="{{$eOrderItem->unit_of_measurement}}">
                                    </td>
                                    <td>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  min="0" autocomplete="size" required readonly value="{{$eOrderItem->size}}">
                                    </td>
                                    <td>
                                        <textarea class="w-full note " style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" rows="3" readonly>{{$eOrderItem->description}}</textarea>
                                    </td>

                                    <td>
                                        @if ($eOrderItem->file_path)
                                            <a href="{{ Storage::url($eOrderItem->file_path) }}" target="_blank">
                                                <svg class="w-6 h-6 ml-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                    </path>
                                                </svg>
                                            </a>
                                        @else
                                            {{__('portal.N/A')}}
                                        @endif
                                    </td>

                                    <td>
                                        <input class="form-input rounded-md shadow-sm  w-full quantity" id="quantity_id" type="number"
                                               name="quote_quantity[]" min="0" step="any" autocomplete="quantity" required readonly placeholder="Qty" value="{{$eOrderItem->quantity}}" >
                                    </td>

                                    <td>
                                        <input class="form-input rounded-md shadow-sm  w-full price_per_unit" id="price_per_unit_id" type="number"
                                               name="quote_price_per_quantity[]"  min="0" step="any" autocomplete="price_per_unit" required>
                                        {{--                                    <span class="text-red-800 priceError" style="display: none">Required</span>--}}
                                    </td>

                                    <td>
                                        <textarea name="note_for_customer[]" id="note_for_customer" class="w-full note " style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Note (if any)')}}"></textarea>
                                    </td>

                                </tr>
                                {{--@if($eOrderItem->required_sample == 'Yes')
                                    <tr>
                                        <td colspan="9">
                                            <p class="py-2 font-bold text-center text-2xl">Sample Information {{$loop->iteration}}</p>
                                            <div class="flex flex-wrap overflow-hidden xl:-mx-1">
                                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                        Samples
                                                    </label>
                                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="sample_information[]"  min="0" step="any" autocomplete="size" required>
                                                </div>
                                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                        Sample Unit
                                                    </label>
                                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_unit[]"  min="0" autocomplete="size" required>
                                                </div>
                                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                        Quantity
                                                    </label>
                                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_security_charges[]"  min="0" autocomplete="size" required>
                                                </div>
                                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                        Sample Charges Per Unit
                                                    </label>
                                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_charges_per_unit[]"  min="0" autocomplete="size" required>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endif--}}
                            @endforeach

                            <tr class="mt-2">
                                <td colspan="9">
                                    {{--                                <div class="flex flex-wrap overflow-hidden xl:-mx-1">--}}
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">{{__('portal.Shipment Time (In Days)')}}</label>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="shipping_time_in_days" type="number" name="shipping_time_in_days"  min="0" step="any" autocomplete="size" required placeholder="{{__('portal.Shipment Time')}}" >
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">{{__('portal.Shipment Cost')}}</label>
                                        <input class="form-input rounded-md shadow-sm block w-full shipment_cost" id="ship_cost" type="number" name="shipment_cost"  min="0" step="any" autocomplete="size" required placeholder="{{__('portal.Shipment Cost')}}" >
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">{{__('portal.VAT (in %)')}}</label>
                                        <input class="form-input rounded-md shadow-sm block w-full VAT" id="VAT" type="number" name="VAT" min="0" max="15"  autocomplete="size" required placeholder="{{__('portal.VAT (in %)')}}">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">{{__('portal.Total Cost')}}</label>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="total_cost" type="number" name="total_cost" autocomplete="size" readonly placeholder="{{__('portal.Total Cost')}}">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <a style="cursor: pointer" id="totalCost" @if(count($eOrderItems) == 1) onclick="calculateCostForSingleItemInSingleCategory()" @else onclick="calculateCost()" @endif class="ml-2 px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ">
                                            {{__('portal.Calculate Total Cost')}}
                                        </a>
                                    </div>
                                    {{--                                </div>--}}
                                </td>
                            </tr>

                            <tr style="border: none !important;">
                                <td colspan="6" class="px-10 text-left">
                                    <button class="px-4 float-right py-2 mt-4 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                        {{__('portal.Send Quote')}}
                                    </button>
                                    <br>
                                    <a href="{{ route('singleCategoryRFQs') }}" class="inline-flex items-center px-4 mr-2 py-2 mb-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                        {{__('portal.Back')}}
                                    </a>
                                </td>
                            </tr>
                        </form>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </x-app-layout>
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

            input ,.note
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
                            {{-- <img src="{{ Storage::url(Auth::user()->business->business_photo_url) }}" alt="logo"
                            style="height: 80px;width: 200px;" /> --}}
                            <img src="{{ url('imp_img.jpg') }}" alt="logo" style="height: 80px;width: 200px;" />
                        </div>
                        @php
                            $user_business_details=auth()->user()->business;
                        @endphp
                        <div class="my-5 pl-5 ">
                            <h1 class="font-extrabold color-1f3864 text-xl ">{{$user_business_details->business_name}}</h1>
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
                                <strong>{{__('portal.Buyer Name')}}:</strong> {{$eOrderItems[0]->business->business_name}}
                                <br>
                                <strong>{{__('portal.Requisition')}} #:</strong> {{__('portal.Emdad')}}-{{$eOrderItems[0]->e_order_id}}
                                <br>
                                <strong>{{__('portal.User Quoted')}}:</strong> {{$eOrderItems[0]->user->name}}
                                <br>
                                <strong>{{__('portal.Category Code')}}: </strong> {{$eOrderItems[0]->item_code}}
                                <br>
                                <strong>{{__('portal.Category Name')}}: </strong>
                                {{ \App\Models\Category::where('id', $eOrderItems[0]->item_code)->first()->name_ar }} / {{ \App\Models\Category::where('id',(\App\Models\Category::where('id',$eOrderItems[0]->item_code)->first()->parent_id))->first()->name_ar }}
                                <br>
                                <strong>{{__('portal.Payment Mode')}}: </strong>
                                    @if($eOrderItems[0]->payment_mode == 'Cash') {{__('portal.Cash')}}
                                    @elseif($eOrderItems[0]->payment_mode == 'Credit') {{__('portal.Credit')}}
                                    @elseif($eOrderItems[0]->payment_mode == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                    @elseif($eOrderItems[0]->payment_mode == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                    @elseif($eOrderItems[0]->payment_mode == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                    @elseif($eOrderItems[0]->payment_mode == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                    @endif
                            </div>
                        </div>
                        <div class="Right-info_holder flex-1">
                            <div class="my-5 pl-5 ">
                                <span class="font-bold text-lg color-1f3864">{{__('portal.Shipping Information')}}</span>
                                <hr style="border-top: 1px solid gray;width: 25%;">
                            </div>
                            <div class="my-5 pl-5 ">

                                <strong>{{__('portal.Delivery Period')}}: </strong>
                                @if ($eOrderItems[0]->delivery_period =='Immediately') {{__('portal.Immediately')}} @endif
                                @if ($eOrderItems[0]->delivery_period =='Within 30 Days') {{__('portal.30 Days')}} @endif
                                @if ($eOrderItems[0]->delivery_period =='Within 60 Days') {{__('portal.60 Days')}} @endif
                                @if ($eOrderItems[0]->delivery_period =='Within 90 Days') {{__('portal.90 Days')}} @endif
                                @if ($eOrderItems[0]->delivery_period =='Standing Order - 2 per year' ) {{__('portal.Standing Order - 2 times / year')}} @endif
                                @if ($eOrderItems[0]->delivery_period =='Standing Order - 3 per year' ) {{__('portal.Standing Order - 3 times / year')}} @endif
                                @if ($eOrderItems[0]->delivery_period =='Standing Order - 4 per year' ) {{__('portal.Standing Order - 4 times / year')}} @endif
                                @if ($eOrderItems[0]->delivery_period =='Standing Order - 6 per year' ) {{__('portal.Standing Order - 6 times / year')}} @endif
                                @if ($eOrderItems[0]->delivery_period =='Standing Order - 12 per year' ) {{__('portal.Standing Order - 12 times / year')}} @endif
                                @if ($eOrderItems[0]->delivery_period =='Standing Order Open' ) {{__('portal.Standing Order - Open')}} @endif
                                <br>
                                <strong>{{__('portal.Delivery Address')}}: </strong> {{ $eOrderItems[0]->warehouse->address }}
                                <br>

                                <strong>{{__('portal.Required Sample')}}: </strong>
                                @if($eOrderItems[0]->required_sample == 'Yes') {{__('portal.Yes')}} @endif
                                @if($eOrderItems[0]->required_sample == 'No') {{__('portal.No')}} @endif
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
                        <th style="width:2%;">#</th>
                        <th style="width:11%;">{{__('portal.Brand')}} @include('misc.required') </th>
                        <th style="width:11%;">{{__('portal.Remarks')}} @include('misc.required') </th>
                        <th style="width:9%;">{{__('portal.UOM')}} @include('misc.required') </th>
                        <th style="width:7%;">{{__('portal.Size')}} @include('misc.required') </th>
                        <th style="width:11%;">{{__('portal.Description')}} @include('misc.required') </th>
                        <th style="width:3%;">{{__('portal.Attachments')}}</th>
                        <th style="width:7%;">{{__('portal.Quantity')}} @include('misc.required')</th>
                        <th style="width:7%;">{{__('portal.Price Per Unit')}} @include('misc.required') </th>
                        <th style="width:20%;">{{__('portal.Note')}}</th>

                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                    @if ($collection && $collection->qoute_status == 'Qouted')

                        <h2 class="text-center text-2xl">{{__('portal.You have already quoted.')}}</h2>

                    @elseif($collection && $collection->qoute_status == 'ModificationNeeded')
                        @php
                            $quote = \App\Models\QouteMessage::where('qoute_id', $collection->id )->get();
                        @endphp
                        @if(isset($quote) && $quote->isNotEmpty())

                            <div class="border-2 p-2 m-2">
                                @foreach ($quote as $msg)
                                    @php $business = \App\Models\Business::where('user_id', $msg->user_id)->first(); @endphp
                                    @php
                                        $user = \App\Models\User::where('id', $msg->user_id)->first();
                                        $business = \App\Models\Business::where('id', $user->business_id)->first();
                                    @endphp

                                    <span class="text-blue-700">
                                            <span class="text-gray-600 text-left">
                                                {{__('portal.Message from')}} {{$business->business_name}}
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
                        <form name="form" method="POST" action="{{ route('singleRFQQuotationUpdate') }}" enctype="multipart/form-data" class="rounded bg-white mt-4">
                            @csrf

                            @foreach($eOrderItems as $eOrderItem)
                                <tr>
                                    <div class="hidden_fields">
                                        <input type="hidden" name="e_order_items_id[]" value="{{ $eOrderItem->id }}">
                                        <input type="hidden" name="e_order_id" value="{{ $eOrderItem->e_order_id }}">
                                        <input type="hidden" name="business_id" value="{{ $eOrderItem->business_id }}">
                                        <input type="hidden" name="supplier_business_id" value="{{ auth()->user()->business_id }}">
                                        <input type="hidden" name="supplier_user_id" value="{{ auth()->id() }}">
                                    </div>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  min="0" autocomplete="size" required readonly value="{{$eOrderItem->brand}}">
                                    </td>
                                    <td>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  min="0" autocomplete="size" required readonly value="{{$eOrderItem->remarks}}">
                                    </td>
                                    <td>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  min="0" autocomplete="size" required readonly value="{{$eOrderItem->unit_of_measurement}}">
                                    </td>
                                    <td>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  min="0" autocomplete="size" required readonly value="{{$eOrderItem->size}}">
                                    </td>
                                    <td>
                                        <textarea class="w-full note " style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" rows="3" readonly>{{$eOrderItem->description}}</textarea>
                                    </td>

                                    <td>
                                        @if ($eOrderItem->file_path)
                                            <a href="{{ Storage::url($eOrderItem->file_path) }}" target="_blank">
                                                <svg class="w-6 h-6 ml-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                    </path>
                                                </svg>
                                            </a>
                                        @else
                                            {{__('portal.N/A')}}
                                        @endif
                                    </td>

                                    <td>
                                        <input class="form-input rounded-md shadow-sm  w-full quantity" id="quantity_id" type="number"
                                               name="quote_quantity[]" min="0" step="any" autocomplete="quantity" required readonly placeholder="{{__('portal.Qty')}}" value="{{$eOrderItem->quantity}}" >
                                    </td>

                                    <td>
                                        @php $quoteInfo = \App\Models\Qoute::where('e_order_items_id', $eOrderItem->id)->first(); @endphp
                                        <input class="form-input rounded-md shadow-sm  w-full price_per_unit" id="price_per_unit_id" type="number"
                                               name="quote_price_per_quantity[]"  min="0" step="any" autocomplete="price_per_unit" value="{{$quoteInfo->quote_price_per_quantity}}" required>
                                    </td>

                                    <td>
                                        <textarea name="note_for_customer[]" id="note_for_customer" class="w-full note " style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Note (if any)')}}">{{$quoteInfo->note_for_customer}}</textarea>
                                    </td>

                                </tr>

                                {{--@if($eOrderItem->required_sample == 'Yes')
                                    <tr>
                                        <td colspan="9">
                                            <p class="py-2 font-bold text-center text-2xl">Sample Information {{$loop->iteration}}</p>
                                            <div class="flex flex-wrap overflow-hidden xl:-mx-1">
                                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                        Samples
                                                    </label>
                                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="sample_information[]"  min="0" step="any" autocomplete="size" value="{{$quoteInfo->sample_information}}" required>
                                                </div>
                                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                        Sample Unit
                                                    </label>
                                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_unit[]"  min="0" autocomplete="size" value="{{$quoteInfo->sample_unit}}" required>
                                                </div>
                                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                        Quantity
                                                    </label>
                                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_security_charges[]"  min="0" autocomplete="size" value="{{$quoteInfo->sample_security_charges}}" required>
                                                </div>
                                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                        Sample Charges Per Unit
                                                    </label>
                                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_charges_per_unit[]"  min="0" autocomplete="size" value="{{$quoteInfo->sample_charges_per_unit}}" required>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endif--}}
                            @endforeach
                            <tr class="mt-2">
                                <td colspan="9">
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">{{__('portal.Shipment Time (In Days)')}}</label>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="shipping_time_in_days" type="number" name="shipping_time_in_days"  min="0" step="any" autocomplete="size" required value="{{$collection->shipping_time_in_days}}" placeholder="Shipment Time" >
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">{{__('portal.Shipment Cost')}}</label>
                                        <input class="form-input rounded-md shadow-sm block w-full shipment_cost" id="ship_cost" type="number" name="shipment_cost"  min="0" step="any" autocomplete="size" value="{{$collection->shipment_cost}}" required placeholder="Shipment Cost" >
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">{{__('portal.VAT (in %)')}}</label>
                                        <input class="form-input rounded-md shadow-sm block w-full VAT" id="VAT" type="number" name="VAT" min="0" max="15"  autocomplete="size" required value="{{$collection->VAT}}" placeholder="VAT (%)">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">{{__('portal.Total Cost')}}</label>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="total_cost" type="number" name="total_cost" autocomplete="size" readonly placeholder="Total Cost">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <a style="cursor: pointer" id="totalCost" @if(count($eOrderItems) == 1) onclick="calculateCostForSingleItemInSingleCategory()" @else onclick="calculateCost()" @endif class="ml-2 px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 hover:text-white active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ">
                                            {{__('portal.Calculate Total Cost')}}
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <tr style="border: none !important;">
                                <td colspan="12" class="px-10 text-left">
                                    <div class="my-4">
                                        <button class=" px-4 float-right py-2 mt-4 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                            {{__('portal.Send Updated Quotation')}}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </form>
                    @else

                        <form name="form" method="POST" action="{{ route('singleRFQQuotationStore') }}" enctype="multipart/form-data" class="rounded bg-white mt-4">
                            @csrf
                            @foreach($eOrderItems as $eOrderItem)
                                <tr>
                                    <div class="hidden_fields">
                                        <input type="hidden" name="e_order_items_id[]" value="{{ $eOrderItem->id }}">
                                        <input type="hidden" name="e_order_id" value="{{ $eOrderItem->e_order_id }}">
                                        <input type="hidden" name="business_id" value="{{ $eOrderItem->business_id }}">
                                        <input type="hidden" name="supplier_business_id" value="{{ auth()->user()->business_id}}">
                                        <input type="hidden" name="supplier_user_id" value="{{ auth()->id() }}">
                                        <input type="hidden" name="warehouse_id" value="{{ $eOrderItem->warehouse->id }}">
                                    </div>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  min="0" autocomplete="size" required readonly value="{{$eOrderItem->brand}}">
                                    </td>
                                    <td>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  min="0" autocomplete="size" required readonly value="{{$eOrderItem->remarks}}">
                                    </td>
                                    <td>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  min="0" autocomplete="size" required readonly value="{{$eOrderItem->unit_of_measurement}}">
                                    </td>
                                    <td>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  min="0" autocomplete="size" required readonly value="{{$eOrderItem->size}}">
                                    </td>
                                    <td>
                                        <textarea class="w-full note " style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" rows="3" readonly>{{$eOrderItem->description}}</textarea>
                                    </td>

                                    <td>
                                        @if ($eOrderItem->file_path)
                                            <a href="{{ Storage::url($eOrderItem->file_path) }}" target="_blank">
                                                <svg class="w-6 h-6 ml-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                    </path>
                                                </svg>
                                            </a>
                                        @else
                                            {{__('portal.N/A')}}
                                        @endif
                                    </td>

                                    <td>
                                        <input class="form-input rounded-md shadow-sm  w-full quantity" id="quantity_id" type="number"
                                               name="quote_quantity[]" min="0" step="any" autocomplete="quantity" required readonly placeholder="Qty" value="{{$eOrderItem->quantity}}" >
                                    </td>

                                    <td>
                                        <input class="form-input rounded-md shadow-sm  w-full price_per_unit" id="price_per_unit_id" type="number"
                                               name="quote_price_per_quantity[]"  min="0" step="any" autocomplete="price_per_unit" required>
                                        {{--                                    <span class="text-red-800 priceError" style="display: none">Required</span>--}}
                                    </td>

                                    <td>
                                        <textarea name="note_for_customer[]" id="note_for_customer" class="w-full note " style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Note (if any)')}}"></textarea>
                                    </td>

                                </tr>
                                {{--@if($eOrderItem->required_sample == 'Yes')
                                    <tr>
                                        <td colspan="9">
                                            <p class="py-2 font-bold text-center text-2xl">Sample Information {{$loop->iteration}}</p>
                                            <div class="flex flex-wrap overflow-hidden xl:-mx-1">
                                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                        Samples
                                                    </label>
                                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="sample_information[]"  min="0" step="any" autocomplete="size" required>
                                                </div>
                                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                        Sample Unit
                                                    </label>
                                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_unit[]"  min="0" autocomplete="size" required>
                                                </div>
                                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                        Quantity
                                                    </label>
                                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_security_charges[]"  min="0" autocomplete="size" required>
                                                </div>
                                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                        Sample Charges Per Unit
                                                    </label>
                                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_charges_per_unit[]"  min="0" autocomplete="size" required>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endif--}}
                            @endforeach

                            <tr class="mt-2">
                                <td colspan="9">
                                    {{--                                <div class="flex flex-wrap overflow-hidden xl:-mx-1">--}}
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">{{__('portal.Shipment Time (In Days)')}}</label>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="shipping_time_in_days" type="number" name="shipping_time_in_days"  min="0" step="any" autocomplete="size" required placeholder="{{__('portal.Shipment Time')}}" >
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">{{__('portal.Shipment Cost')}}</label>
                                        <input class="form-input rounded-md shadow-sm block w-full shipment_cost" id="ship_cost" type="number" name="shipment_cost"  min="0" step="any" autocomplete="size" required placeholder="{{__('portal.Shipment Cost')}}" >
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">{{__('portal.VAT (in %)')}}</label>
                                        <input class="form-input rounded-md shadow-sm block w-full VAT" id="VAT" type="number" name="VAT" min="0" max="15"  autocomplete="size" required placeholder="{{__('portal.VAT (in %)')}}">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">{{__('portal.Total Cost')}}</label>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="total_cost" type="number" name="total_cost" autocomplete="size" readonly placeholder="{{__('portal.Total Cost')}}">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/4 p-2">
                                        <a style="cursor: pointer" id="totalCost" @if(count($eOrderItems) == 1) onclick="calculateCostForSingleItemInSingleCategory()" @else onclick="calculateCost()" @endif class="ml-2 px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 hover:text-white active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ">
                                            {{__('portal.Calculate Total Cost')}}
                                        </a>
                                    </div>
                                    {{--                                </div>--}}
                                </td>
                            </tr>

                            <tr style="border: none !important;">
                                <td colspan="6" class="px-10 text-left">
                                    <button class="px-4 float-right py-2 mt-4 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                        {{__('portal.Send Quote')}}
                                    </button>
                                    <br>
                                    <a href="{{ route('singleCategoryRFQs') }}" class="inline-flex items-center px-4 mr-2 py-2 mb-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 hover:text-white active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                        {{__('portal.Back')}}
                                    </a>
                                </td>
                            </tr>
                        </form>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </x-app-layout>
@endif

<script>

    /* Creating array for quantities and prices */
    function creatingArrayFunction(value, index, array) {
        return value;
    }

    function calculateCostForSingleItemInSingleCategory()
    {

        let quantity =$('#quantity_id').val();

        let ppu= $("#price_per_unit_id").val();
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

    function calculateCost()
    {
        let quantityArray = [] ;
        let priceArray = [] ;
        // Array.from(document.form.elements["quote_quantity"], function(elem) {
        //     quantityArray += elem.value + ',';
        // });
        // Array.from(document.form.elements["price_per_unit"], function(elem) {
        //     priceArray += elem.value + ',';
        // });

        Array.from(document.form.elements["quantity_id"], function(elem) {
            quantityArray += elem.value + ',';
        });
        Array.from(document.form.elements["price_per_unit_id"], function(elem) {
            priceArray += elem.value + ',';
        });


        /!* Arranging array for quantities array *!/
        let removedCommaArray = quantityArray.replace(/,(?=\s*$)/, '');
        const arrayItems = removedCommaArray.split(',');
        const quantityItemsArray = arrayItems.map(creatingArrayFunction);

        /!* Arranging array for prices array *!/
        let removedPriceCommaArray = priceArray.replace(/,(?=\s*$)/, '');
        const priceArrayItems = removedPriceCommaArray.split(',');
        const priceItemsArray = priceArrayItems.map(creatingArrayFunction);

        let ship_cost= $("#ship_cost").val();
        let VAT= $("#VAT").val();
        $.ajax({
            type : 'GET',
            url:"{{ route('singleTotalCost') }}",
            data:{
                'quantities':quantityItemsArray,
                'prices':priceItemsArray,
                'VAT':VAT,
                'shipment_cost':ship_cost,
            },
            success: function (response) {
                $('#total_cost').val(response.data);
            }
        });

        // Clearing Total Cost Field on any mentioned fields changed
        $(document).on('keydown', '.quantity, .price_per_unit, .VAT, .shipment_cost', function(){

            $('#total_cost').val('');
        });

    }
</script>
