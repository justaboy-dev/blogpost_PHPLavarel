@extends('main_layout.master')

@section('tittle', $category->name . ' | Home')

@section('content')
    <div class="col-lg-8">
        <div class="blog classic-view">
            @forelse ($posts as $post)
                <article class="post">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="card">
                                <figure class="card-img-top overlay overlay-1 hover-scale"><a
                                        href="{{ route('posts.show', $post) }}"><img
                                            src="{{ asset('storage/' . $post->images->path) . '' }}" alt="" /></a>
                                    <figcaption>
                                        <h5 class="from-top mb-0">Read More</h5>
                                    </figcaption>
                                </figure>

                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div>
                                <div>
                                    <h2 class="post-title mt-1 mb-0">
                                        <a class="link-dark"
                                            href="{{ route('posts.show', $post) }}">{{ $post->tittle }}</a>
                                    </h2>
                                    <div class="post-category">
                                        <span class="badge badge-secondary">
                                            <a href="" class="hover"
                                                rel="category">{{ $post->categories->name }}</a>
                                        </span>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <p>{{ $post->excerpt }}</p>
                                </div>
                            </div>
                            <div class="pt-4">
                                <ul class="post-meta d-flex mb-0">
                                    <li class="post-date">
                                        <i class="uil uil-calendar-alt"></i>
                                        <span>{{ $post->created_at->diffForHumans() }}</span>
                                    </li>
                                    <li class="post-comments">
                                        <a href="{{ route('posts.show', $post) }}#comments">
                                            <i class="uil uil-comment"></i>{{ count($post->comments) }}
                                            <span>Comments</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="post-meta d-flex mb-0">
                                    <li class="post-author">
                                        <a href="#"><i class="uil uil-user"></i><span>By
                                                {{ $post->author->name }}</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <h3>There are no posts related to this category</h3>
            @endforelse
        </div>
        {{ $posts->onEachSide(0)->links() }}
    </div>
    <aside class="col-lg-4 sidebar mt-8 mt-lg-6">
        <div class="widget">
            <h4 class="widget-title mb-3">About Us</h4>
            <p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum.
                Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget
                metus.</p>
            <nav class="nav social">
                <a href="#"><i class="uil uil-twitter"></i></a>
                <a href="#"><i class="uil uil-facebook-f"></i></a>
                <a href="#"><i class="uil uil-dribbble"></i></a>
                <a href="#"><i class="uil uil-instagram"></i></a>
                <a href="#"><i class="uil uil-youtube"></i></a>
            </nav>
        </div>
        <x-category-side :categories="$categories" />

        <x-popularpost-side :popular_post="$popular_post" />

        <x-tag-side :tags="$tags" />

        <div class="widget">
            <h4 class="widget-title mb-3">Archive</h4>
            <ul class="unordered-list bullet-primary text-reset">
                <li><a href="#">February 2019</a></li>
                <li><a href="#">January 2019</a></li>
                <li><a href="#">December 2018</a></li>
                <li><a href="#">November 2018</a></li>
                <li><a href="#">October 2018</a></li>
            </ul>
        </div>
    </aside>
@endsection