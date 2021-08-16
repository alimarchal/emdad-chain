@if(auth()->user()->rtl == 0)
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                <div class="bg-white overflow-hidden shadow-xl ">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <h3 class="text-2xl text-center"><strong>{{__('portal.Package Update')}}</strong></h3>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <strong>{{__('portal.Current Package')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $businessPackage->package->package_type }}<br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <strong>{{__('portal.Upgrading to package')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $package->package_type }}<br>
                            </div>
                        </div>
                        <hr>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                @php
                                    $startDate = \Carbon\Carbon::parse($businessPackage->subscription_start_date);
                                    $now = \Carbon\Carbon::now();
                                    $usedDays = $now->diffInDays($startDate);
                                    $currentAmountUsed= 0;
                                    $balance = 0;
                                    $amountToPay = 0;
                                    if ($businessPackage->package->id != 1 && $businessPackage->package->id != 5)
                                        {
                                            $currentAmountUsed = ($businessPackage->package->charges * $usedDays) / 365 ;
                                            $balance = $businessPackage->package->charges - $currentAmountUsed;
                                            $amountToPay = $package->charges - $balance;
                                        }
                                @endphp
                                <strong>{{__('portal.Current days used')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{$usedDays}}<br>
                                <strong>{{__('portal.Current amount used')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($currentAmountUsed, 2)}}<br>
                                <strong>{{__('portal.Balance of the subscription amount')}}: &nbsp;</strong>{{ number_format($balance, 2) }}<br>
                                <strong>{{__('portal.New Package Charges')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($package->charges, 2) }}<br>
                                <hr>
                                <strong>{{__('portal.Amount to be paid')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    @if($businessPackage->package->id != 1) {{ number_format($amountToPay, 2) }}
                                    @else {{number_format($package->charges, 2)}}
                                    @endif
                                <br>
                                <hr>
                            </div>
                            {{--<div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>--}}
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden p-4 mt-4" style="justify-content: flex-end;">
                            <div class="w-full overflow-hidden lg:w-1/2 xl:w-1/2">
                                <div class="text-gray-500" style="text-align: end">
                                    <form  action="{{route('businessPackage.stepOne')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="package_id" value="{{$package->id}}">
                                        <input type="hidden" name="business_package_id" value="{{$businessPackage->id}}">
                                        <input type="hidden" name="amountToPay" value="{{$amountToPay}}">
                                        <button class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border
                                                   border-transparent rounded-md font-semibold text-xs text-white uppercase
                                                   tracking-widest hover:bg-red-500  focus:outline-none focus:border-green-700
                                                   focus:shadow-outline-red active:bg-green-600 transition ease-in-out duration-150" style="justify-content: center">{{__('portal.Upgrade')}}</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                <div class="bg-white overflow-hidden shadow-xl ">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <h3 class="text-2xl text-center"><strong>{{__('portal.Package Update')}}</strong></h3>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <strong>{{__('portal.Current Package')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @if($businessPackage->package->package_type == 'Basic') {{__('portal.Basic')}}
                                @elseif($businessPackage->package->package_type == 'Silver') {{__('portal.Silver')}}
                                @elseif($businessPackage->package->package_type == 'Gold') {{__('portal.Gold')}}
                                @elseif($businessPackage->package->package_type == 'Platinum') {{__('portal.Platinum')}}
                                @else {{ $businessPackage->package->package_type }}
                                @endif
                                <br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <strong>{{__('portal.Upgrading to package')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @if($package->package_type == 'Basic') {{__('portal.Basic')}}
                                @elseif($package->package_type == 'Silver') {{__('portal.Silver')}}
                                @elseif($package->package_type == 'Gold') {{__('portal.Gold')}}
                                @elseif($package->package_type == 'Platinum') {{__('portal.Platinum')}}
                                @else {{ $package->package_type }}
                                @endif
                                <br>
                            </div>
                        </div>
                        <hr>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                @php
                                    $startDate = \Carbon\Carbon::parse($businessPackage->subscription_start_date);
                                    $now = \Carbon\Carbon::now();
                                    $usedDays = $now->diffInDays($startDate);
                                    $currentAmountUsed= 0;
                                    $balance = 0;
                                    $amountToPay = 0;
                                    if ($businessPackage->package->id != 1 && $businessPackage->package->id != 5)
                                        {
                                            $currentAmountUsed = ($businessPackage->package->charges * $usedDays) / 365 ;
                                            $balance = $businessPackage->package->charges - $currentAmountUsed;
                                            $amountToPay = $package->charges - $balance;
                                        }
                                @endphp
                                <strong>{{__('portal.Current days used')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{$usedDays}}<br>
                                <strong>{{__('portal.Current amount used')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($currentAmountUsed, 2)}}<br>
                                <strong>{{__('portal.Balance of the subscription amount')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($balance, 2) }}<br>
                                <strong>{{__('portal.New Package Charges')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($package->charges, 2) }}<br>
                                <hr>
                                <strong>{{__('portal.Amount to be paid')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @if($businessPackage->package->id != 1) {{ number_format($amountToPay, 2) }}
                                @else {{number_format($package->charges, 2)}}
                                @endif
                                <br>
                                <hr>
                            </div>
                            {{--<div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>--}}
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden p-4 mt-4" style="justify-content: flex-end;">
                            <div class="w-full overflow-hidden lg:w-1/2 xl:w-1/2">
                                <div class="text-gray-500" style="text-align: end">
                                    <form  action="{{route('businessPackage.stepOne')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="package_id" value="{{$package->id}}">
                                        <input type="hidden" name="business_package_id" value="{{$businessPackage->id}}">
                                        <input type="hidden" name="amountToPay" value="{{$amountToPay}}">
                                        <button class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border
                                                   border-transparent rounded-md font-semibold text-xs text-white uppercase
                                                   tracking-widest hover:bg-red-500  focus:outline-none focus:border-green-700
                                                   focus:shadow-outline-red active:bg-green-600 transition ease-in-out duration-150" style="justify-content: center">{{__('portal.Upgrade')}}</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif
