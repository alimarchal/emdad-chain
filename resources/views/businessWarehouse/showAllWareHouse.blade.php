@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('All Business Warehouse') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                <a href="{{ route('business.index') }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                    {{__('portal.Back')}}
                </a>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')
                <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Warehouse/s')}}</h2>
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Sr. No')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Warehouse Name')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Responsible person')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Designation')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Mobile Number')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Actions')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($business as $biz)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                {{$loop->iteration}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                                {{$biz->warehouse_name}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                                {{$biz->name}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                                {{$biz->designation}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                                {{$biz->mobile}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-center text-sm font-medium">
                                                <a  href="{{route('businessWarehouse.edit',$biz->id)}}" class="h-10 px-5 m-2 text-green-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800">
                                                    {{--                                            VIEW @if(auth()->user()->hasRole('SuperAdmin')) & EDIT @endif--}}
                                                    {{__('portal.VIEW & EDIT')}}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{--                        @if(auth()->user()->hasRole('SuperAdmin'))--}}
                            <div class="card transition duration-300 ease-in-out hover:shadow-sm flex flex-col border m-5 rounded">
                                <h1 class="font-mono font-bold text-purple-900 text-lg leading-tight border-b p-3 px-5 my-0">{{__('portal.If you want to add more warehouse(s)')}}</h1>
                                <div class="card-body p-4">
                                    <div class="btn-group">
                                        <a href="{{ route('businessWarehouse.create') }}"  class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 float-left add-more mt-4 mb-4 bg-green-500">
                                            {{__('portal.Add More')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            {{--                        @endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function () {
                $('.js-example-basic-multiple').select2();
                $(".add-more").click(function () {
                    var html = $(".copy").html();
                    $(".after-add-more").after(html);
                });
                $("body").on("click", ".remove", function () {
                    $(this).parents(".control-group").remove();
                });
            });
        </script>

    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('All Business Warehouse') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="mt-5" style=" margin-right: 30px; margin-bottom: 10px ">
                <a href="{{ route('business.index') }}" style="background-color: #145EA8"
                   class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                    {{__('portal.Back')}}
                </a>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')
                <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Warehouse/s')}}</h2>
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Sr. No')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Warehouse Name')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Responsible person')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Designation')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Mobile Number')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Actions')}}
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($business as $biz)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-center" style="font-family: sans-serif">
                                            {{$loop->iteration}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500" style="font-family: sans-serif">
                                            {{$biz->warehouse_name}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500" style="font-family: sans-serif">
                                            {{$biz->name}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                            @if($biz->designation == 'CEO') {{__('portal.CEO')}} @else {{$biz->designation}} @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500" style="font-family: sans-serif">
                                            {{$biz->mobile}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-center text-sm font-medium">
                                            <a  href="{{route('businessWarehouse.edit',$biz->id)}}" class="h-10 px-5 m-2 text-green-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800 hover:text-white">
                                                {{--                                            VIEW @if(auth()->user()->hasRole('SuperAdmin')) & EDIT @endif--}}
                                                {{__('portal.VIEW & EDIT')}}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{--                        @if(auth()->user()->hasRole('SuperAdmin'))--}}
                            <div class="card transition duration-300 ease-in-out hover:shadow-sm flex flex-col border m-5 rounded">
                                <h1 class="font-mono font-bold text-purple-900 text-lg leading-tight border-b p-3 px-5 my-0">{{__('portal.If you want to add more warehouse(s)')}}</h1>
                                <div class="card-body p-4">
                                    <div class="btn-group">
                                        <a href="{{ route('businessWarehouse.create') }}"  class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 hover:text-white active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 float-left add-more mt-4 mb-4 bg-green-500">
                                            {{__('portal.Add More')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            {{--                        @endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function () {
                $('.js-example-basic-multiple').select2();
                $(".add-more").click(function () {
                    var html = $(".copy").html();
                    $(".after-add-more").after(html);
                });
                $("body").on("click", ".remove", function () {
                    $(this).parents(".control-group").remove();
                });
            });
        </script>

    </x-app-layout>
@endif
