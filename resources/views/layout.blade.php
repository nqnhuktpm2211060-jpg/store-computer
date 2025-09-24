<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/fastkart/front-end/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 31 Mar 2025 01:30:10 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fastkart">
    <meta name="keywords" content="Fastkart">
    <meta name="author" content="Fastkart">
    <link rel="icon" href="../assets/logo.jpg" type="image/x-icon">

    <title>@yield('title')</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap">

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">

    <!-- wow css -->
    <link rel="stylesheet" href="../assets/css/animate.min.css">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bulk-style.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/animate.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="../assets/css/style.css">

</head>

<body class="bg-effect">
    <div id="notification"></div>
    @if (session()->has('success'))
        <div class="alert alert-success fade show" role="alert">
            <i class="fa fa-check-circle fs-2 me-3" aria-hidden="true"></i>
            <div>
                <p class="title">{{ __('notification.success') }}</p>
                <p class="notification">{{ session('success') }}</p>
            </div>
            <button type="button" class="btn-close ms-5 fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-error fade show" role="alert">
            <i class="fa fa-check-circle fs-2 me-3" aria-hidden="true"></i>
            <div>
                <p class="title">{{ __('notification.failure') }}</p>
                <p class="notification">{{ session('error') }}</p>
            </div>
            <button type="button" class="btn-close ms-5 fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <header class="pb-md-4 pb-0">
        <div class="top-nav top-header sticky-header">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar-top">
                            <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                                <span class="navbar-toggler-icon">
                                    <i class="fa-solid fa-bars"></i>
                                </span>
                            </button>
                            <a href="/" class="web-logo nav-logo">
                                <img src="/assets/logo.jpg" style="width: 80px;"
                                    class="img-fluid blur-up lazyload" alt="">
                            </a>

                            <div class="middle-box">
                                {{-- <div class="location-box">
                                <button class="btn location-button" data-bs-toggle="modal"
                                    data-bs-target="#locationModal">
                                    <span class="location-arrow">
                                        <i data-feather="map-pin"></i>
                                    </span>
                                    <span class="locat-name">{{ __('header.your_location') }}</span>
                                    <i class="fa-solid fa-angle-down"></i>
                                </button>
                            </div> --}}

                                <div class="search-box">
                                    <form action="{{ route('product.index') }}" method="get">
                                        <div class="input-group">
                                            <input type="search" class="form-control" name="search"
                                                placeholder="{{ __('header.search_product') }}">
                                            <button class="btn" type="button" id="button-addon2">
                                                <i data-feather="search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="rightside-box">
                                <form action="" method="get">
                                    <div class="search-full">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i data-feather="search" class="font-light"></i>
                                            </span>
                                            <input type="text" class="form-control search-type"
                                                placeholder="{{ __('header.search_product') }}">
                                            <span class="input-group-text close-search">
                                                <i data-feather="x" class="font-light"></i>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                                <ul class="right-side-menu">
                                    <li class="right-side">
                                        <div class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <div class="search-box">
                                                    <i data-feather="search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="right-side">
                                        <a href="{{ route('contact') }}" class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <i data-feather="phone-call"></i>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="right-nav-list">
                                        <x-language-component />
                                    </li>
                                    <li class="right-side">
                                        <div class="onhover-dropdown header-badge ">
                                            <button type="button" class="btn p-0 position-relative header-wishlist">
                                                <i data-feather="shopping-cart"></i>
                                                <span class="position-absolute top-0 start-100 translate-middle badge"
                                                    id="count-cart">0
                                                    <span class="visually-hidden">unread messages</span>
                                                </span>
                                            </button>

                                            <div class="onhover-div">
                                                <ul class="cart-list" id="cart-list">

                                                </ul>

                                                <div class="price-box">
                                                    <h5>{{ __('header.total') }} :</h5>
                                                    <h4 class="theme-color fw-bold" id="total-cart">0đ</h4>
                                                </div>

                                                <div class="button-group">
                                                    <a href="{{ route('cart.index') }}"
                                                        class="btn btn-sm cart-button">{{ __('header.view_cart') }}</a>
                                                    <a href="{{ route('checkout') }}"
                                                        class="btn btn-sm cart-button theme-bg-color
                                                    text-white">{{ __('header.checkout') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="right-side onhover-dropdown">
                                        <div class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <i data-feather="user"></i>
                                            </div>
                                            {{-- <div class="delivery-detail">
                                                <h6>{{ __('header.hello') }},</h6>
                                                <h5>{{ __('header.my_account') }}</h5>
                                            </div> --}}
                                        </div>
                                        @auth
                                            <div class="onhover-div onhover-div-login">
                                                <ul class="user-box-name">
                                                    <li class="product-box-contain">
                                                        {{ __('header.hello') }} {{ Auth::user()->name }}
                                                    </li>

                                                    <li class="product-box-contain">
                                                        <a href="{{ route('logout') }}">{{ __('header.logout') }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endauth

                                        @guest
                                            <div class="onhover-div onhover-div-login">
                                                <ul class="user-box-name">
                                                    <li class="product-box-contain">
                                                        <i></i>
                                                        <a href="{{ route('login.form') }}">{{ __('header.login') }}</a>
                                                    </li>

                                                    <li class="product-box-contain">
                                                        <a
                                                            href="{{ route('register.form') }}">{{ __('header.register') }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endguest
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="header-nav">
                        <div class="header-nav-left">
                            <button class="dropdown-category">
                                <i data-feather="align-left"></i>
                                <span>{{ __('header.categories') }}</span>
                            </button>

                            <div class="category-dropdown">
                                <div class="category-title">
                                    <h5>{{ __('header.categories') }}</h5>
                                    <button type="button" class="btn p-0 close-button text-content">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>

                                <x-categories />
                            </div>
                        </div>

                        <div class="header-nav-middle">
                            <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                                <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                    <div class="offcanvas-header navbar-shadow">
                                        <h5>{{ __('header.menu') }}</h5>
                                        <button class="btn-close lead" type="button"
                                            data-bs-dismiss="offcanvas"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <ul class="navbar-nav">
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    href="{{ route('product.index') }}">{{ __('header.go_to_market') }}
                                                    {{-- Đi Chợ Tại Nhà --}}
                                                </a>
                                            </li>
                                            <li class="nav-item dropdown new-nav-item">
                                                <label class="new-dropdown">Hot</label>
                                                <a class="nav-link"
                                                    href="{{ route('hotDeal') }}">{{ __('header.hot_deals') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    href="{{ route('promotion') }}">{{ __('header.discount') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    href="{{ route('blogs') }}">{{ __('header.news') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="header-nav-right">
                            <button class="btn deal-button" data-bs-toggle="modal" data-bs-target="#deal-box">
                                <i data-feather="zap"></i>
                                <span>{{ __('header.today_discount') }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-menu d-md-none d-block mobile-cart">
        <ul>
            <li class="active">
                <a href="/">
                    <i class="fa-solid fa-house text-white"></i>
                    <span>{{ __('mobile_menu.home') }}</span>
                </a>
            </li>

            <li class="mobile-category">
                <a href="javascript:void(0)">
                    <i class="fa-solid fa-list text-white"></i>
                    <span>{{ __('mobile_menu.categories') }}</span>
                </a>
            </li>

            <li>
                <a href="{{ route('product.index') }}" class="search-box">
                    <i class="fa-solid fa-store text-white"></i>
                    <span>{{ __('mobile_menu.go_to_market') }}</span>
                </a>
            </li>

            <li>
                <a href="{{ route('cart.index') }}">
                    <i class="fa-solid fa-bag-shopping text-white"></i>
                    <span>{{ __('mobile_menu.cart') }}</span>
                </a>
            </li>
        </ul>
    </div>
    @yield('content')

    <footer class="section-t-space">
        <div class="container-fluid-lg">
            <div class="service-section">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="service-contain">
                            <div class="service-box">
                                <div class="service-image">
                                    <img src="https://themes.pixelstrap.com/fastkart/assets/svg/product.svg"
                                        class="blur-up lazyload" alt="">
                                </div>

                                <div class="service-detail">
                                    <h5>{{ __('footer.fresh_products') }}</h5>
                                </div>
                            </div>

                            <div class="service-box">
                                <div class="service-image">
                                    <img src="https://themes.pixelstrap.com/fastkart/assets/svg/delivery.svg"
                                        class="blur-up lazyload" alt="">
                                </div>

                                <div class="service-detail">
                                    <h5>{{ __('footer.free_delivery') }}</h5>
                                </div>
                            </div>

                            <div class="service-box">
                                <div class="service-image">
                                    <img src="https://themes.pixelstrap.com/fastkart/assets/svg/discount.svg"
                                        class="blur-up lazyload" alt="">
                                </div>

                                <div class="service-detail">
                                    <h5>{{ __('footer.daily_mega_discount') }}</h5>
                                </div>
                            </div>

                            <div class="service-box">
                                <div class="service-image">
                                    <img src="https://themes.pixelstrap.com/fastkart/assets/svg/market.svg"
                                        class="blur-up lazyload" alt="">
                                </div>

                                <div class="service-detail">
                                    <h5>{{ __('footer.best_price') }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-footer section-b-space section-t-space">
                <div class="row g-md-4 g-3">
                    <div class="col-xl-4 col-lg-4 col-sm-6">
                        <div class="footer-logo">
                            <div class="theme-logo">
                                <a href="/">
                                    <img src="/assets/logo.jpg"
                                        class="blur-up lazyload" alt="">
                                </a>
                            </div>

                            <div class="footer-logo-contain">
                                <p>{{ __('footer.company_name') }}</p>

                                <ul class="address">
                                    <li>
                                        <i data-feather="home"></i>
                                        <a href="javascript:void(0)">{{ __('footer.address') }}
                                        </a>
                                    </li>
                                    <li>
                                        <i data-feather="mail"></i>
                                        <a href="javascript:void(0)">{{ __('footer.email') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-title">
                            <h4>{{ __('footer.categories') }}</h4>
                        </div>

                        <div class="footer-contain">
                            <x-categories-footer />
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-sm-4">
                        <div class="footer-title">
                            <h4>{{ __('footer.useful_links') }}</h4>
                        </div>

                        <div class="footer-contain">
                            <ul>
                                <li>
                                    <a href="/" class="text-content">{{ __('footer.home') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('product.index') }}"
                                        class="text-content">{{ __('footer.shop') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('blogs') }}" class="text-content">{{ __('footer.news') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer-title">
                            <h4>{{ __('footer.contact_us') }}</h4>
                        </div>

                        <div class="footer-contact">
                            <ul>
                                <li>
                                    <div class="footer-number">
                                        <i data-feather="phone"></i>
                                        <div class="contact-number">
                                            <h6 class="text-content">{{ __('footer.hotline') }} :</h6>
                                            <h5>(+84) 973.454.140</h5>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="footer-number">
                                        <i data-feather="mail"></i>
                                        <div class="contact-number">
                                            <h6 class="text-content">{{ __('footer.email_address') }}:</h6>
                                            <h5>{{__('footer.email')}}</h5>
                                        </div>
                                    </div>
                                </li>

                                <li class="social-app mb-0">
                                    <h5 class="mb-2 text-content">{{ __('footer.download_app') }} :</h5>
                                    <ul>
                                        <li class="mb-0">
                                            <a href="https://play.google.com/store/apps" target="_blank">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/playstore.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li class="mb-0">
                                            <a href="https://www.apple.com/in/app-store/" target="_blank">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/appstore.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sub-footer section-small-space">
                <div class="reserve">
                    <h6 class="text-content">©2024 <a href="http://idai.vn">Idai.vn</a>
                        {{ __('footer.all_rights_reserved') }}</h6>
                </div>

                <div class="payment">
                    <img src="../assets/images/payment/1.png" class="blur-up lazyload" alt="">
                </div>

                <div class="social-link">
                    <h6 class="text-content">{{ __('footer.keep_in_touch') }}:</h6>
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/" target="_blank">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/" target="_blank">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://in.pinterest.com/" target="_blank">
                                <i class="fa-brands fa-pinterest-p"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <div class="modal fade theme-modal view-modal" id="view" tabindex="-1">

    </div>
    {{-- <div class="modal location-modal fade theme-modal" id="locationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Choose your Delivery Location</h5>
                <p class="mt-1 text-content">Enter your address and we will specify the offer for your area.</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="location-list">
                    <div class="search-input">
                        <input type="search" class="form-control" placeholder="Search Your Area">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>

                    <div class="disabled-box">
                        <h6>Select a Location</h6>
                    </div>

                    <ul class="location-select custom-height">
                        <li>
                            <a href="javascript:void(0)">
                                <h6>Alabama</h6>
                                <span>Min: $130</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <h6>Arizona</h6>
                                <span>Min: $150</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <h6>California</h6>
                                <span>Min: $110</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <h6>Colorado</h6>
                                <span>Min: $140</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <h6>Florida</h6>
                                <span>Min: $160</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <h6>Georgia</h6>
                                <span>Min: $120</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <h6>Kansas</h6>
                                <span>Min: $170</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <h6>Minnesota</h6>
                                <span>Min: $120</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <h6>New York</h6>
                                <span>Min: $110</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <h6>Washington</h6>
                                <span>Min: $130</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <div class="modal fade theme-modal deal-modal" id="deal-box" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title w-100" id="deal_today">{{ __('deal_modal.today_deals') }}</h5>
                        <p class="mt-1 text-content">{{ __('deal_modal.recommended_promotions') }}</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="deal-offer-box">
                        <x-deal-today />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="theme-option">
        <div class="setting-box">
            <button class="btn setting-button">
                <i class="fa-solid fa-gear"></i>
            </button>

            <div class="theme-setting-2">
                <div class="theme-box">
                    <ul>
                        <li>
                            <div class="setting-name">
                                <h4>Color</h4>
                            </div>
                            <div class="theme-setting-button color-picker">
                                <form class="form-control">
                                    <label for="colorPick" class="form-label mb-0">Theme Color</label>
                                    <input type="color" class="form-control form-control-color" id="colorPick"
                                        value="#0da487" title="Choose your color">
                                </form>
                            </div>
                        </li>

                        <li>
                            <div class="setting-name">
                                <h4>Dark</h4>
                            </div>
                            <div class="theme-setting-button">
                                <button class="btn btn-2 outline" id="darkButton">Dark</button>
                                <button class="btn btn-2 unline" id="lightButton">Light</button>
                            </div>
                        </li>

                        <li>
                            <div class="setting-name">
                                <h4>RTL</h4>
                            </div>
                            <div class="theme-setting-button rtl">
                                <button class="btn btn-2 rtl-unline">LTR</button>
                                <button class="btn btn-2 rtl-outline">RTL</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="back-to-top">
            <a id="back-to-top" href="#">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <!-- Tap to top and theme setting button end -->

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    <!-- latest jquery-->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <!-- jquery ui-->
    <script src="../assets/js/jquery-ui.min.js"></script>

    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/bootstrap/bootstrap-notify.min.js"></script>
    <script src="../assets/js/bootstrap/popper.min.js"></script>

    <!-- feather icon js-->
    <script src="../assets/js/feather/feather.min.js"></script>
    <script src="../assets/js/feather/feather-icon.js"></script>

    <!-- Lazyload Js -->
    <script src="../assets/js/lazysizes.min.js"></script>

    <!-- Slick js-->
    <script src="../assets/js/slick/slick.js"></script>
    <script src="../assets/js/slick/slick-animation.min.js"></script>
    <script src="../assets/js/slick/custom_slick.js"></script>

    <!-- Auto Height Js -->
    <script src="../assets/js/auto-height.js"></script>

    <!-- Timer Js -->
    <script src="../assets/js/timer1.js"></script>

    <!-- Fly Cart Js -->
    <script src="../assets/js/fly-cart.js"></script>

    <!-- WOW js -=-->
    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/custom-wow.js"></script>

    <!-- script js -->
    <script src="../assets/js/script.js"></script>

    <!-- theme setting js -->
    <script src="../assets/js/theme-setting.js"></script>

    <script>
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.classList.remove('show');
                alert.classList.add('d-none');
            });
        }, 2500);

        const baseUrl = '{{ ENV('APP_URL') }}';
        async function getMyCart() {
            try {
                const response = await fetch(`{{ route('getCarts') }}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                });

                if (!response.ok) {
                    throw new Exception('Error fetching');
                }
                const data = await response.json();
                const carts = data.carts;
                document.getElementById('count-cart').innerText = carts.length;
                // document.getElementById('count_cart_mobile').innerText = carts.length;
                let listCart = '';
                let total = 0;

                carts.forEach(function(cart, index) {
                    total += cart.sale_price > 0 ? cart.sale_price * cart.quantity : cart.price * cart.quantity;

                    listCart += `<li class="product-box-contain">
                                                        <div class="drop-cart">
                                                            <a href="{{ route('product.detail', ':id') }}" class="drop-image">
                                                                <img src="${cart.image}"
                                                                    class="blur-up lazyload" alt="">
                                                            </a>

                                                            <div class="drop-contain">
                                                                <a href="{{ route('product.detail', ':id') }}">
                                                                    <h5>${cart.product_name}
                                                                    </h5>
                                                                </a>
                                                                <h6><span>${cart.quantity} x</span> ${new Intl.NumberFormat().format(cart.sale_price > 0 ? cart.sale_price : cart.price)} đ</h6>
                                                                <button class="close-button close_button delete-cart" data-index="${index}">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </li>`.replace(':id', cart.product_id).replace(':id', cart
                        .product_id);
                });

                if (carts.length < 1) {
                    listCart =
                        `<li class="product-box-contain w-100"> <p class="text-center">{{ __('notification.product_not_in_cart')}}</p> </li>`
                }

                document.getElementById('cart-list').innerHTML = listCart;
                document.getElementById('total-cart').innerText = carts.length > 0 ? new Intl.NumberFormat().format(
                    total) + ' đ' : '0đ';
                const cartlistindexId = document.getElementById('list-carts-index');
                if (cartlistindexId) {
                    let cartlistindex = '';
                    carts.forEach(function(cart, index) {
                        cartlistindex += `
                            <tr class="product-box-contain">
                                        <td class="product-detail">
                                            <div class="product border-0">
                                                <a href="product-left-thumbnail.html" class="product-image">
                                                    <img src="${cart.image}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <div class="product-detail">
                                                    <ul>
                                                        <li class="name">
                                                            <a href="product-left-thumbnail.html">${cart.product_name}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="price">
                                            <h4 class="table-title text-content">{{ __('cart.price') }}</h4>
                                            <h5>${ cart.sale_price > 0 ? new Intl.NumberFormat().format(cart.sale_price) :  new Intl.NumberFormat().format(cart.price) } đ
                                                 <del class="text-content">${ cart.sale_price > 0 ? new Intl.NumberFormat().format(cart.price) + ' đ' :  '' } </del></h5>
                                            <h6 class="theme-color">{{ __('cart.save_up') }} : ${new Intl.NumberFormat().format(cart.sale_price > 0 ? cart.price - cart.sale_price : 0)} đ</h6>
                                        </td>

                                        <td class="quantity">
                                            <h4 class="table-title text-content">{{ __('cart.quantity') }}</h4>
                                            <div class="quantity-price">
                                                <div class="cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus dec"
                                                            data-type="minus" data-field="" data-index="${index}">
                                                            <i class="fa fa-minus ms-0"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="${cart.quantity}">
                                                        <button type="button" class="btn qty-right-plus inc"
                                                            data-type="plus" data-field="" data-index="${index}">
                                                            <i class="fa fa-plus ms-0"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="subtotal">
                                            <h4 class="table-title text-content">{{ __('cart.total') }}</h4>
                                            <h5>${new Intl.NumberFormat().format(cart.sale_price > 0 ? cart.sale_price * cart.quantity : cart.price * cart.quantity)} đ</h5>
                                        </td>

                                        <td class="save-remove text-center align-middle">
                                            <a class="remove close_button delete-cart mt-3" data-index="${index}" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                        `;
                    });
                    document.getElementById('subtotal').innerText = carts.length > 0 ? new Intl.NumberFormat().format(
                        total) + ' đ' : '0đ';
                    document.getElementById('total').innerText = carts.length > 0 ? new Intl.NumberFormat().format(
                        total) + ' đ' : '0đ';
                    cartlistindexId.innerHTML = cartlistindex;
                }

            } catch (e) {
                console.log('error: ', e);
            }
        }

        function addToCart() {
            document.querySelectorAll('.form-add-to-cart').forEach(function(element) {
                element.addEventListener('submit', async function(event) {
                    event.preventDefault();
                    const formData = new FormData(element);

                    const productId = formData.get('product_id');
                    const quantity = formData.get('quantity');

                    try {
                        const response = await fetch(`{{ route('addToCart') }}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                quantity: quantity
                            })
                        });

                        const data = await response.json();

                        if (!response.ok) {
                            document.getElementById('notification').innerHTML = `<div class="alert alert-danger fade show" role="alert" id="auto-close-alert">
                            <i class="fa fa-exclamation-circle fs-2 me-3" aria-hidden="true"></i>
                            <div>
                                <p class="title">{{ __('notification.failure') }}</p>
                                <p class="notification">${data.message}</p>
                            </div>
                            <button type="button" class="btn-close ms-5 fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                            return;
                        }

                        document.getElementById('notification').innerHTML = `<div class="alert alert-success fade show" role="alert" id="auto-close-alert">
                        <i class="fa fa-check-circle fs-2 me-3" aria-hidden="true"></i>
                        <div>
                            <p class="title">{{ __('notification.success') }}</p>
                            <p class="notification">${data.message}</p>
                        </div>
                        <button type="button" class="btn-close ms-5 fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                        setTimeout(function() {
                            const alert = document.getElementById('auto-close-alert');
                            if (alert) {
                                alert.remove();
                            }
                        }, 3000);

                        getMyCart();

                    } catch (e) {
                        console.log('Error: ', e);
                    }
                });
            });
        }
        document.getElementById('cart-list').addEventListener('click', function(event) {
            const deleteButton = event.target.closest('.delete-cart');
            if (deleteButton) {
                const index = deleteButton.getAttribute('data-index');
                deleteCart(index);
            }
        });
        const listCartIndex = document.getElementById('list-carts-index');
        if (listCartIndex) {
            listCartIndex.addEventListener('click', function(event) {
                const deleteButton = event.target.closest('.delete-cart');
                if (deleteButton) {
                    const index = deleteButton.getAttribute('data-index');
                    deleteCart(index);
                }
                const increaseButton = event.target.closest('.inc');
                if (increaseButton) {
                    const index = increaseButton.getAttribute('data-index');
                    increaseCart(index);
                }
                const decreaseButton = event.target.closest('.dec');
                if (decreaseButton) {
                    const index = decreaseButton.getAttribute('data-index');
                    decreaseCart(index);
                }
            });
        }
        async function deleteCart(index) {
            try {
                const url = `{{ route('deleteCart', ':index') }}`.replace(':index', index);
                const response = await fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();
                if (response.ok) {
                    document.getElementById('notification').innerHTML = `<div class="alert alert-success fade show" role="alert" id="auto-close-alert">
                            <i class="fa fa-exclamation-circle fs-2 me-3" aria-hidden="true"></i>
                            <div>
                                <p class="title">{{ __('notification.success') }}</p>
                                <p class="notification">${data.message}</p>
                            </div>
                            <button type="button" class="btn-close ms-5 fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                    setTimeout(function() {
                        const alert = document.getElementById('auto-close-alert');
                        if (alert) {
                            alert.remove();
                        }
                    }, 3000);
                    getMyCart();
                } else {
                    document.getElementById('notification').innerHTML = `<div class="alert alert-danger fade show" role="alert" id="auto-close-alert">
                            <i class="fa fa-exclamation-circle fs-2 me-3" aria-hidden="true"></i>
                            <div>
                                <p class="title">{{ __('notification.failure') }}</p>
                                <p class="notification">${data.message}</p>
                            </div>
                            <button type="button" class="btn-close ms-5 fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                    setTimeout(function() {
                        const alert = document.getElementById('auto-close-alert');
                        if (alert) {
                            alert.remove();
                        }
                    }, 3000);
                }
            } catch (e) {
                console.log('Error: ', e);
            }
        }
        async function decreaseCart(index) {
            try {
                const url = `{{ route('decreaseCart', ':index') }})`.replace(':index', index);
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    document.getElementById('notification').innerHTML = `<div class="alert alert-danger fade show" role="alert" id="auto-close-alert">
                            <i class="fa fa-exclamation-circle fs-2 me-3" aria-hidden="true"></i>
                            <div>
                                <p class="title">{{ __('notification.failure') }}</p>
                                <p class="notification">${data.message}</p>
                            </div>
                            <button type="button" class="btn-close ms-5 fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                    setTimeout(function() {
                        const alert = document.getElementById('auto-close-alert');
                        if (alert) {
                            alert.remove();
                        }
                    }, 3000);
                }

                getMyCart();

            } catch (e) {
                console.log('Error: ', e);

            }
        }

        async function increaseCart(index) {
            try {
                const url = `{{ route('increaseCart', ':index') }})`.replace(':index', index);
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();
                if (!response.ok) {
                    document.getElementById('notification').innerHTML = `<div class="alert alert-danger fade show" role="alert" id="auto-close-alert">
                            <i class="fa fa-exclamation-circle fs-2 me-3" aria-hidden="true"></i>
                            <div>
                                <p class="title">{{ __('notification.failure') }}</p>
                                <p class="notification">${data.message}</p>
                            </div>
                            <button type="button" class="btn-close ms-5 fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                    setTimeout(function() {
                        const alert = document.getElementById('auto-close-alert');
                        if (alert) {
                            alert.remove();
                        }
                    }, 3000);
                }

                getMyCart();

            } catch (e) {
                console.log('Error: ', e);

            }
        }

        document.querySelectorAll('.view').forEach(function(element) {
            element.addEventListener('click', function() {
                productId = this.dataset.id;
                console.log(productId);

                if (productId) {
                    let url = `{{ route('quick-view', ':productId') }}`.replace(':productId', productId);
                    fetch(url)
                        .then(response => {
                            if (response.ok) {
                                return response.text();
                            } else {
                                throw new Error('Network response was not ok.');
                            }
                        })
                        .then(html => {
                            document.getElementById('view').innerHTML = html;
                            new bootstrap.Modal(document.getElementById('view')).show();
                            addToCart();
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                        });
                }
            });
        });
        addToCart();
        getMyCart();
    </script>

    @yield('scripts')
</body>

</html>
