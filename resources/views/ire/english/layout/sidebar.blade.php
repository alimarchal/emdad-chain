@section('headerScripts')
@endsection

    <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
         class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
        <div class="flex items-center justify-center mt-8">
            <div class="flex items-center">
                <a href="{{ route('ireDashboard') }}">
                    <img src="{{ url('logo.png') }}" alt="EMDAD CHAIN LOGO" class="block h-9 w-auto"/>
                </a>
                <a href="{{ route('ireDashboard') }}">
                <span class="text-white text-2xl mx-2 font-semibold">
                    Virtual Office
                </span>
                </a>
            </div>
        </div>

        <nav class="mt-10">

            {{-- Dashboard --}}
            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('ireDashboard') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               href="{{ route('ireDashboard') }}">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                </svg>
                <span class="mx-3">Dashboard</span>
            </a>

            {{-- References --}}
            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('ireReference') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               href="{{ route('ireReference') }}">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.573,11.624c0.568-0.478,0.947-1.219,0.947-2.019c0-1.37-1.108-2.569-2.371-2.569s-2.371,1.2-2.371,2.569c0,0.8,0.379,1.542,0.946,2.019c-0.253,0.089-0.496,0.2-0.728,0.332c-0.743-0.898-1.745-1.573-2.891-1.911c0.877-0.61,1.486-1.666,1.486-2.812c0-1.79-1.479-3.359-3.162-3.359S4.269,5.443,4.269,7.233c0,1.146,0.608,2.202,1.486,2.812c-2.454,0.725-4.252,2.998-4.252,5.685c0,0.218,0.178,0.396,0.395,0.396h16.203c0.218,0,0.396-0.178,0.396-0.396C18.497,13.831,17.273,12.216,15.573,11.624 M12.568,9.605c0-0.822,0.689-1.779,1.581-1.779s1.58,0.957,1.58,1.779s-0.688,1.779-1.58,1.779S12.568,10.427,12.568,9.605 M5.06,7.233c0-1.213,1.014-2.569,2.371-2.569c1.358,0,2.371,1.355,2.371,2.569S8.789,9.802,7.431,9.802C6.073,9.802,5.06,8.447,5.06,7.233 M2.309,15.335c0.202-2.649,2.423-4.742,5.122-4.742s4.921,2.093,5.122,4.742H2.309z M13.346,15.335c-0.067-0.997-0.382-1.928-0.882-2.732c0.502-0.271,1.075-0.429,1.686-0.429c1.828,0,3.338,1.385,3.535,3.161H13.346z"></path>
                </svg>
                <span class="mx-3">References</span>
            </a>

            {{-- Incomplete References --}}
            <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('ireIncompleteReference') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('ireIncompleteReference') }}" title="Incomplete companies references ">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.344,16.174l-7.98-12.856c-0.172-0.288-0.586-0.288-0.758,0L1.627,16.217c0.339-0.543-0.603,0.668,0.384,0.682h15.991C18.893,16.891,18.167,15.961,18.344,16.174 M2.789,16.008l7.196-11.6l7.224,11.6H2.789z M10.455,7.552v3.561c0,0.244-0.199,0.445-0.443,0.445s-0.443-0.201-0.443-0.445V7.552c0-0.245,0.199-0.445,0.443-0.445S10.455,7.307,10.455,7.552M10.012,12.439c-0.733,0-1.33,0.6-1.33,1.336s0.597,1.336,1.33,1.336c0.734,0,1.33-0.6,1.33-1.336S10.746,12.439,10.012,12.439M10.012,14.221c-0.244,0-0.443-0.199-0.443-0.445c0-0.244,0.199-0.445,0.443-0.445s0.443,0.201,0.443,0.445C10.455,14.021,10.256,14.221,10.012,14.221"></path>
                </svg>
                <span class="mx-3">Incomplete references</span>
            </a>

            {{-- Payments --}}
            <div x-data="{ open: false } ">
                <a @click="open = true" class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('irePayment') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.319,8.257c-0.242,0-0.438,0.196-0.438,0.438c0,0.243,0.196,0.438,0.438,0.438c0.242,0,0.438-0.196,0.438-0.438C4.757,8.454,4.561,8.257,4.319,8.257 M7.599,10.396c0,0.08,0.017,0.148,0.05,0.204c0.034,0.056,0.076,0.104,0.129,0.144c0.051,0.04,0.112,0.072,0.182,0.097c0.041,0.015,0.068,0.028,0.098,0.04V9.918C7.925,9.927,7.832,9.958,7.747,10.02C7.648,10.095,7.599,10.22,7.599,10.396 M15.274,6.505H1.252c-0.484,0-0.876,0.392-0.876,0.876v7.887c0,0.484,0.392,0.876,0.876,0.876h14.022c0.483,0,0.876-0.392,0.876-0.876V7.381C16.15,6.897,15.758,6.505,15.274,6.505M1.69,7.381c0.242,0,0.438,0.196,0.438,0.438S1.932,8.257,1.69,8.257c-0.242,0-0.438-0.196-0.438-0.438S1.448,7.381,1.69,7.381M1.69,15.269c-0.242,0-0.438-0.196-0.438-0.438s0.196-0.438,0.438-0.438c0.242,0,0.438,0.195,0.438,0.438S1.932,15.269,1.69,15.269M14.836,15.269c-0.242,0-0.438-0.196-0.438-0.438s0.196-0.438,0.438-0.438s0.438,0.195,0.438,0.438S15.078,15.269,14.836,15.269M15.274,13.596c-0.138-0.049-0.283-0.08-0.438-0.08c-0.726,0-1.314,0.589-1.314,1.314c0,0.155,0.031,0.301,0.08,0.438H2.924c0.049-0.138,0.081-0.283,0.081-0.438c0-0.726-0.589-1.314-1.315-1.314c-0.155,0-0.3,0.031-0.438,0.08V9.053C1.39,9.103,1.535,9.134,1.69,9.134c0.726,0,1.315-0.588,1.315-1.314c0-0.155-0.032-0.301-0.081-0.438h10.678c-0.049,0.137-0.08,0.283-0.08,0.438c0,0.726,0.589,1.314,1.314,1.314c0.155,0,0.301-0.031,0.438-0.081V13.596z M14.836,8.257c-0.242,0-0.438-0.196-0.438-0.438s0.196-0.438,0.438-0.438s0.438,0.196,0.438,0.438S15.078,8.257,14.836,8.257 M12.207,13.516c-0.242,0-0.438,0.196-0.438,0.438s0.196,0.438,0.438,0.438s0.438-0.196,0.438-0.438S12.449,13.516,12.207,13.516 M8.812,11.746c-0.059-0.043-0.126-0.078-0.199-0.104c-0.047-0.017-0.081-0.031-0.117-0.047v1.12c0.137-0.021,0.237-0.064,0.336-0.143c0.116-0.09,0.174-0.235,0.174-0.435c0-0.092-0.018-0.17-0.053-0.233C8.918,11.842,8.87,11.788,8.812,11.746 M18.78,3.875H4.757c-0.484,0-0.876,0.392-0.876,0.876V5.19c0,0.242,0.196,0.438,0.438,0.438c0.242,0,0.438-0.196,0.438-0.438V4.752H18.78v7.888h-1.315c-0.242,0-0.438,0.196-0.438,0.438c0,0.243,0.195,0.438,0.438,0.438h1.315c0.483,0,0.876-0.393,0.876-0.876V4.752C19.656,4.268,19.264,3.875,18.78,3.875 M8.263,8.257c-1.694,0-3.067,1.374-3.067,3.067c0,1.695,1.373,3.068,3.067,3.068c1.695,0,3.067-1.373,3.067-3.068C11.33,9.631,9.958,8.257,8.263,8.257 M9.488,12.543c-0.062,0.137-0.147,0.251-0.255,0.342c-0.108,0.092-0.234,0.161-0.378,0.209c-0.123,0.041-0.229,0.063-0.359,0.075v0.347H8.058v-0.347c-0.143-0.009-0.258-0.032-0.388-0.078c-0.152-0.053-0.281-0.128-0.388-0.226c-0.108-0.098-0.191-0.217-0.25-0.359c-0.059-0.143-0.087-0.307-0.083-0.492h0.575c-0.004,0.219,0.046,0.391,0.146,0.518c0.088,0.109,0.207,0.165,0.388,0.185v-1.211c-0.102-0.031-0.189-0.067-0.3-0.109c-0.136-0.051-0.259-0.116-0.368-0.198c-0.109-0.082-0.198-0.183-0.265-0.306c-0.067-0.123-0.101-0.275-0.101-0.457c0-0.159,0.031-0.298,0.093-0.419c0.062-0.121,0.146-0.222,0.252-0.303S7.597,9.57,7.735,9.527C7.85,9.491,7.944,9.474,8.058,9.468V9.134h0.438v0.333c0.114,0.005,0.207,0.021,0.319,0.054c0.134,0.04,0.251,0.099,0.351,0.179c0.099,0.079,0.178,0.18,0.237,0.303c0.059,0.122,0.088,0.265,0.088,0.427H8.916c-0.007-0.169-0.051-0.297-0.134-0.387C8.712,9.968,8.626,9.932,8.496,9.919v1.059c0.116,0.035,0.213,0.074,0.333,0.118c0.145,0.053,0.272,0.121,0.383,0.203c0.111,0.083,0.2,0.186,0.268,0.308c0.067,0.123,0.101,0.273,0.101,0.453C9.581,12.244,9.549,12.406,9.488,12.543"></path>
                    </svg>
                    <span class="mx-3">Earnings</span>
                    <span x-show="open == false" >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"  style="margin-left: 4.1em;"  viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <span x-show="open == true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4"  style="margin-left: 4.1em;"   viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </a>
                <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @click.away="open = false">
                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('irePayment') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                        </svg>
                        <a href="{{ route('irePayment') }}"><span class="mx-3">Earnings List</span></a>
                    </li>
                </ul>
            </div>

            {{-- Downloads --}}
            <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('ireDownload') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('ireDownload') }}">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.634,10.633c0.116,0.113,0.265,0.168,0.414,0.168c0.153,0,0.308-0.06,0.422-0.177l4.015-4.111c0.229-0.235,0.225-0.608-0.009-0.836c-0.232-0.229-0.606-0.222-0.836,0.009l-3.604,3.689L6.35,5.772C6.115,5.543,5.744,5.55,5.514,5.781C5.285,6.015,5.29,6.39,5.522,6.617L9.634,10.633z"></path>
                    <path d="M17.737,9.815c-0.327,0-0.592,0.265-0.592,0.591v2.903H2.855v-2.903c0-0.327-0.264-0.591-0.591-0.591c-0.327,0-0.591,0.265-0.591,0.591V13.9c0,0.328,0.264,0.592,0.591,0.592h15.473c0.327,0,0.591-0.264,0.591-0.592v-3.494C18.328,10.08,18.064,9.815,17.737,9.815z"></path>
                </svg>
                <span class="mx-3">Downloads</span>
            </a>

        </nav>
    </div>
