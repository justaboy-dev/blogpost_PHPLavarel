@extends('main_layout.master')

@section('tittle', 'Blogpost | Home')

{{-- {{ dd($posts) }} --}}
@section('content')
    <div class="col-lg-8">
        <div class="blog classic-view">
            @foreach ($posts as $post)
                <article class="post">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="card">
                                <figure class="card-img-top overlay overlay-1 hover-scale"><a href="./blog-post.html"><img
                                            src="{{ asset('template/assets/img/photos/b1.jpg') }}" alt="" /></a>
                                    <figcaption>
                                        <h5 class="from-top mb-0">Read More</h5>
                                    </figcaption>
                                </figure>

                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div>
                                <div>
                                    <div class="post-category">
                                        @foreach ($post->tags as $tag)
                                            <span class="badge badge-secondary">
                                                <a href="" class="hover" rel="category">#{{ $tag->name }}</a>
                                            </span>
                                        @endforeach
                                    </div>
                                    <h2 class="post-title mt-1 mb-0">
                                        <a class="link-dark" href="./blog-post.html">{{ $post->tittle }}</a>
                                    </h2>
                                </div>
                                <div class="post-content">
                                    <p>{{ $post->excerpt }}</p>
                                </div>
                            </div>
                            <div>
                                <ul class="post-meta d-flex mb-0">
                                    <li class="post-date">
                                        <i class="uil uil-calendar-alt"></i>
                                        <span>{{ $post->created_at->diffForHumans() }}</span>
                                    </li>
                                    <li class="post-author">
                                        <a href="#"><i class="uil uil-user"></i><span>By
                                                {{ $post->author->name }}</span></a>
                                    </li>
                                    <li class="post-comments">
                                        <a href="#">
                                            <i class="uil uil-comment"></i>{{ count($post->comments) }}<span>
                                                Comments</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        <nav class="d-flex" aria-label="pagination">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true"><i class="uil uil-arrow-left"></i></span>
                    </a>
                </li>
                @if ($posts->currentPage() > 1)
                    <li class="page-item active"><a class="page-link" href="#">{{ $post->currentPage() - 1 }}</a>
                    </li>
                @endif
                <li class="page-item"><a class="page-link" href="#">{{ $posts->currentPage() }}</a></li>
                @if ($posts->currentPage() < $posts->lastPage())
                    <li class="page-item"><a class="page-link" href="#">{{ $posts->currentPage() + 1 }}</a>
                    </li>
                @else
                    <li class="page-item"><a class="page-link" href="#">{{ $posts->lastPage() }}</a>
                    </li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true"><i class="uil uil-arrow-right"></i></span>
                    </a>
                </li>
            </ul>
        </nav>
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
        <div class="widget">
            <h4 class="widget-title mb-3">Popular Posts</h4>
            <ul class="image-list">
                <li>
                    <figure class="rounded"><a href="./blog-post.html"><img
                                src="{{ asset('template/assets/img/photos/a1.jpg') }}" alt="" /></a>
                    </figure>
                    <div class="post-content">
                        <h6 class="mb-2"> <a class="link-dark" href="./blog-post.html">Magna Mollis
                                Ultricies</a> </h6>
                        <ul class="post-meta">
                            <li class="post-date"><i class="uil uil-calendar-alt"></i><span>26
                                    Mar 2021</span></li>
                            <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>3</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <figure class="rounded"> <a href="./blog-post.html"><img
                                src="{{ asset('template/assets/img/photos/a2.jpg') }}" alt="" /></a>
                    </figure>
                    <div class="post-content">
                        <h6 class="mb-2"> <a class="link-dark" href="./blog-post.html">Ornare Nullam
                                Risus</a> </h6>
                        <ul class="post-meta">
                            <li class="post-date"><i class="uil uil-calendar-alt"></i><span>16
                                    Feb 2021</span></li>
                            <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>6</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <figure class="rounded"><a href="./blog-post.html"><img
                                src="{{ asset('template/assets/img/photos/a3.jpg') }}" alt="" /></a>
                    </figure>
                    <div class="post-content">
                        <h6 class="mb-2"> <a class="link-dark" href="./blog-post.html">Euismod Nullam
                                Fusce</a> </h6>
                        <ul class="post-meta">
                            <li class="post-date"><i class="uil uil-calendar-alt"></i><span>8 Jan
                                    2021</span></li>
                            <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>5</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="widget">
            <h4 class="widget-title mb-3">Categories</h4>
            <ul class="unordered-list bullet-primary text-reset">
                <li><a href="#">Teamwork (21)</a></li>
                <li><a href="#">Ideas (19)</a></li>
                <li><a href="#">Workspace (16)</a></li>
                <li><a href="#">Coding (7)</a></li>
                <li><a href="#">Meeting (12)</a></li>
                <li><a href="#">Business Tips (14)</a></li>
            </ul>
        </div>
        <div class="widget">
            <h4 class="widget-title mb-3">Tags</h4>
            <ul class="list-unstyled tag-list">
                <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Still Life</a></li>
                <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Urban</a></li>
                <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Nature</a></li>
                <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Landscape</a></li>
                <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Macro</a></li>
                <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Fun</a></li>
                <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Workshop</a></li>
                <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Photography</a></li>
            </ul>
        </div>
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
