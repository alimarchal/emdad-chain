@extends('ire.arabic.layout.app')

@section('body')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if (session()->has('message'))
                    <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-1">{{ session('message') }}</strong>
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                <div class="py-3">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <h2 class="text-2xl font-bold text-center">Profile details</h2>
                        <x-jet-validation-errors class="mb-4" />
                        <!-- This example requires Tailwind CSS v2.0+ -->
                            <div class="flex flex-col">
                                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                            <table class="min-w-full divide-y divide-gray-200" id="roles-table">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                        NAME
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                        Email
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                        Mobile #
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                        Bank
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                        National Id number
                                                    </th>

{{--                                                    @if(isset(auth()->guard('ire')->user()->referred_no))--}}
{{--                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">--}}
{{--                                                            Reference User name--}}
{{--                                                        </th>--}}
{{--                                                    @endif--}}

{{--                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">--}}
{{--                                                        Edit--}}
{{--                                                    </th>--}}
                                                </tr>
                                                </thead>

                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm text-center text-gray-900">{{auth()->guard('ire')->user()->name}}</div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm text-center text-gray-900">{{auth()->guard('ire')->user()->email}}</div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                            <div class="text-sm text-center text-gray-900">{{auth()->guard('ire')->user()->mobile_number}}</div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                            @php $bank = \App\Models\Bank::where('id', auth()->guard('ire')->user()->bank)->first(); @endphp
                                                            <div class="text-sm text-center text-gray-900">{{$bank->name}}</div>
                                                        </td>

                                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                            <div class="text-sm text-center text-gray-900">{{auth()->guard('ire')->user()->nid_num}}</div>
                                                        </td>

{{--                                                        @if(isset(auth()->guard('ire')->user()->referred_no))--}}
{{--                                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">--}}
{{--                                                                @php $referenceName = \App\Models\Ire::where('ire_no', auth()->guard('ire')->user()->referred_no)->first(); @endphp--}}
{{--                                                                <div class="text-sm text-center text-gray-900">{{$referenceName->name}}</div>--}}
{{--                                                            </td>--}}

{{--                                                        @endif--}}
{{--                                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">--}}
{{--                                                            <a href="#" class="text-indigo-600 inline-block hover:text-indigo-900" title="EDIT">--}}
{{--                                                                <svg width="18" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />--}}
{{--                                                                </svg>--}}
{{--                                                            </a>--}}
{{--                                                        </td>--}}
                                                    </tr>
                                                </tbody>

                                                <!-- More rows... -->
                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
