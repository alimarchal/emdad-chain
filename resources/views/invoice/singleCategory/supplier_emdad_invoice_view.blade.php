@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                <div class="bg-white overflow-hidden shadow-xl ">
                {{--<div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                    <a href="{{ route('generatePDF', $draftPurchaseOrder) }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                        Generate PDF
                    </a>
                </div>--}}
                    <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                        <div class="flex flex-wrap overflow-hidden bg-gray-100 p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <h1 class="text-center text-2xl">{{__('portal.Emdad Invoice for invoice')}} # &nbsp; <strong><br> {{__('portal.Emdad')}}-{{ $emdadInvoices[0]->invoice->id }}</strong></h1>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            {{--<div class="w-full overflow-hidden lg:w-1/4 xl:w-1/4">
                                <h1 class="text-center text-2xl">{{__('portal.Emdad Invoice for invoice')}} &nbsp; <strong>{{__('portal.Emdad')}}-{{ $emdadInvoices[0]->invoice->id }}</strong></h1>
                            </div>--}}
                        </div>
                        <table class="min-w-full divide-y divide-black ">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Delivery item')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Payment Type')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Amount w/o VAT')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Emdad invoice amount (1.5 %)')}}
                                    </th>
                                </tr>
                            </thead>
                            @php $deliveryItem = \App\Models\Delivery::where('draft_purchase_order_id', $emdadInvoices[0]->invoice->purchase_order->id)->first(); @endphp
                            <tbody class="bg-white divide-y divide-black border-1 border-black">
                                @foreach($emdadInvoices as $emdadInvoice)
                                    <tr>
                                        <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                            {{$loop->iteration}}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                            @php
                                                $record = \App\Models\Category::where('id',$deliveryItem->item_code)->first();
                                                $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                            @endphp
                                            {{ $record->name }} @if(isset($parent->name)) , {{ $parent->name }} @endif
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                            @if($deliveryItem->payment_term == 'Cash') {{__('portal.Cash')}}
                                            @elseif($deliveryItem->payment_term == 'Credit') {{__('portal.Credit')}}
                                            @elseif($deliveryItem->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                            @elseif($deliveryItem->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                            @elseif($deliveryItem->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                            @elseif($deliveryItem->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                            @endif
                                        </td>
                                        {{-- calculating total cost without VAT--}}
                                        @php
                                            $quote = \App\Models\Qoute::where('id', $emdadInvoice->invoice->quote->id)->first();
                                            $totalCost = ($quote->quote_quantity * $quote->quote_price_per_quantity) + $quote->shipment_cost;
                                            $totalEmdadCharges = $totalCost * (1.5 / 100);
                                        @endphp
                                        <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                            {{ number_format($totalCost,2) }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                            {{ number_format($totalEmdadCharges,2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                        <div class="flex flex-wrap overflow-hidden  p-4 mt-4">
                        </div>

                        <div class="flex justify-between px-2 py-2 mt-2 h-15">
                            <div></div>
                            <div class="mt-3">{{__('portal.Thank you for using Emdad platform for your business.')}}</div>
                            <div></div>
                        </div>
                        <div class="flex justify-end px-2 py-2 h-15">
                            <div class="mt-2">{{__('portal.Copied to Emdad records')}}</div>
                            <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-10 w-auto" style="margin-left: auto; margin-right: auto;"/></div>
                        </div>

                    </div>

                </div>
                <div class="flex justify-end mt-4 mb-4">

                    <a href="{{url()->previous()}}" class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                        {{__('portal.Back')}}
                    </a>
                </div>
            </div>
        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                <div class="bg-white overflow-hidden shadow-xl ">
                    {{--<div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                        <a href="{{ route('generatePDF', $draftPurchaseOrder) }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                            Generate PDF
                        </a>
                    </div>--}}
                    <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                        <div class="flex flex-wrap overflow-hidden bg-gray-100 p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <h1 class="text-center text-2xl">{{__('portal.Emdad Invoice for invoice')}} # &nbsp; <strong><br> {{__('portal.Emdad')}}-{{ $emdadInvoices[0]->invoice->id }}</strong></h1>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            {{--<div class="w-full overflow-hidden lg:w-1/4 xl:w-1/4">
                                <h1 class="text-center text-2xl">{{__('portal.Emdad Invoice for invoice')}} &nbsp; <strong>{{__('portal.Emdad')}}-{{ $emdadInvoices[0]->invoice->id }}</strong></h1>
                            </div>--}}
                        </div>
                        <table class="min-w-full divide-y divide-black ">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Delivery item')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Payment Type')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Amount w/o VAT')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Emdad invoice amount (1.5 %)')}}
                                    </th>
                                </tr>
                            </thead>
                            @php $deliveryItem = \App\Models\Delivery::where('draft_purchase_order_id', $emdadInvoices[0]->invoice->purchase_order->id)->first(); @endphp
                            <tbody class="bg-white divide-y divide-black border-1 border-black">
                                @foreach($emdadInvoices as $emdadInvoice)
                                    <tr>
                                        <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                            {{$loop->iteration}}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                            @php
                                                $record = \App\Models\Category::where('id',$deliveryItem->item_code)->first();
                                                $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                            @endphp
                                            {{ $record->name_ar }} @if(isset($parent->name)) , {{ $parent->name_ar }} @endif
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                            @if($deliveryItem->payment_term == 'Cash') {{__('portal.Cash')}}
                                            @elseif($deliveryItem->payment_term == 'Credit') {{__('portal.Credit')}}
                                            @elseif($deliveryItem->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                            @elseif($deliveryItem->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                            @elseif($deliveryItem->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                            @elseif($deliveryItem->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                            @endif
                                        </td>
                                        {{-- calculating total cost without VAT--}}
                                        @php
                                            $quote = \App\Models\Qoute::where('id', $emdadInvoice->invoice->quote->id)->first();
                                            $totalCost = ($quote->quote_quantity * $quote->quote_price_per_quantity) + $quote->shipment_cost;
                                            $totalEmdadCharges = $totalCost * (1.5 / 100);
                                        @endphp
                                        <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                            {{ number_format($totalCost,2) }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                            {{ number_format($totalEmdadCharges,2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                        <div class="flex flex-wrap overflow-hidden  p-4 mt-4">
                        </div>

                        <div class="flex justify-between px-2 py-2 mt-2 h-15">
                            <div></div>
                            <div class="mt-3">{{__('portal.Thank you for using Emdad platform for your business.')}}</div>
                            <div></div>
                        </div>
                        <div class="flex justify-end px-2 py-2 h-15">
                            <div class="mt-2">{{__('portal.Copied to Emdad records')}}</div>
                            <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-10 w-auto" style="margin-left: auto; margin-right: auto;"/></div>
                        </div>

                    </div>

                </div>
                <div class="flex justify-end mt-4 mb-4">

                    <a href="{{url()->previous()}}" class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                        {{__('portal.Back')}}
                    </a>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif
