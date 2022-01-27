@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>
        @include('users.sessionMessage')

        <div class="mt-5" style="text-align: center;">
            <a href="{{ route('business.index', ['status' => 3]) }} " style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none active:bg-red-600 transition ease-in-out duration-150">
                {{__('portal.Complete Businesses')}}
            </a>
            <a href="{{ route('business.index', ['status' => 1]) }} " class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                {{__('portal.Pending Businesses')}}
            </a>
            <a href="{{ route('business.index', ['status' => 2]) }} " class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                {{__('portal.Incomplete Businesses')}}
            </a>
        </div>

        @if(isset($businesses))
            <div class="flex flex-col mt-2">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                            <div class="mt-5" style="text-align: center;">
                            <span class="inline-flex items-center justify-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:border-red-700 transition ease-in-out duration-150">
                                @if(isset($status) && $status == 1) {{__('portal.List of Pending Businesses - Statuses')}} @else {{__('portal.List of Complete Businesses')}} @endif
                            </span>
                            </div>
                            <br>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr class="bg-green-500 text-center text-black font-bold">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        {{__('portal.Name')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        {{__('portal.W.H.')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        {{__('portal.business')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        {{__('portal.P.O. Info')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        {{__('portal.Legal')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        {{__('portal.Finance')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        {{__('portal.SC')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                        {{__('portal.Action')}}
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($businesses as $business)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                            <a href="{{ route('business-show', $business->id) }}" class="hover:text-red-700 hover:underline text-black  md:text-blue-600">@if(isset($business->business_name)) {{ $business->business_name }} @else
                                                    {{$business->name}} <br> {{$business->email}} @endif
                                            </a>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                            <a href="{{route('businessWarehouse', $business->id)}}" class="hover:underline text-blue-900 ">@if(isset($business->warehouse)) {{ $business->warehouse->count() }} @endif</a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                            @if ($business->status == 3)
                                                {{__('portal.Completed')}}
                                            @else
                                                {{__('portal.Incomplete')}}
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                            @if(isset($business->poinfo))
                                                @foreach ($business->poinfo as $poInfo)
                                                    <a href="{{ route('purchaseOrderInfo.show', $poInfo->id) }}" class="inline-flex items-center
                                                     justify-center px-4 py-2 text-blue-700 hover:underline" name=" approved">
                                                        {{__('portal.PoInfo')}}
                                                    </a>
                                                @endforeach
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                            @if ($business->legal_status == 1)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100  text-yellow-800">{{__('portal.Pending')}}</span>
                                            @elseif ($business->legal_status == 3)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100  text-green-800">{{__('portal.Approved')}}</span>
                                            @elseif ($business->legal_status == 4)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100  text-red-800">{{__('portal.Rejected')}}</span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                            @if ($business->finance_status == 1)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100  text-yellow-800">{{__('portal.Pending')}}</span>
                                            @elseif ($business->finance_status == 3)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100  text-green-800">{{__('portal.Approved')}}</span>
                                            @elseif ($business->finance_status == 4)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100  text-red-800">{{__('portal.Rejected')}}</span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                            @if ($business->sc_supervisor_status == 1)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100  text-yellow-800">{{__('portal.Pending')}}</span>
                                            @elseif ($business->sc_supervisor_status == 3)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100  text-green-800">{{__('portal.Approved')}}</span>
                                            @elseif ($business->sc_supervisor_status == 4)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100  text-red-800">{{__('portal.Rejected')}}</span>
                                            @endif
                                        </td>

                                        @if($business->status == 3)
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                <span class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">
                                                    {{__('portal.Accepted')}}
                                                </span>
                                            </td>
                                        @elseif($business->status == 4)
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                <span class="bg-purple-500 text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">
                                                    {{__('portal.Rejected')}}
                                                </span>
                                            </td>
                                        @else
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                <a class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1"
                                                   href="{{route('accountStatus', ['business_id' => $business->id, 'status_id' => 3])}}" style="transition: all .15s ease"> {{__('portal.Accept')}}
                                                </a>
                                                <br>
                                                <br>
                                                <a class="bg-purple-500 text-white active:bg-purple-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1"
                                                   href="{{route('accountStatus', ['business_id' => $business->id, 'status_id' => 4])}}" style="transition: all .15s ease"> {{__('portal.Reject')}}
                                                </a>
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                            <span class="pl-4">{{ $businesses->withQueryString()->links() }}</span>
                        </div>
                    </div>

                </div>

            </div>
        @elseif(isset($users))
            <div class="flex flex-col mt-2">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                            <div class="mt-5" style="text-align: center;">
                                <span class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:border-red-700 transition ease-in-out duration-150">
                                    {{__('portal.List of Incomplete')}}
                                </span>
                                <span class="inline-flex items-center justify-center px-4 py-2 bg-purple-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:border-red-700 transition ease-in-out duration-150">
                                     {{__('portal.CEO accounts')}}
                                </span>
                            </div>
                            <br>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr class="bg-green-500 text-center text-black font-bold">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Name')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Email')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Email Verified')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Mobile')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Registered Date')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Registered duration')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('B. Type')}}
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                            <span class="text-black  md:text-blue-600">{{ $user->name }}</span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                            <span class="text-blue-900 ">{{ $user->email }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                            <span class="text-blue-900 "> @if($user->email_verified_at) {{ $user->email_verified_at }} @else {{__('portal.No')}} @endif </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900">
                                            <span class="text-blue-900 ">{{ $user->mobile }}</span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900">
                                            <span class="text-blue-900 ">{{ $user->created_at }}</span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900">
                                            <span class="text-blue-900 ">{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900">
                                            <span class="text-blue-900 ">
                                            @if(empty($user->registration_type))
                                                    {{__('portal.N/A')}}
                                            @else
                                                @if($user->registration_type == 'Buyer') {{__('portal.Buyer')}} @endif
                                                @if($user->registration_type == 'Supplier') {{__('portal.Supplier')}} @endif
                                            @endif
                                            </span>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                            <span class="pl-4">{{ $users->withQueryString()->links() }}</span>
                        </div>
                    </div>

                </div>

            </div>
        @else
            {{__('portal.No record found...!')}}
        @endif
    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>
        @include('users.sessionMessage')

        <div class="mt-5" style="text-align: center;">
            <a href="{{ route('business.index', ['status' => 3]) }} " style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none active:bg-red-600 transition ease-in-out duration-150">
                {{__('portal.Complete Businesses')}}
            </a>
            <a href="{{ route('business.index', ['status' => 1]) }} " class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                {{__('portal.Pending Businesses')}}
            </a>
            <a href="{{ route('business.index', ['status' => 2]) }} " class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                {{__('portal.Incomplete Businesses')}}
            </a>
        </div>

        @if(isset($businesses))
            <div class="flex flex-col mt-2">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                            <div class="mt-5" style="text-align: center;">
                            <span class="inline-flex items-center justify-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:border-red-700 transition ease-in-out duration-150">
                                @if(isset($status) && $status == 1) {{__('portal.List of Pending Businesses - Statuses')}} @else {{__('portal.List of Complete Businesses')}} @endif
                            </span>
                            </div>
                            <br>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr class="bg-green-500 text-center text-black font-bold">
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            #
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.Name')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.W.H.')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.business')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.P.O. Info')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.Legal')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.Finance')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.SC')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.Action')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($businesses as $business)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                <a href="{{ route('business-show', $business->id) }}" class="hover:text-red-700 hover:underline text-black  md:text-blue-600">@if(isset($business->business_name)) {{ $business->business_name }} @else
                                                        {{$business->name}} <br> {{$business->email}} @endif
                                                </a>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                <a href="{{route('businessWarehouse', $business->id)}}" class="hover:underline text-blue-900 ">@if(isset($business->warehouse)) {{ $business->warehouse->count() }} @endif</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                                @if ($business->status == 3)
                                                    {{__('portal.Completed')}}
                                                @else
                                                    {{__('portal.Incomplete')}}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                @if(isset($business->poinfo))
                                                    @foreach ($business->poinfo as $poInfo)
                                                        <a href="{{ route('purchaseOrderInfo.show', $poInfo->id) }}" class="inline-flex items-center
                                                         justify-center px-4 py-2 text-blue-700 hover:underline" name=" approved">
                                                            {{__('portal.PoInfo')}}
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                                @if ($business->legal_status == 1)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100  text-yellow-800">{{__('portal.Pending')}}</span>
                                                @elseif ($business->legal_status == 3)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100  text-green-800">{{__('portal.Approved')}}</span>
                                                @elseif ($business->legal_status == 4)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100  text-red-800">{{__('portal.Rejected')}}</span>
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                                @if ($business->finance_status == 1)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100  text-yellow-800">{{__('portal.Pending')}}</span>
                                                @elseif ($business->finance_status == 3)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100  text-green-800">{{__('portal.Approved')}}</span>
                                                @elseif ($business->finance_status == 4)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100  text-red-800">{{__('portal.Rejected')}}</span>
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                                @if ($business->sc_supervisor_status == 1)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100  text-yellow-800">{{__('portal.Pending')}}</span>
                                                @elseif ($business->sc_supervisor_status == 3)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100  text-green-800">{{__('portal.Approved')}}</span>
                                                @elseif ($business->sc_supervisor_status == 4)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100  text-red-800">{{__('portal.Rejected')}}</span>
                                                @endif
                                            </td>

                                            @if($business->status == 3)
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                    <span class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">
                                                        {{__('portal.Accepted')}}
                                                    </span>
                                                </td>
                                            @elseif($business->status == 4)
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                    <span class="bg-purple-500 text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">
                                                        {{__('portal.Rejected')}}
                                                    </span>
                                                </td>
                                            @else
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                    <a class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md hover:text-white outline-none focus:outline-none mr-1 mb-1"
                                                       href="{{route('accountStatus', ['business_id' => $business->id, 'status_id' => 3])}}" style="transition: all .15s ease"> {{__('portal.Accept')}}
                                                    </a>
                                                    <br>
                                                    <br>
                                                    <a class="bg-purple-500 text-white active:bg-purple-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md hover:text-white outline-none focus:outline-none mr-1 mb-1"
                                                       href="{{route('accountStatus', ['business_id' => $business->id, 'status_id' => 4])}}" style="transition: all .15s ease"> {{__('portal.Reject')}}
                                                    </a>
                                                </td>
                                            @endif

                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <span class="pl-4">{{ $businesses->withQueryString()->links() }}</span>
                        </div>
                    </div>

                </div>

            </div>
        @elseif(isset($users))
            <div class="flex flex-col mt-2">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                            <div class="mt-5" style="text-align: center;">
                                <span class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:border-red-700 transition ease-in-out duration-150">
                                    {{__('portal.List of Incomplete')}}
                                </span>
                                <span class="inline-flex items-center justify-center px-4 py-2 bg-purple-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:border-red-700 transition ease-in-out duration-150">
                                     {{__('portal.CEO accounts')}}
                                </span>
                            </div>
                            <br>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr class="bg-green-500 text-center text-black font-bold">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Name')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Email')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Email Verified')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Mobile')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Registered Date')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Registered duration')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.B.Type')}}
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                            <span class="text-black  md:text-blue-600">{{ $user->name }}</span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                            <span class="text-blue-900 ">{{ $user->email }}</span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                            <span class="text-blue-900 "> @if($user->email_verified_at) {{ $user->email_verified_at }} @else {{__('portal.No')}} @endif </span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900">
                                            <span class="text-blue-900 ">{{ $user->mobile }}</span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900">
                                            <span class="text-blue-900 ">{{ $user->created_at }}</span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900">
                                            <span class="text-blue-900 ">{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900">
                                            <span class="text-blue-900 ">
                                            @if(empty($user->registration_type))
                                                    {{__('portal.N/A')}}
                                                @else
                                                    @if($user->registration_type == 'Buyer') {{__('portal.Buyer')}} @endif
                                                    @if($user->registration_type == 'Supplier') {{__('portal.Supplier')}} @endif
                                                @endif
                                            </span>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                            <span class="pl-4">{{ $users->withQueryString()->links() }}</span>
                        </div>
                    </div>

                </div>

            </div>
        @else
            {{__('portal.No record found...!')}}
        @endif
    </x-app-layout>
@endif
