{{--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <!-- <x-jet-authentication-card-logo /> -->

            <img src="{{url('logo.png')}}" alt="EMDAD CHAIN LOGO" class="block h-20 w-auto" />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <x-jet-button>
            <a href="{{route('ireRegisterDetailsArabic')}}" class="get-started-btn scrollto"><img alt="" src="{{url('sa.png')}}" style="margin-right: 2px;margin-top:-4px;">العربية</a>
        </x-jet-button>

        <form method="POST" action="{{route('ireRegisterDetails')}}" enctype="multipart/form-data">
            @csrf
            <p class="text-center font-bold text-2xl">Registration</p>

            {{--            <div class="mt-2">--}}
            {{--                <x-jet-label for="referred_no" value="{{ __('Reference (If any)') }}"  class="mb-2"  />--}}
            {{--                <x-jet-input id="referred_no" class="block mt-1 w-full" type="tel" name="referred_no" :value="old('referred_no')" autofocus  />--}}

            {{--                <x-jet-label for="referred_no_response_found" id="referred_no_response" value=""  class="mb-2" style="color: green" />--}}
            {{--                <x-jet-label for="referred_no_response_not_found" id="referred_no_response_not_found" value="" class="mb-2 text-danger" style="color: red" />--}}
            {{--            </div>--}}

            <div class="mt-2">
                <livewire:reference />
            </div>

            <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-1 lg:-mx-3 xl:-mx-2">

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <x-jet-label for="nid_num" value="{{ __('National ID Number') }}" />
                    <x-jet-input id="nid_num" class="block mt-1 w-full" type="text" pattern="\d*"  maxlength="10" name="nid_num" :value="old('nid_num')" required />
                </div>

            </div>

            <div class="mt-2">
                <x-jet-label for="nid_image" value="{{ __('Upload National ID (max. 5 MB image)') }}" />
                <x-jet-input id="nid_image" type="file" name="nid_image" class="block mt-1 w-full" :value="old('nid_image')" required />
            </div>

            <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-1 lg:-mx-3 xl:-mx-2">

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <x-jet-label for="type" value="{{ __('Employee') }}" class="mb-1" />
                    <select name="type" id="type" class="form-select mb-2 rounded-md shadow-sm block w-full" required autofocus autocomplete="type" >
                        <option disabled selected value="">Select</option>
                        <option {{ old('type') == '0' ? "selected" : '' }} value="0">No</option>
                        <option {{ old('type') == '1' ? "selected" : '' }} value="1">Yes</option>
                    </select>
                </div>

                <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 md:my-1 md:px-1 md:w-full lg:my-3 lg:px-3 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                    <x-jet-label for="bank" value="{{ __('Bank') }}" class="mb-1" />
                    <select name="bank" id="bank" class="form-select mb-2 rounded-md shadow-sm block w-full" required autofocus autocomplete="bank">
                        <option disabled selected value="">Select</option>
                        @foreach($banks as $bank)
                            <option {{ old('bank') == $bank->id ? 'selected' : '' }} value="{{$bank->id}}">{{$bank->name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>


            <div class="mt-2">
                <x-jet-label for="iban" value="{{ __('IBAN') }}" />
                <x-jet-input id="iban" class="block mt-1 w-full" type="text" maxlength="24" name="iban" :value="old('iban')" required />
            </div>

            <x-jet-button class="float-right mt-4 mb-4">Save & Next</x-jet-button>

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
