<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bank Manual Payment for Buyer
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('users.sessionMessage')
            <!-- component -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                    <form action="{{ route('bank-payments.store') }}" method="post" class="form bg-white p-6 mb-4" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Manual Bank Payment Information</h3>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/3" for="bank_name">Bank Name</x-jet-label>
                            <x-jet-label class="w-1/3" for="amount_received">Amount Deposit</x-jet-label>
                            <x-jet-label class="w-1/3" for="account_number">Account Number</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">

                            <x-jet-input id="bank_name" type="text" name="bank_name" class="border p-2 w-1/2" required></x-jet-input>
                            <x-jet-input id="amount_received" type="text" name="amount_received" class="border p-2 w-1/2" required></x-jet-input>
                            <x-jet-input id="account_number" type="text" name="account_number" class="border p-2 w-1/2" required></x-jet-input>
                        </div>


                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="amount_date">Deposit Date</x-jet-label>
                            <x-jet-label class="w-1/2" for="file_path_1">Receipt (Proof)</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">

                            <x-jet-input id="amount_date" type="date" name="amount_date" class="border p-2 w-1/2" required></x-jet-input>
                            <x-jet-input id="file_path_1" type="file" name="file_path_1" class="border p-2 w-1/2" required></x-jet-input>
                        </div>

                        <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                        <input type="hidden" name="delivery_id" value="{{ $delivery->id }}">
                        <input type="hidden" name="draft_purchase_order_id" value="{{ $delivery->draft_purchase_order_id }}">
                        <input type="hidden" name="quote_no" value="{{ $delivery->qoute_no }}">
                        <input type="hidden" name="supplier_business_id" value="{{ $delivery->supplier_business_id }}">
                        <input type="hidden" name="supplier_user_id"   value="{{ $delivery->supplier_user_id }}">
                        <input type="hidden" name="buyer_user_id"  value="{{ $delivery->user_id }}">
                        <input type="hidden" name="buyer_business_id"   value="{{ $delivery->business_id }}">
                        
                        <x-jet-button class="float-right mt-4 mb-4 mr-4">Upload</x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
