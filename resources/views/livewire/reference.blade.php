<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-1 lg:-mx-3 xl:-mx-2">
        <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
            @if(request()->routeIs('ireRegisterDetailsArabic'))
                <x-jet-label for="seller_no" value="{{ __('الرقم المرجعي (اختياري)') }}"/>
            @else
                <x-jet-label for="seller_no" value="{{ __('Reference Number (Optional)') }}"/>
            @endif

            <input class="form-input rounded-md shadow-sm block mt-1 mb-1 w-full" id="seller_no" wire:model.lazy="reference" type="text" name="referred_no">
        </div>

        <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
            <!-- Column Content -->
            <a wire:click="increment" id="referred_no" style="cursor: context-menu"
               class="inline-flex items-center px-4 py-0 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                @if(request()->routeIs('ireRegisterDetailsArabic'))
                    تفعيل التوصية
                @else
                    Verify the Reference
                @endif
            </a>
            <br>
            @if(empty(!$reference))

                @if($userType == 0) {{-- type == 0 => for non-employee  --}}

                    @if($user && $days < 30 && $poCount < 5 )
                        <h1 class="mt-3 text-green-600 ml-3">{{$user->name}}</h1>
                        <h1 class="mt-3 text-red-600 ml-3" id="days">This reference can't be used at this time</h1>
                    @elseif($user && $days < 30)
                        <h1 class="mt-3 text-green-600 ml-3">{{$user->name}}</h1>
                        <h1 class="mt-3 text-red-600 ml-3" id="days">This reference can't be used at this time</h1>
                    @elseif($user && $poCount < 5)
                        <h1 class="mt-3 text-green-600 ml-3">{{$user->name}}</h1>
                        <h1 class="mt-3 text-red-600 ml-3" id="days">This reference can't be used at this time</h1>
                    @elseif($user)
                        <h1 class="mt-3 text-green-600 ml-3">{{$user->name}}</h1>
                    @else
                        @if(request()->routeIs('ireRegisterDetailsArabic'))
                            <h1 class="mt-3 ml-3">رقم مرجعي غير صحيح</h1>
                        @else
                            <h1 class="mt-3 ml-3 text-red-600">Invalid Reference Number</h1>
                        @endif

                    @endif

                @elseif($userType == 1) {{-- type == 1 => for employee  --}}

                    @if($user && $poCount < 5 )
                        <h1 class="mt-3 text-green-600 ml-3">{{$user->name}}</h1>
                        <h1 class="mt-3 text-red-600 ml-3" id="days">This reference can't be used at this time</h1>
                    @elseif($user)
                        <h1 class="mt-3 text-green-600 ml-3">{{$user->name}}</h1>
                    @else
                        @if(request()->routeIs('ireRegisterDetailsArabic'))
                            <h1 class="mt-3 ml-3">رقم مرجعي غير صحيح</h1>
                        @else
                            <h1 class="mt-3 ml-3 text-red-600">Invalid Reference Number</h1>
                        @endif

                    @endif

                @else
                    <h1 class="mt-3 ml-3 text-red-600">Invalid Reference Number</h1>
                @endif

            @endif

        </div>


    </div>
</div>
