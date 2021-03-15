@if(auth()->user()->rtl == 0)
<x-app-layout>
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-15 mx-auto">
            <div class="flex flex-wrap -m-4">
                <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                    <div class="h-full p-6 rounded-lg border-2 border-gray-300 flex flex-col relative bg-white overflow-hidden">
                        <h2 class="text-sm tracking-widest title-font mb-1 font-medium">Basic</h2>
                        <span class="text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                        <h1 class="text-4xl text-gray-900 pb-4 mb-4 border-b border-gray-200 leading-none">Free</h1>

                        <button class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded" disabled>Subscribe
{{--                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">--}}
{{--                                <path d="M5 12h14M12 5l7 7-7 7"></path>--}}
{{--                            </svg>--}}
                        </button>
                    </div>

                    <!-- style="background-color: #ececec; border: 2px solid #c3c3c3" -->
                </div>
                <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                    <div class="h-full p-6 rounded-lg border-gray-800 flex flex-col relative bg-gray-300 overflow-hidden" style="background-color: #ececec; border: 2px solid #c3c3c3" >
                        <span class="bg-blue-500 text-white px-3 py-1 tracking-widest text-xs absolute left-0 top-0 rounded-bl">POPULAR</span>
                        <span class="text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                        <h2 class="text-sm tracking-widest title-font mb-1 font-medium">Silver</h2>
                        <h1 class="text-4xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                            <span>1500 SAR</span>
                            <span class="text-lg ml-1 font-normal text-gray-500">/year</span>
                        </h1>

                        <button class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">Subscribe</button>
                    </div>
                </div>
                <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                    <div class="h-full p-6 rounded-lg border-2 border-gray-300 flex flex-col relative bg-gray-300 overflow-hidden" style="background-color: #ececec; border: 2px solid #c3c3c3" >
                        <span class="text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                        <h2 class="text-sm tracking-widest title-font mb-1 font-medium">Gold</h2>
                        <h1 class="text-4xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                            <span>5000 SAR</span>
                            <span class="text-lg ml-1 font-normal text-gray-500">/year</span>
                        </h1>

                        <button class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded">Subscribe</button>
                    </div>
                </div>
                <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                    <div class="h-full p-6 rounded-lg border-2 border-gray-300 flex flex-col relative bg-gray-300 overflow-hidden" style="background-color: #ececec; border: 2px solid #c3c3c3" >
                        <span class="text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                        <h2 class="text-sm tracking-widest title-font mb-1 font-medium">Platinum</h2>
{{--                        <h1 class="text-4xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">--}}
{{--                            --}}

{{--                        </h1>--}}
                        <span class="font-bold text-2xl">Free</span>
                        <span class="text-lg ml-1 font-normal text-black">If purchases more than 5 million/month</span>
                        <button class="flex items-center mt-auto text-white bg-gray-600 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-700 rounded">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-gray-600 body-font">
        <div class="container mx-auto">
            <div class="lg:w-2/9 w-full mx-auto overflow-auto">
                <table class="table-auto bg-white overflow-hidden w-full text-left whitespace-no-wrap">
                    <thead>
                    <tr>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm text-center bg-gray-500 rounded-tl rounded-bl">Functions</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm text-center bg-gray-500">Basic</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm text-center bg-gray-500">Silver</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm text-center bg-gray-500">Gold</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm text-center bg-gray-500">Platinum</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="px-4 py-3">Subscription For 1 year</td>
                        <td class="px-4 py-3 text-center">Free</td>
                        <td class="px-4 py-3 text-center">1500</td>
                        <td class="px-4 py-3 text-center">5000</td>
                        <td class="px-4 py-3 text-center">Free (5 million purchases / month)</td>
                    </tr>
                    <tr>
                        <td class="border-t-2 border-gray-200 px-4 py-3">Registeration</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Free</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Free</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Free</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Free</td>
                    </tr>
                    <tr>
                        <td class="border-t-2 border-gray-200 px-4 py-3">Quotations</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">5</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">10</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Unlimited</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3"></td>
                    </tr>
                    <tr>
                        <td class="border-t-2 border-gray-200 px-4 py-3">EmdadTools</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Free</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Free</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Free</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3"></td>
                    </tr>
                    <tr>
                        <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">Super Admin (CEO role)</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">1</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">2</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">10</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"></td>
                    </tr>
                    <tr>
                        <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">Users</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">2</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">10</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">100</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"></td>
                    </tr>
                    <tr>
                        <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">Truck</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">5</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">20</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">Unlimited</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"></td>
                    </tr>
                    <tr>
                        <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">Driver</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">5</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">20</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">Unlimited</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"></td>
                    </tr>
                    <tr>
                        <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">Discount code</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"></td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">Applicable</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">Applicable</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</x-app-layout>
@else
    <x-app-layout>
        <section class="text-gray-600 body-font overflow-hidden">
            <div class="container px-5 py-15 mx-auto">
                <div class="flex flex-wrap -m-4">
                    <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                        <div class="h-full p-6 rounded-lg border-2 border-gray-300 flex flex-col relative bg-white overflow-hidden">
                            <h2 class="text-sm tracking-widest title-font mb-1 font-medium">عادي</h2>
                            <span class="text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                            <h1 class="text-4xl text-gray-900 pb-4 mb-4 border-b border-gray-200 leading-none">مجاني</h1>

                            <button class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded" disabled>Subscribe
                                {{--                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">--}}
                                {{--                                <path d="M5 12h14M12 5l7 7-7 7"></path>--}}
                                {{--                            </svg>--}}
                            </button>
                        </div>
                    </div>
                    <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                        <div class="h-full p-6 rounded-lg border-gray-800 flex flex-col relative bg-gray-300 overflow-hidden">
                            <span class="bg-blue-500 text-white px-3 py-1 tracking-widest text-xs absolute left-0 top-0 rounded-bl">POPULAR</span>
                            <span class="text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                            <h2 class="text-sm tracking-widest title-font mb-1 font-medium">فضي</h2>
                            <h1 class="text-4xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                <span>1500 SAR</span>
                                <span class="text-lg ml-1 font-normal text-gray-500">/السنة</span>
                            </h1>

                            <button class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">Subscribe</button>
                        </div>
                    </div>
                    <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                        <div class="h-full p-6 rounded-lg border-2 border-gray-300 flex flex-col relative bg-gray-300 overflow-hidden">
                            <span class="text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                            <h2 class="text-sm tracking-widest title-font mb-1 font-medium">ذهبي</h2>
                            <h1 class="text-4xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                <span>5000 SAR</span>
                                <span class="text-lg ml-1 font-normal text-gray-500">/السنة</span>
                            </h1>

                            <button class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded">Subscribe</button>
                        </div>
                    </div>
                    <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                        <div class="h-full p-6 rounded-lg border-2 border-gray-300 flex flex-col relative bg-gray-300 overflow-hidden">
                            <span class="text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                            <h2 class="text-sm tracking-widest title-font mb-1 font-medium">بلاتيني</h2>
                            <h1 class="text-4xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                <span>Free</span>
                                <span class="text-lg ml-1 font-normal text-gray-500">مجاني (5 ملايين عملية شراء في الشهر)</span>
                            </h1>
                            <button class="flex items-center mt-auto text-white bg-gray-600 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-700 rounded">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="text-gray-600 body-font">
            <div class="container mx-auto">
                <div class="lg:w-2/9 w-full mx-auto overflow-auto">
                    <table class="table-auto bg-white overflow-hidden w-full text-left whitespace-no-wrap">
                        <thead>
                        <tr>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm text-center bg-gray-500">المهام</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm text-center bg-gray-500">عادي</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm text-center bg-gray-500">فضي</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm text-center bg-gray-500">ذهبي</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm text-center bg-gray-500">بلاتيني</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="px-4 py-3 text-right">اشتراك لمدة سنة</td>
                            <td class="px-4 py-3 text-center">مجاني</td>
                            <td class="px-4 py-3 text-center">1500</td>
                            <td class="px-4 py-3 text-center">5000</td>
                            <td class="px-4 py-3 text-center">مجاني (5 ملايين عملية شراء في الشهر)</td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3 text-right">التسجيل</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">مجاني</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">مجاني</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">مجاني</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">مجاني</td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3 text-right">عروض الأسعار</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">5</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">10</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">غير محدود</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3"></td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3 text-right">أدوات إمداد</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">مجاني</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">مجاني</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">مجاني</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3"></td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">وظيفة المشرف الرئيسي (المدير التنفيذي)</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">1</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">2</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">10</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"></td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">المستخدمين</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">2</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">10</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">100</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"></td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">الشاحنات</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">5</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">20</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">غير محدود</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"></td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">السائقين</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">5</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">20</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">غير محدود</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"></td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">كود الخصم</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"></td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">ملائم</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">ملائم</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </x-app-layout>
@endif
<script>
    function language(rtl_value) {
        $.ajax({
            url: "{{route('languageChange')}}",
            method: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                rtl_value: rtl_value,
            },
            success: function(){
                window.location.reload();
            },
            // error: function(result){
            //     console.log('error');
            // }
        });
    }
</script>
