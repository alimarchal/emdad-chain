{{--<link rel="stylesheet" href="https://www.jqueryscript.net/demo/jQuery-International-Telephone-Input-With-Flags-Dial-Codes/build/css/intlTelInput.css">--}}
<div>
    {{-- The whole world belongs to you. --}}
    @if(!$mobile_verify_check)
    <p style="font-size: 16px; padding: 8px;">{{__('register.Please verify your mobile number to proceed')}}</p>

    @if(auth()->user()->rtl == 0)
        @if(!$sendSms)
        <a href="tel:{{auth()->user()->mobile}}" class="text-red-500 underline float-left">
            {{auth()->user()->mobile}}
        </a> <br>
        @endif
        @if(!$sendSms)
            <button wire:click="send_sms" style="margin-left: 38px;border-radius: 25px;"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                {{__('portal.Send Code')}}
            </button>
            @else
                <p style="font-size: 16px; padding: 8px;color: green">{{__('register.We have send you SMS code please type and press verify.')}}</p>
            @endif
    @else
        @if(!$sendSms)
        <a href="tel:{{auth()->user()->mobile}}" class="text-red-500 underline float-right">
            {{auth()->user()->mobile}}
        </a> <br>
        @endif
        @if(!$sendSms)
            <button wire:click="send_sms" style="margin-right: 38px;border-radius: 25px;"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                {{__('portal.Send Code')}}
            </button>
        @else
            <p style="font-size: 16px; padding: 8px;color: green">{{__('register.We have send you SMS code please type and press verify.')}}</p>
        @endif
    @endif
    <div class="flex flex-wrap overflow-hidden lg:-mx-2">

        @if(!$sendSms)
        <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/4 xl:w-1/4">
            <input class="form-input rounded-md shadow-sm mt-1 mb-1 block w-full" type="tel" wire:model="mobile_number" id="mobile_number" placeholder="{{__('register.Update Number')}}">
        </div>

        <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/4 xl:w-1/4">
            <button wire:click="send_sms" style="border-radius: 25px;"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                {{__('register.Update and Send Code')}}
            </button>
        </div>
        @endif

        <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/4 xl:w-1/4">
            <input class="form-input rounded-md shadow-sm mt-1 mb-1 block w-full" id="name" type="text" wire:model="sms_code">
            @if($wrong_sms)
                <p style="font-size: 16px; padding: 8px;color: red">{{__('register.Your SMS Code is Wrong. Please check and try again.')}}</p>
            @endif

        </div>

        <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/4 xl:w-1/4">
            <button wire:click="verify_sms" style="border-radius: 25px;"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                {{__('portal.Verify')}}
            </button>
        </div>
    </div>
    @endif
</div>


{{--<script>

    $(document).ready(function() {
        $('.intl-tel-input input').css('height', '40px');
        $('.selected-flag').css('padding-top', '12px');
        $('.selected-flag').css('padding-bottom', '12px');
    });

</script>

<script src="{{url('build/js/intlTelInput_2.js')}}"></script>
<script>
    $("#mobile_number").intlTelInput();
</script>--}}
