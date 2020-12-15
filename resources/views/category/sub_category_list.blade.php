<ul>
    @foreach($subcategories as $subcategory)
        <li>
            <i class="fa {{count($subcategory->subcategory)?'fa-plus':'fa-minus'}}"></i>
            <label>
                <input type="checkbox" class=" {{count($subcategory->subcategory)?'hummingbirdNoParent':''}}"> {{$subcategory->name}}
            </label>
            @if(count($subcategory->subcategory))
                @include('category.sub_category_list',['subcategories' => $subcategory->subcategory])
            @endif
        </li>
    @endforeach
</ul>


