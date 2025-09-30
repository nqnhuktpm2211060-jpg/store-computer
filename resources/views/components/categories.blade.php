<ul class="category-list">
    @foreach ($categories as $category)
        <li class="onhover-category-list">
            <a href="{{ route('product.index', ['category_id' => $category->id]) }}" class="category-name">
                <img src="{{ $category->icon_url }}" alt="">
                <h6>{{ $category->name_translated }}</h6>
                <i class="fa-solid fa-angle-right"></i>
            </a>

            <div class="onhover-category-box">
                <div class="list-1">
                    <div class="category-title-box">
                        <h5>{{ $category->name_translated }}</h5>
                    </div>
                    <ul>
                        @foreach ($category->categoryChilden as $cate)
                            <li>
                                <a href="{{ route('product.index', ['category_id' => $cate->id]) }}">{{ $cate->name_translated }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if(($category->previewProducts ?? collect())->isNotEmpty())
                    <div class="list-2">
                        <div class="category-title-box">
                            <h5>{{ __('product.featured') }}</h5>
                        </div>
                        <ul>
                            @foreach (($category->previewProducts ?? []) as $p)
                                <li>
                                    <a href="{{ route('product.detail', ['id' => $p->id]) }}" style="display:flex;align-items:center;gap:8px;">
                                        <img src="{{ $p->main_image }}" alt="{{ $p->name }}" width="40" height="40" style="object-fit:cover;border-radius:4px;">
                                        <span class="name" style="flex:1;">{{ $p->name }}</span>
                                        <span class="price" style="white-space:nowrap;">{{ number_format($p->current_price, 0, '.', ',') }}đ</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </li>
    @endforeach
</ul>
