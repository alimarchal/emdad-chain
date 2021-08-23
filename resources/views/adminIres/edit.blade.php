@section('headerScripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
    <script src="{{url('js/mapInput.js')}}"></script>
@endsection
@if(auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Business Information') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                @include('users.sessionMessage')
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                        <form action="{{route('adminIreUpdate')}}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                            @csrf
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Edit IRE Information')}}</h3>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="name">{{__('portal.Name')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="email">{{__('portal.Email')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="password">{{__('portal.Password')}}</x-jet-label>
                                {{--                            <x-jet-label class="w-1/2" for="password_confirmation">Confirm Password</x-jet-label>--}}
                                <input type="hidden" name="ire_id" value="{{ encrypt($ire->id) }}">
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="name" type="text" name="name" required class="border p-2 w-1/2" value="{{ $ire->name }}"></x-jet-input>
                                <x-jet-input id="email" type="email" name="email" class="border p-2 w-1/2" value="{{ $ire->email }}"></x-jet-input>
                                <x-jet-input id="password" type="password" name="password" class="border p-2 w-1/2" value=""></x-jet-input>
                                {{--                            <x-jet-input id="password_confirmation" type="password_confirmation" name="password_confirmation" class="border p-2 w-1/2" value=""></x-jet-input>--}}
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="bank">{{__('portal.Bank Name')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="iban">{{__('portal.IBAN')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="nid_num">{{__('portal.National ID')}} #</x-jet-label>
                                <x-jet-label class="w-1/2" for="nid_image" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)">{{__('portal.Upload National ID (max. 5 MB image)')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <select name="bank" id="bank" required class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{ $ire->bank }}">
                                    <option value="">{{__('portal.None')}}</option>
                                    @foreach (\App\Models\Bank::all() as $bank)
                                        <option value="{{ $bank->id }}" {{ $ire->bank == $bank->id ? 'selected' : '' }}>{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input id="iban" type="text" name="iban" maxlength="24" required class="border p-2 w-1/2" value="{{ $ire->iban }}"></x-jet-input>
                                <x-jet-input id="nid_num" type="text" name="nid_num" maxlength="10" required class="border p-2 w-1/2" value="{{ $ire->nid_num }}"></x-jet-input>
                                <x-jet-input id="nid_image" type="file" name="nid_image" class="border p-2 w-1/2" value="{{ $ire->nid_image }}"></x-jet-input>
                                {{--                            <x-jet-input id="nid_image" type="file" name="nid_image" class="border p-2 w-1/2"></x-jet-input>--}}
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-label class="w-1/2" for="type">{{__('portal.Employee')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="gender">{{__('portal.Gender')}}</x-jet-label>
                                <x-jet-label for="mobile_number" value="{{ __('portal.Mobile Number') }}"  class="w-1/2"  />
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <select name="type" id="type" required class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{ $ire->type }}">
                                    <option disabled selected value="">{{__('portal.Select')}}</option>
                                    <option {{ $ire->type == 0 ? "selected" : "" }} value="0">{{__('portal.No')}}</option>
                                    <option {{ $ire->type == 1 ? "selected" : "" }} value="1">{{__('portal.Yes')}}</option>
                                </select>
                                <select name="gender" id="gender" required class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{ $ire->gender }}">
                                    <option disabled selected value="">{{__('portal.Select')}}</option>
                                    <option {{ $ire->gender == 0 ? 'selected' : '' }} value="0">{{__('portal.Mr.')}}</option>
                                    <option {{ $ire->gender == 1 ? 'selected' : '' }} value="1">{{__('portal.Ms.')}}</option>
                                    <option {{ $ire->gender == 2 ? 'selected' : '' }} value="1">{{__('portal.Mrs.')}}</option>
                                </select>
                                <x-jet-input id="mobile_number" class="block p-2 w-1/2" type="tel" name="mobile_number" :value="$ire->mobile_number"  />
                                {{--                            <x-jet-input id="mobile_number" type="text" name="mobile_number" class="border p-2 w-1/2" value="{{ $ire->mobile_number }}"></x-jet-input>--}}
                            </div>

                            <br>

                            {{--                        <div class="flex space-x-5 mt-3">
                                                        <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_photo_url">Company logo</label>
                                                    </div>
                                                    <div class="flex space-x-5 mt-3">
                                                        <x-jet-input id="business_photo_url" required type="file" name="business_photo_url_1" class="border p-2 w-1/2" value="{{ $business->business_photo_url }}"></x-jet-input>
                                                    </div>--}}
                            <x-jet-button class="float-right mt-4 mb-4">{{__('portal.Update')}}</x-jet-button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
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
                        <form action="{{route('adminIreUpdate')}}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                            @csrf
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Edit IRE Information')}}</h3>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="name">{{__('portal.Name')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="email">{{__('portal.Email')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="password">{{__('portal.Password')}}</x-jet-label>
                                {{--                            <x-jet-label class="w-1/2" for="password_confirmation">Confirm Password</x-jet-label>--}}
                                <input type="hidden" name="ire_id" value="{{ encrypt($ire->id) }}">
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="name" type="text" name="name" required class="border p-2 w-1/2" value="{{ $ire->name }}"></x-jet-input>
                                <x-jet-input id="email" type="email" name="email" class="border p-2 w-1/2" value="{{ $ire->email }}"></x-jet-input>
                                <x-jet-input id="password" type="password" name="password" class="border p-2 w-1/2" value=""></x-jet-input>
                                {{--                            <x-jet-input id="password_confirmation" type="password_confirmation" name="password_confirmation" class="border p-2 w-1/2" value=""></x-jet-input>--}}
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="bank">{{__('portal.Bank Name')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="iban">{{__('portal.IBAN')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="nid_num">{{__('portal.National ID')}} #</x-jet-label>
                                <x-jet-label class="w-1/2" for="nid_image" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)">{{__('portal.Upload National ID (max. 5 MB image)')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <select name="bank" id="bank" required class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{ $ire->bank }}">
                                    <option value="">{{__('portal.None')}}</option>
                                    @foreach (\App\Models\Bank::all() as $bank)
                                        <option value="{{ $bank->id }}" {{ $ire->bank == $bank->id ? 'selected' : '' }}>{{ $bank->ar_name }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input id="iban" type="text" name="iban" maxlength="24" required class="border p-2 w-1/2" value="{{ $ire->iban }}"></x-jet-input>
                                <x-jet-input id="nid_num" type="text" name="nid_num" maxlength="10" required class="border p-2 w-1/2" value="{{ $ire->nid_num }}"></x-jet-input>
                                <x-jet-input id="nid_image" type="file" name="nid_image" class="border p-2 w-1/2" value="{{ $ire->nid_image }}"></x-jet-input>
                                {{--                            <x-jet-input id="nid_image" type="file" name="nid_image" class="border p-2 w-1/2"></x-jet-input>--}}
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-label class="w-1/2" for="type">{{__('portal.Employee')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="gender">{{__('portal.Gender')}}</x-jet-label>
                                <x-jet-label for="mobile_number" value="{{ __('portal.Mobile Number') }}"  class="w-1/2"  />
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <select name="type" id="type" required class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{ $ire->type }}">
                                    <option disabled selected value="">{{__('portal.Select')}}</option>
                                    <option {{ $ire->type == 0 ? "selected" : "" }} value="0">{{__('portal.No')}}</option>
                                    <option {{ $ire->type == 1 ? "selected" : "" }} value="1">{{__('portal.Yes')}}</option>
                                </select>
                                <select name="gender" id="gender" required class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{ $ire->gender }}">
                                    <option disabled selected value="">{{__('portal.Select')}}</option>
                                    <option {{ $ire->gender == 0 ? 'selected' : '' }} value="0">{{__('portal.Mr.')}}</option>
                                    <option {{ $ire->gender == 1 ? 'selected' : '' }} value="1">{{__('portal.Ms.')}}</option>
                                    <option {{ $ire->gender == 2 ? 'selected' : '' }} value="1">{{__('portal.Mrs.')}}</option>
                                </select>
                                <x-jet-input id="mobile_number" class="block p-2 w-1/2" type="tel" name="mobile_number" :value="$ire->mobile_number"  />
                                {{--                            <x-jet-input id="mobile_number" type="text" name="mobile_number" class="border p-2 w-1/2" value="{{ $ire->mobile_number }}"></x-jet-input>--}}
                            </div>

                            <br>

                            {{--                        <div class="flex space-x-5 mt-3">
                                                        <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_photo_url">Company logo</label>
                                                    </div>
                                                    <div class="flex space-x-5 mt-3">
                                                        <x-jet-input id="business_photo_url" required type="file" name="business_photo_url_1" class="border p-2 w-1/2" value="{{ $business->business_photo_url }}"></x-jet-input>
                                                    </div>--}}
                            <x-jet-button class="float-right mt-4 mb-4">{{__('portal.Update')}}</x-jet-button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif
