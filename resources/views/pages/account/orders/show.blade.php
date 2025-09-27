@extends('layout')
@section('title', 'Chi tiết đơn hàng #' . $order->id)

@section('content')
<section class="breadcrumb-section pt-0">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-contain">
                    <h2>Chi tiết đơn hàng</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/"><i class="fa-solid fa-house"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Đơn hàng</a></li>
                            <li class="breadcrumb-item active">#{{ $order->id }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-b-space">
    <div class="container-fluid-lg">
        <div class="row g-4">
            <div class="col-12 col-lg-4">
                <div class="card p-3 h-100">
                    <h5 class="mb-3">Thông tin đơn hàng</h5>
                    <div class="d-flex justify-content-between mb-2"><span>Mã đơn:</span><span>#{{ $order->id }}</span></div>
                    <div class="d-flex justify-content-between mb-2"><span>Ngày đặt:</span><span>{{ $order->created_at->format('d/m/Y H:i') }}</span></div>
                    <div class="d-flex justify-content-between mb-2"><span>Trạng thái:</span><span>{!! $order->status_label !!}</span></div>
                    <div class="d-flex justify-content-between mb-2"><span>Thanh toán:</span><span>{{ strtoupper($order->payment_method ?? 'cash') }}</span></div>
                    <div class="d-flex justify-content-between mb-2"><span>Tổng tiền:</span><span class="fw-bold">{{ $order->formatted_total }}</span></div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card p-3">
                    <h5 class="mb-3">Sản phẩm</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-center">SL</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ $item->product?->main_image }}" alt="{{ $item->product?->name }}" style="width: 60px; height: 60px; object-fit: cover;" class="rounded">
                                                <div>
                                                    <div class="fw-semibold">{{ $item->product?->name ?? 'Sản phẩm đã xóa' }}</div>
                                                    @if($item->product)
                                                        <a class="small text-muted" href="{{ route('product.detail', $item->product->id) }}">Xem sản phẩm</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">{{ number_format($item->total_price) }} đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
