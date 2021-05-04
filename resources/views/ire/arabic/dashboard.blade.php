@extends('ire.arabic.layout.app')
@section('headerScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js" integrity="sha512-lteuRD+aUENrZPTXWFRPTBcDDxIGWe5uu0apPEn+3ZKYDwDaEErIK9rvR0QzUGmUQ55KFE2RqGTVoZsKctGMVw==" crossorigin="anonymous"></script>
@endsection
@section('body')
{{--    <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight" name="header" style="padding-top: 20px;">--}}
{{--        --}}{{--                {{ __('Dashboard') }} - Welcome {{ auth()->user()->gender == "0" ?'Mr. ' . Auth::user()->name: auth()->user()->gender == "1" ? 'Mrs.'. Auth::user()->name}}--}}
{{--        {{ __('اللوحة الرئيسية') }} - مرحباً {{auth()->guard('ire')->user()->name}}--}}

{{--    </h2>--}}

    <div class="mt-4">
        <div class="flex flex-wrap -mx-6">
            <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white" style="height:100%;">
                    <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700"></h4>
                        <div class="text-gray-500"><a href="{{route('ireReference')}}">مجموع الممثلين المستقلين الموصى لهم</a></div>
                        @php $iresCount = \App\Models\Ire::where('referred_no', auth()->guard('ire')->user()->ire_no)->count(); @endphp
                        <div class="text-gray-500">{{$iresCount}}</div>
                    </div>
                </div>
            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white" style="height:100%;">
                    <div class="p-3 rounded-full bg-orange-600 bg-opacity-75">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>

                    <div class="mx-5">
                        @php $buyerReferredCount = \App\Models\IreCommission::where('ire_no', auth()->guard('ire')->user()->ire_no)->where('type', 1)->where('status', 1)->count(); @endphp
                        <h4 class="text-2xl font-semibold text-gray-700"></h4>
                        <div class="text-gray-500"><a href="{{route('ireReference')}}">مجموع البائعين الموصى لهم</a></div>
                        <div class="text-gray-500">{{$buyerReferredCount}}</div>
                    </div>
                </div>
            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white" style="height:100%;">
                    <div class="p-3 rounded-full bg-pink-600 bg-opacity-75">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>

                    <div class="mx-5">
                        @php $supplierReferredCount = \App\Models\IreCommission::where('ire_no', auth()->guard('ire')->user()->ire_no)->where('type', 2)->where('status', 1)->count(); @endphp
                        <h4 class="text-2xl font-semibold text-gray-700"></h4>
                        <div class="text-gray-500"><a href="{{route('ireReference')}}">مجموع المورّدين الموصى لهم</a></div>
                        <div class="text-gray-500">{{$supplierReferredCount}}</div>
                    </div>
                </div>
            </div>

            @if(auth()->guard('ire')->user()->type == 0)  {{-- type == 0 is for non-employee--}}
                <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0" style="padding-top: 15px;">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white" style="height:100%;">
                        <div class="p-3 rounded-full bg-pink-600 bg-opacity-75">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>

                        <div class="mx-5">
                            @php
                                $userCreatedAt = \Carbon\Carbon::parse(auth()->guard('ire')->user()->created_at);
                                $remainingDays = $userCreatedAt->addDays(30);
                            @endphp
                            <h4 class="text-2xl font-semibold text-gray-700"></h4>
                            <div class="text-gray-500"><a> يبقى أيام</a></div>
                            <div class="text-gray-500" data-countdown="{{$remainingDays}}"></div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0" style="padding-top: 15px;">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="p-3 rounded-full bg-orange-600 bg-opacity-75">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>

                    <div class="mx-5">
                        @php
                            if ($poCount >= 0 && $poCount <=5)
                            {
                                $remainingBusiness = 5 - $poCount;
                            }
                            else{
                                $remainingBusiness = 0;
                            }
                        @endphp
                        <h4 class="text-2xl font-semibold text-gray-700"></h4>
                        <div class="text-gray-500"><a>Remaining Business</a></div>
                        <div class="text-gray-500">{{$remainingBusiness}}</div>
                    </div>
                </div>
            </div>

{{--            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0" style="padding-top: 15px;">--}}
{{--                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white" style="height:100%;">--}}
{{--                    <div class="p-3 rounded-full bg-pink-600 bg-opacity-75">--}}
{{--                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>--}}
{{--                    </div>--}}

{{--                    <div class="mx-5">--}}
{{--                        @php $incompleteReferredCount = \App\Models\IreCommission::where('ire_no', auth()->guard('ire')->user()->ire_no)->where('type', 3)->where('status', 0)->count(); @endphp--}}
{{--                        <h4 class="text-2xl font-semibold text-gray-700"></h4>--}}
{{--                        <div class="text-gray-500"><a href="{{route('ireArabicIncompleteReference')}}" style="font-family: Nunito,system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;">Incomplete Referrals</a></div>--}}
{{--                        <div class="text-gray-500">{{$incompleteReferredCount}}</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>

<script>
    $('[data-countdown]').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('%D أيام %H:%M:%S'));
        });
    });
</script>
@endsection
