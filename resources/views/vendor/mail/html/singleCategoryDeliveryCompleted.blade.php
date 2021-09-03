@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{--Body--}}

    {{ $slot }}

    @php $categoryName = \App\Models\Category::firstWhere('id', $deliveries[0]->item_code); $parent = \App\Models\Category::where('id', $categoryName->parent_id)->pluck('name')->first(); @endphp

    Delivery # : DN-{{$deliveries[0]->id}}
    PO # : PO-{{$deliveries[0]->draft_purchase_order_id}}
    RFQ # : RFQ-{{$deliveries[0]->rfq_no}}
    Quotation # : Q-{{$deliveries[0]->qoute_no}}
    Category Name :  {{ $categoryName->name }} , {{ $parent }}
    Payment Mode : {{ $deliveries[0]->payment_term }}
    Total cost : {{ number_format($deliveries[0]->total_cost, 2) }} {{__('portal.SAR')}}
    Delivery Address : {{ $deliveries[0]->delivery_address }}
    Delivered At : {{ $deliveries[0]->updated_at }}
    @foreach($deliveries as $delivery)
    # : {{$loop->iteration}}
        Description :  {{ $delivery->eOrderItems->description }}
        Quantity : {{ $delivery->quantity }}
        Unit : {{ $delivery->eOrderItems->unit_of_measurement }}
        Remarks : @if(isset($delivery->eOrderItems->remarks)) {{ $delivery->eOrderItems->remarks }} @else N/A @endif
        <br>
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
