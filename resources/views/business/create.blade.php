@section('headerScripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
    <script src="{{url('js/mapInput.js')}}"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    {{--    Combo Tree --}}
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/flatly/bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.0.45/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{url('combo_tree_two/style.css')}}">


    <style>
        table {
            font-size: 1em;
        }
        .ui-draggable, .ui-droppable {
            background-position: top;
        }

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
    </style>

    <script>

        $(document).ready(function() {
            var $j = jQuery.noConflict();
            $( "#datepicker" ).datepicker({
                dateFormat: 'mm/dd/yy',
                changeMonth: true,
                changeYear: true,
                minDate: 0,
                clear: true,
            });
        });
    </script>
@endsection
@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Business Information') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                        <img src="{{url('registration_step/E-2.png')}}" alt="User Registration" class="block w-auto mb-4 m-auto"/>
                        <form action="{{ url('business') }}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                            <x-jet-validation-errors class="mb-4"/>
                            @csrf
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Step # 2: Business Information')}}</h3>
                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/3" for="business_name">{{__('portal.Business Name')}} @include('misc.required')</label>
                                <x-jet-label for="nid_num" class="block font-medium text-sm text-gray-700 w-1/3"  value="{{ __('register.National ID Number') }}"/>
                               <x-jet-label for="nid_exp_date" class="block font-medium text-sm text-gray-700 w-1/3"  value="{{ __('register.National ID Expiry Date') }}"/>


{{--                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="num_of_warehouse">Select the numbers of Warehouses @include('misc.required')</label>--}}
                                <input type="hidden" name="business_type" value="{{ auth()->user()->registration_type }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="business_name" type="text" name="business_name" class="border p-2 w-1/3" value="{{auth()->user()->company_name}}" required></x-jet-input>
                                <x-jet-input id="nid_num" class="block mt-1  w-1/3" type="text" pattern="\d*" maxlength="10" name="nid_num" :value="old('nid_num')" required/>
                                <input type="text" id="datepicker" data-provide="datepicker" class="block mt-1 w-1/3" name="nid_exp_date" value="{{old('nid_exp_date')}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)" readonly>

                                {{--                                <select name="num_of_warehouse" id="num_of_warehouse" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>--}}
{{--                                    <option value="">None</option>--}}
{{--                                    @for ($count = 1; $count <= 100; $count++)--}}
{{--                                        <option value="{{ $count }}">{{ $count }}</option>--}}
{{--                                    @endfor--}}
{{--                                </select>--}}
                            </div>


                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="business_type">{{__('portal.Select the Sub-Categories')}} @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex mt-3 ">
                                <input type="text" id="justAnInputBox1"  placeholder="Select" autocomplete="off" style="width: 100%" />
                            </div>
                            <div class="flex mt-3 ">
                                @include('category.category.index')
                            </div>


                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="chamber_reg_number">{{__('portal.Commercial Registration Number')}} @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="chamber_reg_path_1" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)">
                                    {{__('portal.Commercial Registration Certificate')}} @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="vat_reg_certificate_number">{{__('portal.VAT Number')}} @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="vat_reg_certificate_path_1">{{__('portal.VAT Certificate (If available)')}} @include('misc.required')</label>

                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="chamber_reg_number" type="text" name="chamber_reg_number" class="border p-2 w-1/2" value="{{old('chamber_reg_number')}}"></x-jet-input>
                                <x-jet-input id="chamber_reg_path_1" type="file" name="chamber_reg_path_1" class="border p-2 w-1/2" required></x-jet-input>
                                <x-jet-input id="vat_reg_certificate_number" type="text" name="vat_reg_certificate_number" class="border p-2 w-1/2" value="{{old('vat_reg_certificate_number')}}" required></x-jet-input>
                                <x-jet-input id="vat_reg_certificate_path_1" type="file" name="vat_reg_certificate_path_1" class="border p-2 w-1/2" required></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-label class="w-1/2" for="website">{{__('portal.Website')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="business_email">{{__('portal.Company Email')}} @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-input id="website" name="website" class="border p-2 w-1/2" value="{{old('website')}}"></x-jet-input>
                                <x-jet-input id="business_email" type="email" name="business_email" class="border p-2 w-1/2" value="{{old('business_email')}}"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="phone">{{__('portal.Landline')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="mobile">{{__('portal.Mobile')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="country">{{__('portal.Country')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="city">{{__('portal.City')}} @include('misc.required')</x-jet-label>
                            </div>

                            <livewire:country />
                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="bank_name">{{__('portal.Bank Name')}} @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="iban">{{__('portal.IBAN')}} @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="latitude">{{__('portal.Latitude')}} @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="longitude">{{__('portal.Longitude')}} @include('misc.required')</label>
                            </div>



                            <div class="flex space-x-5 mt-3">

                                <select id="bank_name" name="bank_name" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    @foreach(\App\Models\Bank::all() as $bank_name)
                                        <option {{(old('bank_name') ==  $bank_name->name ? 'selected' : '')}} value="{{ $bank_name->name }}">{{ $bank_name->name }}</option>
                                    @endforeach
                                </select>

                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="iban" type="text" name="iban" value="{{old('iban')}}" required="required">
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="latitude" required readonly type="text" name="latitude">
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="longitude" required readonly type="text" name="longitude">
                            </div>


                            <br>
                            <p>{{__('portal.Please use the map marker for your office location.')}}</p>
                            <br>
                            <div id="map" style="width:100%;height:400px; ">
                                <div style="width: 100%; height: 100%" id="address-map"></div>
                            </div>
                            <br>

                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="address">
                                    {{__('portal.Address')}} @include('misc.required')
                                </label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <textarea id="address" type="text" name="address" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>{{old('address')}}</textarea>
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_photo_url_1">{{__('portal.Company logo')}} @include('misc.required')</label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="business_photo_url" type="file" name="business_photo_url_1" class="border p-2 w-1/2" required></x-jet-input>
                            </div>

                            <br>

                           {{-- @if (auth()->user()->registration_type == 'Buyer')
                                @include('business.buyerPolicy')
                            @else
                                @include('business.supplierPolicy')
                            @endif--}}

                            <div class="block mt-4">
                                <label for="policy_procedure" class="flex items-center">
                                    <input id="policy_procedure" type="checkbox" class="form-checkbox" name="policy_procedure" required>
                                    @if(auth()->user()->registration_type == 'Buyer')
                                        <span class="ml-2 text-sm text-gray-600">{{__('portal.I agree')}}</span> <a href="{{route('policyProcedure.buyer')}}" target="_blank" class="ml-2 text-sm text-red-600"><u>{{ __('portal.Policy and Procedures') }}</u></a>
                                    @elseif(auth()->user()->registration_type == 'Supplier')
                                        <span class="ml-2 text-sm text-gray-600">{{__('portal.I agree')}}</span> <a href="{{route('policyProcedure.supplier')}}" target="_blank" class="ml-2 text-sm text-red-600"><u>{{ __('portal.Policy and Procedures') }}</u></a>
                                    @endif
                                </label>
                            </div>

                            <x-jet-button class="float-right mt-4 mb-4">{{__('portal.Save & Next')}}</x-jet-button>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    @section('footerScripts')
        <!-- Combo Tree -->
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="{{url('combo_tree_two/comboTreePlugin.js')}}" type="text/javascript"></script>

            <script type="text/javascript">


                var SampleJSONData2 = [
                    @include('test.get_category', ['categories' => $parentCategories])
                ];


                var comboTree1, comboTree2;

                jQuery(document).ready(function ($) {

                    comboTree3 = $('#justAnInputBox1').comboTree({
                        source: SampleJSONData2,
                        isMultiple: true,
                        cascadeSelect: true,
                        collapse: true
                    });

                    comboTree3.setSource(SampleJSONData2);


                });


            </script>
        @endsection
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

                    <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                        <img src="{{url('registration_step/E-2.png')}}" alt="User Registration" class="block w-auto mb-4 m-auto"/>
                        <form action="{{ url('business') }}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                            <x-jet-validation-errors class="mb-4"/>
                            @csrf
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Step # 2: Business Information')}}</h3>
                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_name">{{__('portal.Business Name')}} @include('misc.required')</label>
                                <input type="hidden" name="business_type" value="{{ auth()->user()->registration_type }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="business_name" type="text" name="business_name" class="border p-2 w-1/2" value="{{old('business_name')}}" required></x-jet-input>
                            </div>


                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="business_type">{{__('portal.Select the Sub-Categories')}} @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex mt-3 ">
                                <input type="text" id="justAnInputBox1" name="list" placeholder="Select" autocomplete="off"/>
{{--                                @include('category.category.index')--}}
                            </div>


                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="chamber_reg_number">{{__('portal.Commercial Registration Number')}} @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="chamber_reg_path_1" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)">
                                    {{__('portal.Commercial Registration Certificate')}} @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="vat_reg_certificate_number">{{__('portal.VAT Number')}} @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="vat_reg_certificate_path_1">{{__('portal.VAT Certificate (If available)')}} @include('misc.required')</label>

                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="chamber_reg_number" type="text" name="chamber_reg_number" class="border p-2 w-1/2" value="{{old('chamber_reg_number')}}"></x-jet-input>
                                <x-jet-input id="chamber_reg_path_1" type="file" name="chamber_reg_path_1" class="border p-2 w-1/2" style="margin-right: 5px;" required></x-jet-input>
                                <x-jet-input id="vat_reg_certificate_number" type="text" name="vat_reg_certificate_number" class="border p-2 w-1/2" value="{{old('vat_reg_certificate_number')}}" required></x-jet-input>
                                <x-jet-input id="vat_reg_certificate_path_1" type="file" name="vat_reg_certificate_path_1" class="border p-2 w-1/2" required></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-label class="w-1/2" for="website">{{__('portal.Website')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="business_email">{{__('portal.Company Email')}} @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-input id="website" name="website" class="border p-2 w-1/2" value="{{old('website')}}"></x-jet-input>
                                <x-jet-input id="business_email" type="email" name="business_email" class="border p-2 w-1/2" style="margin-right: 8px;" value="{{old('business_email')}}"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="phone">{{__('portal.Landline')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="mobile">{{__('portal.Mobile')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="country">{{__('portal.Country')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="city">{{__('portal.City')}} @include('misc.required')</x-jet-label>
                            </div>

                            <livewire:country />
                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="bank_name">{{__('portal.Bank Name')}} @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="iban">{{__('portal.IBAN')}} @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="latitude">{{__('portal.Latitude')}} @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="longitude">{{__('portal.Longitude')}} @include('misc.required')</label>
                            </div>



                            <div class="flex space-x-5 mt-3">

                                <select id="bank_name" name="bank_name" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    @foreach(\App\Models\Bank::all() as $bank_name)
                                        <option {{(old('bank_name') ==  $bank_name->name ? 'selected' : '')}} value="{{ $bank_name->name }}">{{ $bank_name->name }}</option>
                                    @endforeach
                                </select>

                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="iban" type="text" name="iban" value="{{old('iban')}}" style="margin-right: 5px;" required="required">
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="latitude" required readonly type="text" name="latitude">
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="longitude" required readonly type="text" name="longitude">
                            </div>


                            <br>
                            <p>{{__('portal.Please use the map marker for your office location.')}}</p>
                            <br>
                            <div id="map" style="width:100%;height:400px; ">
                                <div style="width: 100%; height: 100%" id="address-map"></div>
                            </div>
                            <br>

                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="address">
                                    {{__('portal.Address')}} @include('misc.required')
                                </label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <textarea id="address" type="text" name="address" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>{{old('address')}}</textarea>
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_photo_url_1">{{__('portal.Company logo')}} @include('misc.required')</label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="business_photo_url" type="file" name="business_photo_url_1" class="border p-2 w-1/2" required></x-jet-input>
                            </div>

                            <br>

                            {{-- @if (auth()->user()->registration_type == 'Buyer')
                                 @include('business.buyerPolicy')
                             @else
                                 @include('business.supplierPolicy')
                             @endif--}}

                            <div class="block mt-4">
                                <label for="policy_procedure" class="flex items-center">
                                    <input id="policy_procedure" type="checkbox" class="form-checkbox" name="policy_procedure" required>
                                    @if(auth()->user()->registration_type == 'Buyer')
                                        <span class="mr-1 text-sm text-gray-600">{{__('portal.I agree')}}</span> <a href="{{route('arabic.policyProcedure.buyer')}}" target="_blank" class="ml-2 text-sm text-red-600"><u>{{ __('portal.Policy and Procedures') }}</u></a>
                                    @elseif(auth()->user()->registration_type == 'Supplier')
                                        <span class="mr-1 text-sm text-gray-600">{{__('portal.I agree')}}</span> <a href="{{route('arabic.policyProcedure.supplier')}}" target="_blank" class="ml-2 text-sm text-red-600"><u>{{ __('portal.Policy and Procedures') }}</u></a>
                                    @endif
                                </label>
                            </div>

                            <x-jet-button class="float-left mt-4 mb-4">{{__('portal.Save & Next')}}</x-jet-button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @section('footerScripts')
        <!-- Combo Tree -->
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="{{url('combo_tree_two/comboTreePlugin.js')}}" type="text/javascript"></script>

            <script type="text/javascript">


                var SampleJSONData2 = [
                    @include('test.get_category', ['categories' => $parentCategories])
                ];


                var comboTree1, comboTree2;

                jQuery(document).ready(function ($) {

                    comboTree3 = $('#justAnInputBox1').comboTree({
                        source: SampleJSONData2,
                        isMultiple: true,
                        cascadeSelect: true,
                        collapse: true
                    });

                    comboTree3.setSource(SampleJSONData2);


                });


            </script>
        @endsection
    </x-app-layout>
@endif

