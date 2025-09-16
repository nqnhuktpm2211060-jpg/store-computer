<div class="modal fade" id="edit-post" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">{{ __('admin.posts.modal.title_edit') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('admin.posts.modal.close') }}"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.posts.update', $blog->id) }}" id="edit-blog-form" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="mb-3 mb-0">
                                                <label class="form-label">{{ __('admin.posts.fields.title') }}</label>
                                                <input type="text" class="form-control" name="title" value="{{$blog->translations->first()?->title}}"
                                                    placeholder="{{ __('admin.posts.placeholder.title') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-6">
                                            <div class="mb-3 mb-0">
                                                <label class="form-label">{{__('admin.product_management.fields.language')}}</label>
                                                <select name="language" class="form-select" id="select-language"
                                                    required>
                                                    <option value="">{{__('admin.product_management.placeholders.language')}}</option>
                                                    @foreach ($languages as $lang)
                                                        <option value="{{ $lang->code }}"
                                                            {{ (request()->language ?? app()->getLocale()) == $lang->code ? 'selected' : '' }}>
                                                            {{ $lang->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="border rounded p-3 h-100">
                                                <div class="d-flex flex-column align-items-center justify-content-center mb-2">
                                                    <p class="mb-0 f-16">{{ __('admin.posts.fields.image') }}</p>
                                                    <label for="file-upload-edit" class="custom-file-upload">
                                                        <i class="fas fa-upload"></i>
                                                        {{ __('admin.posts.actions.upload_image') }}
                                                    </label>
                                                    <input type="file" id="file-upload-edit" class="file-upload" name="image" style="display: none" accept="image/*">
                                                    <div id="file-info-edit" style="margin-top: 10px;"></div>
                                                </div>
                                                <div class="text-center" id="product-images-edit">
                                                    <img src="{{ $blog->image }}" width="50%" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3 mb-0">
                                                <label class="form-label">{{ __('admin.posts.fields.category') }}</label>
                                                <input name="categories" class="form-control" id="categories_edit" placeholder="{{ __('admin.posts.placeholder.category') }}" value="{{ $blog->translations->first()?->sub_categories }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3 mb-0">
                                                <label class="form-label">{{ __('admin.posts.fields.short_content') }}</label>
                                                <textarea class="form-control" name="short_content" rows="3" placeholder="{{ __('admin.posts.placeholder.short_content') }}" required>{{ $blog->translations->first()?->short_content }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3 mb-0">
                                                <label class="form-label">{{ __('admin.posts.fields.content') }}</label>
                                                <div id="quill-editor-edit" class="mb-3" style="height: 300px;">
                                                    {!! $blog->translations->first()?->content !!}
                                                </div>
                                                <textarea rows="3" class="mb-3 d-none" name="content" id="quill-editor-area-edit">{!! $blog->translations->first()?->content !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row align-items-end justify-content-end g-3">
                                                <div class="col-sm-auto btn-page">
                                                    <button type="submit" class="btn btn-primary">{{ __('admin.posts.actions.submit_update') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
