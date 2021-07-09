@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User List') }}
            </h2>
        </x-slot>

        @if (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <h2 class="text-2xl font-bold py-2 text-center m-15">Items List @if (!$shipmentDetails->count()) seems empty @endif
        </h2>

        @if ($shipmentDetails->count())
            @php $total = 0; @endphp
            <div class="flex flex-col bg-white rounded ">
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
                                        Vehicle Type
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Licence Number
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Delivery Id
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($shipmentDetails as $shipmentDetail)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php $driverName = \App\Models\User::where('id', $shipmentDetail->driver_id)->first();  @endphp
                                            @if(isset($driverName)) {{ $driverName->name }} @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php $vehicleName = \App\Models\Vehicle::where('id', $shipmentDetail->vehicle_id)->first();  @endphp
                                            {{ $vehicleName->type }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php $vehicleName = \App\Models\Vehicle::where('id', $shipmentDetail->vehicle_id)->first();  @endphp
                                            {{ $vehicleName->licence_plate_No }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{route('delivery.show', encrypt($shipmentDetail->rfq_no))}}" class="hover:underline text-blue-600" target="_blank">{{$shipmentDetail->delivery_id}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="mt-5">
            <a href="{{route('shipment.index')}}" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                Back
            </a>
        </div>

    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User List') }}
            </h2>
        </x-slot>

        @if (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <h2 class="text-2xl font-bold py-2 text-center m-15">Items List @if (!$shipmentDetails->count()) seems empty @endif
        </h2>

        <!-- This example requires Tailwind CSS v2.0+ -->


        @if ($shipmentDetails->count())
            @php $total = 0; @endphp
            <div class="flex flex-col bg-white rounded ">
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
                                        نوع العربة
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 tracking-wider">
                                        Delivery Id
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($shipmentDetails as $shipmentDetail)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php $driverName = \App\Models\User::where('id', $shipmentDetail->driver_id)->first();  @endphp
                                            {{ $driverName->name }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php $vehicleName = \App\Models\Vehicle::where('id', $shipmentDetail->vehicle_id)->first();  @endphp
                                            {{ $vehicleName->type }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $shipmentDetail->delivery_id }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="mt-5">
            <a href="{{route('shipment.index')}}" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                عودة
            </a>
        </div>





    </x-app-layout>
@endif
