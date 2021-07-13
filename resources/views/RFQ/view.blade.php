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

        <div class="flex flex-wrap overflow-hidden lg:-mx-2 xl:-mx-1 ">

            <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 ">
                <span>Multiple Categories</span>
                <div class="md:flex flex-1 rounded-md bg-white">

                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3">
                        <div class="items-center text-center px-2 py-6  ">

                            <div class="mx-5">
                                <div class="text-gray-500">
                                    <a href="{{route('RFQ.create')}}"
                                       class="inline-flex items-center justify-center px-4 py-5 bg-blue-500 border
                                       border-transparent rounded-md font-semibold text-xs text-white uppercase
                                       tracking-widest hover:bg-red-500  focus:outline-none focus:border-blue-700
                                       focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                        Make New RFQ
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                        <div class="items-center text-center px-2 py-6 ">

                            <div class="mx-5">
                                <div class="text-gray-500">
                                    <a href="{{route('RFQCart.index')}}"
                                       class="inline-flex items-center justify-center px-4 py-3 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                    <span class="mx-3 ">
                                        RFQ Cart
                                        @if (\App\Models\ECart::where('business_id', auth()->user()->business_id)->count())
                                            ({{ \App\Models\ECart::where(['business_id' => auth()->user()->business_id, 'rfq_type' => 1])->count() }})
                                        @endif
                                    </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="items-center text-center px-2 py-6 ">

                            <div class="mx-5">
                                <div class="text-gray-500">
                                    <a href="{{route('PlacedRFQ.index')}}"
                                                              class="inline-flex items-center justify-center px-4 py-5 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                        RFQ History
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2">
                <span>Single Category</span>
                <div class="md:flex flex-1 rounded-md bg-white">

                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3">
                        <div class="items-center text-center px-2 py-6 ">

                            <div class="mx-5">
                                <div class="text-gray-500">
                                    <a href="{{route('create_single_rfq')}}" class="inline-flex items-center justify-center px-4 py-5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                        Make New RFQ
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                        <div class="items-center text-center px-2 py-6 ">

                            <div class="mx-5">
                                <div class="text-gray-500">
                                    <a href="{{route('single_cart_index')}}"
                                       class="inline-flex items-center justify-center px-4 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-500 focus:shadow-outline-red active:bg-blue-500 transition ease-in-out duration-150">
                                <span class="mx-3 ">RFQ Cart
                                    @if (\App\Models\ECart::where(['business_id' => auth()->user()->business_id, 'rfq_type' => 0])->count())
                                        ({{ \App\Models\ECart::where(['business_id' => auth()->user()->business_id , 'rfq_type' => 0])->count() }})
                                    @endif
                                </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="items-center text-center px-2 py-6 ">
                            <div class="mx-5">
                                <div class="text-gray-500">
                                    <a href="{{route('single_category_rfq_index')}}" class="inline-flex items-center justify-center px-4 py-5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-500 focus:shadow-outline-red active:bg-blue-500 transition ease-in-out duration-150">
                                        RFQ History
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>


</x-app-layout>
