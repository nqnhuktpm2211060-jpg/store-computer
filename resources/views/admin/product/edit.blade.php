@extends('admin.layout.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard.statistics') }}</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.products.index') }}">{{ __('admin.product_management.title') }}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">{{ __('admin.product_management.title_edit') }}</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">{{ __('admin.product_management.title_edit') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row g-3">
                            <div class="col-sm-6 col-xl-6">
                                <div class="mb-3 mb-0">
                                    <label class="form-label">{{ __('admin.product_management.fields.name') }}</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="{{ __('admin.product_management.placeholders.name') }}" required
                                        value="{{ $product->name_translated }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-6">
                                <div class="mb-3 mb-0">
                                    <label class="form-label">{{ __('admin.product_management.fields.language') }}</label>
                                    <select name="language" class="form-select" id="select-language" required>
                                        <option value="">{{ __('admin.product_management.placeholders.language') }}
                                        </option>
                                        @foreach ($languages as $lang)
                                            <option value="{{ $lang->code }}"
                                                {{ (request()->language ?? app()->getLocale()) == $lang->code ? 'selected' : '' }}>
                                                {{ $lang->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-6">
                                <div class="mb-3 mb-0">
                                    <label class="form-label">{{ __('admin.product_management.fields.price') }}</label>
                                    <input type="text" name="price" class="form-control money"
                                        placeholder="{{ __('admin.product_management.placeholders.price') }}" required
                                        value="{{ $product->price }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-6">
                                <div class="mb-3 mb-0">
                                    <label
                                        class="form-label">{{ __('admin.product_management.fields.discounted_price') }}</label>
                                    <input type="text" class="form-control money"
                                        placeholder="{{ __('admin.product_management.placeholders.discounted_price') }}"
                                        value="{{ $product->sale_price }}" name="sale_price">

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
                                        <input type="file" id="file-upload" name="images[]" style="display: none"
                                            accept="image/*" multiple>
                                    </div>
                                    <div class="d-flex" id="product-images">

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-6">
                                <div class="mb-3 mb-0">
                                    <label
                                        class="form-label">{{ __('admin.product_management.fields.stock_quantity') }}</label>
                                    <input type="text" name="stock_quantity" class="form-control"
                                        placeholder="{{ __('admin.product_management.placeholders.stock_quantity') }}"
                                        required value="{{ $product->stock_quantity }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-6">
                                <div class="mb-3 mb-0">
                                    <label class="form-label">{{ __('admin.product_management.fields.category') }}</label>
                                    <select name="category_id" class="form-select" id="" required>
                                        @foreach ($categories as $it)
                                            @if ($product->category_id == $it->id)
                                                <option value="{{ $it->id }}" selected>{{ $it->name }}
                                                </option>
                                            @else
                                                <option value="{{ $it->id }}">{{ $it->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="border rounded p-3 h-100">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <p class="mb-0 f-18">
                                            {{ __('admin.product_management.fields.title_characteristics') }}</p>
                                        <label class="custom-file-upload" id="add-characteristics">
                                            <i class="fas fa-plus"></i>
                                            {{ __('admin.product_management.actions.add_characteristic') }}
                                        </label>
                                    </div>
                                    <div class="" id="product-characteristics">

                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3 mb-0">
                                    <label
                                        class="form-label">{{ __('admin.product_management.fields.short_description') }}</label>
                                    <textarea class="form-control" name="short_description" rows="3"
                                        placeholder="{{ __('admin.product_management.placeholders.short_description') }}" required>{{ $product->short_description_translated }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">{{ __('admin.product_management.fields.description') }}</label>
                                <div id="quill-editor" class="mb-3" style="height: 300px;">
                                    {!! $product->description_translated !!}
                                </div>
                                <textarea rows="3" class="mb-3 d-none" name="description" placeholder="{{ __('admin.product_management.placeholders.description') }}" id="quill-editor-area"></textarea>
                            
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-items-end justify-content-end g-3">
                                <div class="col-sm-auto btn-page">
                                    <button type="submit"
                                        class="btn btn-primary">{{ __('admin.product_management.actions.submit_update') }}</button>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
    let images = <?php echo json_encode($product->images ?? []); ?>;
    let characteristics = <?php echo json_encode($product->characteristics_translated ?? []); ?>;
        let indexCharacteristics = 0
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

        document.getElementById('select-language').addEventListener('change', function(event) {
            const language = event.target.value;
            const url = "{{route('admin.products.edit', $product->id)}}?language=" + language;
            
            window.location.href = url;
        })
        document.getElementById('file-upload').addEventListener('change', function(event) {
            var files = event.target.files;

            const previewContainer = document.getElementById('product-images');
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


        function showImage(images) {
            let listImages = '';
            images.forEach((fileName) => {
                const url = `${window.location.origin}/uploads/products/${fileName}`;
                listImages += `<div style="width: 120px; position: relative" class="me-3 mb-3">
                            <img src="${url}" width="100%" style="border: 1px solid rgb(0, 247, 255)" alt="image product">
                        </div>`;
            });

            const productImagesElement = document.getElementById('product-images');

            productImagesElement.innerHTML = listImages;
        }
        // Note: Image deletion for JSON-based images is not implemented here to keep changes minimal.
        function showCharacteristics(characteristics) {
            listCharacteristics = '';
            characteristics.forEach((it, index) => {
                listCharacteristics += `<div class="row justify-content-between mb-3">
                                                            <div class="col-6 d-flex align-items-center">
                                                                <label for="" style="min-width: 95px" class="me-3">{{ __('admin.product_management.fields.name_characteristics') }}</label>
                                                                <input type="text" class="form-control" name="characteristics[${index}][name]" value="${it.name}"
                                                                    placeholder="{{ __('admin.product_management.placeholders.name_characteristics') }}" required>
                                                            </div>
                                                            <div class="col-5 d-flex align-items-center">
                                                                <label for="" style="min-width: 45px" class="me-3">{{ __('admin.product_management.fields.description_characteristics') }}</label>
                                                                <input type="text" class="form-control"
                                                                    name="characteristics[${index}][description]" placeholder="{{ __('admin.product_management.placeholders.description_characteristics') }}" value="${it.description}" required>
                                                            </div>
                                                            <div class="col-1 text-end mt-2">
                                                                <button type="button"
                                                                    class="btn btn-sm remove-characteristics" data-id="${it.id}"><i
                                                                        class="ti ti-trash text-danger f-20"></i></button>
                                                            </div>
                                                        </div>`;
                indexCharacteristics++;
            });

            document.getElementById('product-characteristics').innerHTML = listCharacteristics;
        }

        document.getElementById('add-characteristics').addEventListener('click', () => {
            const container = document.getElementById('product-characteristics');

            const newColor = document.createElement('div');
            newColor.className = 'row justify-content-between mb-3';

            newColor.innerHTML = `
                <div class="col-6 d-flex align-items-center">
                                                                <label for="" style="min-width: 95px" class="me-3">{{ __('admin.product_management.fields.name_characteristics') }}</label>
                                                                <input type="text" class="form-control" name="characteristics[${indexCharacteristics}][name]"
                                                                    placeholder="{{ __('admin.product_management.placeholders.name_characteristics') }}" required>
                                                            </div>
                                                            <div class="col-5 d-flex align-items-center">
                                                                <label for="" style="min-width: 45px" class="me-3">{{ __('admin.product_management.fields.description_characteristics') }}</label>
                                                                <input type="text" class="form-control"
                                                                    name="characteristics[${indexCharacteristics}][description]" placeholder="{{ __('admin.product_management.placeholders.description_characteristics') }}" required>
                                                            </div>
                                                            <div class="col-1 text-end mt-2">
                                                                <button type="button" class="btn btn-sm remove-characteristics"><i class="ti ti-trash text-danger f-20"></i></button>
                                                            </div>
            `;

            container.appendChild(newColor);

            indexCharacteristics++;
        });

        document.getElementById('product-characteristics').addEventListener('click', (e) => {
            if (e.target.closest('.remove-characteristics')) {
                e.target.closest('.row').remove();
            }

        });

    showImage(images);
    showCharacteristics(characteristics);
    </script>
@endsection
