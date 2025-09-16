<ul class="deal-offer-list">
    @forelse ($dealTodayProducts as $key => $product)
        <li class="list-{{($key % 3) + 1}}">
            <div class="deal-offer-contain">
                <a href="{{route('product.detail', $product->id)}}" class="deal-image">
                    <img src="{{$product->images[0]?->image_path}}" class="blur-up lazyload"
                        alt="">
                </a>

                <a href="{{route('product.detail', $product->id)}}" class="deal-contain">
                    <h5>{{$product->name_translated}}</h5>
                    <h6>{{number_format($product->sale_price)}} đ<del>{{number_format($product->price)}} đ</del></h6>
                </a>
            </div>
        </li>

    @empty

    <p class="w-100 text-center">{{__('product.there_are_no_products_on_sale_today')}}</p>
    @endforelse
</ul>