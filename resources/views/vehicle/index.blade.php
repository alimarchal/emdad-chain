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
                <!-- Remaining User and Driver count for respective packages -->
                @php
                    $business_package = \App\Models\BusinessPackage::where('business_id', auth()->user()->business_id)->first();
                    $package = \App\Models\Package::where('id', $business_package->package_id)->first();
                    if(auth()->user()->usertype != 'superadmin')
                    {
                        if($business_package->package_id == 5 || $business_package->package_id == 6 )
                        {
                            $vehiclesRemaining = $package->truck - $vehiclesCount;
                        }

                    }
                @endphp
                @if($business_package->package_id == 5 || $business_package->package_id == 6 )
                    <div class="flex flex-wrap" style="justify-content: flex-start">
                        <h1 class="text-1xl mt-0 pb-0 text-center"> {{__('portal.Remaining Vehicles you can add')}}: </h1>
                        <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$vehiclesRemaining}} &nbsp;</h1>
                    </div>
                @endif
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @if (session()->has('message'))
                        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-1">{{ session('message') }}</strong>
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block flex flex-col bg-green rounded" id="alermessage">

                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-1">{{ session('error') }}</strong>
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    @php $total = 0; @endphp

                    <div class="py-3">
                        <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                            <a href="{{ route('vehicle.create') }}" style="background-color: #145EA8"
                               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none active:bg-red-600 transition ease-in-out duration-150">
                                {{__('portal.Add Vehicle')}}
                            </a>
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <h2 class="text-2xl font-bold text-center">{{__('portal.Vehicles List')}}</h2>
                            <x-jet-validation-errors class="mb-4" />

                        @if ($vehicles->count())
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                                <table class="min-w-full divide-y divide-gray-200 " id="roles-table">
                                                    <thead class="bg-gray-50">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                                #
                                                            </th>
                                                            <th scope="col" class="px-6 py-30 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                                {{__('portal.Vehicle Type')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-30 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                                {{__('portal.Licence')}} #
                                                            </th>
                                                            <th scope="col" class="px-6 py-30 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                                {{__('portal.Status')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-30 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                                {{__('portal.Action')}}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200 ">
                                                    @foreach ($vehicles as $vehicle)
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap ml-10 text-center">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap ml-10 text-center">
                                                                <a href="{{ route('vehicle.edit', $vehicle) }}" class="hover:text-blue-900 hover:underline text-blue-900">{{$vehicle->type}}</a>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap ml-10 text-center">
                                                                <a href="{{ route('vehicle.edit', $vehicle) }}" class="hover:text-blue-900 hover:underline text-blue-900">{{$vehicle->licence_plate_No}}</a>
                                                            </td>

                                                            <td class="px-6 py-4 whitespace-nowrap ml-10 text-center">
                                                                @if($vehicle->availability_status == 1)
                                                                    <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-green-100  text-green-800">
                                                                        {{__('portal.Available')}}
                                                                    </span>
                                                                @elseif($vehicle->availability_status == 0)
                                                                    <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-red-100  text-red-800">
                                                                        {{__('portal.Not-Available')}}
                                                                    </span>
                                                                @endif
                                                            </td>

                                                            <td class="whitespace-nowrap ml-10 text-center">
                                                                <a href="{{ route('vehicle.edit', $vehicle) }}" class="text-indigo-600 inline-block hover:text-indigo-900" title="EDIT">
                                                                    <svg width="18" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                    </svg>
                                                                </a>
                                                                <form action="{{ route('vehicle.destroy', $vehicle) }}" method="post" class="inline-block">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="text-indigo-600 inline-block hover:text-indigo-900" title="DELETE" onsubmit="alert('Are you sure')">
                                                                        <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="red">
                                                                            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                                                            <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                                        </svg>
                                                                    </button>
                                                                </form>

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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Remaining User and Driver count for respective packages -->
                @php
                    $business_package = \App\Models\BusinessPackage::where('business_id', auth()->user()->business_id)->first();
                    $package = \App\Models\Package::where('id', $business_package->package_id)->first();
                    if(auth()->user()->usertype != 'superadmin')
                    {
                        if($business_package->package_id == 5 || $business_package->package_id == 6 )
                        {
                            $vehiclesRemaining = $package->truck - $vehiclesCount;
                        }

                    }
                @endphp
                @if($business_package->package_id == 5 || $business_package->package_id == 6 )
                    <div class="flex flex-wrap" style="justify-content: flex-start">
                        <h1 class="text-1xl mt-0 pb-0 text-center"> {{__('portal.Remaining Vehicles you can add')}}: </h1>
                        <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$vehiclesRemaining}} &nbsp;</h1>
                    </div>
                @endif
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @if (session()->has('message'))
                        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-3">{{ session('message') }}</strong>
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block flex flex-col bg-green rounded" id="alermessage">

                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-3">{{ session('error') }}</strong>
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    @php $total = 0; @endphp

                    <div class="py-3">
                        <div class="mt-5" style=" margin-right: 30px; margin-bottom: 10px ">
                            <a href="{{ route('vehicle.create') }}" style="background-color: #145EA8"
                               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none active:bg-red-600 transition ease-in-out duration-150">
                                {{__('portal.Add Vehicle')}}
                            </a>
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <h2 class="text-2xl font-bold text-center">{{__('portal.Vehicles List')}}</h2>
                            <x-jet-validation-errors class="mb-4" />

                            @if ($vehicles->count())
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                                <table class="min-w-full divide-y divide-gray-200 " id="roles-table">
                                                    <thead class="bg-gray-50">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                            #
                                                        </th>
                                                        <th scope="col" class="px-6 py-30 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                            {{__('portal.Vehicle Type')}}
                                                        </th>
                                                        <th scope="col" class="px-6 py-30 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                            {{__('portal.Licence')}} #
                                                        </th>
                                                        <th scope="col" class="px-6 py-30 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                            {{__('portal.Status')}}
                                                        </th>
                                                        <th scope="col" class="px-6 py-30 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                            {{__('portal.Action')}}
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200 ">
                                                    @foreach ($vehicles as $vehicle)
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap ml-10 text-center">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap ml-10 text-center">
                                                                <a href="{{ route('vehicle.edit', $vehicle) }}" class="hover:text-blue-900 hover:underline text-blue-900">{{$vehicle->type}}</a>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap ml-10 text-center">
                                                                <a href="{{ route('vehicle.edit', $vehicle) }}" class="hover:text-blue-900 hover:underline text-blue-900">{{$vehicle->licence_plate_No}}</a>
                                                            </td>

                                                            <td class="px-6 py-4 whitespace-nowrap ml-10 text-center">
                                                                @if($vehicle->availability_status == 1)
                                                                    <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-green-100  text-green-800">
                                                                        {{__('portal.Available')}}
                                                                    </span>
                                                                @elseif($vehicle->availability_status == 0)
                                                                    <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-red-100  text-red-800">
                                                                        {{__('portal.Not-Available')}}
                                                                    </span>
                                                                @endif
                                                            </td>

                                                            <td class="whitespace-nowrap ml-10 text-center">
                                                                <a href="{{ route('vehicle.edit', $vehicle) }}" class="text-indigo-600 inline-block hover:text-indigo-900" title="EDIT">
                                                                    <svg width="18" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                    </svg>
                                                                </a>
                                                                <form action="{{ route('vehicle.destroy', $vehicle) }}" method="post" class="inline-block">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="text-indigo-600 inline-block hover:text-indigo-900" title="DELETE" onsubmit="alert('Are you sure')">
                                                                        <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="red">
                                                                            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                                                            <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                                        </svg>
                                                                    </button>
                                                                </form>

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
                                    <strong class="mr-3">{{__('portal.No record found...!')}}</strong>
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
