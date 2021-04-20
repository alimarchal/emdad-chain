@extends('sales.english.layout.app')

@section('body')
<h2 class="font-semibold text-center text-xl text-gray-800 leading-tight" name="header" style="padding-top: 20px;">
{{--                {{ __('Dashboard') }} - Welcome {{ auth()->user()->gender == "0" ?'Mr. ' . Auth::user()->name: auth()->user()->gender == "1" ? 'Mrs.'. Auth::user()->name}}--}}
                {{ __('Dashboard') }} - Welcome {{auth()->guard('seller')->user()->name}}

</h2>

<div class="mt-4">
    <div class="flex flex-wrap -mx-6">
        <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
            <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                </div>

                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700"><a href="{{route('users.index')}}"></a></h4>
                    <div class="text-gray-500"><a href="{{route('sellerReference')}}">Total Referenced IREs</a></div>
                    @php $sellersCount = \App\Models\Seller::where('referred_no', auth()->guard('seller')->user()->seller_no)->count(); @endphp
                    <div class="text-gray-500">{{$sellersCount}}</div>
                </div>
            </div>
        </div>



        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
            <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                <div class="p-3 rounded-full bg-orange-600 bg-opacity-75">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>

                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700"></h4>
                    <div class="text-gray-500"><a href="javascript:void(0)">Total Referenced Buyers</a></div>
                </div>
            </div>
        </div>


        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
            <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                <div class="p-3 rounded-full bg-pink-600 bg-opacity-75">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>

                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">  </h4>
                    <div class="text-gray-500"><a href="javascript:void(0)">Total Referenced Suppliers</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
