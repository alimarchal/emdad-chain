<div>
    {{-- The whole world belongs to you. --}}
    @if(!$mobile_verify_check)
    <p style="font-size: 16px; padding: 8px;">Please verify your mobile number</p>
    <div class="flex flex-wrap overflow-hidden lg:-mx-2">

        <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/4 xl:w-1/4">
            <a href="tel:{{auth()->user()->mobile}}" class="text-red-500 underline float-left">{{auth()->user()->mobile}}</a>
        </div>

        <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/4 xl:w-1/4">
            @if(!$sendSms)
            <button  wire:click="send_sms"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                Send Code
            </button>
            @else
                <p style="font-size: 16px; padding: 8px;">We have send you SMS code please type and press verify.</p>
            @endif
        </div>

        <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/4 xl:w-1/4">
            <input class="form-input rounded-md shadow-sm mt-1 mb-1 block w-full" id="name" type="text" wire:model="sms_code">
{{--            {{$sms_code}}--}}
            @if($wrong_sms)
                <p style="font-size: 16px; padding: 8px;">Your SMS Code is Wrong. Please check and try again.</p>
            @endif

        </div>

        <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/4 xl:w-1/4">
            <button wire:click="verify_sms"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                Verify
            </button>
        </div>
    </div>
    @endif
</div>
