@foreach($categories as $cate)
    {
        id: {{$cate->id}},
        text: "{{$cate->name}}",
        @if(count($cate->subcategory))
            inc: [@include('category.category.sub_category_list',['categories' => $cate->subcategory])]
        @endif
    },
@endforeach
