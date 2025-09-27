@extends('admin.layout.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.dashboard') }}">{{ __('admin.product_management.title') }}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">{{ __('admin.review_management.title') }}</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2">{{ __('admin.review_management.list') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('review.index') }}" method="get">
        <div class="row align-items-center mb-3">
            <div class="col-12 col-md-3">
                <input type="text" class="form-control" name="product_name"
                    placeholder="{{ __('admin.review_management.search_by_product_name') }}"
                    value="{{ request('product_name') }}">
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-info">
                    {{ __('admin.review_management.search') }}
                </button>
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
                                    <th>{{ __('admin.review_management.table.product_name') }}</th>
                                    <th>{{ __('admin.review_management.table.image') }}</th>
                                    <th>{{ __('admin.review_management.table.full_name') }}</th>
                                    <th>{{ __('admin.review_management.table.email') }}</th>
                                    <th>{{ __('admin.review_management.table.content') }}</th>
                                    <th>{{ __('admin.review_management.table.rating') }}</th>
                                    <th>{{ __('admin.review_management.table.status') }}</th>
                                    <th>{{ __('admin.review_management.table.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reviews as $review)
                                    <tr>
                                        <td>
                                            {{ $review->product?->name_translated }}
                                        </td>
                                        <td>
                                            <img src="{{ $review->product->main_image ?? "" }}"
                                                width="40px" alt="image product">
                                        </td>
                                        <td>
                                            {{ $review->full_name }}
                                        </td>
                                        <td>
                                            {{ $review->email }}
                                        </td>
                                        <td>
                                            {{ $review->content }}
                                        </td>
                                        <td>
                                            {{ $review->rating }}
                                        </td>
                                        <td class="{{ $review->status == 0 ? 'text-danger' : 'text-success' }}">
                                            {{ $review->status == 0 ? __('admin.review_management.status.not_approved') : __('admin.review_management.status.approved') }}
                                        </td>
                                        <td>
                                            <a href=""class="avtar avtar-change avtar-xs btn-link-secondary {{ $review->status == 0 ? 'text-danger' : 'text-success' }}"
                                                title="{{ __('admin.review_management.actions.approve') }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#approve-review-{{ $review->id }}">
                                                <i
                                                    class="{{ $review->status == 0 ? 'fas fa-toggle-off f-20' : 'fas fa-toggle-on f-20' }}"></i>
                                            </a>
                                            <a href="#!" class="avtar avtar-change avtar-xs btn-link-secondary"
                                                title="{{ __('admin.review_management.actions.edit') }}"
                                                data-bs-toggle="modal" data-bs-target="#edit-review-{{ $review->id }}">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>
                                            <a href="#!" class="avtar avtar-delete avtar-xs btn-link-secondary"
                                                title="{{ __('admin.review_management.actions.delete') }}"
                                                data-bs-toggle="modal" data-bs-target="#delete-review-{{ $review->id }}">
                                                <i class="ti ti-trash f-20"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            <p class="text-center">{{ __('admin.review_management.empty') }}</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="ps-5 pe-5">
                            {{ $reviews->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($reviews as $review)
        {{-- Modal Xóa --}}
        <div class="modal fade" id="delete-review-{{ $review->id }}" tabindex="-1" aria-labelledby="orderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">{{ __('admin.review_management.modal.title_delete') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="{{ __('admin.review_management.modal.close') }}"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('admin.review_management.modal.content_delete') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('admin.review_management.modal.close') }}</button>
                        <form action="{{ route('review.destroy', $review->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                class="btn btn-info">{{ __('admin.review_management.actions.delete') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Phê duyệt --}}
        <div class="modal fade" id="approve-review-{{ $review->id }}" tabindex="-1" aria-labelledby="orderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">
                            {{ __('admin.review_management.modal.title_approve') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="{{ __('admin.review_management.modal.close') }}"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('admin.review_management.modal.content_approve') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('admin.review_management.modal.close') }}</button>
                        <form action="{{ route('review.approve', $review->id) }}" method="post">
                            @csrf
                            <button type="submit"
                                class="btn btn-info">{{ __('admin.review_management.actions.approve') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Chỉnh sửa --}}
        <div class="modal fade" id="edit-review-{{ $review->id }}" tabindex="-1" aria-labelledby="orderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">{{ __('admin.review_management.modal.title_edit') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="{{ __('admin.review_management.modal.close') }}"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('review.update', $review->id) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="">{{ __('admin.review_management.fields.full_name') }}</label>
                                <input type="text" class="form-control" name="full_name"
                                    value="{{ $review->full_name }}"
                                    placeholder="{{ __('admin.review_management.placeholders.full_name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="">{{ __('admin.review_management.fields.email') }}</label>
                                <input type="text" class="form-control" name="email" value="{{ $review->email }}"
                                    placeholder="{{ __('admin.review_management.placeholders.email') }}">
                            </div>
                            <div class="mb-3">
                                <label for="">{{ __('admin.review_management.fields.rating') }}</label>
                                <input type="text" class="form-control" name="rating" value="{{ $review->rating }}"
                                    placeholder="{{ __('admin.review_management.placeholders.rating') }}">
                            </div>
                            <div class="mb-3">
                                <label for="">{{ __('admin.review_management.fields.content') }}</label>
                                <textarea name="content" class="form-control" cols="30" rows="4"
                                    placeholder="{{ __('admin.review_management.placeholders.content') }}">{{ $review->content }}</textarea>
                            </div>
                            <button type="submit"
                                class="btn btn-info">{{ __('admin.review_management.actions.submit_update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

