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
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User List') }}
            </h2>
        </x-slot>

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

                    <div class="py-3">
                        <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                            <a href="{{ route('createSupplier') }}"
                               class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none active:bg-green-600 transition ease-in-out duration-150">
                                {{__('portal.Add Supplier')}}
                            </a>
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <h2 class="text-2xl font-bold text-center">{{__('portal.List of Suppliers')}}</h2>
                        @if ($suppliers->count())
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                <table class="min-w-full divide-y divide-gray-200" id="roles-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm text-center font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                #
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm text-center font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.Name')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm text-center font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.Email')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm text-center font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.Mobile')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm text-center font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.Business Name')}}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                    @foreach ($suppliers as $supplier)
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                <span class="badge badge-info">{{ $loop->iteration }}</span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                <span class="badge badge-info">{{ $supplier->name }}</span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100  text-green-800">
                                                                    {{$supplier->email }}
                                                                </span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100  text-green-800">
                                                                    {{$supplier->mobile }}
                                                                </span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full @if(isset($supplier->business_id)) bg-green-100  text-green-800 @else bg-red-100  text-red-800 @endif">
                                                                    @if(isset($supplier->business_id))
                                                                        {{$supplier->business->business_name }}
                                                                    @else
                                                                        {{__('portal.Not business yet registered')}}
                                                                    @endif
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            @else
                                <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                                    <strong class="mr-1">{{__('portal.No suppliers yet..!')}}</strong>
                                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>


                </div>

                {{--@if ($suppliers->count() >= 50)
                    <div class="px-4 py-5 mt-3 bg-white sm:p-6 rounded-sm">
                        <div class="col-span-12 sm:col-span-12">
                            {{ $suppliers->links() }}
                        </div>
                    </div>
                @endif--}}
            </div>
        </div>


    </x-app-layout>

    <script>
        $(document).ready(function () {
            $('#roles-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });

    </script>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User List') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @if (session()->has('message'))
                        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-3">{{ session('message') }}</strong>
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    <div class="py-3">
                        <div class="mt-5" style=" margin-right: 30px; margin-bottom: 10px ">
                            <a href="{{ route('createSupplier') }}"
                               class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none active:bg-green-600 transition ease-in-out duration-150">
                                {{__('portal.Add Supplier')}}
                            </a>
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <h2 class="text-2xl font-bold text-center">{{__('portal.List of Suppliers')}}</h2>
                            @if ($suppliers->count())
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                <table class="min-w-full divide-y divide-gray-200" id="roles-table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                            #
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                            {{__('portal.Name')}}
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                            {{__('portal.Email')}}
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                            {{__('portal.Mobile')}}
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                            {{__('portal.Business Name')}}
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                    @foreach ($suppliers as $supplier)
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500" style="font-family: sans-serif">
                                                                <span class="badge badge-info">{{ $loop->iteration }}</span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500" style="font-family: sans-serif">
                                                                <span class="badge badge-info">{{ $supplier->name }}</span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100  text-green-800" style="font-family: sans-serif">
                                                                    {{$supplier->email }}
                                                                </span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100  text-green-800" style="font-family: sans-serif">
                                                                    {{$supplier->mobile }}
                                                                </span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full @if(isset($supplier->business_id)) bg-green-100  text-green-800 @else bg-red-100  text-red-800 @endif">
                                                                    @if(isset($supplier->business_id))
                                                                        {{$supplier->business->business_name }}
                                                                    @else
                                                                        {{__('portal.Not business yet registered')}}
                                                                    @endif
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            @else
                                <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                                    <strong class="mr-3">{{__('portal.No suppliers yet..!')}}</strong>
                                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>


                </div>

                {{--@if ($suppliers->count() >= 50)
                    <div class="px-4 py-5 mt-3 bg-white sm:p-6 rounded-sm">
                        <div class="col-span-12 sm:col-span-12">
                            {{ $suppliers->links() }}
                        </div>
                    </div>
                @endif--}}
            </div>
        </div>


    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#roles-table').DataTable( {
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
