@extends('layout')
@section('title', $blog->title_translated)
@section('content')
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>{{ __('blogs.blog_detail') }}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('blogs')}}">{{ __('blogs.news') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('blogs.blog_detail') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-3 col-xl-4 col-lg-5 d-lg-block d-none">
                    <div class="left-sidebar-box">
                        <div class="left-search-box">
                            <form action="{{route('blogs')}}" method="get">
                                <div class="search-box">
                                    <input type="search" name="search" class="form-control" id="exampleFormControlInput4"
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
                                            @forelse ($recentBlogs as $it)
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

                <div class="col-xxl-9 col-xl-8 col-lg-7 ratio_50">
                    <div class="blog-detail-image rounded-3 mb-4">
                        <img src="{{$blog->image}}" class="bg-img blur-up lazyload" alt="">
                        <div class="blog-image-contain">
                            <ul class="contain-list">
                                @foreach (json_decode($blog->sub_categories_translated) as $category)
                                    <li>{{$category}}</li>
                                @endforeach
                            </ul>
                            <h2>{{ $blog->title_translated }}</h2>
                            <ul class="contain-comment-list">
                                <li>
                                    <div class="user-list">
                                        <i data-feather="user"></i>
                                        <span>{{ $blog->user?->name }}</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="user-list">
                                        <i data-feather="calendar"></i>
                                        <span>{{ $blog->created_at }}</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="user-list">
                                        <i data-feather="message-square"></i>
                                        <span>{{$blog->comments->count()}} {{ __('blogs.comments') }}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="blog-detail-contain">
                        {!! $blog->content_translated !!}
                    </div>

                    <div class="comment-box overflow-hidden">
                        <div class="leave-title">
                            <h3>{{ __('blogs.comments') }}</h3>
                        </div>

                        <div class="user-comment-box">
                            <ul>
                                @forelse ($blog->comments as $comment)
                                    <li>
                                        <div class="user-box border-color">
                                            <div class="user-image">
                                                <img src="../assets/images/inner-page/user/1.jpg"
                                                    class="img-fluid blur-up lazyload" alt="">
                                                <div class="user-name">
                                                    <h6>{{ $comment->created_at }}</h6>
                                                    <h5 class="text-content">{{ $comment->user ? $comment->user->name : __('blogs.anonymous') }}</h5>
                                                </div>
                                            </div>

                                            <div class="user-contain">
                                                <p>{{$comment->content}}</p>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <p class="w-100 text-center">{{ __('blogs.no_comments') }}</p>
                                @endforelse

                            </ul>
                        </div>
                    </div>

                    <div class="leave-box">
                        <div class="leave-title mt-0">
                            <h3>{{ __('blogs.leave_a_comment') }}</h3>
                        </div>

                        <div class="leave-comment">
                            <div class="comment-notes">
                                <p class="text-content mb-4">{{ __('blogs.email_not_published') }}</p>
                            </div>
                            <form action="{{route('postComment')}}" method="post">
                                @csrf
                                <input type="text" name="blog_id" value="{{$blog->id}}" hidden>
                                <div class="row g-3">
                                    <div class="col-xxl-4 col-lg-12 col-sm-6">
                                        <div class="blog-input">
                                            <input type="text" name="full_name" class="form-control" id="exampleFormControlInput1"
                                                placeholder="{{ __('blogs.your_name') }}">
                                        </div>
                                    </div>
            
                                    <div class="col-xxl-4 col-lg-12 col-sm-6">
                                        <div class="blog-input">
                                            <input type="email" name="email" class="form-control" id="exampleFormControlInput2"
                                                placeholder="{{ __('blogs.your_email') }}">
                                        </div>
                                    </div>
            
                                    <div class="col-12">
                                        <div class="blog-input">
                                            <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="4"
                                                placeholder="{{ __('blogs.comment') }}"></textarea>
                                        </div>
                                    </div>
                                </div>
            
                                <button class="btn btn-animation ms-xxl-auto mt-xxl-0 mt-3 btn-md fw-bold">{{ __('blogs.post_comment') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection