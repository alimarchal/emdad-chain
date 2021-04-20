<style>
    #datepicker {
        width: 100%;
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

<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <!-- <x-jet-authentication-card-logo /> -->

            <img src="{{url('logo.png')}}" alt="EMDAD CHAIN LOGO" class="block h-20 w-auto" />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

                <x-jet-button>
                    <a href="{{route('registerAr')}}" class="get-started-btn scrollto"><img alt="" src="{{url('sa.png')}}" style="margin-right: 2px;margin-top:-4px;">العربية</a>
                </x-jet-button>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <p class="text-center font-bold text-2xl">Step # 1: Registration</p>


            <livewire:reference />

            <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-1 lg:-mx-3 xl:-mx-2">

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <x-jet-label for="gender" value="{{ __('Mr/Ms/Mrs') }}" class="mb-2" />
                    <select name="gender" id="gender" class="form-select mb-2 rounded-md shadow-sm block w-full" required autofocus autocomplete="name" >
                        <option value="">Select</option>
                        <option value="Male">Mr.</option>
                        <option value="Female">Ms.</option>
                        <option value="Female">Mrs.</option>
                    </select>
                </div>

                <div class="my-0 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <!-- Column Content -->
                    <x-jet-label for="name" value="{{ __('First Name') }}" />
                    <x-jet-input id="name" class="block mt-2 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="my-0 px-2 w-full overflow-hidden pb-2 sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <!-- Column Content -->
                    <x-jet-label for="middle_initial" value="{{ __('Middle Initial') }}" />
                    <x-jet-input id="middle_initial" class="block mt-2 w-full" type="text" maxlength="3" name="middle_initial" :value="old('middle_initial')" required autofocus autocomplete="middle_initial" />
                </div>

                <div class="my-0  px-2 w-full overflow-hidden  pb-2 sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <!-- Column Content -->
                    <x-jet-label for="family_name" value="{{ __('Family Name') }}" />
                    <x-jet-input id="family_name" class="block  mt-2 w-full" type="text" name="family_name" :value="old('family_name')" required autofocus autocomplete="family_name" />
                </div>

            </div>

            <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-1 lg:-mx-3 xl:-mx-2">

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <x-jet-label for="nid_num" value="{{ __('National ID Number') }}" />
                    <x-jet-input id="nid_num" class="block mt-1 w-full" type="text" pattern="\d*"  maxlength="10" name="nid_num" :value="old('nid_num')" required />
                </div>

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <!-- Column Content -->
{{--                    <x-jet-label for="nid_exp_date" value="{{ __('National ID Expiry Date') }}" />--}}
{{--                    <x-jet-input id="nid_exp_date" class="block mt-1 w-full" type="date" name="nid_exp_date" :value="old('nid_exp_date')" required min="{{date('Y-m-d')}}" />--}}

                    <x-jet-label for="nid_exp_date" value="{{ __('National ID Expiry Date') }}" />
                    <input type="text" id="datepicker" class="block mt-1 w-full" name="nid_exp_date" placeholder="Choose Date (mm/dd/yy)">
                </div>

            </div>


            <div class="mt-2">
                <x-jet-label for="mobile" value="{{ __('Mobile Number') }}"  class="mb-2"  />
                <x-jet-input id="mobile" class="block mt-1 w-full" type="tel" name="mobile" :value="old('mobile')"  />
            </div>


            <div class="mt-2">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <div class="mx-auto max-w-lg">
                    <div class="py-2" x-data="{ show: true }">
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <div class="relative">
                            <input name="password" id="password" required autocomplete="new-password" :type="show ? 'password' : 'text'" class="form-input rounded-md shadow-sm block mt-1 w-full">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 mr-2">
                                <svg class="h-6 text-gray-700" fill="none" @click="show = !show" :class="{'hidden': !show, 'block':show }" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 576 512">
                                    <path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"> </path>
                                </svg>
                                <svg class="h-6 text-gray-700" fill="none" @click="show = !show" :class="{'block': !show, 'hidden':show }" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 640 512">
                                    <path fill="currentColor" d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <div class="mx-auto max-w-lg">
                    <div class="py-2" x-data="{ show: true }">

                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <div class="py-2" x-data="{ show: true }">
                            <div class="relative">
                                <input id="password_confirmation" name="password_confirmation" required autocomplete="new-password" :type="show ? 'password' : 'text'" class="form-input rounded-md shadow-sm block mt-1 w-full">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 mr-2">
                                    <svg class="h-6 text-gray-700" fill="none" @click="show = !show" :class="{'hidden': !show, 'block':show }" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 576 512">
                                        <path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"> </path>
                                    </svg>
                                    <svg class="h-6 text-gray-700" fill="none" @click="show = !show" :class="{'block': !show, 'hidden':show }" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 640 512">
                                        <path fill="currentColor" d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z"></path>
                                    </svg>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-jet-button class="ml-4">
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

<script>
    $(function() {
        $( "#datepicker" ).datepicker({
            dateFormat : 'mm/dd/yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            // maxDate: '-1d'
            clear: true,
        });
    });

</script>
