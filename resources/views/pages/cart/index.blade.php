@extends('layout')
@section('title', __('cart.title'))
@section('content')
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>{{ __('cart.title') }}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('cart.title') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cart-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-5 g-3">
                <div class="col-xxl-9">
                    <div class="cart-table">
                        <div class="table-responsive-xl">
                            <table class="table">
                                <tbody id="list-carts-index">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3">
                    <div class="summery-box p-sticky">
                        <div class="summery-header">
                            <h3>{{ __('cart.cart_summary') }}</h3>
                        </div>

                        <div class="summery-contain">
                            <div class="coupon-cart">
                                <h6 class="text-content mb-2">{{ __('cart.apply_coupon') }}</h6>
                                <div class="mb-3 coupon-box input-group">
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="{{ __('cart.enter_coupon_code') }}">
                                    <button class="btn-apply">{{ __('cart.apply') }}</button>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <h4>{{ __('cart.subtotal') }}</h4>
                                    <h4 class="price" id="subtotal">0 đ</h4>
                                </li>

                                <li>
                                    <h4>{{ __('cart.discount') }}</h4>
                                    <h4 class="price">(-) 0 đ</h4>
                                </li>

                                <li class="align-items-start">
                                    <h4>{{ __('cart.shipping') }}</h4>
                                    <h4 class="price text-end">0 đ</h4>
                                </li>
                            </ul>
                        </div>

                        <ul class="summery-total">
                            <li class="list-total border-top-0">
                                <h4>{{ __('cart.total')}}</h4>
                                <h4 class="price theme-color" id="total">0 đ</h4>
                            </li>
                        </ul>

                        <div class="button-group cart-button">
                            <ul>
                                <li>
                                    <button onclick="location.href = '{{ route('checkout') }}';"
                                        class="btn btn-animation proceed-btn fw-bold">{{ __('cart.proceed_to_checkout') }}</button>
                                </li>

                                <li>
                                    <button onclick="location.href = '{{ redirect()->back() }}"
                                        class="btn btn-light shopping-button text-dark">
                                        <i
                                            class="fa-solid fa-arrow-left-long"></i>{{ __('cart.continue_shopping') }}</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
