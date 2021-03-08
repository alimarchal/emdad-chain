
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
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="num_of_warehouse">Number of Warehouse @include('misc.required')</label>
                            <input type="hidden" name="business_type" value="{{ auth()->user()->registration_type }}">
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
                            <x-jet-label class="w-1/2" for="business_type">Category @include('misc.required')</x-jet-label>
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
                            <x-jet-input id="chamber_reg_number" type="text" name="chamber_reg_number" class="border p-2 w-1/2"></x-jet-input>
                            <x-jet-input id="chamber_reg_path_1" type="file" name="chamber_reg_path_1" class="border p-2 w-1/2"></x-jet-input>
                            <x-jet-input id="vat_reg_certificate_number" type="text" name="vat_reg_certificate_number" class="border p-2 w-1/2"></x-jet-input>
                            <x-jet-input id="vat_reg_certificate_path_1" type="file" name="vat_reg_certificate_path_1" class="border p-2 w-1/2"></x-jet-input>
                        </div>
                        <div class="flex space-x-5 mt-3">

                            <x-jet-label class="w-1/2" for="website">Website</x-jet-label>
                            <x-jet-label class="w-1/2" for="business_email">Business Email @include('misc.required')</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">

                            <x-jet-input id="website" name="website" class="border p-2 w-1/2"></x-jet-input>
                            <x-jet-input id="business_email" type="email" name="business_email" class="border p-2 w-1/2"></x-jet-input>
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
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="longitude">Longitude</label>
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="latitude">Latitude</label>
                        </div>

                        <div class="flex space-x-5 mt-3">
                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="bank_name" type="text" name="bank_name" required="required">
                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="iban" type="text" name="iban" required="required">
                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="longitude" type="text" name="longitude">
                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="latitude" type="text" name="latitude">
                        </div>

                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="address">
                                Address @include('misc.required')
                            </label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <textarea id="address" type="text" name="address" class="form-input rounded-md shadow-sm border p-2 w-1/2" required=""></textarea>
                        </div>

                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_photo_url_1">Company logo</label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="business_photo_url" type="file" name="business_photo_url_1" class="border p-2 w-1/2"></x-jet-input>
                        </div>

                        <br>

                        @if (auth()->user()->registration_type == 'Buyer')
                            @include('business.buyerPolicy')
                        @else
                            @include('business.supplierPolicy')
                        @endif


                        <x-jet-button class="float-right mt-4 mb-4">Save & Next</x-jet-button>

                    </form>

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
                            @csrf
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">Step # 2: Business Information</h3>
                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_name">Business Name</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="num_of_warehouse">Number of Warehouse</label>
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
                                <x-jet-label class="w-1/2" for="business_type">Category</x-jet-label>
                            </div>
                            <div class="flex mt-3 ">
                                @include('category.category.index')
                            </div>


                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="chamber_reg_number">Chamber Registration Number</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="chamber_reg_path" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)">Chamber
                                    Certificate/File</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="vat_reg_certificate_number">VAT Number</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="vat_reg_certificate_path">VAT Certificate (If available)</label>

                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="chamber_reg_number" type="text" name="chamber_reg_number" class="border p-2 w-1/2"></x-jet-input>
                                <x-jet-input id="chamber_reg_path" type="file" name="chamber_reg_path" class="border p-2 w-1/2"></x-jet-input>
                                <x-jet-input id="vat_reg_certificate_number" type="text" name="vat_reg_certificate_number" class="border p-2 w-1/2"></x-jet-input>
                                <x-jet-input id="vat_reg_certificate_path" type="file" name="vat_reg_certificate_path" class="border p-2 w-1/2"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-label class="w-1/2" for="website">Website</x-jet-label>
                                <x-jet-label class="w-1/2" for="business_email">Business Email</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-input id="website" name="website" class="border p-2 w-1/2"></x-jet-input>
                                <x-jet-input id="business_email" type="email" name="business_email" class="border p-2 w-1/2"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="phone">Phone</x-jet-label>
                                <x-jet-label class="w-1/2" for="mobile">Mobile</x-jet-label>
                                <x-jet-label class="w-1/2" for="country">Country</x-jet-label>
                                <x-jet-label class="w-1/2" for="city">City</x-jet-label>
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
                                <x-jet-input id="city" type="text" name="city" class="border p-2 w-1/2" required></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="bank_name">Bank Name</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="iban">IBAN</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="longitude">Longitude</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="latitude">Latitude</label>
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="bank_name" type="text" name="bank_name" required="required">
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="iban" type="text" name="iban" required="required">
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="longitude" type="text" name="longitude">
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="latitude" type="text" name="latitude">
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="address">
                                    Address
                                </label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <textarea id="address" type="text" name="address" class="form-input rounded-md shadow-sm border p-2 w-1/2" required=""></textarea>
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_photo_url">Company logo</label>
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
                    <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">

                        <form action="{{ url('business') }}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                            @csrf
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">الخطوة الثانية: معلومات النشاط التجاري</h3>
                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_name">مسمى النشاط التجاري  </label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="num_of_warehouse">عدد المستودعات</label>
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
                                <x-jet-label class="w-1/2" for="business_type">الفئة</x-jet-label>
                            </div>
                            <div class="flex mt-3 ">
                                @include('category.category.index')
                            </div>


                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="chamber_reg_number">Chamber Registration Number</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="chamber_reg_path" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)">Chamber
                                    Certificate/File</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="vat_reg_certificate_number">الرقم الضريبي</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="vat_reg_certificate_path">الشهادة الضريبية (إن وجدت)</label>

                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="chamber_reg_number" type="text" name="chamber_reg_number" class="border p-2 w-1/2"></x-jet-input>
                                <x-jet-input id="chamber_reg_path" type="file" name="chamber_reg_path" class="border p-2 w-1/2"></x-jet-input>
                                <x-jet-input id="vat_reg_certificate_number" type="text" name="vat_reg_certificate_number" class="border p-2 w-1/2"></x-jet-input>
                                <x-jet-input id="vat_reg_certificate_path" type="file" name="vat_reg_certificate_path" class="border p-2 w-1/2"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-label class="w-1/2" for="website">الموقع الإلكتروني</x-jet-label>
                                <x-jet-label class="w-1/2" for="business_email">البريد الإلكتروني</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-input id="website" name="website" class="border p-2 w-1/2"></x-jet-input>
                                <x-jet-input id="business_email" type="email" name="business_email" class="border p-2 w-1/2"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="phone">رقم الجوال</x-jet-label>
                                <x-jet-label class="w-1/2" for="mobile">رقم الجوال</x-jet-label>
                                <x-jet-label class="w-1/2" for="country">الدولة</x-jet-label>
                                <x-jet-label class="w-1/2" for="city">المدينة</x-jet-label>
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
                                <x-jet-input id="city" type="text" name="city" class="border p-2 w-1/2" required></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="bank_name">اسم البنك</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="iban">الايبان</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="longitude">خط الطول</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="latitude">خط العرض</label>
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="bank_name" type="text" name="bank_name" required="required">
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="iban" type="text" name="iban" required="required">
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="longitude" type="text" name="longitude">
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="latitude" type="text" name="latitude">
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="address">
                                    العنوان
                                </label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <textarea id="address" type="text" name="address" class="form-input rounded-md shadow-sm border p-2 w-1/2" required=""></textarea>
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_photo_url">رمز الشركة</label>
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


                            <x-jet-button class="float-right mt-4 mb-4">حفظ، التالي</x-jet-button>

                        </form>


                    </div>
                </div>


            </div>


        </div>
    </x-app-layout>
@endif
