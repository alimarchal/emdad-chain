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
                            <a href="{{route('PDFForSingleCategoryQuotation', [ 'quoteID' => encrypt($quotes[0]->e_order_id), 'eOrderItemID' => encrypt($quotes[0]->orderItem->id)])}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                {{__('portal.Create PDF')}}
                            </a>
                        </div>
                        <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                            <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <img class="h-20 w-30 object-cover mx-auto" src="{{ Storage::url($quotes[0]->supplier_business->business_photo_url) }}" style="border-radius: 9px;"/>
                                    <h1 class="text-center text-3xl">{{__('portal.Quotation')}}</h1>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
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

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                    <img src="{{ Storage::url($quotes[0]->buyer_business->business_photo_url) }}" alt="{{ $quotes[0]->buyer_business->business_name }}" style="height: 95px;"/>
                                    <strong>{{__('portal.Buyer')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>@if($quotes[0]->orderItem->company_name_check == 1) {{ $quotes[0]->buyer_business->business_name }} @else {{__('portal.N/A')}} @endif <br>
                                    <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $quotes[0]->buyer_business->city }}</span><br>
                                    <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $quotes[0]->buyer_business->vat_reg_certificate_number }}</span><br>
                                    @php
                                        $warehouse = \App\Models\BusinessWarehouse::where('id', $quotes[0]->warehouse_id)->first()->only('mobile', 'address');
                                    @endphp
                                    <strong>{{__('portal.Contact #')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $warehouse['mobile'] }}</span><br>
                                    <strong>{{__('portal.Delivery Address')}}: &nbsp;&nbsp;</strong><span>{{ $warehouse['address'] }}</span><br>
                                </div>
                            </div>

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
                                        <td class="px-2 py-2 text-sm text-black border border-black">
                                            {{$loop->iteration}}
                                        </td>
                                        <td class="px-2 py-2 text-sm text-black border border-black">
                                            @php
                                                $record = \App\Models\Category::where('id',$quote->orderItem->item_code)->first();
                                                $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                            @endphp
                                            {{ $record->name }}@if(isset($parent)), {{ $parent->name }} @endif
                                        </td>
                                        <td class="px-2 py-2  text-sm text-black border border-black">
                                            {{ $quote->orderItem->description }}
                                        </td>
                                        <td class="px-2 py-2  text-sm text-black border border-black">
                                            @if(isset($quote->note_for_customer)) {{ strip_tags($quote->note_for_customer) }} @else N/A @endif
                                        </td>
                                        <td class="px-2 py-2  text-sm text-black border border-black">
                                            {{ $quote->orderItem->unit_of_measurement }}
                                        </td>
                                        <td class="px-2 py-2  text-sm text-black border border-black">
                                            {{ $quote->quote_price_per_quantity }} {{__('portal.SAR')}}
                                        </td>
                                        <td class="px-2 py-2  text-sm text-black border border-black">
                                            {{ $quote->quote_quantity }}
                                        </td>
                                        <td class="px-2 py-2  text-sm text-black border border-black">
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
                                    <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($quotes[0]->shipment_cost) }} {{__('portal.SAR')}}<br>
                                    <strong>{{__('portal.VAT')}} {{ $quotes[0]->VAT }}%: @if($quote->VAT > 9) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @else &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @endif </strong>{{ number_format($subtotal * ($quotes[0]->VAT/100), 2) }} {{__('portal.SAR')}} <br>
                                    <hr>
                                    <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($quotes[0]->total_cost, 2) }} {{__('portal.SAR')}} <br>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 ml-2">
                    <a href="{{route('singleCategoryQuotedRFQQuoted')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                        {{__('portal.Back')}}
                    </a>
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
                            <a href="{{route('PDFForSingleCategoryQuotation', [ 'quoteID' => encrypt($quotes[0]->e_order_id), 'eOrderItemID' => encrypt($quotes[0]->orderItem->id)])}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                {{__('portal.Create PDF')}}
                            </a>
                        </div>
                        <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                            <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <img class="h-20 w-30 object-cover mx-auto" src="{{ Storage::url($quotes[0]->supplier_business->business_photo_url) }}" style="border-radius: 9px;"/>
                                    <h1 class="text-center text-3xl">{{__('portal.Quotation')}}</h1>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                </div>
                            </div>

                            <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                    <strong>{{__('portal.Supplier')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> <span style="font-family: sans-serif">{{ $quotes[0]->supplier_business->business_name }}</span> <br>
                                    <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $quotes[0]->supplier_business->city }}</span><br>
                                    <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $quotes[0]->supplier_business->vat_reg_certificate_number }}</span><br>
                                    <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $quotes[0]->supplier_business->business_email }}</span><br><br>

                                    <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-<span style="font-family: sans-serif">{{ $quotes[0]->id }}</span> <br>
                                    <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-<span style="font-family: sans-serif">{{ $quotes[0]->orderItem->id }}</span> <br>
                                    <strong>{{__('portal.Shipment Time')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> <span style="font-family: sans-serif">{{ $quotes[0]->shipping_time_in_days }}</span> <br>
                                    <strong>{{__('portal.Payment Term')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    @if($quotes[0]->orderItem->payment_mode == 'Cash') {{__('portal.Cash')}}
                                    @elseif($quotes[0]->orderItem->payment_mode == 'Credit') {{__('portal.Credit')}}
                                    @elseif($quotes[0]->orderItem->payment_mode == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                    @elseif($quotes[0]->orderItem->payment_mode == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                    @elseif($quotes[0]->orderItem->payment_mode == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                    @elseif($quotes[0]->orderItem->payment_mode == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                    @endif
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                    <img src="{{ Storage::url($quotes[0]->buyer_business->business_photo_url) }}" alt="{{ $quotes[0]->buyer_business->business_name }}" style="height: 95px;"/>
                                    <strong>{{__('portal.Buyer')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>@if($quotes[0]->orderItem->company_name_check == 1) <span style="font-family: sans-serif"> {{ $quotes[0]->buyer_business->business_name }} </span> @else <span style="font-family: sans-serif">{{__('portal.N/A')}}</span> @endif<br>
                                    <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $quotes[0]->buyer_business->city }}</span><br>
                                    <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $quotes[0]->buyer_business->vat_reg_certificate_number }}</span><br>
                                    @php
                                        $warehouse = \App\Models\BusinessWarehouse::where('id', $quotes[0]->warehouse_id)->first()->only('mobile', 'address');
                                    @endphp
                                    <strong>{{__('portal.Contact #')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $warehouse['mobile'] }}</span><br>
                                    <strong>{{__('portal.Delivery Address')}}: &nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $warehouse['address'] }}</span><br>
                                </div>
                            </div>

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
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="font-family: sans-serif">
                                            {{ $quote->orderItem->description }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="font-family: sans-serif">
                                            @if(isset($quote->note_for_customer)) {{ strip_tags($quote->note_for_customer) }} @else {{__('portal.N/A')}} @endif
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            @php $UOM = \App\Models\UnitMeasurement::where('uom_en', $quote->orderItem->unit_of_measurement)->pluck('uom_ar')->first(); @endphp
                                            {{ $UOM }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            <span style="font-family: sans-serif">{{ $quote->quote_price_per_quantity }}</span>  {{__('portal.SAR')}}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            <span style="font-family: sans-serif">{{ $quote->quote_quantity }}</span>
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
                                    <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ number_format($quotes[0]->shipment_cost) }}</span> {{__('portal.SAR')}}<br>
                                    <strong>{{__('portal.VAT')}} <span style="font-family: sans-serif">{{ $quotes[0]->VAT }}</span>%: @if($quotes[0]->VAT > 9) &nbsp; @else &nbsp;&nbsp; @endif </strong><span style="font-family: sans-serif">{{ number_format($subtotal * ($quotes[0]->VAT/100), 2) }}</span> {{__('portal.SAR')}} <br>
                                    <hr>
                                    <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ number_format($quotes[0]->total_cost, 2) }}</span> {{__('portal.SAR')}} <br>
                                    <hr>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="mt-4 mr-2">
                    <a href="{{route('singleCategoryQuotedRFQQuoted')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                        {{__('portal.Back')}}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endif

