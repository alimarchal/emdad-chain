@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{--Body--}}

    {{ $slot }}

    @php $categoryName = \App\Models\Category::firstWhere('id', $deliveries[0]->item_code); $parent = \App\Models\Category::where('id', $categoryName->parent_id)->pluck('name')->first(); @endphp

    @foreach($deliveries as $delivery)
    Delivery # : DN-{{$delivery->id}}
        PO # : PO-{{$delivery->draft_purchase_order_id}}
        RFQ # : RFQ-{{$delivery->rfq_no}}
        Quotation # : Q-{{$delivery->qoute_no}}
        Total cost : {{ number_format($delivery->total_cost, 2) }} {{__('portal.SAR')}}
        Delivery Address : {{ $delivery->delivery_address }}
        Delivered At : {{ $delivery->updated_at }}
        Category Name :  {{ $categoryName->name }} , {{ $parent }}
        Description :  {{ $delivery->eOrderItems->description }}
        Quantity : {{ $delivery->quantity }}
        Unit : {{ $delivery->eOrderItems->unit_of_measurement }}
        Payment Mode : {{ $delivery->payment_term }}
        Remarks : @if(isset($delivery->eOrderItems->remarks)) {{ $delivery->eOrderItems->remarks }} @else N/A @endif
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
