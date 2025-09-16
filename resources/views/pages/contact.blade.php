@extends('layout')

@section('title', __('contact.contact_us'))
@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>{{ __('contact.contact_us') }}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('contact.contact_us') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-box-section">
        <div class="container-fluid-lg">
            <div class="row g-lg-5 g-3">
                <div class="col-lg-6">
                    <div class="left-sidebar-box">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="contact-image">
                                    <img src="../assets/images/inner-page/contact-us.png"
                                        class="img-fluid blur-up lazyloaded" alt="">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="contact-title">
                                    <h3>{{ __('contact.get_in_touch') }}</h3>
                                </div>
    
                                <div class="contact-detail">
                                    <div class="row g-4">
                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-phone"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>{{ __('contact.phone') }}</h4>
                                                </div>
    
                                                <div class="contact-detail-contain">
                                                    <p>(+84) 973.454.140</p>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>{{ __('contact.email') }}</h4>
                                                </div>
    
                                                <div class="contact-detail-contain">
                                                    <p>{{__('footer.email')}}</p>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>{{ __('contact.address') }}</h4>
                                                </div>
    
                                                <div class="contact-detail-contain">
                                                    <p>{{ __('contact.address_detail') }}</p>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-building"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>{{ __('contact.office') }}</h4>
                                                </div>
    
                                                <div class="contact-detail-contain">
                                                    <p>Visitación de la Encina 22</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-6">
                    <div class="title d-xxl-none d-block">
                        <h2>{{ __('contact.contact_us') }}</h2>
                    </div>
                    <div class="right-sidebar-box">
                        <div class="row">
                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="exampleFormControlInput" class="form-label">{{ __('contact.first_name') }}</label>
                                    <div class="custom-input">
                                        <input type="text" class="form-control" id="exampleFormControlInput"
                                            placeholder="{{ __('contact.enter_first_name') }}">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="exampleFormControlInput1" class="form-label">{{ __('contact.last_name') }}</label>
                                    <div class="custom-input">
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="{{ __('contact.enter_last_name') }}">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="exampleFormControlInput2" class="form-label">{{ __('contact.email_address') }}</label>
                                    <div class="custom-input">
                                        <input type="email" class="form-control" id="exampleFormControlInput2"
                                            placeholder="{{ __('contact.enter_email_address') }}">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="exampleFormControlInput3" class="form-label">{{ __('contact.phone_number') }}</label>
                                    <div class="custom-input">
                                        <input type="tel" class="form-control" id="exampleFormControlInput3"
                                            placeholder="{{ __('contact.enter_phone_number') }}" maxlength="10"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value =
                                            this.value.slice(0, this.maxLength);">
                                        <i class="fa-solid fa-mobile-screen-button"></i>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-12">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="exampleFormControlTextarea" class="form-label">{{ __('contact.message') }}</label>
                                    <div class="custom-textarea">
                                        <textarea class="form-control" id="exampleFormControlTextarea" placeholder="{{ __('contact.enter_your_message') }}" rows="6"></textarea>
                                        <i class="fa-solid fa-message"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-animation btn-md fw-bold ms-auto">{{ __('contact.send_message') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Box Section End -->

    <!-- Map Section Start -->
    <section class="map-section">
        <div class="container-fluid p-0">
            <div class="map-box">
                <iframe style="border: 0;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.7557904946275!2d105.78093437613639!3d20.962320080670523!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135add4f887f7a5%3A0x57d6351f0b1d2d1d!2zVOG6rXAgdGjhu4MgY8O0bmcgYW4gxJBhIFPhu7k!5e0!3m2!1sen!2s!4v1715764188548!5m2!1sen!2s"
                    allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>
    <!-- Map Section End -->
@endsection
