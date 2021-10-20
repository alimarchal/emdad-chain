<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <x-slot name="logo">
            <!-- <x-jet-authentication-card-logo /> -->
            <img src="{{url('logo.png')}}" alt="EMDAD CHAIN LOGO" class="block h-20 w-auto" />
        </x-slot>

        <div class="w-full sm:max-w-lg mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <x-jet-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <div>
                <a href="{{route('login')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"><img alt="" src="{{url('us.png')}}" style="margin-right: 2px;margin-top: -4px;">English</a>
            </div>

            <form method="POST" action="{{ route('login') }}" style="direction: rtl">
                @csrf

                <div>
                    <x-jet-label for="email" value="{{ __('login.Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('login.Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('login.Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('login.Forgot your password?') }}
                        </a>
                    @endif

                    &nbsp;
                    <x-jet-button class="ml-4">
                        {{ __('login.Login') }}
                    </x-jet-button>
                </div>

                <div class="flex items-center mt-4" style="margin: auto;width: 50%; padding: 10px;">
                    <span class="ml-2 text-sm text-gray-600">{{ __('login.Not a member?') }}</span>
                    &nbsp;
                    <a class="underline text-sm text-blue-500 hover:text-gray-900" href="{{ route('registerAr', 'ar') }}">
                        {{ __('login.Register') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
