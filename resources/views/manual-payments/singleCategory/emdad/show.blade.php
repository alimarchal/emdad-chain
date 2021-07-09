<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Business Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- component -->
            @include('users.sessionMessage')
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6">
                    <h1 class="text-center text-3xl font-bold p-4 border-t-2 bg-opacity-5 border-black border-2"> Payment Received Information</h1>


                    <div class="flex flex-wrap -mx-1 overflow-hidden sm:-mx-px md:-mx-1 lg:-mx-1 xl:-mx-1">

                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <p><strong>Invoice Number:</strong> <a href="{{ route('singleCategoryInvoiceShow', $bankPaymentToSupplier->bankPayment->invoice_id) }}" target="_blank" class="text-blue-600 hover:underline">{{ $bankPaymentToSupplier->bankPayment->invoice_id }} (View)</a></p>
                        </div>

                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <p><strong>Purchase Order:</strong> {{ $bankPaymentToSupplier->bankPayment->draft_purchase_order_id }} </p>
                        </div>
                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <p><strong>Bank Name:</strong> {{ $bankPaymentToSupplier->bank_name }} </p>
                        </div>

                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <p><strong>Amount Paid:</strong> {{ $bankPaymentToSupplier->amount_received }} </p>
                        </div>

                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <p><strong>Amount Date:</strong> {{ $bankPaymentToSupplier->amount_date }} </p>
                        </div>

                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <p><strong>Account Number:</strong> {{ $bankPaymentToSupplier->account_number }} </p>
                        </div>

                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <p><strong>Proof of invoice:</strong> @if(isset($bankPaymentToSupplier->file_path)) <img src="{{Storage::url($bankPaymentToSupplier->file_path)}}"> @endif </p>
                        </div>

                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                        </div>

                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                        </div>

                    </div>

                </div>
            </div>


        </div>


    </div>
</x-app-layout>
