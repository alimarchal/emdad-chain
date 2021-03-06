@foreach ($categories as $cate)
    {
    {{-- @if (!count($cate->subcategory)) --}}
        id: {{ $cate->id }},
    {{-- @endif --}}
    text: "{{ strtoupper($cate->name) }} - {{ $cate->name_ar }}",
    @if (count($cate->subcategory))
        inc: [@include('category.adminCategory',['categories' => $cate->subcategory])]
    @endif
    },
@endforeach
