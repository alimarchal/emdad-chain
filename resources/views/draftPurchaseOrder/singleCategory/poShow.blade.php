@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                <div class="bg-white overflow-hidden shadow-xl ">
                    <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                        <form method="POST" action="{{route('singleCategoryGeneratePDF', $draftPurchaseOrders[0]->rfq_no) }}">
                            @csrf
                            <button type="submit" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-blue active:bg-blue-600 transition ease-in-out duration-150">
                                {{__('portal.Create PDF')}}
                            </button>
                        </form>
                       {{-- <a href="{{ route('singleCategoryGeneratePDF'), [ 'rfqNo' => $draftPurchaseOrders[0]->rfq_no] }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                            Create PDF
                        </a>--}}
                    </div>

                    <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                        <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrders[0]->buyer_business->business_photo_url) }}" alt="{{ $draftPurchaseOrders[0]->buyer_business->business_name }}"/>
                                <h1 class="text-center text-2xl">{{ $draftPurchaseOrders[0]->buyer_business->business_name }}</h1>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <h1 class="text-center text-3xl">{{__('portal.Purchase Order')}}</h1>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrders[0]->supplier_business->business_photo_url) }}" alt="{{ $draftPurchaseOrders[0]->supplier_business->business_name }}"/>
                                <h1 class="text-center text-2xl">{{ $draftPurchaseOrders[0]->supplier_business->business_name }}</h1>
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <strong class="text-xl">{{__('portal.Generated By')}}: </strong><br>
                                <p class="text-xl">{{ $draftPurchaseOrders[0]->buyer_business->business_name }}</p><br>
                                <strong class="text-xl">{{__('portal.City')}}: </strong><span class="text-xl">{{ $draftPurchaseOrders[0]->buyer_business->city }}</span><br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <strong class="text-xl">{{__('portal.Purchased From')}}: </strong><br>
                                <p class="text-xl">{{ $draftPurchaseOrders[0]->supplier_business->business_name }}</p><br>

                                <strong class="text-xl">{{__('portal.City')}}: </strong><span class="text-xl">{{ $draftPurchaseOrders[0]->supplier_business->city }}</span><br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                {{--<h3 class="text-2xl" style="padding-left: 55px;"><strong>{{__('portal.Purchase Order')}}</strong></h3>--}}
                                <strong>{{__('portal.P.O.')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.P.O.')}} -{{ $draftPurchaseOrders[0]->id }}<br>
                                {{--                            <strong>Category Code: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->item_code }}<br>--}}
                                <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->created_at }}<br>
                                <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @php
                                    $record = \App\Models\Category::where('id',$draftPurchaseOrders[0]->item_code)->first();
                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                @endphp
                                        {{ $record->name }} @if(isset($parent)) , {{ $parent->name }} @endif
{{--                                {{ $draftPurchaseOrders[0]->item_name }}--}}
                                <br>
                                <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $draftPurchaseOrders[0]->rfq_no }}<br>
                                <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $draftPurchaseOrders[0]->qoute_no }}<br>
                                <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    @if($draftPurchaseOrders[0]->payment_term == 'Cash') {{__('portal.Cash')}}
                                    @elseif($draftPurchaseOrders[0]->payment_term == 'Credit') {{__('portal.Credit')}}
                                    @elseif($draftPurchaseOrders[0]->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                    @elseif($draftPurchaseOrders[0]->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                    @elseif($draftPurchaseOrders[0]->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                    @elseif($draftPurchaseOrders[0]->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                    @endif
{{--                                    {{ $draftPurchaseOrders[0]->payment_term }}--}}
                                <br>
                                {{--                            <strong>VAT %: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->vat, 2) }}<br>--}}
                                {{--                            <strong>Shipping Fees: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->shipment_cost, 2) }}<br>--}}
                                {{--                            <strong>Total: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->total_cost, 2) }}<br>--}}
                            </div>
                        </div>

                        <table class="min-w-full divide-y divide-black ">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        #
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        {{__('portal.Brand')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        {{__('portal.UOM')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        {{__('portal.Remarks')}}
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
                            @foreach($draftPurchaseOrders as $draftPurchaseOrder)
                                <tbody class="bg-white divide-y divide-black border-1 border-black">
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{$loop->iteration}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $draftPurchaseOrder->brand }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $draftPurchaseOrder->uom }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        @if(isset($draftPurchaseOrder->remarks)){{ $draftPurchaseOrder->remarks }} @else {{__('portal.N/A')}} @endif
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $draftPurchaseOrder->unit_price }} {{__('portal.SAR')}}
                                    </td>

                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $draftPurchaseOrder->quantity }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ number_format($draftPurchaseOrder->sub_total, 2) }} {{__('portal.SAR')}}
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                @php
                                    $subtotal = 0;
                                        foreach($draftPurchaseOrders as $draftPurchaseOrder)
                                        {
                                            $subtotal += $draftPurchaseOrder->sub_total;
                                        }
                                @endphp
                                <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($subtotal, 2) }} {{__('portal.SAR')}}<br>
                                <strong>{{__('portal.VAT')}} %: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->vat, 2) }} {{__('portal.SAR')}}<br>
                                <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->shipment_cost, 2) }} {{__('portal.SAR')}}<br>
                                <hr>
                                <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->total_cost, 2) }} {{__('portal.SAR')}}<br>
                                <hr>
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden  p-4 mt-4">
                            <div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
                                <strong>{{__('portal.Mobile Number for OTP')}}: </strong> {{ $draftPurchaseOrders[0]->otp_mobile_number }} <br>
                                <strong>{{__('portal.Delivery Address')}}: </strong> {{ strip_tags($draftPurchaseOrders[0]->delivery_address) }} <br>
                            </div>
                        </div>


                        {{--                    <div class="flex justify-center">--}}
                        {{--                        <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block" style="height: 104px"/></div>--}}
                        {{--                    </div>--}}


                        <div class="flex justify-between mt-4 mb-4">

                            @if ($draftPurchaseOrders[0]->status == 'approved')
                                <img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-9@8x.png')}}" alt="{{__('portal.P.O. APPROVED')}}">
                            @elseif ($draftPurchaseOrders[0]->status == 'cancel')
                                <img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-8@8x.png')}}" alt="{{__('portal.P.O. Canceled')}}">
                            @elseif ($draftPurchaseOrders[0]->status == 'rejectToEdit')
                                <img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-7@8x.png')}}" alt="{{__('portal.Rejected for Edit')}}">
                            @elseif ($draftPurchaseOrders[0]->status == 'completed')
                            @elseif ($draftPurchaseOrders[0]->status == 'prepareDelivery')
                            @endif


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
            </div>
        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                <div class="bg-white overflow-hidden shadow-xl ">
                    <div class="mt-5" style=" margin-right: 30px; margin-bottom: 10px ">
                        <form method="POST" action="{{route('singleCategoryGeneratePDF', $draftPurchaseOrders[0]->rfq_no) }}">
                            @csrf
                            <button type="submit" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-blue active:bg-blue-600 transition ease-in-out duration-150">
                                {{__('portal.Create PDF')}}
                            </button>
                        </form>
                        {{-- <a href="{{ route('singleCategoryGeneratePDF'), [ 'rfqNo' => $draftPurchaseOrders[0]->rfq_no] }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                             Create PDF
                         </a>--}}
                    </div>

                    <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                        <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrders[0]->buyer_business->business_photo_url) }}" alt="{{ $draftPurchaseOrders[0]->buyer_business->business_name }}"/>
                                <h1 class="text-center text-2xl">{{ $draftPurchaseOrders[0]->buyer_business->business_name }}</h1>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <h1 class="text-center text-3xl">{{__('portal.Purchase Order')}}</h1>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrders[0]->supplier_business->business_photo_url) }}" alt="{{ $draftPurchaseOrders[0]->supplier_business->business_name }}"/>
                                <h1 class="text-center text-2xl">{{ $draftPurchaseOrders[0]->supplier_business->business_name }}</h1>
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <strong class="text-xl">{{__('portal.Generated By')}}: </strong><br>
                                <p class="text-xl">{{ $draftPurchaseOrders[0]->buyer_business->business_name }}</p><br>
                                <strong class="text-xl">{{__('portal.City')}}: </strong><span class="text-xl">{{ $draftPurchaseOrders[0]->buyer_business->city }}</span><br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <strong class="text-xl">{{__('portal.Purchased From')}}: </strong><br>
                                <p class="text-xl">{{ $draftPurchaseOrders[0]->supplier_business->business_name }}</p><br>

                                <strong class="text-xl">{{__('portal.City')}}: </strong><span class="text-xl">{{ $draftPurchaseOrders[0]->supplier_business->city }}</span><br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                {{--<h3 class="text-2xl" style="padding-right: 55px;"><strong>{{__('portal.Purchase Order')}}</strong></h3>--}}
                                <strong>{{__('portal.P.O.')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.P.O.')}}-{{ $draftPurchaseOrders[0]->id }}<br>
                                {{--                            <strong>Category Code: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->item_code }}<br>--}}
                                <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->created_at }}<br>
                                <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @php
                                    $record = \App\Models\Category::where('id',$draftPurchaseOrders[0]->item_code)->first();
                                    $parent = \App\Models\Category::where('id',$record->parent_id)->first();
                                @endphp
                                        {{ $record->name_ar }} @if(isset($parent)) , {{ $parent->name_ar }} @endif
                                <br>
                                <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $draftPurchaseOrders[0]->rfq_no }}<br>
                                <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $draftPurchaseOrders[0]->qoute_no }}<br>
                                <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    @if($draftPurchaseOrders[0]->payment_term == 'Cash') {{__('portal.Cash')}}
                                    @elseif($draftPurchaseOrders[0]->payment_term == 'Credit') {{__('portal.Credit')}}
                                    @elseif($draftPurchaseOrders[0]->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                    @elseif($draftPurchaseOrders[0]->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                    @elseif($draftPurchaseOrders[0]->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                    @elseif($draftPurchaseOrders[0]->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                    @endif
{{--                                    {{ $draftPurchaseOrders[0]->payment_term }}--}}
                                <br>
                                {{--                            <strong>VAT %: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->vat, 2) }}<br>--}}
                                {{--                            <strong>Shipping Fees: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->shipment_cost, 2) }}<br>--}}
                                {{--                            <strong>Total: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->total_cost, 2) }}<br>--}}
                            </div>
                        </div>

                        <table class="min-w-full divide-y divide-black ">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        #
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        {{__('portal.Brand')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        {{__('portal.UOM')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        {{__('portal.Remarks')}}
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
                            @foreach($draftPurchaseOrders as $draftPurchaseOrder)
                                <tbody class="bg-white divide-y divide-black border-1 border-black">
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{$loop->iteration}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $draftPurchaseOrder->brand }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $draftPurchaseOrder->uom }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        @if(isset($draftPurchaseOrder->remarks)){{ $draftPurchaseOrder->remarks }} @else {{__('portal.N/A')}} @endif
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $draftPurchaseOrder->unit_price }} {{__('portal.SAR')}}
                                    </td>

                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $draftPurchaseOrder->quantity }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ number_format($draftPurchaseOrder->sub_total, 2) }} {{__('portal.SAR')}}
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                @php
                                    $subtotal = 0;
                                        foreach($draftPurchaseOrders as $draftPurchaseOrder)
                                        {
                                            $subtotal += $draftPurchaseOrder->sub_total;
                                        }
                                @endphp
                                <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($subtotal, 2) }} {{__('portal.SAR')}}<br>
                                <strong>{{__('portal.VAT')}} %: &nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->vat, 2) }} {{__('portal.SAR')}}<br>
                                <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->shipment_cost, 2) }} {{__('portal.SAR')}}<br>
                                <hr>
                                <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->total_cost, 2) }} {{__('portal.SAR')}}<br>
                                <hr>
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden  p-4 mt-4">
                            <div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
                                <strong>{{__('portal.Mobile Number for OTP')}}: </strong> {{ $draftPurchaseOrders[0]->otp_mobile_number }} <br>
                                <strong>{{__('portal.Delivery Address')}}: </strong> {{ strip_tags($draftPurchaseOrders[0]->delivery_address) }} <br>
                            </div>
                        </div>


                        {{--                    <div class="flex justify-center">--}}
                        {{--                        <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block" style="height: 104px"/></div>--}}
                        {{--                    </div>--}}


                        <div class="flex justify-between mt-4 mb-4">

                            @if ($draftPurchaseOrders[0]->status == 'approved')
                                <img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-9@8x.png')}}" alt="{{__('portal.P.O. APPROVED')}}">
                            @elseif ($draftPurchaseOrders[0]->status == 'cancel')
                                <img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-8@8x.png')}}" alt="{{__('portal.P.O. Canceled')}}">
                            @elseif ($draftPurchaseOrders[0]->status == 'rejectToEdit')
                                <img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-7@8x.png')}}" alt="{{__('portal.Rejected for Edit')}}">
                            @elseif ($draftPurchaseOrders[0]->status == 'completed')
                            @elseif ($draftPurchaseOrders[0]->status == 'prepareDelivery')
                            @endif


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
            </div>
        </div>
    </x-app-layout>
@endif
