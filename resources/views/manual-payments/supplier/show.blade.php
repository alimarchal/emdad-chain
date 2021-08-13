@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Manual Payment Information') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6">
                        <h1 class="text-center text-3xl font-bold p-4 border-t-2 bg-opacity-5 border-black border-2"> {{__('portal.Payment Received Information')}}</h1>


                        <div class="flex flex-wrap -mx-1 overflow-hidden sm:-mx-px md:-mx-1 lg:-mx-1 xl:-mx-1">

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Invoice Number')}}:</strong> <a href="{{ route('invoice.show', $supplierBankPayment->bankPayment->invoice_id) }}" target="_blank" class="text-blue-600 hover:underline">{{ $supplierBankPayment->bankPayment->invoice_id }} ({{__('portal.View')}})</a></p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Purchase Order')}}:</strong> {{ $supplierBankPayment->bankPayment->draft_purchase_order_id }} </p>
                            </div>
                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Bank Name')}}:</strong> {{ $supplierBankPayment->bank_name }} </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Amount Received')}}:</strong> {{ number_format($supplierBankPayment->amount_received,2) }} </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Amount Date')}}:</strong> {{ $supplierBankPayment->amount_date }} </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Account Number')}}:</strong> {{ $supplierBankPayment->account_number }} </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Proof of invoice')}}:</strong> @if(isset($supplierBankPayment->file_path)) <img src="{{Storage::url($supplierBankPayment->file_path)}}"> @endif </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            </div>


                            @if ($supplierBankPayment->status == 1)
                                <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <form action="{{ route('update_bank_payment', $supplierBankPayment->bankPayment->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="status" value="3">
                                        <button href="button"
                                                class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-red active:bg-green-600 transition ease-in-out duration-150">
                                            {{__('portal.Confirm Payment Received')}}
                                        </button>
                                    </form>

                                </div>

                                <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <form action="{{ route('update_bank_payment',$supplierBankPayment->bankPayment->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="status" value="2">
                                        <button href="button"
                                                class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150"
                                                wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                                            {{__('portal.Reject Payment Not Received')}}
                                        </button>
                                    </form>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Manual Payment Information') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6">
                        <h1 class="text-center text-3xl font-bold p-4 border-t-2 bg-opacity-5 border-black border-2"> {{__('portal.Payment Received Information')}}</h1>


                        <div class="flex flex-wrap -mx-1 overflow-hidden sm:-mx-px md:-mx-1 lg:-mx-1 xl:-mx-1">

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Invoice Number')}}:</strong> <a href="{{ route('invoice.show', $supplierBankPayment->bankPayment->invoice_id) }}" target="_blank" class="text-blue-600 hover:underline">{{ $supplierBankPayment->bankPayment->invoice_id }} ({{__('portal.View')}})</a></p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Purchase Order')}}:</strong> {{ $supplierBankPayment->bankPayment->draft_purchase_order_id }} </p>
                            </div>
                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Bank Name')}}:</strong>
                                    @php $bankName = \App\Models\Bank::where('name', $supplierBankPayment->bank_name)->pluck('ar_name')->first(); @endphp
                                    {{ $bankName }}
{{--                                    {{ $supplierBankPayment->bank_name }} --}}
                                </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Amount Received')}}:</strong> {{ number_format($supplierBankPayment->amount_received,2) }} </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Amount Date')}}:</strong> {{ $supplierBankPayment->amount_date }} </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Account Number')}}:</strong> {{ $supplierBankPayment->account_number }} </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Proof of invoice')}}:</strong> @if(isset($supplierBankPayment->file_path)) <img src="{{Storage::url($supplierBankPayment->file_path)}}"> @endif </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            </div>


                            @if ($supplierBankPayment->status == 1)
                                <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <form action="{{ route('update_bank_payment', $supplierBankPayment->bankPayment->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="status" value="3">
                                        <button href="button"
                                                class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-red active:bg-green-600 transition ease-in-out duration-150">
                                            {{__('portal.Confirm Payment Received')}}
                                        </button>
                                    </form>

                                </div>

                                <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <form action="{{ route('update_bank_payment',$supplierBankPayment->bankPayment->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="status" value="2">
                                        <button href="button"
                                                class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150"
                                                wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                                            {{__('portal.Reject Payment Not Received')}}
                                        </button>
                                    </form>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif
