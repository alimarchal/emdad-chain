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
            @include('users.sessionMessage')
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6">
                    <h1 class="text-center text-3xl font-bold p-4 border-t-2 bg-opacity-5 border-black border-2"> Payment Received Information</h1>


                    <div class="flex flex-wrap -mx-1 overflow-hidden sm:-mx-px md:-mx-1 lg:-mx-1 xl:-mx-1">

                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <p><strong>Invoice Number:</strong> <a href="{{ route('invoice.show', $bankPayment->invoice_id) }}" target="_blank" class="text-blue-600 hover:underline">{{ $bankPayment->invoice_id }} (View)</a></p>
                        </div>

                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <p><strong>Purchase Order:</strong> {{ $bankPayment->draft_purchase_order_id }} </p>
                        </div>
                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <p><strong>Bank Name:</strong> {{ $bankPayment->bank_name }} </p>
                        </div>

                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <p><strong>Amount Received:</strong> {{ $bankPayment->amount_received }} </p>
                        </div>

                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <p><strong>Amount Date:</strong> {{ $bankPayment->amount_date }} </p>
                        </div>

                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <p><strong>Account Number:</strong> {{ $bankPayment->account_number }} </p>
                        </div>

                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <p><strong>Proof of invoice:</strong> <img src="{{\Illuminate\Support\Facades\Storage::path('public/'.$bankPayment->file_path)}}"> </p>
{{--                            <p><strong>Proof of invoice:</strong> <img src="{{asset('storage/app/public/'.$bankPayment->file_path)}}"> </p>--}}
{{--                            <p><strong>Proof of invoice:</strong> <img src="{{\Illuminate\Support\Facades\Storage::disk('public')->get($bankPayment->file_path)}}"> </p>--}}
                        </div>

                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                        </div>

                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                        </div>


                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <form action="{{ route('bank-payments.update',$bankPayment->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="status" value="3">
                                <button href="button" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-red active:bg-green-600 transition ease-in-out duration-150" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                                    Confirmed Payment Received
                                </button>
                            </form>

                        </div>

                        <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <form action="{{ route('bank-payments.update',$bankPayment->id) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="status" value="2">
                            <button href="button" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                                Reject Payment Not Received
                            </button>
                        </form>
                        </div>

                    </div>

                </div>
            </div>


        </div>


    </div>
</x-app-layout>
