@if (auth()->user()->rtl == 0)

@section('headerScripts')
    <style>
        @media (min-width: 600px) {
            .scroll-bar-for-large-screen {
                overflow-x: hidden !important;
            }
        }
    </style>
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('User List') }}</h2>
    </x-slot>
    @if (session()->has('message'))
        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
            <strong class="mr-1">{{ session('message') }}</strong>
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
                            <a href="{{ route('quotationPDF', [ 'quote_supplier_business_id' => $QouteItem->supplier_business_id, 'e_order_id' => $QouteItem->e_order_id ]) }}" style="background-color: #145EA8"
                               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                {{__('portal.Create PDF')}}
                            </a>
                        </div>
                        <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                            <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($QouteItem->buyer_business->business_photo_url) }}" alt="{{ $QouteItem->buyer_business->business_name }}"/>
                                    <h1 class="text-center text-2xl">{{ $QouteItem->buyer_business->business_name }}</h1>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <h1 class="text-center text-3xl">{{__('portal.Quotation')}}</h1>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($QouteItem->supplier_business->business_photo_url) }}" alt="{{ $QouteItem->supplier_business->business_name }}"/>
                                    <h1 class="text-center text-2xl">{{ $QouteItem->supplier_business->business_name }}</h1>
                                </div>
                            </div>

                            <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                <div class="w-full overflow-hidden">
                                    <h1 class="text-center text-3xl">{{__('portal.Status')}}:
                                        @if ($QouteItem->qoute_status == 'Modified')
                                            <span class="bg-gray-400">{{__('portal.You have asked for a modification for this quotation.')}}</span>
                                        @elseif($QouteItem->qoute_status == 'Qouted')
                                            <span class="bg-yellow-400">{{__('portal.Waiting for response')}}.</span>
                                        @elseif($QouteItem->qoute_status == 'Rejected')
                                            <span class="bg-red-600">{{__('portal.You have rejected this quotation.')}}</span>
                                        @endif
                                    </h1>
                                </div>
                            </div>

                            <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <strong class="text-xl">{{__('portal.Requested by')}}: </strong><br>
                                    <p class="text-xl">{{ $QouteItem->buyer_business->business_name }}</p><br>
                                    <strong class="text-xl">{{__('portal.City')}}: </strong><span class="text-xl">{{ $QouteItem->buyer_business->city }}</span><br>
                                    <strong class="text-xl">{{__('portal.VAT Number')}}: </strong><span class="text-xl">{{ $QouteItem->buyer_business->vat_reg_certificate_number }}</span><br>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <strong class="text-xl">{{__('portal.Supplier')}}: </strong><br>
                                    <p class="text-xl">{{ $QouteItem->supplier_business->business_name }}</p><br>

                                    <strong class="text-xl">{{__('portal.City')}}: </strong><span class="text-xl">{{ $QouteItem->supplier_business->city }}</span><br>
                                    <strong class="text-xl">{{__('portal.VAT Number')}}: </strong><span class="text-xl">{{ $QouteItem->supplier_business->vat_reg_certificate_number }}</span><br>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                    <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}
                                    -{{ $QouteItem->id }}<br>
                                    <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    @php
                                        $record = \App\Models\Category::where('id',$QouteItem->orderItem->item_code)->first();
                                        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                    @endphp
                                    <span style="color: #145ea8;"> {{ $record->name }} @if(isset($parent)) , {{ $parent->name }} @endif </span>
                                    <br>
                                    <strong>{{__('portal.Payment Term')}}:
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> @if ($QouteItem->orderItem->payment_mode == 'Cash') {{__('portal.Cash')}} @else {{__('portal.Credit')}} @endif
                                </div>
                            </div>

                            <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-screen">
                                    <strong class="text-xl">{{__('portal.Quote Description')}}: </strong><br>
                                    <p class="text-xl">{{ strip_tags($QouteItem->orderItem->description) }}</p><br>
                                </div>
                            </div>

                            <table class="min-w-full divide-y divide-black">
                                <thead>
                                <tr>
                                    <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        #
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        {{__('portal.Note')}}
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
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        1
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        @if(isset($QouteItem->note_for_customer)) {{ strip_tags($QouteItem->note_for_customer) }} @else N/A @endif
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $QouteItem->quote_price_per_quantity }} {{__('portal.SAR')}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $QouteItem->quote_quantity }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ number_format($QouteItem->quote_quantity * $QouteItem->quote_price_per_quantity, 2) }} {{__('portal.SAR')}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <strong>{{__('portal.Sub-total')}}:
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($QouteItem->quote_quantity * $QouteItem->quote_price_per_quantity, 2) }} {{__('portal.SAR')}}
                                    <br>
                                    <strong>{{__('portal.VAT')}} %: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $QouteItem->VAT }} <br>
                                    <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($QouteItem->shipment_cost) }} {{__('portal.SAR')}}<br>
                                    <hr>
                                    <strong>{{__('portal.Total')}}:
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($QouteItem->total_cost) }} {{__('portal.SAR')}}
                                    <br>
                                    <hr>
                                </div>
                            </div>

                            {{-- Retrieving eOrderItemsID in qoute_id while Storing Supplier message and Retrieving QuoteID in qoute_id while storing Buyer message --}}
                            @php
                                $quote = \App\Models\QouteMessage::where('qoute_id', $QouteItem->e_order_items_id)->where('user_id', '!=', auth()->id())->get();
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

                            @if($QouteItem->messages->isNotEmpty())
                                <div class="border-2 p-2 m-2">
                                    @foreach ($QouteItem->messages as $msg)
                                        <span class="text-blue-600">{{__('portal.Message you send')}}</span>  : {{ strip_tags(str_replace('&nbsp;', ' ',  $msg->message)) }} <br> <br>
                                    @endforeach
                                </div>
                            @endif

                            <hr>
                            {{-- Inserting eOrderItemsID in qoute_id while Storing Supplier message and Inserting QuoteID in qoute_id while storing Buyer message --}}
                            <form action="{{ route('QuotationMessage.store') }}" class="rounded shadow-md" method="post">
                                @csrf
                                @php $business = \App\Models\Business::where('user_id', $QouteItem->supplier_user_id)->first(); @endphp
                                <h1 class="text-center text-2xl mt-4">{{__('portal.Message to')}} <span class="text-blue-600">{{$business->business_name}}</span>
                                    <span style="font-size: 20px;">({{__('portal.supplier')}})</span></h1>
                                <textarea name="message" id="message" class="w-full" style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Message')}}..." required></textarea>
                                <x-jet-input-error for="message" class="mt-2"/>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="qoute_id" value="{{ $QouteItem->id }}">
                                <input type="hidden" name="usertype" value="{{ $QouteItem->business->business_type }}">

                                <br>

                                <div class="justify-between p-2 m-2">
                                    <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
                                        {{__('portal.Send')}}
                                    </button>
                                </div>
                                <br>
                            </form>

                            <br>
                            <div class="justify-between p-2 m-2">

                                <a href="{{ route('updateQoute', $QouteItem->id) }}"
                                   class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-800 transition ease-in-out duration-150">
                                    {{__('portal.Quote Again')}}
                                </a>

                                <a href="{{ route('updateRejected', $QouteItem->id) }}" style="margin-left: 70px; margin-top: 20px;"
                                   class="inline-flex items-center justify-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-800 transition ease-in-out duration-150">
                                    {{__('portal.Reject Quotation')}}
                                </a>
                            </div>

                            <br>

                            <h1 class="text-2xl text-center font-bold mb-2 mt-2 text-red-700">{{__('portal.If you want to accept request please fill out below form.')}}</h1>
                            <br>
                            <form action="{{ route('qouteAccepted', $QouteItem->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="business_id" value="{{ auth()->user()->business_id }}">

                                <input type="hidden" name="supplier_user_id" value="{{ $QouteItem->supplier_user_id }}">
                                <input type="hidden" name="supplier_business_id" value="{{ $QouteItem->supplier_business_id }}">

                                <input type="hidden" name="rfq_no" value="{{ $QouteItem->e_order_id }}">
                                <input type="hidden" name="rfq_item_no" value="{{ $QouteItem->e_order_items_id }}">

                                <input type="hidden" name="item_code" value="{{ $QouteItem->orderItem->item_code }}">
                                <input type="hidden" name="item_name" value="{{ $QouteItem->orderItem->item_name }}">

                                <input type="hidden" name="uom" value="{{ $QouteItem->orderItem->unit_of_measurement }}">
                                <input type="hidden" name="brand" value="{{ $QouteItem->orderItem->brand }}">

                                <input type="hidden" name="quantity" value="{{ $QouteItem->quote_quantity }}">
                                <input type="hidden" name="unit_price" value="{{ $QouteItem->quote_price_per_quantity }}">

                                <input type="hidden" name="sub_total" value="{{ $QouteItem->quote_quantity * $QouteItem->quote_price_per_quantity }}">
                                <input type="hidden" name="delivery_time" value="{{ $QouteItem->shipping_time_in_days }}">

                                <input type="hidden" name="qoute_no" value="{{ $QouteItem->id }}">

                                <input type="hidden" name="warehouse_id" value="{{ $QouteItem->warehouse_id }}">
                                <input type="hidden" name="shipment_cost" value="{{ $QouteItem->shipment_cost }}">
                                <input type="hidden" name="vat" value="{{ $QouteItem->VAT }}">
                                <input type="hidden" name="total_cost" value="{{ $QouteItem->total_cost }}">
                                <input type="hidden" name="payment_term" value="{{ $QouteItem->orderItem->payment_mode }}">

                                <x-jet-label for="warehouse" class="my-2" value="{{ __('portal.Warehouse delivery address') }}" class="text-black"/>

                                @php
                                    $orderItemID =  \App\Models\EOrderItems::where('id', $QouteItem->e_order_items_id)->first();
                                    $warehouseAddress = \App\Models\BusinessWarehouse::where('id', $orderItemID->warehouse_id)->first();
                                @endphp
                                <input type="text" name="delivery_address" class="form-input rounded-md shadow-sm border p-2 w-full" readonly value="{{$warehouseAddress->address}}">
                                <br>
                                <br>
                                <x-jet-label for="Remarks" value="{{ __('portal.OTP FOR Receiving Delivery Mobile Number (We will send One Time Password when you receive delivery)') }}"
                                             class="text-center text-black font-bold text-red-600"/>
                                <input type="text" name="otp_mobile_number" class="form-input rounded-md shadow-sm border p-2 w-full" value="{{$warehouseAddress->mobile}}">
                                <br>
                                <br>
                                <input type="text" class="form-input rounded-md shadow-sm border p-2 w-full" name="address" value="{{$warehouseAddress->address}}" readonly>

                                <x-jet-label for="Remarks" value="{{ __('portal.Remarks') }}" class="text-black"/>
                                <textarea name="remarks" id="remarks" class="w-full" style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Remarks')}}.."></textarea>

                                <div class="mt-5 d-flex">
                                    <div style="display: inline">
                                        <a href="{{ url()->previous() }}"
                                           class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                            {{__('portal.Go Back')}}
                                        </a>
                                    </div>
                                    <div style="display: inline">
                                        <input type="submit" value="{{__('portal.Accept')}}" style="cursor: pointer"
                                               class="inline-flex items-center justify-center px-4 my-5 py-2 bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-800 transition ease-in-out duration-150">

                                    </div>
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
            .scroll-bar-for-large-screen {
                overflow-x: hidden !important;
            }
        }
    </style>
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('User List') }}</h2>
    </x-slot>
    @if (session()->has('message'))
        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
            <strong class="mr-1">{{ session('message') }}</strong>
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
                            <a href="{{ route('quotationPDF', [ 'quote_supplier_business_id' => encrypt($QouteItem->supplier_business_id), 'e_order_id' => encrypt($QouteItem->e_order_id) ]) }}" style="background-color: #145EA8"
                               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                {{__('portal.Create PDF')}}
                            </a>
                        </div>
                        <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                            <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <img class="h-20 w-20 rounded-full object-cover" src="{{ $QouteItem->buyer_business->business_photo_url }}" alt="{{ $QouteItem->buyer_business->business_name }}"/>
                                    <h1 class="text-center text-2xl">{{ $QouteItem->buyer_business->business_name }}</h1>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <h1 class="text-center text-3xl">{{__('portal.Quotation')}}</h1>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <img class="h-20 w-20 rounded-full object-cover" src="{{ $QouteItem->supplier_business->business_photo_url }}" alt="{{ $QouteItem->supplier_business->business_name }}"/>
                                    <h1 class="text-center text-2xl">{{ $QouteItem->supplier_business->business_name }}</h1>
                                </div>
                            </div>

                            <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                <div class="w-full overflow-hidden">
                                    <h1 class="text-center text-3xl">{{__('portal.Status')}}:
                                        @if ($QouteItem->qoute_status == 'Modified')
                                            <span class="bg-gray-400">{{__('portal.You have asked for a modification for this quotation.')}}</span>
                                        @elseif($QouteItem->qoute_status == 'Qouted')
                                            <span class="bg-yellow-400">{{__('portal.Waiting for response')}}.</span>
                                        @elseif($QouteItem->qoute_status == 'Rejected')
                                            <span class="bg-red-600">{{__('portal.You have rejected this quotation.')}}</span>
                                        @endif
                                    </h1>
                                </div>
                            </div>

                            <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <strong class="text-xl">{{__('portal.Requested by')}}: </strong><br>
                                    <p class="text-xl">{{ $QouteItem->buyer_business->business_name }}</p><br>
                                    <strong class="text-xl">{{__('portal.City')}}: </strong><span class="text-xl">{{ $QouteItem->buyer_business->city }}</span><br>
                                    <strong class="text-xl">{{__('portal.VAT Number')}}: </strong><span class="text-xl">{{ $QouteItem->buyer_business->vat_reg_certificate_number }}</span><br>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <strong class="text-xl">{{__('portal.Supplier')}}: </strong><br>
                                    <p class="text-xl">{{ $QouteItem->supplier_business->business_name }}</p><br>

                                    <strong class="text-xl">{{__('portal.City')}}: </strong><span class="text-xl">{{ $QouteItem->supplier_business->city }}</span><br>
                                    <strong class="text-xl">{{__('portal.VAT Number')}}: </strong><span class="text-xl">{{ $QouteItem->supplier_business->vat_reg_certificate_number }}</span><br>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                    <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $QouteItem->id }}<br>
                                    <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    @php
                                        $record = \App\Models\Category::where('id',$QouteItem->orderItem->item_code)->first();
                                        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                    @endphp
                                    <span style="color: #145ea8;"> {{ $record->name_ar }} @if(isset($parent)) , {{ $parent->name_ar }} @endif </span>
                                    <br>
                                    <strong>{{__('portal.Payment Term')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> @if ($QouteItem->orderItem->payment_mode == 'Cash') {{__('portal.Cash')}} @else {{__('portal.Credit')}} @endif
                                </div>
                            </div>

                            <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-screen">
                                    <strong class="text-xl">{{__('portal.Quote Description')}}: </strong><br>
                                    <p class="text-xl">{{ strip_tags($QouteItem->orderItem->description) }}</p><br>
                                </div>
                            </div>

                            <table class="min-w-full divide-y divide-black">
                                <thead>
                                <tr>
                                    <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        #
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        {{__('portal.Note')}}
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
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        1
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        @if(isset($QouteItem->note_for_customer)) {{ strip_tags($QouteItem->note_for_customer) }} @else N/A @endif
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $QouteItem->quote_price_per_quantity }} {{__('portal.SAR')}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $QouteItem->quote_quantity }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ number_format($QouteItem->quote_quantity * $QouteItem->quote_price_per_quantity, 2) }} {{__('portal.SAR')}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <strong>{{__('portal.Sub-total')}}:
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($QouteItem->quote_quantity * $QouteItem->quote_price_per_quantity, 2) }} {{__('portal.SAR')}}
                                    <br>
                                    <strong>{{__('portal.VAT')}} %: &nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $QouteItem->VAT }} <br>
                                    <strong>{{__('portal.Shipment cost')}}:
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($QouteItem->shipment_cost) }} {{__('portal.SAR')}}<br>
                                    <hr>
                                    <strong>{{__('portal.Total')}}:
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($QouteItem->total_cost) }} {{__('portal.SAR')}}
                                    <br>
                                    <hr>
                                </div>
                            </div>

                            {{-- Retrieving eOrderItemsID in qoute_id while Storing Supplier message and Retrieving QuoteID in qoute_id while storing Buyer message --}}
                            @php
                                $quote = \App\Models\QouteMessage::where('qoute_id', $QouteItem->e_order_items_id)->where('user_id', '!=', auth()->id())->get();
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

                            @if($QouteItem->messages->isNotEmpty())
                                <div class="border-2 p-2 m-2">
                                    @foreach ($QouteItem->messages as $msg)
                                        <span class="text-blue-600">{{__('portal.Message you send')}}</span>  : {{ strip_tags(str_replace('&nbsp;', ' ',  $msg->message)) }} <br> <br>
                                    @endforeach
                                </div>
                            @endif

                            <hr>
                            {{-- Inserting eOrderItemsID in qoute_id while Storing Supplier message and Inserting QuoteID in qoute_id while storing Buyer message --}}
                            <form action="{{ route('QuotationMessage.store') }}" class="rounded shadow-md" method="post">
                                @csrf
                                @php $business = \App\Models\Business::where('user_id', $QouteItem->supplier_user_id)->first(); @endphp
                                <h1 class="text-center text-2xl mt-4">{{__('portal.Message to')}} <span class="text-blue-600">{{$business->business_name}}</span>
                                    <span style="font-size: 20px;">({{__('portal.supplier')}})</span></h1>
                                <textarea name="message" id="message" class="w-full" style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Message')}}..." required></textarea>
                                <x-jet-input-error for="message" class="mt-2"/>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="qoute_id" value="{{ $QouteItem->id }}">
                                <input type="hidden" name="usertype" value="{{ $QouteItem->business->business_type }}">

                                <br>

                                <div class="justify-between p-2 m-2">
                                    <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
                                        {{__('portal.Send')}}
                                    </button>
                                </div>
                                <br>
                            </form>

                            <br>
                            <div class="justify-between p-2 m-2">

                                <a href="{{ route('updateQoute', $QouteItem->id) }}"
                                   class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 hover:text-white focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-800 transition ease-in-out duration-150">
                                    {{__('portal.Quote Again')}}
                                </a>

                                <a href="{{ route('updateRejected', $QouteItem->id) }}" style="margin-left: 70px; margin-top: 20px;"
                                   class="inline-flex items-center justify-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-800 transition ease-in-out duration-150">
                                    {{__('portal.Reject Quotation')}}
                                </a>
                            </div>

                            <br>

                            <h1 class="text-2xl text-center font-bold mb-2 mt-2 text-red-700">{{__('portal.If you want to accept request please fill out below form.')}}</h1>
                            <br>
                            <form action="{{ route('qouteAccepted', $QouteItem->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="business_id" value="{{ auth()->user()->business_id }}">

                                <input type="hidden" name="supplier_user_id" value="{{ $QouteItem->supplier_user_id }}">
                                <input type="hidden" name="supplier_business_id" value="{{ $QouteItem->supplier_business_id }}">

                                <input type="hidden" name="rfq_no" value="{{ $QouteItem->e_order_id }}">
                                <input type="hidden" name="rfq_item_no" value="{{ $QouteItem->e_order_items_id }}">

                                <input type="hidden" name="item_code" value="{{ $QouteItem->orderItem->item_code }}">
                                <input type="hidden" name="item_name" value="{{ $QouteItem->orderItem->item_name }}">

                                <input type="hidden" name="uom" value="{{ $QouteItem->orderItem->unit_of_measurement }}">
                                <input type="hidden" name="brand" value="{{ $QouteItem->orderItem->brand }}">

                                <input type="hidden" name="quantity" value="{{ $QouteItem->quote_quantity }}">
                                <input type="hidden" name="unit_price" value="{{ $QouteItem->quote_price_per_quantity }}">

                                <input type="hidden" name="sub_total" value="{{ $QouteItem->quote_quantity * $QouteItem->quote_price_per_quantity }}">
                                <input type="hidden" name="delivery_time" value="{{ $QouteItem->shipping_time_in_days }}">

                                <input type="hidden" name="qoute_no" value="{{ $QouteItem->id }}">

                                <input type="hidden" name="warehouse_id" value="{{ $QouteItem->warehouse_id }}">
                                <input type="hidden" name="shipment_cost" value="{{ $QouteItem->shipment_cost }}">
                                <input type="hidden" name="vat" value="{{ $QouteItem->VAT }}">
                                <input type="hidden" name="total_cost" value="{{ $QouteItem->total_cost }}">
                                <input type="hidden" name="payment_term" value="{{ $QouteItem->orderItem->payment_mode }}">

                                <x-jet-label for="warehouse" class="my-2" value="{{ __('portal.Warehouse delivery address') }}" class="text-black"/>

                                @php
                                    $orderItemID =  \App\Models\EOrderItems::where('id', $QouteItem->e_order_items_id)->first();
                                    $warehouseAddress = \App\Models\BusinessWarehouse::where('id', $orderItemID->warehouse_id)->first();
                                @endphp
                                <input type="text" name="delivery_address" class="form-input rounded-md shadow-sm border p-2 w-full" readonly value="{{$warehouseAddress->address}}">
                                <br>
                                <br>
                                <x-jet-label for="Remarks" value="{{ __('portal.OTP FOR Receiving Delivery Mobile Number (We will send One Time Password when you receive delivery)') }}"
                                             class="text-center text-black font-bold text-red-600"/>
                                <input type="text" name="otp_mobile_number" class="form-input rounded-md shadow-sm border p-2 w-full" value="{{$warehouseAddress->mobile}}">
                                <br>
                                <br>
                                <input type="text" class="form-input rounded-md shadow-sm border p-2 w-full" name="address" value="{{$warehouseAddress->address}}" readonly>

                                <x-jet-label for="Remarks" value="{{ __('portal.Remarks') }}" class="text-black"/>
                                <textarea name="remarks" id="remarks" class="w-full" style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="{{__('portal.Enter Remarks')}}.."></textarea>

                                <div class="mt-5 d-flex">
                                    <div style="display: inline">
                                        <a href="{{ url()->previous() }}"
                                           class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                            {{__('portal.Go Back')}}
                                        </a>
                                    </div>
                                    <div style="display: inline">
                                        <input type="submit" value="{{__('portal.Accept')}}" style="cursor: pointer"
                                               class="inline-flex items-center justify-center px-4 my-5 py-2 bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-800 transition ease-in-out duration-150">
                                    </div>
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
