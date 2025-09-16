@extends('layout')

@section('content')
<section class="breadcrumb-section pt-0">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-contain">
                    <h2>{{ __('profile.title') }}</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="index.html">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('profile.title') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="checkout-section-2 section-b-space">
    <div class="container-fluid-lg">
        <form action="{{ route('update-profile') }}" method="post">
            @csrf
            <div class="row g-sm-4 g-3">
                <div class="col-lg-12">
                    <div class="left-sidebar-checkout">
                        <div class="checkout-detail-box">
                            <ul>
                                <li>
                                    <div class="checkout-icon">
                                        <lord-icon target=".nav-item" src="https://cdn.lordicon.com/ggihhudh.json"
                                            trigger="loop-on-hover"
                                            colors="primary:#121331,secondary:#646e78,tertiary:#0baf9a" class="lord-icon">
                                        </lord-icon>
                                    </div>
                                    <div class="checkout-box">
                                        <div class="checkout-title">
                                            <h4>{{ __('profile.update') }}</h4>
                                        </div>
                                        <div id="billing-form" class="billing-form">
                                            <div class="row">
                                                @if ($errors->any())
                                                @foreach ($errors->all() as $error)
                                                <div class="text-danger">{{ $error }}</div>
                                                @endforeach
                                                @endif
                                                <div class="col-md-6 col-12 mb-3">
                                                    <label class="form-lable">{{ __('checkout.full_name') }} <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="{{ __('checkout.full_name') }}" name="name" value="{{ old('name') ?? Auth::user()->name }}" required>
                                                </div>

                                                <div class="col-md-6 col-12 mb-3">
                                                    <label class="form-lable">{{ __('checkout.email') }} <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" placeholder="{{ __('checkout.email') }}" name="email" value="{{ old('email') ?? Auth::user()->email }}" required>
                                                </div>

                                                <div class="col-md-6 col-12 mb-3">
                                                    <label class="form-lable">{{ __('checkout.phone_number') }} <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="{{ __('checkout.phone_number') }}" name="phone" value="{{ old('phone') ?? Auth::user()?->phone }}" required>
                                                </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                    <label class="form-lable">{{ __('checkout.province') }} <span class="text-danger">*</span></label>
                                                    <select class="form-select" name="province" id="provinces" required>
                                                        <option value="{{old('province') ? old('province') : (Auth::user()?->province ?? '' )}}" data-id="">{{ old('province') ? old('province') : (Auth::user()?->province ?? __('checkout.select_province')) }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                    <label class="form-lable">{{ __('checkout.district') }} <span class="text-danger">*</span></label>
                                                    <select class="form-select" name="district" id="districts" required>
                                                        <option value="{{old('district') ? old('district') : (Auth::user()?->district ?? '' )}}" data-id="">{{ old('district') ? old('district') : (Auth::user()?->district ?? __('checkout.select_district')) }}</option>
                                                    </select>
                                                </div>


                                                <div class="col-md-6 col-12 mb-3">
                                                    <label class="form-lable">{{ __('checkout.ward') }} <span class="text-danger">*</span></label>
                                                    <select class="form-select" name="ward" id="wards" required>
                                                        <option value="{{old('ward') ? old('ward') : (Auth::user()?->ward ?? '' )}}" data-id="">{{ old('ward') ? old('ward') : (Auth::user()?->ward ?? __('checkout.select_ward')) }}</option>
                                                    </select>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label class="form-lable">{{ __('checkout.address') }} <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="{{ __('checkout.address') }}" name="address" value="{{ old('address') ?? Auth::user()?->address }}" required>
                                                </div>

                                                <div class="col-12">
                                                    <button type="submit" class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold">{{ __('profile.btnUpdate')}}</button>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
</section>
<script>
    async function getProvinces() {
        try {
            const response = await fetch('https://provinces.open-api.vn/api/p/', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                }
            });
            const data = await response.json();
            let provinceList = '<option value="{{old('province') ? old('province') : (Auth::user()?->province ?? '' )}}" data-id="">{{ old('province') ? old('province') : (Auth::user()?->province ?? __('checkout.select_province')) }}</option>';
            data.forEach(it => {
                provinceList += `<option value="${it.name}" data-id="${it.code}">${it.name}</option>`;
            });

            document.getElementById('provinces').innerHTML = provinceList;
        } catch (e) {
            console.log('error', e);
        }
    }
    document.getElementById('provinces').addEventListener('change', async function() {
        let selectedOption = this.options[this.selectedIndex];

        let provinceId = selectedOption.getAttribute('data-id');
        if (provinceId) {
            try {
                const response = await fetch(`https://provinces.open-api.vn/api/p/${provinceId}?depth=2`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                const data = await response.json();


                let districtList = '<option value="" data-id="">{{ __('checkout.select_district') }}</option>';
                data.districts.forEach(it => {
                    districtList += `<option value="${it.name}" data-id="${it.code}">${it.name}</option>`;
                });

                document.getElementById('districts').innerHTML = districtList;
            } catch (e) {
                console.log('error', e);
            }
        }

    });

    document.getElementById('districts').addEventListener('change', async function() {
        let selectedOption = this.options[this.selectedIndex];

        let provinceId = selectedOption.getAttribute('data-id');
        if (provinceId) {
            try {
                const response = await fetch(`https://provinces.open-api.vn/api/d/${provinceId}?depth=2`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                    }
                });
                const data = await response.json();

                let wardList = '<option value="" data-id="">{{ __('checkout.select_ward') }}</option>';
                data.wards.forEach(it => {
                    wardList += `<option value="${it.name}" data-id="${it.code}">${it.name}</option>`;
                });

                document.getElementById('wards').innerHTML = wardList;
            } catch (e) {
                console.log('error', e);
            }
        }

    });
    getProvinces();
</script>
@endsection