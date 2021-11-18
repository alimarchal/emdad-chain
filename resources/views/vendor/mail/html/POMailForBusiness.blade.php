@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{--Body--}}

    {{ $slot }}

    @php $categoryName = \App\Models\Category::firstWhere('id', $dpo->item_code); $parent = \App\Models\Category::where('id', $categoryName->parent_id)->pluck('name')->first(); @endphp

    PO # : PO-{{$dpo->id}}
    RFQ # : RFQ-{{$dpo->rfq_no}}
    Quotation # : Q-{{$dpo->qoute_no}}
    Category Name :  {{ $categoryName->name }} , {{ $parent }}
    Description :  {{ $dpo->eOrderItem->description }}
    Quantity : {{ $dpo->quantity }}
    Unit : {{ $dpo->uom }}
    Payment Mode : {{ $dpo->payment_term }}
    Remarks : @if(isset($dpo->remarks)) {{ $dpo->remarks }} @else N/A @endif
    Total cost : {{ number_format($dpo->sub_total * 0.15 + $dpo->sub_total + $dpo->shipment_cost, 2) }} {{__('portal.SAR')}}
    Delivery Address : {{ $dpo->delivery_address }}


    Thanks,
    {{ config('app.name') }}

    {{--Footer--}}

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
