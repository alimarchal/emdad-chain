@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{--Body--}}

    {{ $slot }}

    @php $categoryName = \App\Models\Category::firstWhere('id', $dpo->item_code); $parent = \App\Models\Category::where('id', $categoryName->parent_id)->pluck('name')->first(); @endphp
    @php $warehouseName = \App\Models\BusinessWarehouse::where('id', $dpo->warehouse_id)->pluck('address')->first(); @endphp

    DPO # : DPO-{{$dpo->id}}
    Category Name :  {{ $categoryName->name }} , {{ $parent }}
    Quantity : {{ $dpo->quantity }}
    Unit : {{ $dpo->uom }}
    Payment Mode : {{ $dpo->payment_term }}
    Remarks : {{ $dpo->remarks }}
    Total cost : {{ number_format($dpo->sub_total * 0.15 + $dpo->sub_total + $dpo->shipment_cost, 2) }} {{__('portal.SAR')}}
    Warehouse Address : {{ $warehouseName }}


    Thanks,
    {{ config('app.name') }}

    {{--Footer--}}

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
