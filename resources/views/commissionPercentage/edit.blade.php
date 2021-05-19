@section('headerScripts')
@endsection
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Commission Percentages  List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
            <a href="{{ route('adminPercentage') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                Commission Percentages List
            </a>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- component -->
            @if($errors->any())
                <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    @if($errors->first('commission_type'))<li><strong class="mr-1"> Commission For is required </strong></li> &nbsp;@endif
                    @if($errors->first('package_type'))<li><strong class="mr-1"> Package Type is required </strong></li> &nbsp;@endif
                    @if($errors->first('ire_type'))<li><strong class="mr-1"> IRE Type is required </strong></li> &nbsp;@endif
                    @if($errors->first('amount_type'))<li><strong class="mr-1"> Amount Type is required </strong></li> @endif
                    @if($errors->first('amount'))<li><strong class="mr-1"> Amount is required </strong></li> @endif
                    @if($errors->first('percentage_amount'))<li><strong class="mr-1"> Amount % is required </strong></li> @endif
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                    <form action="{{route('adminPercentageUpdate')}}" method="POST" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="commissionPercentage" value="{{encrypt($commissionPercentage->id)}}">
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Add Commission Percentages Information</h3>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="commission_type">Commission For</x-jet-label>

                            @if($commissionPercentage->commission_type == 1)
                            <x-jet-label class="w-1/2" for="package_type" id="supplier_packages-label">Package Type</x-jet-label>
                            @elseif($commissionPercentage->commission_type == 2)
                            <x-jet-label class="w-1/2" for="package_type" id="buyer_packages-label">Package Type</x-jet-label>
                            @endif

                            <x-jet-label class="w-1/2" for="package_type" id="supplier_packages-label" style="display: none">Package Type</x-jet-label>
                            <x-jet-label class="w-1/2" for="package_type" id="buyer_packages-label" style="display: none">Package Type</x-jet-label>

                            <x-jet-label class="w-1/2" for="ire_type">IRE Type</x-jet-label>
                        </div>

                        <div class="flex space-x-5 mt-3">
                            <select name="commission_type" id="commission_type" onchange="packageType()" class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{ old('commission_type') }}" required>
                                <option disabled selected value="">None</option>
                                <option {{$commissionPercentage->commission_type == '0' ? 'selected' : ''}} value="0">Sales</option>
                                <option {{$commissionPercentage->commission_type == '1' ? 'selected' : ''}} value="1">Supplier</option>
                                <option {{$commissionPercentage->commission_type == '2' ? 'selected' : ''}} value="2">Buyer</option>
                            </select>

                            @if($commissionPercentage->commission_type == 1)
                            <select id="supplier_packages" name="package_type" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option disabled selected value="">None</option>
                                <option {{$commissionPercentage->package_type == '1' ? 'selected' : ''}} value="1">Basic</option>
                                <option {{$commissionPercentage->package_type == '2' ? 'selected' : ''}} value="2">Silver</option>
                                <option {{$commissionPercentage->package_type == '3' ? 'selected' : ''}} value="3">Gold</option>
                            </select>
                             @elseif($commissionPercentage->commission_type == 2)
                            <select id="buyer_packages" name="package_type" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option disabled selected value="">None</option>
                                <option {{$commissionPercentage->package_type == '1' ? 'selected' : ''}} value="1">Basic</option>
                                <option {{$commissionPercentage->package_type == '2' ? 'selected' : ''}} value="2">Silver</option>
                                <option {{$commissionPercentage->package_type == '3' ? 'selected' : ''}} value="3">Gold</option>
                                <option {{$commissionPercentage->package_type == '4' ? 'selected' : ''}} value="4">Platinum</option>
                            </select>
                            @endif

                            <select id="supplier_packages" style="display: none" name="package_type" class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{ old('package_type') }}">
                                <option disabled selected value="">None</option>
                                <option value="1">Basic</option>
                                <option value="2">Silver</option>
                                <option value="3">Gold</option>
                            </select>
                            <select id="buyer_packages" style="display: none" name="package_type" class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{ old('package_type') }}">
                                    <option disabled selected value="">None</option>
                                    <option value="1">Basic</option>
                                    <option value="2">Silver</option>
                                    <option value="3">Gold</option>
                                    <option value="4">Platinum</option>
                                </select>

                            <select name="ire_type" id="ire_type" class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{ old('ire_type') }}" required>
                                <option selected disabled value="">None</option>
                                <option {{$commissionPercentage->ire_type == '0' ? 'selected' : ''}} value="0">Non-Employee</option>
                                <option {{$commissionPercentage->ire_type == '1' ? 'selected' : ''}} value="1">Employee</option>
                                <option {{$commissionPercentage->ire_type == '2' ? 'selected' : ''}} value="2">Indirect Referral</option>
                            </select>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="amount_type">Amount Type</x-jet-label>
                            @if($commissionPercentage->amount_type == 0)
                            <x-jet-label class="w-1/2" for="amount" id="amount-label">Amount</x-jet-label>
                            @elseif($commissionPercentage->amount_type == 1)
                            <x-jet-label class="w-1/2" for="percentage_amount" id="percentage_amount-label">Amount %</x-jet-label>
                            @endif

                            <x-jet-label class="w-1/2" for="amount" id="amount-label" style="display: none">Amount</x-jet-label>
                            <x-jet-label class="w-1/2" for="percentage_amount" id="percentage_amount-label" style="display: none">Amount %</x-jet-label>

                        </div>
                        <div class="flex space-x-5 mt-3" required>
                            <select name="amount_type" id="amount_type" class="form-input rounded-md shadow-sm border p-2 w-1/2" onchange="disable()" value="{{ old('amount_type') }}" required>
                                <option disabled selected value="">None</option>
                                <option {{$commissionPercentage->amount_type == '0' ? 'selected' : ''}} value="0">Amount</option>
                                <option {{$commissionPercentage->amount_type == '1' ? 'selected' : ''}} value="1">Percentage</option>
                            </select>

                            @if($commissionPercentage->amount_type == 0)
                                <x-jet-input id="amount" type="number" name="amount" class="border p-2 w-1/2" value="{{ $commissionPercentage->amount  }}" step="1" min="0" placeholder="Enter amount"></x-jet-input>
                            @elseif($commissionPercentage->amount_type == 1)
                                <x-jet-input id="percentage_amount" type="number" name="percentage_amount" class="border p-2 w-1/2" value="{{ $commissionPercentage->amount * 100  }}" step="0.01" min="1" placeholder="Enter amount in percentage"></x-jet-input>
                            @endif

                            <x-jet-input id="amount" type="number" name="amount" class="border p-2 w-1/2" value="{{ old('amount') }}" step="1" min="0" placeholder="Enter amount" disabled style="display: none"></x-jet-input>
                            <x-jet-input id="percentage_amount" type="number" name="percentage_amount" class="border p-2 w-1/2" value="{{ old('percentage_amount') }}" step="0.01" min="1" placeholder="Enter amount in percentage" disabled style="display: none"></x-jet-input>

                        </div>
                        <br>

                        <x-jet-button class="float-right mt-4 mb-4">Update</x-jet-button>

                    </form>

                </div>
            </div>


        </div>


    </div>
</x-app-layout>

<script>

    function packageType()
    {
        let value = $( "select#commission_type option:checked" ).val();
        if (value == 1)
        {
            $('#supplier_packages').show();
            $('#buyer_packages').hide();
            $('#supplier_packages-label').show();
            $('#buyer_packages-label').hide();
        }
        else if(value == 2){
            $('#buyer_packages').show();
            $('#supplier_packages').hide();
            $('#buyer_packages-label').show();
            $('#supplier_packages-label').hide();
        }
        else if(value == 0){
            $('#buyer_packages').hide();
            $('#supplier_packages').hide();
            $('#buyer_packages-label').hide();
            $('#supplier_packages-label').hide();
        }
    }

    function disable()
    {
        let value = $( "select#amount_type option:checked" ).val();
        // let value = $( "#amount_type" ).val();
        if (value == 0)
        {
            $('#percentage_amount').hide();
            $('#percentage_amount-label').hide();
            $('#amount').show();
            $('#amount-label').show();
            $('#amount').removeAttr('disabled');
        }
        else if(value == 1){
            $('#amount').hide();
            $('#amount-label').hide();
            $('#percentage_amount').show();
            $('#percentage_amount-label').show();
            $('#percentage_amount').removeAttr('disabled');
        }
    }
</script>
