<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
        </x-slot>
        <x-jet-validation-errors class="mb-4"/>

        <a href="{{route('registerAr', 'ar')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150" style="border-radius: 25px;">
            <img alt="" src="{{url('sa.png')}}" style="margin-right: 2px;margin-top:-4px;">
            العربية
        </a>

        <a href="{{route('english.index')}}">
            <img src="{{url('logo.png')}}" alt="EMDAD CHAIN LOGO" class="block w-16 mx-auto float-right " />
        </a>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="mt-5">
            @csrf

            <img src="{{url('registration_step/E-1.png')}}" alt="User Registration" class="block w-auto m-auto" style="margin:auto;"/>
            <p class="text-center font-bold text-2xl mt-4">{{__('register.Step # 1: Registration')}}</p>

            <div class="flex flex-wrap overflow-hidden lg:-mx-3 xl:-mx-3">

                  <div class="w-full overflow-hidden lg:my-1 lg:px-1 lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2">
                    <x-jet-label for="referred_no" value="{{ __('register.Reference (If any)') }}" class="mb-2"/>
                    <x-jet-input id="referred_no" class="block mt-1 w-full" type="text" name="referred_no" :value="old('referred_no')" autofocus/>

                    <x-jet-label for="referred_no_response_found" id="referred_no_response" value="" class="mb-2" style="color: green"/>
                    <x-jet-label for="referred_no_response_not_found" id="referred_no_response_not_found" value="" class="mb-2 text-danger" style="color: red"/>

                </div>

                <div class="w-full overflow-hidden lg:my-1 lg:px-1 lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2">
                    <label class="block font-medium text-sm text-gray-700 mb-2" for="service">
                        Register as <span class="text-red-500">*</span>
                    </label>

                    <select name="service" id="service" class="form-select mb-2 rounded-md shadow-sm block w-full" required autofocus autocomplete="name">
                        <option value="">{{__('register.Select')}}</option>
                        <option {{old('service') == 1 ? 'selected' : ''}} value="1">{{__('register.CEO (Buyer)')}}</option>
                        <option {{old('service') == 2 ? 'selected' : ''}} value="2">{{__('register.CEO (Supplier)')}}</option>
{{--                        <option {{old('service') == 3 ? 'selected' : ''}} value="3">{{__('register.Logistics Solution')}}</option>--}}
                    </select>
                </div>




            </div>


            <div class="flex flex-wrap  lg:-mx-2 xl:-mx-2">



                <div class="w-full overflow-hidden lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                    <label class="block font-medium text-sm text-gray-700 mb-2" for="gender">
                        Title <span class="text-red-500">*</span>
                    </label>

                    <select name="gender" id="gender" class="form-select mb-2 rounded-md shadow-sm block w-full" required autofocus autocomplete="name">
                        <option value="">{{ __('register.Select') }}</option>
                        <option value="Male">{{ __('register.Mr.') }}</option>
                        <option value="Female">{{ __('register.Ms.') }}</option>
                        <option value="Female">{{ __('register.Mrs.') }}</option>
                    </select>
                </div>

                <div class="w-full overflow-hidden lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                    <label class="block font-medium text-sm text-gray-700" for="name">
                        Name <span class="text-red-500">*</span>
                    </label>
                    <x-jet-input id="name" class="block mt-2 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"/>
                </div>


                <div class="w-full overflow-hidden lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                    <label class="block font-medium text-sm text-gray-700" for="family_name">
                       Family Name <span class="text-red-500">*</span>
                    </label>
                    <x-jet-input id="family_name" class="block mt-2 w-full" type="text" name="family_name" :value="old('family_name')" required autocomplete="family_name"/>
                </div>



            </div>

            <div class="flex flex-wrap  lg:-mx-2 xl:-mx-2">

                <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/3 xl:my-2 xl:px-2 xl:w-1/3">

                    <label class="block font-medium text-sm text-gray-700" for="company_name">
                        Company Name <span class="text-red-500">*</span>
                    </label>
                    <x-jet-input id="company_name" class="block my-2 w-full" type="text" name="company_name" :value="old('company_name')" required autocomplete="company_name"/>
                </div>

                <div class="w-full lg:my-2 lg:px-2 lg:w-1/3 xl:my-2 xl:px-2 xl:w-1/3">

                    <label class="block font-medium text-sm text-gray-700 mb-2" for="mobile-number">
                        Mobile Number <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" id="mobile-number" style="padding-top: 12px;padding-bottom: 12px;" name="mobile" placeholder="e.g. +966 059 338 8833" class="form-input rounded-md shadow-sm block my-2 w-full">

                </div>



                <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/3 xl:my-2 xl:px-2 xl:w-1/3">
                    <label class="block font-medium text-sm text-gray-700" for="email">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <x-jet-input id="email" class="block my-2  w-full" type="email" name="email" :value="old('email')" required/>
                </div>

            </div>


            <div class="flex flex-wrap overflow-hidden lg:-mx-2 xl:-mx-2">

                <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/3 xl:my-2 xl:px-2 xl:w-1/3">
                    <div x-data="{ show: true }">
                        <label class="block font-medium text-sm text-gray-700" for="password">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input name="password" id="password" required autocomplete="new-password" :type="show ? 'password' : 'text'" class="form-input rounded-md shadow-sm block my-2 w-full">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 mr-2">
                                <svg class="h-6 text-gray-700" fill="none" @click="show = !show" :class="{'hidden': !show, 'block':show }" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 576 512">
                                    <path fill="currentColor"
                                          d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"></path>
                                </svg>
                                <svg class="h-6 text-gray-700" fill="none" @click="show = !show" :class="{'block': !show, 'hidden':show }" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 640 512">
                                    <path fill="currentColor"
                                          d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/3 xl:my-2 xl:px-2 xl:w-1/3">
                    <div x-data="{ show: true }">
                        <label class="block font-medium text-sm text-gray-700" for="password_confirmation">
                            Confirm Password <span class="text-red-500">*</span>
                        </label>
                        <div x-data="{ show: true }">
                            <div class="relative">
                                <input id="password_confirmation" name="password_confirmation" required autocomplete="new-password" :type="show ? 'password' : 'text'" class="form-input rounded-md shadow-sm block my-2 w-full">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 mr-2">
                                    <svg class="h-6 text-gray-700" fill="none" @click="show = !show" :class="{'hidden': !show, 'block':show }" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 576 512">
                                        <path fill="currentColor"
                                              d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"></path>
                                    </svg>
                                    <svg class="h-6 text-gray-700" fill="none" @click="show = !show" :class="{'block': !show, 'hidden':show }" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 640 512">
                                        <path fill="currentColor"
                                              d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z"></path>
                                    </svg>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/3 xl:my-2 xl:px-2 xl:w-1/3">
                </div>
            </div>

            <div class="flex flex-wrap overflow-hidden">

                <div class="w-full overflow-hidden">
                    <label for="policy_procedure" class="flex items-center">
                        <input id="policy_procedure" type="checkbox" class="form-checkbox my-2" name="policy_procedure" required>
                        <span class="ml-2 text-sm text-gray-600">{{ __('register.I agree')}}</span> <a href="{{route('policyProcedure.eula')}}" target="_blank" class="ml-2 text-sm text-red-600"><u>{{ __('register.Policy and Procedures') }}</u></a>
                    </label>
                </div>

            </div>

            <div class="flex flex-wrap overflow-hidden lg:-mx-3 xl:-mx-3">

                <div class="w-full overflow-hidden lg:my-3 lg:px-3 lg:w-1/3 xl:my-3 xl:px-3 xl:w-1/3">
                    <!-- Column Content -->
                </div>

                <div class="w-full overflow-hidden lg:my-3 lg:px-3 lg:w-1/3 xl:my-3 xl:px-3 xl:w-1/3">
                    <!-- Column Content -->
                </div>

                <div class="w-full overflow-hidden lg:my-3 lg:px-3 lg:w-1/3 xl:my-3 xl:px-3 xl:w-1/3">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('register.Already registered?') }}
                    </a>

                    <x-jet-button class="ml-4">
                        {{ __('register.Register') }}
                    </x-jet-button>
                </div>

            </div>



        </form>
    </x-jet-authentication-card>
</x-guest-layout>

<script>
    // $(function () {
    //     $("#datepicker").datepicker({
    //         dateFormat: 'mm/dd/yy',
    //         changeMonth: true,
    //         changeYear: true,
    //         yearRange: '-100y:c+nn',
    //         // maxDate: '-1d'
    //         clear: true,
    //     });
    // });

    $(document).ready(function() {
        $('.intl-tel-input input').css('height', '40px');
        $('.selected-flag').css('padding-top', '12px');
        $('.selected-flag').css('padding-bottom', '12px');
    });

    $('#referred_no').on('keyup', function () {
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: "{{ route('search_ire') }}",
            data: {'referred_no': $value},
            success: function (response) {
                if (response.status === 0) {
                    $('#referred_no_response').empty();
                    $('#referred_no_response_not_found').html('Not record found');
                } else {
                    $('#referred_no_response_not_found').empty();
                    $('#referred_no_response').html('Reference Verified: ' + response.data);
                }
            }
        });
    })

</script>
