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
        <div class="-my-2 overflow-x-auto sm:overflow-hidden lg:-mx-8 scroll-bar-for-large-screen">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                        <div class="bg-white overflow-hidden shadow-xl ">
                            <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                                {{--<a href="{{ route('generatePDF', $draftPurchaseOrders[0]) }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                    Create PDF
                                </a>--}}
                            </div>

                            <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                                <div class="flex flex-wrap overflow-hidden bg-gray-100 p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrders[0]->buyer_business->business_photo_url) }}" alt="{{ $draftPurchaseOrders[0]->buyer_business->business_name }}"/>
                                        <h1 class="text-center text-2xl">{{ $draftPurchaseOrders[0]->buyer_business->business_name }}</h1>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <h1 class="text-center text-3xl">{{__('portal.Draft Purchase Order')}}</h1>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrders[0]->supplier_business->business_photo_url) }}" alt="{{ $draftPurchaseOrders[0]->supplier_business->business_name }}"/>
                                        <h1 class="text-center text-2xl">{{ $draftPurchaseOrders[0]->supplier_business->business_name }}</h1>
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <strong class="text-xl">{{__('portal.Buyer')}}: </strong><br>
                                        <p class="text-xl">{{ $draftPurchaseOrders[0]->buyer_business->business_name }}</p><br>
                                        <strong class="text-xl">{{__('portal.City')}}: </strong><span class="text-xl">{{ $draftPurchaseOrders[0]->buyer_business->city }}</span><br>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <strong class="text-xl">{{__('portal.Supplier')}}: </strong><br>
                                        <p class="text-xl">{{ $draftPurchaseOrders[0]->supplier_business->business_name }}</p><br>

                                        <strong class="text-xl">{{__('portal.City')}}: </strong><span class="text-xl">{{ $draftPurchaseOrders[0]->supplier_business->city }}</span><br>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                        <strong>{{__('portal.D.P.O.')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.DPO')}}-{{ $draftPurchaseOrders[0]->id }}<br>
                                        <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->created_at }}<br>
                                        <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $draftPurchaseOrders[0]->rfq_no }}<br>
                                        <strong>{{__('portal.Quote')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $draftPurchaseOrders[0]->qoute_no }}<br>
                                        <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                        @if($draftPurchaseOrders[0]->payment_term == 'Cash') {{__('portal.Cash')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit') {{__('portal.Credit')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                        @endif
                                        <br>

                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-screen">
                                        <strong class="text-xl">{{__('portal.Category Name')}}: </strong>
                                        @php
                                            $record = \App\Models\Category::where('id',$draftPurchaseOrders[0]->item_code)->first();
                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                        @endphp
                                        <span class="text-xl text-blue-600">{{ $record->name }} @if(isset($parent)) , {{ $parent->name }} @endif</span>
                                    </div>
                                </div>

                                <table class="min-w-full divide-y divide-black ">
                                    <thead style="background-color: #FCE5CD;">
                                    <tr>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" >
                                            #
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" >
                                            {{__('portal.Brand')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" >
                                            {{__('portal.Description')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" >
                                            {{__('portal.UOM')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" >
                                            {{__('portal.Remarks')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" >
                                            {{__('portal.Unit Price')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" >
                                            {{__('portal.Quantity')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" >
                                            {{__('portal.Amount')}}
                                        </th>
                                    </tr>
                                    </thead>
                                    @foreach($draftPurchaseOrders as $draftPurchaseOrder)
                                        <tbody class="bg-white divide-y divide-black border-1 border-black">
                                        <tr>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{$loop->iteration}}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->brand }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->eOrderItem->description }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->uom }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                @if(isset($draftPurchaseOrder->remarks)){{ strip_tags($draftPurchaseOrder->remarks) }} @else {{__('portal.N/A')}} @endif
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->unit_price }} {{__('portal.SAR')}}
                                            </td>

                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->quantity }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
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
                                        @php $subtotal = 0;
                                            foreach ($draftPurchaseOrders as $draftPurchaseOrder)
                                            {
                                                $subtotal += $draftPurchaseOrder->quantity * $draftPurchaseOrder->unit_price;
                                            }
                                        @endphp
                                        <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($subtotal, 2) }} {{__('portal.SAR')}}<br>
                                        <strong>{{__('portal.VAT')}} {{ number_format($draftPurchaseOrders[0]->vat) }}%: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format(($subtotal + $draftPurchaseOrders[0]->shipment_cost) * ($draftPurchaseOrders[0]->vat/100), 2) }} {{__('portal.SAR')}}<br>
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
                                        <strong class="text-red-900">{{__('portal.Note')}}: </strong> <span class="text-red-700">
                                {{__('portal.We acknowledge that')}} {{$draftPurchaseOrders[0]->buyer_business->business_name }}
                                            {{__('portal.agrees to deal with')}} {{$draftPurchaseOrders[0]->supplier_business->business_name}}. <br>
                                {{__('portal.Emdad has no responsibility with the kind of delivery and the source of finance for this delivery.')}}</span> <br>

                                        @if($draftPurchaseOrders[0]->quote->expiry_date >= \Carbon\Carbon::now() && $draftPurchaseOrders[0]->status != 'cancel')
                                            <label for="acknowledge" class="flex items-center">
                                                <input id="acknowledge" type="checkbox" class="form-checkbox" name="note">
                                                <span class="ml-2">
                                                    {{__('portal.Please read the note and check if you agree to proceed')}}
                                                </span>
                                            </label>
                                        @endif
                                    </div>
                                </div>


                                <div class="flex justify-center">
                                    <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block" style="height: 104px"/></div>
                                </div>


                                <div class="flex justify-between mt-4 mb-4">

                                    @if ($draftPurchaseOrders[0]->status == 'approved')
                                        <span class="px-3 py-3 bg-green-800 text-white rounded">{{__('portal.Approve')}}</span>
                                    @elseif ($draftPurchaseOrders[0]->status == 'cancel')
                                        <span class="px-3 py-3 bg-red-800 text-white rounded">{{__('portal.Cancel DPO')}}</span>
                                    @elseif ($draftPurchaseOrders[0]->status == 'rejectToEdit')
                                        <span class="px-3 py-3 bg-red-600 text-white rounded uppercase">{{__('portal.Rejected for Edit')}}</span>
                                    @else
                                        @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))

                                            @if($draftPurchaseOrder->quote->expiry_date >= \Carbon\Carbon::now())
                                                <form method="POST" action="{{route('singleCategoryCancel', [ 'rfqNo' => $draftPurchaseOrders[0]->rfq_no, 'supplierBusinessID' => $draftPurchaseOrders[0]->supplier_business_id]) }}"  class="confirm-delete">
                                                    @csrf
                                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                        {{__('portal.Cancel DPO')}}
                                                    </button>
                                                </form>
                                            @endif

                                            @if($draftPurchaseOrder->quote->expiry_date >= \Carbon\Carbon::now())
                                                <form method="POST" action="{{route('singleCategoryApproved', [ 'rfqNo' => $draftPurchaseOrders[0]->rfq_no, 'supplierBusinessID' => $draftPurchaseOrders[0]->supplier_business_id]) }}" class="confirm">
                                                    @csrf
                                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                                        {{__('portal.Generate PO')}}
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    @endif


                                </div>

                                <div class="flex justify-between px-2 py-2 mt-2 h-15">
                                    <div></div>
                                    <div class="mt-3">{{__('portal.Thanks for your Business')}}</div>
                                    <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block" style="height: 60px"/></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script>

        $('.confirm').on('click', function (e) {
            if (!$("#acknowledge").is(":checked")) {
                // do something if the checkbox is NOT checked
                alert('Please read the note and check if you agree to proceed')
                event.preventDefault();
            }
            else if ($("#acknowledge").is(":checked")) {
                if(!confirm('Are you sure?')){
                    e.preventDefault();
                }
            }
        });

        $('.confirm-delete').on('click', function (e) {
            if(!confirm('Are you sure?')){
                e.preventDefault();
            }
        });

        /*function checkbox() {
            if (!$("#acknowledge").is(":checked")) {
                alert('Please check NOTE to acknowledge')
                event.preventDefault();
            }
        }*/
    </script>
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
        <div class="-my-2 overflow-x-auto sm:overflow-hidden lg:-mx-8 scroll-bar-for-large-screen">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                        <div class="bg-white overflow-hidden shadow-xl ">
                            <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                                {{--<a href="{{ route('generatePDF', $draftPurchaseOrders[0]) }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                    Create PDF
                                </a>--}}
                            </div>

                            <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                                <div class="flex flex-wrap overflow-hidden bg-gray-100 p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrders[0]->buyer_business->business_photo_url) }}" alt="{{ $draftPurchaseOrders[0]->buyer_business->business_name }}"/>
                                        <h1 class="text-center text-2xl">{{ $draftPurchaseOrders[0]->buyer_business->business_name }}</h1>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <h1 class="text-center text-3xl">{{__('portal.Draft Purchase Order')}}</h1>
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
                                        <h3 class="text-2xl" style="padding-right: 55px;"><strong>{{__('portal.Draft P.O.')}}</strong></h3>
                                        <strong>{{__('portal.D.P.O.')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.DPO')}}-{{ $draftPurchaseOrders[0]->id }}<br>
                                        <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->created_at }}<br>
                                        <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $draftPurchaseOrders[0]->rfq_no }}<br>
                                        <strong>{{__('portal.Quote')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $draftPurchaseOrders[0]->qoute_no }}<br>
                                        <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                        @if($draftPurchaseOrders[0]->payment_term == 'Cash') {{__('portal.Cash')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit') {{__('portal.Credit')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                        @endif
                                        <br>
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-screen">
                                        <strong class="text-xl">{{__('portal.Category Name')}}: </strong>
                                        @php
                                            $record = \App\Models\Category::where('id',$draftPurchaseOrders[0]->item_code)->first();
                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                        @endphp
                                        <span class="text-xl text-blue-600"> {{ $record->name_ar }} @if(isset($parent)) , {{ $parent->name_ar }} @endif</span>
                                    </div>
                                </div>

                                <table class="min-w-full divide-y divide-black ">
                                    <thead  style="background-color: #FCE5CD;">
                                    <tr>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" >
                                            #
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" >
                                            {{__('portal.Brand')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" >
                                            {{__('portal.Description')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" >
                                            {{__('portal.UOM')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" >
                                            {{__('portal.Remarks')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" >
                                            {{__('portal.Unit Price')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" >
                                            {{__('portal.Quantity')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" >
                                            {{__('portal.Amount')}}
                                        </th>
                                    </tr>
                                    </thead>
                                    @foreach($draftPurchaseOrders as $draftPurchaseOrder)
                                        <tbody class="bg-white divide-y divide-black border-1 border-black">
                                        <tr>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{$loop->iteration}}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->brand }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->eOrderItem->description }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->uom }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                @if(isset($draftPurchaseOrder->remarks)){{ strip_tags($draftPurchaseOrder->remarks) }} @else {{__('portal.N/A')}} @endif
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->unit_price }} {{__('portal.SAR')}}
                                            </td>

                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->quantity }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
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
                                        @php $subtotal = 0;
                                            foreach ($draftPurchaseOrders as $draftPurchaseOrder)
                                            {
                                                $subtotal += $draftPurchaseOrder->quantity * $draftPurchaseOrder->unit_price;
                                            }
                                        @endphp
                                        <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($subtotal, 2) }} {{__('portal.SAR')}}<br>
                                        <strong>{{__('portal.VAT')}} {{ number_format($draftPurchaseOrders[0]->vat) }}%: &nbsp;</strong>{{ number_format(($subtotal + $draftPurchaseOrders[0]->shipment_cost) * ($draftPurchaseOrders[0]->vat/100), 2) }} {{__('portal.SAR')}}<br>
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
                                        <strong class="text-red-900">{{__('portal.Note')}}: </strong> <span class="text-red-700">
                                {{__('portal.We acknowledge that')}} {{$draftPurchaseOrders[0]->buyer_business->business_name }}
                                            {{__('portal.agrees to deal with')}} {{$draftPurchaseOrders[0]->supplier_business->business_name}}. <br>
                                {{__('portal.Emdad has no responsibility with the kind of delivery and the source of finance for this delivery.')}}</span> <br>
                                        @if($draftPurchaseOrders[0]->quote->expiry_date >= \Carbon\Carbon::now() && $draftPurchaseOrders[0]->status != 'cancel')
                                            <div class="block mt-4 ml-4">
                                                <label for="acknowledge" class="flex items-center">
                                                    <input id="acknowledge" type="checkbox" class="form-checkbox" name="note">
                                                    <span class="mr-2">
                                                        {{__('portal.Please read the note and check if you agree to proceed')}}
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                </div>


                                <div class="flex justify-center">
                                    <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block" style="height: 104px"/></div>
                                </div>


                                <div class="flex justify-between mt-4 mb-4">

                                    @if ($draftPurchaseOrders[0]->status == 'approved')
                                        <span class="px-3 py-3 bg-green-800 text-white rounded">{{__('portal.Approve')}}</span>
                                    @elseif ($draftPurchaseOrders[0]->status == 'cancel')
                                        <span class="px-3 py-3 bg-red-800 text-white rounded">{{__('portal.Cancel DPO')}}</span>
                                    @elseif ($draftPurchaseOrders[0]->status == 'rejectToEdit')
                                        <span class="px-3 py-3 bg-red-600 text-white rounded uppercase">{{__('portal.Rejected for Edit')}}</span>
                                    @else
                                        @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))
                                            @if($draftPurchaseOrder->quote->expiry_date >= \Carbon\Carbon::now())
                                                <form method="POST" action="{{route('singleCategoryCancel', [ 'rfqNo' => $draftPurchaseOrders[0]->rfq_no, 'supplierBusinessID' => $draftPurchaseOrders[0]->supplier_business_id]) }}"  class="confirm-delete">
                                                    @csrf
                                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                        {{__('portal.Cancel DPO')}}
                                                    </button>
                                                </form>
                                            @endif

                                            @if($draftPurchaseOrder->quote->expiry_date >= \Carbon\Carbon::now())
                                                <form method="POST" action="{{route('singleCategoryApproved', [ 'rfqNo' => $draftPurchaseOrders[0]->rfq_no, 'supplierBusinessID' => $draftPurchaseOrders[0]->supplier_business_id]) }}" class="confirm">
                                                    @csrf
                                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                                        {{__('portal.Generate PO')}}
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    @endif


                                </div>

                                <div class="flex justify-between px-2 py-2 mt-2 h-15">
                                    <div></div>
                                    <div class="mt-3">{{__('portal.Thanks for your Business')}}</div>
                                    <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block" style="height: 60px"/></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script>

        $('.confirm').on('click', function (e) {
            if (!$("#acknowledge").is(":checked")) {
                // do something if the checkbox is NOT checked
                alert('يرجى قراءة الملاحظة والتأكيد في حال الموافقة للمتابعة')
                event.preventDefault();
            }
            else if ($("#acknowledge").is(":checked")) {
                if(!confirm('هل أنت متأكد؟')){
                    e.preventDefault();
                }
            }
        });

        $('.confirm-delete').on('click', function (e) {
            if(!confirm('هل أنت متأكد؟')){
                e.preventDefault();
            }
        });

        /*function checkbox() {
            if (!$("#acknowledge").is(":checked")) {
                alert('Please check NOTE to acknowledge')
                event.preventDefault();
            }
        }*/
    </script>
@endif
