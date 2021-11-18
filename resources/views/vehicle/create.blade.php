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
        </h2>
        <!-- Remaining User and Driver count for respective packages -->
        @php
            $business_package = \App\Models\BusinessPackage::where('business_id', auth()->user()->business_id)->first();
            $package = \App\Models\Package::where('id', $business_package->package_id)->first();
            if(auth()->user()->usertype != 'superadmin')
            {
                if($business_package->package_id != 7)
                    {
                        $vehiclesRemaining = $package->truck - $vehiclesCount;
                    }
            }
        @endphp
        @if($business_package->package_id == 5 || $business_package->package_id == 6 )
            <div class="flex flex-wrap" style="justify-content: flex-start">
                <h1 class="text-1xl mt-0 pb-0 text-center"> {{__('portal.Remaining Vehicles you can add')}}: </h1>
                <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$vehiclesRemaining}} &nbsp;</h1>
            </div>
        @endif
        <hr>

        <div class="flex flex-col bg-white rounded">
            <div class="p-4">
                <form method="POST" action="{{ route('vehicle.store') }}" enctype="multipart/form-data" class="p-4 rounded bg-white">
                    @csrf
                    <h2 class="text-2xl font-bold mt-0 pb-0 text-center">{{__('portal.Add Vehicle')}}</h2><br>

                    <div class="flex flex-wrap -mx-px overflow-hidden sm:-mx-1 md:-mx-2 lg:-mx-2 xl:-mx-1">

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="type">
                                {{__('portal.Type')}}
                            </label>
                            <select name="type" id="type" class="form-select shadow-sm block w-full" required>
                                <option value="">{{__('portal.Select')}}</option>
                                <option value="truck">Truck</option>
                            </select>
                        </div>
                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="licence_plate_No">
                                {{__('portal.Licence Number')}}
                            </label>
                            <input class="form-input rounded-md shadow-sm block w-full" id="licence_plate_No" type="text" name="licence_plate_No" min="0" autocomplete="licence_plate_No" required>
                        </div>
                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="warehouse_id">
                                {{__('portal.Warehouse')}}
                            </label>

                            <select name="warehouse_id" id="warehouse_id" class="form-select shadow-sm block w-full" required>
                                <option value="">{{__('portal.Select')}}</option>
                                @foreach (\App\Models\BusinessWarehouse::where('user_id',auth()->user()->id)->get() as $warehouse)
                                    <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
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
                            class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
                        {{__('portal.Add Vehicle')}}
                    </button>
                    <a href="{{ route('vehicle.index') }}"
                       class="inline-flex items-center px-4 mr-2 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-red disabled:opacity-25 transition ease-in-out duration-150">
                        {{__('portal.Cancel')}}
                    </a>
                </form>
            </div>
        </div>
        {{--<script>
            tinymce.init({
                selector: 'textarea',
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar_mode: 'floating',
            });
        </script>--}}
    </x-app-layout>
@else
    <x-app-layout>
        <h2 class="text-2xl font-bold py-2 text-center">
        </h2>
        <!-- Remaining User and Driver count for respective packages -->
        @php
            $business_package = \App\Models\BusinessPackage::where('business_id', auth()->user()->business_id)->first();
            $package = \App\Models\Package::where('id', $business_package->package_id)->first();
            if(auth()->user()->usertype != 'superadmin')
            {
                if($business_package->package_id != 7)
                    {
                        $vehiclesRemaining = $package->truck - $vehiclesCount;
                    }
            }
        @endphp
        @if($business_package->package_id == 5 || $business_package->package_id == 6 )
            <div class="flex flex-wrap" style="justify-content: flex-start">
                <h1 class="text-1xl mt-0 pb-0 text-center"> {{__('portal.Remaining Vehicles you can add')}}: </h1>
                <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$vehiclesRemaining}} &nbsp;</h1>
            </div>
        @endif
        <hr>

        <div class="flex flex-col bg-white rounded">
            <div class="p-4">
                <form method="POST" action="{{ route('vehicle.store') }}" enctype="multipart/form-data" class="p-4 rounded bg-white">
                    @csrf
                    <h2 class="text-2xl font-bold mt-0 pb-0 text-center">{{__('portal.Add Vehicle')}}</h2><br>

                    <div class="flex flex-wrap -mx-px overflow-hidden sm:-mx-1 md:-mx-2 lg:-mx-2 xl:-mx-1">

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="type">
                                {{__('portal.Type')}}
                            </label>
                            <select name="type" id="type" class="form-select shadow-sm block w-full" required>
                                <option value="">{{__('portal.Select')}}</option>
                                <option value="truck">Truck</option>
                            </select>
                        </div>
                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="licence_plate_No">
                                {{__('portal.Licence Number')}}
                            </label>
                            <input class="form-input rounded-md shadow-sm block w-full" id="licence_plate_No" type="text" name="licence_plate_No" min="0" autocomplete="licence_plate_No" required>
                        </div>
                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="warehouse_id">
                                {{__('portal.Warehouse')}}
                            </label>

                            <select name="warehouse_id" id="warehouse_id" class="form-select shadow-sm block w-full" required>
                                <option value="">{{__('portal.Select')}}</option>
                                @foreach (\App\Models\BusinessWarehouse::where('user_id',auth()->user()->id)->get() as $warehouse)
                                    <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
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
                            class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
                        {{__('portal.Add Vehicle')}}
                    </button>
                    <a href="{{ route('vehicle.index') }}"
                       class="inline-flex items-center px-4 mr-2 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-red disabled:opacity-25 transition ease-in-out duration-150">
                        {{__('portal.Cancel')}}
                    </a>
                </form>
            </div>
        </div>
        {{--<script>
            tinymce.init({
                selector: 'textarea',
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar_mode: 'floating',
            });
        </script>--}}
    </x-app-layout>
@endif
