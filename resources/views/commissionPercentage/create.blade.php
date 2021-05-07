@section('headerScripts')
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                    <form action="{{route('adminPercentageStore')}}" method="POST" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Add Commission Percentages Information</h3>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="commission_type">Commission For</x-jet-label>
                            <x-jet-label class="w-1/2" for="package_type" id="supplier_packages-label" style="display: none">Package Type</x-jet-label>
                            <x-jet-label class="w-1/2" for="package_type" id="buyer_packages-label" style="display: none">Package Type</x-jet-label>
                            <x-jet-label class="w-1/2" for="ire_type">IRE Type</x-jet-label>
                        </div>

                        <div class="flex space-x-5 mt-3">
                            <select name="commission_type" id="commission_type" onchange="packageType()" class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{ old('commission_type') }}" required>
                                <option disabled selected value="">None</option>
                                <option value="0">Sales</option>
                                <option value="1">Supplier</option>
                                <option value="2">Buyer</option>
                            </select>
                            <select id="supplier_packages" style="display: none" name="package_type" class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{ old('package_type') }}">
                                <option disabled selected value="">None</option>
                                <option value="0">Basic</option>
                                <option value="1">Silver</option>
                                <option value="2">Gold</option>
                            </select>
                            <select id="buyer_packages" style="display: none" name="package_type" class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{ old('package_type') }}">
                                <option disabled selected value="">None</option>
                                <option value="0">Basic</option>
                                <option value="1">Silver</option>
                                <option value="2">Gold</option>
                                <option value="3">Platinum</option>
                            </select>
                            <select name="ire_type" id="ire_type" class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{ old('ire_type') }}">
                                <option value="">None</option>
                                <option value="0">Employee</option>
                                <option value="1">Non-Employee</option>
                                <option value="2">Indirect Referral</option>
                            </select>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="amount_type">Amount Type</x-jet-label>
                            <x-jet-label class="w-1/2" for="amount">Amount(Select if amount type Amount selected)</x-jet-label>
                            <x-jet-label class="w-1/2" for="amount">Amount(Select if amount type Percentage selected)</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3" required>
                            <select name="amount_type" id="amount_type" class="form-input rounded-md shadow-sm border p-2 w-1/2" onchange="disable()" value="{{ old('amount_type') }}" required>
                                <option disabled selected value="">None</option>
                                <option value="0">Amount</option>
                                <option value="1">Percentage</option>
                            </select>
                            <select name="amount" id="js-example-basic-single-amount" class="form-input rounded-md shadow-sm border p-2 w-1/2" style="width: 50%" value="{{ old('amount') }}" required disabled>
                                @php $amounts = range(0, 6000, 5); @endphp
                                @foreach($amounts as $amount)
                                    <option value="{{$amount}}">{{$amount}}</option>
                                @endforeach
                            </select>
                            <select name="amount" id="js-example-basic-single-percentage" class="form-input rounded-md shadow-sm border p-2 w-1/2" style="width: 50%" value="{{ old('amount') }}" required disabled>
                                @php $amounts = range(1, 100, 1); @endphp
                                @foreach($amounts as $amount)
                                    <option value="{{$amount}}">{{$amount}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>

                        <x-jet-button class="float-right mt-4 mb-4">Create</x-jet-button>

                    </form>

                </div>
            </div>


        </div>


    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#js-example-basic-single-amount').select2();
        $('#js-example-basic-single-percentage').select2();
    });

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
            $('#js-example-basic-single-amount').select2('enable', [ true ]);
            $('#js-example-basic-single-percentage').select2('enable', [ false ]);
        }
        else if(value == 1){
            $('#js-example-basic-single-percentage').select2('enable', [ true ]);
            $('#js-example-basic-single-amount').select2('enable', [ false ]);
        }
    }
</script>
