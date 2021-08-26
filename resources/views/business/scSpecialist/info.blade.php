@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>
        @include('users.sessionMessage')

        <div class="mt-5" style="text-align: center;">
            <a href="{{ route('business.index', ['status' => 3]) }} " class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
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
                                @if(isset($status) && $status == 1) {{__('portal.List of Pending Businesses')}} @else {{__('portal.List of Complete Businesses')}} @endif
                            </span>
                            </div>
                            <br>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr class="bg-green-500 text-center text-black font-bold">
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            #
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                            {{__('portal.Name')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.Type')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.Total Warehouse')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.Status')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.P.O. Info')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($businesses as $business)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                <a href="{{ route('business.show', $business->id) }}" class="hover:text-red-700 hover:underline text-black  md:text-blue-600">@if(isset($business->business_name)) {{ $business->business_name }} @else
                                                        {{$business->name}} <br> {{$business->email}} @endif
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
{{--                                                <span>{{(isset($business->user->registration_type) ? $business->user->registration_type : __('portal.N/A'))}}</span>--}}
                                                <span>
                                                    @if(isset($business->user->registration_type))
                                                        @if($business->user->registration_type == 'Buyer') {{__('portal.Buyer')}}
                                                        @elseif($business->user->registration_type == 'Supplier') {{__('portal.Supplier')}}
                                                        @else {{$business->user->registration_type}}
                                                        @endif
                                                    @endif
                                                </span>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                <a href="{{url('businessWarehouse/'. $business->id .'/show')}}" class="hover:underline text-blue-900 ">@if(isset($business->warehouse)) {{ $business->warehouse->count() }} @endif</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                                @if ($business->status == '3')
                                                    {{__('portal.Completed')}}
                                                @else
                                                    {{__('portal.Incomplete')}}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                @if(isset($business->poinfo))
                                                    @foreach ($business->poinfo as $Puinfo)
                                                        <a href="{{ route('purchaseOrderInfo.show', $Puinfo->id) }}" class="inline-flex items-center
                                                         justify-center px-4 py-2 text-blue-700 hover:underline" name=" approved">
                                                            {{__('portal.PoInfo')}}
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </td>
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
                                        {{__('portal.Mobile')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Registered Date')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Registered duration')}}
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900">
                                            <span class="text-blue-900 ">{{ $user->mobile }}</span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900">
                                            <span class="text-blue-900 ">{{ $user->created_at }}</span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900">
                                            <span class="text-blue-900 ">{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</span>
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
            <a href="{{ route('business.index', ['status' => 3]) }} " class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
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
                                @if(isset($status) && $status == 1) {{__('portal.List of Pending Businesses')}} @else {{__('portal.List of Complete Businesses')}} @endif
                            </span>
                            </div>
                            <br>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr class="bg-green-500 text-center text-black font-bold">
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            #
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                            {{__('portal.Name')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.Type')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.Total Warehouse')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.Status')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                            {{__('portal.P.O. Info')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($businesses as $business)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                <a href="{{ route('business.show', $business->id) }}" class="hover:text-red-700 hover:underline text-black  md:text-blue-600">@if(isset($business->business_name)) {{ $business->business_name }} @else
                                                        {{$business->name}} <br> {{$business->email}} @endif
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                <span>
                                                    @if(isset($business->user->registration_type))
                                                        @if($business->user->registration_type == 'Buyer') {{__('portal.Buyer')}}
                                                        @elseif($business->user->registration_type == 'Supplier') {{__('portal.Supplier')}}
                                                        @else {{$business->user->registration_type}}
                                                        @endif
                                                    @endif
                                                </span>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                <a href="{{url('businessWarehouse/'. $business->id .'/show')}}" class="hover:underline text-blue-900 ">@if(isset($business->warehouse)) {{ $business->warehouse->count() }} @endif</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                                @if ($business->status == '3')
                                                    {{__('portal.Completed')}}
                                                @else
                                                    {{__('portal.Incomplete')}}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                                @if(isset($business->poinfo))
                                                    @foreach ($business->poinfo as $Puinfo)
                                                        <a href="{{ route('purchaseOrderInfo.show', $Puinfo->id) }}" class="inline-flex items-center
                                                         justify-center px-4 py-2 text-blue-700 hover:underline" name=" approved">
                                                            {{__('portal.PoInfo')}}
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </td>
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
                                        {{__('portal.Mobile')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Registered Date')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Registered duration')}}
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900">
                                            <span class="text-blue-900 ">{{ $user->mobile }}</span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900">
                                            <span class="text-blue-900 ">{{ $user->created_at }}</span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900">
                                            <span class="text-blue-900 ">{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</span>
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
