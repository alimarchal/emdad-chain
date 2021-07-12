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
        <span>Multi Categories</span>
            <div class="flex flex-wrap -mx-6">

                <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                    <div class="items-center text-center px-5 py-6 shadow-sm rounded-md bg-white">

                        <div class="mx-5">
                            <div class="text-gray-500">
                                <a href="{{route('RFQ.create')}}" class="inline-flex items-center justify-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">Create RFQ</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div class="items-center text-center px-5 py-6 shadow-sm rounded-md bg-white">

                        <div class="mx-5">
                            <div class="text-gray-500">
                                <a href="{{route('RFQCart.index')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                    <span class="mx-3 ">
                                        RFQs Cart
                                        @if (\App\Models\ECart::where('business_id', auth()->user()->business_id)->count())
                                            ({{ \App\Models\ECart::where('business_id', auth()->user()->business_id)->count() }})
                                            ({{ \App\Models\ECart::where(['business_id' => auth()->user()->business_id, 'rfq_type' => 1])->count() }})
                                        @endif
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                    <div class="items-center text-center px-5 py-6 shadow-sm rounded-md bg-white">

                        <div class="mx-5">
                            <div class="text-gray-500"><a href="{{route('PlacedRFQ.index')}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">RFQ(s) History</a></div>
                        </div>
                    </div>
                </div>

            </div>
    </div>

    <div class="mt-4">
        <span>Single Category</span>
        <div class="flex flex-wrap -mx-6">

            <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                <div class="items-center text-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="mx-5">
                        <div class="text-gray-500">
                            <a href="{{route('create_single_rfq')}}" class="shadow bg-blue-500 px-4 py-2 text-white hover:bg-blue-700">Create RFQ</a></div>
                    </div>
                </div>
            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                <div class="items-center text-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="mx-5">
                        <div class="text-gray-500 text-center">
                            <a href="{{route('single_cart_index')}}" class="border-2 border-blue-500 px-4 py-2 text-blue-500 hover:text-white hover:bg-blue-500 rounded">
                                <span class="mx-3 ">RFQs Cart
                                    @if (\App\Models\ECart::where(['business_id' => auth()->user()->business_id, 'rfq_type' => 0])->count())
                                        ({{ \App\Models\ECart::where(['business_id' => auth()->user()->business_id , 'rfq_type' => 0])->count() }})
                                    @endif
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                <div class="items-center text-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="mx-5">
                        <div class="text-gray-500">
                            <a href="{{route('single_category_rfq_index')}}" class="shadow bg-purple-500 px-4 py-2 text-white hover:bg-red-700">RFQ(s) History</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
