@extends('admin.layout.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin">{{ __('admin.order.dashboard') }}</a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ __('admin.order.order_management') }}</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2">{{ __('admin.order.order_list') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (!request('start_date') && !request('end_date'))
        <p class="f-18">{{ __('admin.order.filter_current_month') }}</p>
    @endif


        <div class="row align-items-center mb-3">
            <div class="col-12 col-md-1">
        <form action="{{ route('order.index') }}" method="get">
        
    <input type="text" class="form-control" name="order_id"
                   placeholder="Tìm theo mã đơn hàng"
                   value="{{ request('order_id') }}">
            </div>
            <div class="col-12 col-md-2">
                <input type="text" class="form-control" name="full_name"
                   placeholder="Tìm theo tên người đặt hàng"
                   value="{{ request('full_name') }}">
               </div> 
            <div class="col-12 col-md-2">
                <select name="status" class="form-select">
                    <option value="" selected>{{ __('admin.order.search_by_status') }}</option>
                    <option value="0" {{ request('status') == 1 ? 'selected' : '' }}>{{ __('admin.order.new') }}
                    </option>
                    <option value="1" {{ request('status') == 2 ? 'selected' : '' }}>
                        {{ __('admin.order.delivering') }}</option>
                    <option value="2" {{ request('status') == 3 ? 'selected' : '' }}>
                        {{ __('admin.order.completed') }}</option>
                    <option value="3" {{ request('status') == 4 ? 'selected' : '' }}>
                        {{ __('admin.order.cancelled') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-2">
                <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}">
            </div>
            <div class="col-12 col-md-2">
                <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-info">{{ __('admin.order.search') }}</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table class="table table-hover text-center" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>{{ __('admin.order.id') }}</th>
                                    <th>{{ __('admin.order.name') }}</th>
                                    <th>{{ __('admin.order.phone') }}</th>
                                    <th>{{ __('admin.order.email') }}</th>
                                    <th>{{ __('admin.order.address') }}</th>
                                    <th>{{ __('admin.order.total') }}</th>
                                    <th>{{ __('admin.order.status') }}</th>
                                    <th>{{ __('admin.order.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->full_name }}</td>
                                        <td>{{ $order->phone_number }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td style="width: 40%">{{ $order->address }}</td>
                                        <td>{{ number_format($order->total, 0, '.', ',') }} đ</td>
                                        <td>{!! $order->status_label !!}</td>
                                        <td>
                                            <a href="#!" class="avtar avtar-details avtar-xs btn-link-secondary"
                                                data-id="{{ $order->id }}" title="{{ __('admin.order.view_detail') }}">
                                                <i class="ti ti-eye f-20"></i>
                                            </a>
                                            <a href="#!" class="avtar avtar-change avtar-xs btn-link-secondary"
                                                data-id="{{ $order->id }}"
                                                title="{{ __('admin.order.change_status') }}">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>
                                            <a href="#!" class="avtar avtar-delete avtar-xs btn-link-secondary"
                                                data-id="{{ $order->id }}"
                                                title="{{ __('admin.order.delete_order') }}">
                                                <i class="ti ti-trash f-20"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            <p class="text-center">{{ __('admin.order.no_order') }}</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="ps-5 pe-5">
                            {{ $orders->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="order-item-dialog"></div>
    <div id="change-status-dialog"></div>
    <div id="delete-dialog"></div>


    <script>
        document.querySelectorAll('.avtar-details').forEach((element) => {
            element.addEventListener('click', async () => {
                const id = element.dataset.id;

                if (id) {
                    const response = await fetch('{{ route('order.getOrderItem', ':id') }}'.replace(
                        ':id', id), {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        }
                    });

                    const data = await response.text();
                    if (!response.ok) {
                        alert('Có lỗi xảy ra');
                        return;
                    }
                    document.getElementById('order-item-dialog').innerHTML = data;
                    const modal = new bootstrap.Modal(document.getElementById('order-item'));
                    modal.show();
                }
            });
        });

        document.querySelectorAll('.avtar-change').forEach((element) => {
            element.addEventListener('click', async () => {
                const id = element.dataset.id;
                if (id) {
                    document.getElementById('change-status-dialog').innerHTML = `<div class="modal fade" id="change-status" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-xs">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="orderModalLabel">{{ __('admin.order.change_status_title') }}</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p>{{ __('admin.order.change_status_description') }}: <strong>${id}</strong></p>
                                                                                    <form method="post" action="{{ route('order.changeStatus', ':id') }}">
                                                                                        @csrf
                                                                                        <label class="control-label">{{ __('admin.order.select_status') }}</label>
                                                                                        <select name="status" class="form-select mb-3" required>
                                                                                            <option value="" selected>{{ __('admin.order.select_status') }}</option>
                                                                                            <option value="2">{{ __('admin.order.shipping') }}</option>
                                                                                            <option value="3">{{ __('admin.order.completed') }}</option>
                                                                                            <option value="4">{{ __('admin.order.cancelled') }}</option>
                                                                                        </select>
                                                                                        <button type="submit" class="btn btn-info">{{ __('admin.order.update') }}</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>`.replace(':id', id);
                    const modal = new bootstrap.Modal(document.getElementById('change-status'));
                    modal.show();
                }
            });
        });
        document.querySelectorAll('.avtar-delete').forEach((element) => {
            element.addEventListener('click', async () => {
                const id = element.dataset.id;
                if (id) {
                    document.getElementById('delete-dialog').innerHTML = `<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-xs">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="orderModalLabel">{{ __('admin.order.delete_title') }}</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p>{{ __('admin.order.delete_confirm') }}: <strong>${id}</strong>?</p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('admin.order.close') }}</button>
                                                                                    <form method="post" action="{{ route('order.delete', ':id') }}">
                                                                                        @csrf
                                                                                        @method('delete')
                                                                                        <button type="submit" class="btn btn-info">{{ __('admin.order.delete') }}</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>`.replace(':id', id);
                    const modal = new bootstrap.Modal(document.getElementById('delete'));
                    modal.show();
                }
            });
        });
    </script>
@endsection
