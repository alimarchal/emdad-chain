{{--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <!-- <x-jet-authentication-card-logo /> -->

            <img src="{{url('logo.png')}}" alt="EMDAD CHAIN LOGO" class="block h-20 w-auto" />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <div style="direction: rtl">
            <x-jet-button>
                <a href="{{route('ireRegisterDetails')}}" class="get-started-btn scrollto"><img alt="" src="{{url('us.png')}}" style="margin-right: 2px;margin-top: -4px;">English</a>
            </x-jet-button>
        </div>

        <form method="POST" action="{{route('ireRegisterDetails')}}" enctype="multipart/form-data" style="direction: rtl">
            @csrf
            <p class="text-center font-bold text-2xl">التسجيل</p>

            {{--            <div class="mt-2">--}}
            {{--                <x-jet-label for="referred_no" value="{{ __('Reference (If any)') }}"  class="mb-2"  />--}}
            {{--                <x-jet-input id="referred_no" class="block mt-1 w-full" type="tel" name="referred_no" :value="old('referred_no')" autofocus  />--}}

            {{--                <x-jet-label for="referred_no_response_found" id="referred_no_response" value=""  class="mb-2" style="color: green" />--}}
            {{--                <x-jet-label for="referred_no_response_not_found" id="referred_no_response_not_found" value="" class="mb-2 text-danger" style="color: red" />--}}
            {{--            </div>--}}

            <div class="mt-2">
                <livewire:reference />
            </div>

            <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-1 lg:-mx-3 xl:-mx-2">

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <x-jet-label for="gender" value="{{ __('سيد/آنسة/سيدة') }}" class="mb-1" />
                    <select name="gender" id="gender" class="form-select mb-2 rounded-md shadow-sm block w-full" required autofocus autocomplete="gender">
                        <option disabled selected value="">اختر</option>
                        <option {{ old('gender') == 0 ? 'selected' : '' }} value="0">سيد</option>
                        <option {{ old('gender') == 1 ? 'selected' : '' }} value="1">آنسة</option>
                        <option {{ old('gender') == 2 ? 'selected' : '' }} value="1">سيدة</option>
                    </select>
                </div>

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <x-jet-label for="nid_num" value="{{ __('رقم الهوية الوطنية') }}" />
                    <x-jet-input id="nid_num" class="block mt-1 w-full" type="text" pattern="\d*"  maxlength="10" name="nid_num" :value="old('nid_num')" required />
                </div>

            </div>

            <div class="mt-2">
                <x-jet-label for="nid_image" value="{{ __('تحميل الهوية الوطنية (أقصى حجم للصورة ٥ميغابايت)') }}" />
                <x-jet-input id="nid_image" type="file" name="nid_image" class="block mt-1 w-full" :value="old('nid_image')" required />
            </div>

            <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-1 lg:-mx-3 xl:-mx-2">

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <x-jet-label for="type" value="{{ __('موظف') }}" class="mb-1" />
                    <select name="type" id="type" class="form-select mb-2 rounded-md shadow-sm block w-full" required autofocus autocomplete="type" >
                        <option disabled selected value="">اختر</option>
                        <option {{ old('type') == 0 ? "selected" : "" }} value="0">لا</option>
                        <option {{ old('type') == 1 ? "selected" : "" }} value="1">نعم</option>
                    </select>
                </div>

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <x-jet-label for="bank" value="{{ __('بنك') }}" class="mb-1" />
                    <select name="bank" id="bank" class="form-select mb-2 rounded-md shadow-sm block w-full" required autofocus autocomplete="bank">
                        <option disabled selected value="">اختر</option>
                        @foreach($banks as $bank)
                            <option {{ old('bank') == $bank->id ? 'selected' : '' }} value="{{$bank->id}}">{{$bank->ar_name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>


            <div class="mt-2">
                <x-jet-label for="iban" value="{{ __('رقم الايبان') }}" />
                <x-jet-input id="iban" class="block mt-1 w-full" type="text" maxlength="24" name="iban" :value="old('iban')" required />
            </div>

            <x-jet-button class="float-right mt-4 mb-4">Save & Next</x-jet-button>

        </form>
    </x-jet-authentication-card>
</x-guest-layout>
<div class="flex items-center justify-end mt-4">

</div>
