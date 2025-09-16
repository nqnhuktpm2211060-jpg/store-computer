@extends('layout')
@section('title', __('blogs.title'))

@section('content')
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>{{ __('blogs.title') }}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('blogs.title') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-4">
                <div class="col-xxl-9 col-xl-8 col-lg-7 order-lg-2">
                    <div class="row g-4 ratio_65">
                        @php
                            $timeShow = 0;
                        @endphp
                        @forelse ($news as $it)
                            <div class="col-xxl-4 col-sm-6">
                                <div class="blog-box wow fadeInUp" data-wow-delay="{{ $timeShow }}s">
                                    <div class="blog-image">
                                        <a href="{{ route('blog.detail', $it->slug_translated) }}">
                                            <img src="{{ $it->image }}" class="bg-img blur-up lazyload" alt="">
                                        </a>
                                    </div>

                                    <div class="blog-contain">
                                        <div class="blog-label">
                                            <span class="time"><i data-feather="clock"></i>
                                                <span>{{ $it->created_at }}</span></span>
                                            <span class="super"><i data-feather="user"></i>
                                                <span>{{ $it->user?->name }}</span></span>
                                        </div>
                                        <a href="{{ route('blog.detail', $it->slug_translated) }}">
                                            <h3>{{ $it->title_translated }}</h3>
                                        </a>
                                        <button onclick="location.href = '{{ route('blog.detail', $it->slug_translated) }}';"
                                            class="blog-button">{{ __('blogs.read_more') }}
                                            <i class="fa-solid fa-right-long"></i></button>
                                    </div>
                                </div>
                            </div>

                            @php
                                $timeShow += 0.05;
                            @endphp
                        @empty
                            <p class="w-100 text-center">{{ __('blogs.no_posts') }}</p>
                        @endforelse
                    </div>

                    {{ $news->links('pagination::bootstrap-5') }}
                </div>

                <div class="col-xxl-3 col-xl-4 col-lg-5 order-lg-1">
                    <div class="left-sidebar-box wow fadeInUp">
                        <div class="left-search-box">
                            <form action="{{ route('blogs') }}" method="get">
                                <div class="search-box">
                                    <input type="search" name="search" class="form-control" id="exampleFormControlInput1"
                                        placeholder="{{ __('blogs.search_posts') }}">
                                </div>
                            </form>
                        </div>

                        <div class="accordion left-accordion-box" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne">
                                        {{ __('blogs.recent_posts') }}
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                    <div class="accordion-body pt-0">
                                        <div class="recent-post-box">
                                            @forelse ($news->take(4) as $it)
                                                <div class="recent-box">
                                                    <a href="{{route('blog.detail', $it->slug_translated)}}" class="recent-image">
                                                        <img src="{{$it->image}}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </a>

                                                    <div class="recent-detail">
                                                        <a href="{{route('blog.detail', $it->slug_translated)}}">
                                                            <h5 class="recent-name">{{$it->title_translated}}</h5>
                                                        </a>
                                                        <h6>{{$it->created_at}} <i data-feather="thumbs-up"></i></h6>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="w-100 text-center">{{ __('blogs.no_recent_posts') }}</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection