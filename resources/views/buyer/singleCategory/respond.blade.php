@if (auth()->user()->rtl == 0)
    <x-app-layout>
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
        @if (session()->has('error'))
            <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('error') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <div class="flex flex-wrap overflow-hidden xl:-mx-1 p-4 rounded">
            <div class="w-full overflow-hidden lg:w-3/6 xl:my-1 xl:px-1 xl:w-3/6">
                <div class="mt-5">
                    <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                        {{__('portal.Go Back')}}
                    </a>
                </div>
            </div>
            <div class="w-full overflow-hidden lg:w-3/6 xl:my-1 xl:px-1 xl:w-3/6">
                <div class="mt-5 lg:float-right">
                    <a href="{{ route('singleCategoryQuotationPDF', [ 'quote_supplier_business_id' => encrypt($quotes[0]['supplier_business_id']), 'e_order_id' => encrypt($quotes[0]['e_order_id'])]) }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none active:bg-red-600 transition ease-in-out duration-150">
                        {{__('portal.Create PDF')}}
                    </a>
                </div>
            </div>
        </div>
        <div class="flex flex-col bg-white rounded mt-2">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg p-4">

                        <div class="mt-5 d-flex">
                            <div>
                                <h2 class="text-center text-2xl font-bold py-2 text-center">{{__('portal.Quotation')}}</h2>
                            </div>

                            <div>
                                <h2 class="text-left lg:text-2xl font-bold py-2">
                                    {{__('portal.Status')}}:
                                    @if ($quotes[0]->qoute_status == 'Modified')
                                        <span class="overflow-hidden xl:-mx-1 rounded shadow-md bg-gray-400">{{__('portal.You have asked for a modification for this quotation.')}}</span>
                                    @elseif($quotes[0]->qoute_status == 'Qouted')
                                        <span class="overflow-hidden xl:-mx-1 rounded shadow-md bg-yellow-400">{{__('portal.Waiting for response')}}.</span>
                                    @elseif($quotes[0]->qoute_status == 'Rejected')
                                        <span class="overflow-hidden xl:-mx-1 rounded shadow-md bg-red-600">{{__('portal.You have rejected this quotation.')}}</span>
                                    @endif
                                </h2>
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden xl:-mx-1 p-4 rounded shadow-md bg-gray-200 ">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <strong>{{__('portal.Category Name')}}:</strong>
                                @php
                                    $record = \App\Models\Category::where('id',$quotes[0]->orderItem->item_code)->first();
                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                @endphp
                                {{ $record->name }} @if(isset($parent)), {{$parent->name}} @endif
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <strong>{{__('portal.Shipping Time In Days')}}:</strong> {{ $quotes[0]->shipping_time_in_days }}
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <strong>{{__('portal.Shipment Cost')}}:</strong> {{ $quotes[0]->shipment_cost }} {{__('portal.SAR')}}
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <strong>{{__('portal.VAT')}} (%):</strong> {{ $quotes[0]->VAT }}
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <strong>{{__('portal.Total Cost')}}:</strong> {{ $quotes[0]->total_cost }} {{__('portal.SAR')}}
                            </div>
                        </div>


                        @foreach($quotes as $quote)
                            <div class="flex flex-wrap overflow-hidden xl:-mx-1 p-4 rounded shadow-md ">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <strong>{{__('portal.Sr #')}} : {{ $loop->iteration }}</strong>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <strong>{{__('portal.Quote Quantity')}}:</strong> {{ $quote->quote_quantity }}
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <strong>{{__('portal.Quote Price Per Quantity')}}:</strong> {{ $quote->quote_price_per_quantity }}
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <strong>{{__('portal.Quote Description')}}:</strong> {{ $quote->orderItem->description }}
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <strong>{{__('portal.Note')}}:</strong> {{ strip_tags($quote->note_for_customer) }}
                                </div>
                            </div>
                        @endforeach

                        {{-- Retrieving eOrderItemsID in qoute_id while Storing Supplier message and Retrieving QuoteID in qoute_id while storing Buyer message --}}
                        @php
                            $quote = \App\Models\QouteMessage::where('qoute_id', $quotes[0]->e_order_items_id)->where('user_id', '!=', auth()->id())->get();
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
                                            {{__('portal.Message from')}} {{$business->business_name}}
                                        </span>
                                        : {{strip_tags(str_replace('&nbsp;', ' ',  $msg->message))}}
                                    </span>
                                    <br> <br>
                                @endforeach
                            </div>
                            <br>
                        @endif
                        <hr>

                        @if($quotes[0]->messages->isNotEmpty())
                            <div class="border-2 p-2 m-2">
                                @foreach ($quotes[0]->messages as $msg)
                                    <span class="text-blue-600">{{__('portal.Message you send')}}</span>  : {{ strip_tags(str_replace('&nbsp;', ' ',  $msg->message)) }} <br> <br>
                                @endforeach
                            </div>
                        @endif

                        <hr>
                        <form action="{{ route('QuotationMessage.store') }}" class="rounded shadow-md" method="post">
                            @csrf
                            @php $business = \App\Models\Business::where('user_id', $quotes[0]->supplier_user_id)->first(); @endphp
                            <h1 class="text-center text-2xl mt-4">{{__('portal.Message to')}} <span class="text-blue-600">{{$business->business_name}}</span>
                                <span style="font-size: 20px;">({{__('portal.supplier')}})</span></h1>
                            <textarea name="message" id="message" class="w-full" style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Message')}}..." required></textarea>
                            <x-jet-input-error for="message" class="mt-2" />
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="qoute_id" value="{{ $quotes[0]->id }}">
                            <input type="hidden" name="usertype" value="{{ $quotes[0]->business->business_type }}">

                            <br>

                            <div class="justify-between p-2 m-2">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
                                    {{__('portal.Send')}}
                                </button>
                            </div>
                            <br>
                        </form>

                        <br>
                        <div class="justify-between p-2 m-2">

                            <a href="{{ route('singleCategoryRFQUpdateStatusModificationNeeded', $quotes[0]) }}" class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-800 transition ease-in-out duration-150">
                                {{__('portal.Quote Again')}}
                            </a>

                            <a href="{{ route('singleCategoryRFQUpdateStatusRejected', $quotes[0]) }}" style="margin-left: 70px; margin-top: 20px;" class="inline-flex items-center justify-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-800 transition ease-in-out duration-150">
                                {{__('portal.Reject Quotation')}}
                            </a>
                        </div>

                        <br>

                        <h1 class="text-2xl text-center font-bold mb-2 mt-2 text-red-700">{{__('portal.If you want to accept request please fill out below form.')}}</h1>
                        <br>
                        <form action="{{ route('singleCategoryQuoteAccepted') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="business_id" value="{{ auth()->user()->business_id }}">

                            <input type="hidden" name="supplier_user_id" value="{{ $quotes[0]->supplier_user_id }}">
                            <input type="hidden" name="supplier_business_id" value="{{ $quotes[0]->supplier_business_id }}">

                            <input type="hidden" name="e_order_id" value="{{ $quotes[0]->e_order_id }}">

                            <input type="hidden" name="item_code" value="{{ $quotes[0]->orderItem->item_code }}">
                            <input type="hidden" name="item_name" value="{{ $quotes[0]->orderItem->item_name }}">
                            <input type="hidden" name="delivery_time" value="{{ $quotes[0]->shipping_time_in_days }}">

                            <input type="hidden" name="warehouse_id" value="{{ $quotes[0]->warehouse_id }}">
                            <input type="hidden" name="shipment_cost" value="{{ $quotes[0]->shipment_cost }}">
                            <input type="hidden" name="vat" value="{{ $quotes[0]->VAT }}">
                            <input type="hidden" name="total_cost" value="{{ $quotes[0]->total_cost }}">

                            <x-jet-label for="warehouse" class="my-2" value="{{ __('portal.Warehouse delivery address') }}" class="text-black"  />

                            @php
                                $orderItemID =  \App\Models\EOrderItems::where('id', $quotes[0]->e_order_items_id)->first();
                                $warehouseAddress = \App\Models\BusinessWarehouse::where('id', $orderItemID->warehouse_id)->first();
                            @endphp
                            <input type="text" name="delivery_address" class="form-input rounded-md shadow-sm border p-2 w-full" readonly value="{{$warehouseAddress->address}}">
                            <br>
                            <br>
                            <x-jet-label for="otp_mobile_number" value="{{ __('portal.OTP FOR Receiving Delivery Mobile Number (We will send One Time Password when you receive delivery)') }}" class="text-center text-black font-bold text-red-600"  />
                            <input type="text" name="otp_mobile_number" class="form-input rounded-md shadow-sm border p-2 w-full" value="{{$warehouseAddress->mobile}}">
                            <br>
                            <br>
                            <input type="text" class="form-input rounded-md shadow-sm border p-2 w-full" name="address" value="{{$warehouseAddress->address}}" readonly>

                            <x-jet-label for="Remarks" value="{{ __('portal.Remarks') }}" class="text-black"  />
                            <textarea name="remarks" id="remarks" class="w-full" style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Remarks')}}.."></textarea>

                            <x-jet-label for="payment_term" class="my-2" value="{{ __('portal.Payment Term') }}" class="text-black"  />
                            <select name="payment_term" id="payment_term" class="form-input rounded-md shadow-sm border p-2 w-full" readonly>
                                @if ($quotes[0]->orderItem->payment_mode == 'Cash')
                                    <option selected value="Cash">{{__('portal.Cash')}}</option>
                                @else
                                    <option selected value="Credit">{{__('portal.Credit')}}</option>
                                @endif
                            </select>

                            <div class="mt-5 d-flex">
                                <div style="display: inline">
                                    <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                        {{__('portal.Go Back')}}
                                    </a>
                                </div>
                                <div style="display: inline">
                                    <input type="submit" value="{{__('portal.Accept')}}" style="cursor: pointer" class="inline-flex items-center justify-center px-4 my-5 py-2 bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-800 transition ease-in-out duration-150">
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </x-app-layout>
@else
    <x-app-layout>
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
        @if (session()->has('error'))
            <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('error') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        {{--<div class="mt-5">
            <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                {{__('portal.Go Back')}}
            </a>
        </div>--}}
        <div class="flex flex-wrap overflow-hidden xl:-mx-1 p-4 rounded">
            <div class="w-full overflow-hidden lg:w-3/6 xl:my-1 xl:px-1 xl:w-3/6">
                <div class="mt-5">
                    <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                        {{__('portal.Go Back')}}
                    </a>
                </div>
            </div>
            <div class="w-full overflow-hidden lg:w-3/6 xl:my-1 xl:px-1 xl:w-3/6">
                <div class="mt-5 lg:float-left">
                    <a href="{{ route('singleCategoryQuotationPDF', [ 'quote_supplier_business_id' => encrypt($quotes[0]['supplier_business_id']), 'e_order_id' => encrypt($quotes[0]['e_order_id'])]) }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none active:bg-red-600 transition ease-in-out duration-150">
                        {{__('portal.Create PDF')}}
                    </a>
                </div>
            </div>
        </div>
        <div class="flex flex-col bg-white rounded mt-2">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg p-4">

                        <div class="mt-5 d-flex">
                            <div>
                                <h2 class="text-center text-2xl font-bold py-2 text-center">{{__('portal.Quotation')}}</h2>
                            </div>

                            <div>
                                <h2 class="text-right lg:text-2xl font-bold py-2">
                                    {{__('portal.Status')}}:
                                    @if ($quotes[0]->qoute_status == 'Modified')
                                        <span class="overflow-hidden xl:-mx-1 rounded shadow-md bg-gray-400">{{__('portal.You have asked for a modification for this quotation.')}}</span>
                                    @elseif($quotes[0]->qoute_status == 'Qouted')
                                        <span class="overflow-hidden xl:-mx-1 rounded shadow-md bg-yellow-400">{{__('portal.Waiting for response')}}.</span>
                                    @elseif($quotes[0]->qoute_status == 'Rejected')
                                        <span class="overflow-hidden xl:-mx-1 rounded shadow-md bg-red-600">{{__('portal.You have rejected this quotation.')}}</span>
                                    @endif
                                </h2>
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden xl:-mx-1 p-4 rounded shadow-md bg-gray-200 ">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <strong>{{__('portal.Category Name')}}:</strong>
                                @php
                                    $record = \App\Models\Category::where('id',$quotes[0]->orderItem->item_code)->first();
                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                @endphp
                                {{ $record->name_ar }} @if(isset($parent)), {{$parent->name_ar}} @endif
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <strong>{{__('portal.Shipping Time In Days')}}:</strong> {{ $quotes[0]->shipping_time_in_days }}
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <strong>{{__('portal.Shipment Cost')}}:</strong> {{ $quotes[0]->shipment_cost }} {{__('portal.SAR')}}
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <strong>{{__('portal.VAT')}} (%):</strong> {{ $quotes[0]->VAT }}
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <strong>{{__('portal.Total Cost')}}:</strong> {{ $quotes[0]->total_cost }} {{__('portal.SAR')}}
                            </div>
                        </div>


                        @foreach($quotes as $quote)
                            <div class="flex flex-wrap overflow-hidden xl:-mx-1 p-4 rounded shadow-md ">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <strong>{{__('portal.Sr #')}} : {{ $loop->iteration }}</strong>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <strong>{{__('portal.Quote Quantity')}}:</strong> {{ $quote->quote_quantity }}
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <strong>{{__('portal.Quote Price Per Quantity')}}:</strong> {{ $quote->quote_price_per_quantity }}
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <strong>{{__('portal.Quote Description')}}:</strong> {{ $quote->orderItem->description }}
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <strong>{{__('portal.Note')}}:</strong> {{ strip_tags($quote->note_for_customer) }}
                                </div>
                            </div>
                        @endforeach

                        {{-- Retrieving eOrderItemsID in qoute_id while Storing Supplier message and Retrieving QuoteID in qoute_id while storing Buyer message --}}
                        @php
                            $quote = \App\Models\QouteMessage::where('qoute_id', $quotes[0]->e_order_items_id)->where('user_id', '!=', auth()->id())->get();
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
                                        <span class="text-blue-700 text-left" style="float: right">
                                            {{__('portal.Message from')}} {{$business->business_name}}
                                        </span>
                                        : {{strip_tags(str_replace('&nbsp;', ' ',  $msg->message))}}
                                    </span>
                                    <br> <br>
                                @endforeach
                            </div>
                            <br>
                        @endif
                        <hr>

                        @if($quotes[0]->messages->isNotEmpty())
                            <div class="border-2 p-2 m-2">
                                @foreach ($quotes[0]->messages as $msg)
                                    <span class="text-blue-600">{{__('portal.Message you send')}}</span>  : {{ strip_tags(str_replace('&nbsp;', ' ',  $msg->message)) }} <br> <br>
                                @endforeach
                            </div>
                        @endif

                        <hr>
                        <form action="{{ route('QuotationMessage.store') }}" class="rounded shadow-md" method="post">
                            @csrf
                            @php $business = \App\Models\Business::where('user_id', $quotes[0]->supplier_user_id)->first(); @endphp
                            <h1 class="text-center text-2xl mt-4">{{__('portal.Message to')}} <span class="text-blue-600">{{$business->business_name}}</span>
                                <span style="font-size: 20px;">({{__('portal.supplier')}})</span></h1>
                            <textarea name="message" id="message" class="w-full" style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Message')}}..." required></textarea>
                            <x-jet-input-error for="message" class="mt-2" />
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="qoute_id" value="{{ $quotes[0]->id }}">
                            <input type="hidden" name="usertype" value="{{ $quotes[0]->business->business_type }}">

                            <br>

                            <div class="justify-between p-2 m-2">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
                                    {{__('portal.Send')}}
                                </button>
                            </div>
                            <br>
                        </form>

                        <br>
                        <div class="justify-between p-2 m-2">

                            <a href="{{ route('singleCategoryRFQUpdateStatusModificationNeeded', $quotes[0]) }}" class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 hover:text-white focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-800 transition ease-in-out duration-150">
                                {{__('portal.Quote Again')}}
                            </a>

                            <a href="{{ route('singleCategoryRFQUpdateStatusRejected', $quotes[0]) }}" style="margin-left: 70px; margin-top: 20px;" class="inline-flex items-center justify-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-800 transition ease-in-out duration-150">
                                {{__('portal.Reject Quotation')}}
                            </a>
                        </div>

                        <br>

                        <h1 class="text-2xl text-center font-bold mb-2 mt-2 text-red-700">{{__('portal.If you want to accept request please fill out below form.')}}</h1>
                        <br>
                        <form action="{{ route('singleCategoryQuoteAccepted') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="business_id" value="{{ auth()->user()->business_id }}">

                            <input type="hidden" name="supplier_user_id" value="{{ $quotes[0]->supplier_user_id }}">
                            <input type="hidden" name="supplier_business_id" value="{{ $quotes[0]->supplier_business_id }}">

                            <input type="hidden" name="e_order_id" value="{{ $quotes[0]->e_order_id }}">

                            <input type="hidden" name="item_code" value="{{ $quotes[0]->orderItem->item_code }}">
                            <input type="hidden" name="item_name" value="{{ $quotes[0]->orderItem->item_name }}">
                            <input type="hidden" name="delivery_time" value="{{ $quotes[0]->shipping_time_in_days }}">

                            <input type="hidden" name="warehouse_id" value="{{ $quotes[0]->warehouse_id }}">
                            <input type="hidden" name="shipment_cost" value="{{ $quotes[0]->shipment_cost }}">
                            <input type="hidden" name="vat" value="{{ $quotes[0]->VAT }}">
                            <input type="hidden" name="total_cost" value="{{ $quotes[0]->total_cost }}">

                            <x-jet-label for="warehouse" class="my-2" value="{{ __('portal.Warehouse delivery address') }}" class="text-black"  />

                            @php
                                $orderItemID =  \App\Models\EOrderItems::where('id', $quotes[0]->e_order_items_id)->first();
                                $warehouseAddress = \App\Models\BusinessWarehouse::where('id', $orderItemID->warehouse_id)->first();
                            @endphp
                            <input type="text" name="delivery_address" class="form-input rounded-md shadow-sm border p-2 w-full" readonly value="{{$warehouseAddress->address}}">
                            <br>
                            <br>
                            <x-jet-label for="otp_mobile_number" value="{{ __('portal.OTP FOR Receiving Delivery Mobile Number (We will send One Time Password when you receive delivery)') }}" class="text-center text-black font-bold text-red-600"  />
                            <input type="text" name="otp_mobile_number" class="form-input rounded-md shadow-sm border p-2 w-full" value="{{$warehouseAddress->mobile}}">
                            <br>
                            <br>
                            <input type="text" class="form-input rounded-md shadow-sm border p-2 w-full" name="address" value="{{$warehouseAddress->address}}" readonly>

                            <x-jet-label for="Remarks" value="{{ __('portal.Remarks') }}" class="text-black"  />
                            <textarea name="remarks" id="remarks" class="w-full" style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Remarks')}}.."></textarea>

                            <x-jet-label for="payment_term" class="my-2" value="{{ __('portal.Payment Term') }}" class="text-black"  />
                            <select name="payment_term" id="payment_term" class="form-input rounded-md shadow-sm border p-2 w-full" readonly>
                                @if ($quotes[0]->orderItem->payment_mode == 'Cash')
                                    <option selected value="Cash">{{__('portal.Cash')}}</option>
                                @else
                                    <option selected value="Credit">{{__('portal.Credit')}}</option>
                                @endif
                            </select>

                            <div class="mt-5 d-flex">
                                <div style="display: inline">
                                    <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                        {{__('portal.Go Back')}}
                                    </a>
                                </div>
                                <div style="display: inline">
                                    <input type="submit" value="{{__('portal.Accept')}}" style="cursor: pointer" class="inline-flex items-center justify-center px-4 my-5 py-2 bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-800 transition ease-in-out duration-150">
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </x-app-layout>
@endif
