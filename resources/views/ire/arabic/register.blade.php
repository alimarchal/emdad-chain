<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <!-- <x-jet-authentication-card-logo /> -->

            <img src="{{url('logo.png')}}" alt="EMDAD CHAIN LOGO" class="block h-20 w-auto" />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <div style="direction: rtl">
            <x-jet-button>
                <a href="{{route('ireRegister')}}" class="get-started-btn scrollto"><img alt="" src="{{url('us.png')}}" style="margin-right: 2px;margin-top: -4px;">English</a>
            </x-jet-button>
        </div>

        <form method="POST" action="{{ route('ireRegister') }}" style="direction: rtl">
            @csrf
            <p class="text-center font-bold text-2xl">الخطوة الأولى: التسجيل</p>

{{--            <div class="mt-2">--}}
{{--                <x-jet-label for="referred_no" value="{{ __('المرجع(لو اي)') }}"  class="mb-2"  />--}}
{{--                <x-jet-input id="referred_no" class="block mt-1 w-full" type="tel" name="referred_no" :value="old('referred_no')" autofocus  />--}}

{{--                <x-jet-label for="referred_no_response_found" id="referred_no_response" value=""  class="mb-2" style="color: green" />--}}
{{--                <x-jet-label for="referred_no_response_not_found" id="referred_no_response_not_found" value="" class="mb-2 text-danger" style="color: red" />--}}
{{--            </div>--}}

            <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-1 lg:-mx-3 xl:-mx-2">

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <!-- Column Content -->
                    <x-jet-label for="firstName" value="{{ __('الاسم') }}" />
                    <x-jet-input id="firstName" class="block mt-2 w-full" type="text" name="firstName" :value="old('firstName')" required autofocus autocomplete="firstName" />
                </div>

                <div class="my-0 px-2 w-full overflow-hidden pb-2 sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <!-- Column Content -->
                    <x-jet-label for="lastName" value="{{ __('العائلة') }}" />
                    <x-jet-input id="lastName" class="block mt-2 w-full" type="text" name="lastName" :value="old('lastName')" required autofocus autocomplete="lastName" />
                </div>

            </div>

            <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-1 lg:-mx-3 xl:-mx-2">

{{--                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">--}}
{{--                    <x-jet-label for="gender" value="{{ __('سيد/آنسة/سيدة') }}" class="mb-1" />--}}
{{--                    <select name="gender" id="gender" class="form-select mb-2 rounded-md shadow-sm block w-full" required autofocus autocomplete="gender">--}}
{{--                        <option disabled selected value="">اختر</option>--}}
{{--                        <option {{ old('gender') == 0 ? 'selected' : '' }} value="0">سيد</option>--}}
{{--                        <option {{ old('gender') == 1 ? 'selected' : '' }} value="1">آنسة</option>--}}
{{--                        <option {{ old('gender') == 2 ? 'selected' : '' }} value="1">سيدة</option>--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">--}}
{{--                    <x-jet-label for="nid_num" value="{{ __('رقم الهوية الوطنية') }}" />--}}
{{--                    <x-jet-input id="nid_num" class="block mt-1 w-full" type="text" pattern="\d*"  maxlength="10" name="nid_num" :value="old('nid_num')" required />--}}
{{--                </div>--}}

{{--                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">--}}
{{--                    <x-jet-label for="type" value="{{ __('موظف') }}" class="mb-1" />--}}
{{--                    <select name="type" id="type" class="form-select mb-2 rounded-md shadow-sm block w-full" required autofocus autocomplete="type" >--}}
{{--                        <option disabled selected value="">اختر</option>--}}
{{--                        <option {{ old('type') == 0 ? "selected" : "" }} value="0">لا</option>--}}
{{--                        <option {{ old('type') == 1 ? "selected" : "" }} value="1">نعم</option>--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">--}}
{{--                    <x-jet-label for="bank" value="{{ __('بنك') }}" class="mb-1" />--}}
{{--                    <select name="bank" id="bank" class="form-select mb-2 rounded-md shadow-sm block w-full" required autofocus autocomplete="bank">--}}
{{--                        <option disabled selected value="">اختر</option>--}}
{{--                        @foreach($banks as $bank)--}}
{{--                            <option {{ old('bank') == $bank->id ? 'selected' : '' }} value="{{$bank->id}}">{{$bank->ar_name}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}

            </div>

{{--            <div class="mt-2">--}}
{{--                <x-jet-label for="iban" value="{{ __('IBAN') }}" />--}}
{{--                <x-jet-input id="iban" class="block mt-1 w-full" type="text" maxlength="24" name="iban" :value="old('iban')" required />--}}
{{--            </div>--}}


            <div class="mt-2">
                <x-jet-label for="mobile_number" value="{{ __('رقم الجوال') }}"  class="mb-2"  />
                <x-jet-input id="mobile_number" class="block mt-1 w-full" type="tel" name="mobile_number" :value="old('mobile_number')"  />
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
                    <span class="ml-2 text-sm text-gray-600" style="padding-right: 10px;">أقبل</span> <a href="{{route('arabic.policyProcedure.ire')}}" target="_blank" class="ml-2 text-sm text-red-600"><u>{{ __('الشروط والأحكام') }}</u></a>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{route('ireLoginArabic')}}">
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
<div class="flex items-center justify-end mt-4">

</div>


<script type="text/javascript">

    {{--$('#referred_no').on('keyup',function(){--}}
    {{--    $value=$(this).val();--}}
    {{--    $.ajax({--}}
    {{--        type : 'get',--}}
    {{--        url:"{{ route('search_ire') }}",--}}
    {{--        data:{'referred_no':$value},--}}
    {{--        // success:function(data){--}}
    {{--        //         $('#referred_no_response').html(data.message);--}}
    {{--        // },--}}
    {{--        success: function (response) {--}}
    {{--            if(response.status === 0){--}}
    {{--                $('#referred_no_response').empty();--}}
    {{--                $('#referred_no_response_not_found').html('Not record found');--}}
    {{--            }--}}
    {{--            else {--}}
    {{--                $('#referred_no_response_not_found').empty();--}}
    {{--                $('#referred_no_response').html(response.data);--}}
    {{--            }--}}
    {{--        }--}}
    {{--    });--}}
    {{--})--}}

</script>
