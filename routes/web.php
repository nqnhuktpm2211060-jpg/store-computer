<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\CustomerNeedAdviceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmbedYoutubeVideosController;
use App\Http\Controllers\Admin\RivewProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\vnpay\PaymentByVnpay;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;

Route::middleware('set_locale')->group(function () {
    Route::get('/', [PagesController::class, 'home'])->name('home');
    Route::get('uu-dai-hot', [PagesController::class, 'hotDeal'])->name('hotDeal');
    Route::get('khuyen-mai', [PagesController::class, 'promotion'])->name('promotion');
    Route::get('san-pham', [ProductController::class, 'index'])->name('product.index');
    Route::get('quick-view/{id}', [ProductController::class, 'quickView'])->name('quick-view');
    Route::get('product-detail/{id}', [ProductController::class, 'productDetail'])->name('product.detail');
    Route::get('tin-tuc/{slug}', [BlogController::class, 'detail'])->name('blog.detail');
    Route::get('tin-tuc', [BlogController::class, 'index'])->name('blogs');
    Route::get('gio-hang', [CartController::class, 'index'])->name('cart.index');
    Route::get('thanh-toan', [PaymentController::class, 'checkout'])->name('checkout');
    Route::get('login', [AuthController::class, 'loginForm'])->name('login.form');
    Route::get('register', [AuthController::class, 'registerForm'])->name('register.form');
    Route::get('lien-he', [PagesController::class, 'contact'])->name('contact');

    Route::middleware('is_admin')->prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('quan-ly-don-hang', [OrderController::class, 'index'])->name('order.index');
        Route::get('chi-tiet-don-hang/{id}', [OrderController::class, 'getOrderItem'])->name('order.getOrderItem');

        Route::get('quan-ly-san-pham', [AdminProductController::class, 'index'])->name('admin.products.index');
        Route::get('quan-ly-san-pham/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
        Route::get('quan-ly-bai-viet', [PostController::class, 'index'])->name('admin.posts.index');
        Route::get('danh-muc-san-pham', [CategoryProductController::class, 'index'])->name('admin.category.product.index');
        Route::get('danh-gia-san-pham', [RivewProductController::class, 'index'])->name('review.index');
    });

    Route::get('ve-chung-toi', [PagesController::class, 'aboutUs'])->name('aboutUs');
    Route::get('faqs', [PagesController::class, 'faqs'])->name('faqs');
    Route::get('dich-vu-cua-chung-toi', [PagesController::class, 'ourService'])->name('ourService');

    Route::get('chinh-sach-bao-hanh', [PagesController::class, 'warrantyPolicy'])->name('warrantyPolicy');
    Route::get('chinh-sach-giao-hang', [PagesController::class, 'shippingPolicy'])->name('shippingPolicy');
    Route::get('chinh-sach-bao-mat', [PagesController::class, 'privacyPolicy'])->name('privacyPolicy');
    Route::get('dieu-khoan-dieu-kien', [PagesController::class, 'termsConditions'])->name('termsConditions');
    Route::get('cam-ket-gia-ca', [PagesController::class, 'priceCommitment'])->name('priceCommitment');
    Route::get('phan-hoi-khach-hang', [PagesController::class, 'feedbackService'])->name('feedbackService');

    Route::post('review-product/{id}', [ProductController::class, 'review'])->name('review.product');

    Route::post('post-comment', [BlogController::class, 'postComment'])->name('postComment');

    Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('get-carts', [CartController::class, 'getCarts'])->name('getCarts');
    Route::post('cart/decrease/{index}', [CartController::class, 'decrease'])->name('decreaseCart');
    Route::post('cart/increase/{index}', [CartController::class, 'increase'])->name('increaseCart');
    Route::DELETE('delete-cart/{index}', [CartController::class, 'deleteCart'])->name('deleteCart');

    // Chatbot route
    Route::post('chat', [ChatController::class, 'chat'])->name('chat');

    Route::middleware('auth')->group(function () {
        Route::get('thong-tin-ca-nhan', [PagesController::class, 'profile'])->name('profile');
        Route::post('update-profile', [AuthController::class, 'updateProfile'])->name('update-profile');
        Route::post('dat-hang', [PaymentController::class, 'placeOrder'])->name('placeOrder');
        Route::get('payment-vnpay-return', [PaymentByVnpay::class, 'handlePaymentReturn'])->name('payment.vnpay.return');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::get('/lang/{locale}', [LanguageController::class, 'switchLang'])->name('lang.switch');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    Route::middleware('is_admin')->prefix('admin')->group(function () {
        Route::post('thay-doi-trang-thai/{id}', [OrderController::class, 'changeStatus'])->name('order.changeStatus');
        Route::delete('xoa-don-hang/{id}', [OrderController::class, 'delete'])->name('order.delete');

    Route::resource('quan-ly-san-pham', AdminProductController::class)->except(['index', 'edit'])->names('admin.products');
        Route::post('/upload-image-product', [AdminProductController::class, 'uploadImageDescription'])->name('upload.image.product');

        Route::resource('quan-ly-bai-viet', PostController::class)->except(['index'])->names('admin.posts');
        Route::post('/upload-image-blog', [PostController::class, 'uploadImageDescription'])->name('upload.image.blog');
        Route::resource('danh-muc-san-pham', CategoryProductController::class)->except(['index'])->names('admin.category.product');


        Route::post('update-review/{id}', [RivewProductController::class, 'update'])->name('review.update');
        Route::delete('destroy-review/{id}', [RivewProductController::class, 'destroy'])->name('review.destroy');
        Route::post('approve-review/{id}', [RivewProductController::class, 'approve'])->name('review.approve');
    });
});
