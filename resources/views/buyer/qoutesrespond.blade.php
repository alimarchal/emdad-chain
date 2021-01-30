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
    <div class="flex flex-col bg-white rounded mt-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg p-4">

                    <h2 class="text-2xl font-bold py-2 text-center m-15">Qoutation</h2>
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
