@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{--Body--}}

    {{ $slot }}

    @php $categoryName = \App\Models\Category::firstWhere('id', $quote->orderItem->item_code); $parent = \App\Models\Category::where('id', $categoryName->parent_id)->pluck('name')->first(); @endphp

    Category Name :  {{ $categoryName->name }} , {{ $parent }}
    Requisition # : RFQ-{{$quote->e_order_id}}

    Thanks,
    {{ config('app.name') }}

    {{--Footer--}}

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
