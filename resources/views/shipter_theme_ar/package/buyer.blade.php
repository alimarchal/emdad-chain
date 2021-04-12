<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{url('ficon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{url('ficon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{url('ficon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('ficon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{url('ficon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('ficon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{url('ficon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('ficon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{url('ficon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{url('ficon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('ficon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{url('ficon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('ficon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{url('ficon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{url('ficon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    <script src="https://cdn.tiny.cloud/1/izbyerk8x92uls8z2ulnezm5uaudhf41lw0lebop5ba724o5/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@livewireStyles

<!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    @yield('headerScripts')
</head>

<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto" id="side-bar">

        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container mx-auto px-6 pb-8">
                    <section class="text-gray-600 body-font overflow-hidden" style="direction: rtl">
                        <div class="container px-5 py-15 mx-auto">
                            <div class="flex flex-wrap -m-4">
                                @php $packages = \App\Models\Package::all()->take(4); @endphp
                                @foreach($packages as $package)
                                    <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                                        <div class="h-full p-6 rounded-lg border-2 border-gray-300 flex flex-col relative bg-white overflow-hidden" style="border: 2px solid #c3c3c3">
                                            @if($package->package_type == 'Basic')
                                                <h2 class="text-sm tracking-widest title-font mb-1 font-medium">عادي</h2>
                                                <span class="text-white px-3 py-1 tracking-widest text-xs absolute left-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                                <h1 class="text-4xl text-gray-900 pb-4 mb-4 border-b border-gray-200 leading-none">مجاني</h1>
                                                <a href="{{route('register')}}" class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded" style="justify-content: center">Subscribe</a>
                                            @elseif($package->package_type == 'Silver')
                                                <h2 class="text-sm tracking-widest title-font mb-1 font-medium">فضي</h2>
                                                <span class="bg-blue-600 text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl">POPULAR</span>
                                                <span class="text-white px-3 py-1 tracking-widest text-xs absolute left-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                                <h1 class="text-4xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                                    <span>{{$package->charges}} SAR</span>
                                                    <span class="text-lg ml-1 font-normal text-gray-500">/السنة</span>
                                                </h1>
                                                <a href="{{route('register')}}" class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded" style="justify-content: center">Subscribe</a>
                                            @elseif($package->package_type == 'Gold')
                                                <h2 class="text-sm tracking-widest title-font mb-1 font-medium">ذهبي</h2>
                                                <span class="text-white px-3 py-1 tracking-widest text-xs absolute left-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                                <h1 class="text-4xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                                    <span>{{$package->charges}} SAR</span>
                                                    <span class="text-lg ml-1 font-normal text-gray-500">/السنة</span>
                                                </h1>
                                                <a href="{{route('register')}}" class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center">Subscribe</a>
                                            @elseif($package->package_type == 'Platinum')
                                                <h2 class="text-sm tracking-widest title-font mb-1 font-medium">بلاتيني</h2>
                                                <span class="text-white px-3 py-1 tracking-widest text-xs absolute left-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                                <h1 class="text-4xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                                    <span class="font-bold text-2xl">مجاني</span>
                                                    <span class="text-lg ml-1 font-normal text-gray-500">{{$package->charges}}</span>
                                                </h1>
                                                <a href="{{route('register')}}" class="flex items-center mt-auto text-white bg-gray-700 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-900 rounded" style="justify-content: center">Subscribe</a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    <section class="text-gray-600 body-font" style="direction: rtl">
                        <div class="container mx-auto">
                            <div class="lg:w-2/9 w-full mx-auto overflow-auto">
                                <table class="table-auto bg-white overflow-hidden w-full text-left whitespace-no-wrap">
                                    <thead>
                                    <tr>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm text-center bg-gray-500">المهام</th>
                                        @foreach($packages as $package)
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm text-center bg-gray-500">
                                              @if($package->id == 1) عادي
                                              @elseif($package->id == 2)فضي
                                              @elseif($package->id == 3)ذهبي
                                              @elseif($package->id == 4)بلاتيني
                                              @endif
                                            </th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="px-4 py-3 text-right">اشتراك لمدة سنة</td>
                                        @foreach($packages as $package)
                                            <td class="px-4 py-3 text-center">@if($package->id == 1) مجاني @else {{$package->charges}}@endif</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="border-t-2 border-gray-200 px-4 py-3 text-right">التسجيل</td>
                                        @foreach($packages as $package)
                                            <td class="border-t-2 text-center border-gray-200 px-4 py-3"> مجاني</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="border-t-2 border-gray-200 px-4 py-3 text-right">Category</td>
                                        @foreach($packages as $package)
                                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">{{$package->category}}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="border-t-2 border-gray-200 px-4 py-3 text-right">Sub Category</td>
                                        @foreach($packages as $package)
                                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">{{$package->sub_category}}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="border-t-2 border-gray-200 px-4 py-3 text-right">RFQs / Day</td>
                                        @foreach($packages as $package)
                                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">@if($package->id == 3 || $package->id == 4) غير محدود @else {{$package->rfq_per_day}} @endif</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="border-t-2 border-gray-200 px-4 py-3 text-right">No. of quotations / RFQ</td>
                                        @foreach($packages as $package)
                                            <td class="border-t-2 text-center border-gray-200 px-4 py-3" style="direction: rtl">
                                                @if($package->quotations_per_rfq == 2) 1-{{$package->quotations_per_rfq}} @include('misc.required')
                                                @elseif($package->quotations_per_rfq == 3) 1-{{$package->quotations_per_rfq}} @include('misc.required')
                                                @elseif($package->quotations_per_rfq == 5) 1-{{$package->quotations_per_rfq}} @include('misc.required')
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="border-t-2 border-gray-200 px-4 py-3 text-right">أدوات إمداد</td>
                                        @foreach($packages as $package)
                                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">مجاني</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">وظيفة المشرف الرئيسي (المدير التنفيذي)</td>
                                        @foreach($packages as $package)
                                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">{{$package->super_admin_count}}</td>
                                        @endforeach
                                    </tr>

                                    <tr>
                                        <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">Sub Admin</td>
                                        @foreach($packages as $package)
                                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">{{$package->sub_admin_count}}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">المستخدمين</td>
                                        @foreach($packages as $package)
                                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">{{$package->users}}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">Payment</td>
                                        @foreach($packages as $package)
                                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">@if($package->payment_type == 'Cash')  @endif {{$package->payment_type}}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">Trainings</td>
                                        @foreach($packages as $package)
                                            <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">غير محدود</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">كود الخصم</td>
                                        @foreach($packages as $package)
                                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">@if($package->discount_code != null ) ملائم @endif</td>
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </main>
        </div>
    </div>
</div>

@stack('modals')

@livewireScripts


</body>

</html>
