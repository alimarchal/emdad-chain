@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User List') }}
            </h2>
        </x-slot>
        @include('users.sessionMessage')
        @can('all')
            <div class="mt-5" style="text-align: center;">
                <a href="{{ route('business.index', ['status' => 1]) }} "
                   class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                    Pending
                </a>
                <a href="{{ route('business.index', ['status' => 3]) }} "
                   class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                    Approved
                </a>
                <a href="{{ route('business.index', ['status' => 4]) }}"
                   class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                    Rejected
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
                                    Name
                                </th>
                                @can('all')
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        Type
                                    </th>
                                @endcan
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                    Total Warehouse
                                </th>
                                {{--                                @can('all')--}}

                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                    Status
                                </th>
                                {{--                                @endcan--}}

                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                    P.O Info
                                </th>
                                @can('all')
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        Action
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
                                        <a href="{{ route('business.show', $business->id) }}" class="hover:text-red-700 hover:underline text-black  md:text-blue-600"> {{ $business->business_name }}
                                        </a>
                                    </td>
                                    @can('all')

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                            {{ $business->business_type }}
                                        </td>
                                    @endcan

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                        <a href="{{url('businessWarehouse/'. $business->id .'/show')}}" class="hover:underline text-blue-900 ">{{ $business->warehouse->count() }}</a>
                                    </td>
                                    {{--                                    @can('all')--}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                        @if ($business->status == '1')
                                            Pending
                                        @elseif($business->status == '3')
                                            Approved
                                        @elseif($business->status == '4')
                                            Rejected
                                        @endif
                                    </td>
                                    {{--                                    @endcan--}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                        @foreach ($business->poinfo as $Puinfo)
                                            <a href="{{ route('purchaseOrderInfo.show', $Puinfo->id) }}" class="inline-flex items-center
                                                 justify-center px-4 py-2 text-blue-700 hover:underline" name=" approved">
                                                PoInfo
                                            </a>
                                        @endforeach
                                    </td>
                                    @can('all')
                                        @if($business->status == 3)
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                <span class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">Accepted</span>
                                            </td>
                                        @elseif($business->status == 4)
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                <span class="bg-purple-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">Rejected</span>
                                            </td>
                                        @else
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                <a class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" href="{{route('accountStatus', ['business_id' => $business->id, 'status_id' => 3])}}"
                                                   style="transition: all .15s ease">
                                                    Accept
                                                </a>
                                                <a class="bg-purple-500 text-white active:bg-purple-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1"
                                                   href="{{route('accountStatus', ['business_id' => $business->id, 'status_id' => 4])}}" style="transition: all .15s ease">
                                                    Reject
                                                </a>
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User List') }}
            </h2>
        </x-slot>
        @include('users.sessionMessage')
        @can('all')
            <div class="mt-5" style="text-align: center;">
                <a href="{{ route('business.index', ['status' => 1]) }} " class="inline-flex items-center justify-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white
        uppercase tracking-widest hover:bg-pink-200 focus:outline-none focus:border-red-700
        focus:shadow-outline-red active:bg-pink-600 transition ease-in-out duration-150">
                    Pending
                </a>
                <a href="{{ route('business.index', ['status' => 3]) }} " class="inline-flex items-center
        justify-center px-4 py-2 bg-yellow-400 bg-opacity-75 border border-transparent rounded-md font-semibold
        text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none
        focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out
        duration-150">
                    Approved
                </a>
                <a href="{{ route('business.index', ['status' => 4]) }}" class="inline-flex items-center
         justify-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold
          text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none
          focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out
          duration-150">
                    Rejected
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
                                    الاسم
                                </th>
                                @can('all')
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        Type
                                    </th>
                                @endcan
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                    مجموع المستودعات
                                </th>
                                {{--                                @can('all')--}}

                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                    الحالة
                                </th>
                                {{--                                @endcan--}}

                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                    معلومات أمر الشراء
                                </th>
                                @can('all')
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        Action
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
                                        <a href="{{ route('business.show', $business->id) }}" class="text-white hover:text-red-700  md:text-blue-600" name="name"> {{ $business->business_name }}
                                        </a>
                                    </td>
                                    @can('all')

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                            {{ $business->business_type }}
                                        </td>
                                    @endcan

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">

                                        <a href="{{url('businessWarehouse/'. $business->id .'/show')}}" class="hover:underline text-blue-900 ">{{ $business->warehouse->count() }}</a>
                                    </td>
                                    {{--                                    @can('all')--}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                        @if ($business->status == '1')
                                            معلق
                                        @elseif($business->status == '3')
                                            مقبول
                                        @elseif($business->status == '4')
                                            مرفوض
                                        @endif
                                    </td>
                                    {{--                                    @endcan--}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                        @foreach ($business->poinfo as $Puinfo)
                                            <a href="{{ route('purchaseOrderInfo.show', $Puinfo->id) }}" class="inline-flex items-center
                                                 justify-center px-4 py-2 text-blue-700 hover:underline" name=" approved">
                                                PoInfo
                                            </a>
                                        @endforeach
                                    </td>
                                    @can('all')
                                        @if($business->status == 3)
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                <span class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">Accpected</span>
                                            </td>
                                        @elseif($business->status == 4)
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                <span class="bg-purple-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">Rejected</span>
                                            </td>
                                        @else
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                <a class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" href="{{route('accountStatus', ['business_id' => $business->id, 'status_id' => 3])}}"
                                                   style="transition: all .15s ease">
                                                    Accept
                                                </a>
                                                <a class="bg-purple-500 text-white active:bg-purple-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1"
                                                   href="{{route('accountStatus', ['business_id' => $business->id, 'status_id' => 4])}}" style="transition: all .15s ease">
                                                    Reject
                                                </a>
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
