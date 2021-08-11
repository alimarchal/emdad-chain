@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Purchase Orders Information') }}
            </h2>
        </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                    <img src="{{url('registration_step/E-2.png')}}" alt="User Registration" class="block w-auto my-2 m-auto"/>
                    <x-jet-validation-errors class="mb-4" />
                    @if($po->isNotEmpty())
                        <h2 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Existing P.O. Info')}}</h2>
                    @endif
                    <form action="{{route('purchaseOrderInfo.store')}}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Step # 4: Purchase Orders Information')}}</h3>
                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 w-1/3" for="no_of_drivers">
                                {{__('portal.No of Monthly Orders')}}
                            </label>
                            <label class="block font-medium text-sm text-gray-700 w-1/3" for="volume">
                                {{__('portal.Volume')}}
                            </label>
                            <label class="block font-medium text-sm text-gray-700 w-1/3" for="type">
                                {{__('portal.Type')}}
                            </label>
                            <label class="block font-medium text-sm text-gray-700 w-1/3" for="order_info_1">
                                {{__('portal.Proof (Old Orders...any file)')}}
                            </label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="no_of_monthly_orders" type="number" name="no_of_monthly_orders" value="{{old('no_of_monthly_orders')}}" required>
                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="volume" type="text" name="volume" value="{{old('volume')}}" required>
                            <select name="type" id="type" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                <option value="">{{__('portal.Select')}}</option>
                                <option {{(old('type') == 'Credit' ? 'selected' : '')}} value="Credit">{{__('portal.Credit')}}</option>
                                <option {{(old('type') == 'Cash' ? 'selected' : '')}} value="Cash">{{__('portal.Cash')}}</option>
                            </select>
                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="order_info" type="file" name="order_info_1[]" multiple>
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <input type="hidden" name="business_id" value="{{Auth::user()->business->id}}">
                        </div>
                        <div class="control-group after-add-more">

                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 float-right mt-4 mb-4">
                            {{__('portal.Submit for Approval')}}
                        </button>

                        <div class="flex space-x-2 mt-4">
                            <div style="padding-top: 0.1em; padding-bottom: 0.1rem" class="text-sm px-3 bg-pink-200 text-pink-800 rounded-full">{{__('portal.Please review all your information is correct after submission you will not able to edit any information.')}}</div>
                        </div>
                    </form>

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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Purchase Orders Information') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                        <img src="{{url('registration_step/E-2.png')}}" alt="User Registration" class="block w-auto my-2 m-auto"/>
                        <x-jet-validation-errors class="mb-4" />
                        @if($po->isNotEmpty())
                            <h2 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Existing P.O. Info')}}</h2>
                        @endif
                        <form action="{{route('purchaseOrderInfo.store')}}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                            @csrf
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Step # 4: Purchase Orders Information')}}</h3>
                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/3" for="no_of_drivers">
                                    {{__('portal.No of Monthly Orders')}}
                                </label>
                                <label class="block font-medium text-sm text-gray-700 w-1/3" for="volume" style="margin-right: 10px;">
                                    {{__('portal.Volume')}}
                                </label>
                                <label class="block font-medium text-sm text-gray-700 w-1/3" for="type">
                                    {{__('portal.Type')}}
                                </label>
                                <label class="block font-medium text-sm text-gray-700 w-1/3" for="order_info_1">
                                    {{__('portal.Proof (Old Orders...any file)')}}
                                </label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="no_of_monthly_orders" type="number" name="no_of_monthly_orders" value="{{old('no_of_monthly_orders')}}" required>
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="volume" type="text" name="volume" value="{{old('volume')}}" style="margin-right: 5px;" required>
                                <select name="type" id="type" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    <option {{(old('type') == 'Credit' ? 'selected' : '')}} value="Credit">{{__('portal.Credit')}}</option>
                                    <option {{(old('type') == 'Cash' ? 'selected' : '')}} value="Cash">{{__('portal.Cash')}}</option>
                                </select>
                                <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="order_info" type="file" name="order_info_1[]" multiple>
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <input type="hidden" name="business_id" value="{{Auth::user()->business->id}}">
                            </div>
                            <div class="control-group after-add-more">

                            </div>
                            <button type="submit" class="inline-flex float-left items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 float-right mt-4 mb-4">
                                {{__('portal.Submit for Approval')}}
                            </button>

                            <div class="flex space-x-2 mt-4">
                                <div style="padding-top: 0.1em; padding-bottom: 0.1rem" class="text-sm px-3 bg-pink-200 text-pink-800 rounded-full">{{__('portal.Please review all your information is correct after submission you will not able to edit any information.')}}</div>
                            </div>
                        </form>

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
