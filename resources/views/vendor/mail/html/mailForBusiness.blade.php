@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

 {{--Body--}}

    {{ $slot }}

    @foreach ($eOrderItems as $eOrderItem)
        @php $categoryName = \App\Models\Category::firstWhere('id', $eOrderItem->item_code); $parent = \App\Models\Category::where('id', $categoryName->parent_id)->pluck('name')->first(); @endphp
    # : {{$loop->iteration}}
    Category Name :  {{ $categoryName->name }} , {{ $parent }}
    Brand : {{ $eOrderItem->brand }}
    Description : {{ $eOrderItem->description }}
    Unit : {{ $eOrderItem->unit_of_measurement }}
    Size : {{ $eOrderItem->size }}
    Quantity : {{ $eOrderItem->quantity }}
    Last Price : {{ $eOrderItem->last_price }}
    Delivery Period : {{ $eOrderItem->delivery_period }}
    Payment Mode : {{ $eOrderItem->payment_mode }}
    Remarks : {{ $eOrderItem->remarks }}
    @endforeach

    Thanks,
    {{ config('app.name') }}

 {{--Footer--}}

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
