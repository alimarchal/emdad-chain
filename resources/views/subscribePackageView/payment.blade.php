<x-app-layout>
    @section('headerScripts')
        @if($gateway == "mada")
            <script src="https://code.jquery.com/jquery.js" type="text/javascript"></script>
            <style>

                .wpwl-form-card
                {
                    min-height: 0px !important;
                }

                .wpwl-label-brand{
                    display: none !important;
                }
                .wpwl-control-brand{
                    display: none !important;
                }

                .wpwl-brand-card
                {
                    display: block;
                    visibility: visible;
                    position: absolute;
                    right: 178px;
                    top: 40px;
                    width: 67px;
                    z-index: 10;
                }

                .wpwl-brand-MASTER
                {
                    margin-top: -10;
                    margin-right: -10;
                }

            </style>

            <script>

                var wpwlOptions = {
                    locale: "en", //check if the store is in Arabic or English

                    onReady: function(){
                        if (wpwlOptions.locale == "ar") {
                            $(".wpwl-group").css('direction', 'ltr');
                            $(".wpwl-control-cardNumber").css({'direction': 'ltr' , "text-align":"right"});
                            $(".wpwl-brand-card").css('right', '200px');
                        }
                    }}
            </script>
        @endif
        <script src="{{env('URL_GATEWAY')}}/v1/paymentWidgets.js?checkoutId={{{$res_data['id']}}}"></script>
        <script type="text/javascript">
            var wpwlOptions = {
                paymentTarget:"_top",
            }
        </script>


    @endsection
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
        Amount: SAR {{number_format($package->charges,2)}}
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


        <form action="{{route('businessPackage.paymentStatus')}}?package_id={{$package->id}}&merchant_id={{$merchant_id->id}}&gateway={{$gateway}}" method="get" class="paymentWidgets" data-brands="@if($gateway == "mada") MADA @else VISA MASTER @endif">
        </form>


</x-app-layout>
