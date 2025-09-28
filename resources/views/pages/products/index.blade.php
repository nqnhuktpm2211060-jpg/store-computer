@extends('layout')
@section('title', __('product.title_index'))

@section('content')
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>{{ __('product.title_index') }}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                @php
                                    $activeL1 = request('category_l1_id');
                                    $activeCat = request('category_id');
                                    $activeL1Name = null;
                                    $activeCatName = null;
                                    if ($activeL1) {
                                        $c = $categories->firstWhere('id', (int) $activeL1);
                                        $activeL1Name = $c?->name_translated;
                                    }
                                    if ($activeCat) {
                                        $c2 = $categories->firstWhere('id', (int) $activeCat);
                                        $activeCatName = $c2?->name_translated;
                                    }
                                @endphp
                                @if ($activeL1 || $activeCat)
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('product.index') }}">{{ __('product.shop_at_home') }}</a>
                                    </li>
                                    @if ($activeL1Name)
                                        <li class="breadcrumb-item {{ $activeCatName ? '' : 'active' }}">
                                            @if ($activeCatName)
                                                <a href="{{ route('product.index', ['category_l1_id' => $activeL1]) }}">{{ $activeL1Name }}</a>
                                            @else
                                                {{ $activeL1Name }}
                                            @endif
                                        </li>
                                    @endif
                                    @if ($activeCatName)
                                        <li class="breadcrumb-item active">{{ $activeCatName }}</li>
                                    @endif
                                @else
                                    <li class="breadcrumb-item active">{{ __('product.shop_at_home') }}</li>
                                @endif
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="wow fadeInUp">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="slider-7_1 no-space shop-box no-arrow">

                        @foreach ($categories->where('level', 1) as $category)
                            <div>
                                <div class="shop-category-box">
                                    @php
                                        // Build link using ID param and removing lower-level filter
                                        $query = collect(request()->query())->except(['category','category_id'])->toArray();
                                        $url = route('product.index', $query + ['category_l1_id' => $category->id]);
                                    @endphp
                                    <a href="{{ $url }}">
                                        <div class="shop-category-image">
                                            <img src="{{ $category->icon_url }}" class="blur-up lazyload" alt="">
                                        </div>
                                        <div class="category-box-name">
                                            <h6>{{ $category->name_translated }}</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-custom-3 wow fadeInUp">
                    <div class="left-box">
                        <div class="shop-left-sidebar">
                            <div class="back-button">
                                <h3><i class="fa-solid fa-arrow-left"></i> {{ __('product.back') }}</h3>
                            </div>

                            <div class="accordion custom-accordion" id="accordionExample">
                                <form action="{{route('product.index')}}" method="GET">
                                    <div class="form-floating theme-form-floating-2 search-box">
                                        <input type="search" class="form-control" name="search"
                                            placeholder="{{ __('product.search_product') }}"
                                            value="{{request('search')}}">
                                        <label for="search">{{ __('product.search') }}</label>
                                    </div>
                                    @foreach (request()->except('search', 'page') as $key => $value)
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endforeach
                                </form>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne">
                                            <span>{{ __('product.categories') }}</span>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show">
                                        <div class="accordion-body">


                                            @php
                                                $level2 = $categories->where('level', 2);
                                                if ($activeL1) {
                                                    $level2 = $level2->filter(function($c) use ($activeL1){
                                                        return optional($c->categoryParent)->id == $activeL1;
                                                    });
                                                }
                                            @endphp
                                            <ul class="category-list custom-padding custom-height">
                                                @foreach ($level2 as $category)
                                                    @php
                                                        $isActive = (string)request('category_id') === (string)$category->id;
                                                        $url = route('product.index', collect(request()->query())->toArray() + ['category_id' => $category->id]);
                                                    @endphp
                                                    <li>
                                                        <a href="{{ $url }}" class="d-flex justify-content-between align-items-center {{ $isActive ? 'fw-bold' : '' }}">
                                                            <span class="name">{{ $category->name_translated }}</span>
                                                            <span class="number">({{ $category->products->count() }})</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>


                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                            <span>{{ __('product.price') }}</span>
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <div class="range-slider">
                                                <input type="text" class="js-range-slider" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSix">
                                            <span>{{ __('product.rating') }}</span>
                                        </button>
                                    </h2>
                                    <div id="collapseSix" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding">
                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox">
                                                        <div class="form-check-label">
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
                                                                    <i data-feather="star" class="fill"></i>
                                                                </li>
                                                            </ul>
                                                            <span class="text-content">(5 {{ __('product.star') }})</span>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox">
                                                        <div class="form-check-label">
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
                                                            <span class="text-content">(4 {{ __('product.star') }})</span>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox">
                                                        <div class="form-check-label">
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
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                            </ul>
                                                            <span class="text-content">(3 {{ __('product.star') }})</span>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox">
                                                        <div class="form-check-label">
                                                            <ul class="rating">
                                                                <li>
                                                                    <i data-feather="star" class="fill"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star" class="fill"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                            </ul>
                                                            <span class="text-content">(2 {{ __('product.star') }})</span>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox">
                                                        <div class="form-check-label">
                                                            <ul class="rating">
                                                                <li>
                                                                    <i data-feather="star" class="fill"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                            </ul>
                                                            <span class="text-content">(1 {{ __('product.star') }})</span>
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

                <div class="col-custom- wow fadeInUp">
                    <div class="show-button">
                        <div class="filter-button-group mt-0">
                            <div class="filter-button d-inline-block d-lg-none">
                                <a><i class="fa-solid fa-filter"></i> Filter Menu</a>
                            </div>
                        </div>

                        <div class="top-filter-menu">
                            <div class="grid-option d-none d-md-block">
                                <ul>
                                    <li class="three-grid">
                                        <a href="javascript:void(0)">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/grid-3.svg"
                                                class="blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                    <li class="grid-btn d-xxl-inline-block d-none active">
                                        <a href="javascript:void(0)">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/grid-4.svg"
                                                class="blur-up lazyload d-lg-inline-block d-none" alt="">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/grid.svg"
                                                class="blur-up lazyload img-fluid d-lg-none d-inline-block"
                                                alt="">
                                        </a>
                                    </li>
                                    <li class="list-btn">
                                        <a href="javascript:void(0)">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/list.svg"
                                                class="blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div
                        class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">

                        @php
                            $timeIn = 0;
                        @endphp
                        @forelse ($products as $it)
                            <form class="form-add-to-cart" method="post">
                                <input type="text" name="product_id" hidden value="{{ $it->id }}">
                                <div>
                                    <div class="product-box-3 h-100 wow fadeInUp {{ $timeIn . 's' }}">
                                        <div class="product-header">
                                            <div class="product-image">
                                                <a href="{{ route('product.detail', $it->id) }}">
                                                    <img src="{{ $it->main_image }}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>

                                                <ul class="product-option">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        class="view" data-id="{{ $it->id }}" title="View">
                                                        <a href="javascript:void(0)">
                                                            <i data-feather="eye"></i>
                                                        </a>
                                                    </li>

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Compare">
                                                        <a href="#!">
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
                                        </div>
                                        <div class="product-footer">
                                            <div class="product-detail">
                                                <span class="span-name">{{ $it->category?->name_translated }}</span>
                                                <a href="{{ route('product.detail', $it->id) }}">
                                                    <h6 class="name h-100">{{ $it->name }}</h6>
                                                </a>
                                                {{-- <p class="text-content mt-1 mb-2 product-content">
                                                    {{ $it->short_description_translated }}
                                                </p> --}}
                                                <div class="product-rating mt-sm-2 mt-1">
                                                    @php
                                                        $rating = $it->reviews->count()
                                                            ? $it->reviews->sum('rating') /
                                                                $it->reviews->count()
                                                            : 0;
                                                    @endphp
                                                    <ul class="rating me-1">

                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <li>
                                                                <i data-feather="star"
                                                                    class="{{ $i <= $rating ? 'fill' : '' }}"></i>
                                                            </li>
                                                        @endfor
                                                    </ul>

                                                    <h6 class="theme-color">
                                                        {{ $it->stock_quantity > 0 ? __('product.in_stock') : __('product.out_stock') }}
                                                    </h6>
                                                </div>
                                                <h5 class="price"><span
                                                        class="theme-color">{{ $it->has_sale ? number_format($it->sale_price, 0, '.', ',') : number_format($it->price, 0, '.', ',') }}
                                                        đ</span>
                                                    <del>{{ $it->has_sale ? number_format($it->price, 0, '.', ',') . ' đ' : '' }}</del>
                                                </h5>
                                            </div>
                                            <div class="add-to-cart-box bg-white">
                                                <div class="{{ $it->stock_quantity < 0 ? 'out-stock' : '' }}">
                                                    <button class="btn btn-add-cart addcart-button"
                                                        type="submit">{{__('product.add_to_cart')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @php
                                $timeIn += 0.05;
                            @endphp
                        @empty
                            <p class="w-100 text-center"> {{__('product.no_products_available')}} </p>
                        @endforelse


                    </div>

                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- Shop Section End -->
@endsection

@section('scripts')
    {{-- <script>
        const min = {{ $minPrice }};
        const max = {{ $maxPrice }};
        $('#price-range').slider({
            range: true,
            min: 10000,
            max: 10000000,
            values: [min, max],
            slide: function(event, ui) {
                $('#price-amount').val(ui.values[0].toLocaleString('vi-VN') + 'đ - ' + ui.values[1]
                    .toLocaleString('vi-VN') + 'đ');
            }
        });

        $('#price-amount').val($('#price-range').slider('values', 0).toLocaleString('vi-VN') + 'đ - ' +
            $('#price-range').slider('values', 1).toLocaleString('vi-VN') + 'đ');

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
    </script> --}}
@endsection

