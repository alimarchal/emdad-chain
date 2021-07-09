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
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bank Manual Payment
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('users.sessionMessage')

            @if ($errors->any())
                <div>
                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                    <form action="{{ route('singleCategoryUpdateSupplierPaymentStatus', $bankPayments[0]->rfq_no) }}" method="post" class="form bg-white p-6 mb-4" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Manual Payment Information</h3>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/3" for="bank_name">Bank Name</x-jet-label>
                            <x-jet-label class="w-1/3" for="amount_received">Amount to pay</x-jet-label>
                            @php
                                $supplierBusinessName = \App\Models\Business::where('id', $invoice->supplier_business_id)->first();

                                $total_amount = 0;
                                $shipmentCharges = null;
                                $vat = null;
                                // Calculating and Subtracting 1.5 % emdad charges that is applied to supplier payment
                                foreach ($bankPayments as $bankPayment)
                                {
                                    $dpo = \App\Models\DraftPurchaseOrder::where('id', $bankPayment->draft_purchase_order_id)->first();
                                    $total_amount += ($dpo->quantity * $dpo->unit_price);
                                    $shipmentCharges = $dpo->shipment_cost;
                                    $vat = $dpo->vat;
                                }
                                $total_amount +=  $shipmentCharges;
                                $emdadCharges = ($total_amount * (1.5 / 100));
                                $total_vat = ($total_amount * ($vat / 100));
                                $sum = ($total_amount + $total_vat) - $emdadCharges ;

                            @endphp
                            <x-jet-label class="w-1/3" for="account_number">{{$supplierBusinessName->business_name}}&nbsp;IBAN#</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">

                            <x-jet-input id="bank_name" type="text" name="bank_name" class="border p-2 w-1/2" value="{{$supplierBusinessName->bank_name}}" readonly required></x-jet-input>
                            <x-jet-input id="amount_received" type="text" name="amount_received" class="border p-2 w-1/2" value="{{ number_format($sum,2,'.')}}" readonly required></x-jet-input>
                            <x-jet-input id="account_number" type="text" name="account_number" class="border p-2 w-1/2" value="{{$supplierBusinessName->iban}}" readonly required></x-jet-input>
                        </div>


                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="amount_date">Deposit Date</x-jet-label>
                            <x-jet-label class="w-1/2" for="file_path_1">Receipt (Proof)</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">

                            <x-jet-input id="datepicker" placeholder="Choose Date (mm/dd/yy)"  type="text" name="amount_date" class="border p-2 w-1/2" readonly required></x-jet-input>
                            <x-jet-input id="file_path_1" type="file" name="file_path_1" class="border p-2 w-1/2" required></x-jet-input>
                        </div>

                        <x-jet-button class="float-right mt-4 mb-4 mr-4">
                            @if($bankPayments[0]->supplier_payment_status == 0)
                                Confirm
                            @elseif($bankPayments[0]->supplier_payment_status == 2)
                                Update
                            @endif
                        </x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
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
