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
                <form method="post" action="{{route('storeSupplierRating')}}">
                    @csrf

                    @php $rfq_no = \App\Models\Delivery::where('id', $deliveryID)->pluck('rfq_no')->first();  @endphp
                    <input type="hidden" name="delivery_id" value="{{$deliveryID}}">
                    <input type="hidden" name="user_id" value="{{Auth::id()}}">
                    <input type="hidden" name="business_id" value="{{Auth::user()->business_id}}">
                    <input type="hidden" name="rfq_no" value="{{$rfq_no}}">

                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">

                            <h3 class="text-2xl text-center mb-2">Rate</h3>
                            <div class="grid grid-cols-8 gap-6">

                                <div class="col-span-6 sm:col-span-2">
                                    <label class="block font-medium text-sm text-gray-700" for="buyer_business_name">
                                        Buyer name
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="buyer_business_name" readonly value="{{$supplier->name}}">
                                    </label>
                                </div>
                                <div class="col-span-6 sm:col-span-2">
                                    <label class="block font-medium text-sm text-gray-700" for="buyer_business_name">
                                        Buyer business name
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="buyer_business_name" readonly value="{{$supplier->business->business_name}}">
                                    </label>
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <label class="block font-medium text-sm text-gray-700" for="rating">
                                        Rate
                                    </label>
                                    <select name="rating" id="rating" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                        <option disabled selected value="">Select</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <label class="block font-medium text-sm text-gray-700" for="comment_content">
                                        Comments
                                    </label>
                                    <textarea name="comment_content" id="comment_content" class="w-full" style="border: 2px solid #d6d8db; border-radius: 8px;" maxlength="254" cols="50" placeholder="Any Comments..."></textarea>
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
