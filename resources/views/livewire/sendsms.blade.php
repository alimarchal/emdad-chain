<div>
    @if(!$mobile_verify_check)
    <p style="font-size: 16px; padding: 8px;">{{__('register.Please verify your mobile number to proceed')}}</p>

    @if(auth()->user()->rtl == 0)
        <div class="flex flex-wrap overflow-hidden lg:-mx-2">
            @if(!$sendSms)
                <div class="flex flex-wrap mt-3 sm:mt-0" style="justify-content: center">
                    <a href="tel:{{auth()->user()->mobile}}" class="text-red-500 underline mt-3 ml-6">
                        {{auth()->user()->mobile}}
                    </a>
                        <button wire:click="send_sms" style="border-radius: 25px;height: fit-content"
                            class="inline-flex items-center px-4 py-2 mt-4 ml-2 sm:ml-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            {{__('portal.Send Code')}}
                        </button>
                </div>
            @else
                <p style="font-size: 16px; padding: 8px;color: green">{{__('register.We have sent you an SMS code please type and press verify.')}}</p>
            @endif
            @if($sendSms || !is_null(auth()->user()->mobile_verify_code))
                <div class="overflow-hidden lg:my-2 lg:px-2 lg:w-1/3 xl:w-1/3">
                    <div class="flex flex-wrap mt-3 sm:mt-0" style="justify-content: center">
                        <input class="form-input rounded-md shadow-sm mt-1 mb-1 block lg:w-1/4 xl:w-1/4" id="name" placeholder="1234"
                           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "4" minlength="4"
                           type="text" wire:model="sms_code">
                        <button wire:click="verify_sms" style="border-radius: 25px;height: fit-content"
                                class="inline-flex items-center px-4 py-2 mt-2 ml-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            {{__('portal.Verify')}}
                        </button>
                    </div>
                    @if($wrong_sms)
                        <p style="font-size: 16px; padding: 8px;color: red">{{__('register.Your SMS Code is Wrong. Please check and try again.')}}</p>
                    @endif
                </div>
            @endif
        </div>
    @else
        <div class="flex flex-wrap overflow-hidden lg:-mx-2">
        @if(!$sendSms)
            <div class="flex flex-wrap mt-3 sm:mt-0" style="justify-content: center">
                <a href="tel:{{auth()->user()->mobile}}" class="text-red-500 hover:text-red-500 hover:underline underline mt-3 mr-5" style="font-family: sans-serif">
                    {{auth()->user()->mobile}}
                </a>
                    <button wire:click="send_sms" style="margin-right: 38px;border-radius: 25px;height: fit-content"
                        class="inline-flex items-center px-4 py-2 mt-4 mr-2 sm:mr-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        {{__('portal.Send Code')}}
                    </button>
            </div>
        @else
            <p style="font-size: 16px; padding: 8px;color: green">{{__('register.We have sent you an SMS code please type and press verify.')}}</p>
        @endif
            @if($sendSms || !is_null(auth()->user()->mobile_verify_code))
                <div class="overflow-hidden lg:my-2 lg:px-2 lg:w-1/3 xl:w-1/3">
                    <div class="flex flex-wrap mt-3 sm:mt-0" style="justify-content: center">
                        <input class="form-input rounded-md shadow-sm mt-1 mb-1 block lg:w-1/4 xl:w-1/4" id="name" placeholder="1234" style="font-family: sans-serif"
                               oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "4" minlength="4"
                               type="text" wire:model="sms_code">
                        <button wire:click="verify_sms" style="border-radius: 25px;height: fit-content;"
                                class="inline-flex items-center px-4 py-2 mt-2 mr-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            {{__('portal.Verify')}}
                        </button>
                    </div>
                    @if($wrong_sms)
                        <p style="font-size: 16px; padding: 8px;color: red">{{__('register.Your SMS Code is Wrong. Please check and try again.')}}</p>
                    @endif
                </div>
            @endif
        </div>
    @endif
    <br><br>
    <div class="flex flex-wrap overflow-hidden lg:-mx-2">

        @if(!$sendSms)
            <form  class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/4 xl:w-1/4" wire:submit.prevent="send_sms">
                <input
                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "9" minlength="9" pattern="([5][0-9]{8})"
                    type = "tel" placeholder="e.g. 523456789" @if(auth()->user()->rtl == 1)  style="font-family: sans-serif" @endif
                    class="form-input border border-gray-200 rounded-md shadow-sm mt-1 mb-1 block w-full" wire:model="mobile_number" id="mobile_number">
                @error('mobile_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150" type="submit">{{__('register.Update and Send Code')}}</button>
            </form>
        @endif


    </div>
    @endif
</div>



