@extends('layouts.app')

@section('title', 'Blog - ' . config('app.name'))

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-wrap bg-f br-1">
    <div class="container">
        <div class="breadcrumb-title">
            <h2>Our Blog</h2>
            <ul class="breadcrumb-menu list-style">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Blog</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Blog Section Start -->
<section class="blog-section ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @if($posts->count() > 0)
                <div class="row">
                    @foreach($posts as $post)
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="blog-card style-one">
                            <div class="blog-card">
                                @if($post->featured_image)
                                <img src="{{ blog_image($post->featured_image) }}" alt="{{ $post->title }}">
                                @else
                                <img src="{{ asset('assets/img/blog/blog-1.webp') }}" alt="{{ $post->title }}">
                                @endif
                            </div>
                            <div class="blog-info">
                                <ul class="blog-metainfo list-style">
                                    @if($post->published_at)
                                    <li><i class="ri-calendar-line"></i>{{ $post->published_at->format('M d, Y') }}</li>
                                    @endif
                                    @if($post->author)
                                    <li><i class="ri-user-line"></i>{{ $post->author }}</li>
                                    @endif
                                    @if($post->category)
                                    <li><i class="ri-bookmark-line"></i>{{ $post->category }}</li>
                                    @endif
                                </ul>
                                <h3><a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a></h3>
                                @if($post->excerpt)
                                <p>{{ $post->excerpt }}</p>
                                @else
                                <p>{{ Str::limit(strip_tags($post->content), 150) }}</p>
                                @endif
                                <a href="{{ route('blog.show', $post) }}" class="link-one">
                                    {{ __('general.read_more') }} <i class="ri-arrow-right-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="pagination-wrap">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="lead">No blog posts available at the moment.</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <!-- Search Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">{{ __('general.search') }}</h3>
                        <form action="{{ route('blog.index') }}" method="GET" class="search-form">
                            <input type="text" name="search" placeholder="{{ __('general.search') }}..." value="{{ request('search') }}">
                            <button type="submit"><i class="ri-search-line"></i></button>
                        </form>
                    </div>

                    <!-- Categories Widget -->
                    @if($categories->count() > 0)
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Categories</h3>
                        <ul class="category-list list-style">
                            <li>
                                <a href="{{ route('blog.index') }}" class="{{ !request('category') ? 'active' : '' }}">
                                    All Posts
                                </a>
                            </li>
                            @foreach($categories as $category)
                            <li>
                                <a href="{{ route('blog.index', ['category' => $category]) }}" class="{{ request('category') == $category ? 'active' : '' }}">
                                    {{ $category }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Recent Posts Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Recent Posts</h3>
                        @php
                        $recentPosts = \App\Models\Post::where('is_published', true)->latest('published_at')->take(5)->get();
                        @endphp
                        @foreach($recentPosts as $recentPost)
                        <div class="recent-post-item">
                            @if($recentPost->featured_image)
                            <img src="{{ blog_image($recentPost->featured_image) }}" alt="{{ $recentPost->title }}">
                            @endif
                            <div class="recent-post-info">
                                <h4><a href="{{ route('blog.show', $recentPost) }}">{{ Str::limit($recentPost->title, 50) }}</a></h4>
                                <span class="date"><i class="ri-calendar-line"></i>{{ $recentPost->published_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Tags Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Tags</h3>
                        <ul class="tag-list list-style">
                            <li><a href="#">Dental Care</a></li>
                            <li><a href="#">Teeth Cleaning</a></li>
                            <li><a href="#">Oral Health</a></li>
                            <li><a href="#">Dentistry</a></li>
                            <li><a href="#">Cosmetic</a></li>
                            <li><a href="#">Whitening</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->
@endsection
