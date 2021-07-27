@section('headerScripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
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
        <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
            <a href="{{ route('supplierDeliveriesListToRate') }}" class="inline-flex items-center justify-left px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-500 focus:outline-none focus:border-orange-700 focus:shadow-outline-orange active:bg-orange-600 transition ease-in-out duration-150">
                Back
            </a>
        </div>
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
                <form method="post" action="{{route('storeSupplierRatedToDelivery')}}">
                    @csrf

                    @php $rfq_no = \App\Models\Delivery::where('id', decrypt($deliveryID))->pluck('rfq_no')->first();  @endphp
                    <input type="hidden" name="delivery_id" value="{{$deliveryID}}">
                    <input type="hidden" name="rfq_no" value="{{encrypt($rfq_no)}}">

                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">

                            <h2 class="text-2xl font-bold text-center text-blue-600">Rate</h2>

                            <div class="grid grid-cols-8 gap-6 mt-2">

                                <div class="col-span-6 sm:col-span-2">
                                    <label class="block font-medium text-sm text-gray-700" for="buyer_business_name">
                                        Buyer name
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="buyer_business_name" readonly value="{{$buyer->name}}">
                                    </label>
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <label class="block font-medium text-sm text-gray-700" for="buyer_business_name">
                                        Buyer business name
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="buyer_business_name" readonly value="{{$buyer->business->business_name}}">
                                    </label>
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <label class="block font-medium text-sm text-gray-700" for="buyer_rating">Rate</label>
                                    <select name="buyer_rating" id="buyer_rating" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                        <option disabled selected value="">Select</option>
                                        <option @if (old('buyer_rating') == "1") {{ 'selected' }} @endif value="1">1</option>
                                        <option @if (old('buyer_rating') == "2") {{ 'selected' }} @endif value="2">2</option>
                                        <option @if (old('buyer_rating') == "3") {{ 'selected' }} @endif value="3">3</option>
                                        <option @if (old('buyer_rating') == "4") {{ 'selected' }} @endif value="4">4</option>
                                        <option @if (old('buyer_rating') == "5") {{ 'selected' }} @endif value="5">5</option>
                                    </select>
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <label class="block font-medium text-sm text-gray-700" for="buyer_comment_content">Comments</label>
                                    <textarea name="buyer_comment_content" id="buyer_comment_content" class="w-full" style="border: 2px solid #d6d8db; border-radius: 8px;" maxlength="254" cols="50" placeholder="Any Comments...">{{old('buyer_comment_content')}}</textarea>
                                </div>

                            </div>
                            <hr>

                            <div class="grid grid-cols-8 gap-6 mt-2">

                                <div class="col-span-6 sm:col-span-2">
                                    <label class="block font-medium text-sm text-gray-700" for="emdad_business_name">
                                        Name
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="emdad_business_name" readonly value="Emdad">
                                    </label>
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <label class="block font-medium text-sm text-gray-700" for="emdad_rating">
                                        Rate
                                    </label>
                                    <select name="emdad_rating" id="emdad_rating" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                        <option disabled selected value="">Select</option>
                                        <option @if (old('emdad_rating') == "1") {{ 'selected' }} @endif  value="1">1</option>
                                        <option @if (old('emdad_rating') == "2") {{ 'selected' }} @endif  value="2">2</option>
                                        <option @if (old('emdad_rating') == "3") {{ 'selected' }} @endif  value="3">3</option>
                                        <option @if (old('emdad_rating') == "4") {{ 'selected' }} @endif  value="4">4</option>
                                        <option @if (old('emdad_rating') == "5") {{ 'selected' }} @endif  value="5">5</option>
                                    </select>
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <label class="block font-medium text-sm text-gray-700" for="emdad_comment_content">
                                        Comments
                                    </label>
                                    <textarea name="emdad_comment_content" id="emdad_comment_content" class="w-full" style="border: 2px solid #d6d8db; border-radius: 8px;" maxlength="254" cols="50" placeholder="Any Comments...">{{old('emdad_comment_content')}}</textarea>
                                </div>

                            </div>

                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Rate
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
