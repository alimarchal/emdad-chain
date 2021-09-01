@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{--Body--}}

    {{ $slot }}

    @php $categoryName = \App\Models\Category::firstWhere('id', $DPOs[0]->item_code); $parent = \App\Models\Category::where('id', $categoryName->parent_id)->pluck('name')->first(); @endphp
    @php $warehouseName = \App\Models\BusinessWarehouse::where('id', $DPOs[0]->warehouse_id)->pluck('address')->first(); @endphp

    Category Name :  {{ $categoryName->name }} , {{ $parent }}
    Warehouse Address : {{ $warehouseName }}
    Payment Mode : {{ $DPOs[0]->payment_term }}

    @foreach($DPOs as $dpo)
        # : {{$loop->iteration}}
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
