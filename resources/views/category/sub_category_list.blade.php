@foreach ($categories as $cate)
{
    @if (!count($cate->subcategory))
        id: {{ $cate->id }},
    @endif
{{--    text: "{{ $cate->name . ' - ' . $cate->name_ar }}",--}}
    @if(auth()->user()->rtl == 0)
        text: "@if(strtoupper($cate->name) == "OTHER") {{\App\Models\Category::find($cate->parent_id)->name . " - " . \App\Models\Category::find($cate->parent_id)->name_ar }} ,  @endif {{ $cate->name }}",
    @else
        text: "@if(strtoupper($cate->name) == "OTHER") {{\App\Models\Category::find($cate->parent_id)->name . " - " . \App\Models\Category::find($cate->parent_id)->name_ar }} ,  @endif {{ $cate->name_ar }}",
    @endif
    @if (count($cate->children))
        inc: [@include('category.sub_category_list',['categories' => $cate->children])]
    @endif
    },
@endforeach
