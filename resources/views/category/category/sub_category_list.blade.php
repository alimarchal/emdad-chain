@foreach ($categories as $cate)
    {
    @if (!count($cate->subcategory))
        id: {{ $cate->id }},
    @endif
    text: "{{ ($cate->name != "Other"?strtoupper($cate->name): strtoupper(\App\Models\Category::where('id',$cate->parent_id)->first()->name) . ' (' . $cate->name . ') - ' . \App\Models\Category::where('id',$cate->parent_id)->first()->name_ar ) }} - {{ $cate->name_ar }}",
    @if (count($cate->subcategory))
        inc: [@include('category.category.sub_category_list',['categories' => $cate->subcategory])]
    @endif
    },
@endforeach
