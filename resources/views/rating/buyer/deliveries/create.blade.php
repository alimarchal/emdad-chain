@section('headerScripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ratings') }}
            </h2>
        </x-slot>
        <script>
            $(document).ready(function () {
                $('.js-example-basic-multiple').select2();
                $('.js-example-basic-single').select2();
            });
        </script>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                @include('users.sessionMessage')
                @if ($errors->any())
                    <div>
                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="mt-5" style="margin-bottom: 10px ">
                        <a href="{{ route('deliveriesListToRate') }}" style="background-color: #145EA8" class="inline-flex items-center justify-left px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                            {{__('portal.Back')}}
                        </a>
                    </div>
                    <form method="post" action="{{route('storeBuyerRatedToDelivery')}}">
                        @csrf

                        @php $rfq_no = \App\Models\Delivery::where('id', decrypt($deliveryID))->pluck('rfq_no')->first();  @endphp
                        <input type="hidden" name="delivery_id" value="{{$deliveryID}}">
                        <input type="hidden" name="rfq_no" value="{{encrypt($rfq_no)}}">

                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">

                                <h3 class="text-2xl font-bold text-center text-blue-600">{{__('portal.Rate')}}</h3>

                                <div class="grid grid-cols-8 gap-6 mt-2">

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="supplier_business_name">
                                            {{__('portal.Supplier name')}}
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="supplier_business_name" readonly value="{{$supplier->name}}">
                                        </label>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="supplier_business_name">
                                            {{__('portal.Supplier business name')}}
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="supplier_business_name" readonly value="{{$supplier->business->business_name}}">
                                        </label>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="supplier_rating">{{__('portal.Rate')}}</label>
                                        <select name="supplier_rating" id="supplier_rating" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                            <option disabled selected value="">{{__('portal.Select')}}</option>
                                            <option @if (old('supplier_rating') == "1") {{ 'selected' }} @endif value="1">1</option>
                                            <option @if (old('supplier_rating') == "2") {{ 'selected' }} @endif value="2">2</option>
                                            <option @if (old('supplier_rating') == "3") {{ 'selected' }} @endif value="3">3</option>
                                            <option @if (old('supplier_rating') == "4") {{ 'selected' }} @endif value="4">4</option>
                                            <option @if (old('supplier_rating') == "5") {{ 'selected' }} @endif value="5">5</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="supplier_comment_content">{{__('portal.Comments')}}</label>
                                        <textarea name="supplier_comment_content" id="supplier_comment_content" class="w-full" style="border: 2px solid #d6d8db; border-radius: 8px;" maxlength="254" cols="50" placeholder="{{__('portal.Any Comments')}}...">{{old('supplier_comment_content')}}</textarea>
                                    </div>

                                </div>
                                <hr>

                                <div class="grid grid-cols-8 gap-6 mt-2">

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="driver_business_name">
                                            {{__('portal.Driver name')}}
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="driver_business_name" readonly value="{{$driver->name}}">
                                        </label>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="driver_business_name">
                                            {{__('portal.Driver business name')}}
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="driver_business_name" readonly value="{{$driver->business->business_name}}">
                                        </label>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="driver_rating">{{__('portal.Rate')}}</label>
                                        <select name="driver_rating" id="driver_rating" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                            <option disabled selected value="">{{__('portal.Select')}}</option>
                                            <option @if (old('driver_rating') == "1") {{ 'selected' }} @endif value="1">1</option>
                                            <option @if (old('driver_rating') == "2") {{ 'selected' }} @endif value="2">2</option>
                                            <option @if (old('driver_rating') == "3") {{ 'selected' }} @endif value="3">3</option>
                                            <option @if (old('driver_rating') == "4") {{ 'selected' }} @endif value="4">4</option>
                                            <option @if (old('driver_rating') == "5") {{ 'selected' }} @endif value="5">5</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="driver_comment_content">
                                            {{__('portal.Comments')}}
                                        </label>
                                        <textarea name="driver_comment_content" id="driver_comment_content" class="w-full" style="border: 2px solid #d6d8db; border-radius: 8px;" maxlength="254" cols="50" placeholder="{{__('portal.Any Comments')}}...">{{old('driver_comment_content')}}</textarea>
                                    </div>

                                </div>
                                <hr>

                                <div class="grid grid-cols-8 gap-6 mt-2">

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="emdad_business_name">
                                            {{__('portal.Name')}}
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="emdad_business_name" readonly value="{{__('portal.Emdad')}}">
                                        </label>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="emdad_rating">
                                            {{__('portal.Rate')}}
                                        </label>
                                        <select name="emdad_rating" id="emdad_rating" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                            <option disabled selected value="">{{__('portal.Select')}}</option>
                                            <option @if (old('emdad_rating') == "1") {{ 'selected' }} @endif  value="1">1</option>
                                            <option @if (old('emdad_rating') == "2") {{ 'selected' }} @endif  value="2">2</option>
                                            <option @if (old('emdad_rating') == "3") {{ 'selected' }} @endif  value="3">3</option>
                                            <option @if (old('emdad_rating') == "4") {{ 'selected' }} @endif  value="4">4</option>
                                            <option @if (old('emdad_rating') == "5") {{ 'selected' }} @endif  value="5">5</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="emdad_comment_content">
                                            {{__('portal.Comments')}}
                                        </label>
                                        <textarea name="emdad_comment_content" id="emdad_comment_content" class="w-full" style="border: 2px solid #d6d8db; border-radius: 8px;" maxlength="254" cols="50" placeholder="{{__('portal.Any Comments')}}...">{{old('emdad_comment_content')}}</textarea>
                                    </div>

                                </div>

                            </div>

                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    {{__('portal.Rate')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ratings') }}
            </h2>
        </x-slot>
        <script>
            $(document).ready(function () {
                $('.js-example-basic-multiple').select2();
                $('.js-example-basic-single').select2();
            });
        </script>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                @include('users.sessionMessage')
                @if ($errors->any())
                    <div>
                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="mt-5" style="margin-bottom: 10px ">
                        <a href="{{ route('deliveriesListToRate') }}" style="background-color: #145EA8" class="inline-flex items-center justify-left px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                            {{__('portal.Back')}}
                        </a>
                    </div>
                    <form method="post" action="{{route('storeBuyerRatedToDelivery')}}">
                        @csrf

                        @php $rfq_no = \App\Models\Delivery::where('id', decrypt($deliveryID))->pluck('rfq_no')->first();  @endphp
                        <input type="hidden" name="delivery_id" value="{{$deliveryID}}">
                        <input type="hidden" name="rfq_no" value="{{encrypt($rfq_no)}}">

                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">

                                <h3 class="text-2xl font-bold text-center text-blue-600">{{__('portal.Rate')}}</h3>

                                <div class="grid grid-cols-8 gap-6 mt-2">

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="supplier_business_name">
                                            {{__('portal.Supplier name')}}
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="supplier_business_name" readonly value="{{$supplier->name}}" style="font-family: sans-serif">
                                        </label>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="supplier_business_name">
                                            {{__('portal.Supplier business name')}}
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="supplier_business_name" readonly value="{{$supplier->business->business_name}}" style="font-family: sans-serif">
                                        </label>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="supplier_rating">{{__('portal.Rate')}}</label>
                                        <select name="supplier_rating" id="supplier_rating" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                            <option disabled selected value="">{{__('portal.Select')}}</option>
                                            <option @if (old('supplier_rating') == "1") {{ 'selected' }} @endif value="1" style="font-family: sans-serif">1</option>
                                            <option @if (old('supplier_rating') == "2") {{ 'selected' }} @endif value="2" style="font-family: sans-serif">2</option>
                                            <option @if (old('supplier_rating') == "3") {{ 'selected' }} @endif value="3" style="font-family: sans-serif">3</option>
                                            <option @if (old('supplier_rating') == "4") {{ 'selected' }} @endif value="4" style="font-family: sans-serif">4</option>
                                            <option @if (old('supplier_rating') == "5") {{ 'selected' }} @endif value="5" style="font-family: sans-serif">5</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="supplier_comment_content">{{__('portal.Comments')}}</label>
                                        <textarea name="supplier_comment_content" id="supplier_comment_content" class="w-full" style="border: 2px solid #d6d8db; border-radius: 8px;font-family: sans-serif" maxlength="254" cols="50" placeholder="{{__('portal.Any Comments')}}...">{{old('supplier_comment_content')}}</textarea>
                                    </div>

                                </div>
                                <hr>

                                <div class="grid grid-cols-8 gap-6 mt-2">

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="driver_business_name">
                                            {{__('portal.Driver name')}}
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="driver_business_name" readonly value="{{$driver->name}}" style="font-family: sans-serif">
                                        </label>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="driver_business_name">
                                            {{__('portal.Driver business name')}}
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="driver_business_name" readonly value="{{$driver->business->business_name}}" style="font-family: sans-serif">
                                        </label>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="driver_rating">{{__('portal.Rate')}}</label>
                                        <select name="driver_rating" id="driver_rating" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                            <option disabled selected value="">{{__('portal.Select')}}</option>
                                            <option @if (old('driver_rating') == "1") {{ 'selected' }} @endif value="1" style="font-family: sans-serif">1</option>
                                            <option @if (old('driver_rating') == "2") {{ 'selected' }} @endif value="2" style="font-family: sans-serif">2</option>
                                            <option @if (old('driver_rating') == "3") {{ 'selected' }} @endif value="3" style="font-family: sans-serif">3</option>
                                            <option @if (old('driver_rating') == "4") {{ 'selected' }} @endif value="4" style="font-family: sans-serif">4</option>
                                            <option @if (old('driver_rating') == "5") {{ 'selected' }} @endif value="5" style="font-family: sans-serif">5</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="driver_comment_content">
                                            {{__('portal.Comments')}}
                                        </label>
                                        <textarea name="driver_comment_content" id="driver_comment_content" class="w-full" style="border: 2px solid #d6d8db; border-radius: 8px;font-family: sans-serif" maxlength="254" cols="50" placeholder="{{__('portal.Any Comments')}}...">{{old('driver_comment_content')}}</textarea>
                                    </div>

                                </div>
                                <hr>

                                <div class="grid grid-cols-8 gap-6 mt-2">

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="emdad_business_name">
                                            {{__('portal.Name')}}
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="emdad_business_name" readonly value="{{__('portal.Emdad')}}">
                                        </label>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="emdad_rating">
                                            {{__('portal.Rate')}}
                                        </label>
                                        <select name="emdad_rating" id="emdad_rating" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                            <option disabled selected value="">{{__('portal.Select')}}</option>
                                            <option @if (old('emdad_rating') == "1") {{ 'selected' }} @endif  value="1" style="font-family: sans-serif">1</option>
                                            <option @if (old('emdad_rating') == "2") {{ 'selected' }} @endif  value="2" style="font-family: sans-serif">2</option>
                                            <option @if (old('emdad_rating') == "3") {{ 'selected' }} @endif  value="3" style="font-family: sans-serif">3</option>
                                            <option @if (old('emdad_rating') == "4") {{ 'selected' }} @endif  value="4" style="font-family: sans-serif">4</option>
                                            <option @if (old('emdad_rating') == "5") {{ 'selected' }} @endif  value="5" style="font-family: sans-serif">5</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="emdad_comment_content">
                                            {{__('portal.Comments')}}
                                        </label>
                                        <textarea name="emdad_comment_content" id="emdad_comment_content" class="w-full" style="border: 2px solid #d6d8db; border-radius: 8px;font-family: sans-serif" maxlength="254" cols="50" placeholder="{{__('portal.Any Comments')}}...">{{old('emdad_comment_content')}}</textarea>
                                    </div>

                                </div>

                            </div>

                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    {{__('portal.Rate')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif
