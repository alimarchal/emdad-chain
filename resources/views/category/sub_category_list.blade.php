@foreach($categories as $cate)
    {
    id: {{$cate->id}},
    text: "{{$cate->name}}",
    @if(count($cate->children))
        inc: [@include('category.sub_category_list',['categories' => $cate->children])]
    @endif
    },
@endforeach
