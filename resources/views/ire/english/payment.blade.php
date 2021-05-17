@extends('ire.english.layout.app')
@section('headerScripts')
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
{{--    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet">--}}

    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
{{--    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>--}}
    {{--    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>--}}
    {{--    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>--}}
@endsection

@section('body')
    {{--        <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight" style="padding-top: 10px;">--}}
    {{--            {{ __('References List') }}--}}
    {{--        </h2>--}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if (session()->has('message'))
                    <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-1">{{ session('message') }}</strong>
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                <script>
                    $(document).ready(function() {
                        $('#alermessage').delay(2000).hide(0);
                        $('#roles-table').DataTable( {
                            dom: 'Bfrtip',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ]
                        } );
                    });

                </script>
                <div class="py-3">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <h2 class="text-2xl font-bold text-center">List of Payments</h2>
                        <x-jet-validation-errors class="mb-4" />
                    @if ($ireCommissions->count())
                        <!-- This example requires Tailwind CSS v2.0+ -->
                            <div class="flex flex-col">
                                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                            <table class="min-w-full divide-y divide-gray-200" id="roles-table">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                        #
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                        Name/s of References
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                        Email
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                        Mobile #
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                        Type
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                        Payment Status
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach ($ireCommissions as $ireCommission)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm text-center text-gray-900">{{ $loop->iteration }}</div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm text-center text-gray-900">
                                                                @if($ireCommission->type == 0)
                                                                    {{ $ireCommission->ireReference->name }}
                                                                @else
                                                                    {{ $ireCommission->nonIreReference->name }}
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm text-center text-gray-900">
                                                                @if($ireCommission->type == 0)
                                                                    {{ $ireCommission->ireReference->email }}
                                                                @else
                                                                    {{ $ireCommission->nonIreReference->email }}
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm text-center text-gray-900">
                                                                @if($ireCommission->type == 0)
                                                                    {{ $ireCommission->ireReference->mobile_number }}
                                                                @else
                                                                    {{ $ireCommission->nonIreReference->mobile }}
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm text-center text-gray-900">
                                                                @if($ireCommission->type == 0)
                                                                    IRE
                                                                @elseif($ireCommission->type == 1)
                                                                    Buyer
                                                                @elseif($ireCommission->type == 2)
                                                                    Supplier
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                            <div class="text-sm text-center text-gray-900">
                                                                @if($ireCommission->payment_status == 0)
                                                                    Un-paid
                                                                @else
                                                                    Paid
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                                </tbody>

                                                <!-- More rows... -->
                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        @else
                            <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                                <strong class="mr-1">No record found...!</strong>
                                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            @if ($ireCommissions->count() >= 50)
                <div class="px-4 py-5 mt-3 bg-white sm:p-6 rounded-sm">
                    <div class="col-span-12 sm:col-span-12">
                        {{ $ireCommissions->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>


@endsection
