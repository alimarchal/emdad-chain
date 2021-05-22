<ul class="list-decimal ml-6">
    @foreach ($categories as $category)

        <li><a @if(auth()->user()->hasRole('SuperAdmin')) href="{{route('category.edit',$category->id)}}" @endif class="text-blue-900 hover:text-red-900 hover:underline">
                {{ $category->name . ' - ' . $category->name_ar . ' - ' .  $category->name_ur }}</a>

            --
            @php $count = \App\Models\BusinessCategory::where('category_number', $category->id)->count(); @endphp
            <a @if($count > 0) class="text-green-600 hover:underline" href="{{route('categoryRelatedBusiness', encrypt($category->id))}}"  @else class="text-red-600 hover:underline" style="cursor: no-drop" @endif > Registered Businesses {{$count}} </a>

            @if(auth()->user()->hasRole('SuperAdmin'))
                --
            <form class="inline" method="POST" action="{{ route('category.destroy', $category->id) }}">@csrf @method('delete')
                <input type="submit"  onclick="clicked(event)"  class="text-blue-800 hover:underline bg-white" value="Delete*" style="cursor: pointer">
            </form>
            @endif

        </li>
        @if (count($category->subcategory))
            @include('manageChild',['categories' => $category->subcategory])
        @endif
    @endforeach
</ul>
