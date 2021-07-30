@if (auth()->user()->rtl == 0)
    <x-app-layout>
        @if (session()->has('error'))
            <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" style="margin-top: 10px;" role="alert">
                <strong class="mr-1">{{ session('error') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>

        @elseif (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" style="margin-top: 10px;" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif

        <div class="mt-4">

            <span>{{__('portal.Ratings')}}</span>
            <div class="md:flex flex-1 rounded-md bg-white">

                <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3">
                    <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                        <div class="mx-5">
                            <div class="text-gray-500" >
                                <a href="{{route('buyerDeliveryRatingListIndex')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border
                                               border-transparent rounded-md font-semibold text-xs text-white uppercase
                                               tracking-widest hover:bg-red-500  focus:outline-none focus:border-blue-700
                                               focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                    {{__('portal.All Deliveries')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                        <div class="mx-5">
                            <div class="text-gray-500" >
                                <a href="{{route('buyerRatedToDeliveries')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border
                                               border-transparent rounded-md font-semibold text-xs text-white uppercase
                                               tracking-widest hover:bg-red-500  focus:outline-none focus:border-blue-700
                                               focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                    {{__('portal.My Rated Deliveries')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                        <div class="mx-5">
                            <div class="text-gray-500" >
                                <a href="{{route('buyerUnRatedDeliveries')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border
                                               border-transparent rounded-md font-semibold text-xs text-white uppercase
                                               tracking-widest hover:bg-red-500  focus:outline-none focus:border-blue-700
                                               focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                    {{__('portal.My Un-Rated Deliveries')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                        <div class="mx-5">
                            <div class="text-gray-500">
                                <a href="{{route('deliveriesListToRate')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border
                                               border-transparent rounded-md font-semibold text-xs text-white uppercase
                                               tracking-widest hover:bg-red-500  focus:outline-none focus:border-blue-700
                                               focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                    {{__('portal.Rate Deliveries')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{--<div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                        <div class="mx-5">
                            <div class="text-gray-500">
                                <a href="{{route('supplierRated')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                    Suppliers' rating
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                        <div class="mx-5">
                            <div class="text-gray-500" >
                                <a href="{{route('buyerList')}}" class="inline-flex items-center justify-center px-4 py-4 bg-blue-600 border
                                               border-transparent rounded-md font-semibold text-xs text-white uppercase
                                               tracking-widest hover:bg-red-500  focus:outline-none focus:border-blue-700
                                               focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                    Rate Buyer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                        <div class="mx-5">
                            <div class="text-gray-500">
                                <a href="{{route('supplierList')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                    Rate Supplier
                                </a>
                            </div>
                        </div>
                    </div>
                </div>--}}

            </div>

        </div>

    </x-app-layout>
@else
    <x-app-layout>
        @if (session()->has('error'))
            <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" style="margin-top: 10px;" role="alert">
                <strong class="mr-1">{{ session('error') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>

        @elseif (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" style="margin-top: 10px;" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif

        <div class="mt-4">

            <span>{{__('portal.Ratings')}}</span>
            <div class="md:flex flex-1 rounded-md bg-white">

                <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3">
                    <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                        <div class="mx-5">
                            <div class="text-gray-500" >
                                <a href="{{route('buyerDeliveryRatingListIndex')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border
                                               border-transparent rounded-md font-semibold text-xs text-white uppercase
                                               tracking-widest hover:bg-red-500 hover:text-white  focus:outline-none transition ease-in-out duration-150">
                                    {{__('portal.All Deliveries')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                        <div class="mx-5">
                            <div class="text-gray-500" >
                                <a href="{{route('buyerRatedToDeliveries')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border
                                               border-transparent rounded-md font-semibold text-xs text-white uppercase
                                               tracking-widest hover:bg-red-500 hover:text-white  focus:outline-none transition ease-in-out duration-150">
                                    {{__('portal.My Rated Deliveries')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                        <div class="mx-5">
                            <div class="text-gray-500" >
                                <a href="{{route('buyerUnRatedDeliveries')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border
                                               border-transparent rounded-md font-semibold text-xs text-white uppercase
                                               tracking-widest hover:bg-red-500 hover:text-white  focus:outline-none transition ease-in-out duration-150">
                                    {{__('portal.My Un-Rated Deliveries')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                        <div class="mx-5">
                            <div class="text-gray-500">
                                <a href="{{route('deliveriesListToRate')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border
                                               border-transparent rounded-md font-semibold text-xs text-white uppercase
                                               tracking-widest hover:bg-red-500 hover:text-white  focus:outline-none transition ease-in-out duration-150">
                                    {{__('portal.Rate Deliveries')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{--<div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                        <div class="mx-5">
                            <div class="text-gray-500">
                                <a href="{{route('supplierRated')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                    Suppliers' rating
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                        <div class="mx-5">
                            <div class="text-gray-500" >
                                <a href="{{route('buyerList')}}" class="inline-flex items-center justify-center px-4 py-4 bg-blue-600 border
                                               border-transparent rounded-md font-semibold text-xs text-white uppercase
                                               tracking-widest hover:bg-red-500  focus:outline-none focus:border-blue-700
                                               focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                    Rate Buyer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                        <div class="mx-5">
                            <div class="text-gray-500">
                                <a href="{{route('supplierList')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                    Rate Supplier
                                </a>
                            </div>
                        </div>
                    </div>
                </div>--}}

            </div>

        </div>

    </x-app-layout>
@endif
