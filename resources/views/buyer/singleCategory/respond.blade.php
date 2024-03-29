@if (auth()->user()->rtl == 0)

@section('headerScripts')
    <style>
        @media (min-width: 600px) {
            .scroll-bar-for-large-screen{
                overflow-x:hidden !important;
            }
        }
    </style>
@endsection

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>
        @if (session()->has('message'))
            <div class="block mt-2 text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="block mt-2 text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-">{{ session('error') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif

        <div class="-my-2 overflow-x-auto sm:overflow-hidden lg:-mx-8 scroll-bar-for-large-screen">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                        <div class="bg-white overflow-hidden shadow-xl ">
                            <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                                <a href="{{ route('singleCategoryQuotationPDF', [ 'quote_supplier_business_id' => encrypt($quotes[0]['supplier_business_id']), 'e_order_id' => encrypt($quotes[0]['e_order_id'])]) }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                    {{__('portal.Create PDF')}}
                                </a>
                            </div>
                            <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                                <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($quotes[0]->buyer_business->business_photo_url) }}"  />--}}
{{--                                        <h1 class="text-center text-2xl">{{ $quotes[0]->buyer_business->business_name }}</h1>--}}
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <img class="h-20 w-30 object-cover mx-auto" src="{{ Storage::url($quotes[0]->supplier_business->business_photo_url) }}" style="border-radius: 9px;"/>
                                        <h1 class="text-center text-3xl">{{__('portal.Quotation')}}</h1>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($quotes[0]->supplier_business->business_photo_url) }}" />--}}
{{--                                        <h1 class="text-center text-2xl">{{ $quotes[0]->supplier_business->business_name }}</h1>--}}
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden">
                                        <h1 class="text-center text-3xl">{{__('portal.Status')}}:
                                            @if ($quotes[0]->qoute_status == 'Modified')
                                                <span class="bg-gray-400">{{__('portal.You have asked for a modification for this quotation.')}}</span>
                                            @elseif($quotes[0]->qoute_status == 'Qouted')
                                                <span class="bg-yellow-400">{{__('portal.Waiting for response')}}.</span>
                                            @elseif($quotes[0]->qoute_status == 'Rejected')
                                                <span class="bg-red-600">{{__('portal.You have rejected this quotation.')}}</span>
                                            @endif
                                        </h1>
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                        <strong>{{__('portal.Supplier')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $quotes[0]->supplier_business->business_name }}<br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $quotes[0]->supplier_business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $quotes[0]->supplier_business->vat_reg_certificate_number }}</span><br>
                                        <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $quotes[0]->supplier_business->business_email }}</span><br><br>

                                        <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $quotes[0]->id }}<br>
                                        <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $quotes[0]->orderItem->id }}<br>
                                        <strong>{{__('portal.Shipment Time')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> {{ $quotes[0]->shipping_time_in_days }}<br>
                                        <strong>{{__('portal.Payment Term')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                        @if($quotes[0]->orderItem->payment_mode == 'Cash') {{__('portal.Cash')}}
                                        @elseif($quotes[0]->orderItem->payment_mode == 'Credit') {{__('portal.Credit')}}
                                        @elseif($quotes[0]->orderItem->payment_mode == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                        @elseif($quotes[0]->orderItem->payment_mode == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                        @elseif($quotes[0]->orderItem->payment_mode == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                        @elseif($quotes[0]->orderItem->payment_mode == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                        @endif
                                    </div>
                                    {{--<div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <strong>{{__('portal.Supplier')}}: </strong><br>
                                        <p>{{ $quotes[0]->supplier_business->business_name }}</p><br>

                                        <strong>{{__('portal.City')}}: </strong><span>{{ $quotes[0]->supplier_business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: </strong><span>{{ $quotes[0]->supplier_business->vat_reg_certificate_number }}</span><br>
                                    </div>--}}
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                        <img src="{{ Storage::url($quotes[0]->buyer_business->business_photo_url) }}" alt="{{ $quotes[0]->buyer_business->business_name }}" style="height: 95px;"/>
                                        <strong>{{__('portal.Buyer')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $quotes[0]->buyer_business->business_name }}<br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $quotes[0]->buyer_business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $quotes[0]->buyer_business->vat_reg_certificate_number }}</span><br>
                                        @php
                                            $warehouse = \App\Models\BusinessWarehouse::where('id', $quotes[0]->warehouse_id)->first()->only('mobile', 'warehouse_name');
                                        @endphp
                                        <strong>{{__('portal.Contact #')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $warehouse['mobile'] }}</span><br>
                                        <strong>{{__('portal.Warehouse for delivery')}}: &nbsp;&nbsp;</strong><span>{{ $warehouse['warehouse_name'] }}</span><br>
                                    </div>
                                </div>

                                {{--<div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-screen">
                                        <strong class="text-xl">{{__('portal.Category Name')}}: </strong>
                                        @php
                                            $record = \App\Models\Category::where('id',$quotes[0]->orderItem->item_code)->first();
                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                        @endphp
                                        <span class="text-xl text-blue-600">{{ $record->name }}@if(isset($parent)), {{ $parent->name }} @endif</span>
                                    </div>
                                </div>--}}

                                <table class="min-w-full divide-y divide-black">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            #
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Category Name')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Description')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Note')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.UOM')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Unit Price')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Quantity')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Amount')}}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-black border-1 border-black">
                                    @foreach($quotes as $quote)
                                        <tr>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                {{$loop->iteration}}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                @php
                                                    $record = \App\Models\Category::where('id',$quote->orderItem->item_code)->first();
                                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                @endphp
                                                {{ $record->name }}@if(isset($parent)), {{ $parent->name }} @endif
                                            </td>
                                            <td class="px-2 py-2 text-sm text-black border border-black">
                                                {{ $quote->orderItem->description }}
                                            </td>
                                            <td class="px-2 py-2 text-sm text-black border border-black">
                                                @if(isset($quote->note_for_customer)) {{ strip_tags($quote->note_for_customer) }} @else N/A @endif
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                 {{ $quote->orderItem->unit_of_measurement }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                {{ number_format($quote->quote_price_per_quantity, 2) }} {{__('portal.SAR')}}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                {{ number_format($quote->quote_quantity) }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                {{ number_format($quote->quote_quantity * $quote->quote_price_per_quantity, 2) }} {{__('portal.SAR')}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        @php
                                            $subtotal = 0;
                                                foreach($quotes as $quote)
                                                {
                                                    $subtotal += $quote->quote_quantity * $quote->quote_price_per_quantity;
                                                }
                                        @endphp
                                        <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($subtotal, 2) }} {{__('portal.SAR')}}<br>
                                        @php $subtotal += $quotes[0]->shipment_cost; @endphp
                                        <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($quotes[0]->shipment_cost, 2) }} {{__('portal.SAR')}}<br>
                                        <strong>{{__('portal.VAT')}} {{ $quotes[0]->VAT }}%: @if($quotes[0]->VAT > 9) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @else &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @endif </strong>{{ number_format($subtotal * ($quotes[0]->VAT/100), 2) }} {{__('portal.SAR')}} <br>
                                        <hr>
                                        <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($quotes[0]->total_cost, 2) }} {{__('portal.SAR')}} <br>
                                        <hr>
                                    </div>
                                </div>

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
                                <form action="{{ route('singleCategoryRFQUpdateStatusModificationNeeded', $quotes[0]) }}" class="rounded shadow-md" method="post">
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
                                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-800 transition ease-in-out duration-150">
                                            {{__('portal.Quote Again')}}
                                        </button>
                                    </div>
                                    <br>
                                </form>

                                <br>
                                <div class="justify-between p-2 m-2">

                                    <a href="{{ route('singleCategoryRFQUpdateStatusRejected', $quotes[0]) }}" class="inline-flex items-center justify-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-800 transition ease-in-out duration-150">
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
                                    <input type="hidden" name="payment_term" value="{{ $quotes[0]->orderItem->payment_mode }}">
                                    @php
                                        $orderItemID =  \App\Models\EOrderItems::where('id', $quotes[0]->e_order_items_id)->first();
                                        $warehouseAddress = \App\Models\BusinessWarehouse::where('id', $orderItemID->warehouse_id)->first();
                                    @endphp
                                    <input type="hidden" name="delivery_address" value="{{ $warehouseAddress->address }}">
                                    {{--                                    <x-jet-label for="warehouse" class="my-2" value="{{ __('portal.Warehouse delivery address') }}" class="text-black"  />--}}

                                    {{--@php
                                        $orderItemID =  \App\Models\EOrderItems::where('id', $quotes[0]->e_order_items_id)->first();
                                        $warehouseAddress = \App\Models\BusinessWarehouse::where('id', $orderItemID->warehouse_id)->first();
                                    @endphp--}}
                                    {{--<input type="text" name="delivery_address" class="form-input rounded-md shadow-sm border p-2 w-full" readonly value="{{$warehouseAddress->address}}">
                                    <br>
                                    <br>--}}
                                    <x-jet-label for="otp_mobile_number" value="{{ __('portal.OTP FOR Receiving Delivery Mobile Number (We will send One Time Password when you receive delivery)') }}" class="text-center text-black font-bold text-red-600"  />
                                    <div class="flex mt-3" style="justify-content: center">
                                        <div class="flex-row">
                                            <input type="number" id="otp_mobile_number" name="otp_mobile_number" class="form-input rounded-md shadow-sm border p-2 w-full"
                                                   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                   maxlength="9"
                                                   value="{{$warehouseAddress->mobile}}">
                                        </div>
                                        <div class="flex-row">
                                            @if($warehouseAddress->mobile_verified == 1)
                                                <img src="{{url('complete_check.jpg')}}" class="ml-4 mt-2" style="height: 25px;">
                                            @endif
                                        </div>
                                    </div>


                                    <div class="flex text-center" id="mobile_verfication">
                                        <livewire:mobile-verification />
                                    </div>

                                    <br>
                                    <br>
{{--                                    <input type="text" class="form-input rounded-md shadow-sm border p-2 w-full" name="address" value="{{$warehouseAddress->address}}" readonly>--}}

                                    <x-jet-label for="Remarks" value="{{ __('portal.Remarks') }}" class="text-black text-2xl"/>
                                    <textarea name="remarks" id="remarks" class="w-full" style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Remarks')}}.."></textarea>

                                    <div class="mt-5 d-flex">
                                        <div style="display: inline">
                                            <a href="{{ url()->previous() }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                {{__('portal.Go Back')}}
                                            </a>
                                        </div>
                                        @if($warehouseAddress->mobile_verified == 1)
                                            <div style="display: inline">
                                                <input type="submit" value="{{__('portal.Approve')}}" style="cursor: pointer" class="inline-flex items-center justify-center px-4 my-5 py-2 bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-800 transition ease-in-out duration-150">
                                            </div>
                                        @endif
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-app-layout>
@else

@section('headerScripts')
    <style>
        @media (min-width: 600px) {
            .scroll-bar-for-large-screen{
                overflow-x:hidden !important;
            }
        }
    </style>
@endsection

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>
        @if (session()->has('message'))
            <div class="block mt-2 text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-3">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="block mt-2 text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-3">{{ session('error') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif

        <div class="-my-2 overflow-x-auto sm:overflow-hidden lg:-mx-8 scroll-bar-for-large-screen">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                        <div class="bg-white overflow-hidden shadow-xl ">
                            <div class="mt-5" style=" margin-right: 30px; margin-bottom: 10px ">
                                <a href="{{ route('singleCategoryQuotationPDF', [ 'quote_supplier_business_id' => encrypt($quotes[0]['supplier_business_id']), 'e_order_id' => encrypt($quotes[0]['e_order_id'])]) }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                    {{__('portal.Create PDF')}}
                                </a>
                            </div>
                            <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                                <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ $quotes[0]->buyer_business->business_photo_url }}" alt="{{ $quotes[0]->buyer_business->business_name }}" />--}}
{{--                                        <h1 class="text-center text-2xl">{{ $quotes[0]->buyer_business->business_name }}</h1>--}}
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <img class="h-20 w-30 object-cover mx-auto" src="{{ Storage::url($quotes[0]->supplier_business->business_photo_url) }}" style="border-radius: 9px;"/>
                                        <h1 class="text-center text-3xl">{{__('portal.Quotation')}}</h1>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ $quotes[0]->supplier_business->business_photo_url }}" alt="{{ $quotes[0]->supplier_business->business_name }}" />--}}
{{--                                        <h1 class="text-center text-2xl">{{ $quotes[0]->supplier_business->business_name }}</h1>--}}
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden">
                                        <h1 class="text-center text-3xl">{{__('portal.Status')}}:
                                            @if ($quotes[0]->qoute_status == 'Modified')
                                                <span class="bg-gray-400">{{__('portal.You have asked for a modification for this quotation.')}}</span>
                                            @elseif($quotes[0]->qoute_status == 'Qouted')
                                                <span class="bg-yellow-400">{{__('portal.Waiting for response')}}.</span>
                                            @elseif($quotes[0]->qoute_status == 'Rejected')
                                                <span class="bg-red-600">{{__('portal.You have rejected this quotation.')}}</span>
                                            @endif
                                        </h1>
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                        <strong>{{__('portal.Supplier')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $quotes[0]->supplier_business->business_name }}</span><br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $quotes[0]->supplier_business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $quotes[0]->supplier_business->vat_reg_certificate_number }}</span><br>
                                        <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $quotes[0]->supplier_business->business_email }}</span><br><br>

                                        <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-<span style="font-family: sans-serif">{{ $quotes[0]->id }}</span><br>
                                        <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-<span style="font-family: sans-serif">{{ $quotes[0]->orderItem->id }}</span><br>
                                        <strong>{{__('portal.Shipment Time')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> <span style="font-family: sans-serif">{{ $quotes[0]->shipping_time_in_days }}</span><br>
                                        <strong>{{__('portal.Payment Term')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                        @if($quotes[0]->orderItem->payment_mode == 'Cash') {{__('portal.Cash')}}
                                        @elseif($quotes[0]->orderItem->payment_mode == 'Credit') {{__('portal.Credit')}}
                                        @elseif($quotes[0]->orderItem->payment_mode == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                        @elseif($quotes[0]->orderItem->payment_mode == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                        @elseif($quotes[0]->orderItem->payment_mode == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                        @elseif($quotes[0]->orderItem->payment_mode == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                        @endif
                                    </div>
                                    {{--<div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <strong>{{__('portal.Supplier')}}: </strong><br>
                                        <p>{{ $quotes[0]->supplier_business->business_name }}</p><br>

                                        <strong>{{__('portal.City')}}: </strong><span>{{ $quotes[0]->supplier_business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: </strong><span>{{ $quotes[0]->supplier_business->vat_reg_certificate_number }}</span><br>
                                    </div>--}}
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                        <img src="{{ Storage::url($quotes[0]->buyer_business->business_photo_url) }}" alt="{{ $quotes[0]->buyer_business->business_name }}" style="height: 95px;"/>
                                        <strong>{{__('portal.Buyer')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $quotes[0]->buyer_business->business_name }}</span><br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $quotes[0]->buyer_business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $quotes[0]->buyer_business->vat_reg_certificate_number }}</span><br>
                                        @php
                                            $warehouse = \App\Models\BusinessWarehouse::where('id', $quotes[0]->warehouse_id)->first()->only('mobile', 'warehouse_name');
                                        @endphp
                                        <strong>{{__('portal.Contact #')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $warehouse['mobile'] }}</span><br>
                                        <strong>{{__('portal.Warehouse for delivery')}}: &nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $warehouse['warehouse_name'] }}</span><br>
                                    </div>
                                </div>

                                {{--<div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-screen">
                                        <strong class="text-xl">{{__('portal.Category Name')}}: </strong>
                                        @php
                                            $record = \App\Models\Category::where('id',$quotes[0]->orderItem->item_code)->first();
                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                        @endphp
                                        <span class="text-xl text-blue-600"> {{ $record->name_ar }}@if(isset($parent)), {{ $parent->name_ar }} @endif </span>
                                    </div>
                                </div>--}}

                                <table class="min-w-full divide-y divide-black">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            #
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Category Name')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Description')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Note')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.UOM')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Unit Price')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Quantity')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Amount')}}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-black border-1 border-black">
                                    @foreach($quotes as $quote)
                                        <tr>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="font-family: sans-serif">
                                                {{$loop->iteration}}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                @php
                                                    $record = \App\Models\Category::where('id',$quote->orderItem->item_code)->first();
                                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                @endphp
                                                {{ $record->name_ar }}@if(isset($parent)), {{ $parent->name_ar }} @endif
                                            </td>
                                            <td class="px-2 py-2 text-sm text-black border border-black" style="font-family: sans-serif">
                                                {{ $quote->orderItem->description }}
                                            </td>
                                            <td class="px-2 py-2 text-sm text-black border border-black" style="font-family: sans-serif">
                                                @if(isset($quote->note_for_customer)) {{ strip_tags($quote->note_for_customer) }} @else N/A @endif
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                @php $UOM = \App\Models\UnitMeasurement::where('uom_en', $quote->orderItem->unit_of_measurement)->pluck('uom_ar')->first(); @endphp
                                                {{ $UOM }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                <span style="font-family: sans-serif">{{ number_format($quote->quote_price_per_quantity, 2) }}</span> {{__('portal.SAR')}}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="font-family: sans-serif">
                                                {{ number_format($quote->quote_quantity) }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                <span style="font-family: sans-serif">{{ number_format($quote->quote_quantity * $quote->quote_price_per_quantity, 2) }}</span> {{__('portal.SAR')}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        @php
                                            $subtotal = 0;
                                                foreach($quotes as $quote)
                                                {
                                                    $subtotal += $quote->quote_quantity * $quote->quote_price_per_quantity;
                                                }
                                        @endphp
                                        <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ number_format($subtotal, 2) }}</span> {{__('portal.SAR')}}<br>
                                        @php $subtotal += $quotes[0]->shipment_cost; @endphp
                                        <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ number_format($quotes[0]->shipment_cost, 2) }}</span> {{__('portal.SAR')}}<br>
                                        <strong>{{__('portal.VAT')}} <span style="font-family: sans-serif">{{ $quotes[0]->VAT }}</span>%: @if($quotes[0]->VAT > 9) &nbsp; @else &nbsp;&nbsp; @endif </strong><span style="font-family: sans-serif">{{ number_format($subtotal * ($quotes[0]->VAT/100), 2) }}</span> {{__('portal.SAR')}} <br>
                                        <hr>
                                        <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ number_format($quotes[0]->total_cost, 2) }}</span> {{__('portal.SAR')}} <br>
                                        <hr>
                                    </div>
                                </div>

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
                                <form action="{{ route('singleCategoryRFQUpdateStatusModificationNeeded', $quotes[0]) }}" class="rounded shadow-md" method="post">
                                    @csrf
                                    @php $business = \App\Models\Business::where('user_id', $quotes[0]->supplier_user_id)->first(); @endphp
                                    <h1 class="text-center text-2xl mt-4">{{__('portal.Message to')}} <span class="text-blue-600" style="font-family: sans-serif">{{$business->business_name}}</span>
                                        <span style="font-size: 20px;">({{__('portal.supplier')}})</span></h1>
                                    <textarea name="message" id="message" class="w-full" style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none; font-family: sans-serif" maxlength="254" placeholder="{{__('portal.Enter Message')}}..." required></textarea>
                                    <x-jet-input-error for="message" class="mt-2" />
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="qoute_id" value="{{ $quotes[0]->id }}">
                                    <input type="hidden" name="usertype" value="{{ $quotes[0]->business->business_type }}">

                                    <br>

                                    <div class="justify-between p-2 m-2">
                                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 hover:text-white focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-800 transition ease-in-out duration-150">
                                            {{__('portal.Quote Again')}}
                                        </button>
                                    </div>
                                    <br>
                                </form>

                                <br>
                                <div class="justify-between p-2 m-2">

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
                                    <input type="hidden" name="payment_term" value="{{ $quotes[0]->orderItem->payment_mode }}">
                                    @php
                                            $orderItemID =  \App\Models\EOrderItems::where('id', $quotes[0]->e_order_items_id)->first();
                                            $warehouseAddress = \App\Models\BusinessWarehouse::where('id', $orderItemID->warehouse_id)->first();
                                    @endphp
                                    <input type="hidden" name="delivery_address" value="{{ $warehouseAddress->address }}">


                                    <x-jet-label for="otp_mobile_number" value="{{ __('portal.OTP FOR Receiving Delivery Mobile Number (We will send One Time Password when you receive delivery)') }}" class="text-center text-black font-bold text-red-600"  />
                                    <div class="flex mt-3" style="justify-content: center">
                                        <div class="flex-row">
                                            <input type="number" id="otp_mobile_number" name="otp_mobile_number" class="form-input rounded-md shadow-sm border p-2 w-full" style="font-family: sans-serif"
                                                   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                   maxlength="9"
                                                   value="{{$warehouseAddress->mobile}}">
                                        </div>
                                        <div class="flex-row">
                                            @if($warehouseAddress->mobile_verified == 1)
                                                <img src="{{url('complete_check.jpg')}}" class="mr-4 mt-2" style="height: 25px;">
                                            @endif
                                        </div>
                                    </div>


                                    <div class="flex text-center" id="mobile_verfication">
                                        <livewire:mobile-verification />
                                    </div>

                                    <br>
                                    <br>
{{--                                    <input type="text" class="form-input rounded-md shadow-sm border p-2 w-full" name="address" value="{{$warehouseAddress->address}}" readonly>--}}

                                    <x-jet-label for="Remarks" value="{{ __('portal.Remarks') }}" class="text-black text-2xl"/>
                                    <textarea name="remarks" id="remarks" class="w-full" style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none;font-family: sans-serif" maxlength="254" placeholder="{{__('portal.Enter Remarks')}}.."></textarea>

                                    <div class="mt-5 d-flex">
                                        <div style="display: inline">
                                            <a href="{{ url()->previous() }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 hover:text-white focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                {{__('portal.Go Back')}}
                                            </a>
                                        </div>
                                        @if($warehouseAddress->mobile_verified == 1)
                                            <div style="display: inline">
                                                <input type="submit" value="{{__('portal.Approve')}}" style="cursor: pointer" class="inline-flex items-center justify-center px-4 my-5 py-2 bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-800 transition ease-in-out duration-150">
                                            </div>
                                        @endif
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif

<script>

    $('#otp_mobile_number').on('keyup', function() {
        if ($(this).val().length > 8)
        {
            $.ajax({
                url: "{{route('warehouseNumberUpdate')}}",
                method: 'get',
                data: {
                    'number' : $(this).val(),
                },
                success: function(response){
                    if (response.data === 'success'){
                        location.reload();
                        // $("#mobile_verfication").load(" #mobile_verfication");
                    }
                },
            })
        }
        // console.log($(this).val());
    });

</script>
