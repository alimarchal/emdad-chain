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
@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <div class="py-6">
            <h2 class="text-2xl text-center font-bold pb-2">
                @if(auth()->user()->registration_type == 'Buyer')
                    {{__('portal.All Unpaid Invoices')}}
                @elseif(auth()->user()->registration_type == 'Supplier')
                    {{__('portal.List of Unpaid invoices')}}
                @endif
            </h2>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-0 rounded-sm">
                        <table class="min-w-full divide-y divide-gray-200" id="invoices">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{__('portal.Invoice Number')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{__('portal.Invoice Date')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        @if(auth()->user()->registration_type == 'Buyer') {{__('portal.Supplier Business name')}} @elseif(auth()->user()->registration_type == 'Supplier') {{__('portal.Buyer Business name')}} @endif
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{__('portal.Status')}}
                                    </th>
                                    @if(auth()->user()->registration_type == 'Buyer')
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            @if(auth()->user()->registration_type == 'Buyer') {{__('portal.Claim')}} @elseif(auth()->user()->registration_type == 'Supplier') {{__('portal.Confirm')}} @endif {{__('portal.manual payment')}}
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($collection as $item)
                                <tr>
                                    <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                        @if (auth()->user()->registration_type == 'Buyer')
                                            <a href="{{ route('singleCategoryInvoiceShow',$item->id) }}" class="text-blue-600 hover:underline" target="_blank">{{__('portal.Emdad')}}-{{$item->id}}</a>
                                        @elseif(auth()->user()->registration_type == 'Supplier')
                                            <a href="{{ route('singleCategoryInvoiceShow',$item->id) }}" class="text-blue-600 hover:underline" target="_blank">{{__('portal.Emdad')}}-{{$item->id}}</a>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                        @if (auth()->user()->registration_type == 'Buyer')
                                            @php $invoiceDate = \App\Models\Invoice::where('id', $item->id)->first(); @endphp
                                        @elseif(auth()->user()->registration_type == 'Supplier')
                                            @php $invoiceDate = \App\Models\Invoice::where('id', $item->id)->first(); @endphp
                                        @endif
                                        {{\Carbon\Carbon::parse($item->created_at)->format('d-M-Y')}}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                        @if(auth()->user()->registration_type == 'Buyer')
                                            @php $businessName = \App\Models\Business::where('id', $item->supplier_business_id)->first(); @endphp
                                        @elseif(auth()->user()->registration_type == 'Supplier')
                                            @php $businessName = \App\Models\Business::where('id', $item->buyer_business_id)->first(); @endphp
                                        @endif

                                        {{$businessName->business_name}}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                        @if (auth()->user()->registration_type == 'Buyer')
                                            @if ($item->invoice_status == '0')
                                                {{__('portal.Un-Paid')}}
                                            @elseif ($item->invoice_status == '1')
                                                {{__('portal.Supplier Verification Pending')}}
                                            @elseif ($item->invoice_status == '2')
                                                {{__('portal.Supplier Rejected')}}
                                            @elseif ($item->invoice_status == '3')
                                                {{__('portal.Supplier Confirmed')}}
                                            @endif
                                        @elseif(auth()->user()->registration_type == 'Supplier')
                                            @if ($item->invoice_status == '0')
                                                {{__('portal.Un-Paid')}}
                                            @elseif ($item->invoice_status == '1')
                                                {{__('portal.Verification Pending')}}
                                            @elseif ($item->invoice_status == '2')
                                                {{__('portal.Rejected')}}
                                            @elseif ($item->invoice_status == '3')
                                                {{__('portal.Confirmed')}}
                                            @endif
                                        @endif

                                    </td>
                                    @if (auth()->user()->registration_type == 'Buyer')

                                        <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                            <a href="@if($item->invoice_status == '0') {{ route('bank-payments.create', $item->id) }} @endif" class="text-blue-600 hover:underline" target="_blank">
                                                {{__('portal.Proceed')}}
                                            </a> |
                                            @if($item->invoice_status == '0')
                                                <form action="{{route('make.payment')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="invoice_id" value="{{$item->id}}">
                                                    <button type="submit" class="text-blue-600 hover:underline" target="_blank">
                                                        {{__('portal.Make Payment Online')}}
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#invoices').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        });
    </script>
@else
    <x-app-layout>
        <div class="py-6">
            <h2 class="text-2xl text-center font-bold pb-2">
                @if(auth()->user()->registration_type == 'Buyer')
                    {{__('portal.All Unpaid Invoices')}}
                @elseif(auth()->user()->registration_type == 'Supplier')
                    {{__('portal.List of Unpaid invoices')}}
                @endif
            </h2>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-0 rounded-sm">
                        <table class="min-w-full divide-y divide-gray-200" id="invoices">
                            <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{__('portal.Invoice Number')}}
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{__('portal.Invoice Date')}}
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    @if(auth()->user()->registration_type == 'Buyer') {{__('portal.Supplier Business name')}} @elseif(auth()->user()->registration_type == 'Supplier') {{__('portal.Buyer Business name')}} @endif
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{__('portal.Status')}}
                                </th>
                                @if(auth()->user()->registration_type == 'Buyer')
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        @if(auth()->user()->registration_type == 'Buyer') {{__('portal.Claim')}} @elseif(auth()->user()->registration_type == 'Supplier') {{__('portal.Confirm')}} @endif {{__('portal.manual payment')}}
                                    </th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($collection as $item)
                                <tr>
                                    <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                        @if (auth()->user()->registration_type == 'Buyer')
                                            <a href="{{ route('singleCategoryInvoiceShow',$item->id) }}" class="text-blue-600 hover:underline" target="_blank">{{__('portal.Emdad')}}-{{$item->id}}</a>
                                        @elseif(auth()->user()->registration_type == 'Supplier')
                                            <a href="{{ route('singleCategoryInvoiceShow',$item->id) }}" class="text-blue-600 hover:underline" target="_blank">{{__('portal.Emdad')}}-{{$item->id}}</a>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                        @if (auth()->user()->registration_type == 'Buyer')
                                            @php $invoiceDate = \App\Models\Invoice::where('id', $item->id)->first(); @endphp
                                        @elseif(auth()->user()->registration_type == 'Supplier')
                                            @php $invoiceDate = \App\Models\Invoice::where('id', $item->id)->first(); @endphp
                                        @endif
                                        {{\Carbon\Carbon::parse($item->created_at)->format('d-M-Y')}}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                        @if(auth()->user()->registration_type == 'Buyer')
                                            @php $businessName = \App\Models\Business::where('id', $item->supplier_business_id)->first(); @endphp
                                        @elseif(auth()->user()->registration_type == 'Supplier')
                                            @php $businessName = \App\Models\Business::where('id', $item->buyer_business_id)->first(); @endphp
                                        @endif

                                        {{$businessName->business_name}}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                        @if (auth()->user()->registration_type == 'Buyer')
                                            @if ($item->invoice_status == '0')
                                                {{__('portal.Un-Paid')}}
                                            @elseif ($item->invoice_status == '1')
                                                {{__('portal.Supplier Verification Pending')}}
                                            @elseif ($item->invoice_status == '2')
                                                {{__('portal.Supplier Rejected')}}
                                            @elseif ($item->invoice_status == '3')
                                                {{__('portal.Supplier Confirmed')}}
                                            @endif
                                        @elseif(auth()->user()->registration_type == 'Supplier')
                                            @if ($item->invoice_status == '0')
                                                {{__('portal.Un-Paid')}}
                                            @elseif ($item->invoice_status == '1')
                                                {{__('portal.Verification Pending')}}
                                            @elseif ($item->invoice_status == '2')
                                                {{__('portal.Rejected')}}
                                            @elseif ($item->invoice_status == '3')
                                                {{__('portal.Confirmed')}}
                                            @endif
                                        @endif

                                    </td>
                                    @if (auth()->user()->registration_type == 'Buyer')

                                        <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                            <a href="@if($item->invoice_status == '0') {{ route('bank-payments.create', $item->id) }} @endif" class="text-blue-600 hover:underline" target="_blank">
                                                {{__('portal.Proceed')}}
                                            </a> |
                                            @if($item->invoice_status == '0')
                                                <form action="{{route('make.payment')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="invoice_id" value="{{$item->id}}">
                                                    <button type="submit" class="text-blue-600 hover:underline" target="_blank">
                                                        {{__('portal.Make Payment Online')}}
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#invoices').DataTable( {
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
