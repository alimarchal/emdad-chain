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
                    @if (session()->has('error'))
                        <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-1">{{ session('error') }}</strong>
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    @if(auth()->user()->registration_type == 'Supplier')
                    <!-- Remaining User and Driver count for respective packages -->
                        @php
                            $business_package = \App\Models\BusinessPackage::where('business_id', auth()->user()->business_id)->first();
                            $package = \App\Models\Package::where('id', $business_package->package_id)->first();
                            if(auth()->user()->usertype != 'SuperAdmin')
                            {

                                    $userRemaining = $package->users - $userCount;
                                    if($business_package->package_id != 7)
                                    {
                                        $driverRemaining = $package->driver - $driverCount;
                                    }
                            }
                        @endphp

                        <div class="flex flex-wrap" style="justify-content: flex-start">
                            <h1 class="text-1xl mt-0 pb-0 text-center"> {{__('portal.Remaining Users you can add')}}: </h1>
                            <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$userRemaining}} &nbsp;</h1>
                            @if($business_package->package_id == 5 || $business_package->package_id == 6 )
                                <h1 class="text-1xl mt-0 pb-0 text-center"> {{__('portal.Remaining Drivers you can add')}}: </h1>
                                <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$driverRemaining}} </h1>
                            @endif
                        </div>

                        <hr>
                    @elseif(auth()->user()->registration_type == 'Buyer')
                    <!-- Remaining User count for respective packages -->
                        @php
                            $business_package = \App\Models\BusinessPackage::where('business_id', auth()->user()->business_id)->first();
                            $package = \App\Models\Package::where('id', $business_package->package_id)->first();
                            if(auth()->user()->usertype != 'SuperAdmin')
                            {
                                $userRemaining = $package->users - $userCount;
                            }
                        @endphp
                        @if(auth()->user()->usertype != 'SuperAdmin')
                            <div class="flex flex-wrap" style="justify-content: flex-start">

                                <h1 class="text-1xl mt-0 pb-0 text-center">
                                    {{__('portal.Remaining Users you can add')}}:
                                </h1>

                                <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$userRemaining}} </h1>
                            </div>
                            <hr>
                        @endif
                    @endif
                    <div class="py-3">
                        @if(auth()->user()->registration_type == 'Supplier')
                            @if($userRemaining != 0 || $driverRemaining != 0)
                                <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                                    <a href="{{ route('users.create') }}" style="background-color: #145EA8"
                                       class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none active:bg-red-600 transition ease-in-out duration-150">
                                        {{__('portal.Add User')}}
                                    </a>
                                </div>
                            @endif
                        @elseif(auth()->user()->registration_type == 'Buyer')
                            @if(auth()->user()->usertype != 'SuperAdmin')
                                @if($userRemaining != 0)
                                    <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                                        <a href="{{ route('users.create') }}" style="background-color: #145EA8"
                                           class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none active:bg-red-600 transition ease-in-out duration-150">
                                            {{__('portal.Add User')}}
                                        </a>
                                    </div>
                                @endif
                            @endif
                        @endif
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            {{--                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
                            {{--                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">--}}
                            <h2 class="text-2xl font-bold text-center">{{__('portal.Users List')}}</h2>
                            @if ($users->count())
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                <table class="min-w-full divide-y divide-gray-200" id="roles-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{__('portal.User')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{__('portal.Timestamp')}}
                                                            </th>

                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{__('portal.Business Name')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{__('portal.Role')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{__('portal.Permissions')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{__('portal.Action')}}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                        @foreach ($users as $user)
                                                            <tr>
                                                                <td class="px-6 py-4 whitespace-nowrap">
                                                                    <div class="flex items-center">
                                                                        <div class="flex-shrink-0 h-10 w-10">
                                                                            <img class="h-3xl w-24 rounded-full" src="{{ empty($user->profile_photo_path) ? Storage::url('images.png') : Storage::url($user->profile_photo_path) }}" alt="{{__('portal.Profile Picture')}}">
                                                                            <!-- https://images.unsplash.com/photo-1584824486539-53bb4646bdbc?&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60 -->
                                                                        </div>
                                                                        <div class="ml-4">
                                                                            <div class="text-sm font-medium text-gray-900">
                                                                                {{ $user->name }}
                                                                            </div>
                                                                            <div class="text-sm text-gray-500">
                                                                                {{ $user->email }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>


                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                    {{$user->created_at}}
                                                                </td>

                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                    @if(empty($user->business_id))
                                                                        {{__('portal.NULL')}}
                                                                    @else
                                                                        @if($user->business->business_name)
                                                                            {{$user->business->business_name}}
                                                                        @else
                                                                            {{__('portal.NULL')}}
                                                                        @endif
                                                                    @endif

                                                                </td>

                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                    @foreach($user->roles()->pluck('name') as $role)
                                                                        @if(auth()->user()->registration_type == 'Buyer')
                                                                            <span class="badge badge-info">{{ str_replace('Buyer','',$role) }}</span>
                                                                        @elseif(auth()->user()->registration_type == 'Supplier')
                                                                            <span class="badge badge-info">{{ str_replace('Supplier','',$role) }}</span>
                                                                        @else
                                                                            <span class="badge badge-info">{{ $role }}</span>
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                    @if(!empty($user->getAllPermissions()))
                                                                        @foreach($user->getAllPermissions() as $v)
                                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100  text-green-800">
                                                                                {{$v->name }}
                                                                            </span>
                                                                        @endforeach
                                                                    @endif
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">

                                                                    <a href="{{ route('users.show', $user->id) }}" class="text-indigo-600 inline-block hover:text-indigo-900" title="VIEW">
                                                                        <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="blue">
                                                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                                        </svg>
                                                                    </a>
                                                                    <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 inline-block hover:text-indigo-900" title="EDIT">
                                                                        <svg width="18" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                                        </svg>
                                                                    </a>
                                                                    <form action="{{ route('users.destroy', $user->id) }}" method="post" class="inline-block">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="text-indigo-600 inline-block hover:text-indigo-900" title="DELETE" onsubmit="alert('Are you sure')">
                                                                            <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="red">
                                                                                <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"/>
                                                                                <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"/>
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
                                    <strong class="mr-1">{{__('portal.No users yet..!')}}</strong>
                                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                        </div>
                    </div>


                </div>

                            {{--@if ($users->count() >= 50)
                                <div class="px-4 py-5 mt-3 bg-white sm:p-6 rounded-sm">
                                    <div class="col-span-12 sm:col-span-12">
                                        {{ $users->links() }}
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
                            <strong class="mr-1">{{ session('message') }}</strong>
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                            </button>
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

                    @if(auth()->user()->registration_type == 'Supplier')
                    <!-- Remaining User and Driver count for respective packages -->
                        @php
                            $business_package = \App\Models\BusinessPackage::where('business_id', auth()->user()->business_id)->first();
                            $package = \App\Models\Package::where('id', $business_package->package_id)->first();
                            if(auth()->user()->usertype != 'SuperAdmin')
                            {

                                    $userRemaining = $package->users - $userCount;
                                    if($business_package->package_id != 7)
                                    {
                                        $driverRemaining = $package->driver - $driverCount;
                                    }
                            }
                        @endphp

                        <div class="flex flex-wrap" style="justify-content: flex-start">
                            <h1 class="text-1xl mt-0 pb-0 text-center"> {{__('portal.Remaining Users you can add')}}: </h1>
                            <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$userRemaining}} &nbsp;</h1>
                            @if($business_package->package_id == 5 || $business_package->package_id == 6 )
                                <h1 class="text-1xl mt-0 pb-0 text-center"> {{__('portal.Remaining Drivers you can add')}}: </h1>
                                <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$driverRemaining}} </h1>
                            @endif
                        </div>

                        <hr>
                    @elseif(auth()->user()->registration_type == 'Buyer')
                    <!-- Remaining User count for respective packages -->
                        @php
                            $business_package = \App\Models\BusinessPackage::where('business_id', auth()->user()->business_id)->first();
                            $package = \App\Models\Package::where('id', $business_package->package_id)->first();
                            if(auth()->user()->usertype != 'SuperAdmin')
                            {
                                $userRemaining = $package->users - $userCount;
                            }
                        @endphp
                        @if(auth()->user()->usertype != 'SuperAdmin')
                            <div class="flex flex-wrap" style="justify-content: flex-start">

                                <h1 class="text-1xl mt-0 pb-0 text-center">
                                    {{__('portal.Remaining Users you can add')}}:
                                </h1>

                                <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$userRemaining}} </h1>
                            </div>
                            <hr>
                        @endif
                    @endif
                    <div class="py-3">
                        @if(auth()->user()->registration_type == 'Supplier')
                            @if($userRemaining != 0 || $driverRemaining != 0)
                                <div class="mt-5" style=" margin-right: 30px; margin-bottom: 10px ">
                                    <a href="{{ route('users.create') }}" style="background-color: #145EA8"
                                       class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none active:bg-red-600 transition ease-in-out duration-150">
                                        {{__('portal.Add User')}}
                                    </a>
                                </div>
                            @endif
                        @elseif(auth()->user()->registration_type == 'Buyer')
                            @if(auth()->user()->usertype != 'SuperAdmin')
                                @if($userRemaining != 0)
                                    <div class="mt-5" style=" margin-right: 30px; margin-bottom: 10px ">
                                        <a href="{{ route('users.create') }}" style="background-color: #145EA8"
                                           class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none active:bg-red-600 transition ease-in-out duration-150">
                                            {{__('portal.Add User')}}
                                        </a>
                                    </div>
                                @endif
                            @endif
                        @endif
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            {{--                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
                            {{--                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">--}}
                            <h2 class="text-2xl font-bold text-center">{{__('portal.Users List')}}</h2>
                            @if ($users->count())
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                <table class="min-w-full divide-y divide-gray-200" id="roles-table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            {{__('portal.User')}}
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            {{__('portal.Timestamp')}}
                                                        </th>

                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            {{__('portal.Business Name')}}
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            {{__('portal.Role')}}
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            {{__('portal.Permissions')}}
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            {{__('portal.Action')}}
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                    @foreach ($users as $user)
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="flex items-center">
                                                                    <div class="flex-shrink-0 h-10 w-10">
                                                                        <img class="h-3xl w-24 rounded-full" src="{{ empty($user->profile_photo_path) ? Storage::url('images.png') : Storage::url($user->profile_photo_path) }}" alt="{{__('portal.Profile Picture')}}">
                                                                        <!-- https://images.unsplash.com/photo-1584824486539-53bb4646bdbc?&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60 -->
                                                                    </div>
                                                                    <div class="ml-4">
                                                                        <div class="text-sm font-medium text-gray-900">
                                                                            {{ $user->name }}
                                                                        </div>
                                                                        <div class="text-sm text-gray-500">
                                                                            {{ $user->email }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>


                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{$user->created_at}}
                                                            </td>

                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                @if(empty($user->business_id))
                                                                    {{__('portal.NULL')}}
                                                                @else
                                                                    @if($user->business->business_name)
                                                                        {{$user->business->business_name}}
                                                                    @else
                                                                        {{__('portal.NULL')}}
                                                                    @endif
                                                                @endif

                                                            </td>

                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                @foreach($user->roles()->pluck('name') as $role)
                                                                    @if(auth()->user()->registration_type == 'Buyer')
                                                                        <span class="badge badge-info">{{ str_replace('Buyer','',$role) }}</span>
                                                                    @elseif(auth()->user()->registration_type == 'Supplier')
                                                                        <span class="badge badge-info">{{ str_replace('Supplier','',$role) }}</span>
                                                                    @else
                                                                        <span class="badge badge-info">{{ $role }}</span>
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                @if(!empty($user->getAllPermissions()))
                                                                    @foreach($user->getAllPermissions() as $v)
                                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100  text-green-800">
                                                                                {{$v->name }}
                                                                            </span>
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">

                                                                <a href="{{ route('users.show', $user->id) }}" class="text-indigo-600 inline-block hover:text-indigo-900" title="VIEW">
                                                                    <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="blue">
                                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                                    </svg>
                                                                </a>
                                                                <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 inline-block hover:text-indigo-900" title="EDIT">
                                                                    <svg width="18" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                                    </svg>
                                                                </a>
                                                                <form action="{{ route('users.destroy', $user->id) }}" method="post" class="inline-block">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="text-indigo-600 inline-block hover:text-indigo-900" title="DELETE" onsubmit="alert('Are you sure')">
                                                                        <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="red">
                                                                            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"/>
                                                                            <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"/>
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
                                    <strong class="mr-1">{{__('portal.No users yet..!')}}</strong>
                                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                        </div>
                    </div>


                </div>

                {{--@if ($users->count() >= 50)
                    <div class="px-4 py-5 mt-3 bg-white sm:p-6 rounded-sm">
                        <div class="col-span-12 sm:col-span-12">
                            {{ $users->links() }}
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
