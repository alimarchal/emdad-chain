<style>
    #datepicker {
        /*display: none;*/
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
    }
</style>
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <!-- <x-jet-authentication-card-logo /> -->

            <img src="{{url('logo.png')}}" alt="EMDAD CHAIN LOGO" class="block h-20 w-auto" />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <div style="direction: rtl">
            <x-jet-button>
                <a href="{{route('register')}}" class="get-started-btn scrollto"><img alt="" src="{{url('us.png')}}" style="margin-right: 2px;margin-top: -4px;">English</a>
            </x-jet-button>
        </div>

        <form method="POST" action="{{ route('register') }}" style="direction: rtl">
            @csrf
{{--            <p class="text-center font-bold text-2xl">الخطوة الأولى: التسجيل</p>--}}
{{--            <livewire:reference />--}}

            <div class="mt-2">
                <x-jet-label for="referred_no" value="{{ __('المرجع (ان وجد)') }}"  class="mb-2"  />
                <x-jet-input id="referred_no" class="block mt-1 w-full" type="text" name="referred_no" :value="old('referred_no')" autofocus  />

                <x-jet-label for="referred_no_response_found" id="referred_no_response" value=""  class="mb-2" style="color: green" />
                <x-jet-label for="referred_no_response_not_found" id="referred_no_response_not_found" value="" class="mb-2 text-danger" style="color: red" />
            </div>

            <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-1 lg:-mx-3 xl:-mx-2">

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <x-jet-label for="gender" value="{{ __('اللقب') }}" class="mb-2" />
                    <select name="gender" id="gender" class="form-select mb-2 rounded-md shadow-sm block w-full" required autofocus autocomplete="name" >
                        <option value="">اختر</option>
                        <option value="Male">سيد</option>
                        <option value="Male">آنسة</option>
                        <option value="Female">سيدة</option>
                    </select>
                </div>

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <!-- Column Content -->
                    <x-jet-label for="name" value="{{ __('الاسم الأول') }}" />
                    <x-jet-input id="name" class="block mt-2 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="my-0 px-2 w-full overflow-hidden pb-2 sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <!-- Column Content -->
                    <x-jet-label for="middle_initial" value="{{ __('أول حرف من اسم الأب') }}" />
                    <x-jet-input id="middle_initial" class="block mt-2 w-full" type="text" maxlength="3" name="middle_initial" :value="old('middle_initial')" required autofocus autocomplete="middle_initial" />
                </div>

                <div class="my-0  px-2 w-full overflow-hidden  pb-2 sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <!-- Column Content -->
                    <x-jet-label for="family_name" value="{{ __('العائلة') }}" />
                    <x-jet-input id="family_name" class="block  mt-2 w-full" type="text" name="family_name" :value="old('family_name')" required autofocus autocomplete="family_name" />
                </div>

            </div>

            <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-1 lg:-mx-3 xl:-mx-2">

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <x-jet-label for="nid_num" value="{{ __('رقم الهوية الوطنية') }}" />
                    <x-jet-input id="nid_num" class="block mt-1 w-full" type="number" pattern="\d*"  maxlength="10" name="nid_num" :value="old('nid_num')" required />
                </div>

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <!-- Column Content -->
{{--                    <x-jet-label for="nid_exp_date" value="{{ __('تاريخ انتهاء الهوية الوطنية') }}" />--}}
{{--                    <x-jet-input id="nid_exp_date" class="block mt-1 w-full" type="date" name="nid_exp_date" :value="old('nid_exp_date')" required min="{{date('Y-m-d')}}" />--}}

                    <x-jet-label for="nid_exp_date" value="{{ __('تاريخ انتهاء الهوية الوطنية') }}" />
                    <input type="text" id="datepicker" class="block mt-1 w-full" name="nid_exp_date" placeholder="اختر موعدا (mm\dd\yy)">
                </div>

            </div>


            <div class="mt-2" style="direction: ltr;">
                <x-jet-label for="mobile" value="{{ __('رقم الجوال') }}"  class="mb-2 float-right" style="direction: rtl;"  />
                <input id="phone" name="mobile" type="tel" class="form-input rounded-md shadow-sm block mt-1 w-full" >
{{--                <x-jet-input id="mobile" class="block mt-1 w-full" type="tel" name="mobile" :value="old('mobile')"  />--}}
            </div>


            <div class="mt-2">
                <x-jet-label for="email" value="{{ __('البريد الإلكتروني') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('كلمة المرور') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('تأكيد كلمة المرور') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="block mt-4">
                <label for="policy_procedure" class="flex items-center">
                    <input id="policy_procedure" type="checkbox" class="form-checkbox" name="policy_procedure" required>
                    <span class="ml-2 text-sm text-gray-600">I agree</span> <a href="{{route('arabic.policyProcedure.eula')}}" target="_blank" class="ml-2 text-sm text-red-600"><u>{{ __('Policy and Procedures') }}</u></a>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('loginAr') }}">
                    {{ __('هل سبق لك التسجيل؟') }}
                </a>

                &nbsp;
                <x-jet-button class="ml-4">
                    {{ __('تسجيل') }}
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
        });
    });

    $('#referred_no').on('keyup',function(){
        $value=$(this).val();
        $.ajax({
            type : 'get',
            url:"{{ route('search_ire') }}",
            data:{'referred_no':$value},
            success: function (response) {
                if(response.status === 0){
                    $('#referred_no_response').empty();
                    $('#referred_no_response_not_found').html('Not record found');
                }
                else {
                    $('#referred_no_response_not_found').empty();
                    $('#referred_no_response').html(response.data);
                }
            }
        });
    })
</script>
