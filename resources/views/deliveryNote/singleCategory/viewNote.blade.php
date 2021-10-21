@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <div class="py-12">
            <div class="mt-5" style=" margin-left: 8px; margin-bottom: 10px ">
                <a href="{{ route('singleCategoryDeliveryNoteGeneratePDF', $deliveryNotes[0]->rfq_no) }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-gray-800 focus:shadow-outline-gray active:bg-red-600 transition ease-in-out duration-150">
                    {{__('portal.Create PDF')}}
                </a>
            </div>
            <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                <div class="bg-white overflow-hidden shadow-xl ">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow ">

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <h3 class="text-2xl text-center"><strong>{{__('portal.Delivery Note')}}</strong></h3>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                @if ($deliveryNotes[0]->status == 'completed')
                                    <strong>{{__('portal.Invoice')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Inv.')}}-{{ $deliveryNotes[0]->delivery->invoice_id }}<br>
                                @endif
                                <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.P.O.')}} -{{ $deliveryNotes[0]->purchase_order->id }}<br>
                                <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    @php
                                        $record = \App\Models\Category::where('id',$deliveryNotes[0]->purchase_order->item_code)->first();
                                        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                    @endphp
                                    <span class="text-blue-600"> {{ $record->name }} , {{ $parent->name }} </span>
                                    <br>
                                <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveryNotes[0]->purchase_order->created_at }}<br>
                                <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $deliveryNotes[0]->purchase_order->rfq_no }}<br>
                                <strong>{{__('portal.Quote')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $deliveryNotes[0]->purchase_order->qoute_no }}<br>
                                <strong>{{__('portal.Payment Terms')}} : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    @if($deliveryNotes[0]->purchase_order->payment_term == 'Cash') {{__('portal.Cash')}}
                                    @elseif($deliveryNotes[0]->purchase_order->payment_term == 'Credit') {{__('portal.Credit')}}
                                    @elseif($deliveryNotes[0]->purchase_order->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                    @elseif($deliveryNotes[0]->purchase_order->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                    @elseif($deliveryNotes[0]->purchase_order->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                    @elseif($deliveryNotes[0]->purchase_order->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                    @endif
                                    <br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                @php
                                    $supplierBusiness = \App\Models\Business::where('id', $deliveryNotes[0]->supplier_business_id)->first();
                                @endphp
                                <img src="{{(isset($supplierBusiness->business_photo_url)?Storage::url($supplierBusiness->business_photo_url):'#')}}" alt="logo" style="height: 80px;width: 200px;"/>
                            </div>
                            {{--<div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            </div>--}}
                        </div>

                        <table class="min-w-full divide-y divide-black ">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        #
                                    </th>

                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        {{__('portal.Description')}}
                                    </th>

                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        {{__('portal.UOM')}}
                                    </th>


                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        {{__('portal.Quantity')}}
                                    </th>

                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-black border-1 border-black">
                                @foreach($deliveryNotes as $deliveryNote)
                                    <tr>
                                        <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                            {{$loop->iteration}}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                            {{ $deliveryNote->purchase_order->eOrderItem->description }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                            {{ $deliveryNote->purchase_order->uom }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                            {{ $deliveryNote->purchase_order->quantity }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <br>
                        <br>
                        @if ($deliveryNotes[0]->status == 'processing')
                            <h2 class="text-2xl text-center font-bold">{{__('portal.Invoice Generate')}}</h2>
                            <p>
                                <strong>{{__('portal.Delivery Address')}}:</strong> {{ $deliveryNotes[0]->delivery_address }}<br>
                                <strong>{{__('portal.City')}}:</strong> {{ $deliveryNotes[0]->city }}<br>
                                @if(isset($deliveryNotes[0]->terms_and_conditions)) <strong>{{__('portal.Terms and Conditions')}}:</strong> {{ $deliveryNotes[0]->terms_and_conditions }}<br> @endif
                                @if(isset($deliveryNotes[0]->warranty)) <strong>{{__('portal.Warranty')}}:</strong> {{ $deliveryNotes[0]->warranty }}<br> @endif
                            </p>

                            <form action="{{ route('singleCategoryInvoiceGenerate') }}" method="post">
                                @csrf
                                <div class="mt-5">
                                    <input type="hidden" name="rfq_no" value="{{ $deliveryNotes[0]->rfq_no }}">
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                        {{__('portal.Generate Final Invoice')}}
                                    </button>
                                </div>
                            </form>
                        @endif

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
            </div>
        </div>

    </x-app-layout>
@else
    <x-app-layout>
        <div class="py-12">
            <div class="mt-5" style=" margin-right: 8px; margin-bottom: 10px ">
                <a href="{{ route('singleCategoryDeliveryNoteGeneratePDF', $deliveryNotes[0]->rfq_no) }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-gray-800 focus:shadow-outline-gray active:bg-red-600 transition ease-in-out duration-150">
                    {{__('portal.Create PDF')}}
                </a>
            </div>
            <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                <div class="bg-white overflow-hidden shadow-xl ">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow ">

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <h3 class="text-2xl text-center"><strong>{{__('portal.Delivery Note')}}</strong></h3>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                @if ($deliveryNotes[0]->status == 'completed')
                                    <strong>{{__('portal.Invoice')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Inv.')}}-{{ $deliveryNotes[0]->delivery->invoice_id }}<br>
                                @endif
                                <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.P.O.')}}-{{ $deliveryNotes[0]->purchase_order->id }}<br>
                                <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @php
                                    $record = \App\Models\Category::where('id',$deliveryNotes[0]->purchase_order->item_code)->first();
                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                @endphp
                                <span class="text-blue-600"> {{ $record->name_ar }} , {{ $parent->name_ar }} </span>
                                <br>
                                <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveryNotes[0]->purchase_order->created_at }}<br>
                                <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $deliveryNotes[0]->purchase_order->rfq_no }}<br>
                                <strong>{{__('portal.Quote')}} #: &nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $deliveryNotes[0]->purchase_order->qoute_no }}<br>
                                <strong>{{__('portal.Payment Terms')}} : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @if($deliveryNotes[0]->purchase_order->payment_term == 'Cash') {{__('portal.Cash')}}
                                @elseif($deliveryNotes[0]->purchase_order->payment_term == 'Credit') {{__('portal.Credit')}}
                                @elseif($deliveryNotes[0]->purchase_order->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                @elseif($deliveryNotes[0]->purchase_order->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                @elseif($deliveryNotes[0]->purchase_order->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                @elseif($deliveryNotes[0]->purchase_order->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                @endif
                                <br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                @php
                                    $supplierBusiness = \App\Models\Business::where('id', $deliveryNotes[0]->supplier_business_id)->first();
                                @endphp
                                <img src="{{(isset($supplierBusiness->business_photo_url)?Storage::url($supplierBusiness->business_photo_url):'#')}}" alt="logo" style="height: 80px;width: 200px;"/>
                            </div>
                            {{--<div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            </div>--}}
                        </div>


                        <table class="min-w-full divide-y divide-black ">
                            <thead>
                            <tr>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                    #
                                </th>

                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                    {{__('portal.Description')}}
                                </th>

                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                    {{__('portal.UOM')}}
                                </th>


                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                    {{__('portal.Quantity')}}
                                </th>

                            </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-black border-1 border-black">
                            @foreach($deliveryNotes as $deliveryNote)
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                        {{$loop->iteration}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                        {{ $deliveryNote->purchase_order->eOrderItem->description }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                        {{ $deliveryNote->purchase_order->uom }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                        {{ $deliveryNote->purchase_order->quantity }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <br>
                        <br>
                        @if ($deliveryNotes[0]->status == 'processing')
                            <h2 class="text-2xl text-center font-bold">{{__('portal.Invoice Generate')}}</h2>
                            <p>
                                <strong>{{__('portal.Delivery Address')}}:</strong> {{ $deliveryNotes[0]->delivery_address }}<br>
                                <strong>{{__('portal.City')}}:</strong> {{ $deliveryNotes[0]->city }}<br>
                                @if(isset($deliveryNotes[0]->terms_and_conditions)) <strong>{{__('portal.Terms and Conditions')}}:</strong> {{ $deliveryNotes[0]->terms_and_conditions }}<br> @endif
                                @if(isset($deliveryNotes[0]->warranty)) <strong>{{__('portal.Warranty')}}:</strong> {{ $deliveryNotes[0]->warranty }}<br> @endif
                            </p>

                            <form action="{{ route('singleCategoryInvoiceGenerate') }}" method="post">
                                @csrf
                                <div class="mt-5">
                                    <input type="hidden" name="rfq_no" value="{{ $deliveryNotes[0]->rfq_no }}">
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                        {{__('portal.Generate Final Invoice')}}
                                    </button>
                                </div>
                            </form>
                        @endif

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
            </div>
        </div>

    </x-app-layout>
@endif
