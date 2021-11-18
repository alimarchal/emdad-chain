@section('headerScripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link href="{{ url('select2/src/select2totree.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ url('select2/src/select2totree.js') }}"></script>
@endsection
@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <h2 class="text-2xl font-bold py-2 text-center"> </h2>

        @include('users.sessionMessage')
        @if ($errors->any())
            <div>
                <div class="font-medium text-red-600">{{ __('Field(s) required.') }}</div>

                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-col bg-white rounded">
            @if ($shipmentCarts->count())
                @php $total = 0; @endphp
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            #
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Driver Name')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Vehicle')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Delivery')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Action')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($shipmentCarts as $shipmentCart)
                                        <tr>
                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                {{ $loop->iteration }}
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                {{ $shipmentCart->driver->name }}
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                {{ $shipmentCart->vehicle->type }} -- {{ $shipmentCart->vehicle->licence_plate_No }}
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                @php
                                                    $record = \App\Models\Category::where('id',$shipmentCart->delivery->eOrderItems->item_code)->first();
                                                @endphp
                                                {{ $record->name }}
{{--                                                {{ $shipmentCart->delivery->item_name }}--}}
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">

                                                <form method="POST" action="{{ route('shipmentCart.destroy', $shipmentCart->rfq_no) }}" class="inline delete">
                                                    @csrf
                                                    @method('delete')

                                                    <input type="hidden" name="rfq_type" value="{{$shipmentCart->delivery->rfq_type}}">
                                                    <input type="hidden" name="delivery_id" value="{{$shipmentCart->delivery->id}}">

                                                    <button type="submit" class="text-indigo-600 inline-block hover:text-indigo-900" title="DELETE">
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
                    <h2 class="text-2xl font-bold mt-0 pb-0 text-center">{{__('portal.Set Shipment Details')}}</h2><br>
                    <div class="w-full overflow-hidden">
                        <!-- Column Content -->
                        {{--                    @include('category.rfp')--}}
                    </div>

                    <div class="flex flex-wrap -mx-px overflow-hidden sm:-mx-1 md:-mx-2 lg:-mx-2 xl:-mx-1">

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="driver_id">{{__('portal.Driver')}}</label>

                            <select name="driver_id" id="driver_id" class="form-select shadow-sm block w-full" @if ($shipmentCarts->count() > 0) disabled @endif @if ($shipmentCarts->count() <= 0) required @endif>
                                <option value="">{{__('portal.Select')}}</option>
{{--                            @foreach (\App\Models\User::where('usertype', '=', 'Supplier Driver')->where('business_id', auth()->user()->business_id)->get() as $item)--}}
                                @foreach (\App\Models\User::where(['usertype' =>  'Supplier Driver', 'business_id' => auth()->user()->business_id, 'driver_status' => 1])->get() as $driver)
                                    <option @if ($shipmentCarts->count() > 0) selected @endif value="{{$driver->id}}">{{$driver->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="vehicle_id">{{__('portal.Vehicle')}}</label>
                            <select name="vehicle_id" id="vehicle_id" class="form-select shadow-sm block w-full" @if ($shipmentCarts->count() > 0) disabled @endif @if ($shipmentCarts->count() <= 0) required @endif>
                                <option value="">{{__('portal.Select')}}</option>
                                @foreach (\App\Models\Vehicle::where(['supplier_business_id' =>  auth()->user()->business_id, 'availability_status' => 1])->get() as $vehicle)
                                    <option @if ($shipmentCarts->count() > 0) selected @endif value="{{$vehicle->id}}">{{$vehicle->type. ' -- '. $vehicle->licence_plate_No}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="delivery_id">{{__('portal.Delivery')}}</label>
                            <select name="delivery_id" id="delivery_id" class="form-select shadow-sm block w-full" required>
                                <option value="">{{__('portal.Select')}}</option>
                                {{--@foreach(\App\Models\Delivery::where(['supplier_business_id' =>  auth()->user()->business_id, 'shipment_status' => 0])->get() as $delivery)
                                    <option value="{{$delivery->id}}">{{$delivery->item_name . ' - ' . $delivery->draft_purchase_order_id}}</option>
                                @endforeach--}}
                                @foreach($deliveries as $delivery)
                                    <option value="{{$delivery->id.','.$delivery->rfq_no}}">{{$delivery->item_name . ' - ' . $delivery->draft_purchase_order_id}}</option>
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
                    <div class="flex">
                        <div class="flex-row">
                            <button type="submit"
                                    class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
                                <svg class="svg-icon w-5 h-4" stroke="currentColor" viewBox="0 0 20 20" style="margin-right: 5px;">
                                    <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                                </svg>
                                {{__('portal.Add Shipment to cart')}}
                            </button>
                        </div>
                        <div class="flex-row">
                            <a href="{{ route('shipment.index') }}"
                               class="inline-flex items-center px-4 mr-2 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-red disabled:opacity-25 transition ease-in-out duration-150">
                                {{__('portal.Cancel')}}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <h2 class="text-2xl font-bold py-2 text-center"></h2>

        @include('users.sessionMessage')
        @if ($errors->any())
            <div>
                <div class="font-medium text-red-600">{{ __('Field(s) required.') }}</div>

                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-col bg-white rounded">
            @if ($shipmentCarts->count())
                @php $total = 0; @endphp
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Driver Name')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Vehicle')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Delivery')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Action')}}
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($shipmentCarts as $shipmentCart)
                                    <tr>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $shipmentCart->driver->name }}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $shipmentCart->vehicle->type }} -- {{ $shipmentCart->vehicle->licence_plate_No }}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @php
                                                $record = \App\Models\Category::where('id',$shipmentCart->delivery->eOrderItems->item_code)->first();
                                            @endphp
                                            {{ $record->name_ar }}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">

                                            <form method="POST" action="{{ route('shipmentCart.destroy', $shipmentCart->rfq_no) }}" class="inline delete">
                                                @csrf
                                                @method('delete')

                                                <input type="hidden" name="rfq_type" value="{{$shipmentCart->delivery->rfq_type}}">
                                                <input type="hidden" name="delivery_id" value="{{$shipmentCart->delivery->id}}">

                                                <button type="submit" class="text-indigo-600 inline-block hover:text-indigo-900" title="DELETE">
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
                    <h2 class="text-2xl font-bold mt-0 pb-0 text-center">{{__('portal.Set Shipment Details')}}</h2><br>
                    <div class="w-full overflow-hidden">
                        <!-- Column Content -->
                        {{--                    @include('category.rfp')--}}
                    </div>

                    <div class="flex flex-wrap -mx-px overflow-hidden sm:-mx-1 md:-mx-2 lg:-mx-2 xl:-mx-1">

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="driver_id">{{__('portal.Driver')}}</label>

                            <select name="driver_id" id="driver_id" class="form-select shadow-sm block w-full" @if ($shipmentCarts->count() > 0) disabled @endif @if ($shipmentCarts->count() <= 0) required @endif>
                                <option value="">{{__('portal.Select')}}</option>
                                {{--                            @foreach (\App\Models\User::where('usertype', '=', 'Supplier Driver')->where('business_id', auth()->user()->business_id)->get() as $item)--}}
                                @foreach (\App\Models\User::where(['usertype' =>  'Supplier Driver', 'business_id' => auth()->user()->business_id, 'driver_status' => 1])->get() as $driver)
                                    <option @if ($shipmentCarts->count() > 0) selected @endif value="{{$driver->id}}">{{$driver->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="vehicle_id">{{__('portal.Vehicle')}}</label>
                            <select name="vehicle_id" id="vehicle_id" class="form-select shadow-sm block w-full" @if ($shipmentCarts->count() > 0) disabled @endif @if ($shipmentCarts->count() <= 0) required @endif>
                                <option value="">{{__('portal.Select')}}</option>
                                @foreach (\App\Models\Vehicle::where(['supplier_business_id' =>  auth()->user()->business_id, 'availability_status' => 1])->get() as $vehicle)
                                    <option @if ($shipmentCarts->count() > 0) selected @endif value="{{$vehicle->id}}">{{$vehicle->type. ' -- '. $vehicle->licence_plate_No}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="delivery_id">{{__('portal.Delivery')}}</label>
                            <select name="delivery_id" id="delivery_id" class="form-select shadow-sm block w-full" required>
                                <option value="">{{__('portal.Select')}}</option>
                                {{--@foreach(\App\Models\Delivery::where(['supplier_business_id' =>  auth()->user()->business_id, 'shipment_status' => 0])->get() as $delivery)
                                    <option value="{{$delivery->id}}">{{$delivery->item_name . ' - ' . $delivery->draft_purchase_order_id}}</option>
                                @endforeach--}}
                                @foreach($deliveries as $delivery)
                                    {{-- Php tag for displaying Arabic category name --}}
                                    @php $record = \App\Models\Category::where('id',$delivery->item_code)->first(); @endphp
                                    <option value="{{$delivery->id.','.$delivery->rfq_no}}">{{$record->name_ar . ' - ' . $delivery->draft_purchase_order_id}}</option>
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

                    <div class="flex">
                        <div class="flex-row">
                            <button type="submit"
                                    class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
                                <svg class="svg-icon w-5 h-4" stroke="currentColor" viewBox="0 0 20 20" style="margin-left: 5px;">
                                    <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                                </svg>
                                {{__('portal.Add Shipment to cart')}}
                            </button>
                        </div>
                        <div class="flex-row">
                        <a href="{{ route('shipment.index') }}"
                           class="inline-flex items-center px-4 mr-2 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 hover:text-white active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-red disabled:opacity-25 transition ease-in-out duration-150">
                            {{__('portal.Cancel')}}
                        </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-app-layout>
@endif

<script>
    $(".delete").on("submit", function(){
        return confirm("Are you sure you want to delete?");
    });
</script>
