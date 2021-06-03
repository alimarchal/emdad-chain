@section('headerScripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link href="{{ url('select2/src/select2totree.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ url('select2/src/select2totree.js') }}"></script>
@endsection
@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <h2 class="text-2xl font-bold py-2 text-center">
            {{--        <a href="{{ route('RFQCart.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">--}}
            {{--        <svg class="w-6 h-6" viewBox="0 0 124.000000 153.000000" preserveAspectRatio="xMidYMid meet">--}}
            {{--            <g transform="translate(0.000000,153.000000) scale(0.100000,-0.100000)"--}}
            {{--            fill="#fff" stroke="none">--}}
            {{--            <path d="M95 1506 c-45 -19 -83 -70 -90 -119 -3 -23 -5 -320 -3 -659 3 -605 3--}}
            {{--            -617 24 -644 11 -15 33 -37 48 -48 27 -21 38 -21 541 -21 503 0 514 0 541 21--}}
            {{--            15 11 37 33 48 48 21 27 21 40 23 554 l2 527 -162 177 -162 178 -390 -1 c-302--}}
            {{--            0 -397 -3 -420 -13z m785 -146 c0 -200 18 -220 205 -220 l105 0 0 -509 0 -509--}}
            {{--            -26 -31 c-14 -17 -42 -35 -62 -41 -50 -13 -924 -13 -974 0 -20 6 -48 24 -62--}}
            {{--            41 l-26 31 0 642 0 643 22 28 c41 53 53 54 451 55 l367 0 0 -130z m168 -48--}}
            {{--            l124 -137 -85 -3 c-101 -3 -152 13 -167 53 -12 30 -14 225 -2 224 4 0 63 -62--}}
            {{--            130 -137z"/>--}}
            {{--            <path d="M165 1019 c-4 -6 -3 -15 2 -20 5 -5 152 -8 354 -7 298 3 344 5 344--}}
            {{--            18 0 13 -46 15 -347 18 -244 1 -349 -1 -353 -9z"/>--}}
            {{--            <path d="M160 895 c0 -13 46 -15 355 -15 309 0 355 2 355 15 0 13 -46 15 -355--}}
            {{--            15 -309 0 -355 -2 -355 -15z"/>--}}
            {{--            <path d="M165 789 c-4 -6 -3 -15 2 -20 5 -5 191 -8 454 -7 387 3 444 5 444 18--}}
            {{--            0 13 -57 15 -447 18 -316 1 -449 -1 -453 -9z"/>--}}
            {{--            <path d="M269 684 c-4 -72 3 -270 10 -277 13 -13 19 3 23 55 l3 37 56 -49 c46--}}
            {{--            -41 59 -47 68 -36 9 11 1 22 -39 56 -50 42 -61 60 -37 60 24 0 57 45 57 76 0--}}
            {{--            43 -38 75 -94 81 -25 3 -46 2 -47 -3z m94 -52 c26 -23 21 -50 -13 -67 -45 -23--}}
            {{--            -50 -20 -50 39 0 51 1 54 23 49 12 -3 30 -13 40 -21z"/>--}}
            {{--            <path d="M477 683 c-9 -8 -9 -268 0 -276 17 -18 33 19 33 79 l0 64 55 0 c42 0--}}
            {{--            55 3 55 15 0 12 -13 15 -55 15 l-55 0 0 40 0 40 65 0 c51 0 65 3 65 15 0 12--}}
            {{--            -15 15 -78 15 -43 0 -82 -3 -85 -7z"/>--}}
            {{--            <path d="M709 652 c-42 -43 -54 -76 -45 -126 18 -94 125 -144 205 -95 30 18--}}
            {{--            35 19 50 5 10 -9 23 -16 29 -16 19 0 14 28 -7 42 -14 10 -17 18 -10 28 14 23--}}
            {{--            11 98 -6 131 -23 43 -71 69 -129 69 -43 0 -53 -4 -87 -38z m167 -23 c26 -24--}}
            {{--            40 -75 29 -108 -6 -21 -7 -21 -40 5 -47 36 -66 21 -26 -20 38 -39 27 -56 -37--}}
            {{--            -56 -109 0 -145 142 -50 197 32 18 95 9 124 -18z"/>--}}
            {{--            <path d="M160 335 c0 -13 57 -15 455 -15 398 0 455 2 455 15 0 13 -57 15 -455--}}
            {{--            15 -398 0 -455 -2 -455 -15z"/>--}}
            {{--            <path d="M165 239 c-4 -6 -3 -15 2 -20 5 -5 191 -8 454 -7 387 3 444 5 444 18--}}
            {{--            0 13 -57 15 -447 18 -316 1 -449 -1 -453 -9z"/>--}}
            {{--            </g>--}}
            {{--            </svg>--}}
            {{--            &nbsp;RFQ Items @if ($eCart->count()) ({{ $eCart->count() }}) @else @endif--}}
            {{--        </a>--}}
        </h2>

        <div class="flex flex-col bg-white rounded">

            @if ($shipmentCarts->count())
                @php $total = 0; @endphp
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Driver Name
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Vehicle
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Delivery
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </th>


                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($shipmentCarts as $shipmentCart)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $shipmentCart->driver->name }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $shipmentCart->vehicle->type }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $shipmentCart->delivery->item_name }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            </form>
                                            <form method="POST" action="{{ route('shipmentCart.destroy', $shipmentCart->id) }}" class="inline">
                                                @csrf
                                                @method('delete')

                                                <button type="submit" class="text-indigo-600 inline-block hover:text-indigo-900" title="DELETE" onsubmit="alert('Are you sure')">
                                                    <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="red">
                                                        <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                                        <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            <br>
            <div class="p-4">


                <hr>

                <form method="POST" action="{{ route('shipmentCart.store') }}" enctype="multipart/form-data" class="p-4 rounded bg-white">
                    @csrf
                    <h2 class="text-2xl font-bold mt-0 pb-0 text-center">Set Shipment Details</h2><br>
                    <div class="w-full overflow-hidden">
                        <!-- Column Content -->
                        {{--                    @include('category.rfp')--}}
                    </div>

                    <div class="flex flex-wrap -mx-px overflow-hidden sm:-mx-1 md:-mx-2 lg:-mx-2 xl:-mx-1">

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="driver_id">
                                Drivers
                            </label>

                            <select name="driver_id" id="driver_id" class="form-select shadow-sm block w-full" @if ($shipmentCarts->count() > 0) disabled @endif @if ($shipmentCarts->count() <= 0) required @endif>
                                <option value="">None</option>
                                {{--                            @foreach (\App\Models\User::where('usertype', '=', 'Supplier Driver')->where('business_id', auth()->user()->business_id)->get() as $item)--}}
                                @foreach (\App\Models\User::where(['usertype' =>  'Supplier Driver', 'business_id' => auth()->user()->business_id, 'driver_status' => 1])->get() as $driver)
                                    <option @if ($shipmentCarts->count() > 0) selected @endif value="{{$driver->id}}">{{$driver->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="vehicle_type">
                                Vehicle
                            </label>
                            <select name="vehicle_type" id="vehicle_type" class="form-select shadow-sm block w-full" @if ($shipmentCarts->count() > 0) disabled @endif @if ($shipmentCarts->count() <= 0) required @endif>
                                <option value="">None</option>
                                @foreach (\App\Models\Vehicle::where(['supplier_business_id' =>  auth()->user()->business_id, 'availability_status' => 1])->get() as $vehicle)
                                    <option @if ($shipmentCarts->count() > 0) selected @endif value="{{$vehicle->id}}">{{$vehicle->type. ' -- '. $vehicle->licence_plate_No}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="delivery_id">
                                Delivery
                            </label>
                            <select name="delivery_id" id="delivery_id" class="form-select shadow-sm block w-full" required>
                                <option value="">None</option>
                                @foreach(\App\Models\Delivery::where(['supplier_business_id' =>  auth()->user()->business_id, 'shipment_status' => 0])->get() as $delivery)
                                    <option value="{{$delivery->id}}">{{$delivery->item_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <!-- Column Content -->
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <!-- Column Content -->
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">

                        </div>

                    </div>
                    <button type="submit"
                            class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        ADD Shipment to cart
                    </button>
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        Cancel</a>
                </form>
            </div>
        </div>
        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar_mode: 'floating',
            });
        </script>
    </x-app-layout>
@else
    <x-app-layout>
        <h2 class="text-2xl font-bold py-2 text-center">
        </h2>

        <div class="flex flex-col bg-white rounded">

            @if ($shipmentCarts->count())
                @php $total = 0; @endphp
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 tracking-wider">
                                        Driver Name
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 tracking-wider">
                                        Vehicle
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 tracking-wider">
                                        التوصيل
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 tracking-wider">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </th>


                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($shipmentCarts as $shipmentCart)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $shipmentCart->driver->name }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $shipmentCart->vehicle->type }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $shipmentCart->delivery->item_name }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            </form>
                                            <form method="POST" action="{{ route('shipmentCart.destroy', $shipmentCart->id) }}" class="inline">
                                                @csrf
                                                @method('delete')

                                                <button type="submit" class="text-indigo-600 inline-block hover:text-indigo-900" title="DELETE" onsubmit="alert('Are you sure')">
                                                    <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="red">
                                                        <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                                        <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            <br>
            <div class="p-4">


                <hr>

                <form method="POST" action="{{ route('shipmentCart.store') }}" enctype="multipart/form-data" class="p-4 rounded bg-white">
                    @csrf
                    <h2 class="text-2xl font-bold mt-0 pb-0 text-center">Set Shipment Details</h2><br>
                    <div class="w-full overflow-hidden">
                        <!-- Column Content -->
                        {{--                    @include('category.rfp')--}}
                    </div>

                    <div class="flex flex-wrap -mx-px overflow-hidden sm:-mx-1 md:-mx-2 lg:-mx-2 xl:-mx-1">

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="driver_id">
                                Drivers
                            </label>

                            <select name="driver_id" id="driver_id" class="form-select shadow-sm block w-full" @if ($shipmentCarts->count() > 0) disabled @endif @if ($shipmentCarts->count() <= 0) required @endif>
                                <option value="">None</option>
                                {{--                            @foreach (\App\Models\User::where('usertype', '=', 'Supplier Driver')->where('business_id', auth()->user()->business_id)->get() as $item)--}}
                                @foreach (\App\Models\User::where(['usertype' =>  'Supplier Driver', 'business_id' => auth()->user()->business_id, 'driver_status' => 1])->get() as $driver)
                                    <option @if ($shipmentCarts->count() > 0) selected @endif value="{{$driver->id}}">{{$driver->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="vehicle_type">
                                Vehicle
                            </label>
                            <select name="vehicle_type" id="vehicle_type" class="form-select shadow-sm block w-full" @if ($shipmentCarts->count() > 0) disabled @endif @if ($shipmentCarts->count() <= 0) required @endif>
                                <option value="">None</option>
                                @foreach (\App\Models\Vehicle::where(['supplier_business_id' =>  auth()->user()->business_id, 'availability_status' => 1])->get() as $vehicle)
                                    <option @if ($shipmentCarts->count() > 0) selected @endif value="{{$vehicle->id}}">{{$vehicle->type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="delivery_id">
                                التوصيل
                            </label>
                            <select name="delivery_id" id="delivery_id" class="form-select shadow-sm block w-full" required>
                                <option value="">None</option>
                                @foreach(\App\Models\Delivery::where(['supplier_business_id' =>  auth()->user()->business_id, 'shipment_status' => 0])->get() as $delivery)
                                    <option value="{{$delivery->id}}">{{$delivery->item_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <!-- Column Content -->
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <!-- Column Content -->
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">

                        </div>

                    </div>
                    <button type="submit"
                            class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        ADD Shipment to cart
                    </button>
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        إلغاء</a>
                </form>
            </div>
        </div>
        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar_mode: 'floating',
            });
        </script>
    </x-app-layout>
@endif
