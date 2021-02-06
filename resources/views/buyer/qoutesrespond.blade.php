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

                    <h2 class="text-2xl font-bold py-2 text-center">Quotation</h2>
                    <hr>
                    <div class="flex flex-wrap overflow-hidden xl:-mx-1 p-4 rounded shadow-md ">
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Quote Request #: {{ $QouteItem->id }}</strong>
                        </div>

                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Item Name:</strong> {{ $QouteItem->orderItem->item_name }}
                        </div>

                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Quote Quantity:</strong> {{ $QouteItem->quote_quantity }}
                        </div>

                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Quote Price Per Quantity: {{ $QouteItem->quote_price_per_quantity }}</strong>
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Sample Information:</strong> {{ $QouteItem->sample_information }}
                        </div>


                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Sample Unit:</strong> {{ $QouteItem->sample_unit }}
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Sample Security Charges:</strong> {{ $QouteItem->sample_security_charges }}
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Sample Charges Per Unit:</strong> {{ $QouteItem->sample_charges_per_unit }}
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Shipping Time In Days:</strong> {{ $QouteItem->shipping_time_in_days }}
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <strong>Note:</strong> {{ strip_tags($QouteItem->note_for_customer) }}
                        </div>
                    </div>

                    <div class="border-2 p-2 m-2">
                        @foreach ($QouteItem->messages as $msg)
                            Message from {{ $msg->usertype }} : {{ strip_tags($msg->message) }} <br>
                        @endforeach
                    </div>

                    <hr>
                    <form action="{{ route('QuotationMessage.store') }}" method="post">
                        @csrf
                        <h1 class="text-center text-2xl mt-4">Message to Buyer</h1>
                        <textarea name="message" id="message" cols="30" rows="10" class="form-input rounded-md shadow-sm mt-1 block w-full" autocomplete="name"></textarea>
                        <x-jet-input-error for="message" class="mt-2" />
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="qoute_id" value="{{ $QouteItem->id }}">
                        <input type="hidden" name="usertype" value="{{ $QouteItem->business->business_type }}">

                        <br>
                        <x-jet-button>
                            {{ __('Send') }}
                        </x-jet-button>
                        <br>
                    </form>

                    <br>
                    <hr>
                    <h2 class="text-center text-2xl">
                        @if ($QouteItem->qoute_status == 'ModificationNeeded')
                            You have choose for modification needed for this quote
                        @elseif($QouteItem->qoute_status == 'Qouted')
                            You have not quoted...
                        @elseif($QouteItem->qoute_status == 'Rejected')
                            You have rejected this quote..
                        @endif
                    </h2>
                    <hr>
                    <br>
                    <div class="flex justify-between p-2 m-2">

                        <a href="{{ route('updateQoute', $QouteItem->id) }}"
                            class="inline-flex items-center justify-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-800 transition ease-in-out duration-150">
                            Qoute Again
                        </a>

                        <form action="{{ route('qouteAccepted', $QouteItem->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="business_id" value="{{ auth()->user()->business_id }}">

                            <input type="hidden" name="supplier_user_id" value="{{ $QouteItem->supplier_user_id }}">
                            <input type="hidden" name="supplier_business_id" value="{{ $QouteItem->supplier_business_id }}">

                            <input type="hidden" name="rfq_no" value="{{ $QouteItem->e_order_id }}">
                            <input type="hidden" name="rfq_item_no" value="{{ $QouteItem->e_order_items_id }}">

                            <input type="hidden" name="item_code" value="{{ $QouteItem->orderItem->item_code }}">
                            <input type="hidden" name="item_name" value="{{ $QouteItem->orderItem->item_name }}">

                            <input type="hidden" name="uom" value="{{ $QouteItem->orderItem->unit_of_measurement }}">
                            <input type="hidden" name="brand" value="{{ $QouteItem->orderItem->brand }}">

                            <input type="hidden" name="quantity" value="{{ $QouteItem->quote_quantity }}">
                            <input type="hidden" name="unit_price" value="{{ $QouteItem->quote_price_per_quantity }}">




                            <input type="hidden" name="payment_term" value="{{ $QouteItem->e_order_items_id }}">

                            <input type="submit" value="Accept" class="inline-flex items-center justify-center px-4 py-2 bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-800 transition ease-in-out duration-150">
                        </form>

                        <a href="{{ route('updateRejected', $QouteItem->id) }}"
                            class="inline-flex items-center justify-center px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-blue-800 transition ease-in-out duration-150">Reject
                            Request</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
            Back
        </a>
    </div>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
        });

    </script>
</x-app-layout>
