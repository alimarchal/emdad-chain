@foreach ($categories as $cate)
    {
    {{-- @if (!count($cate->subcategory)) --}}
        id: {{ $cate->id }},
    {{-- @endif --}}
    text: "@if(strtoupper($cate->name) == "OTHER") {{\App\Models\Category::find($cate->parent_id)->name . " - " . \App\Models\Category::find($cate->parent_id)->name_ar }} ,  @endif {{ strtoupper($cate->name) }} - {{ $cate->name_ar }} ",
    @if (count($cate->subcategory))
        inc: [@include('category.adminCategory',['categories' => $cate->subcategory])]
    @endif
    },
@endforeach
