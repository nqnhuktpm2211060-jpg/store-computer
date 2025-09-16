<!doctype html>
<html lang="en">

<head>
    <title>Trang quản trị</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    <!-- [Font] Family -->
    <link rel="stylesheet" href="{{ asset('adminAssets/fonts/inter/inter.css') }}" id="main-font-link">

    <link rel="stylesheet" href="{{ asset('adminAssets/fonts/phosphor/duotone/style.css') }}">

    <link rel="stylesheet" href="{{ asset('adminAssets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminAssets/fonts/feather.css') }}">

    <link rel="stylesheet" href="{{ asset('adminAssets/fonts/fontawesome.css') }}">

    <link rel="stylesheet" href="{{ asset('adminAssets/fonts/material.css') }}">
    <link rel="stylesheet" href="{{ asset('adminAssets/css/style.css') }}" id="main-style-link">
    <script src="{{ asset('adminAssets/js/tech-stack.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <link rel="stylesheet" href="{{ asset('adminAssets/css/style-preset.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr"
    data-pc-theme_contrast="" data-pc-theme="light"><!-- [ Pre-loader ] start -->
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div><!-- [ Pre-loader ] End --><!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header" style="height: 200px !important">
                <a href="{{ route('admin.dashboard') }}" class="b-brand text-primary">
                    <img src="/assets/logo.jpg" class="img-fluid" height="150px" width="250px"
                        alt="logo">
                </a>
            </div>
            <div class="navbar-content">
                <div class="card pc-user-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('adminAssets/images/avatar.jpg') }}" alt="user-image"
                                    class="user-avtar wid-45 rounded-circle">
                            </div>
                            <div class="flex-grow-1 ms-3 me-2">
                                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                <small>{{ __('admin.layout.role') }}: Admin</small>
                            </div>
                            <a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse"
                                href="#pc_sidebar_userlink">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-sort-outline"></use>
                                </svg>
                            </a>
                        </div>
                        <div class="collapse pc-user-links" id="pc_sidebar_userlink">
                            <div class="pt-3">
                                <a href=""><i class="ti ti-user"></i>
                                    <span>{{ __('admin.layout.my_account') }}</span></a>
                                <a href="{{ route('logout') }}"><i class="ti ti-power"></i>
                                    <span>{{ __('admin.layout.logout') }}</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>{{ __('admin.layout.navigation') }}</label>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="{{ route('admin.dashboard') }}" class="pc-link">
                            <span class="pc-mtext">{{ __('admin.layout.dashboard') }}</span>
                        </a>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="{{ route('order.index') }}" class="pc-link">
                            <span class="pc-mtext">{{ __('admin.layout.order_management') }}</span>
                        </a>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="#" class="pc-link">
                            <span class="pc-mtext">{{ __('admin.layout.product_management') }}</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu" style="display: block; box-sizing: border-box;">
                            <li class="pc-item pc-hasmenu">
                                <a href="{{ route('admin.products.index') }}" class="pc-link">
                                    <span class="pc-mtext">{{ __('admin.layout.product_list') }}</span>
                                </a>
                            </li>
                            <li class="pc-item pc-hasmenu">
                                <a class="pc-link"
                                    href="{{ route('review.index') }}">{{ __('admin.layout.product_reviews') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="{{ route('admin.category.product.index') }}" class="pc-link">
                            <span class="pc-mtext">{{ __('admin.layout.product_categories') }}</span>
                        </a>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="{{ route('admin.posts.index') }}" class="pc-link">
                            <span class="pc-mtext">{{ __('admin.layout.post_management') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav><!-- [ Sidebar Menu ] end --><!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <div class="header-wrapper">
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a href="#" class="pc-head-link ms-0" id="sidebar-hide"><i
                                class="ti ti-menu-2"></i></a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link ms-0" id="mobile-collapse"><i
                                class="ti ti-menu-2"></i></a>
                    </li>
                    <li class="pc-h-item d-none d-md-inline-flex">
                        <form class="form-search">
                            <i class="search-icon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-search-normal-1"></use>
                                </svg>
                            </i>
                            <input type="search" class="form-control"
                                placeholder="{{ __('admin.layout.search_placeholder') }}">
                        </form>
                    </li>
                </ul>
            </div>

            <div class="ms-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                            href="#" role="button">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-sun-1"></use>
                            </svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                            <a href="#!" class="dropdown-item" onclick="layout_change('dark')">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-moon"></use>
                                </svg>
                                <span>{{ __('admin.layout.theme_dark') }}</span>
                            </a>
                            <a href="#!" class="dropdown-item" onclick="layout_change('light')">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-sun-1"></use>
                                </svg>
                                <span>{{ __('admin.layout.theme_light') }}</span>
                            </a>
                            <a href="#!" class="dropdown-item" onclick="layout_change_default()">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-setting-2"></use>
                                </svg>
                                <span>{{ __('admin.layout.theme_default') }}</span>
                            </a>
                        </div>
                    </li>

                    <li class="dropdown pc-h-item header-user-profile">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                            href="#" role="button" data-bs-auto-close="outside">
                            <img src="{{ asset('adminAssets/images/avatar.jpg') }}" alt="user-image"
                                class="user-avtar">
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h5 class="m-0">{{ __('admin.layout.my_account') }}</h5>
                            </div>
                            <div class="dropdown-body">
                                <div class="profile-notification-scroll position-relative"
                                    style="max-height: calc(100vh - 225px)">
                                    <div class="d-flex mb-1">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('adminAssets/images/avatar.jpg') }}" alt="user-image"
                                                class="user-avtar wid-35">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">{{ Auth::user()->name }} 🖖</h6>
                                            <span>{{ Auth::user()->email }}</span>
                                        </div>
                                    </div>
                                    <hr class="border-secondary border-opacity-50">
                                    <div class="card">
                                        <div class="card-body py-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0 d-inline-flex align-items-center">
                                                    <svg class="pc-icon text-muted me-2">
                                                        <use xlink:href="#custom-notification-outline"></use>
                                                    </svg>
                                                    {{ __('admin.layout.notification') }}
                                                </h5>
                                                <div class="form-check form-switch form-check-reverse m-0">
                                                    <input class="form-check-input f-18" type="checkbox"
                                                        role="switch">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="border-secondary border-opacity-50">
                                    <div class="d-grid mb-3">
                                        <a class="btn btn-primary" href="{{ route('logout') }}">
                                            <svg class="pc-icon me-2"></svg>
                                            {{ __('admin.layout.logout') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content"><!-- [ Main Content ] start -->
            @yield('content')
        </div>
    </div>
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col my-1">
                    <p class="m-0"><a href="https://idai.vn/" target="_blank">Idai &#9829;</a></p>
                </div>
                {{-- <div class="col-auto my-1">
                    <ul class="list-inline footer-link mb-0">
                        <li class="list-inline-item"><a href="https://idai.vn/">Home</a></li>
                        <li class="list-inline-item"><a href="https://phoenixcoded.gitbook.io/able-pro/"
                                target="_blank">Documentation</a></li>
                        <li class="list-inline-item"><a href="https://phoenixcoded.authordesk.app/"
                                target="_blank">Support</a></li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </footer>
    <div class="pct-c-btn"><a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_pc_layout"><i
                class="ph-duotone ph-gear-six"></i></a></div>
    <div class="offcanvas border-0 pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">{{ __('admin.layout.settings') }}</h5>
            <button type="button" class="btn btn-icon btn-link-danger ms-auto" data-bs-dismiss="offcanvas"
                aria-label="Close">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <div class="pct-body customizer-body">
            <div class="offcanvas-body py-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="pc-dark">
                            <h6 class="mb-1">{{ __('admin.layout.theme_mode') }}</h6>
                            <p class="text-muted text-sm">{{ __('admin.layout.theme_mode_description') }}</p>
                            <div class="row theme-color theme-layout">
                                <div class="col-4">
                                    <div class="d-grid">
                                        <button class="preset-btn btn active" data-value="true"
                                            onclick="layout_change('light');" data-bs-toggle="tooltip"
                                            title="{{ __('admin.layout.light') }}">
                                            <svg class="pc-icon text-warning">
                                                <use xlink:href="#custom-sun-1"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-grid">
                                        <button class="preset-btn btn" data-value="false"
                                            onclick="layout_change('dark');" data-bs-toggle="tooltip"
                                            title="{{ __('admin.layout.dark') }}">
                                            <svg class="pc-icon">
                                                <use xlink:href="#custom-moon"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-grid">
                                        <button class="preset-btn btn" data-value="default"
                                            onclick="layout_change_default();" data-bs-toggle="tooltip"
                                            title="{{ __('admin.layout.auto') }}">
                                            <span
                                                class="pc-lay-icon d-flex align-items-center justify-content-center"><i
                                                    class="ph-duotone ph-cpu"></i></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <h6 class="mb-1">{{ __('admin.layout.theme_contrast') }}</h6>
                        <p class="text-muted text-sm">{{ __('admin.layout.theme_contrast_description') }}</p>
                        <div class="row theme-contrast">
                            <div class="col-6">
                                <div class="d-grid">
                                    <button class="preset-btn btn" data-value="true"
                                        onclick="layout_theme_contrast_change('true');" data-bs-toggle="tooltip"
                                        title="{{ __('admin.layout.on') }}">
                                        <svg class="pc-icon">
                                            <use xlink:href="#custom-mask"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-grid">
                                    <button class="preset-btn btn active" data-value="false"
                                        onclick="layout_theme_contrast_change('false');" data-bs-toggle="tooltip"
                                        title="{{ __('admin.layout.off') }}">
                                        <svg class="pc-icon">
                                            <use xlink:href="#custom-mask-1-outline"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <h6 class="mb-1">{{ __('admin.layout.custom_theme') }}</h6>
                        <p class="text-muted text-sm">{{ __('admin.layout.custom_theme_description') }}</p>
                        <div class="theme-color preset-color">
                            <a href="#!" data-bs-toggle="tooltip" title="{{ __('admin.layout.blue') }}"
                                class="active" data-value="preset-1"><i class="ti ti-checks"></i></a>
                            <a href="#!" data-bs-toggle="tooltip" title="{{ __('admin.layout.indigo') }}"
                                data-value="preset-2"><i class="ti ti-checks"></i></a>
                            <a href="#!" data-bs-toggle="tooltip" title="{{ __('admin.layout.purple') }}"
                                data-value="preset-3"><i class="ti ti-checks"></i></a>
                            <a href="#!" data-bs-toggle="tooltip" title="{{ __('admin.layout.pink') }}"
                                data-value="preset-4"><i class="ti ti-checks"></i></a>
                            <a href="#!" data-bs-toggle="tooltip" title="{{ __('admin.layout.red') }}"
                                data-value="preset-5"><i class="ti ti-checks"></i></a>
                            <a href="#!" data-bs-toggle="tooltip" title="{{ __('admin.layout.orange') }}"
                                data-value="preset-6"><i class="ti ti-checks"></i></a>
                            <a href="#!" data-bs-toggle="tooltip" title="{{ __('admin.layout.yellow') }}"
                                data-value="preset-7"><i class="ti ti-checks"></i></a>
                            <a href="#!" data-bs-toggle="tooltip" title="{{ __('admin.layout.green') }}"
                                data-value="preset-8"><i class="ti ti-checks"></i></a>
                            <a href="#!" data-bs-toggle="tooltip" title="{{ __('admin.layout.teal') }}"
                                data-value="preset-9"><i class="ti ti-checks"></i></a>
                            <a href="#!" data-bs-toggle="tooltip" title="{{ __('admin.layout.aqua') }}"
                                data-value="preset-10"><i class="ti ti-checks"></i></a>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <h6 class="mb-1">{{ __('admin.layout.layout') }}</h6>
                        <p class="text-muted text-sm">{{ __('admin.layout.layout_description') }}</p>
                        <div class="theme-main-layout d-flex align-center gap-1 w-100">
                            <a href="#!" data-bs-toggle="tooltip" title="{{ __('admin.layout.vertical') }}"
                                class="active" data-value="vertical">
                                <img src="https://ableproadmin.com/assets/images/customizer/caption-on.svg"
                                    alt="img" class="img-fluid">
                            </a>
                            <a href="#!" data-bs-toggle="tooltip" title="{{ __('admin.layout.horizontal') }}"
                                data-value="horizontal">
                                <img src="https://ableproadmin.com/assets/images/customizer/horizontal.svg"
                                    alt="img" class="img-fluid">
                            </a>
                            <a href="#!" data-bs-toggle="tooltip" title="{{ __('admin.layout.color_header') }}"
                                data-value="color-header">
                                <img src="https://ableproadmin.com/assets/images/customizer/color-header.svg"
                                    alt="img" class="img-fluid">
                            </a>
                            <a href="#!" data-bs-toggle="tooltip" title="{{ __('admin.layout.compact') }}"
                                data-value="compact">
                                <img src="https://ableproadmin.com/assets/images/customizer/compact.svg"
                                    alt="img" class="img-fluid">
                            </a>
                            <a href="#!" data-bs-toggle="tooltip" title="{{ __('admin.layout.tab') }}"
                                data-value="tab">
                                <img src="https://ableproadmin.com/assets/images/customizer/tab.svg" alt="img"
                                    class="img-fluid">
                            </a>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <h6 class="mb-1">{{ __('admin.layout.sidebar_caption') }}</h6>
                        <p class="text-muted text-sm">{{ __('admin.layout.sidebar_caption_description') }}</p>
                        <div class="row theme-color theme-nav-caption">
                            <div class="col-6">
                                <div class="d-grid">
                                    <button class="preset-btn btn-img btn active" data-value="true"
                                        onclick="layout_caption_change('true');" data-bs-toggle="tooltip"
                                        title="{{ __('admin.layout.show_caption') }}">
                                        <img src="https://ableproadmin.com/assets/images/customizer/caption-on.svg"
                                            alt="img" class="img-fluid">
                                    </button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-grid">
                                    <button class="preset-btn btn-img btn" data-value="false"
                                        onclick="layout_caption_change('false');" data-bs-toggle="tooltip"
                                        title="{{ __('admin.layout.hide_caption') }}">
                                        <img src="https://ableproadmin.com/assets/images/customizer/caption-off.svg"
                                            alt="img" class="img-fluid">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="pc-rtl">
                            <h6 class="mb-1">{{ __('admin.layout.layout_direction') }}</h6>
                            <p class="text-muted text-sm">{{ __('admin.layout.layout_direction_description') }}</p>
                            <div class="row theme-color theme-direction">
                                <div class="col-6">
                                    <div class="d-grid">
                                        <button class="preset-btn btn-img btn active" data-value="false"
                                            onclick="layout_rtl_change('false');" data-bs-toggle="tooltip"
                                            title="{{ __('admin.layout.ltr') }}">
                                            <img src="https://ableproadmin.com/assets/images/customizer/ltr.svg"
                                                alt="img" class="img-fluid">
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-grid">
                                        <button class="preset-btn btn-img btn" data-value="true"
                                            onclick="layout_rtl_change('true');" data-bs-toggle="tooltip"
                                            title="{{ __('admin.layout.rtl') }}">
                                            <img src="https://ableproadmin.com/assets/images/customizer/rtl.svg"
                                                alt="img" class="img-fluid">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item pc-box-width">
                        <div class="pc-container-width">
                            <h6 class="mb-1">{{ __('admin.layout.layout_width') }}</h6>
                            <p class="text-muted text-sm">{{ __('admin.layout.layout_width_description') }}</p>
                            <div class="row theme-color theme-container">
                                <div class="col-6">
                                    <div class="d-grid">
                                        <button class="preset-btn btn-img btn active" data-value="false"
                                            onclick="change_box_container('false')" data-bs-toggle="tooltip"
                                            title="{{ __('admin.layout.full_width') }}">
                                            <img src="https://ableproadmin.com/assets/images/customizer/full.svg"
                                                alt="img" class="img-fluid">
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-grid">
                                        <button class="preset-btn btn-img btn" data-value="true"
                                            onclick="change_box_container('true')" data-bs-toggle="tooltip"
                                            title="{{ __('admin.layout.fixed_width') }}">
                                            <img src="https://ableproadmin.com/assets/images/customizer/fixed.svg"
                                                alt="img" class="img-fluid">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-grid">
                            <button class="btn btn-light-danger"
                                id="layoutreset">{{ __('admin.layout.reset_layout') }}</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- <script data-cfasync="false" src="{{ asset('adminAdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"> --}}
    </script>
    <script src="{{ asset('adminAssets/js/plugins/apexcharts.min.js') }}"></script>
    {{-- <script src="{{ asset('adminAssets/js/pages/dashboard-analytics.js') }}"></script> --}}
    <script src="{{ asset('adminAssets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('adminAssets/js/pcoded.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/feather.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script>
        layout_change('light');
        change_box_container('false');
        layout_caption_change('true');
        layout_rtl_change('false');
        preset_change('preset-1');
        main_layout_change('vertical');
        setTimeout(function() {
            const alert = document.getElementsByClassName("alert")[0];
            if (alert) {
                alert.classList.add("d-none");
            }
        }, 3000);
        $(document).ready(function() {
            $('.money').inputmask('currency', {
                prefix: '',
                suffix: ' đồng',
                autoUnmask: true,
                digits: 0,
                digitsOptional: false,
                placeholder: '0'
            });
        });
    </script>

</body>

</html>
