@foreach ($categories as $cate)
{
    @if (!count($cate->subcategory))
        id: {{ $cate->id }},
    @endif
{{--    text: "{{ $cate->name . ' - ' . $cate->name_ar }}",--}}
    text: "{{ $cate->name }}",
    @if (count($cate->children))
        inc: [@include('category.sub_category_list',['categories' => $cate->children])]
    @endif
    },
@endforeach
