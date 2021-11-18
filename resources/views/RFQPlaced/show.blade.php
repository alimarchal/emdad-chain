@section('headerScripts')
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    @if (session()->has('message'))
        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
            <strong class="mr-1">{{ session('message') }}</strong>
            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    @if (!$collection->count()) <h2 class="text-2xl font-bold py-0 text-center m-5">{{__('portal.Items List')}}{{__('portal.seems empty')}} @endif </h2>

    @if ($collection->count())
        @php $total = 0; @endphp

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
                                <a href="{{route('RFQItemsPDF', encrypt($collection[0]->e_order_id))}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                    {{__('portal.Create PDF')}}
                                </a>
                            </div>
                            <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                                <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3"> </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <img class="h-20 w-30 object-cover mx-auto" src="{{ Storage::url($collection[0]->business->business_photo_url) }}" alt="{{ $collection[0]->business->business_name }}" style="border-radius: 9px;"/>
                                        <h1 class="text-center text-3xl">{{__('portal.Requisition')}}</h1>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3"> </div>
                                </div>


                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                        @if(auth()->user()->rtl == 0)
                                            <strong>{{__('portal.Buyer')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $collection[0]->business->business_name }}<br>
                                            <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $collection[0]->business->business_email }}<br>
                                            <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $collection[0]->business->city }}</span><br>
                                            <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $collection[0]->business->vat_reg_certificate_number }}</span><br>
                                        @else
                                            <strong>{{__('portal.Buyer')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $collection[0]->business->business_name }}<br>
                                            <strong>{{__('portal.Email')}}: &nbsp;&nbsp;</strong>{{ $collection[0]->business->business_email }}<br>
                                            <strong>{{__('portal.City')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $collection[0]->business->city }}</span><br>
                                            <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $collection[0]->business->vat_reg_certificate_number }}</span><br>
                                        @endif
                                    </div>

                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                        @if(auth()->user()->rtl == 0)
                                            <strong>{{__('portal.Requisition Type')}}: &nbsp;&nbsp;</strong> @if($collection[0]->rfq_type == 1) {{__('portal.Multiple Categories')}} @else {{__('portal.Single Category')}} @endif <br>
                                            <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $collection[0]->created_at }}<br>
                                            <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{__('portal.RFQ')}}-{{ $collection[0]->id }}</span><br>
                                            <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                            @if($collection[0]->payment_mode == 'Cash') {{__('portal.Cash')}}
                                            @elseif($collection[0]->payment_mode == 'Credit') {{__('portal.Credit')}}
                                            @elseif($collection[0]->payment_mode == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                            @elseif($collection[0]->payment_mode == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                            @elseif($collection[0]->payment_mode == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                            @elseif($collection[0]->payment_mode == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                            @endif
                                            <br>
                                            <strong>{{__('portal.Contact #')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $collection[0]->warehouse->mobile }}</span> <br>
                                            <strong>{{__('portal.Delivery Address')}}: &nbsp;&nbsp;</strong><span>{{ $collection[0]->warehouse->address }}</span> <br>
                                        @else
                                            <strong>{{__('portal.Requisition Type')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> @if($collection[0]->rfq_type == 1) {{__('portal.Multiple Categories')}} @else {{__('portal.Single Category')}} @endif <br>
                                            <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $collection[0]->created_at }}<br>
                                            <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;</strong><span>{{__('portal.RFQ')}}-{{ $collection[0]->id }}</span><br>
                                            <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                            @if($collection[0]->payment_mode == 'Cash') {{__('portal.Cash')}}
                                            @elseif($collection[0]->payment_mode == 'Credit') {{__('portal.Credit')}}
                                            @elseif($collection[0]->payment_mode == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                            @elseif($collection[0]->payment_mode == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                            @elseif($collection[0]->payment_mode == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                            @elseif($collection[0]->payment_mode == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                            @endif
                                            <br>
                                            <strong>{{__('portal.Contact #')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $collection[0]->warehouse->mobile }}</span> <br>
                                            <strong>{{__('portal.Delivery Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span>{{ $collection[0]->warehouse->address }}</span> <br>
                                        @endif
                                    </div>
                                </div>

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
                                            {{__('portal.Size')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Delivery Period')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Last Unit Price')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Qty')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Remarks')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Attachments')}}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-black border-1 border-black">
                                    @foreach ($collection as $rfp)
                                    <tr>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            @php
                                                $category = \App\Models\Category::where('id',$rfp->category->id)->first();
                                                $parentCategory = \App\Models\Category::where('id',$category->parent_id)->first();
                                            @endphp
                                            {{ $rfp->item_name }}@if(isset($parentCategory->name)), {{ $parentCategory->name }} @endif
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{ strip_tags($rfp->description) }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            @if(isset($rfp->brand)) {{ $rfp->brand }} @endif
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{ $rfp->unit_of_measurement }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{ $rfp->size }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            @if($rfp->delivery_period =='Immediately') {{__('portal.Immediately')}}
                                            @elseif($rfp->delivery_period =='Within 30 Days') {{__('portal.30 Days')}}
                                            @elseif($rfp->delivery_period =='Within 60 Days') {{__('portal.60 Days')}}
                                            @elseif($rfp->delivery_period =='Within 90 Days') {{__('portal.90 Days')}}
                                            @elseif($rfp->delivery_period =='Standing Order - 2 per year') {{__('portal.Standing Order - 2 times / year')}}
                                            @elseif($rfp->delivery_period =='Standing Order - 3 per year') {{__('portal.Standing Order - 3 times / year')}}
                                            @elseif($rfp->delivery_period =='Standing Order - 4 per year') {{__('portal.Standing Order - 4 times / year')}}
                                            @elseif($rfp->delivery_period =='Standing Order - 6 per year') {{__('portal.Standing Order - 6 times / year')}}
                                            @elseif($rfp->delivery_period =='Standing Order - 12 per year') {{__('portal.Standing Order - 12 times / year')}}
                                            @elseif($rfp->delivery_period =='Standing Order Open') {{__('portal.Standing Order - Open')}}
                                            @endif
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{ number_format($rfp->last_price, 2) }} {{__('portal.SAR')}}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{ $rfp->quantity }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            @if(isset($rfp->remarks)){{ $rfp->remarks }} @else {{__('portal.N/A')}} @endif
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            @if ($rfp->file_path)
                                                <a href="{{ Storage::url($rfp->file_path) }}">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @else
                                                {{__('portal.N/A')}}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="flex justify-between px-2 py-2 mt-2 h-15">
                                    <div></div>
                                    <div class="mt-3">{{__('portal.Thank you for using Emdad platform for your business.')}}</div>
                                    <div></div>
                                </div>
                                <div class="flex justify-end px-2 py-2 h-15 mt-3">
                                    <div class="mt-2">{{__('portal.Copied to Emdad records')}}</div>
                                    <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-10 w-auto" style="margin-left: auto; margin-right: auto;"/></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="mt-5">
        <a href="{{route('PlacedRFQ.index')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
            {{__('portal.Back')}}
        </a>
    </div>

</x-app-layout>

@if(auth()->user()->rtl == 0)
    <script>
        $(document).ready(function() {
            $('#requisition-table').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        });

    </script>
@else
    <script>
        $(document).ready(function() {
            $('#requisition-table').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "language": {
                    "sSearch": "بحث:",
                    "oPaginate": {
                        "sFirst":    	"أولا",
                        "sPrevious": 	"السابق",
                        "sNext":     	"التالي",
                        "sLast":     	"الاخير"
                    },
                    "info": "عرض _PAGE_ ل _PAGES_ من _MAX_ المدخلات",
                },
            } );
        });
    </script>
@endif
