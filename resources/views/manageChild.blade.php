<ul class="list-decimal ml-6">
    @foreach ($categories as $category)
        <li><a href="{{route('category.edit',$category->id)}}" class="text-blue-900 hover:text-red-900 hover:underline">{{ $category->name . ' - ' . $category->name_ar . ' - ' .  $category->name_ur }}</a> --
            <form class="inline" method="POST" action="{{ route('category.destroy', $category->id) }}">@csrf @method('delete')
                <input type="submit"  onclick="clicked(event)"  class="text-blue-800 hover:underline bg-white" value="Delete*" style="cursor: pointer">
            </form>
        </li>
        @if (count($category->subcategory))
            @include('manageChild',['categories' => $category->subcategory])
        @endif
    @endforeach
</ul>