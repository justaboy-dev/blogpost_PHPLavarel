@extends('main_layout.master')
@section('tittle', 'Blogpost | SinglePost')
@section('content')
    <section class="wrapper bg-soft-primary">
        <div class="container pt-10 pb-19 pt-md-10 pb-md-20 text-center">
            <div class="row">
                <div class="col-md-10 col-xl-8 mx-auto">
                    <div class="post-header">
                        <div class="post-category">
                            <a href="{{ route('category.show', $post->categories) }}" class="hover"
                                rel="category">{{ $post->categories->name }}</a>
                        </div>
                        <h1 class="display-1 mb-4">{{ $post->tittle }}</h1>
                        <ul class="post-meta mb-5">
                            <li class="post-date"><i
                                    class="uil uil-calendar-alt"></i><span>{{ $post->created_at->diffForHumans() }}</span>
                            </li>
                            <li class="post-author"><a href="{{ route('author.show', $post->author) }}"><i
                                        class="uil uil-user"></i><span>By
                                        {{ $post->author->name }}</span></a>
                            </li>
                            <li class="post-comments"><a href="#comments"><i
                                        class="uil uil-comment"></i>{{ count($post->comments) }}<span> Comments</span></a>
                            </li>
                            <li class="post-comments">
                                <i class="uil uil-eye"></i>
                                <span>
                                    {{ $post->views }} Views
                                </span>
                            </li>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="wrapper bg-light">
        <div class="container pb-14 pb-md-16">
            <div class="row" id="image">
                <div class="col-lg-10 mx-auto">
                    <div class="blog single mt-n17">
                        <div class="card">
                            <figure class="card-img-top">
                                <img src="{{ asset($post->images->path) }}" alt="">
                            </figure>
                            <div class="card-body">
                                <div class="classic-view">
                                    <article class="post">
                                        <div class="post-content mb-5">
                                            {!! $post->body !!}
                                        </div>

                                        <div
                                            class="post-footer d-md-flex flex-md-row justify-content-md-between align-items-center mt-8">
                                            <div>
                                                <ul class="list-unstyled tag-list mb-0">
                                                    @foreach ($post->tags as $tag)
                                                        <li><a href="{{ route('tag.show', $tag) }}"
                                                                class="btn btn-soft-ash btn-sm rounded-pill mb-0">{{ $tag->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="mb-0 mb-md-2">
                                                <div class="dropdown share-dropdown btn-group">
                                                    <button
                                                        class="btn btn-sm btn-red rounded-pill btn-icon btn-icon-start dropdown-toggle mb-0 me-0"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="uil uil-share-alt"></i> Share </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="uil uil-twitter"></i>Twitter</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="uil uil-facebook-f"></i>Facebook</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="uil uil-linkedin"></i>Linkedin</a>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    </article>

                                </div>

                                <hr>
                                <div class="author-info d-md-flex align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <figure class="user-avatar"><img class="rounded-circle-height-avatar" alt=""
                                                src="{{ $post->author->images ? asset($post->author->images->path) : asset('storage/images/user.png') }}">
                                        </figure>
                                        <div>
                                            <h6><a href="#" class="link-dark">{{ $post->author->name }}</a></h6>
                                        </div>
                                    </div>
                                    <div class="mt-3 mt-md-0 ms-auto">
                                        <a href="{{ route('author.show', $post->author) }}"
                                            class="btn btn-sm btn-soft-ash rounded-pill btn-icon btn-icon-start mb-0"><i
                                                class="uil uil-file-alt"></i> All Posts</a>
                                    </div>
                                </div>
                                <nav class="nav social">
                                    <a href="#"><i class="uil uil-twitter"></i></a>
                                    <a href="#"><i class="uil uil-facebook-f"></i></a>
                                    <a href="#"><i class="uil uil-dribbble"></i></a>
                                    <a href="#"><i class="uil uil-instagram"></i></a>
                                    <a href="#"><i class="uil uil-youtube"></i></a>
                                </nav>

                                <hr>
                                <h3 class="mb-6">Same post author</h3>
                                <div class="swiper-container blog grid-view mb-16 swiper-container-0" data-margin="30"
                                    data-dots="true" data-items-md="2" data-items-xs="1">
                                    <div class="swiper swiper-initialized swiper-horizontal swiper-pointer-events">
                                        <div class="swiper-wrapper" id="swiper-wrapper-4ec29683c7bd81f7" aria-live="off"
                                            style="cursor: grab; transform: translate3d(0px, 0px, 0px);">
                                            @foreach ($same_author_posts as $same_author_post)
                                                <div class="swiper-slide swiper-slide-active" role="group"
                                                    aria-label="1 / 4" style="width: 385px; margin-right: 30px;">
                                                    <article>
                                                        <figure class="overlay overlay-1 hover-scale rounded mb-5">
                                                            <a href="#">
                                                                <img src="{{ asset($same_author_post->images->path) }}"
                                                                    alt="">
                                                            </a>
                                                            <figcaption>
                                                                <h5 class="from-top mb-0">Read More</h5>
                                                            </figcaption>
                                                        </figure>
                                                        <div class="post-header">
                                                            <div class="post-category text-line">
                                                                <a href="#" class="hover"
                                                                    rel="category">{{ $same_author_post->categories->name }}</a>
                                                            </div>

                                                            <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark"
                                                                    href="{{ route('posts.show', $same_author_post) }}">{{ $same_author_post->tittle }}</a>
                                                            </h2>
                                                        </div>

                                                        <div class="post-footer">
                                                            <ul class="post-meta mb-0">
                                                                <li class="post-date"><i
                                                                        class="uil uil-calendar-alt"></i><span>{{ $same_author_post->created_at->diffForHumans() }}</span>
                                                                </li>
                                                                <li class="post-comments"><a
                                                                        href="{{ route('posts.show', $same_author_post) . '#comments' }}"><i
                                                                            class="uil uil-comment"></i>{{ count($same_author_post->comments) }}</a>
                                                                </li>
                                                            </ul>

                                                        </div>

                                                    </article>

                                                </div>
                                            @endforeach
                                        </div>
                                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                                    </div>
                                    <div class="swiper-controls">
                                        <div
                                            class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                                            <span class="swiper-pagination-bullet swiper-pagination-bullet-active"
                                                tabindex="0" role="button" aria-current="true"></span><span
                                                class="swiper-pagination-bullet" tabindex="0" role="button"></span><span
                                                class="swiper-pagination-bullet" tabindex="0" role="button"></span>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div id="comments">
                                    <h3 class="mb-6">{{ count($post->comments) }} Comments</h3>
                                    <ol id="singlecomments" class="commentlist">
                                        @foreach ($post->comments->sortByDesc('created_at') as $comment)
                                            <li class="comment" id="comment_{{ $comment->id }}">
                                                <div class="comment-header d-md-flex align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <figure class="user-avatar "><img
                                                                class="rounded-circle-height-avatar" alt=""
                                                                src="{{ $comment->user->images ? asset($comment->user->images->path) : asset('storage/images/user.png') }}">
                                                        </figure>
                                                        <div>
                                                            <h6 class="comment-author"><a href="#"
                                                                    class="link-dark">{{ $comment->user->name }}</a>
                                                            </h6>
                                                            <ul class="post-meta">
                                                                <li><i
                                                                        class="uil uil-calendar-alt"></i>{{ $comment->created_at->diffForHumans() }}
                                                                </li>
                                                            </ul>

                                                        </div>

                                                    </div>
                                                </div>
                                                <p>
                                                    {{ $comment->the_comment }}
                                                </p>
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                                @auth
                                    <hr>
                                    <h3 class="mb-3">Would you like to share your thoughts?</h3>
                                    <x-message :status="'success'" />
                                    <form class="comment-form" method="POST"
                                        action="{{ route('posts.add_comment', $post) }}">
                                        @csrf
                                        <div class="form-floating mb-4">
                                            <textarea name="the_comment" class="form-control" placeholder="Comment" style="height: 250px"></textarea>
                                            <label>Comment *</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary rounded-pill mb-0">Submit</button>
                                    </form>
                                @endauth
                                @guest
                                    <hr>
                                    <h3 class="mb-3">Would you like to share your thoughts?</h3>
                                    <p>Please <a href="{{ route('login') }}">login</a> or <a
                                            href="{{ route('register') }}">register</a> to post a comment.</p>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom-js')
    <script src="{{ asset('dist/viewer.js') }}"></script>
    <script>
        var viewer = new Viewer(document.getElementById('image'), {
            title: false,
            toolbar: false,
            navbar: false,
            loop: true,
            fullscreen: false,
            minZoomRatio: 0.5,
            maxZoomRatio: 10,
            zoomRatio: 1,
            ready: function() {
                viewer.zoomTo(1);
            }
        });
    </script>
@endsection

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('dist/viewer.css') }}">
@endsection
