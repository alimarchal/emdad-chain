@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>
        @include('users.sessionMessage')
        @can('all')
            <div class="mt-5" style="text-align: center;">
                <a href="{{ route('business.index', ['status' => 1]) }} " style="background-color: #145EA8"
                   class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none active:bg-red-600 transition ease-in-out duration-150">
                    {{__('portal.Pending')}}
                </a>
                <a href="{{ route('business.index', ['status' => 3]) }} "
                   class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                    {{__('portal.Approved')}}
                </a>
                <a href="{{ route('business.index', ['status' => 4]) }}"
                   class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                    {{__('portal.Rejected')}}
                </a>
            </div>
        @endcan

        <div class="flex flex-col mt-2">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr class="bg-green-500 text-center text-black font-bold">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        {{__('portal.Name')}}
                                    </th>
                                    @can('all')
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.Type')}}
                                        </th>
                                    @endcan
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        {{__('portal.Total Warehouse')}}
                                    </th>
                                    {{--                                @can('all')--}}

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        {{__('portal.Status')}}
                                    </th>
                                    {{--                                @endcan--}}

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        {{__('portal.P.O. Info')}}
                                    </th>
                                    @can('all')
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.Action')}}
                                        </th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($businesses as $business)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                            <a href="{{ route('business-show', $business->id) }}" class="hover:text-red-700 hover:underline text-black  md:text-blue-600"> {{ $business->business_name }}
                                            </a>
                                        </td>
                                        @can('all')

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                @if($business->business_type == 'Buyer') {{__('portal.Buyer')}} @elseif($business->business_type == 'Supplier') {{__('portal.Supplier')}} @endif
                                            </td>
                                        @endcan

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                            <a href="{{route('businessWarehouse', $business->id)}}" class="hover:underline text-blue-900 ">{{ $business->warehouse->count() }}</a>
                                        </td>
                                        {{--                                    @can('all')--}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            @if ($business->status == '1')
                                                <span class="text-yellow-400"> {{__('portal.Pending')}} </span>
                                            @elseif($business->status == '3' && $business->is_active == 1)
                                                <span class="text-green-600"> {{__('portal.Approved')}} </span>
                                            @elseif($business->status == '3' && $business->is_active == 0)
                                                <span class="text-yellow-400"> {{__('portal.Pending')}} </span>
                                            @elseif($business->status == '4')
                                                <span class="text-red-500"> {{__('portal.Rejected')}} </span>
                                            @endif
                                        </td>
                                        {{--                                    @endcan--}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                            @foreach ($business->poinfo as $poInfo)
                                                <a href="{{ route('purchaseOrderInfo.show', $poInfo->id) }}" class="inline-flex items-center
                                                     justify-center px-4 py-2 text-blue-700 hover:underline" name=" approved">
                                                    {{__('portal.PoInfo')}}
                                                </a>
                                            @endforeach
                                        </td>
                                        @can('all')
                                            {{-- is_active is updated in POInfoController(Store) when user submits details for approval i.e complete his registration --}}
                                            @if($business->status == 1 && $business->user->is_active == null)
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                <a class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" href="{{route('accountStatus', ['business_id' => $business->id, 'status_id' => 3])}}"
                                                   style="transition: all .15s ease">
                                                    {{__('portal.Accept')}}
                                                </a>
                                                <a class="bg-purple-500 text-white active:bg-purple-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1"
                                                   href="{{route('accountStatus', ['business_id' => $business->id, 'status_id' => 4])}}" style="transition: all .15s ease">
                                                    {{__('portal.Reject')}}
                                                </a>
                                            </td>
                                            @elseif($business->status == 3)
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                    <span class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">{{__('portal.Accepted')}}</span>
                                                </td>
                                            @elseif($business->status == 4)
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                    <span class="bg-purple-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">{{__('portal.Rejected')}}</span>
                                                </td>
                                            @endif
                                        @endcan

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <span class="pl-4">{{ $businesses->withQueryString()->links() }}</span>
                    </div>
                </div>

            </div>

        </div>

    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>
        @include('users.sessionMessage')
        @can('all')
            <div class="mt-5" style="text-align: center;">
                <a href="{{ route('business.index', ['status' => 1]) }} " style="background-color: #145EA8"
                   class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none active:bg-red-600 transition ease-in-out duration-150">
                    {{__('portal.Pending')}}
                </a>
                <a href="{{ route('business.index', ['status' => 3]) }} "
                   class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                    {{__('portal.Approved')}}
                </a>
                <a href="{{ route('business.index', ['status' => 4]) }}"
                   class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                    {{__('portal.Rejected')}}
                </a>
            </div>
        @endcan

        <div class="flex flex-col mt-2">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr class="bg-green-500 text-center text-black font-bold">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        {{__('portal.Name')}}
                                    </th>
                                    @can('all')
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.Type')}}
                                        </th>
                                    @endcan
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        {{__('portal.Total Warehouse')}}
                                    </th>
                                    {{--                                @can('all')--}}

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        {{__('portal.Status')}}
                                    </th>
                                    {{--                                @endcan--}}

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        {{__('portal.P.O. Info')}}
                                    </th>
                                    @can('all')
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.Action')}}
                                        </th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($businesses as $business)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                            <a href="{{ route('business-show', $business->id) }}" class="hover:text-red-700 hover:underline hover:text-white text-black  md:text-blue-600"> {{ $business->business_name }} </a>
                                        </td>
                                        @can('all')

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                @if($business->business_type == 'Buyer') {{__('portal.Buyer')}} @elseif($business->business_type == 'Supplier') {{__('portal.Supplier')}} @endif
                                            </td>
                                        @endcan

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                            <a href="{{route('businessWarehouse', $business->id)}}" class="hover:underline hover:text-white text-blue-900 ">{{ $business->warehouse->count() }}</a>
                                        </td>
                                        {{--                                    @can('all')--}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                            @if ($business->status == '1')
                                                <span class="text-yellow-400"> {{__('portal.Pending')}} </span>
                                            @elseif($business->status == '3' && $business->is_active == 1)
                                                <span class="text-green-600"> {{__('portal.Approved')}} </span>
                                            @elseif($business->status == '3' && $business->is_active == 0)
                                                <span class="text-yellow-400"> {{__('portal.Pending')}} </span>
                                            @elseif($business->status == '4')
                                                <span class="text-red-500"> {{__('portal.Rejected')}} </span>
                                            @endif
                                        </td>
                                        {{--                                    @endcan--}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                            @foreach ($business->poinfo as $poInfo)
                                                <a href="{{ route('purchaseOrderInfo.show', $poInfo->id) }}" class="inline-flex items-center
                                                         justify-center px-4 py-2 text-blue-700 hover:underline" name=" approved">
                                                    {{__('portal.PoInfo')}}
                                                </a>
                                            @endforeach
                                        </td>
                                        @can('all')
                                            {{-- is_active is updated in POInfoController(Store) when user submits details for approval i.e complete his registration --}}
                                            @if($business->status == 1 && $business->user->is_active == null)
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                    <a class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" href="{{route('accountStatus', ['business_id' => $business->id, 'status_id' => 3])}}"
                                                       style="transition: all .15s ease">
                                                        {{__('portal.Accept')}}
                                                    </a>
                                                    <a class="bg-purple-500 text-white active:bg-purple-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1"
                                                       href="{{route('accountStatus', ['business_id' => $business->id, 'status_id' => 4])}}" style="transition: all .15s ease">
                                                        {{__('portal.Reject')}}
                                                    </a>
                                                </td>
                                            @elseif($business->status == 3)
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                    <span class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">{{__('portal.Accepted')}}</span>
                                                </td>
                                            @elseif($business->status == 4)
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                    <span class="bg-purple-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">{{__('portal.Rejected')}}</span>
                                                </td>
                                            @endif
                                        @endcan

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <span class="pl-4">{{ $businesses->withQueryString()->links() }}</span>
                    </div>
                </div>

            </div>

        </div>

    </x-app-layout>
@endif
