@if(auth()->user()->rtl == 0)
    <x-app-layout>
        <section class="text-gray-600 body-font overflow-hidden">
            @if (session()->has('message'))
                <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    <strong class="mr-1">{{ session('message') }}</strong>
                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="block mt-3 text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    <strong class="mr-1">{{ session('error') }}</strong>
                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            <div class="container px-5 py-15 mx-auto">
                <div class="flex flex-wrap -m-4">
                    @php $businessPackage = \App\Models\BusinessPackage::where(['user_id' => auth()->id(), 'status' => 1])->first(); @endphp
                    @foreach($packages as $package)
                        <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                            <div class="h-full p-6 rounded-lg border-2 border-gray-300 flex flex-col relative @if($package->package_type == 'Basic') bg-white @else bg-gray-300 @endif overflow-hidden"
                                @if($package->package_type != 'Basic') style="background-color: #ececec; border: 2px solid #c3c3c3" @endif>
                                @if($package->package_type == 'Basic')
                                    <h2 class="text-sm tracking-widest title-font mb-1 font-medium">@if($package->package_type == 'Basic') {{__('portal.Basic')}} @else {{$package->package_type}} @endif</h2>
                                    <span class="text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                    <h1 class="text-2xl text-gray-900 pb-4 mb-4 border-b border-gray-200 leading-none">@if($package->charges == 'Free') {{__('portal.Free')}} @else {{$package->charges}} @endif</h1>

                                    @if(isset($businessPackage) && $businessPackage->package_id == 1)
                                        <span class="text-lg ml-1 font-normal text-gray-500">{{__('portal.Emdad-ID')}}: {{auth()->user()->business_id}}</span>
                                        <button class="flex items-center mt-auto text-white bg-yellow-500 border-0 py-2 px-4 w-full rounded" style="justify-content: center; cursor: no-drop" disabled>{{__('portal.Purchased')}}</button>
                                    @elseif(isset($businessPackage))
{{--                                        <span onclick="alert('Contact Emdad To Update Your Package')" class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded" style="justify-content: center; cursor: pointer">Update</span>--}}
                                    @else
                                        <form action="{{route('business-packages.store')}}" method="POST" style="padding-top: 36px;">
                                            @csrf
                                            <input type="hidden" name="package_id" value="{{encrypt($package->id)}}">
                                            <button class="flex items-center mt-6 text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center">{{__('portal.Subscribe')}}</button>
                                        </form>
                                    @endif
                                @elseif($package->package_type == 'Silver')
                                    <h2 class="text-sm tracking-widest title-font mb-1 font-medium">@if($package->package_type == 'Silver') {{__('portal.Silver')}} @else {{$package->package_type}} @endif</h2>
                                    <span class="bg-blue-600 text-white px-3 py-1 tracking-widest text-xs absolute left-0 top-0 rounded-bl">{{__('portal.POPULAR')}}</span>
                                    <span class="text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                    <h1 class="text-2xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                        <span>{{$package->charges}} {{__('portal.SAR')}}</span>
                                        <span class="text-lg ml-1 font-normal text-gray-500">/{{__('portal.year')}}</span>
                                    </h1>
                                    @if(isset($businessPackage) && $businessPackage->package_id == 2)
                                        <span class="text-lg ml-1 font-normal text-gray-500">{{__('portal.Emdad-ID')}}: {{auth()->user()->business_id}}</span>
                                        <span class="flex items-center mt-auto text-white bg-gray-500 border-0 py-2 px-4 w-full rounded" style="justify-content: center; cursor: no-drop" disabled>{{__('portal.Purchased')}}</span>
                                    @elseif(isset($businessPackage) )
                                        @if($businessPackage->package_id == 1)
                                            @php $packageManualPayment = \App\Models\PackageManualPayment::where(['business_id' => auth()->user()->business_id, 'upgrade' => 0])->where('status', '!=', 1)->first(); @endphp
                                            @if(isset($packageManualPayment) && $packageManualPayment->status == 0 && $packageManualPayment->package_id == 2)
                                                <a class="flex items-center mt-auto text-white hover:text-white bg-yellow-500 border-0 py-2 px-4 w-full rounded" style="justify-content: center;">{{__('portal.Pending Confirmation')}}</a>
                                            @elseif(isset($packageManualPayment) && $packageManualPayment->status == 2 && $packageManualPayment->package_id == 2)
                                                <a href="{{route('manualPaymentUpgradingView', encrypt($packageManualPayment->id))}}" class="flex items-center mt-auto text-white hover:text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center; cursor: pointer">{{__('portal.Update')}}</a>
                                            @elseif(isset($packageManualPayment) && $packageManualPayment->status == 0 && $packageManualPayment->package_id != 2 || isset($packageManualPayment) && $packageManualPayment->status == 2 && $packageManualPayment->package_id != 2)
                                                {{-- Showing nothing in case of package upgrade requested for a another package --}}
                                            @else
                                                <a href="{{route('subscriptionUpdate', encrypt($package->id))}}" class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center; cursor: pointer">{{__('portal.Update')}}</a>
                                            @endif
                                        @else
                                        @endif
                                    @else
                                        {{--<form action="{{route('businessPackage.stepOne')}}" method="POST" style="padding-top: 36px;">
                                            @csrf
                                            <input type="hidden" name="package_id" value="{{encrypt($package->id)}}">
                                            <button class="flex items-center mt-6 text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded" style="justify-content: center">{{__('portal.Subscribe')}}</button>
                                        </form>--}}
                                        <a href="{{route('packagePaymentType', encrypt($package->id))}}" class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center; cursor: pointer">{{__('portal.Subscribe')}}</a>
                                    @endif
                                @elseif($package->package_type == 'Gold')
                                    <h2 class="text-sm tracking-widest title-font mb-1 font-medium">@if($package->package_type == 'Gold') {{__('portal.Gold')}} @else {{$package->package_type}} @endif</h2>
                                    <span class="text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                    <h1 class="text-2xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                        <span>{{$package->charges}} {{__('portal.SAR')}}</span>
                                        <span class="text-lg ml-1 font-normal text-gray-500">/{{__('portal.year')}}</span>
                                    </h1>
                                    @if(isset($businessPackage) && $businessPackage->package_id == 3)
                                        <span class="text-lg ml-1 font-normal text-gray-500">{{__('portal.Emdad-ID')}}: {{auth()->user()->business_id}}</span>
                                        <button class="flex items-center mt-auto text-white bg-yellow-500 border-0 py-2 px-4 w-full rounded" style="justify-content: center; cursor: no-drop" disabled>{{__('portal.Purchased')}}</button>
                                    @elseif(isset($businessPackage))
                                        @if($businessPackage->package_id == 1 || $businessPackage->package_id == 2)
                                            @php $packageManualPayment = \App\Models\PackageManualPayment::where(['business_id' => auth()->user()->business_id, 'upgrade' => 0])->where('status', '!=', 1)->first(); @endphp
                                            @if(isset($packageManualPayment) && $packageManualPayment->status == 0 && $packageManualPayment->package_id == 3)
                                                <a class="flex items-center mt-auto text-white hover:text-white bg-yellow-500 border-0 py-2 px-4 w-full rounded" style="justify-content: center;">{{__('portal.Pending Confirmation')}}</a>
                                            @elseif(isset($packageManualPayment) && $packageManualPayment->status == 2 && $packageManualPayment->package_id == 3)
                                                <a href="{{route('manualPaymentUpgradingView', encrypt($packageManualPayment->id))}}" class="flex items-center mt-auto text-white hover:text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center; cursor: pointer">{{__('portal.Update')}}</a>
                                            @elseif(isset($packageManualPayment) && $packageManualPayment->status == 0 && $packageManualPayment->package_id != 3 || isset($packageManualPayment) && $packageManualPayment->status == 2 && $packageManualPayment->package_id != 3)
                                                {{-- Showing nothing in case of package upgrade requested for a another package --}}
                                            @else
                                                <a href="{{route('subscriptionUpdate', encrypt($package->id))}}" class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center; cursor: pointer">{{__('portal.Update')}}</a>
                                            @endif
                                        @else
                                        @endif
                                    @else
{{--                                        <form action="{{route('business-packages.store')}}" method="POST">--}}
                                        {{--<form  action="{{route('businessPackage.stepOne')}}" method="POST" style="padding-top: 43px;">
                                            @csrf
                                            <input type="hidden" name="package_id" value="{{encrypt($package->id)}}">
                                            <button class="flex items-center mt-6 text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center">{{__('portal.Subscribe')}}</button>
                                        </form>--}}
                                        <a href="{{route('packagePaymentType', encrypt($package->id))}}" class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center; cursor: pointer">{{__('portal.Subscribe')}}</a>
                                    @endif
                                @elseif($package->package_type == 'Platinum')
                                    <h2 class="text-sm tracking-widest title-font mb-1 font-medium">@if($package->package_type == 'Platinum') {{__('portal.Platinum')}} @else {{$package->package_type}} @endif</h2>
                                    <span class="text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                    <h1 class="text-2xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                        <span class="font-bold text-2xl">{{__('portal.Free')}}</span>
                                        <span class="text-lg ml-1 font-normal text-gray-500">@if($package->charges == '(Purchases above SR 5 million/month )') {{__('portal.(Purchases above SR 5 million/month )')}} @else {{$package->charges}} @endif </span>
                                    </h1>
                                    <span class="text-xs mb-2 text-red-500"> * {{__('portal.Only upgradable from Gold Package.')}}</span>

                                    @if(isset($businessPackage) && $businessPackage->package_id == 4)
                                        <span class="text-lg ml-1 font-normal text-gray-500">{{__('portal.Emdad-ID')}}: {{auth()->user()->business_id}}</span>
                                        <button class="flex items-center mt-auto text-white bg-yellow-500 border-0 py-2 px-4 w-full rounded" style="justify-content: center; cursor: no-drop" disabled>{{__('portal.Purchased')}}</button>
                                    @elseif(isset($businessPackage))
                                        <span onclick="alert('Contact Emdad To Update Your Package')" class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center; cursor: pointer">{{__('portal.Update')}}</span>
                                    @else
                                        <form action="{{route('business-packages.store')}}" method="POST" style="padding-top: 36px;">
                                            @csrf
                                            <input type="hidden" name="package_id" value="{{encrypt($package->id)}}">
                                            <button class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" disabled style="justify-content: center">{{__('portal.Subscribe')}}</button>
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
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm text-center bg-gray-500 rounded-tl rounded-bl">{{__('portal.Functions')}}</th>
                            @foreach($packages as $package)
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm text-center bg-gray-500">
                                    @if($package->package_type == 'Basic') {{__('portal.Basic')}}
                                    @elseif($package->package_type == 'Silver') {{__('portal.Silver')}}
                                    @elseif($package->package_type == 'Gold') {{__('portal.Gold')}}
                                    @elseif($package->package_type == 'Platinum') {{__('portal.Platinum')}}
                                    @else {{$package->package_type}}
                                    @endif
{{--                                    {{$package->package_type}}--}}
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="px-4 py-3">{{__('portal.Subscription For 1 year')}}</td>
                            @foreach($packages as $package)
                                <td class="px-4 py-3 text-center">
                                    @if($package->charges == 'Free') {{__('portal.Free')}}
                                    @elseif($package->charges == '(Purchases above SR 5 million/month )') {{__('portal.(Purchases above SR 5 million/month )')}}
                                    @else {{$package->charges}}  {{__('portal.SAR')}}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3">{{__('portal.Registration')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-gray-200 px-4 py-3">
                                    @if($package->registeration == 'Free') {{__('portal.Free')}}
                                    @else {{$package->registeration}}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3">{{__('portal.Main Categories')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-gray-200 px-4 py-3">{{$package->category}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3">{{__('portal.Sub Categories')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-gray-200 px-4 py-3">{{$package->sub_category}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3">{{__('portal.No. of available RFQs per Day')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-gray-200 px-4 py-3">
                                    @if($package->rfq_per_day == 'Unlimited') {{__('portal.Unlimited')}}
                                    @else {{$package->rfq_per_day}}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3">{{__('portal.No. Quotes. Per 1 RFQ')}}</td>
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
                            <td class="border-t-2 border-gray-200 px-4 py-3">{{__('portal.Emdad Tools App')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-gray-200 px-4 py-3">
                                    @if($package->emdad_tools == 'Free') {{__('portal.Free')}}
                                    @else {{$package->emdad_tools}}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">{{__('portal.Super Admin (CEO role)')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">{{$package->super_admin_count}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">{{__('portal.Users')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">{{$package->users}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">{{__('portal.Payment')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">
                                    @if($package->payment_type == 'Cash') {{__('portal.Cash')}}
                                    @elseif($package->payment_type == 'Cash/Credit') {{__('portal.Cash/Credit')}}
                                    @else {{$package->payment_type}}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">{{__('portal.Trainings')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">
                                    @if($package->training == 'Unlimited') {{__('portal.Unlimited')}}
                                    @else {{$package->training}}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        {{--<tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3"></td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3"></td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">{{__('portal.Discount Code')}}</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">{{__('portal.Discount Code')}}</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">{{__('portal.Discount Code')}}</td>
                        </tr>--}}
                        </tbody>
                    </table>
                </div>
                <br>
                <span>@include('misc.required') <strong>{{__('portal.Note')}}:</strong> {{__('portal.Minimum 1 quotation received, in case of Branded item')}}</span>
                @if(isset($businessPackage->package_id) == 2 || isset($businessPackage->package_id) == 3 )
                    <br>
                    <div class="text-gray-500" style="text-align: end">
                        <a href="{{route('subscriptionPDF')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border
                                               border-transparent rounded-md font-semibold text-xs text-white uppercase
                                               tracking-widest hover:bg-red-500 focus:outline-none focus:border-blue-700
                                               focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                            {{__('portal.Generate PDF')}}
                        </a>
                    </div>
                @endif
            </div>
        </section>

    </x-app-layout>
@else
    <x-app-layout>
        <section class="text-gray-600 body-font overflow-hidden">
            @if (session()->has('message'))
                <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    <strong class="mr-3">{{ session('message') }}</strong>
                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="block mt-3 text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    <strong class="mr-3">{{ session('error') }}</strong>
                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            <div class="container px-5 py-15 mx-auto">
                <div class="flex flex-wrap -m-4" style="direction: rtl">
                    @php $businessPackage = \App\Models\BusinessPackage::where(['user_id' => auth()->id(), 'status' => 1])->first(); @endphp
                    @foreach($packages as $package)
                        <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                            <div class="h-full p-6 rounded-lg border-2 border-gray-300 flex flex-col relative @if($package->package_type == 'Basic') bg-white @else bg-gray-300 @endif overflow-hidden"
                                 @if($package->package_type != 'Basic') style="background-color: #ececec; border: 2px solid #c3c3c3" @endif>
                                @if($package->package_type == 'Basic')
                                    <h2 class="text-sm tracking-widest title-font mb-1 font-medium">@if($package->package_type == 'Basic') {{__('portal.Basic')}} @else {{$package->package_type}} @endif</h2>
                                    <span class="text-white px-3 py-1 tracking-widest text-xs absolute left-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                    <h1 class="text-2xl text-gray-900 pb-4 mb-4 border-b border-gray-200 leading-none">@if($package->charges == 'Free') {{__('portal.Free')}} @else {{$package->charges}} @endif</h1>

                                    @if(isset($businessPackage) && $businessPackage->package_id == 1)
                                        <span class="text-lg ml-1 font-normal text-gray-500">{{__('portal.Emdad-ID')}}: {{auth()->user()->business_id}}</span>
                                        <button class="flex items-center mt-auto text-white bg-yellow-500 border-0 py-2 px-4 w-full rounded" style="justify-content: center; cursor: no-drop" disabled>{{__('portal.Purchased')}}</button>
                                    @elseif(isset($businessPackage))
                                        {{--                                        <span onclick="alert('Contact Emdad To Update Your Package')" class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded" style="justify-content: center; cursor: pointer">Update</span>--}}
                                    @else
                                        <form action="{{route('business-packages.store')}}" method="POST" style="padding-top: 36px;">
                                            @csrf
                                            <input type="hidden" name="package_id" value="{{encrypt($package->id)}}">
                                            <span class="text-lg ml-1 font-normal text-gray-500"></span>
                                            <button class="flex items-center mt-4 text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center">{{__('portal.Subscribe')}}</button>
                                        </form>
                                    @endif
                                @elseif($package->package_type == 'Silver')
                                    <h2 class="text-sm tracking-widest title-font mb-1 font-medium">@if($package->package_type == 'Silver') {{__('portal.Silver')}} @else {{$package->package_type}} @endif</h2>
                                    <span class="bg-blue-600 text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl">{{__('portal.POPULAR')}}</span>
                                    <span class="text-white px-3 py-1 tracking-widest text-xs absolute left-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                    <h1 class="text-2xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                        <span style="font-family: sans-serif;margin-left: 10px;">{{$package->charges}}</span> {{__('portal.SAR')}}
                                        <span class="text-lg ml-1 font-normal text-gray-500">/{{__('portal.year')}}</span>
                                    </h1>
                                    @if(isset($businessPackage) && $businessPackage->package_id == 2)
                                        <span class="text-lg ml-1 font-normal text-gray-500">{{__('portal.Emdad-ID')}}: {{auth()->user()->business_id}}</span>
                                        <span class="flex items-center mt-auto text-white bg-yellow-500 border-0 py-2 px-4 w-full rounded" style="justify-content: center; cursor: no-drop" disabled>{{__('portal.Purchased')}}</span>
                                    @elseif(isset($businessPackage) )
                                        @if($businessPackage->package_id == 1)
                                            @php $packageManualPayment = \App\Models\PackageManualPayment::where(['business_id' => auth()->user()->business_id, 'upgrade' => 0])->where('status', '!=', 1)->first(); @endphp
                                            @if(isset($packageManualPayment) && $packageManualPayment->status == 0 && $packageManualPayment->package_id == 2)
                                                <a class="flex items-center mt-auto text-white hover:text-white bg-yellow-500 border-0 py-2 px-4 w-full rounded" style="justify-content: center;">{{__('portal.Pending Confirmation')}}</a>
                                            @elseif(isset($packageManualPayment) && $packageManualPayment->status == 2 && $packageManualPayment->package_id == 2)
                                                <a href="{{route('manualPaymentUpgradingView', encrypt($packageManualPayment->id))}}" class="flex items-center mt-auto text-white hover:text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center; cursor: pointer">{{__('portal.Update')}}</a>
                                            @elseif(isset($packageManualPayment) && $packageManualPayment->status == 0 && $packageManualPayment->package_id != 2 || isset($packageManualPayment) && $packageManualPayment->status == 2 && $packageManualPayment->package_id != 2)
                                                {{-- Showing nothing in case of package upgrade requested for a another package --}}
                                            @else
                                                <a href="{{route('subscriptionUpdate', encrypt($package->id))}}" class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 hover:text-white rounded" style="justify-content: center; cursor: pointer">{{__('portal.Update')}}</a>
                                            @endif
                                        @else
                                        @endif
                                    @else
                                        {{--                                        <form action="{{route('businessPackage.getCheckOutId')}}" method="POST">--}}
                                        {{--                                        <form action="{{route('business-packages.store')}}" method="POST" style="padding-top: 36px;">--}}
                                        {{--<form action="{{route('businessPackage.stepOne')}}" method="POST" style="padding-top: 36px;">
                                            @csrf
                                            <input type="hidden" name="package_id" value="{{encrypt($package->id)}}">
                                            <span class="text-lg ml-1 font-normal text-gray-500"></span>
                                            <button class="flex items-center mt-4 text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded" style="justify-content: center">{{__('portal.Subscribe')}}</button>
                                        </form>--}}
                                        <a href="{{route('packagePaymentType', encrypt($package->id))}}" class="flex items-center mt-auto text-white hover:text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center; cursor: pointer">{{__('portal.Subscribe')}}</a>
                                    @endif
                                @elseif($package->package_type == 'Gold')
                                    <h2 class="text-sm tracking-widest title-font mb-1 font-medium">@if($package->package_type == 'Gold') {{__('portal.Gold')}} @else {{$package->package_type}} @endif</h2>
                                    <span class="text-white px-3 py-1 tracking-widest text-xs absolute left-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                    <h1 class="text-2xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                        <span style="font-family: sans-serif;margin-left: 10px;">{{$package->charges}}</span> {{__('portal.SAR')}}
                                        <span class="text-lg ml-1 font-normal text-gray-500">/{{__('portal.year')}}</span>
                                    </h1>
                                    @if(isset($businessPackage) && $businessPackage->package_id == 3)
                                        <span class="text-lg ml-1 mt-5 font-normal text-gray-500">{{__('portal.Emdad-ID')}}: {{auth()->user()->business_id}}</span>
                                        <button class="flex items-center mt-auto text-white bg-yellow-500 border-0 py-2 px-4 w-full rounded" style="justify-content: center; cursor: no-drop" disabled>{{__('portal.Purchased')}}</button>
                                    @elseif(isset($businessPackage))
                                        @if($businessPackage->package_id == 1 || $businessPackage->package_id == 2)
                                            @php $packageManualPayment = \App\Models\PackageManualPayment::where(['business_id' => auth()->user()->business_id, 'upgrade' => 0])->where('status', '!=', 1)->first(); @endphp
                                            @if(isset($packageManualPayment) && $packageManualPayment->status == 0 && $packageManualPayment->package_id == 3)
                                                <a class="flex items-center mt-auto text-white hover:text-white bg-yellow-500 border-0 py-2 px-4 w-full rounded" style="justify-content: center;">{{__('portal.Pending Confirmation')}}</a>
                                            @elseif(isset($packageManualPayment) && $packageManualPayment->status == 2 && $packageManualPayment->package_id == 3)
                                                <a href="{{route('manualPaymentUpgradingView', encrypt($packageManualPayment->id))}}" class="flex items-center mt-auto text-white hover:text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center; cursor: pointer">{{__('portal.Update')}}</a>
                                            @elseif(isset($packageManualPayment) && $packageManualPayment->status == 0 && $packageManualPayment->package_id != 3 || isset($packageManualPayment) && $packageManualPayment->status == 2 && $packageManualPayment->package_id != 3)
                                                {{-- Showing nothing in case of package upgrade requested for a another package --}}
                                            @else
                                                <a href="{{route('subscriptionUpdate', encrypt($package->id))}}" class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 hover:text-white rounded" style="justify-content: center; cursor: pointer">{{__('portal.Update')}}</a>
                                            @endif
                                        @else
                                        @endif
                                    @else
                                        {{--                                        <form action="{{route('business-packages.store')}}" method="POST">--}}
                                        {{--<form  action="{{route('businessPackage.stepOne')}}" method="POST" style="padding-top: 43px;">
                                            @csrf
                                            <input type="hidden" name="package_id" value="{{encrypt($package->id)}}">
                                            <span class="text-lg ml-1 font-normal text-gray-500"></span>
                                            <button class="flex items-center mt-4 text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center">{{__('portal.Subscribe')}}</button>
                                        </form>--}}
                                        <a href="{{route('packagePaymentType', encrypt($package->id))}}" class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full hover:text-white focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center; cursor: pointer">{{__('portal.Subscribe')}}</a>
                                    @endif
                                @elseif($package->package_type == 'Platinum')
                                    <h2 class="text-sm tracking-widest title-font mb-1 font-medium">@if($package->package_type == 'Platinum') {{__('portal.Platinum')}} @else {{$package->package_type}} @endif</h2>
                                    <span class="text-white px-3 py-1 tracking-widest text-xs absolute left-0 top-0 rounded-bl"><img src="{{asset('logo.png')}}" style="width: 50px; height: 40px;"></span>
                                    <h1 class="text-2xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                        <span class="font-bold text-2xl">{{__('portal.Free')}}</span>
                                        <span class="text-lg ml-1 font-normal text-gray-500">@if($package->charges == '(Purchases above SR 5 million/month )') {{__('portal.(Purchases above SR 5 million/month )')}} @else {{$package->charges}} @endif </span>
                                    </h1>
                                    <span class="text-xs mb-2 text-red-500"> * {{__('portal.Only upgradable from Gold Package.')}}</span>

                                    @if(isset($businessPackage) && $businessPackage->package_id == 4)
                                        <span class="text-lg ml-1 font-normal text-gray-500">{{__('portal.Emdad-ID')}}: {{auth()->user()->business_id}}</span>
                                        <button class="flex items-center mt-auto text-white bg-yellow-500 border-0 py-2 px-4 w-full rounded" style="justify-content: center; cursor: no-drop" disabled>{{__('portal.Purchased')}}</button>
                                    @elseif(isset($businessPackage))
                                        <span onclick="alert('تواصل مع إمداد لترقية باقتك')" class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" style="justify-content: center; cursor: pointer">{{__('portal.Update')}}</span>
                                    @else
                                        <form action="{{route('business-packages.store')}}" method="POST" style="padding-top: 36px;">
                                            @csrf
                                            <input type="hidden" name="package_id" value="{{encrypt($package->id)}}">
                                            <button class="flex items-center mt-auto text-white bg-yellow-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded" disabled style="justify-content: center">{{__('portal.Subscribe')}}</button>
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
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm text-center bg-gray-500">{{__('portal.Functions')}}</th>
                            @foreach($packages as $package)
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm text-center bg-gray-500">
                                    @if($package->package_type == 'Basic') {{__('portal.Basic')}}
                                    @elseif($package->package_type == 'Silver') {{__('portal.Silver')}}
                                    @elseif($package->package_type == 'Gold') {{__('portal.Gold')}}
                                    @elseif($package->package_type == 'Platinum') {{__('portal.Platinum')}}
                                    @else {{$package->package_type}}
                                    @endif
                                    {{--                                    {{$package->package_type}}--}}
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="px-4 py-3 text-right">{{__('portal.Subscription For 1 year')}}</td>
                            @foreach($packages as $package)
                                <td class="px-4 py-3 text-center">
                                    @if($package->charges == 'Free') {{__('portal.Free')}}
                                    @elseif($package->charges == '(Purchases above SR 5 million/month )') {{__('portal.(Purchases above SR 5 million/month )')}}
                                    @else <span style="font-family: sans-serif">{{$package->charges}}</span> {{__('portal.SAR')}}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3 text-right">{{__('portal.Registration')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-gray-200 px-4 py-3">
                                    @if($package->registeration == 'Free') {{__('portal.Free')}}
                                    @else {{$package->registeration}}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3 text-right">{{__('portal.Main Categories')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-gray-200 px-4 py-3"><span style="font-family: sans-serif">{{$package->category}}</span></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3 text-right">{{__('portal.Sub Categories')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-gray-200 px-4 py-3"><span style="font-family: sans-serif">{{$package->sub_category}}</span></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3 text-right">{{__('portal.No. of available RFQs per Day')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-gray-200 px-4 py-3">
                                    @if($package->rfq_per_day == 'Unlimited') {{__('portal.Unlimited')}}
                                    @else <span style="font-family: sans-serif">{{$package->rfq_per_day}}</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3 text-right">{{__('portal.No. Quotes. Per 1 RFQ')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-gray-200 px-4 py-3">
                                    @if($package->quotations_per_rfq == 2) @include('misc.required') من 1 إلى <span style="font-family: sans-serif">{{$package->quotations_per_rfq}}</span>
                                    @elseif($package->quotations_per_rfq == 3) @include('misc.required') من 1 إلى <span style="font-family: sans-serif">{{$package->quotations_per_rfq}}</span>
                                    @elseif($package->quotations_per_rfq == 5) @include('misc.required') من 1 إلى <span style="font-family: sans-serif">{{$package->quotations_per_rfq}}</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3 text-right" style="font-family: sans-serif">Emdad Tools App</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-gray-200 px-4 py-3">
                                    @if($package->emdad_tools == 'Free') {{__('portal.Free')}}
                                    @else {{$package->emdad_tools}}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">{{__('portal.Super Admin (CEO role)')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"><span style="font-family: sans-serif">{{$package->super_admin_count}}</span></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">{{__('portal.Users')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"><span style="font-family: sans-serif">{{$package->users}}</span></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">{{__('portal.Payment')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">
                                    @if($package->payment_type == 'Cash') {{__('portal.Cash')}}
                                    @elseif($package->payment_type == 'Cash/Credit') {{__('portal.Cash/Credit')}}
                                    @else {{$package->payment_type}}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-right">{{__('portal.Trainings')}}</td>
                            @foreach($packages as $package)
                                <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">
                                    @if($package->training == 'Unlimited') {{__('portal.Unlimited')}}
                                    @else {{$package->training}}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        {{--<tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3"></td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3"></td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">{{__('portal.Discount Code')}}</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">{{__('portal.Discount Code')}}</td>
                            <td class="border-t-2 text-center border-gray-200 px-4 py-3">{{__('portal.Discount Code')}}</td>
                        </tr>--}}
                        </tbody>
                    </table>
                </div>
                <br>
                <span>@include('misc.required') <strong>{{__('portal.Note')}}:</strong> {{__('portal.Minimum 1 quotation received, in case of Branded item')}}</span>
                @if(isset($businessPackage->package_id) == 2 || isset($businessPackage->package_id) == 3 )
                    <br>
                    <div class="text-gray-500" style="text-align: end">
                        <a href="{{route('subscriptionPDF')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border
                                               border-transparent rounded-md font-semibold text-xs text-white uppercase
                                               tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-blue-700
                                               focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                            {{__('portal.Generate PDF')}}
                        </a>
                    </div>
                @endif
            </div>
        </section>

    </x-app-layout>
@endif
{{--<script>
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
</script>--}}
