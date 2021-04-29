@if(auth()->user()->rtl == 0)
    <x-app-layout>
        <section class="text-gray-600 body-font overflow-hidden">
            <div class="container px-5 py-15 mx-auto">
                <div class="flex flex-wrap -m-4">
                    @php $businessPackage = \App\Models\BusinessPackage::where('user_id', auth()->id())->first(); @endphp
                    @foreach($packages as $package)
                        <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                            <div class="h-full p-6 rounded-lg border-2 border-gray-300 flex flex-col relative @if($package->package_type == 'Basic') bg-white @else bg-gray-300 @endif overflow-hidden"
                                 @if($package->package_type != 'Basic') style="background-color: #ececec; border: 2px solid #c3c3c3" @endif>
                                @if($package->package_type == 'Basic')
                                    <h2 class="text-sm tracking-widest title-font mb-1 font-medium">{{$package->package_type}}</h2>
                                    <span class="text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                    <h1 class="text-4xl text-gray-900 pb-4 mb-4 border-b border-gray-200 leading-none">{{$package->charges}}</h1>

                                    @if(isset($businessPackage) && $businessPackage->package_id == 1)
                                        <span class="text-lg ml-1 font-normal text-gray-500">Emdad-ID: {{auth()->user()->business_id}}</span>
                                        <button class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded" style="justify-content: center" disabled>Purchased</button>
                                    @else
                                        <form action="{{route('business-packages.store')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="package_id" value="{{$package->id}}">
                                            <button class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded" style="justify-content: center">Subscribe</button>
                                        </form>
                                    @endif
                                @elseif($package->package_type == 'Silver')
                                    <h2 class="text-sm tracking-widest title-font mb-1 font-medium">{{$package->package_type}}</h2>
                                    <span class="bg-blue-600 text-white px-3 py-1 tracking-widest text-xs absolute left-0 top-0 rounded-bl">POPULAR</span>
                                    <span class="text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                    <h1 class="text-4xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                        <span>{{$package->charges}} SAR</span>
                                        <span class="text-lg ml-1 font-normal text-gray-500">/year</span>
                                    </h1>
                                    @if(isset($businessPackage) && $businessPackage->package_id == 2)
                                        <span class="text-lg ml-1 font-normal text-gray-500">Emdad-ID: {{auth()->user()->business_id}}</span>
                                        <span class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded" style="justify-content: center" disabled>Purchased</span>
                                    @else
                                        <form action="{{route('business-packages.store')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="package_id" value="{{$package->id}}">
                                            <button class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded" style="justify-content: center">Subscribe</button>
                                        </form>
                                    @endif
                                @elseif($package->package_type == 'Gold')
                                    <h2 class="text-sm tracking-widest title-font mb-1 font-medium">{{$package->package_type}}</h2>
                                    <span class="text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                    <h1 class="text-4xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                        <span>{{$package->charges}} SAR</span>
                                        <span class="text-lg ml-1 font-normal text-gray-500">/year</span>
                                    </h1>
                                    @if(isset($businessPackage) && $businessPackage->package_id == 3)
                                        <span class="text-lg ml-1 font-normal text-gray-500">Emdad-ID: {{auth()->user()->business_id}}</span>
                                        <button class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center" disabled>Purchased</button>
                                    @else
                                        <form action="{{route('business-packages.store')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="package_id" value="{{$package->id}}">
                                            <button class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center">Subscribe</button>
                                        </form>
                                    @endif
                                @elseif($package->package_type == 'Platinum')
                                    <h2 class="text-sm tracking-widest title-font mb-1 font-medium">{{$package->package_type}}</h2>
                                    <span class="text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                    <h1 class="text-4xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                        <span class="font-bold text-2xl">Free</span>
                                        {{--                                    <span>{{$package->charges}}</span>--}}
                                        <span class="text-lg ml-1 font-normal text-gray-500">{{$package->charges}}</span>
                                    </h1>
                                    @if(isset($businessPackage) && $businessPackage->package_id == 4)
                                        <span class="text-lg ml-1 font-normal text-gray-500">Emdad-ID: {{auth()->user()->business_id}}</span>
                                        <button class="flex items-center mt-auto text-white bg-gray-700 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-900 rounded" style="justify-content: center" disabled>Purchased</button>
                                    @else
                                        <form action="{{route('business-packages.store')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="package_id" value="{{$package->id}}">
                                            <button class="flex items-center mt-auto text-white bg-gray-700 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-900 rounded" style="justify-content: center">Subscribe</button>
                                        </form>
                                    @endif
                                @endif

                            </div>
                        </div>
                    @endforeach
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
                            @foreach($packages as $package)
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm text-center bg-gray-500">
                                    {{$package->package_type}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="px-4 py-3">Subscription For 1 year</td>
                            @foreach($packages as $package)
                                <td class="px-4 py-3 text-center">{{$package->charges}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3">Registeration</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-gray-200 px-4 py-3">{{$package->registeration}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3">Main Categories</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-gray-200 px-4 py-3">{{$package->category}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3">Sub Categories</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-gray-200 px-4 py-3">{{$package->sub_category}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3">No. of available RFQs per Day</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-gray-200 px-4 py-3">{{$package->rfq_per_day}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3">No. Quots. Per 1 RFQ</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-gray-200 px-4 py-3">
                                    @if($package->quotations_per_rfq == 2) 1-{{$package->quotations_per_rfq}} @include('misc.required')
                                    @elseif($package->quotations_per_rfq == 3) 1-{{$package->quotations_per_rfq}} @include('misc.required')
                                    @elseif($package->quotations_per_rfq == 5) 1-{{$package->quotations_per_rfq}} @include('misc.required')
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3">Emdad Tools App</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-gray-200 px-4 py-3">{{$package->emdad_tools}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">Super Admin (CEO role)</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">{{$package->super_admin_count}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">Users</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">{{$package->users}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">Payment</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">{{$package->payment_type}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">Trainings</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">{{$package->training}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3"></td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3"></td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">Discount Code</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">Discount Code</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">Discount Code</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <span>@include('misc.required') <strong>Note:</strong> Minimum 1 quotation received, in case of Branded item</span>
            </div>
        </section>

    </x-app-layout>
@else
    <x-app-layout>
        <section class="text-gray-600 body-font overflow-hidden">
            <div class="container px-5 py-15 mx-auto">
                <div class="flex flex-wrap -m-4">

                    <div class="flex flex-wrap -m-4 " style="direction: rtl">
                        @php $businessPackage = \App\Models\BusinessPackage::where('user_id', auth()->id())->first(); @endphp
                        @foreach($packages as $package)
                            <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                                <div class="h-full p-6 rounded-lg border-2 border-gray-300 flex flex-col relative @if($package->package_type == 'Basic') bg-white @else bg-gray-300 @endif overflow-hidden" @if($package->package_type != 'Basic') style="background-color: #ececec; border: 2px solid #c3c3c3" @endif>
                                    @if($package->package_type == 'Basic')
                                        <h2 class="text-sm tracking-widest title-font mb-1 font-medium">عادي</h2>
                                        <span class="text-white px-3 py-1 tracking-widest text-xs absolute left-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                        <h1 class="text-4xl text-gray-900 pb-4 mb-4 border-b border-gray-200 leading-none">{{$package->charges}}</h1>

                                        @if(isset($businessPackage) && $businessPackage->package_id == 1)
                                            <span class="text-lg ml-1 font-normal text-gray-500">Emdad-ID: {{auth()->user()->business_id}}</span>
                                            <button class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded" style="justify-content: center"  disabled>Purchased</button>
                                        @else
                                            <form action="{{route('business-packages.store')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="package_id" value="{{$package->id}}">
                                                <button class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded" style="justify-content: center">اشترك</button>
                                            </form>
                                        @endif
                                    @elseif($package->package_type == 'Silver')
                                        <h2 class="text-sm tracking-widest title-font mb-1 font-medium">فضي</h2>
                                        <span class="bg-blue-500 text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl">POPULAR</span>
                                        <span class="text-white px-3 py-1 tracking-widest text-xs absolute left-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                        <h1 class="text-4xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                            <span>{{$package->charges}} SAR</span>
                                            <span class="text-lg ml-1 font-normal text-gray-500">/year</span>
                                        </h1>
                                        @if(isset($businessPackage) && $businessPackage->package_id == 2)
                                            <span class="text-lg ml-1 font-normal text-gray-500">Emdad-ID: {{auth()->user()->business_id}}</span>
                                            <span class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded" style="justify-content: center"  disabled>Purchased</span>
                                        @else
                                            <form action="{{route('business-packages.store')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="package_id" value="{{$package->id}}">
                                                <button class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded" style="justify-content: center">اشترك</button>
                                            </form>
                                        @endif
                                    @elseif($package->package_type == 'Gold')
                                        <h2 class="text-sm tracking-widest title-font mb-1 font-medium">ذهبي</h2>
                                        <span class="text-white px-3 py-1 tracking-widest text-xs absolute left-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                        <h1 class="text-4xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                            <span>{{$package->charges}} SAR</span>
                                            <span class="text-lg ml-1 font-normal text-gray-500">/year</span>
                                        </h1>
                                        @if(isset($businessPackage) && $businessPackage->package_id == 3)
                                            <span class="text-lg ml-1 font-normal text-gray-500">Emdad-ID: {{auth()->user()->business_id}}</span>
                                            <button class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center"  disabled>Purchased</button>
                                        @else
                                            <form action="{{route('business-packages.store')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="package_id" value="{{$package->id}}">
                                                <button class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center">اشترك</button>
                                            </form>
                                        @endif
                                    @elseif($package->package_type == 'Platinum')
                                        <h2 class="text-sm tracking-widest title-font mb-1 font-medium">بلاتيني</h2>
                                        <span class="text-white px-3 py-1 tracking-widest text-xs absolute left-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                        <h1 class="text-4xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                            <span class="font-bold text-2xl">مجاني</span>
                                            {{--                                    <span>{{$package->charges}}</span>--}}
                                            <span class="text-lg ml-1 font-normal text-gray-500">
                                            مجاني (5 ملايين عملية شراء في الشهر)
                                            </span>
                                        </h1>
                                        @if(isset($businessPackage) && $businessPackage->package_id == 4)
                                            <span class="text-lg ml-1 font-normal text-gray-500">Emdad-ID: {{auth()->user()->business_id}}</span>
                                            <button class="flex items-center mt-auto text-white bg-gray-700 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-900 rounded" style="justify-content: center"  disabled>Purchased</button>
                                        @else
                                            <form action="{{route('business-packages.store')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="package_id" value="{{$package->id}}">
                                                <button class="flex items-center mt-auto text-white bg-gray-700 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-900 rounded" style="justify-content: center">اشترك</button>
                                            </form>
                                        @endif
                                    @endif

                                </div>
                            </div>
                        @endforeach
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
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-lg text-center bg-gray-500">المهام</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-lg text-center bg-gray-500">عادي</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-lg text-center bg-gray-500">فضي</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-lg text-center bg-gray-500">ذهبي</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-lg text-center bg-gray-500">بلاتيني</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="px-4 py-3 text-right">اشتراك لمدة سنة</td>
                            <td class="px-4 py-3 text-center">مجاني</td>
                            <td class="px-4 py-3 text-center">1500</td>
                            <td class="px-4 py-3 text-center">5000</td>
                            <td class="px-4 py-3 text-center">(إذا بلغ المشتري حد خمسة ملايين ريال سعودي)</td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3 text-right">التسجيل</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">مجاني</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">مجاني</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">مجاني</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">مجاني</td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3 text-right">الفئات الرئيسيه</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">1</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">3</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">5</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">5</td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3 text-right">الفئات الفرعية</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">5</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">15</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">50</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">50</td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3 text-right">عدد الطلبات اليومية المتاحة</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">3</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">10</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">غير محدود</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">غير محدود</td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3 text-right">عدد عروض الأسعار المستلمة لكل طلب</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">'من 1 إلى 2</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">من 1 إلى 3</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">من 1 إلى 5</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">من 1 إلى 5</td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3 text-right">أدوات إمداد</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">مجاني</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">مجاني</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">مجاني</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">مجاني</td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">مستخدم رئيسي</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">1</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">1</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">1</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">1</td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">إضافة مدير فرعي</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">0</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">2</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">100</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">100</td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">إضافة مستخدمين</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">2</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">5</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">100</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">100</td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">نظام المدفوعات</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">نظام الدفع المقدم</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">نظامي الدفع ( المقدم و الآجل )</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">نظامي الدفع ( المقدم و الآجل )</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">نظامي الدفع ( المقدم و الآجل )</td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">الدعم التدريب</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">غير محدود</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">غير محدود</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">غير محدود</td>
                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">غير محدود</td>
                        </tr>
                        {{--                        <tr>--}}
                        {{--                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right"></td>--}}
                        {{--                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">رمز خصم</td>--}}
                        {{--                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">رمز خصم</td>--}}
                        {{--                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">رمز خصم</td>--}}
                        {{--                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">رمز خصم</td>--}}
                        {{--                        </tr>--}}
                        </tbody>
                    </table>
                </div>
                <br>
                <span>@include('misc.required') <strong>تنبيه :</strong> يتم استلام عرض واحد فقط في حال تم تحديد العلامة تجارية المطلوبة ( Brand ) </span>
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
            success: function () {
                window.location.reload();
            },
            // error: function(result){
            //     console.log('error');
            // }
        });
    }
</script>
