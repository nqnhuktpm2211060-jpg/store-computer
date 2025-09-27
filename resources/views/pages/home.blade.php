@extends('layout')

@section('title', __('home.home'))

@section('content')
    <section class="home-section pt-2">
        <div class="container-fluid-lg">
            <div class="row g-4">
                <div class="col-xl-8 ratio_65">
                    <div class="home-contain h-100">
                        <div class="h-100">
                            <img src="../assets/images/vegetable/banner/1.jpg" class="bg-img blur-up lazyload" alt="">
                        </div>
                        <div class="home-detail p-center-left w-75">
                            <div>
                                <h6>{{ __('home.exclusive_offer') }} <span>{{ __('home.discount') }} 30%</span></h6>
                                <h1 class="text-uppercase">{{ __('home.stay_home') }} <span
                                        class="daily">{{ __('home.daily_needs') }}</span>
                                </h1>
                                <p class="w-75 d-none d-sm-block">{{ __('home.vegetables_are_rich') }}
                                </p>
                                <button onclick="location.href = '{{ route('product.index') }}';"
                                    class="btn btn-animation mt-xxl-4 mt-2 home-button mend-auto">{{ __('home.shop_now') }}
                                    <i class="fa-solid fa-right-long icon"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 ratio_65">
                    <div class="row g-4">
                        <div class="col-xl-12 col-md-6">
                            <div class="home-contain">
                                <img src="../assets/images/vegetable/banner/2.jpg" class="bg-img blur-up lazyload"
                                    alt="">
                                <div class="home-detail p-center-left home-p-sm w-75">
                                    <div>
                                        <h2 class="mt-0 text-danger"><span
                                                class="discount text-title">{{ __('home.discount') }}</span> 45%
                                        </h2>
                                        <h3 class="theme-color">{{ __('home.seeds_collection') }}</h3>
                                        <p class="w-75">{{ __('home.we_provide_organic') }}
                                        </p>
                                        <a href="{{ route('product.index') }}"
                                            class="shop-button">{{ __('home.shop_now') }} <i
                                                class="fa-solid fa-right-long"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-6">
                            <div class="home-contain">
                                <img src="../assets/images/vegetable/banner/3.jpg" class="bg-img blur-up lazyload"
                                    alt="">
                                <div class="home-detail p-center-left home-p-sm w-75">
                                    <div>
                                        <h3 class="mt-0 theme-color fw-bold">{{ __('home.healthy_food') }}</h3>
                                        <h4 class="text-danger">{{ __('home.organic_market') }}</h4>
                                        <p class="organic">{{ __('home.start_your_daily') }}</p>
                                        <a href="{{ route('product.index') }}"
                                            class="shop-button">{{ __('home.shop_now') }} <i
                                                class="fa-solid fa-right-long"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="banner-section ratio_60 wow fadeInUp">
        <div class="container-fluid-lg">
            <div class="banner-slider">
                <div>
                    <div class="banner-contain hover-effect">
                        <img src="../assets/images/vegetable/banner/4.jpg" class="bg-img blur-up lazyload" alt="">
                        <div class="banner-details">
                            <div class="banner-box">
                                <h6 class="text-danger">{{ __('home.discount') }} 5% </h6>
                                <h5>{{ __('home.exciting_offers') }}</h5>
                                <h6 class="text-content">{{ __('home.daily_essentials') }}</h6>
                            </div>
                            <a href="{{ route('product.index') }}"
                                class="banner-button text-white">{{ __('home.shop_now') }} <i
                                    class="fa-solid fa-right-long ms-2"></i></a>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="banner-contain hover-effect">
                        <img src="../assets/images/vegetable/banner/5.jpg" class="bg-img blur-up lazyload" alt="">
                        <div class="banner-details">
                            <div class="banner-box">
                                <h6 class="text-danger">{{ __('home.discount') }} 5% </h6>
                                <h5>{{ __('home.buy_more_save') }}</h5>
                                <h6 class="text-content">{{ __('home.fresh_vegetables') }}</h6>
                            </div>
                            <a href="{{ route('product.index') }}"
                                class="banner-button text-white">{{ __('home.shop_now') }} <i
                                    class="fa-solid fa-right-long ms-2"></i></a>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="banner-contain hover-effect">
                        <img src="../assets/images/vegetable/banner/6.jpg" class="bg-img blur-up lazyload" alt="">
                        <div class="banner-details">
                            <div class="banner-box">
                                <h6 class="text-danger">{{ __('home.discount') }} 5% </h6>
                                <h5>{{ __('home.processed_organic') }}</h5>
                                <h6 class="text-content">{{ __('home.home_delivery') }}</h6>
                            </div>
                            <a href="{{ route('product.index') }}"
                                class="banner-button text-white">{{ __('home.shop_now') }} <i
                                    class="fa-solid fa-right-long ms-2"></i></a>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="banner-contain hover-effect">
                        <img src="../assets/images/vegetable/banner/7.jpg" class="bg-img blur-up lazyload" alt="">
                        <div class="banner-details">
                            <div class="banner-box">
                                <h6 class="text-danger">{{ __('home.discount') }} 5%</h6>
                                <h5>{{ __('home.buy_more_save') }}</h5>
                                <h6 class="text-content">{{ __('home.nuts_and_snacks') }}</h6>
                            </div>
                            <a href="{{ route('product.index') }}"
                                class="banner-button text-white">{{ __('home.shop_now') }} <i
                                    class="fa-solid fa-right-long ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-3 col-xl-4 d-none d-xl-block">
                    <div class="p-sticky">
                        <div class="category-menu">
                            <h3>{{ __('home.categories') }}</h3>
                            <ul>
                                @foreach ($categories as $category)
                                    <li class="{{ $loop->last ? 'pb-30' : '' }}">
                                        <div class="category-list">
                                            <img src="{{ $category->icon }}" class="blur-up lazyload" alt="">
                                            <h5>
                                                <a
                                                    href="{{ route('product.index', ['category' => $category->name]) }}">{{ $category->name_translated }}</a>
                                            </h5>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <ul class="value-list">
                                <li>
                                    <div class="category-list">
                                        <h5 class="ms-0 text-title">
                                            <a href="{{ route('product.index') }}">{{ __('home.top_50_offers') }}</a>
                                        </h5>
                                    </div>
                                </li>
                                <li class="mb-0">
                                    <div class="category-list">
                                        <h5 class="ms-0 text-title">
                                            <a href="{{ route('product.index') }}">{{ __('home.new_arrivals') }}</a>
                                        </h5>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="ratio_156 section-t-space">
                            <div class="home-contain hover-effect">
                                <img src="../assets/images/vegetable/banner/8.jpg" class="bg-img blur-up lazyload"
                                    alt="">
                                <div class="home-detail p-top-left home-p-medium">
                                    <div>
                                        <h6 class="text-yellow home-banner">{{ __('home.our_products') }}</h6>
                                        <h3 class="text-uppercase fw-normal">{{ __('home.fresh_seafood') }} <span
                                                class="theme-color fw-bold">
                                                {{ __('home.every_hour') }}</span></h3>
                                        <h3 class="fw-light">{{ __('home.every_day') }}</h3>
                                        <button onclick="location.href = '{{ route('product.index') }}';"
                                            class="btn btn-animation btn-md mend-auto">{{ __('home.shop_now') }} <i
                                                class="fa-solid fa-arrow-right icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ratio_medium section-t-space">
                            <div class="home-contain hover-effect">
                                <img src="../assets/images/vegetable/banner/11.jpg" class="img-fluid blur-up lazyload"
                                    alt="">
                                <div class="home-detail p-top-left home-p-medium">
                                    <div>
                                        <h4 class="text-yellow text-exo">{{ __('home.vegetables') }}</h4>
                                        <h2 class="text-uppercase fw-normal mb-0 text-russo theme-color">
                                            {{ __('home.fresh') }}</h2>
                                        <h2 class="text-uppercase fw-normal text-title">{{ __('home.organic') }}</h2>
                                        <p class="mb-3">{{ __('home.super_discount') }}</p>
                                        <button onclick="location.href = '{{ route('product.index') }}';"
                                            class="btn btn-animation btn-md mend-auto">{{ __('home.shop_now') }} <i
                                                class="fa-solid fa-arrow-right icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section-t-space">
                            <div class="category-menu">
                                <h3>{{ __('home.trending_products') }}</h3>

                                <ul class="product-list border-0 p-0 d-block">
                                    @forelse($trendingProduct as $product)
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
                                                        <span>
                                                            {{ $product->stock_quantity > 0 ? __('home.in_stock') : __('home.out_of_stock') }}
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
                                        <p class="text-center">{{ __('home.no_products_available') }}</p>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-9 col-xl-8">
                    <div class="title title-flex">
                        <div>
                            <h2>{{ __('home.sale_products') }}</h2>
                            <span class="title-leaf">
                                <svg class="icon-width">
                                    <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                    </use>
                                </svg>
                            </span>
                            <p>{{ __('home.dont_miss_out') }}</p>
                        </div>
                        <div class="timing-box">
                            <div class="timing">
                                <i data-feather="clock"></i>
                                <h6 class="name">{{ __('home.expires_in') }} :</h6>
                                <div class="time" id="clockdiv-1" data-hours="12" data-minutes="2" data-seconds="3">
                                    <ul>
                                        <li>
                                            <div class="counter">
                                                <div class="days">
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter">
                                                <div class="hours">
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter">
                                                <div class="minutes">
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter">
                                                <div class="seconds">
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section-b-space">
                        <div class="product-border border-row overflow-hidden">
                            <div class="product-box-slider no-arrow">
                                @forelse($saleProducts as $it)
                                    <form class="form-add-to-cart" method="post">
                                        <input type="text" name="product_id" hidden value="{{ $it->id }}">
                                        <div>
                                            <div class="row m-0">
                                                <div class="col-12 px-0">
                                                    <div class="product-box">
                                                        <div class="product-image">
                                                            <a href="{{ route('product.detail', $it->id) }}">
                                                                <img src="{{ $it->main_image }}"
                                                                    class="img-fluid blur-up lazyload" alt="">
                                                            </a>
                                                            <ul class="product-option">
                                                                <li data-bs-toggle="tooltip" class="view"
                                                                    data-id="{{ $it->id }}" data-bs-placement="top"
                                                                    title="View">
                                                                    <a href="javascript:void(0)">
                                                                        <i data-feather="eye"></i>
                                                                    </a>
                                                                </li>

                                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Compare">
                                                                    <a href="#">
                                                                        <i data-feather="refresh-cw"></i>
                                                                    </a>
                                                                </li>

                                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Wishlist">
                                                                    <a href="#" class="notifi-wishlist">
                                                                        <i data-feather="heart"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="product-detail">
                                                            <a href="{{ route('product.detail', $it->id) }}">
                                                                <h6 class="name h-100">{{ $it->name }}</h6>
                                                            </a>

                                                            <h5 class="sold text-content">
                                                                <span
                                                                    class="theme-color price">{{ $it->has_sale ? number_format($it->sale_price, 0, '.', ',') : number_format($it->price, 0, '.', ',') }}
                                                                    đ</span>
                                                                <del>{{ $it->has_sale ? number_format($it->price, 0, '.', ',') . ' đ' : '' }}</del>
                                                            </h5>

                                                            <div class="product-rating mt-sm-2 mt-1">
                                                                @php
                                                                    $rating = $it->reviews->count()
                                                                        ? $it->reviews->sum('rating') /
                                                                            $it->reviews->count()
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

                                                                <h6 class="theme-color">
                                                                    {{ $it->stock_quantity > 0 ? __('home.in_stock') : __('home.out_of_stock') }}
                                                                </h6>
                                                            </div>

                                                            <div class="add-to-cart-box">

                                                                <div
                                                                    class="{{ $it->stock_quantity < 0 ? 'out-stock' : '' }}">
                                                                </div>
                                                                <button class="btn btn-add-cart addcart-button"
                                                                    type="submit">{{ __('product.add_to_cart') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @empty
                                    <p class="text-center">{{ __('home.no_products_available') }}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="title d-block">
                        <h2>{{ __('home.featured_categories') }}</h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                            </svg>
                        </span>
                        <p>{{ __('home.top_categories') }}</p>
                    </div>

                    <div class="category-slider-2 product-wrapper no-arrow">
                        @forelse($categories as $category)
                            <div>
                                <a href="{{ route('product.index', ['category' => $category->name]) }}"
                                    class="category-box category-dark">
                                    <div>
                                        <img src="{{ $category->icon }}" class="blur-up lazyload" alt="">
                                        <h5>{{ $category->name_translated }}</h5>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p class="text-center">{{ __('home.no_categories_available') }}</p>
                        @endforelse
                    </div>

                    <div class="section-t-space section-b-space">
                        <div class="row g-md-4 g-3">
                            <div class="col-md-6">
                                <div class="banner-contain hover-effect">
                                    <img src="../assets/images/vegetable/banner/9.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                    <div class="banner-details p-center-left p-4">
                                        <div>
                                            <h3 class="text-exo">{{ __('home.discount') }} 50%</h3>
                                            <h4 class="text-russo fw-normal theme-color mb-2">{{ __('home.fresh_meat') }}
                                            </h4>
                                            <button onclick="location.href = '{{ route('product.index') }}';"
                                                class="btn btn-animation btn-sm mend-auto">{{ __('home.shop_now') }} <i
                                                    class="fa-solid fa-arrow-right icon"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="banner-contain hover-effect">
                                    <img src="../assets/images/vegetable/banner/10.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                    <div class="banner-details p-center-left p-4">
                                        <div>
                                            <h3 class="text-exo">{{ __('home.discount') }} 50%</h3>
                                            <h4 class="text-russo fw-normal theme-color mb-2">
                                                {{ __('home.tasty_mushrooms') }}</h4>
                                            <button onclick="location.href = '{{ route('product.index') }}';"
                                                class="btn btn-animation btn-sm mend-auto">{{ __('home.shop_now') }} <i
                                                    class="fa-solid fa-arrow-right icon"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="title d-block">
                        <h2>{{ __('home.dry_and_packed') }}</h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                            </svg>
                        </span>
                        <p>{{ __('home.dry_and_packed_desc') }}</p>
                    </div>

                    <div class="product-border overflow-hidden wow fadeInUp">
                        <div class="product-box-slider no-arrow">
                            @forelse($productCupboard as $it)
                                <form class="form-add-to-cart" method="post">
                                    <input type="text" name="product_id" hidden value="{{ $it->id }}">
                                    <div>
                                        <div class="row m-0">
                                            <div class="col-12 px-0">
                                                <div class="product-box">
                                                    <div class="product-image">
                                                        <a href="{{ route('product.detail', $it->id) }}">
                                                            <img src="{{ $it->main_image }}"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>
                                                        <ul class="product-option">
                                                            <li data-bs-toggle="tooltip" class="view"
                                                                data-id="{{ $it->id }}" data-bs-placement="top"
                                                                title="View">
                                                                <a href="javascript:void(0)">
                                                                    <i data-feather="eye"></i>
                                                                </a>
                                                            </li>

                                                            <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Compare">
                                                                <a href="#">
                                                                    <i data-feather="refresh-cw"></i>
                                                                </a>
                                                            </li>

                                                            <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Wishlist">
                                                                <a href="#" class="notifi-wishlist">
                                                                    <i data-feather="heart"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-detail">
                                                        <a href="{{ route('product.detail', $it->id) }}">
                                                            <h6 class="name h-100">{{ $it->name }}</h6>
                                                        </a>

                                                        <h5 class="sold text-content">
                                                            <span
                                                                class="theme-color price">{{ $it->has_sale ? number_format($it->sale_price, 0, '.', ',') : number_format($it->price, 0, '.', ',') }}
                                                                đ</span>
                                                            <del>{{ $it->has_sale ? number_format($it->price, 0, '.', ',') . ' đ' : '' }}</del>
                                                        </h5>

                                                        <div class="product-rating mt-sm-2 mt-1">
                                                            @php
                                                                $rating = $it->reviews->count()
                                                                    ? $it->reviews->sum('rating') /
                                                                        $it->reviews->count()
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

                                                            <h6 class="theme-color">
                                                                {{ $it->stock_quantity > 0 ? __('product.in_stock') : __('product.out_of_stock') }}
                                                            </h6>
                                                        </div>

                                                        <div class="add-to-cart-box">

                                                            <div
                                                                class="{{ $it->stock_quantity < 0 ? 'out-stock' : '' }}">
                                                            </div>
                                                            <button class="btn btn-add-cart addcart-button"
                                                                type="submit">{{ __('product.add_to_cart') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @empty
                                <p class="text-center">{{ __('product.no_products_available') }}</p>
                            @endforelse
                        </div>
                    </div>


                    <div class="section-t-space section-b-space">
                        <div class="row g-md-4 g-3">
                            <div class="col-xxl-8 col-xl-12 col-md-7">
                                <div class="banner-contain hover-effect">
                                    <img src="../assets/images/vegetable/banner/12.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                    <div class="banner-details p-center-left p-4">
                                        <div>
                                            <h2 class="text-kaushan fw-normal theme-color">{{ __('home.ready_to_shop') }}
                                                <h3 class="mt-2 mb-3">{{ __('home.for_today') }}</h3>
                                                <p class="text-content banner-text">{{ __('home.morning_energy') }}</p>
                                                <button onclick="location.href = '{{ route('product.index') }}';"
                                                    class="btn btn-animation btn-sm mend-auto">{{ __('home.buy_now') }} <i
                                                        class="fa-solid fa-arrow-right icon"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-xl-12 col-md-5">
                                <a href="{{ route('product.index') }}" class="banner-contain hover-effect h-100">
                                    <img src="../assets/images/vegetable/banner/13.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                    <div class="banner-details p-center-left p-4 h-100">
                                        <div>
                                            <h2 class="text-kaushan fw-normal text-danger">{{ __('home.discount_20') }}</h2>
                                            <h3 class="mt-2 mb-2 theme-color">{{ __('home.all') }}</h3>
                                            <h3 class="fw-normal product-name text-title">{{ __('home.beverage') }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="title d-block">
                        <div>
                            <h2>{{ __('home.best_selling') }}</h2>
                            <span class="title-leaf">
                                <svg class="icon-width">
                                    <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                    </use>
                                </svg>
                            </span>
                            <p>{{ __('home.dont_miss_best_sellers') }}</p>
                        </div>
                    </div>

                    <div class="best-selling-slider product-wrapper wow fadeInUp">

                        @forelse ($bestSellingProducts->chunk(4) as $chunk)

                            <div>
                                <ul class="product-list">
                                    @foreach ($chunk as $product)
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
                                                        <span>
                                                            {{ $product->stock_quantity > 0 ? __('home.in_stock') : __('home.out_of_stock') }}
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
                                    @endforeach
                                </ul>
                            </div>
                        @empty
                            <p class="text-center">{{ __('home.no_products_available') }}</p>
                        @endforelse

                    </div>
                    <div class="title section-t-space">
                        <h2>{{ __('home.featured_news') }}</h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                            </svg>
                        </span>
                    </div>
                    <div class="slider-3-blog ratio_65 no-arrow product-wrapper">

                        @forelse ($news as $it)
                            <div>
                                <div class="blog-box">
                                    <div class="blog-box-image">
                                        <a href="{{ route('blog.detail', $it->slug_translated) }}" class="blog-image">
                                            <img src="{{ $it->image }}" class="bg-img blur-up lazyload"
                                                alt="">
                                        </a>
                                    </div>

                                    <a href="{{ route('blog.detail', $it->slug_translated) }}" class="blog-detail">
                                        <h6>{{ $it->create_at }}</h6>
                                        <h5>{{ $it->title_translated }}</h5>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">{{ __('home.no_news_available') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="newsletter-section section-b-space">
        <div class="container-fluid-lg">
            <div class="newsletter-box newsletter-box-2">
                <div class="newsletter-contain py-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xxl-4 col-lg-5 col-md-7 col-sm-9 offset-xxl-2 offset-md-1">
                                <div class="newsletter-detail">
                                    <h2>{{ __('home.join_our_newsletter') }}</h2>
                                    <h5>{{ __('home.discount_for_first_order') }}</h5>
                                    <div class="input-box">
                                        <input type="email" class="form-control" id="exampleFormControlInput1"
                                            placeholder="{{ __('home.enter_your_email') }}">
                                        <i class="fa-solid fa-envelope arrow"></i>
                                        <button class="sub-btn  btn-animation">
                                            <span class="d-sm-block d-none">{{ __('home.subscribe') }}</span>
                                            <i class="fa-solid fa-arrow-right icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.category-level-1').forEach((element) => {
            element.addEventListener('click', () => {
                const isActive = element.classList.contains('active');

                document.querySelectorAll('.category-level-1.active, .category-level-2.active').forEach((
                    el) => {
                    el.classList.remove('active');
                    const icon = el.querySelector('i');
                    if (icon) {
                        icon.classList.remove('fa-angle-up');
                        icon.classList.add('fa-angle-down');
                    }
                });

                if (!isActive) {
                    element.classList.add('active');
                    const icon = element.querySelector('i');

                    if (icon) {
                        icon.classList.remove('fa-angle-down');
                        icon.classList.add('fa-angle-up');
                    }
                    const id = element.getAttribute('id').replace('category-id-', '');

                    const subCategory = document.querySelector(`#category-parent-${id}`);
                    if (subCategory) {
                        subCategory.classList.add('active');
                    }
                }
            })
        })
    </script>
@endsection

