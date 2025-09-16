@extends('admin.layout.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard.statistics') }}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">{{ __('admin.product_management.title') }}</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title d-flex justify-content-between align-items-center">
                        <h2 class="mb-2">{{ __('admin.product_management.list') }}</h2>
                        <button data-bs-toggle="modal" data-bs-target="#add-product"
                            class="btn btn-light-primary d-flex align-items-center gap-2">
                            <i class="ti ti-plus"></i> {{ __('admin.product_management.add') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.products.index') }}" method="get">
        <div class="row align-items-center mb-3">
            <div class="col-12 col-md-3">
                <input type="text" class="form-control" name="name" placeholder="{{ __('admin.product_management.search_by_name') }}"
                    value="{{ request('name') }}">
            </div>

            <div class="col-3">
                <button type="submit" class="btn btn-info">{{ __('admin.product_management.search') }}</button>
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
                                    <th>ID</th>
                                    <th>{{ __('admin.product_management.table.name') }}</th>
                                    <th>{{ __('admin.product_management.table.image') }}</th>
                                    <th>{{ __('admin.product_management.table.price') }}</th>
                                    <th>{{ __('admin.product_management.table.discounted_price') }}</th>
                                    <th>{{ __('admin.product_management.table.stock_quantity') }}</th>
                                    <th>{{ __('admin.product_management.table.sold') }}</th>
                                    <th>{{ __('admin.product_management.table.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name_translated }}</td>
                                        <td>
                                            <img src="{{ $product->images[0] ? $product->images[0]->image_path : '#' }}"
                                                width="60px" alt="{{ __('admin.product_management.table.product_image') }}">
                                        </td>
                                        <td>{{ number_format($product->price, 0, '.', ',') }} đ</td>
                                        <td>{{ number_format($product->sale_price, 0, '.', ',') }} đ</td>
                                        <td>{{ $product->stock_quantity }}</td>
                                        <td>{{ $product->total_purchases }}</td>
                                        <td>
                                            <a href="{{ route('product.detail', $product->id) }}"
                                                class="avtar avtar-details avtar-xs btn-link-secondary"
                                                title="{{ __('admin.product_management.table.view_detail') }}">
                                                <i class="ti ti-eye f-20"></i>
                                            </a>
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                                class="avtar avtar-change avtar-xs btn-link-secondary"
                                                data-id="{{ $product->id }}" title="{{ __('admin.product_management.table.update_status') }}">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>
                                            <a href="#!" class="avtar avtar-delete avtar-xs btn-link-secondary"
                                                data-name="{{ $product->name_translated }}" data-id="{{ $product->id }}"
                                                title="{{ __('admin.product_management.table.delete_order') }}">
                                                <i class="ti ti-trash f-20"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">
                                            <p class="text-center">{{ __('admin.product_management.table.no_orders') }}</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="ps-5 pe-5">
                            {{ $products->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="dialog-delete"></div>
    <div class="modal fade" id="add-product" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">{{ __('admin.product_management.modal.title_add') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.products.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-sm-6 col-xl-6">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">{{ __('admin.product_management.fields.name') }}</label>
                                                    <input type="text" class="form-control" name="name" placeholder="{{ __('admin.product_management.placeholders.name') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-6">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">{{__('admin.product_management.fields.language')}}</label>
                                                    <select name="language" class="form-select" id=""
                                                        required>
                                                        <option value="">{{__('admin.product_management.placeholders.language')}}</option>
                                                        @foreach ($languages as $lang)
                                                            <option value="{{ $lang->code }}">{{ $lang->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-6">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">{{ __('admin.product_management.fields.price') }}</label>
                                                    <input type="text" name="price" class="form-control money" placeholder="{{ __('admin.product_management.placeholders.price') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-6">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">{{ __('admin.product_management.fields.discounted_price') }}</label>
                                                    <input type="text" class="form-control money" placeholder="{{ __('admin.product_management.placeholders.discounted_price') }}" name="sale_price">

                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="border rounded p-3 h-100">
                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                        <p class="mb-0 f-18">{{ __('admin.product_management.fields.image') }}</p>
                                                        <label for="file-upload" class="custom-file-upload">
                                                            <i class="fas fa-upload"></i>
                                                            {{ __('admin.product_management.actions.upload_image') }}
                                                        </label>
                                                        <input type="file" id="file-upload" name="images[]"
                                                            style="display: none" accept="image/*" multiple required>
                                                    </div>
                                                    <div class="d-flex" id="product-images">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-6">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">{{ __('admin.product_management.fields.stock_quantity') }}</label>
                                                    <input type="text" name="stock_quantity" class="form-control" placeholder="{{ __('admin.product_management.placeholders.stock_quantity') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-6">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">{{__('admin.product_management.fields.category')}}</label>
                                                    <select name="category_id" class="form-select" id=""
                                                        required>
                                                        <option value="">{{__('admin.product_management.placeholders.category')}}</option>
                                                        @foreach ($categories as $it)
                                                            <option value="{{ $it->id }}">{{ $it->name_translated }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="border rounded p-3 h-100">
                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                        <p class="mb-0 f-18">{{ __('admin.product_management.fields.title_characteristics') }}</p>
                                                        <label class="custom-file-upload" id="add-characteristics">
                                                            <i class="fas fa-plus"></i>
                                                            {{ __('admin.product_management.actions.add_characteristic') }}
                                                        </label>
                                                    </div>
                                                    <div class="" id="product-characteristics">
                                                        <div class="row justify-content-between mb-3">
                                                            <div class="col-6 d-flex align-items-center">
                                                                <label for="" style="min-width: 95px"
                                                                    class="me-3">{{ __('admin.product_management.fields.name_characteristics') }}</label>
                                                                <input type="text" class="form-control"
                                                                    name="characteristics[0][name]"
                                                                    placeholder="{{ __('admin.product_management.placeholders.name_characteristics') }}" required>
                                                            </div>
                                                            <div class="col-5 d-flex align-items-center">
                                                                <label for="" style="min-width: 45px"
                                                                    class="me-3">{{ __('admin.product_management.fields.description_characteristics') }}</label>
                                                                <input type="text" class="form-control"
                                                                    name="characteristics[0][description]"
                                                                    placeholder="{{ __('admin.product_management.placeholders.description_characteristics') }}" required>
                                                            </div>
                                                            <div class="col-1 text-end mt-2">
                                                                <button type="button"
                                                                    class="btn btn-sm remove-characteristics"><i
                                                                        class="ti ti-trash text-danger f-20 remove-characteristics"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">{{ __('admin.product_management.fields.short_description') }}</label>
                                                    <textarea class="form-control" name="short_description" rows="3" placeholder="{{ __('admin.product_management.placeholders.short_description') }}" required></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">{{ __('admin.product_management.fields.description') }}</label>
                                                    <div id="quill-editor" class="mb-3" style="height: 300px;">
                                                    </div>
                                                    <textarea rows="3" class="mb-3 d-none" name="description" placeholder="{{ __('admin.product_management.placeholders.description') }}" id="quill-editor-area"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row align-items-end justify-content-end g-3">
                                                    <div class="col-sm-auto btn-page">
                                                        <button type="submit" class="btn btn-primary">{{ __('admin.product_management.actions.submit_add') }}</button>
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
    
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        let colorIndex = 1;
        document.addEventListener('DOMContentLoaded', function() {
            quill('quill-editor-area', '#quill-editor')
        });
        function quill(idEditorErea, idEditor){
            if (document.getElementById(idEditorErea)) {
                var editor = new Quill(idEditor, {
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

                            fetch('{{route('upload.image.product')}}', {
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
                                    editor.insertEmbed(range.index, 'image',
                                    url);
                                })
                                .catch(error => console.error('Error uploading image:', error));
                        }
                    };
                });
                var quillEditor = document.getElementById(idEditorErea);
                editor.on('text-change', function() {
                    quillEditor.value = editor.root.innerHTML;
                });
                quillEditor.addEventListener('input', function() {
                    editor.root.innerHTML = quillEditor.value;
                });
            }
        }
        document.getElementById('file-upload').addEventListener('change', function(event) {
            var files = event.target.files;

            const previewContainer = document.getElementById('product-images');
            previewContainer.innerHTML = '';

            Array.from(files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const wrapper = document.createElement('div');
                        wrapper.style.width = '120px';
                        wrapper.style.position = 'relative';
                        wrapper.className = 'me-3 mb-3';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'ảnh sản phẩm';
                        img.style.width = '100%';
                        img.style.border = '1px solid rgb(0, 247, 255)';

                        const deleteBtn = document.createElement('a');
                        deleteBtn.href = 'javascript:void(0);';
                        deleteBtn.className = 'btn-pc-default btn-delete-image f-18';
                        deleteBtn.style.position = 'absolute';
                        deleteBtn.style.top = '-14px';
                        deleteBtn.style.right = '-4px';
                        deleteBtn.innerText = 'x';
                        deleteBtn.dataset.index = index;

                        deleteBtn.addEventListener('click', () => {
                            wrapper.remove();
                        });

                        wrapper.appendChild(img);
                        wrapper.appendChild(deleteBtn);
                        previewContainer.appendChild(wrapper);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        document.querySelectorAll('.avtar-delete').forEach((element) => {
            element.addEventListener('click', async () => {
                const id = element.dataset.id;
                const name = element.dataset.name;

                if (id) {
                    document.getElementById('dialog-delete').innerHTML = `<div class="modal fade" id="delete-product" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="orderModalLabel">{{__('admin.product_management.modal.title_delete')}}</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p>{{__('admin.product_management.modal.content_delete')}}: <strong>${name}</strong> không?</p>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('admin.product_management.modal.close')}}</button>
                                                                                        <form action="{{ route('admin.products.destroy', ':id') }}" method="post">
                                                                                            @csrf
                                                                                            @method('delete')
                                                                                            <button type="submit" class="btn btn-info">{{__('admin.product_management.actions.submit_delete')}}</button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>`.replace(':id', id);
                    const modal = new bootstrap.Modal(document.getElementById('delete-product'));
                    modal.show();
                }
            })
        });

        document.getElementById('add-characteristics').addEventListener('click', () => {
            const container = document.getElementById('product-characteristics');

            const newColor = document.createElement('div');
            newColor.className = 'row justify-content-between mb-3';

            newColor.innerHTML = `
                <div class="row justify-content-between mb-3">
                    <div class="col-6 d-flex align-items-center">
                                                                <label for="" style="min-width: 95px" class="me-3">{{__('admin.product_management.fields.name_characteristics')}}</label>
                                                                <input type="text" class="form-control" name="characteristics[${colorIndex}][name]"
                                                                    placeholder="{{__('admin.product_management.placeholders.name_characteristics')}}" required>
                                                            </div>
                                                            <div class="col-5 d-flex align-items-center">
                                                                <label for="" style="min-width: 45px" class="me-3">{{__('admin.product_management.fields.description_characteristics')}}</label>
                                                                <input type="text" class="form-control"
                                                                    name="characteristics[${colorIndex}][description]" placeholder="{{__('admin.product_management.placeholders.description_characteristics')}}" required>
                                                            </div>
                                                            <div class="col-1 text-end mt-2">
                                                                <button type="button" class="btn btn-sm remove-characteristics"><i class="ti ti-trash text-danger f-20 remove-characteristics"></i></button>
                                                            </div>
                                                        </div>
            `;

            container.appendChild(newColor);

            colorIndex++;
        })
        document.getElementById('product-characteristics').addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-characteristics')) {
                e.target.closest('.row').remove();
            }
        });
    </script>
@endsection
