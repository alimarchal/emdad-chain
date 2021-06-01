@section('headerScripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
    <script src="{{url('js/mapInput.js')}}"></script>
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
                <!-- component -->

                @include('users.sessionMessage')
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                        <form action="{{ url('business') }}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                            <x-jet-validation-errors class="mb-4"/>
                            @csrf
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">Step # 2: Business Information</h3>
                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_name">Business Name @include('misc.required')</label>
{{--                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="num_of_warehouse">Select the numbers of Warehouses @include('misc.required')</label>--}}
                                <input type="hidden" name="business_type" value="{{ auth()->user()->registration_type }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="business_name" type="text" name="business_name" class="border p-2 w-1/2" value="{{old('business_name')}}" required></x-jet-input>
{{--                                <select name="num_of_warehouse" id="num_of_warehouse" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>--}}
{{--                                    <option value="">None</option>--}}
{{--                                    @for ($count = 1; $count <= 100; $count++)--}}
{{--                                        <option value="{{ $count }}">{{ $count }}</option>--}}
{{--                                    @endfor--}}
{{--                                </select>--}}
                            </div>


                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="business_type">Select the Sub-Categories @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex mt-3 ">
                                @include('category.category.index')
                            </div>


                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="chamber_reg_number">Chamber Registration Number @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="chamber_reg_path_1" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)">Chamber
                                    Certificate/File @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="vat_reg_certificate_number">VAT Number @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="vat_reg_certificate_path_1">VAT Certificate (If available) @include('misc.required')</label>

                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="chamber_reg_number" type="text" name="chamber_reg_number" class="border p-2 w-1/2" value="{{old('chamber_reg_number')}}"></x-jet-input>
                                <x-jet-input id="chamber_reg_path_1" type="file" name="chamber_reg_path_1" class="border p-2 w-1/2" required></x-jet-input>
                                <x-jet-input id="vat_reg_certificate_number" type="text" name="vat_reg_certificate_number" class="border p-2 w-1/2" value="{{old('vat_reg_certificate_number')}}" required></x-jet-input>
                                <x-jet-input id="vat_reg_certificate_path_1" type="file" name="vat_reg_certificate_path_1" class="border p-2 w-1/2" required></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-label class="w-1/2" for="website">Website</x-jet-label>
                                <x-jet-label class="w-1/2" for="business_email">Company Email @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-input id="website" name="website" class="border p-2 w-1/2" value="{{old('website')}}"></x-jet-input>
                                <x-jet-input id="business_email" type="email" name="business_email" class="border p-2 w-1/2" value="{{old('business_email')}}"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="phone">Landline @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="mobile">Mobile @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="country">Country @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="city">City @include('misc.required')</x-jet-label>
                            </div>

                            <livewire:country />
                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="bank_name">Bank Name @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="iban">IBAN @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="latitude">Latitude @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="longitude">Longitude @include('misc.required')</label>
                            </div>



                            <div class="flex space-x-5 mt-3">

                                <select id="bank_name" name="bank_name" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">None</option>
                                    @foreach(\App\Models\Bank::all() as $bank_name)
                                        <option {{(old('bank_name') ==  $bank_name->name ? 'selected' : '')}} value="{{ $bank_name->name }}">{{ $bank_name->name }}</option>
                                    @endforeach
                                </select>

                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="iban" type="text" name="iban" value="{{old('iban')}}" required="required">
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="latitude" required readonly type="text" name="latitude">
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="longitude" required readonly type="text" name="longitude">
                            </div>


                            <br>
                            <p>Please use the map marker for your office location.</p>
                            <br>
                            <div id="map" style="width:100%;height:400px; ">
                                <div style="width: 100%; height: 100%" id="address-map"></div>
                            </div>
                            <br>

                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="address">
                                    Address @include('misc.required')
                                </label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <textarea id="address" type="text" name="address" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>{{old('address')}}</textarea>
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_photo_url_1">Company logo @include('misc.required')</label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="business_photo_url" type="file" name="business_photo_url_1" class="border p-2 w-1/2" required></x-jet-input>
                            </div>

                            <br>

{{--                            @if (auth()->user()->registration_type == 'Buyer')--}}
{{--                                @include('business.buyerPolicy')--}}
{{--                            @else--}}
{{--                                @include('business.supplierPolicy')--}}
{{--                            @endif--}}

                            <div class="block mt-4">
                                <label for="policy_procedure" class="flex items-center">
                                    <input id="policy_procedure" type="checkbox" class="form-checkbox" name="policy_procedure" required>
                                    @if(auth()->user()->registration_type == 'Buyer')
                                        <span class="ml-2 text-sm text-gray-600">I agree</span> <a href="{{route('policyProcedure.buyer')}}" target="_blank" class="ml-2 text-sm text-red-600"><u>{{ __('Policy and Procedures') }}</u></a>
                                    @elseif(auth()->user()->registration_type == 'Supplier')
                                        <span class="ml-2 text-sm text-gray-600">I agree</span> <a href="{{route('policyProcedure.supplier')}}" target="_blank" class="ml-2 text-sm text-red-600"><u>{{ __('Policy and Procedures') }}</u></a>
                                    @endif
                                </label>
                            </div>

                            <x-jet-button class="float-right mt-4 mb-4">Save & Next</x-jet-button>

                        </form>


                    </div>
                </div>


            </div>


        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Business Information') }}
            </h2>
        </x-slot>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- component -->
                @include('users.sessionMessage')
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6 rounded-sm" style="direction: rtl">

                        <form action="{{ url('business') }}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                            @csrf
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">الخطوة الثانية: معلومات النشاط التجاري</h3>
                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_name">مسمى النشاط التجاري  @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="num_of_warehouse">قم باختيار عدد المستودعات@include('misc.required')</label>
                                <input type="hidden" name="business_type" value="{{ auth()->user()->registration_type }}">
                                <input type="hidden" name="supplier_client" value="{{ auth()->user()->supplier_client }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="business_name" type="text" name="business_name" class="border p-2 w-1/2" required></x-jet-input>
                                <select name="num_of_warehouse" id="num_of_warehouse" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">None</option>
                                    @for ($count = 1; $count <= 100; $count++)
                                        <option value="{{ $count }}">{{ $count }}</option>
                                    @endfor
                                </select>
                            </div>


                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="business_type"> قم بتحديد الفئات الفرعية@include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex mt-3 ">
                                @include('category.category.index')
                            </div>


                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="chamber_reg_number"> رقم السجل التجاري @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="chamber_reg_path" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)"> صورة من السجل التجاري @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="vat_reg_certificate_number">الرقم الضريبي@include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="vat_reg_certificate_path"> صورة من الشهادة الضريبية@include('misc.required')</label>

                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="chamber_reg_number" type="text" name="chamber_reg_number" class="border p-2 w-1/2"></x-jet-input>
                                <x-jet-input id="chamber_reg_path" type="file" name="chamber_reg_path" class="border p-2 w-1/2"></x-jet-input>
                                <x-jet-input id="vat_reg_certificate_number" type="text" name="vat_reg_certificate_number" class="border p-2 w-1/2"></x-jet-input>
                                <x-jet-input id="vat_reg_certificate_path" type="file" name="vat_reg_certificate_path" class="border p-2 w-1/2"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-label class="w-1/2" for="website">الموقع الإلكتروني</x-jet-label>
                                <x-jet-label class="w-1/2" for="business_email">البريد الالكتروني للمنشأة@include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-input id="website" name="website" class="border p-2 w-1/2"></x-jet-input>
                                <x-jet-input id="business_email" type="email" name="business_email" class="border p-2 w-1/2"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="phone">رقم الهاتف@include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="mobile">رقم الجوال@include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="country">الدولة@include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="city">المدينة@include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="phone" type="tel" name="phone" class="border p-2 w-1/2" required></x-jet-input>
                                <x-jet-input id="mobile" type="number" name="mobile" class="border p-2 w-1/2" required></x-jet-input>
                                <select name="country" id="country" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">None</option>
                                    @foreach (\App\Models\User::countries() as $country)
                                        <option value="{{ $country }}">{{ $country }}</option>
                                    @endforeach
                                </select>
                                <select name="city" id="city" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">None</option>
                                    @foreach (\App\Models\City::all() as $city)
                                        <option value="{{ $city }}">{{ $city->name_ar }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="bank_name">اسم البنك@include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="iban">الايبان@include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="longitude">خط الطول</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="latitude">خط العرض</label>
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <select id="bank_name" name="bank_name" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">None</option>
                                    @foreach(\App\Models\Bank::all() as $bank_name)
                                        <option value="{{ $bank_name->name }}">{{ $bank_name->ar_name }}</option>
                                    @endforeach
                                </select>
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="iban" type="text" name="iban" required="required">
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="longitude" required readonly type="text" name="longitude">
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="latitude" required readonly type="text" name="latitude">
                            </div>


                            <br>
                            <p>الرجاء تحديد موقع المنشأة من الخارطة في الأسفل</p>
                            <br>
                            <div id="map" style="width:100%;height:400px; ">
                                <div style="width: 100%; height: 100%" id="address-map"></div>
                            </div>
                            <br>

                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="address">
                                    العنوان@include('misc.required')
                                </label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <textarea id="address" type="text" name="address" class="form-input rounded-md shadow-sm border p-2 w-1/2" required=""></textarea>
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_photo_url">صورة شعار المنشأة</label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="business_photo_url" type="file" name="business_photo_url" class="border p-2 w-1/2"></x-jet-input>
                            </div>

                            <br>

{{--                            @if (auth()->user()->registration_type == 'Buyer')--}}
{{--                                @include('business.buyerPolicy')--}}
{{--                            @else--}}
{{--                                @include('business.supplierPolicy')--}}
{{--                            @endif--}}

                            <div class="block mt-4">
                                <label for="policy_procedure" class="flex items-center">
                                    <input id="policy_procedure" type="checkbox" class="form-checkbox" name="policy_procedure" required>
                                    @if(auth()->user()->registration_type == 'Buyer')
                                        <span class="ml-2 text-sm text-gray-600">أقبل</span> <a href="{{route('arabic.policyProcedure.buyer')}}" target="_blank" class="ml-2 text-sm text-red-600"><u>{{ __('الشروط والأحكام') }}</u></a>
                                    @elseif(auth()->user()->registration_type == 'Supplier')
                                        <span class="ml-2 text-sm text-gray-600">أقبل</span> <a href="{{route('arabic.policyProcedure.supplier')}}" target="_blank" class="ml-2 text-sm text-red-600"><u>{{ __('الشروط والأحكام') }}</u></a>
                                    @endif
                                </label>
                            </div>

                            <x-jet-button class="float-right mt-4 mb-4">حفظ، التالي</x-jet-button>

                        </form>


                    </div>
                </div>


            </div>


        </div>
    </x-app-layout>
@endif
