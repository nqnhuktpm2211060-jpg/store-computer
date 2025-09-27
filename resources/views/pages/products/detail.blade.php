@extends('layout')
@section('title', $product->name)

@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>{{ __('product.title_detail') }}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">{{ __('product.title_detail') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Left Sidebar Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                    <div class="row g-4">
                        <div class="col-xl-6 wow fadeInUp">
                            <div class="product-left-box">
                                <div class="row g-2">
                                    <div class="col-xxl-10 col-lg-12 col-md-10 order-xxl-2 order-lg-1 order-md-2">
                                        <div class="product-main no-arrow">
                                            @foreach($product->all_images as $index => $imageUrl)
                                                <div>
                                                    <div class="slider-image">
                                                        <img src="{{ $imageUrl }}"
                                                            id="{{ $index == 0 ? 'img-1' : '' }}"
                                                            data-zoom-image="{{ $imageUrl }}"
                                                            class="img-fluid image_zoom_cls image_zoom_cls-{{ $index }} blur-up lazyload"
                                                            alt="">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-xxl-2 col-lg-12 col-md-2 order-xxl-1 order-lg-2 order-md-1">
                                        <div class="left-slider-image left-slider no-arrow slick-top">
                                            @foreach($product->all_images as $index => $imageUrl)
                                                <div>
                                                    <div class="sidebar-image">
                                                        <img src="{{ $imageUrl }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="right-box-contain">
                                <h6 class="offer-top">{{ __('product.discount') }} {!! $product->has_sale
                                    ? number_format((($product->price - $product->sale_price) / $product->price) * 100, 0)
                                    : '0' !!}%</h6>
                                <h2 class="name">{{ $product->name }}</h2>
                                <div class="price-rating">
                                    <h3 class="theme-color price">
                                        {{ $product->has_sale ? number_format($product->sale_price) : number_format($product->price) }}
                                        đ <del
                                            class="text-content">{{ $product->has_sale ? number_format($product->price) . ' đ' : '' }}</del>
                                    </h3>
                                    <div class="product-rating custom-rate">
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
                                        <span class="review">{{ $product->reviews->count() }} {{ __('product.reviews') }}</span>
                                    </div>
                                </div>

                                <div class="product-contain">
                                    <p>
                                        {{ $product->short_description_translated }}
                                    </p>
                                </div>


                                <div class="time deal-timer product-deal-timer mx-md-0 mx-auto" id="clockdiv-1"
                                    data-hours="1" data-minutes="2" data-seconds="3">
                                    <div class="product-title">
                                        <h4>{{ __('product.discount_ends_on')}}</h4>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="days d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>{{ __('product.day')}}</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="hours d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>{{ __('product.hour')}}</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="minutes d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>{{ __('product.minute')}}</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="seconds d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>{{ __('product.second')}}</h6>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <form class="form-add-to-cart" method="post">
                                    <input type="text" name="product_id" hidden value="{{ $product->id }}">
                                    <div class="note-box product-package">
                                        <div class="cart_qty qty-box product-qty">
                                            <div class="input-group">

                                                <button type="button" class="qty-left-minus" data-type="minus"
                                                    data-field="">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                                <input class="form-control input-number qty-input" type="text"
                                                    name="quantity" value="1">
                                                <button type="button" class="qty-right-plus" data-type="plus"
                                                    data-field="">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-md bg-dark cart-button text-white w-100">{{ __('product.add_to_cart') }}</button>
                                    </div>
                                </form>

                                <div class="progress-sec">
                                    <div class="left-progressbar">
                                        <h6>{{ __('product.hurry_up') }} {{ $product->stock_quantity }} {{ __('product.products_left') }}
                                        </h6>
                                        <div role="progressbar" class="progress warning-progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                style="width: 50%;"></div>
                                        </div>
                                    </div>
                                </div>


                                <div class="pickup-box">
                                    <div class="product-title">
                                        <h4>{{ __('product.product_information') }}</h4>
                                    </div>

                                    <div class="product-info">
                                        <ul class="product-info-list product-info-list-2">
                                            <li>{{ __('product.category') }} : <a href="javascript:void(0)">{{ $product->category?->name_translated }}</a>
                                            </li>
                                            <li>{{ __('product.product_code') }} : <a href="javascript:void(0)">{{ $product->id }}</a></li>
                                            <li>{{ __('product.in_stock') }} : <a href="javascript:void(0)">{{ $product->stock_quantity }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="payment-option">
                                    <div class="product-title">
                                        <h4>{{ __('product.secure_payment') }}</h4>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/1.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/2.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/3.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/4.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/5.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="product-section-box">
                                <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                            data-bs-target="#description" type="button" role="tab">{{ __('product.description') }}</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="info-tab" data-bs-toggle="tab"
                                            data-bs-target="#info" type="button" role="tab">{{ __('product.product_characteristics') }}</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                            data-bs-target="#review" type="button" role="tab">{{ __('product.reviews') }}</button>
                                    </li>
                                </ul>

                                <div class="tab-content custom-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                                        <div class="product-description">
                                            {!! $product->description_translated !!}
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="info" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="table info-table">
                                                <tbody>

                                                    @foreach ($product->characteristics_translated as $characteristic)
                                                        <tr>
                                                            <td>{{ $characteristic->name }}</td>
                                                            <td>{{ $characteristic->description }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="review" role="tabpanel">
                                        <div class="review-box">
                                            <div class="row">
                                                <div class="col-xl-5">
                                                    <div class="product-rating-box">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <div class="product-main-rating">
                                                                    <h2>3.40
                                                                        <i data-feather="star"></i>
                                                                    </h2>

                                                                    <h5>5 {{ __('product.overall_rating') }}</h5>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-12">
                                                                <ul class="product-rating-list">
                                                                    <li>
                                                                        <div class="rating-product">
                                                                            <h5>5<i data-feather="star"></i></h5>
                                                                            <div class="progress">
                                                                                <div class="progress-bar"
                                                                                    style="width: 40%;">
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="total">2</h5>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="rating-product">
                                                                            <h5>4<i data-feather="star"></i></h5>
                                                                            <div class="progress">
                                                                                <div class="progress-bar"
                                                                                    style="width: 20%;">
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="total">1</h5>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="rating-product">
                                                                            <h5>3<i data-feather="star"></i></h5>
                                                                            <div class="progress">
                                                                                <div class="progress-bar"
                                                                                    style="width: 0%;">
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="total">0</h5>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="rating-product">
                                                                            <h5>2<i data-feather="star"></i></h5>
                                                                            <div class="progress">
                                                                                <div class="progress-bar"
                                                                                    style="width: 20%;">
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="total">1</h5>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="rating-product">
                                                                            <h5>1<i data-feather="star"></i></h5>
                                                                            <div class="progress">
                                                                                <div class="progress-bar"
                                                                                    style="width: 20%;">
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="total">1</h5>
                                                                        </div>
                                                                    </li>

                                                                </ul>

                                                                <div class="review-title-2">
                                                                    <h4 class="fw-bold">Review this product</h4>
                                                                    <p>Let other customers know what you think</p>
                                                                    <button class="btn" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#writereview">Write a
                                                                        review</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-7">
                                                    <div class="review-people">
                                                        <ul class="review-list">
                                                            <li>
                                                                <div class="people-box">
                                                                    <div>
                                                                        <div class="people-image people-text">
                                                                            <img alt="user" class="img-fluid "
                                                                                src="../assets/images/review/1.jpg">
                                                                        </div>
                                                                    </div>
                                                                    <div class="people-comment">
                                                                        <div class="people-name"><a
                                                                                href="javascript:void(0)"
                                                                                class="name">Jack Doe</a>
                                                                            <div class="date-time">
                                                                                <h6 class="text-content"> 29 Sep 2023
                                                                                    06:40:PM
                                                                                </h6>
                                                                                <div class="product-rating">
                                                                                    <ul class="rating">
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"></i>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="reply">
                                                                            <p>Avoid this product. The quality is
                                                                                terrible, and
                                                                                it started falling apart almost
                                                                                immediately. I
                                                                                wish I had read more reviews before
                                                                                buying.
                                                                                Lesson learned.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                    <div class="right-sidebar-box">
                        <div class="vendor-box">
                            <div class="vendor-contain">
                                <div class="vendor-image">
                                    <img src="../assets/images/product/vendor.png" class="blur-up lazyload"
                                        alt="">
                                </div>

                                <div class="vendor-name">
                                    <h5 class="fw-500">Noodles Co.</h5>

                                    <div class="product-rating mt-1">
                                        <ul class="rating">
                                            <li>
                                                <i data-feather="star" class="fill"></i>
                                            </li>
                                            <li>
                                                <i data-feather="star" class="fill"></i>
                                            </li>
                                            <li>
                                                <i data-feather="star" class="fill"></i>
                                            </li>
                                            <li>
                                                <i data-feather="star" class="fill"></i>
                                            </li>
                                            <li>
                                                <i data-feather="star"></i>
                                            </li>
                                        </ul>
                                        <span>(36 {{ __('product.reviews')}})</span>
                                    </div>

                                </div>
                            </div>

                            <p class="vendor-detail">{{ __('product.vendor_info') }}</p>

                            <div class="vendor-list">
                                <ul>
                                    <li>
                                        <div class="address-contact">
                                            <i data-feather="map-pin"></i>
                                            <h5>{{__('product.address')}}: <span class="text-content">1288 Franklin Avenue</span></h5>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="address-contact">
                                            <i data-feather="headphones"></i>
                                            <h5>{{__('product.contact_seller')}}: <span class="text-content">(+1)-123-456-789</span></h5>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Trending Product -->
                        <div class="pt-25">
                            <div class="category-menu">
                                <h3>{{ __('product.recommended_products') }}</h3>

                                <ul class="product-list product-right-sidebar border-0 p-0">
                                    @forelse($suggestedProducts as $product)
                                        <li>
                                            <div class="offer-product">
                                                <a href="{{ route('product.detail', $product->id) }}"
                                                    class="offer-image">
                                                    <img src="{{ $product->main_image }}"
                                                        class="blur-up lazyload" alt="{{ $product->name }}">
                                                </a>

                                                <div class="offer-detail">
                                                    <div>
                                                        <a href="{{ route('product.detail', $product->id) }}"
                                                            class="text-title">
                                                            <h6 class="name">{{ $product->name }}</h6>
                                                        </a>
                                                        <span> {{ $product->stock_quantity > 0 ? __('product.in_stock') : __('product.out_stock') }}
                                                        </span>
                                                        <h5 class="sold text-content">
                                                            <span
                                                                class="theme-color price">{{ $product->has_sale ? number_format($product->sale_price, 0, '.', ',') : number_format($product->price, 0, '.', ',') }}
                                                                đ</span>
                                                            <del>{{ $product->has_sale ? number_format($product->sale_price, 0, '.', ',') . ' đ' : '' }}</del>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <p class="text-center">{{ __('product.no_products_available')}}</p>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <!-- Banner Section -->
                        <div class="ratio_156 pt-25">
                            <div class="home-contain">
                                <img src="../assets/images/vegetable/banner/8.jpg" class="bg-img blur-up lazyload"
                                    alt="">
                                <div class="home-detail p-top-left home-p-medium">
                                    <div>
                                        <h6 class="text-yellow home-banner">{{ __('product.text_banner_1') }}</h6>
                                        <h3 class="text-uppercase fw-normal"><span class="theme-color fw-bold">{{ __('product.text_banner_2') }}</span> {{ __('product.text_banner_3') }}</h3>
                                        <button onclick="location.href = '{{ route('product.index') }}';"
                                            class="btn btn-animation btn-md fw-bold mend-auto"> {{__('product.shop_now')}}<i
                                                class="fa-solid fa-arrow-right icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Left Sidebar End -->

    <!-- Related Product Section Start -->
    <section class="product-list-section section-b-space">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>{{ __('product.related_products') }}</h2>
                <span class="title-leaf">
                    <svg class="icon-width">
                        <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                    </svg>
                </span>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="slider-6_1 product-wrapper">
                        @forelse ($relatedProducts as $it)
                            <form class="form-add-to-cart" method="post">
                                <input type="text" name="product_id" hidden value="{{ $it->id }}">
                                <div>
                                    <div class="product-box-3 wow fadeInUp">
                                        <div class="product-header">
                                            <div class="product-image">
                                                <a href="{{ route('product.detail', $it->id) }}">
                                                    <img src="{{ $it->main_image }}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
    
                                                <ul class="product-option">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" class="view"
                                                        data-id="{{ $it->id }}" title="View">
                                                        <a href="javascript:void(0)">
                                                            <i data-feather="eye"></i>
                                                        </a>
                                                    </li>
    
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                        <a href="#!">
                                                            <i data-feather="refresh-cw"></i>
                                                        </a>
                                                    </li>
    
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                        <a href="#!" class="notifi-wishlist">
                                                            <i data-feather="heart"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
    
                                        <div class="product-footer">
                                            <div class="product-detail">
                                                <span class="span-name">{{ $it->category?->name_translated }}</span>
                                                <a href="{{ route('product.detail', $it->id) }}">
                                                    <h5 class="name">{{ $it->name }}</h5>
                                                </a>
                                                <div class="product-rating mt-2">
                                                    @php
                                                        $rating = $it->reviews->count()
                                                            ? $it->reviews->sum('rating') / $it->reviews->count()
                                                            : 0;
                                                    @endphp
    
    
                                                    <ul class="rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <li>
                                                                <i data-feather="star"
                                                                    class="{{ $i <= $rating ? 'fill' : '' }}"></i>
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                    <span>({{ $rating }})</span>
                                                </div>
    
                                                <h6 class="theme-color mt-2">
                                                    {{ $it->stock_quantity > 0 ? __('product.in_stock') : __('product.out_stock') }}
                                                </h6>
    
                                                <h5 class="price"><span class="theme-color">{{ $it->has_sale ? number_format($it->sale_price, 0, '.', ',') : number_format($it->price, 0, '.', ',') }}
                                                    đ</span> <del>{{ $it->has_sale ? number_format($it->price, 0, '.', ',') . ' đ' : '' }}</del>
                                                </h5>
                                                <div class="add-to-cart-box bg-white">
                                                    <button class="btn btn-add-cart addcart-button" type="submit">{{__('product.add_to_cart')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @empty
                            <p class="text-center">{{__('product.no_products_available')}}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     const stars = document.querySelectorAll("#reviewRating i");
        //     const ratingInput = document.getElementById("rating-input");

        //     stars.forEach((element) => {
        //         element.addEventListener("click", () => {
        //             const currentRating = element.dataset.rating;
        //             ratingInput.value = currentRating;
        //             stars.forEach(star => {
        //                 if (parseInt(star.getAttribute("data-rating")) <= currentRating) {
        //                     star.classList.add("active");
        //                 } else {
        //                     star.classList.remove("active");
        //                 }
        //             });
        //         })
        //     })
        // });
        $('.qty-right-plus').click(function() {
            if ($(this).prev().val() < 9) {
                $(this).prev().val(+$(this).prev().val() + 1);
            }
        });
        $('.qty-left-minus').click(function() {
            if ($(this).next().val() > 1) {
                if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
            }
        });
    </script>
@endsection

