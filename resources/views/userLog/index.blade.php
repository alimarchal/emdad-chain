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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User log') }} </h2>
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
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <h2 class="text-2xl font-bold text-center">{{__('portal.User Logs list')}}</h2>
                            <x-jet-validation-errors class="mb-4" />
                        @if ($users->count())
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
                                                                {{__('portal.User name')}}
                                                            </th>

                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                                {{__('portal.Company Name')}}
                                                            </th>

                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                                {{__('portal.Business Checked/Saw')}}
                                                            </th>

                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                                {{__('portal.Logged in at')}}
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                        @foreach ($users as $user)
                                                            <tr>
                                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                                    <div class="text-sm text-gray-900">{{ $loop->iteration }}</div>
                                                                </td>

                                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                                    <div class="text-sm text-gray-900">{{ isset($user->user->name) ? $user->user->name : __('portal.N/A')  }}</div>
                                                                </td>

                                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                                    <div class="text-sm text-gray-900">
                                                                        {{ isset($user->user->business->business_name) ? $user->user->business->business_name : __('portal.N/A')  }}
                                                                    </div>
                                                                </td>

                                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                                    @if($user->business_inspect_check == 0)
                                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"> {{__('portal.No')}} </span>
                                                                    @elseif($user->business_inspect_check == 1)
                                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> {{__('portal.Yes')}} </span>
                                                                    @endif
                                                                </td>

                                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                                    <div class="text-sm text-gray-900">{{ $user->login_at }}</div>
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
                                    <strong class="mr-1">{{__('portal.No record found...!')}}</strong>
                                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#alermessage').delay(2000).hide(0);
            $('#roles-table').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        });

    </script>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User log') }} </h2>
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
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <h2 class="text-2xl font-bold text-center">{{__('portal.User Logs list')}}</h2>
                            <x-jet-validation-errors class="mb-4" />
                            @if ($users->count())
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
                                                            {{__('portal.User name')}}
                                                        </th>

                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                            {{__('portal.Company Name')}}
                                                        </th>

                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                            {{__('portal.Business Checked/Saw')}}
                                                        </th>

                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                            {{__('portal.Logged in at')}}
                                                        </th>
                                                    </tr>
                                                    </thead>

                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                    @foreach ($users as $user)
                                                        <tr>
                                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                                <div class="text-sm text-gray-900">{{ $loop->iteration }}</div>
                                                            </td>

                                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                                <div class="text-sm text-gray-900">{{ isset($user->user->name) ? $user->user->name : __('portal.N/A')  }}</div>
                                                            </td>

                                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                                <div class="text-sm text-gray-900">
                                                                    {{ isset($user->user->business->business_name) ? $user->user->business->business_name : __('portal.N/A')  }}
                                                                </div>
                                                            </td>

                                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                                @if($user->business_inspect_check == 0)
                                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"> {{__('portal.No')}} </span>
                                                                @elseif($user->business_inspect_check == 1)
                                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> {{__('portal.Yes')}} </span>
                                                                @endif
                                                            </td>

                                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                                <div class="text-sm text-gray-900">{{ $user->login_at }}</div>
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
                                    <strong class="mr-1">{{__('portal.No record found...!')}}</strong>
                                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
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
