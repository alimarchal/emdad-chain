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
                <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                    <div class="bg-white overflow-hidden shadow-xl ">
                        <div class="px-4 py-5 sm:p-6 bg-white shadow ">

                            <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                    <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($deliveries[0]->buyer->business->business_photo_url) }}" alt="{{ $deliveries[0]->buyer->business->business_name }}" />--}}
{{--                                    <h1 class="text-center text-2xl">{{ $deliveries[0]->buyer->business->business_name }}</h1>--}}
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <img class="h-20 w-20 rounded-full object-cover mx-auto" src="{{ Storage::url($deliveries[0]->supplier->business->business_photo_url) }}" alt="{{ $deliveries[0]->supplier->business->business_name }}" />
                                    <h1 class="text-center text-3xl">{{__('portal.Delivery Note')}}</h1>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                    <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($deliveries[0]->supplier->business->business_photo_url) }}" alt="{{ $deliveries[0]->supplier->business->business_name }}" />--}}
{{--                                    <h1 class="text-center text-2xl">{{ $deliveries[0]->supplier->business->business_name }}</h1>--}}
                                </div>
                            </div>

                            <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <strong>{{__('portal.Delivery Note')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.D.N.')}}-{{ $deliveries[0]->delivery_note_id }}<br>
                                    <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;</strong>{{__('portal.PO')}}-{{ $deliveries[0]->draft_purchase_order_id }}<br>
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
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <strong class="text-xl">
{{--                                        {{__('portal.Purchased From')}}: --}}
                                    </strong><br>
                                    <p class="text-xl">{{ $deliveries[0]->supplier->business->business_name }}</p><br>

                                    <strong class="text-xl">{{__('portal.City')}}: </strong><span class="text-xl">{{ $deliveries[0]->supplier->business->city }}</span><br>
                                    <strong class="text-xl">{{__('portal.VAT Number')}}: </strong><span class="text-xl">{{ $deliveries[0]->supplier->business->vat_reg_certificate_number }}</span><br>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                    <strong class="text-xl">{{__('portal.Buyer')}}: </strong><br>
                                    <div class="flex">
                                        <div class="flex-row">
                                            <p class="text-xl">{{ $deliveries[0]->buyer->business->business_name }}</p><br>
                                        </div>
                                        <div class="flex-row mx-auto">
                                            <img class="h-10 w-10" src="{{ Storage::url($deliveries[0]->buyer->business->business_photo_url) }}" alt="{{ $deliveries[0]->buyer->business->business_name }}" />
                                        </div>
                                    </div>
                                    <strong class="text-xl">{{__('portal.City')}}: </strong><span class="text-xl">{{ $deliveries[0]->buyer->business->city }}</span><br>
                                    <strong class="text-xl">{{__('portal.VAT Number')}}: </strong><span class="text-xl">{{ $deliveries[0]->buyer->business->vat_reg_certificate_number }}</span><br>
                                </div>
                            </div>

                            <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-screen">
                                    <strong class="text-xl">{{__('portal.Category Name')}}: </strong>
                                    @php
                                        $record = \App\Models\Category::where('id',$deliveries[0]->item_code)->first();
                                        $parent = \App\Models\Category::where('id',$record->parent_id)->first();
                                    @endphp
                                    <span class="text-xl">{{ $record->name }} @if(isset($parent)) , {{ $parent->name }} @endif</span>
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
                <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                    <div class="bg-white overflow-hidden shadow-xl ">
                        <div class="px-4 py-5 sm:p-6 bg-white shadow ">

                            <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                    <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($deliveries[0]->buyer->business->business_photo_url) }}" alt="{{ $deliveries[0]->buyer->business->business_name }}" />--}}
{{--                                    <h1 class="text-center text-2xl">{{ $deliveries[0]->buyer->business->business_name }}</h1>--}}
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <img class="h-20 w-20 rounded-full object-cover mx-auto" src="{{ Storage::url($deliveries[0]->supplier->business->business_photo_url) }}" alt="{{ $deliveries[0]->supplier->business->business_name }}" />
                                    <h1 class="text-center text-3xl">{{__('portal.Delivery Note')}}</h1>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                    <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($deliveries[0]->supplier->business->business_photo_url) }}" alt="{{ $deliveries[0]->supplier->business->business_name }}" />--}}
{{--                                    <h1 class="text-center text-2xl">{{ $deliveries[0]->supplier->business->business_name }}</h1>--}}
                                </div>
                            </div>

                            <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <strong>{{__('portal.Delivery Note')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.D.N.')}}-{{ $deliveries[0]->delivery_note_id }}<br>
                                    <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.PO')}}-{{ $deliveries[0]->draft_purchase_order_id }}<br>
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
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    <strong class="text-xl">
{{--                                        {{__('portal.Purchased From')}}: --}}
                                    </strong><br>
                                    <p class="text-xl">{{ $deliveries[0]->supplier->business->business_name }}</p><br>

                                    <strong class="text-xl">{{__('portal.City')}}: </strong><span class="text-xl">{{ $deliveries[0]->supplier->business->city }}</span><br>
                                    <strong class="text-xl">{{__('portal.VAT Number')}}: </strong><span class="text-xl">{{ $deliveries[0]->supplier->business->vat_reg_certificate_number }}</span><br>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                    <strong class="text-xl">{{__('portal.Buyer')}}: </strong><br>
                                    <div class="flex">
                                        <div class="flex-row">
                                            <p class="text-xl">{{ $deliveries[0]->buyer->business->business_name }}</p><br>
                                        </div>
                                        <div class="flex-row mx-auto">
                                            <img class="h-10 w-10" src="{{ Storage::url($deliveries[0]->buyer->business->business_photo_url) }}" alt="{{ $deliveries[0]->buyer->business->business_name }}" />
                                        </div>
                                    </div>
                                    <strong class="text-xl">{{__('portal.City')}}: </strong><span class="text-xl">{{ $deliveries[0]->buyer->business->city }}</span><br>
                                    <strong class="text-xl">{{__('portal.VAT Number')}}: </strong><span class="text-xl">{{ $deliveries[0]->buyer->business->vat_reg_certificate_number }}</span><br>
                                </div>
                            </div>

                            <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-screen">
                                    <strong class="text-xl">{{__('portal.Category Name')}}: </strong>
                                    @php
                                        $record = \App\Models\Category::where('id',$deliveries[0]->item_code)->first();
                                        $parent = \App\Models\Category::where('id',$record->parent_id)->first();
                                    @endphp
                                    <span class="text-xl">{{ $record->name_ar }} @if(isset($parent)) , {{ $parent->name_ar }} @endif</span>
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
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{--@if ($deliveries[0]->status == 1)
                                <div class="flex justify-between mt-4 mb-4">
                                    <img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-9@8x.png')}}" alt="{{__('portal.P.O. APPROVED')}}">
                                </div>
                            @endif--}}

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
