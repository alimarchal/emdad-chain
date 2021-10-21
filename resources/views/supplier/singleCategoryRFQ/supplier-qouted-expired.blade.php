@section('headerScripts')
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

    <style>
        #datepicker {
            width: 100%;
            padding: 10px;
            cursor: default;
            /*text-transform: uppercase;*/
            font-size: 13px;
            background: #FFFFFF;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            border: solid 1px #d2d6dc;
            box-shadow: none;
        }
    </style>
@endsection
@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>
        @if (session()->has('message'))
            <div class="block mt-4 text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @foreach ($errors->get('expiry_date') as $error)
            <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative mt-4" role="alert">
                <strong class="mr-1">{{ $error }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endforeach
        <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Quotations List')}} @if (!$collection->count()) {{__('portal.seems empty')}} @endif </h2>

        <div class="bg-white">
            @include('supplier.singleCategoryRFQ.navBar')
        </div>
        @if ($collection->count())
            <div class="flex flex-col bg-white rounded ">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200" id="quotation-table">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Quotation')}}&nbsp;#
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Category Name')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{ ucwords(str_replace("_", " ", __('portal.Requisition'))) }} #
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{ ucwords(str_replace("_", " ", __('portal.Shipping Time In Days'))) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{ ucwords(str_replace("_", " ", __('portal.Quote status'))) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{ ucwords(str_replace("_", " ", __('portal.Valid upto'))) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{ ucwords(str_replace("_", " ", __('portal.Generate PDF'))) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{ ucwords(str_replace("_", " ", __('portal.Action'))) }}
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($collection as $rfp)
                                    @if($rfp->qoute_status_updated != 'Rejected')
                                    <tr>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{__('portal.Q')}}-{{$rfp->id}}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @php
                                                $record = \App\Models\Category::where('id',$rfp->orderItem->item_code)->first();
                                                $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                            @endphp
                                            {{ $rfp->orderItem->item_name }}, {{$parent->name}}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{__('portal.RFQ')}}-{{ $rfp->RFQ->id }}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $rfp->shipping_time_in_days }}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @if($rfp->qoute_status == 'Qouted' && $rfp->request_status == 1 || $rfp->qoute_status == 'accepted' && $rfp->request_status == 1) {{__('portal.Buyer Requested to extend expiry date.')}}
                                            @else {{__('portal.Quoted')}}
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            <span class="text-red-600"> {{ __('portal.Expired') }} </span>
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            <a href="{{route('PDFForSingleCategoryQuotation', [ 'quoteID' => encrypt($rfp->e_order_id), 'eOrderItemID' => encrypt($rfp->orderItem->id)])}}">
                                                <img src="{{url('pdf.png')}}" style="height: 40px; padding-left: 30%;">
                                            </a>
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @if($rfp->qoute_status == 'Qouted' && $rfp->request_status == 1 || $rfp->qoute_status == 'accepted' && $rfp->request_status == 1)
                                                <a href="javascript:void(0)" title="{{__('portal.Extend quotation expiry date')}}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150" onclick="toggleModal({{$rfp->e_order_id}})">
                                                    {{__('portal.Accept')}}
                                                </a>
                                                <a href="{{route('quotationExpiredStatusRejectResponseSingleCategory', encrypt($rfp->e_order_id))}}" onclick="request()" title="{{__('portal.Reject request to extend quotation expiry date')}}" class="inline-flex mt-2 items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                    {{__('portal.Reject')}}
                                                </a>
                                            @else {{__('portal.N/A')}}
                                            @endif
                                        </td>

                                        <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="modal">
                                            <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                <div class="fixed inset-0 transition-opacity">
                                                    <div class="absolute inset-0 bg-gray-900 opacity-75" />
                                                </div>
                                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                                                <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                                    <form action="{{route('quotationExpiredStatusResponseSingleCategory')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="quoteEOrderID" id="quoteEOrderID">
                                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                            <label>{{__('portal.Last expiry date')}}:</label>
                                                            <input type="text" value="{{\Carbon\Carbon::parse($rfp->expiry_date)->format('m-d-Y')}}" disabled class="w-full bg-gray-100 p-2 mt-2 mb-3" />
                                                            <label>{{__('portal.Select New expiry date')}}:</label>
                                                            <input type="text" id="datepicker" class="block mt-1 w-full focus:outline-none focus:border-gray-700 focus:shadow-outline-gray" name="expiry_date" value="{{old('expiry_date')}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)" required>
                                                            @foreach ($errors->get('expiry_date') as $error)
                                                                <span class="text-red-700">{{ $error }}</span>
                                                            @endforeach
                                                        </div>
                                                        <div class="bg-gray-200 px-4 py-3 text-right">
                                                            <button type="button" class="py-2 px-4 bg-gray-500 text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray rounded hover:bg-gray-700 mr-2" onclick="toggleModal()">{{__('portal.Cancel')}}</button>
                                                            <button type="submit" class="py-2 px-4 text-white focus:outline-none focus:border-blue-700 focus:shadow-outline-blue rounded hover:bg-blue-700 mr-2" style="background-color: #145EA8">{{__('portal.Save')}}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#quotation-table').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        });

        function request() {
            if(!confirm('Are you sure to reject the request?')){
                event.preventDefault();
            }
        }
    </script>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>
        @if (session()->has('message'))
            <div class="block mt-4 text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @foreach ($errors->get('expiry_date') as $error)
            <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative mt-4" role="alert">
                <strong class="mr-1">{{ $error }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endforeach
        <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Quotations List')}} @if (!$collection->count()) {{__('portal.seems empty')}} @endif </h2>

        <div class="bg-white">
            @include('supplier.singleCategoryRFQ.navBar')
        </div>
        @if ($collection->count())
            <div class="flex flex-col bg-white rounded ">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200" id="quotation-table">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Quotation')}}&nbsp;#
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Category Name')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{ ucwords(str_replace("_", " ", __('portal.Requisition'))) }} #
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{ ucwords(str_replace("_", " ", __('portal.Shipping Time In Days'))) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{ ucwords(str_replace("_", " ", __('portal.Quote status'))) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{ ucwords(str_replace("_", " ", __('portal.Valid upto'))) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{ ucwords(str_replace("_", " ", __('portal.Generate PDF'))) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{ ucwords(str_replace("_", " ", __('portal.Action'))) }}
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($collection as $rfp)
                                    @if($rfp->qoute_status_updated != 'Rejected')
                                    <tr>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{__('portal.Q')}}-{{$rfp->id}}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @php
                                                $record = \App\Models\Category::where('id',$rfp->orderItem->item_code)->first();
                                                $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                            @endphp
                                            {{ $record->name_ar }}, {{$parent->name_ar}}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{__('portal.RFQ')}}-{{ $rfp->RFQ->id }}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $rfp->shipping_time_in_days }}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @if($rfp->qoute_status == 'Qouted' && $rfp->request_status == 1 || $rfp->qoute_status == 'accepted' && $rfp->request_status == 1) {{__('portal.Buyer Requested to extend expiry date.')}}
                                            @else {{__('portal.Quoted')}}
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            <span class="text-red-600"> {{ __('portal.Expired') }} </span>
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            <a href="{{route('PDFForSingleCategoryQuotation', [ 'quoteID' => encrypt($rfp->e_order_id), 'eOrderItemID' => encrypt($rfp->orderItem->id)])}}">
                                                <img src="{{url('pdf.png')}}" style="height: 40px; padding-right: 35%;">
                                            </a>
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @if($rfp->qoute_status == 'Qouted' && $rfp->request_status == 1 || $rfp->qoute_status == 'accepted' && $rfp->request_status == 1)
                                                <a href="javascript:void(0)" title="{{__('portal.Extend quotation expiry date')}}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150" onclick="toggleModal({{$rfp->e_order_id}})">
                                                    {{__('portal.Accept')}}
                                                </a>
                                                <a href="{{route('quotationExpiredStatusRejectResponseSingleCategory', encrypt($rfp->e_order_id))}}" onclick="request()" title="{{__('portal.Reject request to extend quotation expiry date')}}" class="inline-flex mt-2 items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                    {{__('portal.Reject')}}
                                                </a>
                                            @else {{__('portal.N/A')}}
                                            @endif
                                        </td>

                                        <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="modal">
                                            <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                <div class="fixed inset-0 transition-opacity">
                                                    <div class="absolute inset-0 bg-gray-900 opacity-75" />
                                                </div>
                                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                                                <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                                    <form action="{{route('quotationExpiredStatusResponseSingleCategory')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="quoteEOrderID" id="quoteEOrderID">
                                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                            <label class="float-right">{{__('portal.Last expiry date')}}:</label>
                                                            <input type="text" value="{{\Carbon\Carbon::parse($rfp->expiry_date)->format('m-d-Y')}}" disabled class="w-full bg-gray-100 p-2 mt-2 mb-3" />
                                                            <label class="float-right">{{__('portal.Select New expiry date')}}:</label>
                                                            <input type="text" id="datepicker" class="block mt-1 w-full focus:outline-none focus:border-gray-700 focus:shadow-outline-gray" name="expiry_date" value="{{old('expiry_date')}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)" required>
                                                            @foreach ($errors->get('expiry_date') as $error)
                                                                <span class="text-red-700">{{ $error }}</span>
                                                            @endforeach
                                                        </div>
                                                        <div class="bg-gray-200 px-4 py-3 text-right">
                                                            <button type="button" class="py-2 px-4 bg-gray-500 text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray rounded hover:bg-gray-700 mr-2" onclick="toggleModal()">{{__('portal.Cancel')}}</button>
                                                            <button type="submit" class="py-2 px-4 text-white focus:outline-none focus:border-blue-700 focus:shadow-outline-blue rounded hover:bg-blue-700 mr-2" style="background-color: #145EA8">{{__('portal.Save')}}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#quotation-table').DataTable( {
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

        function request() {
            if(!confirm('Are you sure to reject the request?')){
                event.preventDefault();
            }
        }
    </script>
@endif

<script>
    $( function() {
        $( "#datepicker" ).datepicker({
            dateFormat: 'mm/dd/yy',
            changeMonth: true,
            changeYear: true,
            minDate: +5,
            maxDate: +94,
            clear: true,
            required: true,
        }).attr('readonly', 'readonly');
    } );

    function toggleModal(id) {
        document.getElementById('modal').classList.toggle('hidden')
        $("#quoteEOrderID").val(id);
    }
</script>
