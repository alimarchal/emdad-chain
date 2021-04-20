<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-1 lg:-mx-3 xl:-mx-2">
        <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
            @if(request()->routeIs('registerAr'))
                <x-jet-label for="seller_no" value="{{ __('الرقم المرجعي (اختياري)') }}"/>
            @else
                <x-jet-label for="seller_no" value="{{ __('Reference Number (Optional)') }}"/>
            @endif  

            <input class="form-input rounded-md shadow-sm block mt-1 mb-1 w-full" id="seller_no" wire:model.lazy="reference" type="text" name="seller_no">
        </div>

        <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
            <!-- Column Content -->
            <a wire:click="increment"
               class="inline-flex items-center px-4 py-0 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                @if(request()->routeIs('registerAr'))
                    التحقق من المرجع
                @else
                    Verify the Reference
                @endif
            </a>
            <br>
            @if(empty(!$reference))
                @if($user)
                    <h1 class="mt-3 ml-3">{{$user->name}}</h1>
                @else
                    @if(request()->routeIs('registerAr'))
                        <h1 class="mt-3 ml-3">رقم مرجعي غير صحيح</h1>
                    @else
                        <h1 class="mt-3 ml-3">Invalid Reference Number</h1>
                    @endif

                @endif
            @endif

        </div>


    </div>
</div>
