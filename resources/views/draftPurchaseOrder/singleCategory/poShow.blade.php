@if (auth()->user()->rtl == 0)

@section('headerScripts')
    <style>
        @media (min-width: 800px) {
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
                        @if (session()->has('message'))
                            <div class="mb-3 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                                <strong class="ml-2">{{ session('message') }}</strong>
                                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="mb-3 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="ml-3">{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif

                        <div class="bg-white overflow-hidden shadow-xl ">
                            <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                                <form method="POST" action="{{route('singleCategoryGeneratePDF', $draftPurchaseOrders[0]->rfq_no) }}">
                                    @csrf
                                    <button type="submit" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-blue active:bg-blue-600 transition ease-in-out duration-150">
                                        {{__('portal.Create PDF')}}
                                    </button>
                                </form>
                            </div>

                            <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                                <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrders[0]->buyer_business->business_photo_url) }}" alt="{{ $draftPurchaseOrders[0]->buyer_business->business_name }}"/>--}}
{{--                                        <h1 class="text-center text-2xl">{{ $draftPurchaseOrders[0]->buyer_business->business_name }}</h1>--}}
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <img class="h-20 w-30 object-cover mx-auto" src="{{ Storage::url($draftPurchaseOrders[0]->buyer_business->business_photo_url) }}" style="border-radius: 9px;"/>
                                        <h1 class="text-center text-3xl">{{__('portal.Purchase Order')}}</h1>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrders[0]->supplier_business->business_photo_url) }}" alt="{{ $draftPurchaseOrders[0]->supplier_business->business_name }}"/>--}}
{{--                                        <h1 class="text-center text-2xl">{{ $draftPurchaseOrders[0]->supplier_business->business_name }}</h1>--}}
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                        <strong>{{__('portal.Buyer')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->buyer_business->business_name }}<br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrders[0]->buyer_business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrders[0]->buyer_business->vat_reg_certificate_number }}</span><br>
                                        <strong>{{__('portal.Contact #')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrders[0]->otp_mobile_number }}</span><br>
                                        @php $warehouse = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrders[0]->warehouse_id)->first()->only('warehouse_name'); @endphp
                                        @if(auth()->user()->registration_type == 'Supplier')
                                            <strong>{{__('portal.Delivery Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrders[0]->delivery_address }}</span><br><br>
                                        @else
                                            <strong>{{__('portal.Warehouse for delivery')}}: &nbsp;&nbsp;</strong><span>{{ $warehouse['warehouse_name'] }}</span> <br><br>
                                        @endif

                                        <strong>{{__('portal.P.O.')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.PO')}}-{{ $draftPurchaseOrders[0]->id }}<br>
                                        <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->created_at }}<br>
                                        <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $draftPurchaseOrders[0]->qoute_no }}<br>
                                        <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $draftPurchaseOrders[0]->eOrderItem->id }}<br>
                                        <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                        @if($draftPurchaseOrders[0]->payment_term == 'Cash') {{__('portal.Cash')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit') {{__('portal.Credit')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                        @endif
                                        <br>
                                    </div>

                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                        <img src="{{ Storage::url($draftPurchaseOrders[0]->supplier_business->business_photo_url) }}" alt="{{ $draftPurchaseOrders[0]->supplier_business->business_name }}" style="height: 95px;border-radius: 9px;"/><br><br>
                                        <strong>{{__('portal.Supplier')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->supplier_business->business_name }}<br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrders[0]->supplier_business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrders[0]->supplier_business->vat_reg_certificate_number }}</span><br>
                                        <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrders[0]->supplier_business->business_email }}</span><br>
                                    </div>
                                </div>

                                {{--<div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-screen">
                                        <strong class="text-xl">{{__('portal.Category Name')}}: </strong>
                                        @php
                                            $record = \App\Models\Category::where('id',$draftPurchaseOrders[0]->item_code)->first();
                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                        @endphp
                                        <span class="text-xl text-blue-600"> {{ $record->name }} @if(isset($parent)), {{$parent->name}} @endif </span> <br>
                                    </div>
                                </div>--}}

                                <table class="min-w-full divide-y divide-black ">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            #
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Category Name')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Brand')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Description')}}
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
                                                @php
                                                    $record = \App\Models\Category::where('id',$draftPurchaseOrders[0]->item_code)->first();
                                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                @endphp
                                                {{ $record->name }}@if(isset($parent)), {{$parent->name}} @endif
                                            </td>
                                            <td class="px-2 py-2 text-sm text-black border border-black">
                                                @if(isset($draftPurchaseOrder->brand)) {{ $draftPurchaseOrder->brand }} @else {{__('portal.N/A')}} @endif
                                            </td>
                                            <td class="px-2 py-2 text-sm text-black border border-black">
                                                {{ $draftPurchaseOrder->eOrderItem->description }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                {{ $draftPurchaseOrder->uom }}
                                            </td>
                                            <td class="px-2 py-2 text-sm text-black border border-black">
                                                @if(isset($draftPurchaseOrder->remarks)){{ $draftPurchaseOrder->remarks }} @else {{__('portal.N/A')}} @endif
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                {{ number_format($draftPurchaseOrder->unit_price) }} {{__('portal.SAR')}}
                                            </td>

                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                {{ number_format($draftPurchaseOrder->quantity) }}
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
                                        <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->shipment_cost, 2) }} {{__('portal.SAR')}}<br>
                                        <strong>{{__('portal.VAT')}} {{ number_format($draftPurchaseOrders[0]->vat) }}%: @if($draftPurchaseOrders[0]->vat > 9) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @else &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @endif </strong>{{ number_format(($subtotal + $draftPurchaseOrders[0]->shipment_cost) * ($draftPurchaseOrders[0]->vat/100), 2) }} {{__('portal.SAR')}}<br>
                                        <hr>
                                        <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->total_cost, 2) }} {{__('portal.SAR')}}<br>
                                        <hr>
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden  p-4 mt-4">
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
                                        <strong>{{__('portal.Mobile Number for OTP')}}: </strong> {{ $draftPurchaseOrders[0]->otp_mobile_number }} <br>
                                        @if(auth()->user()->registration_type == 'Supplier')
                                            <strong>{{__('portal.Delivery Address')}}: </strong> {{ strip_tags($draftPurchaseOrders[0]->delivery_address) }} <br>
                                        @else
                                            <strong>{{__('portal.Warehouse for delivery')}}: </strong> {{ $warehouse['warehouse_name'] }} <br>
                                        @endif
                                    </div>
                                    @if(auth()->user()->registration_type == 'Buyer')
                                    <div class="w-full overflow-hidden mt-3 lg:w-1/2 xl:w-1/2">
                                        <form action="{{route('uploadSingleCategoryDPOFile')}}" method="post" id="upload-image-form" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="dpoRFQNo" name="dpo_rfq_no" value="{{encrypt($draftPurchaseOrders[0]->rfq_no)}}">
                                            <div class="flex">
                                                <div class="flex-row">
                                                    <strong>{{__('portal.File Upload')}}:</strong><br>
                                                </div>
                                                <div class="flex-row ml-4">
                                                    <label for="file" class="file-label">
                                                        <img style="width:25px;cursor: pointer" src="https://img.icons8.com/pastel-glyph/64/000000/upload-document--v1.png"/>
                                                    </label>
                                                    <input class="shadow-sm block w-full" id="file" type="file" name="file_path_1" autocomplete="name" style="display:none;">
                                                </div>
                                                <div class="flex-row ml-4">
                                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-1 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150"> {{__('portal.Click to Upload')}}</button>
                                                </div>
                                                @if($draftPurchaseOrders[0]->file)
                                                    <div class="flex-row ml-4">
                                                        <a href="{{ Storage::url($draftPurchaseOrders[0]->file) }}">
                                                            <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor"
                                                                 viewBox="0 0 24 24"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      stroke-width="2"
                                                                      d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                                </path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                </div>

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
            </div>
        </div>
    </x-app-layout>
@else

@section('headerScripts')
    <style>
        @media (min-width: 800px) {
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
                        @if (session()->has('message'))
                            <div class="mb-3 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                                <strong class="mr-4">{{ session('message') }}</strong>
                                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="mb-3 mr-1 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="mr-4">{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        <div class="bg-white overflow-hidden shadow-xl ">
                            <div class="mt-5" style=" margin-right: 30px; margin-bottom: 10px ">
                                <form method="POST" action="{{route('singleCategoryGeneratePDF', $draftPurchaseOrders[0]->rfq_no) }}">
                                    @csrf
                                    <button type="submit" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-blue active:bg-blue-600 transition ease-in-out duration-150">
                                        {{__('portal.Create PDF')}}
                                    </button>
                                </form>
                            </div>

                            <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                                <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrders[0]->buyer_business->business_photo_url) }}" alt="{{ $draftPurchaseOrders[0]->buyer_business->business_name }}"/>--}}
{{--                                        <h1 class="text-center text-2xl">{{ $draftPurchaseOrders[0]->buyer_business->business_name }}</h1>--}}
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <img class="h-20 w-30 object-cover mx-auto" src="{{ Storage::url($draftPurchaseOrders[0]->buyer_business->business_photo_url) }}" style="border-radius: 9px;"/>
                                        <h1 class="text-center text-3xl">{{__('portal.Purchase Order')}}</h1>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrders[0]->supplier_business->business_photo_url) }}" alt="{{ $draftPurchaseOrders[0]->supplier_business->business_name }}"/>--}}
{{--                                        <h1 class="text-center text-2xl">{{ $draftPurchaseOrders[0]->supplier_business->business_name }}</h1>--}}
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                        <strong>{{__('portal.Buyer')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrders[0]->buyer_business->business_name }}</span> <br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrders[0]->buyer_business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrders[0]->buyer_business->vat_reg_certificate_number }}</span><br>
                                        <strong>{{__('portal.Contact #')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrders[0]->otp_mobile_number }}</span><br>
                                        @php $warehouse = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrders[0]->warehouse_id)->first()->only('warehouse_name'); @endphp
                                        @if(auth()->user()->registration_type == 'Supplier')
                                            <strong>{{__('portal.Delivery Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrders[0]->delivery_address }}</span><br><br>
                                        @else
                                            <strong>{{__('portal.Warehouse for delivery')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $warehouse['warehouse_name'] }}</span><br><br>
                                        @endif

                                        <strong>{{__('portal.P.O.')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.PO')}}-<span style=" font-family: sans-serif;">{{ $draftPurchaseOrders[0]->id }}</span> <br>
                                        <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrders[0]->created_at }}</span> <br>
                                        <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-<span style=" font-family: sans-serif;">{{ $draftPurchaseOrders[0]->qoute_no }}</span> <br>
                                        <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-<span style=" font-family: sans-serif;">{{ $draftPurchaseOrders[0]->eOrderItem->id }}</span> <br>
                                        <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                        @if($draftPurchaseOrders[0]->payment_term == 'Cash') {{__('portal.Cash')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit') {{__('portal.Credit')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                        @elseif($draftPurchaseOrders[0]->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                        @endif
                                        <br>
                                    </div>

                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                        <img src="{{ Storage::url($draftPurchaseOrders[0]->supplier_business->business_photo_url) }}" alt="{{ $draftPurchaseOrders[0]->supplier_business->business_name }}" style="height: 95px;border-radius: 9px;"/><br><br>
                                        <strong>{{__('portal.Supplier')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrders[0]->supplier_business->business_name }}</span> <br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrders[0]->supplier_business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrders[0]->supplier_business->vat_reg_certificate_number }}</span><br>
                                        <strong>{{__('portal.Email')}}: &nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrders[0]->supplier_business->business_email }}</span><br>
                                    </div>
                                </div>

                                {{--<div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-screen">
                                        <strong class="text-xl">{{__('portal.Category Name')}}: </strong>
                                        @php
                                            $record = \App\Models\Category::where('id',$draftPurchaseOrders[0]->item_code)->first();
                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                        @endphp
                                        <span class="text-xl text-blue-600"> {{ $record->name_ar }} @if(isset($parent)), {{$parent->name_ar}} @endif </span> <br>
                                    </div>
                                </div>--}}

                                <table class="min-w-full divide-y divide-black ">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            #
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Category Name')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Brand')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Description')}}
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
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style=" font-family: sans-serif;">
                                                {{$loop->iteration}}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                @php
                                                    $record = \App\Models\Category::where('id',$draftPurchaseOrders[0]->item_code)->first();
                                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                @endphp
                                                {{ $record->name_ar }}@if(isset($parent)), {{$parent->name_ar}} @endif
                                            </td>
                                            <td class="px-2 py-2 text-sm text-black border border-black" style=" font-family: sans-serif;">
                                                @if(isset($draftPurchaseOrder->brand)) {{ $draftPurchaseOrder->brand }} @else {{__('portal.N/A')}} @endif
                                            </td>
                                            <td class="px-2 py-2 text-sm text-black border border-black" style=" font-family: sans-serif;">
                                                {{ $draftPurchaseOrder->eOrderItem->description }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                @php $UOM = \App\Models\UnitMeasurement::where('uom_en', $draftPurchaseOrder->uom)->pluck('uom_ar')->first(); @endphp
                                                {{ $UOM }}
                                            </td>
                                            <td class="px-2 py-2 text-sm text-black border border-black" style=" font-family: sans-serif;">
                                                @if(isset($draftPurchaseOrder->remarks)){{ $draftPurchaseOrder->remarks }} @else {{__('portal.N/A')}} @endif
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                <span style=" font-family: sans-serif;">{{ number_format($draftPurchaseOrder->unit_price) }}</span> {{__('portal.SAR')}}
                                            </td>

                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style=" font-family: sans-serif;">
                                                {{ number_format($draftPurchaseOrder->quantity) }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                <span style=" font-family: sans-serif;">{{ number_format($draftPurchaseOrder->sub_total, 2) }}</span> {{__('portal.SAR')}}
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
                                        <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ number_format($subtotal, 2) }}</span> {{__('portal.SAR')}}<br>
                                        <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ number_format($draftPurchaseOrders[0]->shipment_cost, 2) }}</span> {{__('portal.SAR')}}<br>
                                        <strong>{{__('portal.VAT')}} <span style=" font-family: sans-serif;">{{ number_format($draftPurchaseOrders[0]->vat) }}</span>%: @if($draftPurchaseOrders[0]->vat > 9) @else &nbsp; @endif </strong><span style=" font-family: sans-serif;">{{ number_format(($subtotal + $draftPurchaseOrders[0]->shipment_cost) * ($draftPurchaseOrders[0]->vat/100), 2) }}</span> {{__('portal.SAR')}}<br>
                                        <hr>
                                        <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ number_format($draftPurchaseOrders[0]->total_cost, 2) }}</span> {{__('portal.SAR')}}<br>
                                        <hr>
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden  p-4 mt-4">
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
                                        <strong>{{__('portal.Mobile Number for OTP')}}: </strong> <span style=" font-family: sans-serif;">{{ $draftPurchaseOrders[0]->otp_mobile_number }}</span> <br>
                                        @if(auth()->user()->registration_type == 'Supplier')
                                            <strong>{{__('portal.Delivery Address')}}: </strong> <span style=" font-family: sans-serif;">{{ strip_tags($draftPurchaseOrders[0]->delivery_address) }}</span> <br>
                                        @else
                                            <strong>{{__('portal.Warehouse for delivery')}}: </strong> <span style=" font-family: sans-serif;">{{ $warehouse['warehouse_name'] }}</span> <br>
                                        @endif
                                    </div>
                                    @if(auth()->user()->registration_type == 'Buyer')
                                    <div class="w-full overflow-hidden mt-3 lg:w-1/2 xl:w-1/2">
                                        <form action="{{route('uploadSingleCategoryDPOFile')}}" method="post" id="upload-image-form" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="dpoRFQNo" name="dpo_rfq_no" value="{{encrypt($draftPurchaseOrders[0]->rfq_no)}}">
                                            <div class="flex">
                                                <div class="flex-row">
                                                    <strong>{{__('portal.File Upload')}}:</strong><br>
                                                </div>
                                                <div class="flex-row mr-4">
                                                    <label for="file" class="file-label">
                                                        <img style="width:25px;cursor: pointer" src="https://img.icons8.com/pastel-glyph/64/000000/upload-document--v1.png"/>
                                                    </label>
                                                    <input class="shadow-sm block w-full" id="file" type="file" name="file_path_1" autocomplete="name" style="display:none;">
                                                </div>
                                                <div class="flex-row mr-4">
                                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-1 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150"> {{__('portal.Click to Upload')}}</button>
                                                </div>
                                                @if($draftPurchaseOrders[0]->file)
                                                    <div class="flex-row mr-4">
                                                        <a href="{{ Storage::url($draftPurchaseOrders[0]->file) }}">
                                                            <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor"
                                                                 viewBox="0 0 24 24"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      stroke-width="2"
                                                                      d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                                </path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                </div>

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
            </div>
        </div>
    </x-app-layout>
@endif
