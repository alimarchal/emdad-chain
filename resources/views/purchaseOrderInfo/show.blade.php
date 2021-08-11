@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Business Information') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6">
                        <h1 class="text-center text-3xl font-bold p-4 border-t-2 bg-opacity-5 border-black border-2"> {{__('portal.Purchase Order Information of')}} {{$business->business_name}}</h1>
                        <div class="md:inline-flex space-y-4 md:space-y-0 w-full p-4 text-gray-500 items-center border-2 border-t-0 border-cool-gray-700">
                            <div class="flex flex-wrap overflow-hidden">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3  h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Business Name')}}:</strong> {{$business->business_name}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Total No of Monthly Order')}}:</strong> {{$purchaseOrderInfo->no_of_monthly_orders}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Volume')}}:</strong> {{$purchaseOrderInfo->volume}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Type')}}:</strong> {{$purchaseOrderInfo->type}}</p>
                                </div>

                                <div class="w-full  lg:w-1/3 xl:w-1/2 h-auto text-lg text-black">
                                    <p><strong>{{__('portal.Orders Information Pictures')}}:</strong></p>
                                    <ol class="list-decimal">
                                        @php $exp = explode(', ', $purchaseOrderInfo->order_info); @endphp
                                        @if($purchaseOrderInfo->order_info != null)
                                            @foreach($exp as $ex)
                                                <li><a href="{{asset('storage/'.$ex)}}" class="hover:text-blue-900 hover:underline text-blue-900">{{__('portal.Image')}}#{{$loop->iteration}} ({{__('portal.Click to show')}})</a></li>
                                            @endforeach
                                        @else
                                            {{__('portal.N/A')}}
                                        @endif
                                    </ol>
                                </div>

                                <div class="w-full overflow-hidden">

                                    <a href="#" onclick="window.print();" class="mr-3 float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                        {{__('portal.Print')}}
                                    </a>

                                    <a href="{{url()->previous()}}" class="mr-3 float-right inline-flex items-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                        {{__('portal.Back')}}
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>


        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Business Information') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6">
                        <h1 class="text-center text-3xl font-bold p-4 border-t-2 bg-opacity-5 border-black border-2"> {{__('portal.Purchase Order Information of')}} {{$business->business_name}}</h1>
                        <div class="md:inline-flex space-y-4 md:space-y-0 w-full p-4 text-gray-500 items-center border-2 border-t-0 border-cool-gray-700">
                            <div class="flex flex-wrap overflow-hidden">
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3  h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Business Name')}}:</strong> {{$business->business_name}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Total No of Monthly Order')}}:</strong> {{$purchaseOrderInfo->no_of_monthly_orders}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Volume')}}:</strong> {{$purchaseOrderInfo->volume}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Type')}}:</strong> @if($purchaseOrderInfo->type == 'Credit') {{__('portal.Credit')}} @elseif($purchaseOrderInfo->type == 'Cash') {{__('portal.Cash')}} @endif </p>
                                </div>

                                <div class="w-full  lg:w-1/3 xl:w-1/2 h-auto text-lg text-black">
                                    <p><strong>{{__('portal.Orders Information Pictures')}}:</strong></p>
                                    <ol class="list-decimal">
                                        @php $exp = explode(', ', $purchaseOrderInfo->order_info); @endphp
                                        @if($purchaseOrderInfo->order_info != null)
                                            @foreach($exp as $ex)
                                                <li><a href="{{asset('storage/'.$ex)}}" class="hover:text-blue-900 hover:underline text-blue-900">{{__('portal.Image')}}#{{$loop->iteration}} ({{__('portal.Click to show')}})</a></li>
                                            @endforeach
                                        @else
                                            {{__('portal.N/A')}}
                                        @endif
                                    </ol>
                                </div>

                                <div class="w-full overflow-hidden">

                                    <a href="#" onclick="window.print();" class="mr-3 float-left inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 hover:text-white active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                        {{__('portal.Print')}}
                                    </a>

                                    <a href="{{url()->previous()}}" class="mr-3 float-left inline-flex items-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 hover:text-white active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                        {{__('portal.Back')}}
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>


        </div>
    </x-app-layout>
@endif
