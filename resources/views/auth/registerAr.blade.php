<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <!-- <x-jet-authentication-card-logo /> -->

            <img src="{{url('logo.png')}}" alt="EMDAD CHAIN LOGO" class="block h-20 w-auto" />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" style="direction: rtl">
            @csrf
            <p class="text-center font-bold text-2xl">الخطوة الأولى: التسجيل</p>

            <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-1 lg:-mx-3 xl:-mx-2">

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <x-jet-label for="gender" value="{{ __('') }}" class="mb-2" />&nbsp;
                    <select name="gender" id="gender" class="form-select mb-2 rounded-md shadow-sm block w-full" required autofocus autocomplete="name" >
                        <option value="">اختر</option>
                        <option value="Male">سيد</option>
                        <option value="Male">آنسة</option>
                        <option value="Female">سيدة</option>
                    </select>
                </div>

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <!-- Column Content -->
                    <x-jet-label for="name" value="{{ __('الاسم') }}" />
                    <x-jet-input id="name" class="block mt-2 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

            </div>

            <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-1 lg:-mx-3 xl:-mx-2">

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <x-jet-label for="nid_num" value="{{ __('رقم الهوية الوطنية') }}" />
                    <x-jet-input id="nid_num" class="block mt-1 w-full" type="text" name="nid_num" :value="old('nid_num')" required />
                </div>

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <!-- Column Content -->
                    <x-jet-label for="nid_exp_date" value="{{ __('تاريخ انتهاء الهوية الوطنية') }}" />
                    <x-jet-input id="nid_exp_date" class="block mt-1 w-full" type="date" name="nid_exp_date" :value="old('nid_exp_date')" required min="{{date('Y-m-d')}}" />
                </div>

            </div>


            <div class="mt-2">
                <x-jet-label for="mobile" value="{{ __('رقم الجوال') }}"  class="mb-2"  />
                <x-jet-input id="mobile" class="block mt-1 w-full" type="tel" name="mobile" :value="old('mobile')"  />
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
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
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
