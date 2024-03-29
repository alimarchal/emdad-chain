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
                        @if (session()->has('message'))
                            <div class="mb-3 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                                <strong class="ml-1">{{ session('message') }}</strong>
                                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="mb-3 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
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
                                {{--<a href="{{ route('generatePDF', $draftPurchaseOrder) }}"
                                   class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                    Create PDF
                                </a>--}}
                            </div>
                            <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                                <div class="flex flex-wrap overflow-hidden bg-gray-100 p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrder->buyer_business->business_photo_url) }}" alt="{{ $draftPurchaseOrder->buyer_business->business_name }}"/>--}}
{{--                                        <h1 class="text-center text-2xl">{{ $draftPurchaseOrder->buyer_business->business_name }}</h1>--}}
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <img class="h-20 w-30 object-cover mx-auto" src="{{ Storage::url($draftPurchaseOrder->buyer_business->business_photo_url) }}" style="border-radius: 9px;"/>
                                        <h1 class="text-center text-3xl">{{__('portal.Draft Purchase Order')}}</h1>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrder->supplier_business->business_photo_url) }}" alt="{{ $draftPurchaseOrder->supplier_business->business_name }}"/>--}}
{{--                                        <h1 class="text-center text-2xl">{{ $draftPurchaseOrder->supplier_business->business_name }}</h1>--}}
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                        <strong>{{__('portal.Buyer')}}:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->buyer_business->business_name }}<br>
                                        <strong>{{__('portal.City')}}:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrder->buyer_business->city }}</span> <br>
                                        <strong>{{__('portal.VAT Number')}}:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrder->buyer_business->vat_reg_certificate_number }}</span> <br>
                                        <strong>{{__('portal.Contact #')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrder->otp_mobile_number }}</span> <br>
                                        @php $warehouse = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrder->warehouse_id)->first()->only('warehouse_name'); @endphp
                                        <strong>{{__('portal.Warehouse for delivery')}}: &nbsp;&nbsp;</strong><span>{{ $warehouse['warehouse_name'] }}</span> <br><br>

                                        <strong>{{__('portal.D.P.O.')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.DPO')}}-{{ $draftPurchaseOrder->id }}<br>
                                        <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->created_at }}<br>
                                        <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $draftPurchaseOrder->qoute_no }}<br>
                                        <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $draftPurchaseOrder->eOrderItem->id }}<br>
                                        <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                        @if($draftPurchaseOrder->payment_term == 'Cash') {{__('portal.Cash')}}
                                        @elseif($draftPurchaseOrder->payment_term == 'Credit') {{__('portal.Credit')}}
                                        @elseif($draftPurchaseOrder->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                        @elseif($draftPurchaseOrder->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                        @elseif($draftPurchaseOrder->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                        @elseif($draftPurchaseOrder->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                        @endif
                                    </div>

                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                        <img src="{{ Storage::url($draftPurchaseOrder->supplier_business->business_photo_url) }}" alt="{{ $draftPurchaseOrder->supplier_business->business_name }}" style="height: 95px;border-radius: 9px;"/><br><br>
                                        <strong>{{__('portal.Supplier')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->supplier_business->business_name }}<br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrder->supplier_business->city }}</span> <br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrder->supplier_business->vat_reg_certificate_number }}</span> <br>
                                        <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $draftPurchaseOrder->supplier_business->business_email }}</span> <br>
                                        <br>
                                    </div>
                                </div>

                                <table class="min-w-full divide-y divide-black ">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            #
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Category Name')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Description')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Brand')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.UOM')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Remarks')}}
                                        </th>

                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Unit Price')}}
                                        </th>

                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Quantity')}}
                                        </th>

                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Amount')}}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-black border-1 border-black">
                                    <tr>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black  border border-black">
                                            1
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black  border border-black">
                                            @php
                                                $record = \App\Models\Category::where('id',$draftPurchaseOrder->item_code)->first();
                                                $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                            @endphp
                                            {{ $record->name }}@if(isset($parent)), {{ $parent->name }} @endif
                                        </td>
                                        <td class="px-2 py-2 text-sm text-center text-black  border border-black">
                                            {{ strip_tags($draftPurchaseOrder->eOrderItem->description) }}
                                        </td>
                                        <td class="px-2 py-2 text-sm text-center text-black  border border-black">
                                            {{ $draftPurchaseOrder->brand }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black  border border-black">
                                            {{ $draftPurchaseOrder->uom }}
                                        </td>
                                        <td class="px-2 py-2 text-sm text-center text-black  border border-black">
                                            @if(isset($draftPurchaseOrder->remarks)) {{ strip_tags($draftPurchaseOrder->remarks) }} @else {{__('portal.N/A')}} @endif
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black  border border-black">
                                            {{ $draftPurchaseOrder->unit_price }} {{__('portal.SAR')}}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black  border border-black">
                                            {{ $draftPurchaseOrder->quantity }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black  border border-black">
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
                                        <strong>{{__('portal.VAT')}} {{ number_format($draftPurchaseOrder->vat) }}%: @if($draftPurchaseOrder->vat > 9) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @else &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @endif </strong>{{ number_format($subtotal * ($draftPurchaseOrder->vat/100), 2) }} {{__('portal.SAR')}}<br>
                                        <hr>
                                        <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrder->total_cost, 2) }}  {{__('portal.SAR')}}<br>
                                        <hr>
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden  p-4 mt-4">
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
                                        <strong>{{__('portal.Mobile Number for OTP')}}: </strong> {{ $draftPurchaseOrder->otp_mobile_number }} <br>
                                        <strong>{{__('portal.Warehouse for delivery')}}: </strong> {{ $warehouse['warehouse_name'] }} <br>
                                        <strong class="text-red-900">{{__('portal.Note')}}: </strong> <span class="text-red-700">
                                {{__('portal.We acknowledge that')}} {{$draftPurchaseOrder->buyer_business->business_name }}
                                            {{__('portal.agrees to deal with')}} {{$draftPurchaseOrder->supplier_business->business_name}}. <br>
                                {{__('portal.Emdad has no responsibility with the kind of delivery and the source of finance for this delivery.')}}</span> <br>
                                        @if($draftPurchaseOrder->quote->expiry_date >= \Carbon\Carbon::now() && $draftPurchaseOrder->status != 'cancel')
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" name="note" id="acknowledge" required>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    {{__('portal.Please read the note and check if you agree to proceed')}}.
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                    @if($draftPurchaseOrder->quote->expiry_date >= \Carbon\Carbon::now())
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
                                    @endif
                                </div>


                                <div class="flex justify-center">
                                    <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block" style="height: 104px"/></div>
                                </div>


                                <div class="flex justify-between mt-4 mb-4">


                                    @if ($draftPurchaseOrder->status == 'approved')
                                        <img src="" alt="">
                                        <span class="px-3 py-3 bg-green-800 text-white rounded">{{__('portal.Approve')}}</span>
                                    @elseif ($draftPurchaseOrder->status == 'cancel')
                                        <img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-8@8x.png')}}" alt="{{__('portal.P.O. Canceled')}}">
                                    @elseif ($draftPurchaseOrder->status == 'rejectToEdit')
                                        <span class="px-3 py-3 bg-red-600 text-white rounded uppercase">{{__('portal.Rejected for Edit')}}</span>
                                    @else
                                        @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))
                                            @if($draftPurchaseOrder->quote->expiry_date >= \Carbon\Carbon::now())
                                                <a href="{{ route('dpo.cancel', $draftPurchaseOrder->id) }}" onclick="cancel()"
                                                   class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                    {{__('portal.Cancel DPO')}}
                                                </a>
                                            @endif
                                            @if($draftPurchaseOrder->payment_term == 'Cash')
                                                @if($draftPurchaseOrder->quote->expiry_date >= \Carbon\Carbon::now())
                                                <form method="post" action="{{route('cashDpo.approved', $draftPurchaseOrder->id)}}" class="confirm">
                                                    @csrf
                                                    <input type="hidden" value="{{ $draftPurchaseOrder->rfq_no }}" name="rfq_no">
                                                    <input type="hidden" value="{{ $draftPurchaseOrder->rfq_item_no }}" name="rfq_item_no">
                                                    <input type="hidden" value="{{ $draftPurchaseOrder->qoute_no }}" name="qoute_no">
                                                    <input type="hidden" value="{{ $draftPurchaseOrder->id }}" name="draft_purchase_order_id">
                                                    <input type="hidden" value="{{ $draftPurchaseOrder->user_id }}" name="buyer_user_id">
                                                    <input type="hidden" value="{{ $draftPurchaseOrder->business_id }}" name="buyer_business_id">
                                                    <input type="hidden" value="{{ $draftPurchaseOrder->supplier_user_id }}" name="supplier_user_id">
                                                    <input type="hidden" value="{{ $draftPurchaseOrder->supplier_business_id }}" name="supplier_business_id">
                                                    <input type="hidden" value="{{ $draftPurchaseOrder->payment_term }}" name="payment_method">
                                                    <input type="hidden" value="{{ $draftPurchaseOrder->shipment_cost }}" name="shipment_cost">
                                                    <input type="hidden" value="{{ $draftPurchaseOrder->vat }}" name="vat">
                                                    <input type="hidden" value="{{ $draftPurchaseOrder->total_cost }}" name="total_cost">
                                                    <input type="hidden" value="{{ $draftPurchaseOrder->ship_to_address }}" name="ship_to_address">

                                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">{{__('portal.Generate PO')}}</button>
                                                </form>
                                                @endif
                                            @else
                                                @if($draftPurchaseOrder->quote->expiry_date >= \Carbon\Carbon::now())
                                                <form method="POST" action="{{route('dpo.approved', $draftPurchaseOrder->id) }}" class="confirm">
                                                    @csrf
                                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                                        {{__('portal.Generate PO')}}
                                                    </button>
                                                </form>
                                                @endif
                                            @endif
                                        @endif
                                        {{-- <a href="{{ route('dpo.rejected', $draftPurchaseOrder->id) }}" class="inline-flex  mx-4  items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Reject to Edit</a> --}}
                                    @endif


                                </div>

                                <div class="flex justify-between px-2 py-2 mt-2 h-15">
                                    <div></div>
                                    <div class="mt-3">{{__('portal.Thank you for using Emdad platform for your business.')}}</div>
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
                alert('Please read the note and check if you agree to proceed. \nNote: We acknowledge that we agree to deal with this supplier. \nEmdad is not responsible for the kind of delivery or the financial source for this delivery.')
                event.preventDefault();
            }
            else if ($("#acknowledge").is(":checked")) {
                if(!confirm('Are you sure?')){
                    e.preventDefault();
                }
            }
        });

        function cancel() {
            if(!confirm('Are you sure?')){
                event.preventDefault();
            }
        }
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
                        @if (session()->has('message'))
                            <div class="mb-3 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                                <strong class="mr-4">{{ session('message') }}</strong>
                                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="mb-3 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
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
                            <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                                {{--<a href="{{ route('generatePDF', $draftPurchaseOrder) }}"
                                   class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                    Create PDF
                                </a>--}}
                            </div>
                            <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                                <div class="flex flex-wrap overflow-hidden bg-gray-100 p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrder->buyer_business->business_photo_url) }}" alt="{{ $draftPurchaseOrder->buyer_business->business_name }}"/>--}}
{{--                                        <h1 class="text-center text-2xl">{{ $draftPurchaseOrder->buyer_business->business_name }}</h1>--}}
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <img class="h-20 w-30 object-cover mx-auto" src="{{ Storage::url($draftPurchaseOrder->buyer_business->business_photo_url) }}" style="border-radius: 9px;"/>
                                        <h1 class="text-center text-3xl">{{__('portal.Draft Purchase Order')}}</h1>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
{{--                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrder->supplier_business->business_photo_url) }}" alt="{{ $draftPurchaseOrder->supplier_business->business_name }}"/>--}}
{{--                                        <h1 class="text-center text-2xl">{{ $draftPurchaseOrder->supplier_business->business_name }}</h1>--}}
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                        <strong>{{__('portal.Buyer')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif;">{{ $draftPurchaseOrder->buyer_business->business_name }}</span><br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif;">{{ $draftPurchaseOrder->buyer_business->city }}</span> <br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif;">{{ $draftPurchaseOrder->buyer_business->vat_reg_certificate_number }}</span><br>
                                        <strong>{{__('portal.Contact #')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif;">{{ $draftPurchaseOrder->otp_mobile_number }}</span><br>
                                        @php $warehouse = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrder->warehouse_id)->first()->only('warehouse_name'); @endphp
                                        <strong>{{__('portal.Warehouse for delivery')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif;">{{ $warehouse['warehouse_name'] }}</span><br><br>

                                        <strong>{{__('portal.D.P.O.')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.DPO')}}-<span style="font-family: sans-serif;">{{ $draftPurchaseOrder->id }}</span><br>
                                        <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif;">{{ $draftPurchaseOrder->created_at }}</span><br>
                                        <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-<span style="font-family: sans-serif;">{{ $draftPurchaseOrder->qoute_no }}</span><br>
                                        <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-<span style="font-family: sans-serif;">{{ $draftPurchaseOrder->eOrderItem->id }}</span><br>
                                        <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
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
                                        <strong>{{__('portal.Supplier')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif;">{{ $draftPurchaseOrder->supplier_business->business_name }}</span> <br>
                                        <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> <span style="font-family: sans-serif;">{{ $draftPurchaseOrder->supplier_business->city }}</span> <br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif;">{{ $draftPurchaseOrder->supplier_business->vat_reg_certificate_number }}</span> <br>
                                        <strong>{{__('portal.Email')}}: &nbsp;</strong><span style="font-family: sans-serif;">{{ $draftPurchaseOrder->supplier_business->business_email }}</span> <br>
                                    </div>
                                </div>

                                <table class="min-w-full divide-y divide-black ">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            #
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Category Name')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Description')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Brand')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.UOM')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Remarks')}}
                                        </th>

                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Unit Price')}}
                                        </th>

                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Quantity')}}
                                        </th>

                                        <th scope="col" class="px-2 py-2 border border-black text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Amount')}}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-black border-1 border-black">
                                    <tr>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black  border border-black" style="font-family: sans-serif;">
                                            1
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black  border border-black">
                                            @php
                                                $record = \App\Models\Category::where('id',$draftPurchaseOrder->item_code)->first();
                                                $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                            @endphp
                                            {{ $record->name_ar }}@if(isset($parent)), {{ $parent->name_ar }} @endif
                                        </td>
                                        <td class="px-2 py-2 text-sm text-center text-black  border border-black" style="font-family: sans-serif;">
                                            {{ strip_tags($draftPurchaseOrder->eOrderItem->description) }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black  border border-black" style="font-family: sans-serif;">
                                            {{ $draftPurchaseOrder->brand }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black  border border-black">
                                            @php $UOM = \App\Models\UnitMeasurement::where('uom_en', $draftPurchaseOrder->uom)->pluck('uom_ar')->first(); @endphp
                                            {{ $UOM }}
                                        </td>
                                        <td class="px-2 py-2 text-sm text-center text-black  border border-black" style="font-family: sans-serif;">
                                            @if(isset($draftPurchaseOrder->remarks)) {{ strip_tags($draftPurchaseOrder->remarks) }} @else {{__('portal.N/A')}} @endif
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black  border border-black">
                                            <span style="font-family: sans-serif;">{{ $draftPurchaseOrder->unit_price }}</span> {{__('portal.SAR')}}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black  border border-black" style="font-family: sans-serif;">
                                            {{ $draftPurchaseOrder->quantity }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black  border border-black">
                                            <span style="font-family: sans-serif;">{{ number_format($draftPurchaseOrder->sub_total, 2) }}</span> {{__('portal.SAR')}}
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
                                        <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif;">{{ number_format($draftPurchaseOrder->sub_total, 2) }}</span> {{__('portal.SAR')}}<br>
                                        @php $subtotal = $draftPurchaseOrder->sub_total; $subtotal += $draftPurchaseOrder->shipment_cost; @endphp
                                        <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif;">{{ number_format($draftPurchaseOrder->shipment_cost, 2) }}</span> {{__('portal.SAR')}}<br>
                                        <strong>{{__('portal.VAT')}} <span style="font-family: sans-serif;">{{ number_format($draftPurchaseOrder->vat) }}</span>%: @if($draftPurchaseOrder->vat > 9)  @else &nbsp;&nbsp; @endif </strong><span style="font-family: sans-serif;">{{ number_format($subtotal * ($draftPurchaseOrder->vat/100), 2) }}</span> {{__('portal.SAR')}}<br>
                                        <hr>
                                        <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif;">{{ number_format(($draftPurchaseOrder->total_cost),2) }}</span>  {{__('portal.SAR')}}<br>
                                        <hr>
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden  p-4 mt-4">
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
                                        <strong>{{__('portal.Mobile Number for OTP')}}: </strong> <span style="font-family: sans-serif;">{{ $draftPurchaseOrder->otp_mobile_number }}</span> <br>
                                        <strong>{{__('portal.Warehouse for delivery')}}: </strong> <span style="font-family: sans-serif;">{{ $warehouse['warehouse_name'] }}</span> <br>
                                        <strong class="text-red-900">{{__('portal.Note')}}: </strong> <span class="text-red-700">
                                            {{__('portal.We acknowledge that')}} {{$draftPurchaseOrder->buyer_business->business_name }}
                                                        {{__('portal.agrees to deal with')}} {{$draftPurchaseOrder->supplier_business->business_name}}. <br>
                                            {{__('portal.Emdad has no responsibility with the kind of delivery and the source of finance for this delivery.')}}</span> <br>
                                        @if($draftPurchaseOrder->quote->expiry_date >= \Carbon\Carbon::now() && $draftPurchaseOrder->status != 'cancel')
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" name="note" id="acknowledge" required>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    {{__('portal.Please read the note and check if you agree to proceed')}}.
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                    @if($draftPurchaseOrder->quote->expiry_date >= \Carbon\Carbon::now())
                                        <div class="w-full overflow-hidden lg:w-1/2 xl:w-1/2">
                                            <div class="w-full overflow-hidden mt-3">
                                                <form action="{{route('uploadDPOFile')}}" method="post" id="upload-image-form" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" id="dpoID" name="dpo_id" value="{{$draftPurchaseOrder->id}}">
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
                                    @endif
                                </div>


                                <div class="flex justify-center">
                                    <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block" style="height: 104px"/></div>
                                </div>


                                <div class="flex justify-between mt-4 mb-4">


                                    @if ($draftPurchaseOrder->status == 'approved')
                                        <img src="" alt="">
                                        <span class="px-3 py-3 bg-green-800 text-white rounded">{{__('portal.Approve')}}</span>
                                    @elseif ($draftPurchaseOrder->status == 'cancel')
                                        <img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-8@8x.png')}}" alt="{{__('portal.P.O. Canceled')}}">
                                    @elseif ($draftPurchaseOrder->status == 'rejectToEdit')
                                        <span class="px-3 py-3 bg-red-600 text-white rounded uppercase">{{__('portal.Rejected for Edit')}}</span>
                                    @else
                                        @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))
                                            @if($draftPurchaseOrder->quote->expiry_date >= \Carbon\Carbon::now())
                                                <a href="{{ route('dpo.cancel', $draftPurchaseOrder->id) }}" onclick="cancel()"
                                                   class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                    {{__('portal.Cancel DPO')}}
                                                </a>
                                            @endif
                                            @if($draftPurchaseOrder->payment_term == 'Cash')
                                                @if($draftPurchaseOrder->quote->expiry_date >= \Carbon\Carbon::now())
                                                    <form method="post" action="{{route('cashDpo.approved', $draftPurchaseOrder->id)}}" class="confirm">
                                                        @csrf
                                                        <input type="hidden" value="{{ $draftPurchaseOrder->rfq_no }}" name="rfq_no">
                                                        <input type="hidden" value="{{ $draftPurchaseOrder->rfq_item_no }}" name="rfq_item_no">
                                                        <input type="hidden" value="{{ $draftPurchaseOrder->qoute_no }}" name="qoute_no">
                                                        <input type="hidden" value="{{ $draftPurchaseOrder->id }}" name="draft_purchase_order_id">
                                                        <input type="hidden" value="{{ $draftPurchaseOrder->user_id }}" name="buyer_user_id">
                                                        <input type="hidden" value="{{ $draftPurchaseOrder->business_id }}" name="buyer_business_id">
                                                        <input type="hidden" value="{{ $draftPurchaseOrder->supplier_user_id }}" name="supplier_user_id">
                                                        <input type="hidden" value="{{ $draftPurchaseOrder->supplier_business_id }}" name="supplier_business_id">
                                                        <input type="hidden" value="{{ $draftPurchaseOrder->payment_term }}" name="payment_method">
                                                        <input type="hidden" value="{{ $draftPurchaseOrder->shipment_cost }}" name="shipment_cost">
                                                        <input type="hidden" value="{{ $draftPurchaseOrder->vat }}" name="vat">
                                                        <input type="hidden" value="{{ $draftPurchaseOrder->total_cost }}" name="total_cost">
                                                        <input type="hidden" value="{{ $draftPurchaseOrder->ship_to_address }}" name="ship_to_address">

                                                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">{{__('portal.Generate PO')}}</button>
                                                    </form>
                                                @endif
                                            @else
                                                @if($draftPurchaseOrder->quote->expiry_date >= \Carbon\Carbon::now())
                                                    <form method="POST" action="{{route('dpo.approved', $draftPurchaseOrder->id) }}" class="confirm">
                                                        @csrf
                                                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                                            {{__('portal.Generate PO')}}
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        @endif
                                        {{-- <a href="{{ route('dpo.rejected', $draftPurchaseOrder->id) }}" class="inline-flex  mx-4  items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Reject to Edit</a> --}}
                                    @endif


                                </div>

                                <div class="flex justify-between px-2 py-2 mt-2 h-15">
                                    <div></div>
                                    <div class="mt-3">{{__('portal.Thank you for using Emdad platform for your business.')}}</div>
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
                alert('يرجى قراءة الملاحظة والتأكيد في حال الموافقة للمتابعة \nملاحظة: نقرّ بموافقتنا على التعامل مع هذا المورّد. \nإمداد غير مسؤولة عن نوع التوصيل أو المصدر الممول لهذه الطلبية')
                event.preventDefault();
            }
            else if ($("#acknowledge").is(":checked")) {
                if(!confirm('هل أنت متأكد؟')){
                    e.preventDefault();
                }
            }
        });

        function cancel() {
            if(!confirm('هل أنت متأكد؟')){
                event.preventDefault();
            }
        }
    </script>
@endif
