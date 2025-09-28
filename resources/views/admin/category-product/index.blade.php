@extends('admin.layout.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard.statistics') }}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">{{ __('admin.category_management.title') }}</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title d-flex justify-content-between align-items-center">
                        <h2 class="mb-2">{{ __('admin.category_management.title') }}</h2>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#add-category" class="btn btn-light-primary d-flex align-items-center gap-2">
                            <i class="ti ti-plus"></i> {{ __('admin.category_management.add_category') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.category.product.index') }}" method="get">
        <div class="row align-items-center mb-3">
            <div class="col-12 col-md-3">
                <input type="text" class="form-control" name="name"
                    placeholder="{{ __('admin.category_management.search_placeholder') }}" value="{{ request('name') }}">
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-info">{{ __('admin.layout.search_placeholder') }}</button>
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
                                    <th>ID</th>
                                    <th>{{ __('admin.category_management.category_name') }}</th>
                                    <th>{{ __('admin.category_management.category_icon') }}</th>
                                    <th>{{ __('admin.category_management.subcategory_count') }}</th>
                                    <th>{{ __('admin.category_management.product_count') }}</th>
                                    <th>{{ __('admin.layout.function') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $it)
                                    <tr class="parent-row">
                                        <td>{{ $it->id }}</td>
                                        <td>{{ $it->name_translated }}</td>
                                        <td>
                                            @if($it->icon_url)
                                                <img src="{{ $it->icon_url }}" style="width: 25px; height: 25px" class="blur-up lazyload" alt="">
                                            @else
                                                {{ __('admin.category_management.no_icon') }}
                                            @endif
                                        </td>
                                        <td>{{ $it->categoryChilden ? $it->categoryChilden->count() : __('admin.category_management.no_subcategory') }}
                                        </td>
                                        <td></td>
                                        <td>
                                            <a href="#!" class="avtar avtar-edit avtar-xs btn-link-secondary"
                                                data-id="{{ $it->id }}"
                                                title="{{ __('admin.category_management.edit') }}">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>
                                            <a href="#!" class="avtar avtar-delete avtar-xs btn-link-secondary"
                                                data-name="{{ $it->name_translated }}" data-id="{{ $it->id }}"
                                                title="{{ __('admin.category_management.delete') }}">
                                                <i class="ti ti-trash f-20"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @foreach ($it->categoryChilden as $sub_category)
                                        <tr class="sub-row" style="display:none;">
                                            <td>{{ $sub_category->id }}</td>
                                            <td>{{ $sub_category->name_translated }}</td>
                                            <td></td>
                                            <td>{{ __('admin.category_management.subcategory') }}</td>
                                            <td>{{ $sub_category->products->count() }}</td>
                                            <td>
                                                <a href="#!" class="avtar avtar-edit avtar-xs btn-link-secondary"
                                                    data-id="{{ $sub_category->id }}"
                                                    title="{{ __('admin.category_management.edit') }}">
                                                    <i class="ti ti-edit f-20"></i>
                                                </a>
                                                <a href="#!" class="avtar avtar-delete avtar-xs btn-link-secondary"
                                                    data-name="{{ $sub_category->name_translated }}"
                                                    data-id="{{ $sub_category->id }}"
                                                    title="{{ __('admin.category_management.delete') }}">
                                                    <i class="ti ti-trash f-20"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <p class="text-center">{{ __('admin.category_management.no_category_found') }}
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="ps-5 pe-5">
                            {{ $categories->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-category" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">{{ __('admin.category_management.add_category') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="{{ __('admin.category_management.close') }}"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.category.product.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for=""
                                class="form-lable">{{ __('admin.category_management.category_name') }}</label>
                            <input type="text" class="form-control" name="name"
                                placeholder="{{ __('admin.category_management.enter_category_name') }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for=""
                                class="form-lable">{{ __('admin.category_management.select_level') }}</label>
                            <select class="form-select select-level" name="level" required>
                                <option value="">{{ __('admin.category_management.select_level') }}</option>
                                <option value="1">{{ __('admin.category_management.level_1') }}</option>
                                <option value="2">{{ __('admin.category_management.level_2') }}</option>
                            </select>
                        </div>

                        <div class="mb-3 icon">
                            <label for=""
                                class="form-lable">{{ __('admin.category_management.icon_link') }}</label>
                            <input type="text" class="form-control" name="icon"
                                placeholder="{{ __('admin.category_management.enter_icon_link') }}">
                        </div>

                        <div class="mb-3 select-category-parent" style="display: none">
                            <label for=""
                                class="form-lable">{{ __('admin.category_management.select_parent_category') }}</label>
                            <select class="form-select" name="category_parent">
                                <option value="" selected>
                                    {{ __('admin.category_management.select_parent_category') }}</option>
                                @foreach ($categoriesSelect as $it)
                                    <option value="{{ $it->id }}">{{ $it->name_translated }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class="btn btn-info">{{ __('admin.category_management.add_new') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="dialog-edit"></div>
    <div id="dialog-delete"></div>
    <script>
        document.querySelectorAll('.parent-row').forEach(row => {
            row.addEventListener('dblclick', () => {
                let subRows = row.nextElementSibling;
                while (subRows && subRows.classList.contains('sub-row')) {
                    subRows.style.display = (subRows.style.display === 'none' || subRows.style.display === '') ? 'table-row' : 'none';
                    subRows = subRows.nextElementSibling;
                }
            });
        });

        function OnSelectCategoryParent() {
            document.querySelectorAll('.select-level').forEach((element) => {
                element.addEventListener('change', () => {
                    const value = parseInt(element.value, 10);
                    const parentCategories = document.querySelectorAll('.select-category-parent');
                    const Icon = document.querySelectorAll('.icon');

                    if (value === 2) {
                        parentCategories.forEach((el) => {
                            el.style.display = 'block';
                        });
                        Icon.forEach((i) => {
                            i.style.display = 'none';
                        })
                    } else {
                        parentCategories.forEach((el) => {
                            el.style.display = 'none';
                        });
                        Icon.forEach((i) => {
                            i.style.display = 'block';
                        })
                    }

                })
            })
        }

        document.querySelectorAll('.avtar-edit').forEach((element) => {
            element.addEventListener('click', async () => {
                const id = element.dataset.id;

                if (id) {
                    await getCategoryDetail(id);
                    const modal = new bootstrap.Modal(document.getElementById('edit-category'));
                    modal.show();
                }
            })
        });

        async function getCategoryDetail(id) {
            try {
                let url = '{{ route('admin.category.product.show', ':id') }}'.replace(':id', id);

                const response = await fetch(url, {
                    method: "get",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    alert("{{ __('admin.category_management.error_occurred') }}");
                    return;
                }
                const category = data.category;

                const existingModal = document.getElementById('edit-category');
                if (existingModal) {
                    updateModalContent(category, id);
                } else {
                    createModalContent(category, id);
                }

                OnSelectCategoryParent();
            } catch (error) {
                console.error("Error fetching category details:", error);
                alert("{{ __('admin.category_management.error_occurred') }}");
            }
        }

        function createModalContent(category, id) {
            document.getElementById('dialog-edit').innerHTML = `<div class="modal fade" id="edit-category" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">{{ __('admin.category_management.edit_category') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('admin.category_management.close') }}"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.category.product.update', ':id') }}" method="post" id="edit-category-form">
                        @csrf
                        @method('put') 
                        <div class="mb-3">
                            <label for="" class="form-lable">{{ __('admin.category_management.category_name') }}</label>
                            <input type="text" class="form-control" name="name" placeholder="{{ __('admin.category_management.enter_category_name') }}" value="${category.name || ''}" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">{{ __('admin.category_management.select_level') }}</label>
                            <select class="form-select select-level" name="level" required>
                                <option value="">{{ __('admin.category_management.select_level') }}</option>
                                <option value="1" ${category.level == 1 ? 'selected' : ''}>{{ __('admin.category_management.level_1') }}</option>
                                <option value="2" ${category.level == 2 ? 'selected' : ''}>{{ __('admin.category_management.level_2') }}</option>
                            </select>
                        </div>
                        <div class="mb-3 icon" ${category.level == 1 ? 'style="display: block"' : 'style="display: none"'}>
                            <label for="" class="form-lable">{{ __('admin.category_management.icon_link') }}</label>
                            <input type="text" class="form-control" name="icon" value="${category.icon || ''}" placeholder="{{ __('admin.category_management.enter_icon_link') }}">
                        </div>

                        <div class="mb-3 select-category-parent" ${category.level == 2 ? 'style="display: block"' : 'style="display: none"'}>
                            <label for="" class="form-lable">{{ __('admin.category_management.select_parent_category') }}</label>
                            <select class="form-select" name="category_parent">
                                <option value="0">{{ __('admin.category_management.select_parent_category') }}</option>
                                @foreach ($categoriesSelect as $it)
                                    <option value="{{ $it->id }}" ${category.parent_id == '{{ $it->id }}' ? 'selected' : ''}>{{ $it->name_translated }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-info">{{ __('admin.category_management.update') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>`.replace(':id', id);
        }

        function updateModalContent(category, id) {
            const form = document.querySelector('#edit-category-form');

            form.querySelector('input[name="name"]').value = category.name || '';
            form.querySelector('input[name="icon"]').value = category.icon || '';

            // Cập nhật select level
            const levelSelect = form.querySelector('select[name="level"]');
            for (let i = 0; i < levelSelect.options.length; i++) {
                levelSelect.options[i].selected = levelSelect.options[i].value == category.level;
            }

            // Cập nhật hiển thị select category parent
            const categoryParentDiv = form.querySelector('.select-category-parent');
            const iconDiv = form.querySelector('.icon');
            if (category.level == 2) {
                categoryParentDiv.style.display = 'block';
                iconDiv.style.display = 'none';
            } else {
                categoryParentDiv.style.display = 'none';
                iconDiv.style.display = 'block';
            }

            // Cập nhật giá trị category parent nếu có
            const categoryParentSelect = form.querySelector('select[name="category_parent"]');
            if (categoryParentSelect) {
                for (let i = 0; i < categoryParentSelect.options.length; i++) {
                    categoryParentSelect.options[i].selected = categoryParentSelect.options[i].value == category
                        .parent_id;
                }
            }

            form.action = '{{ route('admin.category.product.update', ':id') }}'.replace(':id', id);
        }

        document.querySelectorAll('.avtar-delete').forEach((element) => {
            element.addEventListener('click', async () => {
                const id = element.dataset.id;
                const name = element.dataset.name;

                if (id) {
                    document.getElementById('dialog-delete').innerHTML = `<div class="modal fade" id="delete-category" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="orderModalLabel">{{ __('admin.category_management.confirm_delete') }}</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('admin.category_management.close') }}"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p>{{ __('admin.category_management.delete_category_confirmation') }} <strong>${name}</strong>?</p>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('admin.category_management.close') }}</button>
                                                                                        <form action="{{ route('admin.category.product.destroy', ':id') }}" method="post">
                                                                                            @csrf
                                                                                            @method('delete')
                                                                                            <button type="submit" class="btn btn-info">{{ __('admin.category_management.delete') }}</button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>`.replace(':id', id);
                    const modal = new bootstrap.Modal(document.getElementById('delete-category'));
                    modal.show();
                }
            });
        });
        OnSelectCategoryParent();
    </script>
@endsection
