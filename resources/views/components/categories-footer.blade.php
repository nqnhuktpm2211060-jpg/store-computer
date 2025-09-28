<ul>
    @foreach ($categories as $category)
        <li>
            <a href="{{route('product.index', ['category_l1_id' => $category->id])}}" class="text-content">{{$category->name_translated}}</a>
        </li>
    @endforeach
</ul>