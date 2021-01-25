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





    <div class="flex flex-col bg-white rounded ">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg p-4">
                    <h2 class="text-2xl font-bold py-2 text-center m-15">Send Quote Request</h2>
                    <hr>
                    
                    <p class="p-4">
                        <strong>Quote Request #: {{ $eOrderItems->id }}</strong><br>
                        <strong>Client Name: {{ $eOrderItems->business->business_name }}</strong><br>
                        <strong>Description:</strong> {{ strip_tags($eOrderItems->description) }}<br>
                        <strong>Qoute User:</strong> {{ $eOrderItems->user->name }}<br>
                        <strong>Item Code:</strong> {{ $eOrderItems->item_code }}<br>
                        <strong>Item Name:</strong> {{ $eOrderItems->item_name }}<br>
                        <strong>Unit of Measurement:</strong> {{ $eOrderItems->unit_of_measurement }}<br>
                        <strong>Size:</strong> {{ $eOrderItems->size }}<br>
                        <strong>Quantity:</strong> {{ $eOrderItems->quantity }}<br>
                        <strong>Brand:</strong> {{ $eOrderItems->brand }}<br>
                        <strong>Remarks:</strong> {{ $eOrderItems->remarks }}<br>
                        <strong>Delivery Period:</strong> {{ $eOrderItems->delivery_period }}<br>
                        <strong>Required Sample:</strong> {{ $eOrderItems->required_sample }}<br>
                        <strong>Required Sample:</strong> {{ $eOrderItems->required_sample }}<br>
                        <strong>Payment Mode:</strong> {{ $eOrderItems->payment_mode }}<br>
                    </p>
                    <hr>
                    <p class="pt-6 pb-3 font-bold text-2xl text-center">Quote Information</p>
                    <hr>

                    <form method="POST" action="#" enctype="multipart/form-data" class="rounded bg-white">
                        @csrf


                        <div class="w-full overflow-hidden  p-2">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="unit_of_measurement">
                                Quote Quantity
                            </label>
                            <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="size" min="0" autocomplete="size" required>
                        </div>

                        <div class="w-full overflow-hidden  p-2">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                Quote Price Per Quantity
                            </label>
                            <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="size" min="0" autocomplete="size" required>
                        </div>

                        <p class="py-2 font-bold text-center  text-2xl">Sample Information:</p>


                        <div class="w-full overflow-hidden p-2">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                Samples 

                            </label>
                            <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="size" min="0" autocomplete="size" required>
                        </div>

                        <div class="w-full overflow-hidden p-2">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                Sample Unit 
                            </label>
                            <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="size" min="0" autocomplete="size" required>
                        </div>

                        <div class="w-full overflow-hidden p-2">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                Sample Security Charges 

                            </label>
                            <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="size" min="0" autocomplete="size" required>
                        </div>


                        <div class="w-full overflow-hidden p-2">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                Sample Charges Per Unit 

                            </label>
                            <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="size" min="0" autocomplete="size" required>
                        </div>

                        <p class="py-2 font-bold text-center  text-2xl">Shipping Information:</p>

                        <div class="w-full overflow-hidden p-2">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                Shipping Time (In Days) 

                            </label>
                            <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="size" min="0" autocomplete="size" required>
                        </div>


                        <div class="w-full overflow-hidden p-2">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                Note For Customer 
                            </label>
                            <textarea name="description" id="description"></textarea>
                        </div>

                        <button href="#"
                        class=" px-4 float-right py-2 mt-4 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                        Send Quote
                    </button>
                      
                      
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <a href="{{ route('dashboard') }}"
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
