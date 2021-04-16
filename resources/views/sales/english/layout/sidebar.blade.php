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
            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('sellerDashboard') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               href="{{ route('sellerDashboard') }}">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                </svg>
                <span class="mx-3">Dashboard</span>
            </a>
        </nav>
    </div>
{{--@endif--}}

