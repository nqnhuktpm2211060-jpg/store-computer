<div class="modal fade" id="order-item" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">{{ __('admin.order_detail.title') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover text-center table-fixed" id="pc-dt-simple">
                        <thead>
                            <tr><th>{{ __('admin.order_detail.order_id') }}</th>
                                <th>{{ __('admin.order_detail.product_name') }}</th>
                                <th></th>
                                <th>{{ __('admin.order_detail.quantity') }}</th>
                                <th>{{ __('admin.order_detail.total_price') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order_items as $it)
                                <tr>
                                    <td>{{ $it->order_id }}</td>
                                    <td>{{ $it->product?->name_translated }}</td>
                                    <td><img src="{{ $it->product?->images ? $it->product->images->first()->image_path : '' }}" width="60px" alt="anh sp"></td>
                                    <td>{{ $it->quantity }}</td>
                                    <td>{{ number_format($it->total_price, 0, '.', ',') }} đ</td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <p class="text-center">{{ __('admin.order_detail.no_order') }}</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('admin.order_detail.close') }}</button>
            </div>
        </div>
    </div>
</div>
