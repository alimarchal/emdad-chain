@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{--Body--}}

    {{ $slot }}

    @php $categoryName = \App\Models\Category::firstWhere('id', $DPOs[0]->item_code); $parent = \App\Models\Category::where('id', $categoryName->parent_id)->pluck('name')->first(); @endphp

    PO # :  PO-{{ $DPOs[0]->id }}
    RFQ # : RFQ-{{ $DPOs[0]->rfq_no }}
    Quotation # : Q-{{ $DPOs[0]->qoute_no }}
    Category Name :  {{ $categoryName->name }} , {{ $parent }}
    Delivery Address : {{ $DPOs[0]->delivery_address }}
    Payment Mode : {{ $DPOs[0]->payment_term }}

    @foreach($DPOs as $dpo)
        # : {{$loop->iteration}}
        Description : {{ $dpo->eOrderItem->description }}
        Quantity : {{ $dpo->quantity }}
        Unit : {{ $dpo->uom }}
        Remarks : {{ $dpo->remarks }}
    @endforeach

    Total cost : {{ number_format($DPOs[0]->total_cost, 2) }} {{__('portal.SAR')}}


    Thanks,
    {{ config('app.name') }}

    {{--Footer--}}

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
