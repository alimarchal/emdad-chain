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
                        @if (session()->has('message'))
                            <div class="mb-3 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                                <strong class="mr-1">{{ session('message') }}</strong>
                                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="mb-3 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="ml-2">{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        <div class="bg-white overflow-hidden shadow-xl ">
                            <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                                <a href="{{ route('generatePDF', $draftPurchaseOrder) }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                    {{__('portal.Create PDF')}}
                                </a>
                            </div>
                            <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                                <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrder->buyer_business->business_photo_url) }}" alt="{{ $draftPurchaseOrder->buyer_business->business_name }}" />--}}
{{--                                        <h1 class="text-center text-2xl">{{ $draftPurchaseOrder->buyer_business->business_name }}</h1>--}}
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <img class="h-20 w-30 object-cover mx-auto" src="{{ Storage::url($draftPurchaseOrder->buyer_business->business_photo_url) }}" style="border-radius: 9px;"/>
                                        <h1 class="text-center text-3xl">{{__('portal.Purchase Order')}}</h1>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrder->supplier_business->business_photo_url) }}" alt="{{ $draftPurchaseOrder->supplier_business->business_name }}" />--}}
{{--                                        <h1 class="text-center text-2xl">{{ $draftPurchaseOrder->supplier_business->business_name }}</h1>--}}
                                    </div>
                                </div>


                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                        <strong>{{__('portal.Buyer')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->buyer_business->business_name }}<br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrder->buyer_business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrder->buyer_business->vat_reg_certificate_number }}</span><br>
                                        <strong>{{__('portal.Contact #')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrder->otp_mobile_number }}</span> <br>
                                        @php $warehouse = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrder->warehouse_id)->first()->only('warehouse_name'); @endphp
                                        @if(auth()->user()->registration_type == 'Supplier')
                                        <strong>{{__('portal.Delivery Address')}}: &nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrder->delivery_address }}</span> <br><br>
                                        @else
                                            <strong>{{__('portal.Delivery Address')}}: &nbsp;&nbsp;</strong><span>{{ $warehouse['warehouse_name'] }}</span> <br><br>
                                        @endif

                                        <strong>{{__('portal.P.O.')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.PO')}}-{{ $draftPurchaseOrder->id }}<br>
                                        <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->created_at }}<br>
                                        <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $draftPurchaseOrder->qoute_no }}<br>
                                        <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $draftPurchaseOrder->eOrderItem->id }}<br>
                                        <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                        @if($draftPurchaseOrder->payment_term == 'Cash') {{__('portal.Cash')}}
                                        @elseif($draftPurchaseOrder->payment_term == 'Credit') {{__('portal.Credit')}}
                                        @elseif($draftPurchaseOrder->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                        @elseif($draftPurchaseOrder->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                        @elseif($draftPurchaseOrder->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                        @elseif($draftPurchaseOrder->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                        @endif
                                        <br>
                                    </div>

                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                        <img src="{{ Storage::url($draftPurchaseOrder->supplier_business->business_photo_url) }}" alt="{{ $draftPurchaseOrder->supplier_business->business_name }}" style="height: 95px;border-radius: 9px;"/><br><br>
                                        <strong>{{__('portal.Supplier')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->supplier_business->business_name }}<br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrder->supplier_business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrder->supplier_business->vat_reg_certificate_number }}</span><br>
                                        <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrder->supplier_business->business_email }}</span><br>
                                    </div>
                                </div>

                                {{--<div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-screen">
                                        <strong class="text-xl">{{__('portal.Category Name')}}: </strong>
                                        @php
                                            $record = \App\Models\Category::where('id',$draftPurchaseOrder->item_code)->first();
                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                        @endphp
                                        <span class="text-xl text-blue-600">{{ $record->name }} @if(isset($parent)) , {{ $parent->name }} @endif</span>
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-screen">
                                        <strong class="text-xl">{{__('portal.Item Description')}}: </strong>
                                        <span class="text-xl">{{ strip_tags($draftPurchaseOrder->eOrderItem->description) }}</span><br>
                                    </div>
                                </div>--}}

                                {{--                        <table class="min-w-full divide-y divide-black ">--}}
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
                                    <tbody class="bg-white divide-y divide-black border-1 border-black">
                                    <tr>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            1
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            @php
                                                $record = \App\Models\Category::where('id',$draftPurchaseOrder->item_code)->first();
                                                $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                            @endphp
                                            {{ $record->name }}@if(isset($parent)), {{ $parent->name }} @endif
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{ strip_tags($draftPurchaseOrder->eOrderItem->description) }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            @if(isset($draftPurchaseOrder->brand)) {{ $draftPurchaseOrder->brand }} @endif
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
                                </table>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrder->sub_total, 2) }} {{__('portal.SAR')}}<br>
                                        @php $subtotal = $draftPurchaseOrder->sub_total; $subtotal += $draftPurchaseOrder->shipment_cost; @endphp
                                        <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrder->shipment_cost, 2) }} {{__('portal.SAR')}}<br>
                                        <strong>{{__('portal.VAT')}} {{ number_format($draftPurchaseOrder->vat) }}%: @if($draftPurchaseOrder->vat > 9) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @else &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @endif</strong>{{ number_format($subtotal * ($draftPurchaseOrder->vat/100), 2) }} {{__('portal.SAR')}}<br>
                                        <hr>
                                        <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrder->total_cost, 2) }} {{__('portal.SAR')}}<br>
                                        <hr>
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden  p-4 mt-4">
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
                                        <strong>{{__('portal.Mobile Number for OTP')}}: </strong> {{ strip_tags($draftPurchaseOrder->otp_mobile_number) }} <br>
                                        @if(auth()->user()->registration_type == 'Supplier')
                                        <strong>{{__('portal.Delivery Address')}}: </strong> {{ strip_tags($draftPurchaseOrder->delivery_address) }} <br>
                                        @else
                                        <strong>{{__('portal.Delivery Address')}}: </strong> {{ $warehouse['warehouse_name'] }} <br>
                                        @endif
                                    </div>
                                    <div class="w-full overflow-hidden mt-3 lg:w-1/2 xl:w-1/2">
                                        <form action="{{route('uploadDPOFile')}}" method="post" id="upload-image-form" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="dpoID" name="dpo_id" value="{{encrypt($draftPurchaseOrder->id)}}">
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
                                                @if($draftPurchaseOrder->file)
                                                    <div class="flex-row ml-4">
                                                        <a href="{{ Storage::url($draftPurchaseOrder->file) }}">
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
                                </div>


                                {{--                    <div class="flex justify-center">--}}
                                {{--                        <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-10 w-auto" /></div>--}}
                                {{--                    </div>--}}
                                <div class="flex justify-between mt-4 mb-4">


                                    @if ($draftPurchaseOrder->status == 'approved')
                                        <img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-9@8x.png')}}" alt="{{__('portal.P.O. APPROVED')}}">
                                        {{--                            <span class="px-3 py-3 bg-green-800 text-white rounded">APPROVED P.O</span>--}}
                                    @elseif ($draftPurchaseOrder->status == 'cancel')
                                        <img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-8@8x.png')}}" alt="{{__('portal.P.O. Canceled')}}">
                                        {{--                            <span class="px-3 py-3 bg-red-800 text-white rounded">Canceled P.O</span>--}}
                                    @elseif ($draftPurchaseOrder->status == 'rejectToEdit')
                                        <img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-7@8x.png')}}" alt="{{__('portal.Rejected for Edit')}}">
                                        {{--                            <span class="px-3 py-3 bg-red-600 text-white rounded uppercase">Rejected for Edit</span>--}}
                                    @elseif ($draftPurchaseOrder->status == 'completed')
                                    @elseif ($draftPurchaseOrder->status == 'prepareDelivery')
                                    @else
                                        @if(auth()->user()->registeration_type == 'Buyer')
                                            <a href="{{ route('dpo.approved', $draftPurchaseOrder->id) }}" class="inline-flex  mx-4  items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">DPO Approved</a>
                                        @endif
                                        <a href="{{ route('dpo.cancel', $draftPurchaseOrder->id) }}" class="inline-flex  mx-4  items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Cancel P.O</a>
                                        <a href="{{ route('dpo.rejected', $draftPurchaseOrder->id) }}" class="inline-flex  mx-4  items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Reject to Edit</a>
                                    @endif

                                </div>

                                <div class="flex justify-between px-2 py-2 mt-2 h-15">
                                    <div></div>
                                    <div class="mt-3">{{__('portal.Thank you for using Emdad platform for your business.')}}</div>
                                    {{--                        <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-10 w-auto" /></div>--}}
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
                        @if (session()->has('message'))
                            <div class="mb-3 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                                <strong class="mr-4">{{ session('message') }}</strong>
                                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="mb-3 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative">
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
                                <a href="{{ route('generatePDF', $draftPurchaseOrder) }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                    {{__('portal.Create PDF')}}
                                </a>
                            </div>
                            <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                                <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ $draftPurchaseOrder->buyer_business->business_photo_url }}" alt="{{ $draftPurchaseOrder->buyer_business->business_name }}" />--}}
{{--                                        <h1 class="text-center text-2xl">{{ $draftPurchaseOrder->buyer_business->business_name }}</h1>--}}
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <img class="h-20 w-30 object-cover mx-auto" src="{{ Storage::url($draftPurchaseOrder->buyer_business->business_photo_url) }}" style="border-radius: 9px;"/>
                                        <h1 class="text-center text-3xl">{{__('portal.Purchase Order')}}</h1>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ $draftPurchaseOrder->supplier_business->business_photo_url }}" alt="{{ $draftPurchaseOrder->supplier_business->business_name }}" />--}}
{{--                                        <h1 class="text-center text-2xl">{{ $draftPurchaseOrder->supplier_business->business_name }}</h1>--}}
                                    </div>
                                </div>


                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                        <strong>{{__('portal.Buyer')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrder->buyer_business->business_name }}</span> <br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrder->buyer_business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrder->buyer_business->vat_reg_certificate_number }}</span><br>
                                        <strong>{{__('portal.Contact #')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrder->otp_mobile_number }}</span><br>
                                        @php $warehouse = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrder->warehouse_id)->first()->only('warehouse_name'); @endphp
                                        @if(auth()->user()->registration_type == 'Supplier')
                                            <strong>{{__('portal.Delivery Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrder->delivery_address }}</span><br><br>
                                        @else
                                            <strong>{{__('portal.Delivery Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $warehouse['warehouse_name'] }}</span> <br><br>
                                        @endif

                                        <strong>{{__('portal.P.O.')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.PO')}}-<span style=" font-family: sans-serif;">{{ $draftPurchaseOrder->id }}</span> <br>
                                        <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrder->created_at }}</span> <br>
                                        <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-<span style=" font-family: sans-serif;">{{ $draftPurchaseOrder->qoute_no }}</span> <br>
                                        <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-<span style=" font-family: sans-serif;">{{ $draftPurchaseOrder->eOrderItem->id }}</span> <br>
                                        <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                        @if($draftPurchaseOrder->payment_term == 'Cash') {{__('portal.Cash')}}
                                        @elseif($draftPurchaseOrder->payment_term == 'Credit') {{__('portal.Credit')}}
                                        @elseif($draftPurchaseOrder->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                        @elseif($draftPurchaseOrder->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                        @elseif($draftPurchaseOrder->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                        @elseif($draftPurchaseOrder->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                        @endif
                                        {{--                                    {{ $draftPurchaseOrder->payment_term }}--}}
                                        <br>
                                    </div>

                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                        <img src="{{ Storage::url($draftPurchaseOrder->supplier_business->business_photo_url) }}" alt="{{ $draftPurchaseOrder->supplier_business->business_name }}" style="height: 95px;border-radius: 9px;"/><br><br>
                                        <strong>{{__('portal.Supplier')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrder->supplier_business->business_name }}</span> <br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrder->supplier_business->city }}</span><br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrder->supplier_business->vat_reg_certificate_number }}</span><br>
                                        <strong>{{__('portal.Email')}}: &nbsp;</strong><span style=" font-family: sans-serif;">{{ $draftPurchaseOrder->supplier_business->business_email }}</span><br>
                                    </div>
                                </div>

                                {{--<div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-screen">
                                        <strong class="text-xl">{{__('portal.Category Name')}}: </strong>
                                        @php
                                            $record = \App\Models\Category::where('id',$draftPurchaseOrder->item_code)->first();
                                            $parent = \App\Models\Category::where('id',$record->parent_id)->first();
                                        @endphp
                                        <span class="text-xl text-blue-600">{{ $record->name_ar }} @if(isset($parent)) , {{ $parent->name_ar }} @endif</span>
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-screen">
                                        <strong class="text-xl">{{__('portal.Item Description')}}: </strong>
                                        <span class="text-xl">{{ strip_tags($draftPurchaseOrder->eOrderItem->description) }}</span><br>
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
                                            {{__('portal.Description')}}
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
                                    <tbody class="bg-white divide-y divide-black border-1 border-black">
                                    <tr>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style=" font-family: sans-serif;">
                                            1
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            @php
                                                $record = \App\Models\Category::where('id',$draftPurchaseOrder->item_code)->first();
                                                $parent = \App\Models\Category::where('id',$record->parent_id)->first();
                                            @endphp
                                            {{ $record->name_ar }}@if(isset($parent)), {{ $parent->name_ar }} @endif
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style=" font-family: sans-serif;">
                                            {{ strip_tags($draftPurchaseOrder->eOrderItem->description) }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style=" font-family: sans-serif;">
                                            {{ $draftPurchaseOrder->brand }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            @php $UOM = \App\Models\UnitMeasurement::where('uom_en', $draftPurchaseOrder->uom)->pluck('uom_ar')->first(); @endphp
                                            {{ $UOM }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style=" font-family: sans-serif;">
                                            @if(isset($draftPurchaseOrder->remarks)){{ $draftPurchaseOrder->remarks }} @else {{__('portal.N/A')}} @endif
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            <span style=" font-family: sans-serif;">{{ $draftPurchaseOrder->unit_price }}</span> {{__('portal.SAR')}}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style=" font-family: sans-serif;">
                                            {{ $draftPurchaseOrder->quantity }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            <span style=" font-family: sans-serif;">{{ number_format($draftPurchaseOrder->sub_total, 2) }}</span>  {{__('portal.SAR')}}
                                        </td>
                                    </tr>
                                    {{--<tr>
                                        <td colspan="7" rowspan="4">
                                        </td>
                                        <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                            Sub Total
                                        </td>
                                        <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                            {{ number_format($draftPurchaseOrder->sub_total, 2) }} {{__('portal.SAR')}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                            VAT 15%
                                        </td>
                                        <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                            {{ number_format($draftPurchaseOrder->sub_total * 0.15, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                            Shipping Fees
                                        </td>
                                        <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                            {{ number_format($draftPurchaseOrder->shipment_cost, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                            P.O Total
                                        </td>
                                        <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                            {{ number_format($draftPurchaseOrder->sub_total * 0.15 + $draftPurchaseOrder->sub_total + $draftPurchaseOrder->shipment_cost, 2) }}
                                        </td>
                                    </tr>--}}
                                    </tbody>
                                </table>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ number_format($draftPurchaseOrder->sub_total, 2) }}</span> {{__('portal.SAR')}}<br>
                                        @php $subtotal = $draftPurchaseOrder->sub_total; $subtotal += $draftPurchaseOrder->shipment_cost; @endphp
                                        <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ number_format($draftPurchaseOrder->shipment_cost, 2) }}</span> {{__('portal.SAR')}}<br>
                                        <strong>{{__('portal.VAT')}} <span style=" font-family: sans-serif;">{{ number_format($draftPurchaseOrder->vat) }}</span>%: @if($draftPurchaseOrder->vat > 9)  @else &nbsp;  @endif</strong><span style=" font-family: sans-serif;">{{ number_format($subtotal * ($draftPurchaseOrder->vat/100), 2) }}</span> {{__('portal.SAR')}}<br>
                                        <hr>
                                        <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style=" font-family: sans-serif;">{{ number_format($draftPurchaseOrder->total_cost, 2) }}</span> {{__('portal.SAR')}}<br>
                                        <hr>
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden  p-4 mt-4">
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
                                        <strong>{{__('portal.Mobile Number for OTP')}}: </strong> <span style=" font-family: sans-serif;">{{ strip_tags($draftPurchaseOrder->otp_mobile_number) }}</span> <br>
                                        @if(auth()->user()->registration_type == 'Supplier')
                                            <strong>{{__('portal.Delivery Address')}}: </strong> <span style=" font-family: sans-serif;">{{ strip_tags($draftPurchaseOrder->delivery_address) }}</span> <br>
                                        @else
                                            <strong>{{__('portal.Delivery Address')}}: </strong> <span style=" font-family: sans-serif;">{{ $warehouse['warehouse_name'] }}</span> <br>
                                        @endif
                                    </div>
                                    <div class="w-full overflow-hidden mt-3 lg:w-1/2 xl:w-1/2">
                                        <form action="{{route('uploadDPOFile')}}" method="post" id="upload-image-form" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="dpoID" name="dpo_id" value="{{encrypt($draftPurchaseOrder->id)}}">
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
                                                @if($draftPurchaseOrder->file)
                                                    <div class="flex-row mr-4">
                                                        <a href="{{ Storage::url($draftPurchaseOrder->file) }}">
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
                                </div>


                                {{--                    <div class="flex justify-center">--}}
                                {{--                        <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-10 w-auto" /></div>--}}
                                {{--                    </div>--}}
                                <div class="flex justify-between mt-4 mb-4">


                                    @if ($draftPurchaseOrder->status == 'approved')
                                        <img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-9@8x.png')}}" alt="{{__('portal.P.O. APPROVED')}}">
                                        {{--                            <span class="px-3 py-3 bg-green-800 text-white rounded">APPROVED P.O</span>--}}
                                    @elseif ($draftPurchaseOrder->status == 'cancel')
                                        <img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-8@8x.png')}}" alt="{{__('portal.P.O. Canceled')}}">
                                        {{--                            <span class="px-3 py-3 bg-red-800 text-white rounded">Canceled P.O</span>--}}
                                    @elseif ($draftPurchaseOrder->status == 'rejectToEdit')
                                        <img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-7@8x.png')}}" alt="{{__('portal.Rejected for Edit')}}">
                                        {{--                            <span class="px-3 py-3 bg-red-600 text-white rounded uppercase">Rejected for Edit</span>--}}
                                    @elseif ($draftPurchaseOrder->status == 'completed')
                                    @elseif ($draftPurchaseOrder->status == 'prepareDelivery')
                                    @else
                                        @if(auth()->user()->registeration_type == 'Buyer')
                                            <a href="{{ route('dpo.approved', $draftPurchaseOrder->id) }}" class="inline-flex  mx-4  items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">DPO Approved</a>
                                        @endif
                                        <a href="{{ route('dpo.cancel', $draftPurchaseOrder->id) }}" class="inline-flex  mx-4  items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Cancel P.O</a>
                                        <a href="{{ route('dpo.rejected', $draftPurchaseOrder->id) }}" class="inline-flex  mx-4  items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Reject to Edit</a>
                                    @endif

                                </div>

                                <div class="flex justify-between px-2 py-2 mt-2 h-15">
                                    <div></div>
                                    <div class="mt-3">{{__('portal.Thank you for using Emdad platform for your business.')}}</div>
                                    {{--                        <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-10 w-auto" /></div>--}}
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
