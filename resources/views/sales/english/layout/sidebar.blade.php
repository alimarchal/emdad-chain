@section('headerScripts')
@endsection

{{--@if (auth()->user()->rtl == 0)--}}
    <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
         class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
        <div class="flex items-center justify-center mt-8">
            <div class="flex items-center">
                <a href="{{ route('sellerDashboard') }}">
                    <img src="{{ url('logo.png') }}" alt="EMDAD CHAIN LOGO" class="block h-9 w-auto"/>
                </a>
                <a href="{{ route('sellerDashboard') }}">
                <span class="text-white text-2xl mx-2 font-semibold">
                    Seller
                </span>
                </a>
            </div>
        </div>

        <nav class="mt-10">

            {{-- Dashboard --}}
            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('sellerDashboard') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               href="{{ route('sellerDashboard') }}">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                </svg>
                <span class="mx-3">Dashboard</span>
            </a>

            {{-- References --}}
            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('sellerReference') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               href="{{ route('sellerReference') }}">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z" clip-rule="evenodd"></path>
                </svg>
                <span class="mx-3">References</span>
            </a>

            {{-- Payments --}}
            <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('sellerPayment') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('sellerPayment') }}">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M6.625 2.655A9 9 0 0119 11a1 1 0 11-2 0 7 7 0 00-9.625-6.492 1 1 0 11-.75-1.853zM4.662 4.959A1 1 0 014.75 6.37 6.97 6.97 0 003 11a1 1 0 11-2 0 8.97 8.97 0 012.25-5.953 1 1 0 011.412-.088z" clip-rule="evenodd"></path>
                    <path fill-rule="evenodd" d="M5 11a5 5 0 1110 0 1 1 0 11-2 0 3 3 0 10-6 0c0 1.677-.345 3.276-.968 4.729a1 1 0 11-1.838-.789A9.964 9.964 0 005 11zm8.921 2.012a1 1 0 01.831 1.145 19.86 19.86 0 01-.545 2.436 1 1 0 11-1.92-.558c.207-.713.371-1.445.49-2.192a1 1 0 011.144-.83z"
                          clip-rule="evenodd"></path>
                    <path fill-rule="evenodd" d="M10 10a1 1 0 011 1c0 2.236-.46 4.368-1.29 6.304a1 1 0 01-1.838-.789A13.952 13.952 0 009 11a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
                <span class="mx-3">Payments</span>
            </a>
        </nav>
    </div>
{{--@endif--}}

