@if (auth()->user()->rtl == 0)

@section('headerScripts')
    <style>
        @media (min-width: 600px) {
            .scroll-bar-for-large-screen{
                overflow-x:hidden;
            }
        }
    </style>
@endsection

    <x-app-layout>
        <div class="-my-2 overflow-x-auto sm:overflow-hidden lg:-mx-8 scroll-bar-for-large-screen">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="py-12">
                    <div style=" margin-left: 8px; margin-bottom: 10px ">
                        <a href="{{route('deliveryNotePDF', ['deliveryID' => $deliveries[0]->id, 'rfq_no' => $deliveries[0]->rfq_no, 'rfq_type' => $deliveries[0]->rfq_type])}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-gray-800 focus:shadow-outline-gray active:bg-red-600 transition ease-in-out duration-150">
                            {{__('portal.Create PDF')}}
                        </a>
                    </div>
                    <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                        <div class="bg-white overflow-hidden shadow-xl ">
                            <div class="px-4 py-5 sm:p-6 bg-white shadow ">

                                <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($deliveries[0]->buyer->business->business_photo_url) }}" alt="{{ $deliveries[0]->buyer->business->business_name }}" />--}}
{{--                                        <h1 class="text-center text-2xl">{{ $deliveries[0]->buyer->business->business_name }}</h1>--}}
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <img class="h-20 w-30 object-cover mx-auto" src="{{ Storage::url($deliveries[0]->supplier->business->business_photo_url) }}" alt="{{ $deliveries[0]->supplier->business->business_name }}" style="border-radius: 9px;"/>
                                        <h1 class="text-center text-3xl">{{__('portal.Delivery Note')}}</h1>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($deliveries[0]->supplier->business->business_photo_url) }}" alt="{{ $deliveries[0]->supplier->business->business_name }}" />--}}
{{--                                        <h1 class="text-center text-2xl">{{ $deliveries[0]->supplier->business->business_name }}</h1>--}}
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                        <strong>{{__('portal.Supplier')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveries[0]->supplier->business->business_name }}<br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $deliveries[0]->supplier->business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $deliveries[0]->supplier->business->vat_reg_certificate_number }}</span><br>
                                        <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $deliveries[0]->supplier->business->business_email }}</span><br><br>

                                        <strong>{{__('portal.Delivery Note')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.D.N.')}}-{{ $deliveries[0]->delivery_note_id }}<br>
                                        @if(isset($deliveries[0]->invoice))
                                            <strong>{{__('portal.Invoice')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Inv.')}}-{{ $deliveries[0]->invoice->id }}<br>
                                        @endif
                                        <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;</strong>{{__('portal.PO')}}-{{ $deliveries[0]->draft_purchase_order_id }}<br>
                                        <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveries[0]->created_at }}<br>
                                        <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $deliveries[0]->qoute_no }}<br>
                                        <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $deliveries[0]->rfq_item_no }}<br>
                                        <strong>{{__('portal.Payment Terms')}} : &nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                        @if($deliveries[0]->payment_term == 'Cash') {{__('portal.Cash')}}
                                        @elseif($deliveries[0]->payment_term == 'Credit') {{__('portal.Credit')}}
                                        @elseif($deliveries[0]->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                        @elseif($deliveries[0]->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                        @elseif($deliveries[0]->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                        @elseif($deliveries[0]->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                        @endif

                                    </div>

                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                        <img src="{{ Storage::url($deliveries[0]->buyer->business->business_photo_url) }}" alt="{{ $deliveries[0]->buyer->business->business_name }}" style="height: 115px;"/><br>
                                        <strong>{{__('portal.Buyer')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveries[0]->buyer->business->business_name }}<br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $deliveries[0]->buyer->business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $deliveries[0]->buyer->business->vat_reg_certificate_number }}</span><br>
                                        <strong>{{__('portal.Contact #')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $deliveries[0]->otp_mobile_number }}</span><br>
                                        <strong>{{__('portal.Delivery Address')}}: &nbsp;&nbsp;&nbsp;</strong><span>{{ $deliveries[0]->delivery_address }}</span><br>
                                    </div>
                                </div>

                                <table class="min-w-full divide-y divide-black ">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                            #
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Category Name')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Description')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.UOM')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Quantity')}}
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-black border-1 border-black">
                                    @foreach($deliveries as $delivery)
                                        <tr>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                {{$loop->iteration}}
                                            </td>
                                            @php
                                                $record = \App\Models\Category::where('id',$deliveries[0]->item_code)->first();
                                                $parent = \App\Models\Category::where('id',$record->parent_id)->first();
                                            @endphp
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                {{ $record->name }} @if(isset($parent)) , {{ $parent->name }} @endif
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                {{ $delivery->eOrderItems->description }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                {{ $delivery->eOrderItems->unit_of_measurement }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                {{ $delivery->quantity }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                {{-- Uncommet below lines after adding Delivery delivered stamp --}}
                                {{--@if ($deliveries[0]->status == 1)
                                    <div class="flex justify-between mt-4 mb-4">
                                        <img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-9@8x.png')}}" alt="{{__('portal.P.O. APPROVED')}}">
                                    </div>
                                @endif--}}

                                <div class="w-full overflow-hidden mt-2 lg:w-1/2 xl:w-2/3">
                                    <div class="mt-3 text-blue-600">{{__('portal.General note')}}:</div>
                                </div>
                                <div class="w-full overflow-hidden mt-2 lg:w-1/2 xl:w-2/3">
                                    <div class="text-blue-600">
                                        <li>{{__('portal.Emdad is a neutral Platform.')}}</li>
                                    </div>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
                                    <div class="text-blue-600">
                                        <li>{{__('portal.Quantity, quality and legality of the contents of this delivery are the supplier\'s responsibility.')}}</li>
                                    </div>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
                                    <div class="text-blue-600">
                                        <li>{{__('portal.Upon receiving the delivery, the buyer acknowledges that the quantity is correct and quality is acceptable.')}}</li>
                                    </div>
                                </div>

                                <div class="flex justify-between px-2 py-2 mt-3 h-15">
                                    <div></div>
                                    <div class="mt-3">{{__('portal.Thank you for using Emdad platform for your business.')}}</div>
                                    <div></div>
                                </div>
                                <div class="flex justify-end px-2 py-2 h-15">
                                    <div class="mt-2">{{__('portal.Copied to Emdad records')}}</div>
                                    <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-12 w-auto" style="margin-left: auto; margin-right: auto;"/></div>
                                </div>

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
                overflow-x:hidden;
            }
        }
    </style>
@endsection

    <x-app-layout>
        <div class="-my-2 overflow-x-auto sm:overflow-hidden lg:-mx-8 scroll-bar-for-large-screen">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="py-12">
                    <div style=" margin-right: 8px; margin-bottom: 10px ">
                        <a href="{{route('deliveryNotePDF', ['deliveryID' => $deliveries[0]->id, 'rfq_no' => $deliveries[0]->rfq_no, 'rfq_type' => $deliveries[0]->rfq_type])}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-gray-800 focus:shadow-outline-gray active:bg-red-600 transition ease-in-out duration-150">
                            {{__('portal.Create PDF')}}
                        </a>
                    </div>
                    <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                        <div class="bg-white overflow-hidden shadow-xl ">
                            <div class="px-4 py-5 sm:p-6 bg-white shadow ">

                                <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($deliveries[0]->buyer->business->business_photo_url) }}" alt="{{ $deliveries[0]->buyer->business->business_name }}" />--}}
{{--                                        <h1 class="text-center text-2xl">{{ $deliveries[0]->buyer->business->business_name }}</h1>--}}
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <img class="h-20 w-30 object-cover mx-auto" src="{{ Storage::url($deliveries[0]->supplier->business->business_photo_url) }}" alt="{{ $deliveries[0]->supplier->business->business_name }}" style="border-radius: 9px;"/>
                                        <h1 class="text-center text-3xl">{{__('portal.Delivery Note')}}</h1>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($deliveries[0]->supplier->business->business_photo_url) }}" alt="{{ $deliveries[0]->supplier->business->business_name }}" />--}}
{{--                                        <h1 class="text-center text-2xl">{{ $deliveries[0]->supplier->business->business_name }}</h1>--}}
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                        <strong>{{__('portal.Supplier')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveries[0]->supplier->business->business_name }}<br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $deliveries[0]->supplier->business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $deliveries[0]->supplier->business->vat_reg_certificate_number }}</span><br>
                                        <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $deliveries[0]->supplier->business->business_email }}</span><br><br>

                                        <strong>{{__('portal.Delivery Note')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.D.N.')}}-{{ $deliveries[0]->delivery_note_id }}<br>
                                        @if(isset($deliveries[0]->invoice))
                                            <strong>{{__('portal.Invoice')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Inv.')}}-{{ $deliveries[0]->invoice->id }}<br>
                                        @endif
                                        <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.PO')}}-{{ $deliveries[0]->draft_purchase_order_id }}<br>
                                        <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveries[0]->created_at }}<br>
                                        <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $deliveries[0]->qoute_no }}<br>
                                        <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $deliveries[0]->rfq_item_no }}<br>
                                        <strong>{{__('portal.Payment Terms')}} : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                        @if($deliveries[0]->payment_term == 'Cash') {{__('portal.Cash')}}
                                        @elseif($deliveries[0]->payment_term == 'Credit') {{__('portal.Credit')}}
                                        @elseif($deliveries[0]->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                        @elseif($deliveries[0]->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                        @elseif($deliveries[0]->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                        @elseif($deliveries[0]->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                        @endif
                                    </div>

                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                        <img src="{{ Storage::url($deliveries[0]->buyer->business->business_photo_url) }}" alt="{{ $deliveries[0]->buyer->business->business_name }}" style="height: 115px;"/><br>
                                        <strong>{{__('portal.Buyer')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveries[0]->buyer->business->business_name }}<br>
                                        {{--<div class="flex">
                                            <div class="flex-row">
                                                <p>{{ $deliveries[0]->buyer->business->business_name }}</p><br>
                                            </div>
                                            <div class="flex-row mx-auto">
                                                <img class="h-20 w-20" src="{{ Storage::url($deliveries[0]->buyer->business->business_photo_url) }}" alt="{{ $deliveries[0]->buyer->business->business_name }}" />
                                            </div>
                                        </div>--}}
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $deliveries[0]->buyer->business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $deliveries[0]->buyer->business->vat_reg_certificate_number }}</span><br>
                                        <strong>{{__('portal.Contact #')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $deliveries[0]->otp_mobile_number }}</span><br>
                                        <strong>{{__('portal.Delivery Address')}}: &nbsp;&nbsp;&nbsp;</strong><span>{{ $deliveries[0]->delivery_address }}</span><br>
                                    </div>
                                </div>

                                <table class="min-w-full divide-y divide-black ">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                            #
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Category Name')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Description')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.UOM')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Quantity')}}
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-black border-1 border-black">
                                    @foreach($deliveries as $delivery)
                                        <tr>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                {{$loop->iteration}}
                                            </td>
                                            @php
                                                $record = \App\Models\Category::where('id',$deliveries[0]->item_code)->first();
                                                $parent = \App\Models\Category::where('id',$record->parent_id)->first();
                                            @endphp
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                {{ $record->name_ar }} @if(isset($parent)) , {{ $parent->name_ar }} @endif
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                {{ $delivery->eOrderItems->description }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                {{ $delivery->eOrderItems->unit_of_measurement }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                {{ $delivery->quantity }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                {{--@if ($deliveries[0]->status == 1)
                                    <div class="flex justify-between mt-4 mb-4">
                                        <img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-9@8x.png')}}" alt="{{__('portal.P.O. APPROVED')}}">
                                    </div>
                                @endif--}}

                                <div class="w-full overflow-hidden mt-2 lg:w-1/2 xl:w-2/3">
                                    <div class="mt-3 text-blue-600">{{__('portal.General note')}}:</div>
                                </div>
                                <div class="w-full overflow-hidden mt-2 lg:w-1/2 xl:w-2/3">
                                    <div class="text-blue-600">
                                        <li>{{__('portal.Emdad is a neutral Platform.')}}</li>
                                    </div>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
                                    <div class="text-blue-600">
                                        <li>{{__('portal.Quantity, quality and legality of the contents of this delivery are the supplier\'s responsibility.')}}</li>
                                    </div>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
                                    <div class="text-blue-600">
                                        <li>{{__('portal.Upon receiving the delivery, the buyer acknowledges that the quantity is correct and quality is acceptable.')}}</li>
                                    </div>
                                </div>

                                <div class="flex justify-between px-2 py-2 mt-2 h-15">
                                    <div></div>
                                    <div class="mt-3">{{__('portal.Thank you for using Emdad platform for your business.')}}</div>
                                    <div></div>
                                </div>
                                <div class="flex justify-end px-2 py-2 h-15">
                                    <div class="mt-2">{{__('portal.Copied to Emdad records')}}</div>
                                    <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-12 w-auto" style="margin-left: auto; margin-right: auto;"/></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif
