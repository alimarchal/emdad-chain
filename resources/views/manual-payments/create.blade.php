@section('headerScripts')
    <style>
        #datepicker {
            padding: 10px;
            cursor: default;
            /*text-transform: uppercase;*/
            font-size: 13px;
            background: #FFFFFF;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            border: solid 1px #d2d6dc;
            box-shadow: none;
        }

        table {
            font-size: 1em;
        }
        .ui-draggable, .ui-droppable {
            background-position: top;
        }
    </style>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>
@endsection

@if(auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{__('portal.Bank Manual Payment for Buyer')}} </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('users.sessionMessage')

                @if ($errors->any())
                    <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="text-center text-red-600 mr-5">
                    <span class="text-center text-red-600 mr-5">{{__('portal.Payment to be paid to Emdad')}}</span>
                </div>

                @if(isset($delivery))
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                            <form action="{{ route('bank-payments.store') }}" method="post" class="form bg-white p-6 mb-4" enctype="multipart/form-data">
                                @csrf
                                <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Manual Payment Information')}}</h3>
                                <div class="flex space-x-5 mt-3">
                                    <x-jet-label class="w-1/3" for="bank_name">{{__('portal.Bank Name')}}</x-jet-label>
                                    <x-jet-label class="w-1/3" for="amount_received">{{__('portal.Amount to pay')}}</x-jet-label>
                                    {{-- Emdad IBAN #--}}
                                    <x-jet-label class="w-1/3" for="account_number">{{__('portal.Emdad IBAN #')}}</x-jet-label>
                                </div>
                                <div class="flex space-x-5 mt-3">
                                    <x-jet-input id="bank_name" type="text" name="bank_name" class="border p-2 w-1/2" value="Alinma Bank" readonly required></x-jet-input>
                                    <x-jet-input id="amount_received" type="text" name="amount_received" class="border p-2 w-1/2" value="{{$invoice->total_cost}}" readonly required></x-jet-input>
                                    <x-jet-input id="account_number" type="text" name="account_number" class="border p-2 w-1/2" value="SA2605000068203048310001" readonly required></x-jet-input>
                                </div>

                                <div class="flex space-x-5 mt-3">
                                    <x-jet-label class="w-1/2" for="amount_date">{{__('portal.Deposit Date')}}</x-jet-label>
                                    <x-jet-label class="w-1/2" for="file_path_1">{{__('portal.Receipt (Proof)')}}</x-jet-label>
                                </div>
                                <div class="flex space-x-5 mt-3">

                                    <x-jet-input  id="datepicker" placeholder="{{__('portal.Choose Date')}} (mm/dd/yy)"   type="text" name="amount_date" readonly class="border p-2 w-1/2" required></x-jet-input>
                                    <x-jet-input id="file_path_1" type="file" name="file_path_1" class="border p-2 w-1/2" required></x-jet-input>
                                </div>

                                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                <input type="hidden" name="delivery_id" value="{{ $delivery->id }}">
                                <input type="hidden" name="draft_purchase_order_id" value="{{ $delivery->draft_purchase_order_id }}">
                                <input type="hidden" name="quote_no" value="{{ $delivery->qoute_no }}">
                                <input type="hidden" name="rfq_no" value="{{ $delivery->rfq_no }}">
                                <input type="hidden" name="supplier_business_id" value="{{ $delivery->supplier_business_id }}">
                                <input type="hidden" name="supplier_user_id" value="{{ $delivery->supplier_user_id }}">
                                <input type="hidden" name="buyer_user_id" value="{{ $delivery->user_id }}">
                                <input type="hidden" name="buyer_business_id" value="{{ $delivery->business_id }}">

                                <x-jet-button class="float-right mt-4 mb-4 mr-4">{{__('portal.Confirm')}}</x-jet-button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                            <form action="{{ route('bank-payments.store') }}" method="post" class="form bg-white p-6 mb-4" enctype="multipart/form-data">
                                @csrf
                                <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Manual Payment Information')}}</h3>
                                <div class="flex space-x-5 mt-3">
                                    <x-jet-label class="w-1/3" for="bank_name">{{__('portal.Bank Name')}}</x-jet-label>
                                    <x-jet-label class="w-1/3" for="amount_received">{{__('portal.Amount to pay')}}</x-jet-label>
                                    {{-- Emdad IBAN #--}}
                                    <x-jet-label class="w-1/3" for="account_number">{{__('portal.Emdad IBAN #')}}</x-jet-label>
                                </div>
                                <div class="flex space-x-5 mt-3">
                                    <x-jet-input id="bank_name" type="text" name="bank_name" class="border p-2 w-1/2" value="Alinma Bank" readonly required></x-jet-input>
                                    <x-jet-input id="amount_received" type="text" name="amount_received" class="border p-2 w-1/2" value="{{$invoice->total_cost}}" readonly required></x-jet-input>
                                    <x-jet-input id="account_number" type="text" name="account_number" class="border p-2 w-1/2" value="SA2605000068203048310001" readonly required></x-jet-input>
                                </div>


                                <div class="flex space-x-5 mt-3">
                                    <x-jet-label class="w-1/2" for="amount_date">{{__('portal.Deposit Date')}}</x-jet-label>
                                    <x-jet-label class="w-1/2" for="file_path_1">{{__('portal.Receipt (Proof)')}}</x-jet-label>
                                </div>
                                <div class="flex space-x-5 mt-3">

                                    <x-jet-input  id="datepicker" placeholder="{{__('portal.Choose Date')}} (mm/dd/yy)"  type="text" name="amount_date" readonly class="border p-2 w-1/2" required></x-jet-input>
                                    <x-jet-input id="file_path_1" type="file" name="file_path_1" class="border p-2 w-1/2" required></x-jet-input>
                                </div>

                                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                <input type="hidden" name="draft_purchase_order_id" value="{{ $invoice->draft_purchase_order_id }}">
                                <input type="hidden" name="quote_no" value="{{ $invoice->qoute_no }}">
                                <input type="hidden" name="rfq_no" value="{{ $invoice->rfq_no }}">
                                <input type="hidden" name="supplier_business_id" value="{{ $invoice->supplier_business_id }}">
                                <input type="hidden" name="supplier_user_id" value="{{ $invoice->supplier_user_id }}">
                                <input type="hidden" name="buyer_user_id" value="{{ $invoice->buyer_user_id }}">
                                <input type="hidden" name="buyer_business_id" value="{{ $invoice->buyer_business_id }}">

                                <x-jet-button class="float-right mt-4 mb-4 mr-4">{{__('portal.Confirm')}}</x-jet-button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{__('portal.Bank Manual Payment for Buyer')}} </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('users.sessionMessage')

                @if ($errors->any())
                    <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="text-center text-red-600 mr-5">
                    <span class="text-center text-red-600 mr-5">{{__('portal.Payment to be paid to Emdad')}}</span>
                </div>

                @if(isset($delivery))
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                            <form action="{{ route('bank-payments.store') }}" method="post" class="form bg-white p-6 mb-4" enctype="multipart/form-data">
                                @csrf
                                <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Manual Payment Information')}}</h3>
                                <div class="flex space-x-5 mt-3">
                                    <x-jet-label class="w-1/3" for="bank_name">{{__('portal.Bank Name')}}</x-jet-label>
                                    <x-jet-label class="w-1/3" for="amount_received">{{__('portal.Amount to pay')}}</x-jet-label>
                                    {{-- Emdad IBAN #--}}
                                    <x-jet-label class="w-1/3" for="account_number">{{__('portal.Emdad IBAN #')}}</x-jet-label>
                                </div>
                                <div class="flex space-x-5 mt-3">
                                    <x-jet-input id="bank_name" type="text" name="bank_name" class="border p-2 w-1/2" value="بنك الإنماء" readonly required></x-jet-input>
                                    <x-jet-input id="amount_received" type="text" name="amount_received" class="border p-2 w-1/2" value="{{$invoice->total_cost}}" readonly required></x-jet-input>
                                    <x-jet-input id="account_number" type="text" name="account_number" class="border p-2 w-1/2" value="SA2605000068203048310001" readonly required></x-jet-input>
                                </div>


                                <div class="flex space-x-5 mt-3">
                                    <x-jet-label class="w-1/2" for="amount_date">{{__('portal.Deposit Date')}}</x-jet-label>
                                    <x-jet-label class="w-1/2" for="file_path_1">{{__('portal.Receipt (Proof)')}}</x-jet-label>
                                </div>
                                <div class="flex space-x-5 mt-3">

                                    <x-jet-input  id="datepicker" placeholder="{{__('portal.Choose Date')}} (mm/dd/yy)"  type="text" name="amount_date" readonly class="border p-2 w-1/2" required></x-jet-input>
                                    <x-jet-input id="file_path_1" type="file" name="file_path_1" class="border p-2 w-1/2" style="margin-right: 7px;"  required></x-jet-input>
                                </div>

                                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                <input type="hidden" name="delivery_id" value="{{ $delivery->id }}">
                                <input type="hidden" name="draft_purchase_order_id" value="{{ $delivery->draft_purchase_order_id }}">
                                <input type="hidden" name="quote_no" value="{{ $delivery->qoute_no }}">
                                <input type="hidden" name="rfq_no" value="{{ $delivery->rfq_no }}">
                                <input type="hidden" name="supplier_business_id" value="{{ $delivery->supplier_business_id }}">
                                <input type="hidden" name="supplier_user_id" value="{{ $delivery->supplier_user_id }}">
                                <input type="hidden" name="buyer_user_id" value="{{ $delivery->user_id }}">
                                <input type="hidden" name="buyer_business_id" value="{{ $delivery->business_id }}">

                                <x-jet-button class="float-right mt-4 mb-4 mr-4">{{__('portal.Confirm')}}</x-jet-button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                            <form action="{{ route('bank-payments.store') }}" method="post" class="form bg-white p-6 mb-4" enctype="multipart/form-data">
                                @csrf
                                <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Manual Payment Information')}}</h3>
                                <div class="flex space-x-5 mt-3">
                                    <x-jet-label class="w-1/3" for="bank_name">{{__('portal.Bank Name')}}</x-jet-label>
                                    <x-jet-label class="w-1/3" for="amount_received">{{__('portal.Amount to pay')}}</x-jet-label>
                                    {{-- Emdad IBAN #--}}
                                    <x-jet-label class="w-1/3" for="account_number">{{__('portal.Emdad IBAN #')}}</x-jet-label>
                                </div>
                                <div class="flex space-x-5 mt-3">
                                    <x-jet-input id="bank_name" type="text" name="bank_name" class="border p-2 w-1/2" value="بنك الإنماء" readonly required></x-jet-input>
                                    <x-jet-input id="amount_received" type="text" name="amount_received" class="border p-2 w-1/2" value="{{$invoice->total_cost}}" readonly required></x-jet-input>
                                    <x-jet-input id="account_number" type="text" name="account_number" class="border p-2 w-1/2" value="SA2605000068203048310001" readonly required></x-jet-input>
                                </div>


                                <div class="flex space-x-5 mt-3">
                                    <x-jet-label class="w-1/2" for="amount_date">{{__('portal.Deposit Date')}}</x-jet-label>
                                    <x-jet-label class="w-1/2" for="file_path_1">{{__('portal.Receipt (Proof)')}}</x-jet-label>
                                </div>
                                <div class="flex space-x-5 mt-3">

                                    <x-jet-input  id="datepicker" placeholder="{{__('portal.Choose Date')}} (mm/dd/yy)"  type="text" name="amount_date" readonly class="border p-2 w-1/2" required></x-jet-input>
                                    <x-jet-input id="file_path_1" type="file" name="file_path_1" class="border p-2 w-1/2" style="margin-right: 7px;" required></x-jet-input>
                                </div>

                                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                <input type="hidden" name="draft_purchase_order_id" value="{{ $invoice->draft_purchase_order_id }}">
                                <input type="hidden" name="quote_no" value="{{ $invoice->qoute_no }}">
                                <input type="hidden" name="rfq_no" value="{{ $invoice->rfq_no }}">
                                <input type="hidden" name="supplier_business_id" value="{{ $invoice->supplier_business_id }}">
                                <input type="hidden" name="supplier_user_id" value="{{ $invoice->supplier_user_id }}">
                                <input type="hidden" name="buyer_user_id" value="{{ $invoice->buyer_user_id }}">
                                <input type="hidden" name="buyer_business_id" value="{{ $invoice->buyer_business_id }}">

                                <x-jet-button class="float-right mt-4 mb-4 mr-4">{{__('portal.Confirm')}}</x-jet-button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </x-app-layout>
@endif

<script>
    $(function () {
        $("#datepicker").datepicker({
            dateFormat: 'mm/dd/yy',
            changeMonth: true,
            changeYear: true,
            yearRange: '-100y:c+nn',
            // maxDate: '-1d'
            clear: true,
        });
    });
</script>
