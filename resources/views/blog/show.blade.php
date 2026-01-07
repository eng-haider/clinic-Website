@extends('layouts.app')

@section('title', $post->title . ' - ' . config('app.name'))

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-wrap bg-f br-1">
    <div class="container">
        <div class="breadcrumb-title">
            <h2>{{ $post->title }}</h2>
            <ul class="breadcrumb-menu list-style">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                <li>{{ Str::limit($post->title, 30) }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Blog Details Section Start -->
<section class="blog-details-section ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details-content">
                    @if($post->featured_image)
                    <div class="blog-image mb-4">
                        <img src="{{ blog_image($post->featured_image) }}" alt="{{ $post->title }}" class="img-fluid rounded">
                    </div>
                    @endif

                    <ul class="blog-metainfo list-style mb-3">
                        <li><i class="ri-calendar-line"></i>{{ $post->published_at->format('M d, Y') }}</li>
                        @if($post->author)
                        <li><i class="ri-user-line"></i>{{ $post->author }}</li>
                        @endif
                        @if($post->category)
                        <li><i class="ri-bookmark-line"></i>{{ $post->category }}</li>
                        @endif
                    </ul>

                    <h1>{{ $post->title }}</h1>

                    @if($post->excerpt)
                    <div class="post-excerpt mt-3 mb-4">
                        <p class="lead">{{ $post->excerpt }}</p>
                    </div>
                    @endif

                    <div class="post-content mt-4">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    @if($post->tags && count($post->tags) > 0)
                    <div class="post-tags mt-5">
                        <h4>Tags:</h4>
                        <ul class="tag-list list-style">
                            @foreach($post->tags as $tag)
                            <li><a href="#">{{ $tag }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Share Post -->
                    <div class="post-share mt-5">
                        <h4>Share This Post:</h4>
                        <ul class="social-profile list-style">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post)) }}" target="_blank"><i class="ri-facebook-fill"></i></a></li>
                            <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post)) }}&text={{ urlencode($post->title) }}" target="_blank"><i class="ri-twitter-fill"></i></a></li>
                            <li><a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('blog.show', $post)) }}" target="_blank"><i class="ri-linkedin-fill"></i></a></li>
                        </ul>
                    </div>

                    <!-- Related Posts -->
                    @if($relatedPosts->count() > 0)
                    <div class="related-posts mt-5">
                        <h3>Related Posts</h3>
                        <div class="row">
                            @foreach($relatedPosts as $relatedPost)
                            <div class="col-md-4">
                                <div class="blog-card style-one">
                                    <div class="blog-card">
                                        @if($relatedPost->featured_image)
                                        <img src="{{ blog_image($relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}">
                                        @else
                                        <img src="{{ asset('assets/img/blog/blog-1.webp') }}" alt="{{ $relatedPost->title }}">
                                        @endif
                                    </div>
                                    <div class="blog-info">
                                        <ul class="blog-metainfo list-style">
                                            <li><i class="ri-calendar-line"></i>{{ $relatedPost->published_at->format('M d, Y') }}</li>
                                        </ul>
                                        <h3><a href="{{ route('blog.show', $relatedPost) }}">{{ Str::limit($relatedPost->title, 50) }}</a></h3>
                                        <a href="{{ route('blog.show', $relatedPost) }}" class="link-one">{{ __('general.read_more') }}</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <!-- Author Widget -->
                    @if($post->author)
                    <div class="sidebar-widget author-widget">
                        <h3 class="widget-title">About Author</h3>
                        <div class="author-info">
                            <h4>{{ $post->author }}</h4>
                            <p>Professional dental care writer and healthcare expert.</p>
                        </div>
                    </div>
                    @endif

                    <!-- Recent Posts Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Recent Posts</h3>
                        @php
                        $recentPosts = \App\Models\Post::where('is_published', true)
                            ->where('id', '!=', $post->id)
                            ->latest('published_at')
                            ->take(5)
                            ->get();
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

                    <!-- CTA Widget -->
                    <div class="sidebar-widget cta-widget">
                        <h3 class="widget-title">Need Dental Care?</h3>
                        <p>Book an appointment with our expert dentists today!</p>
                        <a href="{{ route('appointments.create') }}" class="btn style-one w-100">Book Appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->
@endsection
