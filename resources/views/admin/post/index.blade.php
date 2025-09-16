@extends('admin.layout.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">{{ __('admin.posts.breadcrumb_dashboard') }}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">{{ __('admin.posts.breadcrumb_manage') }}</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2">{{ __('admin.posts.title') }}</h2>
                        <button data-bs-toggle="modal" data-bs-target="#add-post"
                            class="btn btn-light-primary d-flex align-items-center gap-2">
                            <i class="ti ti-plus"></i>
                            {{ __('admin.posts.add_post') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.posts.index') }}" method="get">
        <div class="row align-items-center mb-3">
            <div class="col-12 col-md-3">
                <input type="text" class="form-control" name="title"
                    placeholder="{{ __('admin.posts.search_placeholder') }}" value="{{ request('title') }}">
            </div>

            <div class="col-3">
                <button type="submit" class="btn btn-info">{{ __('admin.posts.search_button') }}</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table class="table table-hover text-center table-fixed" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>{{ __('admin.posts.table.id') }}</th>
                                    <th>{{ __('admin.posts.table.title') }}</th>
                                    <th>{{ __('admin.posts.table.image') }}</th>
                                    <th>{{ __('admin.posts.table.short_content') }}</th>
                                    <th>{{ __('admin.posts.table.category') }}</th>
                                    <th>{{ __('admin.posts.table.author') }}</th>
                                    <th>{{ __('admin.posts.table.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $it)
                                    <tr>
                                        <td>{{ $it->id }}</td>
                                        <td>{{ $it->title_translated }}</td>
                                        <td><img src="{{ $it->image }}" width="60px" alt=""></td>
                                        <td>{{ $it->short_content }}</td>
                                        <td>
                                            @foreach (json_decode($it->sub_categories_translated, true) as $ca)
                                                <button class="btn btn-info">{{ $ca }}</button>
                                            @endforeach
                                        </td>
                                        <td>{{ $it->user ? $it->user->name : $it->user_id }}</td>
                                        <td>
                                            <a href="{{ route('blog.detail', $it->slug_translated) }}"
                                                class="avtar avtar-details avtar-xs btn-link-secondary"
                                                title="{{ __('admin.posts.actions.view') }}">
                                                <i class="ti ti-eye f-20"></i>
                                            </a>
                                            <a href="#!" class="avtar avtar-edit avtar-xs btn-link-secondary"
                                                data-id="{{ $it->id }}"
                                                title="{{ __('admin.posts.actions.edit') }}">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>
                                            <a href="#!" class="avtar avtar-delete avtar-xs btn-link-secondary"
                                                data-title="{{ $it->title }}" data-id="{{ $it->id }}"
                                                title="{{ __('admin.posts.actions.delete') }}">
                                                <i class="ti ti-trash f-20"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <p class="text-center">{{ __('admin.posts.empty') }}</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="ps-5 pe-5">
                            {{ $posts->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-post" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">{{ __('admin.posts.modal.title_add') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="{{ __('admin.posts.modal.close') }}"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.posts.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">{{ __('admin.posts.fields.title') }}</label>
                                                    <input type="text" class="form-control" name="title"
                                                        placeholder="{{ __('admin.posts.placeholder.title') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-6">
                                                <div class="mb-3 mb-0">
                                                    <label
                                                        class="form-label">{{ __('admin.product_management.fields.language') }}</label>
                                                    <select name="language" class="form-select" id="" required>
                                                        <option value="">
                                                            {{ __('admin.product_management.placeholders.language') }}
                                                        </option>
                                                        @foreach ($languages as $lang)
                                                            <option value="{{ $lang->code }}">{{ $lang->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="border rounded p-3 h-100">
                                                    <div
                                                        class="d-flex flex-column align-items-center justify-content-center mb-2">
                                                        <p class="mb-0 f-16">{{ __('admin.posts.fields.image') }}</p>
                                                        <label for="file-upload" class="custom-file-upload">
                                                            <i class="fas fa-upload"></i>
                                                            {{ __('admin.posts.actions.upload_image') }}
                                                        </label>
                                                        <input type="file" id="file-upload" name="image"
                                                            style="display: none" accept="image/*" required>
                                                        <div class="text-center mt-4" id="product-images"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3 mb-0">
                                                    <label
                                                        class="form-label">{{ __('admin.posts.fields.category') }}</label>
                                                    <input name="categories" class="form-control" id="category_add"
                                                        placeholder="{{ __('admin.posts.placeholder.category') }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3 mb-0">
                                                    <label
                                                        class="form-label">{{ __('admin.posts.fields.short_content') }}</label>
                                                    <textarea class="form-control" name="short_content" rows="3"
                                                        placeholder="{{ __('admin.posts.placeholder.short_content') }}" required></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3 mb-0">
                                                    <label
                                                        class="form-label">{{ __('admin.posts.fields.content') }}</label>
                                                    <div id="quill-editor" class="mb-3" style="height: 300px;">
                                                    </div>
                                                    <textarea rows="3" class="mb-3 d-none" name="content"
                                                        placeholder="{{ __('admin.posts.placeholders.content') }}" id="quill-editor-area"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row align-items-end justify-content-end g-3">
                                                    <div class="col-sm-auto btn-page">
                                                        <button type="submit"
                                                            class="btn btn-primary">{{ __('admin.posts.actions.submit_add') }}</button>
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


    <div id="dialog-edit"></div>
    <div id="dialog-delete"></div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            quill('quill-editor-area', '#quill-editor');
        });

        // Biến toàn cục để lưu trữ instance editor
        let quillEditorInstance = null;
        let tagifyInstances = {};

        function quill(idEditorErea, idEditor) {
            if (!document.getElementById(idEditorErea)) {
                return null;
            }

            const editor = new Quill(idEditor, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{
                            'font': []
                        }],
                        [{
                            'size': ['small', false, 'large', 'huge']
                        }],
                        [{
                            'color': []
                        }, {
                            'background': []
                        }],
                        [{
                            'header': [1, 2, false]
                        }],
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ]
                }
            });

            editor.getModule('toolbar').addHandler('image', function() {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.click();

                input.onchange = function() {
                    var file = input.files[0];
                    if (file) {
                        var formData = new FormData();
                        formData.append('image', file);

                        fetch('{{ route('upload.image.blog') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData
                            })
                            .then(response => response.json())
                            .then(result => {
                                const url = result.url;
                                const range = editor.getSelection();
                                editor.insertEmbed(range.index, 'image', url);
                            })
                            .catch(error => console.error('Error uploading image:', error));
                    }
                };
            });

            const quillEditor = document.getElementById(idEditorErea);
            editor.on('text-change', function() {
                quillEditor.value = editor.root.innerHTML;
            });

            quillEditor.addEventListener('input', function() {
                editor.root.innerHTML = quillEditor.value;
            });

            return editor; // Trả về instance của editor
        }

        function tagify(id) {
            const input = document.getElementById(id);
            if (!input) return null;

            const tagifyInstance = new Tagify(input, {
                delimiters: ",|Enter",
                maxTags: 10,
                placeholder: "Nhập danh mục và nhấn Enter",
                whitelist: [],
                dropdown: {
                    maxItems: 5,
                    enabled: 1,
                    closeOnSelect: true
                }
            });

            tagifyInstances[id] = tagifyInstance;

            return tagifyInstance;
        }

        function uploadFileEdit() {
            const fileUpload = document.getElementById('file-upload-edit');
            if (!fileUpload) return;

            fileUpload.addEventListener('change', function(event) {
                const file = event.target.files[0];
                const previewContainer = document.getElementById('product-images-edit');

                if (!previewContainer) return;
                previewContainer.innerHTML = '';

                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'ảnh sản phẩm';
                        img.style.width = '50%';
                        img.style.border = '1px solid rgb(0, 247, 255)';
                        img.style.borderRadius = '6px';

                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        document.querySelectorAll('.avtar-edit').forEach((element) => {
            element.addEventListener('click', async () => {
                const id = element.dataset.id;

                if (id) {
                    const response = await fetch('{{ route('admin.posts.edit', ':id') }}'.replace(
                        ':id', id), {
                        method: "GET",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const data = await response.text();
                    if (!response.ok) {
                        alert('{{ __('admin.posts.error_occurred') }}', data.message);
                        return;
                    }
                    document.getElementById('dialog-edit').innerHTML = data;
                    await tagify('categories_edit');
                    await uploadFileEdit();
                    quillEditorInstance = await quill('quill-editor-area-edit', '#quill-editor-edit');
                    const modal = new bootstrap.Modal(document.getElementById('edit-post'));
                    modal.show();

                    setupLanguageChangeHandler(id);
                }
            });
        });

        function setupLanguageChangeHandler(postId) {
            const selectLanguage = document.getElementById('select-language');

            const newSelect = selectLanguage.cloneNode(true);
            selectLanguage.parentNode.replaceChild(newSelect, selectLanguage);

            newSelect.addEventListener('change', async function(event) {
                const language = event.target.value;

                if (language) {
                    try {
                        const cacheBuster = new Date().getTime();
                        const url = '{{ route('admin.posts.show', ':id') }}'
                            .replace(':id', postId) +
                            '?language=' + language +
                            '&_=' + cacheBuster;


                        const response = await fetch(url);

                        if (!response.ok) {
                            console.error("API trả về lỗi");
                            alert('{{ __('admin.posts.error_occurred') }}', "Lỗi khi lấy dữ liệu");
                            return;
                        }

                        const blogData = await response.json();
                        console.log("Dữ liệu nhận được:", blogData);

                        let blog;
                        if (Array.isArray(blogData) && blogData.length > 0) {
                            blog = blogData[0];
                        } else {
                            blog = blogData;
                        }

                        const form = document.querySelector('#edit-blog-form');

                        const hasTranslations = blog && blog.translations && blog.translations.length > 0;

                        if (form) {
                            if (hasTranslations) {
                                const translation = blog.translations[0];
                                form.querySelector('input[name="title"]').value = translation.title || '';

                                form.querySelector('textarea[name="short_content"]').value = translation
                                    .short_content || '';

                                const categoriesInput = form.querySelector('input[name="categories"]');
                                categoriesInput.value = translation.sub_categories || '';

                                const tagifyElement = categoriesInput.nextElementSibling;
                                if (tagifyElement && tagifyElement.classList.contains('tagify')) {
                                    const event = new Event('change', {
                                        bubbles: true
                                    });
                                    categoriesInput.dispatchEvent(event);
                                }

                                const newContent = translation.content || '';

                                const quillEditor = document.querySelector('#quill-editor-edit');
                                if (quillEditor && quillEditor.querySelector('.ql-editor')) {
                                    quillEditor.querySelector('.ql-editor').innerHTML = newContent;

                                    const hiddenTextarea = document.getElementById('quill-editor-area-edit');
                                    if (hiddenTextarea) {
                                        hiddenTextarea.value = newContent;
                                    }
                                }
                            } else {
                                const titleInput = form.querySelector('input[name="title"]');
                                if (titleInput) titleInput.value = '';

                                const shortContentInput = form.querySelector('textarea[name="short_content"]');
                                if (shortContentInput) shortContentInput.value = '';

                                const categoriesInput = form.querySelector('input[name="categories"]');
                                if (categoriesInput) categoriesInput.value = '';

                                const quillEditor = document.querySelector('#quill-editor-edit');
                                if (quillEditor && quillEditor.querySelector('.ql-editor')) {
                                    quillEditor.querySelector('.ql-editor').innerHTML = '';

                                    const hiddenTextarea = document.getElementById('quill-editor-area-edit');
                                    if (hiddenTextarea) hiddenTextarea.value = '';
                                }
                            }
                        }
                    } catch (error) {
                        console.error("Lỗi xử lý:", error);
                        alert('{{ __('admin.posts.error_occurred') }}', error.message);
                    }
                }
            });
        }

        document.querySelectorAll('.avtar-delete').forEach((element) => {
            element.addEventListener('click', async () => {
                const id = element.dataset.id;
                const title = element.dataset.title;

                if (!id) return;

                document.getElementById('dialog-delete').innerHTML = `<div class="modal fade" id="delete-post" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="orderModalLabel">{{ __('admin.posts.modal.title_delete') }}</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>{{ __('admin.posts.modal.content_delete') }}: <strong>${title}</strong></p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('admin.posts.modal.close') }}</button>
                                                                        <form action="{{ route('admin.posts.destroy', ':id') }}" method="post">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button type="submit" class="btn btn-info">{{ __('admin.posts.actions.submit_delete') }}</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>`.replace(':id', id);
                const modal = new bootstrap.Modal(document.getElementById('delete-post'));
                modal.show();
            });
        });

        tagify('category_add');

        document.getElementById('file-upload')?.addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('product-images');

            if (!previewContainer) return;
            previewContainer.innerHTML = '';

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'ảnh sản phẩm';
                    img.style.width = '50%';
                    img.style.border = '1px solid rgb(0, 247, 255)';
                    img.style.borderRadius = '6px';

                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
