@section('headerScripts')

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>
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
@endsection

@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Supplier') }}
            </h2>
        </x-slot>

        <div>
            <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                <a href="{{ route('businessSuppliers') }}"
                   class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none active:bg-green-600 transition ease-in-out duration-150">
                    {{__('portal.List of Suppliers')}}
                </a>
            </div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <x-jet-validation-errors class="mb-4" />
                <div class="mt-5 md:mt-0 md:col-span-2">
                    {{--                <form method="post" action="{{route('createUserForCompany',auth()->user()->business->id)}}">--}}
                    <form method="post" action="{{route('storeSupplier')}}">
                        @csrf
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">

                                <h3 class="text-2xl text-center mb-2">{{__('sidebar.Add Supplier')}}</h3>
                                <div class="grid grid-cols-8 gap-6">
                                    <!-- Name -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <x-jet-label for="gender" value="{{ __('portal.Title') }}" class="mb-1" />

                                        <select name="gender" id="gender" class="form-select mb-2 rounded-md shadow-sm block w-full" required autofocus autocomplete="name" >
                                            <option value="">{{__('portal.Select')}}</option>
                                            <option value="Male">{{__('register.Mr.')}}</option>
                                            <option value="Female">{{__('register.Ms.')}}</option>
                                            <option value="Female">{{__('register.Mrs.')}}</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="name">
                                            {{__('register.First Name')}}
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="name" type="text" name="name" value="{{old('name')}}" required>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <x-jet-label for="middle_initial" value="{{ __('register.Middle Initial') }}" />
                                        <x-jet-input id="middle_initial" class="block mt-1 w-full" type="text" maxlength="3" name="middle_initial" :value="old('middle_initial')" required autofocus autocomplete="middle_initial" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <x-jet-label for="family_name" value="{{ __('register.Family Name') }}" />
                                        <x-jet-input id="family_name" class="block  mt-1 w-full" type="text" name="family_name" :value="old('family_name')" required autofocus autocomplete="family_name" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <x-jet-label for="nid_num" value="{{ __('register.National ID Number') }}" />
                                        <x-jet-input id="nid_num" class="block mt-1 w-full" type="text" pattern="\d*"  maxlength="10" name="nid_num" :value="old('nid_num')" required />
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <x-jet-label for="nid_exp_date" value="{{ __('register.National ID Expiry Date') }}" />
                                        <input type="text" id="datepicker" class="block mt-1 w-full" name="nid_exp_date" value="{{old('nid_exp_date')}}" placeholder="{{__('register.Choose Date')}} (yy/mm/dd)" readonly>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <x-jet-label for="mobile" value="{{ __('register.Mobile Number') }}"  class="mb-1"  />
                                        <input id="phone" name="mobile" type="tel" class="form-input rounded-md shadow-sm block mt-1 w-full" value="{{old('mobile')}}" required>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <x-jet-label for="email" value="{{ __('register.Email') }}" />
                                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <div class="py-2" x-data="{ show: true }">
                                            <x-jet-label for="password" value="{{ __('register.Password') }}" />
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


                                    <div class="col-span-6 sm:col-span-2">
                                        <x-jet-label for="password_confirmation" value="{{ __('register.Confirm Password') }}" />
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
                                </div>
                            </div>

                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
                                    {{__('portal.Create')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--
            <x-jet-section-border/>
            <x-jet-section-title title="Create User" description="Update your account's profile information and email address."/>
            <x-jet-section-border/>
            -->
        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Supplier') }}
            </h2>
        </x-slot>

        <div>
            <div class="mt-5" style=" margin-right: 30px; margin-bottom: 10px ">
                <a href="{{ route('businessSuppliers') }}" style="background-color: #145EA8"
                   class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none active:bg-green-600 transition ease-in-out duration-150">
                    {{__('portal.List of Suppliers')}}
                </a>
            </div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <x-jet-validation-errors class="mb-4" />
                <div class="mt-5 md:mt-0 md:col-span-2">
                    {{--                <form method="post" action="{{route('createUserForCompany',auth()->user()->business->id)}}">--}}
                    <form method="post" action="{{route('storeSupplier')}}">
                        @csrf
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">

                                <h3 class="text-2xl text-center mb-2">{{__('sidebar.Add Supplier')}}</h3>
                                <div class="grid grid-cols-8 gap-6">
                                    <!-- Name -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <x-jet-label for="gender" value="{{ __('portal.Title') }}" class="mb-1" />

                                        <select name="gender" id="gender" class="form-select mb-2 rounded-md shadow-sm block w-full" required autofocus autocomplete="name" >
                                            <option value="">{{__('portal.Select')}}</option>
                                            <option value="Male">{{__('register.Mr.')}}</option>
                                            <option value="Female">{{__('register.Ms.')}}</option>
                                            <option value="Female">{{__('register.Mrs.')}}</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="name">
                                            {{__('register.First Name')}}
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="name" type="text" name="name" value="{{old('name')}}" required>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <x-jet-label for="middle_initial" value="{{ __('register.Middle Initial') }}" />
                                        <x-jet-input id="middle_initial" class="block mt-1 w-full" type="text" maxlength="3" name="middle_initial" :value="old('middle_initial')" required autofocus autocomplete="middle_initial" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <x-jet-label for="family_name" value="{{ __('register.Family Name') }}" />
                                        <x-jet-input id="family_name" class="block  mt-1 w-full" type="text" name="family_name" :value="old('family_name')" required autofocus autocomplete="family_name" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <x-jet-label for="nid_num" value="{{ __('register.National ID Number') }}" />
                                        <x-jet-input id="nid_num" class="block mt-1 w-full" type="text" pattern="\d*"  maxlength="10" name="nid_num" :value="old('nid_num')" required />
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <x-jet-label for="nid_exp_date" value="{{ __('register.National ID Expiry Date') }}" />
                                        <input type="text" id="datepicker" class="block mt-1 w-full" name="nid_exp_date" value="{{old('nid_exp_date')}}" placeholder="{{__('register.Choose Date')}} (yy/mm/dd)" readonly>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <x-jet-label for="mobile" value="{{ __('register.Mobile Number') }}"  class="mb-1"  />
                                        <input id="phone" name="mobile" type="tel" class="form-input rounded-md shadow-sm block mt-1 w-full" value="{{old('mobile')}}" required>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <x-jet-label for="email" value="{{ __('register.Email') }}" />
                                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <div class="py-2" x-data="{ show: true }">
                                            <x-jet-label for="password" value="{{ __('register.Password') }}" />
                                            <div class="relative">
                                                <input name="password" id="password" required autocomplete="new-password" :type="show ? 'password' : 'text'" class="form-input rounded-md shadow-sm block mt-1 w-full">
                                                <div class="absolute inset-y-0 left-0 pr-3 flex items-center text-sm leading-5 ml-2">
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


                                    <div class="col-span-6 sm:col-span-2">
                                        <x-jet-label for="password_confirmation" value="{{ __('register.Confirm Password') }}" />
                                        <div class="py-2" x-data="{ show: true }">
                                            <div class="relative">
                                                <input id="password_confirmation" name="password_confirmation" required autocomplete="new-password" :type="show ? 'password' : 'text'" class="form-input rounded-md shadow-sm block mt-1 w-full">
                                                <div class="absolute inset-y-0 left-0 pr-3 flex items-center text-sm leading-5 ml-2">
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
                            </div>

                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
                                    {{__('portal.Create')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--
            <x-jet-section-border/>
            <x-jet-section-title title="Create User" description="Update your account's profile information and email address."/>
            <x-jet-section-border/>
            -->
        </div>
    </x-app-layout>
@endif

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
