@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                <div class="bg-white overflow-hidden shadow-xl ">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                <h3 class="text-2xl" style="padding-left: 25px;"><strong>{{__('portal.Delivery details')}}</strong></h3>
                                <strong>{{__('portal.Delivery ID')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.D')}}-{{ $deliveries[0]->id }}<br>
                                <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;</strong>{{__('portal.P.O.')}} -{{ $deliveries[0]->draft_purchase_order_id }}<br>
                                <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    @php
                                        $record = \App\Models\Category::where('id',$deliveries[0]->item_code)->first();
                                        $parent = \App\Models\Category::where('id',$record->parent_id)->first();
                                    @endphp
                                    {{ $record->name }} @if(isset($parent)) , {{ $parent->name }} @endif
                                <br>
                                <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveries[0]->created_at }}<br>
                                <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $deliveries[0]->rfq_no }}<br>
                                <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $deliveries[0]->qoute_no }}<br>
                                <strong>{{__('portal.Payment Terms')}} : &nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    @if($deliveries[0]->payment_term == 'Cash') {{__('portal.Cash')}}
                                    @elseif($deliveries[0]->payment_term == 'Credit') {{__('portal.Credit')}}
                                    @elseif($deliveries[0]->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                    @elseif($deliveries[0]->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                    @elseif($deliveries[0]->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                    @elseif($deliveries[0]->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                    @endif
                                <br>
                            </div>
                        </div>
                        <table class="min-w-full divide-y divide-black ">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        #
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Description')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Quantity')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Unit Price')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Total')}}
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-black border-1 border-black">
                            @foreach($deliveries as $delivery)
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{$loop->iteration}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $delivery->eOrderItems->description }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $delivery->quantity }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $delivery->unit_price }} {{__('portal.SAR')}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ number_format($delivery->quantity * $delivery->unit_price, 2) }} {{__('portal.SAR')}}
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
                                @php $subtotal = 0;
                                    foreach ($deliveries as $delivery)
                                    {
                                        $subtotal += $delivery->invoice->purchase_order->quantity * $delivery->invoice->purchase_order->unit_price;
                                    }
                                @endphp
                                <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($subtotal, 2) }} {{__('portal.SAR')}}<br>
                                <strong>{{__('portal.VAT')}} %: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveries[0]->vat }}<br>
                                <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveries[0]->shipment_cost }} {{__('portal.SAR')}}<br>
                                <hr>
                                <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($deliveries[0]->total_cost, 2) }} {{__('portal.SAR')}}<br>
                                <hr>
                            </div>
                        </div>

                        <br>
                        <br>

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
            <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                <div class="bg-white overflow-hidden shadow-xl ">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                <h3 class="text-2xl" style="padding-right: 25px;"><strong>{{__('portal.Delivery details')}}</strong></h3>
                                <strong>{{__('portal.Delivery ID')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.D')}}-{{ $deliveries[0]->id }}<br>
                                <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.P.O.')}}-{{ $deliveries[0]->draft_purchase_order_id }}<br>
                                <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    @php
                                        $record = \App\Models\Category::where('id',$deliveries[0]->item_code)->first();
                                        $parent = \App\Models\Category::where('id',$record->parent_id)->first();
                                    @endphp
                                    {{ $record->name_ar }} @if(isset($parent)) , {{ $parent->name_ar }} @endif
                                <br>
                                <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveries[0]->created_at }}<br>
                                <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $deliveries[0]->rfq_no }}<br>
                                <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $deliveries[0]->qoute_no }}<br>
                                <strong>{{__('portal.Payment Terms')}} : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @if($deliveries[0]->payment_term == 'Cash') {{__('portal.Cash')}}
                                @elseif($deliveries[0]->payment_term == 'Credit') {{__('portal.Credit')}}
                                @elseif($deliveries[0]->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                @elseif($deliveries[0]->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                @elseif($deliveries[0]->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                @elseif($deliveries[0]->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                @endif
                                <br>
                            </div>
                        </div>
                        <table class="min-w-full divide-y divide-black ">
                            <thead>
                            <tr>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                    #
                                </th>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                    {{__('portal.Description')}}
                                </th>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                    {{__('portal.Quantity')}}
                                </th>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                    {{__('portal.Unit Price')}}
                                </th>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                    {{__('portal.Total')}}
                                </th>

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-black border-1 border-black">
                            @foreach($deliveries as $delivery)
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{$loop->iteration}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $delivery->eOrderItems->description }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $delivery->quantity }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $delivery->unit_price }} {{__('portal.SAR')}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ number_format($delivery->quantity * $delivery->unit_price, 2) }} {{__('portal.SAR')}}
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
                                @php $subtotal = 0;
                                    foreach ($deliveries as $delivery)
                                    {
                                        $subtotal += $delivery->invoice->purchase_order->quantity * $delivery->invoice->purchase_order->unit_price;
                                    }
                                @endphp
                                <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($subtotal, 2) }} {{__('portal.SAR')}}<br>
                                <strong>{{__('portal.VAT')}} %: &nbsp;&nbsp;</strong>{{ $deliveries[0]->vat }}<br>
                                <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveries[0]->shipment_cost }} {{__('portal.SAR')}}<br>
                                <hr>
                                <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($deliveries[0]->total_cost, 2) }} {{__('portal.SAR')}}<br>
                                <hr>
                            </div>
                        </div>

                        <br>
                        <br>

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
