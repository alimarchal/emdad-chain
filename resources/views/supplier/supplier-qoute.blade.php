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
    <div class="flex flex-col bg-white rounded mt-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg p-4">

                    <h2 class="text-2xl font-bold py-2 text-center m-15">RFQ</h2>
                    <hr>
                    <div class="flex flex-wrap overflow-hidden xl:-mx-1 p-4 rounded shadow-md ">
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Quote Request #: {{ $eOrderItems->id }}</strong>
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                           @if($eOrderItems->company_name_check == 1) <strong>Client Name: {{ $eOrderItems->business->business_name }}</strong>@endif
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            @if($eOrderItems->company_name_check == 1) <strong>Qoute User:</strong> {{ $eOrderItems->user->name }} @endif
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Item Code:</strong> {{ $eOrderItems->item_code }}
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Item Name:</strong> {{ $eOrderItems->item_name }}
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Unit of Measurement:</strong> {{ $eOrderItems->unit_of_measurement }}
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Size:</strong> {{ $eOrderItems->size }}
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Quantity:</strong> {{ $eOrderItems->quantity }}
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Brand:</strong> {{ $eOrderItems->brand }}
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Remarks:</strong> {{ $eOrderItems->remarks }}
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Delivery Period:</strong> {{ $eOrderItems->delivery_period }}
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Required Sample:</strong> {{ $eOrderItems->required_sample }}
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Payment Mode:</strong> {{ $eOrderItems->payment_mode }}
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Delivery Address:</strong> {{ $eOrderItems->warehouse->address }}
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Description:</strong> {{ strip_tags($eOrderItems->description) }}
                        </div>
                    </div>



                    @if ($collection)
                        <br>
                        <br>

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Item Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        {{ ucwords(str_replace('_', ' ', 'quantity')) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        {{ ucwords(str_replace('_', ' ', 'price_per_quantity')) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        {{ ucwords(str_replace('_', ' ', 'sample_information')) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        {{ ucwords(str_replace('_', ' ', 'sample_unit')) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        {{ ucwords(str_replace('_', ' ', 'sample_security_charges')) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        {{ ucwords(str_replace('_', ' ', 'sample_charges_per_unit')) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        {{ ucwords(str_replace('_', ' ', 'shipping_time_in_days')) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        {{ ucwords(str_replace('_', ' ', 'note_for_customer')) }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        {{ 1 }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $collection->orderItem->item_name }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $collection->quote_quantity }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $collection->quote_price_per_quantity }}
                                    </td>


                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $collection->sample_information }}
                                    </td>



                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $collection->sample_unit }}
                                    </td>



                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $collection->sample_security_charges }}
                                    </td>


                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $collection->sample_charges_per_unit }}
                                    </td>


                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $collection->shipping_time_in_days }}
                                    </td>


                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ strip_tags($collection->note_for_customer) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    @endif

                    @if ($collection && $collection->qoute_status == 'Qouted')

                        <h2 class="text-center text-2xl">You have already qouted...</h2>

                    @elseif($collection && $collection->qoute_status == 'ModificationNeeded')
                        <hr>

                        @php $quote = \App\Models\QouteMessage::where('qoute_id',$collection->id )->get(); @endphp
                        @if(isset($quote))
                            <br>

                            <div class="border-2 p-2 m-2">
                                @foreach ($quote as $msg)
                                        {{--@php $business = \App\Models\Business::where('user_id', $msg->user_id)->first(); @endphp--}}
                                        @php
                                            $user = \App\Models\User::where('id', $msg->user_id)->first();
                                            $business = \App\Models\Business::where('id', $user->business_id)->first();
                                        @endphp

                                        <span class="text-blue-700">
                                            <span class="text-gray-600 text-left">
                                                Message from {{$business->business_name}}
                                            </span>
                                            : {{strip_tags(str_replace('&nbsp;', ' ',  $msg->message))}}
                                        </span>
                                    <br> <br>
                                @endforeach
                            </div>
                            <br>
                        @endif
                        <hr>

                        <form method="POST" action="{{ route('qoute.update', $collection->id) }}" enctype="multipart/form-data" class="rounded bg-white mt-4">
                            @csrf
                            @method('PUT')

                            <p class="pt-6 pb-3 font-bold text-2xl text-center">
                                @if ($collection->qoute_status == 'ModificationNeeded')
                                    <span class="text-red-900">Modification Needed</span>
                                @endif
                                Quote Information</p>
                            <div class="flex flex-wrap overflow-hidden xl:-mx-1">
                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="unit_of_measurement">
                                        Quantity
                                    </label>
                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="quote_quantity" value="{{ $collection->quote_quantity }}" min="0" step="any" autocomplete="size" required>
                                    <input type="hidden" name="e_order_items_id" value="{{ $eOrderItems->id }}">
                                    <input type="hidden" name="e_order_id" value="{{ $eOrderItems->e_order_id }}">
                                    <input type="hidden" name="business_id" value="{{ $eOrderItems->business_id }}">
                                    <input type="hidden" name="supplier_business_id" value="{{ $user_business_id }}">
                                    <input type="hidden" name="supplier_user_id" value="{{ auth()->user()->id }}">
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                        Price per unit
                                    </label>
                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="quote_price_per_quantity" value="{{ $collection->quote_price_per_quantity }}" min="0" step="any" autocomplete="size" required>
                                </div>
                            </div>
                            @if($collection->required_sample == 'Yes')
                            <p class="py-2 font-bold text-center  text-2xl">Sample Information</p>
                            <div class="flex flex-wrap overflow-hidden xl:-mx-1">
                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                        Samples
                                    </label>
                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="sample_information" value="{{ $collection->sample_information }}" min="0" step="any" autocomplete="size" required>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                        Sample Unit
                                    </label>
                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_unit" value="{{ $collection->sample_unit }}" min="0" autocomplete="size" required>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                        Quantity
                                    </label>
                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_security_charges" value="{{ $collection->sample_security_charges }}" min="0" autocomplete="size" required>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                        Sample Charges Per Unit
                                    </label>
                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_charges_per_unit" value="{{ $collection->sample_charges_per_unit }}" min="0" autocomplete="size" required>
                                </div>
                            </div>
                            @endif
                            <p class="py-2 font-bold text-center  text-2xl">Shipping Information</p>
                            <div class="flex flex-wrap -mx-1 overflow-hidden sm:-mx-1 md:-mx-1 lg:-mx-1 xl:-mx-1">
                                <div class="my-1 px-1 w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 xl:my-1 xl:px-1">
                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                        Shipping Time (In Days)
                                    </label>
                                    <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" value="{{ $collection->shipping_time_in_days }}" name="shipping_time_in_days" min="0" autocomplete="size" required>
                                </div>
                                <div class="my-1 px-1 w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 xl:my-1 xl:px-1">
                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                        @php $business = \App\Models\Business::where('user_id', $collection->user_id)->first(); @endphp
                                        Note to {{$business->business_name}} (buyer)
                                    </label>
                                    <textarea name="note_for_customer" id="note_for_customer" class="w-full" style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="Enter Note (if any)"></textarea>
{{--                                    <textarea name="note_for_customer" id="description">{{ $collection->note_for_customer }}</textarea>--}}
                                </div>
                                <div class="my-1 px-1 w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 xl:my-1 xl:px-1">
                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                        VAT(%)
                                    </label>
                                    <input class="form-input rounded-md shadow-sm block w-full VAT" id="VAT" type="number" name="VAT" min="0" max="15" value="{{$collection->VAT}}" autocomplete="size" required>
                                </div>
                                <div class="my-1 px-1 w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 xl:my-1 xl:px-1">
                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                        Shipment Cost
                                    </label>
                                    <input class="form-input rounded-md shadow-sm block w-full shipment_cost" id="shipment_cost" type="number" name="shipment_cost" value="{{$collection->shipment_cost}}" min="0" step="any" autocomplete="size" required>
                                </div>
                                <div class="my-1 px-1 w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 xl:my-1 xl:px-1">
                                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                        Total Cost
                                    </label>
                                    <input class="form-input rounded-md shadow-sm block w-full" id="total_cost" type="text" name="total_cost" value="{{$collection->total_cost}}" autocomplete="size" readonly>
                                </div>
                            </div>
                            <button
                                class=" px-4 float-right py-2 mt-4 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                Update Send Quote
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('qoute.store') }}" enctype="multipart/form-data" class="rounded bg-white mt-4">
                            @csrf
                            <div class="calculate">
                                <p class="pt-6 pb-3 font-bold text-2xl text-center">

                                    Quote Information</p>
                                <div class="flex flex-wrap overflow-hidden xl:-mx-1">
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="unit_of_measurement">
                                            Quantity
                                        </label>
                                        <input class="form-input rounded-md shadow-sm block w-full quantity" id="size" type="number" name="quote_quantity" min="0" step="any" autocomplete="size" required>
                                        <input type="hidden" name="e_order_items_id" value="{{ $eOrderItems->id }}">
                                        <input type="hidden" name="e_order_id" value="{{ $eOrderItems->e_order_id }}">
                                        <input type="hidden" name="business_id" value="{{ $eOrderItems->business_id }}">
                                        <input type="hidden" name="supplier_business_id" value="{{ $user_business_id }}">
                                        <input type="hidden" name="supplier_user_id" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="warehouse_id" value="{{ $eOrderItems->warehouse->id }}">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                            Price per unit
                                        </label>
                                        <input class="form-input rounded-md shadow-sm block w-full price_per_unit" id="size" type="number" name="quote_price_per_quantity" min="0" step="any" autocomplete="size" required>
                                    </div>
                                </div>
                                @if($eOrderItems->required_sample == 'Yes')
                                <p class="py-2 font-bold text-center  text-2xl">Sample Information</p>
                                <div class="flex flex-wrap overflow-hidden xl:-mx-1">
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                            Samples
                                        </label>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="sample_information" min="0" step="any" autocomplete="size" required>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                            Quantity
                                        </label>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_unit" min="0" autocomplete="size" required>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                            Sample Charges
                                        </label>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_security_charges" min="0" autocomplete="size" required>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                            Sample Charges Per Unit
                                        </label>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_charges_per_unit" min="0" autocomplete="size" required>
                                    </div>
                                </div>
                                @endif
                                <p class="py-2 font-bold text-center  text-2xl">Shipping Information</p>
                                <div class="flex flex-wrap -mx-1 overflow-hidden sm:-mx-1 md:-mx-1 lg:-mx-1 xl:-mx-1">
                                    <div class="my-1 px-1 w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 xl:my-1 xl:px-1">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                            Shipping Time (In Days)
                                        </label>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="shipping_time_in_days" min="0" autocomplete="size" required>
                                    </div>
                                    <div class="my-1 px-1 w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 xl:my-1 xl:px-1">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                            @php $business = \App\Models\Business::where('id', $eOrderItems->business_id)->first(); @endphp
                                            Note to {{$business->business_name}} (buyer)
                                        </label>
                                        <textarea name="note_for_customer" id="note_for_customer" class="w-full" style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="Enter Note.."></textarea>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                            VAT(%)
                                        </label>
                                        <input class="form-input rounded-md shadow-sm block w-full VAT" id="size" type="number" name="VAT" min="0" max="15" step="any" autocomplete="size" required>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="shipment_cost">
                                            Shipment Cost
                                        </label>

                                        <input class="form-input rounded-md shadow-sm block w-full shipment_cost" id="shipment_cost" type="number" name="shipment_cost" min="0" autocomplete="shipment_cost" required>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                            Total Cost
                                        </label>
                                        <input class="form-input rounded-md shadow-sm block w-full" id="total_cost" type="text" name="total_cost" autocomplete="size" readonly>
                                    </div>
                                </div>
                                <button
                                    class=" px-4 float-right py-2 mt-4 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                    Send Quote
                                </button>
                                <br>
                                <a href="{{ route('dashboard') }}"
                                    class="inline-flex items-center px-4 mr-2 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-red disabled:opacity-25 transition ease-in-out duration-150">
                                    Cancel</a>
                            </div>
                        </form>
                        <br>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
            Go Back
        </a>
    </div>

    <script>
        // tinymce.init({
        //     selector: 'textarea',
        //     plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        //     toolbar_mode: 'floating',
        // });

        $(document).on('change', '.quantity, .price_per_unit, .VAT, .shipment_cost', function(){

            // var total = 0;
            var quantity = $('.quantity').val(); // 10
            var unitPrice = $('.price_per_unit').val(); // 10
            var shipment_cost = $('.shipment_cost').val(); // 10
            var VAT = $('.VAT').val(); // 10

            var totalCost = (quantity * unitPrice) // 100
            var VAT_value = (totalCost) * (VAT / 100); // 10

            var totalSumCost = (totalCost + VAT_value);
            $('#total_cost').val(totalSumCost);
        });

    </script>
</x-app-layout>
