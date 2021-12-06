@if (auth()->user()->rtl == 0)
    <x-app-layout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                @include('users.sessionMessage')
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6">
                        <h1 class="text-center text-3xl font-bold p-4 border-t-2 bg-opacity-5 border-black border-2">{{__('portal.Payment Received Information')}}</h1>


                        <div class="flex flex-wrap -mx-1 overflow-hidden sm:-mx-px md:-mx-1 lg:-mx-1 xl:-mx-1">

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.B.Type')}}:</strong>
                                    @if($payment->package->id == 1 || $payment->package->id == 5) {{__('portal.Basic')}}@endif
                                    @if($payment->package->id == 2 || $payment->package->id == 6) {{__('portal.Silver')}}@endif
                                    @if($payment->package->id == 3 || $payment->package->id == 7) {{__('portal.Gold')}}@endif
                                    @if($payment->package->id == 4) {{__('portal.Platinum')}}@endif
                                </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Package Type')}}:</strong>
                                    @if($payment->business_type == 1)
                                        {{__('portal.Buyer')}}
                                    @elseif($payment->business_type == 2)
                                        {{__('portal.Supplier')}}
                                    @endif
                                </p>
                            </div>
                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Bank Name')}}:</strong> {{ $payment->bank_name }} </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Amount Received')}}:</strong> {{ $payment->amount_received }} </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Amount Date')}}:</strong> {{ \Carbon\Carbon::parse($payment->amount_date)->format('Y-m-d') }} </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Account Number')}}:</strong> {{ $payment->account_number }} </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Proof of invoice')}}:</strong> @if(isset($payment->receipt)) <img src="{{Storage::url($payment->receipt)}}"> @endif </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            </div>


                            @if ($payment->status == 0)
                                <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <form action="{{ route('updatePackageManualPayment', $payment->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="status" value="1">
                                        <button href="button" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-red active:bg-green-600 transition ease-in-out duration-150">
                                            {{__('portal.Confirm Payment Received')}}
                                        </button>
                                    </form>

                                </div>

                                <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <form action="{{ route('updatePackageManualPayment',$payment->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="status" value="2">
                                        <button href="button" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Business Information') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                @include('users.sessionMessage')
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6">
                        <h1 class="text-center text-3xl font-bold p-4 border-t-2 bg-opacity-5 border-black border-2">{{__('portal.Payment Received Information')}}</h1>


                        <div class="flex flex-wrap -mx-1 overflow-hidden sm:-mx-px md:-mx-1 lg:-mx-1 xl:-mx-1">

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.B.Type')}}:</strong>
                                    @if($payment->package->id == 1 || $payment->package->id == 5) {{__('portal.Basic')}}@endif
                                    @if($payment->package->id == 2 || $payment->package->id == 6) {{__('portal.Silver')}}@endif
                                    @if($payment->package->id == 3 || $payment->package->id == 7) {{__('portal.Gold')}}@endif
                                    @if($payment->package->id == 4) {{__('portal.Platinum')}}@endif
                                </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Package Type')}}:</strong>
                                    @if($payment->business_type == 1)
                                        {{__('portal.Buyer')}}
                                    @elseif($payment->business_type == 2)
                                        {{__('portal.Supplier')}}
                                    @endif
                                </p>
                            </div>
                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                @php $bank = \App\Models\Bank::where('name', $payment->bank_name)->pluck('ar_name')->first(); @endphp
                                <p><strong>{{__('portal.Bank Name')}}:</strong> {{ $bank }} </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Amount Received')}}:</strong> <span style="font-family: sans-serif">{{ $payment->amount_received }}</span>  </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Amount Date')}}:</strong> <span style="font-family: sans-serif">{{ \Carbon\Carbon::parse($payment->amount_date)->format('Y-m-d') }}</span>  </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Account Number')}}:</strong> <span style="font-family: sans-serif">{{ $payment->account_number }}</span>  </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <p><strong>{{__('portal.Proof of invoice')}}:</strong> @if(isset($payment->receipt)) <img src="{{Storage::url($payment->receipt)}}"> @endif </p>
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            </div>

                            <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            </div>


                            @if ($payment->status == 0)
                                <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <form action="{{ route('updatePackageManualPayment', $payment->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="status" value="1">
                                        <button href="button" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-red active:bg-green-600 transition ease-in-out duration-150">
                                            {{__('portal.Confirm Payment Received')}}
                                        </button>
                                    </form>

                                </div>

                                <div class="my-1 px-1 w-full overflow-hidden sm:my-px sm:px-px md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                    <form action="{{ route('updatePackageManualPayment',$payment->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="status" value="2">
                                        <button href="button" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
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
