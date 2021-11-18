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

    <h2 class="text-2xl font-bold py-2 text-center m-2">
        <br>
    </h2>

    {{-- If user is upgrading his package than @if part will be loaded else @else part will be loaded  --}}
    <form action="{{route('processPaymentCheckout')}}" method="POST">
        @csrf
        <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
        <div class="min-w-screen min-h-screen bg-gray-200 flex items-center justify-center px-5 pb-10 pt-16">
            <div class="w-full mx-auto rounded-lg bg-white shadow-lg p-5 text-gray-700" style="max-width: 600px">
                <div class="w-full pt-1 pb-5">
                    <div class="bg-white text-white overflow-hidden rounded-full w-20 h-20 -mt-16 mx-auto shadow-lg flex justify-center items-center">
                        <img src="{{ url('logo.png') }}" alt="EMDAD CHAIN LOGO" class="block h-15 "/>
                        {{--                    <i class="mdi mdi-credit-card-outline text-3xl"></i>--}}
                    </div>
                </div>
                <div class="mb-10">
                    <h1 class="text-center font-bold text-xl uppercase">{{__('portal.Secure payment info')}}</h1>
                </div>
                <div class="mb-3 flex -mx-2">
                    <div class="px-2">
                        <label for="type1" class="flex items-center cursor-pointer">
                            <input type="radio" class="form-radio h-5 w-5 text-indigo-500" name="gateway" value="mada" id="type1" checked>
                            <img src="{{url('images/mada.jpg')}}" class="h-8 ml-3">
                        </label>
                    </div>
                    <div class="px-2">
                        <label for="type2" class="flex items-center cursor-pointer">
                            <input type="radio" class="form-radio h-5 w-5 text-indigo-500" name="gateway" value="visa_master" id="type2">
                            <img src="{{url('images/visa_master.png')}}" class="h-8 ml-3">
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="font-bold text-sm mb-2 ml-1">{{__('portal.Email ID')}} *</label>
                    <div>
                        <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="{{__('portal.Email')}}" required name="customer.email" type="email"/>
                    </div>
                </div>
                <div class="mb-3">
                    <div>
                        <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="{{__('portal.Billing address')}}" required name="billing.street1" type="text"/>
                    </div>
                </div>
                <div class="mb-3 -mx-2 flex items-end">
                    <div class="px-2 w-1/2">
                        <div>
                            <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="{{__('portal.City')}}" required name="billing.city" type="text"/>
                        </div>
                    </div>
                    <div class="px-2 w-1/2">
                        <div>
                            <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="{{__('portal.State')}}" required name="billing.state" type="text"/>
                        </div>
                    </div>
                </div>
                <div class="mb-3 -mx-2 flex items-end">
                    <div class="px-2 w-1/2">
                        <label class="font-bold text-sm mb-2 ml-1">{{__('portal.Country')}}</label>
                        <div>
                            <select class="form-select w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer" required name="billing.country">
                                @foreach(\App\Models\User::countries_with_code() as $country => $code)
                                    <option value="{{$code}}" @if($country == "Saudi Arabia") selected @endif>{{$country}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="px-2 w-1/2">
                        <label class="font-bold text-sm mb-2 ml-1">{{__('portal.Postal Code')}}</label>
                        <div>
                            <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="{{__('portal.Postcode')}}" pattern="[\s\S]{1,16}" required name="billing.postcode" type="text"/>
                        </div>
                    </div>
                </div>
                <div class="mb-3 -mx-2 flex items-end">
                    <div class="px-2 w-1/2">

                        <label class="font-bold text-sm mb-2 ml-1">{{__('portal.Given Name')}}</label>
                        <div>
                            <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="{{__('portal.Given Name')}}" required name="customer.givenName" type="text"/>
                        </div>

                    </div>
                    <div class="px-2 w-1/2">
                        <label class="font-bold text-sm mb-2 ml-1">{{__('portal.Surname')}}</label>
                        <div>
                            <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="{{__('portal.Surname')}}" required name="customer.surname" type="text"/>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <button readonly disabled class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded">{{__('portal.Amount')}}: {{__('portal.SAR')}} {{number_format($invoice->total_cost,2)}}</button>
                </div>
                <div>
                    <button class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">
                        <i class="mdi mdi-lock-outline mr-1"></i>
                        {{__('portal.Proceed')}}
                    </button>
                </div>
            </div>
        </div>

    </form>


</x-app-layout>

