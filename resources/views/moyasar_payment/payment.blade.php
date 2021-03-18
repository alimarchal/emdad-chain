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
    <h2 class="text-2xl font-bold py-2 text-center m-2">
        Amount: SAR {{number_format($invoice->total_cost,2)}}
    </h2>
    <style>
    .form-radio {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    -webkit-print-color-adjust: exact;
    color-adjust: exact;
    display: inline-block;
    vertical-align: middle;
    background-origin: border-box;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    flex-shrink: 0;
    border-radius: 100%;
    border-width: 2px;
    }

    .form-radio:checked {
    background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
    border-color: transparent;
    background-color: currentColor;
    background-size: 100% 100%;
    background-position: center;
    background-repeat: no-repeat;
    }

    @media not print {
    .form-radio::-ms-check {
    border-width: 1px;
    color: transparent;
    background: inherit;
    border-color: inherit;
    border-radius: inherit;
    }
    }

    .form-radio:focus {
    outline: none;
    }

    .form-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23a0aec0'%3e%3cpath d='M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z'/%3e%3c/svg%3e");
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    -webkit-print-color-adjust: exact;
    color-adjust: exact;
    background-repeat: no-repeat;
    padding-top: 0.5rem;
    padding-right: 2.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    background-position: right 0.5rem center;
    background-size: 1.5em 1.5em;
    }

    .form-select::-ms-expand {
    color: #a0aec0;
    border: none;
    }

    @media not print {
    .form-select::-ms-expand {
    display: none;
    }
    }

    @media print and (-ms-high-contrast: active), print and (-ms-high-contrast: none) {
    .form-select {
    padding-right: 0.75rem;
    }
    }
    </style>
    <form accept-charset="UTF-8" action="https://api.moyasar.com/v1/payments.html" method="POST">
        <input type="hidden" name="callback_url" value="{{route('payment.status')}}" />
        <input type="hidden" name="publishable_api_key" value="pk_test_w2wfxVNAyRe8tDF5dxeRbCaHD6eVmg6gXUHuoL3E" />

        <input type="hidden" name="amount" value="{{$invoice->total_cost * 100}}" />
        <input type="hidden" name="source[type]" value="creditcard" />
        <input type="hidden" name="description" value="{{$invoice->id}}" />

{{--        <input type="text" name="source[name]" value="Ali Raza Marchal"/>--}}
{{--        <input type="text" name="source[number]" value="4111111111111111" />--}}
{{--        <input type="text" name="source[month]" value="05" />--}}
{{--        <input type="text" name="source[year]" value="2021" />--}}
{{--        <input type="text" name="source[cvc]" value="111"/>--}}



{{--        <button type="submit">Purchase</button>--}}

        <div class="w-full mx-auto p-4 rounded-lg bg-white shadow-lg p-5 text-gray-700" style="max-width: 600px">
            <div class="w-full pt-1 pb-5">
                <div class="text-white overflow-hidden rounded-full w-20 h-20 -mt-16 mx-auto shadow-lg flex justify-center items-center">
                    <img src="{{ url('logo.png') }}" alt="EMDAD CHAIN LOGO" class="block h-9 w-auto"/>
                </div>
            </div>
            <div class="mb-10">
                <h1 class="text-center font-bold text-xl uppercase">Secure payment info</h1>
            </div>
            <div class="mb-3 flex -mx-2">
                <div class="px-2">
                    <label for="type1" class="flex items-center cursor-pointer">
                        <input type="radio" class="form-radio h-5 w-5 text-indigo-500" name="type" id="type1" checked>
                        <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" class="h-8 ml-3">
                    </label>
                </div>
{{--                <div class="px-2">--}}
{{--                    <label for="type2" class="flex items-center cursor-pointer">--}}
{{--                        <input type="radio" class="form-radio h-5 w-5 text-indigo-500" name="type" id="type2">--}}
{{--                        <img src="https://www.sketchappsources.com/resources/source-image/PayPalCard.png" class="h-8 ml-3">--}}
{{--                    </label>--}}
{{--                </div>--}}
            </div>
            <div class="mb-3">
                <label class="font-bold text-sm mb-2 ml-1">Name on card</label>
                <div>
                    <input name="source[name]" value="Ali Raza Marchal" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="John Smith" type="text"/>
                </div>
            </div>
            <div class="mb-3">
                <label class="font-bold text-sm mb-2 ml-1">Card number</label>
                <div>
                    <input name="source[number]" value="4111111111111111" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="0000 0000 0000 0000" maxlength="16" minlength="16" type="text"/>
                </div>
            </div>
            <div class="mb-3 -mx-2 flex items-end">
                <div class="px-2 w-1/2">
                    <label class="font-bold text-sm mb-2 ml-1">Expiration date</label>
                    <div>
                        <select name="source[month]" required class="form-select w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                            <option value="01">01 - January</option>
                            <option value="02">02 - February</option>
                            <option value="03">03 - March</option>
                            <option value="04">04 - April</option>
                            <option value="05" selected>05 - May</option>
                            <option value="06">06 - June</option>
                            <option value="07">07 - July</option>
                            <option value="08">08 - August</option>
                            <option value="09">09 - September</option>
                            <option value="10">10 - October</option>
                            <option value="11">11 - November</option>
                            <option value="12">12 - December</option>
                        </select>
                    </div>
                </div>
                <div class="px-2 w-1/2">
                    <label class="font-bold text-sm mb-2 ml-1">Expiration Year</label>
                    <select name="source[year]" class="form-select w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer" required>
                        <option value="2020">2020</option>
                        <option value="2021" selected>2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                    </select>
                </div>
            </div>
            <div class="mb-10">
                <label class="font-bold text-sm mb-2 ml-1">Security code</label>
                <div>
                    <input  name="source[cvc]" value="111"  maxlength="3" minlength="3" class="w-32 px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="000" type="text"/>
                </div>
            </div>
            <div>
                <button class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold"><i class="mdi mdi-lock-outline mr-1"></i> PAY NOW</button>
            </div>
        </div>
    </form>

{{--    <div class="flex flex-col bg-white rounded ">--}}
{{--        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">--}}
{{--            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">--}}
{{--                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">--}}
{{--                    <div class="w-full mx-auto rounded-lg bg-white shadow-lg p-5 text-gray-700" style="max-width: 600px">--}}
{{--                        <div class="w-full pt-1 pb-5">--}}
{{--                            <div class="bg-indigo-500 text-white overflow-hidden rounded-full w-20 h-20 -mt-16 mx-auto shadow-lg flex justify-center items-center">--}}
{{--                                <i class="mdi mdi-credit-card-outline text-3xl"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-10">--}}
{{--                            <h1 class="text-center font-bold text-xl uppercase">Secure payment info</h1>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3 flex -mx-2">--}}
{{--                            <div class="px-2">--}}
{{--                                <label for="type1" class="flex items-center cursor-pointer">--}}
{{--                                    <input type="radio" class="form-radio h-5 w-5 text-indigo-500" name="type" id="type1" checked>--}}
{{--                                    <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" class="h-8 ml-3">--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="px-2">--}}
{{--                                <label for="type2" class="flex items-center cursor-pointer">--}}
{{--                                    <input type="radio" class="form-radio h-5 w-5 text-indigo-500" name="type" id="type2">--}}
{{--                                    <img src="https://www.sketchappsources.com/resources/source-image/PayPalCard.png" class="h-8 ml-3">--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label class="font-bold text-sm mb-2 ml-1">Name on card</label>--}}
{{--                            <div>--}}
{{--                                <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="John Smith" type="text"/>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label class="font-bold text-sm mb-2 ml-1">Card number</label>--}}
{{--                            <div>--}}
{{--                                <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="0000 0000 0000 0000" type="text"/>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3 -mx-2 flex items-end">--}}
{{--                            <div class="px-2 w-1/2">--}}
{{--                                <label class="font-bold text-sm mb-2 ml-1">Expiration date</label>--}}
{{--                                <div>--}}
{{--                                    <select class="form-select w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">--}}
{{--                                        <option value="01">01 - January</option>--}}
{{--                                        <option value="02">02 - February</option>--}}
{{--                                        <option value="03">03 - March</option>--}}
{{--                                        <option value="04">04 - April</option>--}}
{{--                                        <option value="05">05 - May</option>--}}
{{--                                        <option value="06">06 - June</option>--}}
{{--                                        <option value="07">07 - July</option>--}}
{{--                                        <option value="08">08 - August</option>--}}
{{--                                        <option value="09">09 - September</option>--}}
{{--                                        <option value="10">10 - October</option>--}}
{{--                                        <option value="11">11 - November</option>--}}
{{--                                        <option value="12">12 - December</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="px-2 w-1/2">--}}
{{--                                <select class="form-select w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">--}}
{{--                                    <option value="2020">2020</option>--}}
{{--                                    <option value="2021">2021</option>--}}
{{--                                    <option value="2022">2022</option>--}}
{{--                                    <option value="2023">2023</option>--}}
{{--                                    <option value="2024">2024</option>--}}
{{--                                    <option value="2025">2025</option>--}}
{{--                                    <option value="2026">2026</option>--}}
{{--                                    <option value="2027">2027</option>--}}
{{--                                    <option value="2028">2028</option>--}}
{{--                                    <option value="2029">2029</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-10">--}}
{{--                            <label class="font-bold text-sm mb-2 ml-1">Security code</label>--}}
{{--                            <div>--}}
{{--                                <input class="w-32 px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="000" type="text"/>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <button class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold"><i class="mdi mdi-lock-outline mr-1"></i> PAY NOW</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</x-app-layout>
