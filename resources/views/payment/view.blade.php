@if (auth()->user()->rtl == 0)
    <x-app-layout>
        @if (session()->has('error'))
            <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" style="margin-top: 10px;" role="alert">
                <strong class="mr-1">{{ session('error') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>

        @elseif (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" style="margin-top: 10px;" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif

        {{--Multi Categories Routes--}}
        <div class="mt-4">

            <div class="md:flex flex-1 rounded-md bg-white">

                {{--For Supplier--}}
                @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO|Supplier Payment Admin') && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)
                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500" ><a href="{{route('payment.index')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-700 active:bg-blue-600 transition ease-in-out duration-150">{{__('portal.Generate invoice')}}</a></div>
                            </div>
                        </div>
                    </div>

                @endif

                {{--For Both--}}
                @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO|Supplier Payment Admin|Buyer Payment Admin') && Auth::user()->status == 3)
                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500"><a href="{{route('invoices')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-700 active:bg-blue-600 transition ease-in-out duration-150">{{__('portal.Invoices History')}}</a></div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500"><a href="{{route('bank-payments.index')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-700 active:bg-blue-600 transition ease-in-out duration-150">{{__('portal.Unpaid Invoices')}}</a></div>
                            </div>
                        </div>
                    </div>
                @endif

                {{--For Supplier--}}
                @if(auth()->user()->hasRole('CEO|Supplier Payment Admin') && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)
                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500"><a href="{{route('emdadInvoices')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-700 active:bg-blue-600 transition ease-in-out duration-150">{{__('portal.Emdad Invoices')}}</a></div>
                            </div>
                        </div>
                    </div>

                    {{--<div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500"><a href="{{route('supplier_payment_received')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-700 active:bg-blue-600 transition ease-in-out duration-150">{{__('portal.Manual Payments')}}</a></div>
                            </div>
                        </div>
                    </div>--}}
                @endif

            </div>

        </div>

    </x-app-layout>
@else
    <x-app-layout>
        @if (session()->has('error'))
            <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" style="margin-top: 10px;" role="alert">
                <strong class="mr-1">{{ session('error') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>

        @elseif (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" style="margin-top: 10px;" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif

        {{--Multi Categories Routes--}}
        {{--<div class="mt-4">

            <div class="flex flex-wrap overflow-hidden lg:-mx-2 xl:-mx-1 ">

                <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/2 xl:my-1 xl:px-1 xl:w-screen ">
                    <span>Multiple Categories</span>
                    <div class="md:flex flex-1 rounded-md bg-white">


                        --}}{{--For Supplier--}}{{--
                        @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)
                            <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3">
                                <div class="items-center text-center px-2 py-6  ">

                                    <div class="mx-5">
                                        <div class="text-gray-500">
                                            <a href="{{route('payment.index')}}"
                                               class="inline-flex items-center justify-center px-4  py-3  bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-500 active:bg-blue-500 transition ease-in-out duration-150">Generate
                                                invoice
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                                <div class="items-center text-center px-2 py-6  ">

                                    <div class="mx-5">
                                        <div class="text-gray-500">
                                            <a href="{{route('generate_proforma_invoices')}}"
                                               class="inline-flex items-center justify-center px-4  py-3  bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-500 active:bg-blue-500 transition ease-in-out duration-150">Generate
                                                Proforma Invoice</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        --}}{{--For Both--}}{{--
                        @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO')  && Auth::user()->status == 3)
                            <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                                <div class="items-center text-center px-2 py-6  ">

                                    <div class="mx-5">
                                        <div class="text-gray-500"><a href="{{route('invoices')}}"
                                                                      class="inline-flex items-center justify-center px-4  py-3  bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-500 active:bg-blue-500 transition ease-in-out duration-150">Invoices
                                                History</a></div>
                                    </div>
                                </div>
                            </div>

                            <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                                <div class="items-center text-center px-2 py-6  ">

                                    <div class="mx-5">
                                        <div class="text-gray-500"><a href="{{route('bank-payments.index')}}"
                                                                      class="inline-flex items-center justify-center px-4  py-3  bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-500 active:bg-blue-500 transition ease-in-out duration-150">Unpaid
                                                Invoices</a></div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        --}}{{--For Buyer--}}{{--
                        @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Buyer" && Auth::user()->status == 3)
                            <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                                <div class="items-center text-center px-2 py-6  ">

                                    <div class="mx-5">
                                        <div class="text-gray-500"><a href="{{route('proforma_invoices')}}"
                                                                      class="inline-flex items-center justify-center px-4  py-3  bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-500 active:bg-blue-500 transition ease-in-out duration-150">Proforma
                                                Invoices</a></div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        --}}{{--For Supplier--}}{{--
                        @if(auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)
                            <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                                <div class="items-center text-center px-2 py-6  ">

                                    <div class="mx-5">
                                        <div class="text-gray-500"><a href="{{route('emdadInvoices')}}"
                                                                      class="inline-flex items-center justify-center px-4  py-3  bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-500 active:bg-blue-500 transition ease-in-out duration-150">Emdad
                                                Invoices</a></div>
                                    </div>
                                </div>
                            </div>

                            <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                                <div class="items-center text-center px-2 py-6  ">

                                    <div class="mx-5">
                                        <div class="text-gray-500"><a href="{{route('supplier_payment_received')}}"
                                                                      class="inline-flex items-center justify-center px-4  py-3  bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-500 active:bg-blue-500 transition ease-in-out duration-150">Manual
                                                Payments</a></div>
                                    </div>
                                </div>
                            </div>
                        @endif


                    </div>
                </div>

                <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/2 xl:my-1 xl:px-1 xl:w-screen">
                    <span>Single Category</span>
                    <div class="md:flex flex-1 rounded-md bg-white">

                        --}}{{--For Supplier--}}{{--
                        @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)
                            <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3">
                                <div class="items-center text-center px-2 py-6  ">

                                    <div class="mx-5">
                                        <div class="text-gray-500"><a href="{{route('singleCategoryPaymentIndex')}}"
                                         class="inline-flex items-center justify-center px-4  py-3  bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-500 active:bg-blue-500 transition ease-in-out duration-150">Generate
                                                invoice</a></div>
                                    </div>
                                </div>
                            </div>

                            <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                                <div class="items-center text-center px-2 py-6  ">

                                    <div class="mx-5">
                                        <div class="text-gray-500">
                                            <a href="{{route('singleCategoryGenerateProformaInvoiceView')}}"
                                               class="inline-flex items-center justify-center px-4  py-3  bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-500 active:bg-blue-500 transition ease-in-out duration-150">Generate
                                                Proforma Invoice</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        --}}{{--For Both--}}{{--
                        @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO')  && Auth::user()->status == 3)
                            <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                                <div class="items-center text-center px-2 py-6  ">

                                    <div class="mx-5">
                                        <div class="text-gray-500"><a href="{{route('singleCategoryInvoices')}}"
                                                                      class="inline-flex items-center justify-center px-4  py-3  bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-500 active:bg-blue-500 transition ease-in-out duration-150">Invoices
                                                History</a></div>
                                    </div>
                                </div>
                            </div>

                            <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                                <div class="items-center text-center px-2 py-6  ">

                                    <div class="mx-5">
                                        <div class="text-gray-500"><a href="{{route('singleCategoryBankPaymentIndex')}}"
                                                                      class="inline-flex items-center justify-center px-4  py-3  bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-500 active:bg-blue-500 transition ease-in-out duration-150">Unpaid
                                                Invoices</a></div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        --}}{{--For Buyer--}}{{--
                        @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Buyer" && Auth::user()->status == 3)
                            <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                                <div class="items-center text-center px-2 py-6  ">

                                    <div class="mx-5">
                                        <div class="text-gray-500"><a href="{{route('singleCategoryProformaInvoices')}}"
                                             class="inline-flex items-center justify-center px-4  py-3  bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-500 active:bg-blue-500 transition ease-in-out duration-150">Proforma
                                                Invoices</a></div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        --}}{{--For Supplier--}}{{--
                        @if(auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)
                            <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                                <div class="items-center text-center px-2 py-6  ">

                                    <div class="mx-5">
                                        <div class="text-gray-500"><a href="{{route('singleCategoryEmdadInvoicesIndex')}}"
                              class="inline-flex items-center justify-center px-4  py-3  bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-500 active:bg-blue-500 transition ease-in-out duration-150">
                                                Emdad
                                                Invoices</a></div>
                                    </div>
                                </div>
                            </div>

                            <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                                <div class="items-center text-center px-2 py-6  ">

                                    <div class="mx-5">
                                        <div class="text-gray-500">
                                            <a href="{{route('singleCategorySupplierPaymentsReceived')}}"
                                        class="inline-flex items-center justify-center px-4  py-3  bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-500 active:bg-blue-500 transition ease-in-out duration-150">Manual
                                                Payments</a></div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>
            </div>

        </div>--}}

        {{--Multi Categories Routes--}}
        <div class="mt-4">

{{--            <span>{{__('portal.Multiple Categories')}}</span>--}}
            <div class="md:flex flex-1 rounded-md bg-white">

                {{--For Supplier--}}
                @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO|Supplier Payment Admin') && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)
                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500" ><a href="{{route('payment.index')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none transition ease-in-out duration-150">{{__('portal.Generate invoice')}}</a></div>
                            </div>
                        </div>
                    </div>

                    {{--<div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500">
                                    <a href="{{route('generate_proforma_invoices')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none transition ease-in-out duration-150">{{__('portal.Generate Proforma Invoice')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                @endif

                {{--For Both--}}
                @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO|Supplier Payment Admin|Buyer Payment Admin')  && Auth::user()->status == 3)
                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500"><a href="{{route('invoices')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none transition ease-in-out duration-150">{{__('portal.Invoices History')}}</a></div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500"><a href="{{route('bank-payments.index')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none transition ease-in-out duration-150">{{__('portal.Unpaid Invoices')}}</a></div>
                            </div>
                        </div>
                    </div>
                @endif

                {{--For Buyer--}}
                @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Buyer" && Auth::user()->status == 3)
                    {{--<div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500"><a href="{{route('proforma_invoices')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none transition ease-in-out duration-150">{{__('portal.Proforma Invoices')}}</a></div>
                            </div>
                        </div>
                    </div>--}}
                @endif

                {{--For Supplier--}}
                @if(auth()->user()->hasRole('CEO|Supplier Payment Admin') && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)
                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500"><a href="{{route('emdadInvoices')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none transition ease-in-out duration-150">{{__('portal.Emdad Invoices')}}</a></div>
                            </div>
                        </div>
                    </div>

                    {{--<div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500"><a href="{{route('supplier_payment_received')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none transition ease-in-out duration-150">{{__('portal.Manual Payments')}}</a></div>
                            </div>
                        </div>
                    </div>--}}
                @endif

            </div>

        </div>

        {{--Single Category Routes--}}
        {{--<div class="mt-4">

            <span>{{__('portal.Single Category')}}</span>
            <div class="md:flex flex-1 rounded-md bg-white">

                --}}{{--For Supplier--}}{{--
                @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)
                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500" ><a href="{{route('singleCategoryPaymentIndex')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none transition ease-in-out duration-150">{{__('portal.Generate invoice')}}</a></div>
                            </div>
                        </div>
                    </div>

                    --}}{{--<div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 sm:mt-0">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500">
                                    <a href="{{route('singleCategoryGenerateProformaInvoiceView')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none transition ease-in-out duration-150">{{__('portal.Generate Proforma Invoice')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>--}}{{--
                @endif

                --}}{{--For Both--}}{{--
                @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO')  && Auth::user()->status == 3)
                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500"><a href="{{route('singleCategoryInvoices')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none transition ease-in-out duration-150">{{__('portal.Invoices History')}}</a></div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500"><a href="{{route('singleCategoryBankPaymentIndex')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none transition ease-in-out duration-150">{{__('portal.Unpaid Invoices')}}</a></div>
                            </div>
                        </div>
                    </div>
                @endif

                --}}{{--For Buyer--}}{{--
                @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Buyer" && Auth::user()->status == 3)
                    --}}{{--<div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500"><a href="{{route('singleCategoryProformaInvoices')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none transition ease-in-out duration-150">{{__('portal.Proforma Invoices')}}</a></div>
                            </div>
                        </div>
                    </div>--}}{{--
                @endif

                --}}{{--For Supplier--}}{{--
                @if(auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)
                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500"><a href="{{route('singleCategoryEmdadInvoicesIndex')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none transition ease-in-out duration-150">{{__('portal.Emdad Invoices')}}</a></div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="items-center text-center px-2 py-6 shadow-sm rounded-md bg-white">

                            <div class="mx-5">
                                <div class="text-gray-500"><a href="{{route('singleCategorySupplierPaymentsReceived')}}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none transition ease-in-out duration-150">{{__('portal.Manual Payments')}}</a></div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>--}}

    </x-app-layout>
@endif
