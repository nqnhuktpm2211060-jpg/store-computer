<div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
    <div class="modal-content">
        <div class="modal-header p-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="row g-sm-4 g-2">
                <div class="col-lg-6">
                    <div class="slider-image">
                        <img src="{{ $product->images[0]?->image_path }}" style="width: 100%"
                            class="img-fluid blur-up lazyload" alt="{{__('product.product_image')}}">
                    </div>
                </div>

                <div class="col-lg-6">
                    <form class="form-add-to-cart" method="post">
                        <input type="text" name="product_id" hidden value="{{ $product->id }}">
                        <div class="right-sidebar-modal">
                            <h4 class="title-name">{{ $product->name_translated }}</h4>
                            <h4 class="price">
                                {{ $product->has_sale
                                    ? number_format($product->sale_price, 0, '.', ',')
                                    : number_format($product->price, 0, '.', ',') }} đ
                            </h4>
                            <div class="product-rating">
                                @php
                                    $rating =
                                        $product->reviews->count() > 0
                                            ? $product->reviews->sum('rating') / $product->reviews->count()
                                            : 0;
                                @endphp

                                <ul class="rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <li>
                                            <i data-feather="star" class="{{ $i <= $rating ? 'fill' : '' }}"></i>
                                        </li>
                                    @endfor
                                </ul>
                                <span class="ms-2">{{ $product->reviews->count() }} {{__('product.reviews')}}</span>
                                {{-- <span class="ms-2 text-danger">6 sold in last 16 hours</span> --}}
                            </div>

                            <div class="product-detail">
                                <h4>{{__('product.product_details')}} :</h4>
                                <p>{{ $product->short_description_translated }}</p>
                            </div>

                            <ul class="brand-list">

                                <li>
                                    <div class="brand-box">
                                        <h5>{{__('product.product_code')}}:</h5>
                                        <h6>{{ $product->id }}</h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="brand-box">
                                        <h5>{{__('product.category')}}:</h5>
                                        <h6>{{ $product->category?->name_translated }}</h6>
                                    </div>
                                </li>
                            </ul>

                            {{-- <div class="select-size">
                                <h4>Cake Size :</h4>
                                <select class="form-select select-form-size">
                                    <option selected>Select Size</option>
                                    <option value="1.2">1/2 KG</option>
                                    <option value="0">1 KG</option>
                                    <option value="1.5">1/5 KG</option>
                                    <option value="red">Red Roses</option>
                                    <option value="pink">With Pink Roses</option>
                                </select>
                            </div> --}}

                            <div class="modal-button">
                                <button class="btn btn-md add-cart-button icon" type="submit">{{ __('product.add_to_cart') }}</button>
                                <button onclick="location.href = '{{ route('product.detail', $product->id) }}';"
                                    class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                                    {{__('product.view_details')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    addToCart();
</script>
