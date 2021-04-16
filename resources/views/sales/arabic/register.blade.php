<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <!-- <x-jet-authentication-card-logo /> -->

            <img src="{{url('logo.png')}}" alt="EMDAD CHAIN LOGO" class="block h-20 w-auto" />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <div style="direction: rtl">
            <x-jet-button>
                <a href="{{route('sellerRegister')}}" class="get-started-btn scrollto"><img alt="" src="{{url('us.png')}}" style="margin-right: 2px;margin-top: -4px;">English</a>
            </x-jet-button>
        </div>

        <form method="POST" action="{{ route('sellerRegister') }}" style="direction: rtl">
            @csrf
            <p class="text-center font-bold text-2xl">الخطوة الأولى: التسجيل</p>

            <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-1 lg:-mx-3 xl:-mx-2">

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <!-- Column Content -->
                    <x-jet-label for="firstName" value="{{ __('الاسم') }}" />
                    <x-jet-input id="firstName" class="block mt-2 w-full" type="text" name="firstName" :value="old('firstName')" required autofocus autocomplete="firstName" />
                </div>

                <div class="my-0 px-2 w-full overflow-hidden pb-2 sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <!-- Column Content -->
                    <x-jet-label for="lastName" value="{{ __('Last Name') }}" />
                    <x-jet-input id="lastName" class="block mt-2 w-full" type="text" name="lastName" :value="old('lastName')" required autofocus autocomplete="lastName" />
                </div>

            </div>

            <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-1 lg:-mx-3 xl:-mx-2">

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <x-jet-label for="gender" value="{{ __('Gender') }}" class="mb-1" />&nbsp;
                    <select name="gender" id="gender" class="form-select mb-2 rounded-md shadow-sm block w-full" required autofocus autocomplete="name" >
                        <option disabled selected value="">اختر</option>
                        <option {{ old('gender') == 0 ? "selected" : "" }} value="0">Male</option>
                        <option {{ old('gender') == 1 ? "selected" : "" }} value="1">Female</option>
                    </select>
                </div>

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <x-jet-label for="nid_num" value="{{ __('رقم الهوية الوطنية') }}" />
                    <x-jet-input id="nid_num" class="block mt-1 w-full" type="text" pattern="\d*"  maxlength="10" name="nid_num" :value="old('nid_num')" required />
                </div>

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <x-jet-label for="type" value="{{ __('Employee') }}" class="mb-1" />
                    <select name="type" id="type" class="form-select mb-2 rounded-md shadow-sm block w-full" required autofocus autocomplete="type" >
                        <option disabled selected value="">اختر</option>
                        <option {{ old('type') == 0 ? "selected" : "" }} value="0">لا</option>
                        <option {{ old('type') == 1 ? "selected" : "" }} value="1">نعم</option>
                    </select>
                </div>

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <x-jet-label for="referred_no" value="{{ __('Referred Seller #') }}" />
                    <x-jet-input id="referred_no" class="block mt-1 w-full" type="text" maxlength="10" name="referred_no" :value="old('referred_no')"/>
                </div>

            </div>


            <div class="mt-2">
                <x-jet-label for="mobile_number" value="{{ __('رقم الجوال') }}"  class="mb-2"  />
                <x-jet-input id="mobile_number" class="block mt-1 w-full" type="tel" name="mobile_number" :value="old('mobile_number')"  />
            </div>


            <div class="mt-2">
                <x-jet-label for="email" value="{{ __('البريد الإلكتروني') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('كلمة المرور') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('تأكيد كلمة المرور') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{route('sellerLoginArabic')}}">
                    {{ __('هل سبق لك التسجيل؟') }}
                </a>

                &nbsp;
                <x-jet-button class="ml-4">
                    {{ __('تسجيل') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
<div class="flex items-center justify-end mt-4">

</div>
