<div class="w-full">

    @if(!$mobile_verify_check && $warehouse->mobile_verified != 1)
        <p style="padding: 8px;justify-content: center" class="text-xl">{{__('portal.Please verify your mobile number inorder to proceed')}}</p>
        <div class="flex flex-wrap overflow-hidden lg:-mx-2" style="justify-content: center">

            <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/4 xl:w-1/4">
{{--                <a href="tel:{{auth()->user()->mobile}}" class="text-red-500 underline float-left">{{auth()->user()->mobile}}</a>--}}
            </div>

            <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/4 xl:w-1/4">
                @if(!$warehouse->mobile_verification_code)
                    <a wire:click="send_sms" style="cursor: pointer" class="inline-flex mt-2 items-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 hover:text-white active:bg-yellow-500 focus:outline-none focus:border-yellow-500 focus:shadow-outline-yellow disabled:opacity-25 transition ease-in-out duration-150">
                        {{__('portal.Send Code')}}
                    </a>
                @else
                    <p class="text-blue-600" style="font-size: 16px; padding: 8px;">{{__('portal.Verification code is sent to your mobile number.')}}</p>
                @endif
            </div>

            <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/4 xl:w-1/4">
                <input class="form-input rounded-md shadow-sm mt-1 mb-1 block w-full" id="name" type="number" wire:model="sms_code" required>
                @if($wrong_sms)
                    <p class="text-red-600" style="font-size: 16px; padding: 8px;">{{__('portal.Wrong code entered. Try again.')}}</p>
                @endif

            </div>

            <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/4 xl:w-1/4">
                <a wire:click="verify_sms" style="cursor: pointer" class="inline-flex mt-2 items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 hover:text-white active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
                    {{__('portal.Verify')}}
                </a>
            </div>
        </div>
    @elseif($warehouse->mobile_verified == 1 && $i == 1)
        <script>
            location.reload();
        </script>
    @endif
</div>
