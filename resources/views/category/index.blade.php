@extends('main_layout.master')

@section('tittle', 'Category | Home')

@section('content')
    <div class="col-lg-12">
        <div class="blog classic-view">
            <article class="post">
                <div class="row">

                    @forelse ($categories as $category)
                        <div class="col-md-3">
                            <div class=" border mb-4 p-3 rounded">
                                <div class="card">
                                    <figure class="card-img-top overlay overlay-1 hover-scale">
                                        <a href="{{ route('category.show', $category) }}">
                                            <img src="{{ asset('storage/' . $category->images->path) . '' }}" alt="" />
                                        </a>
                                        <figcaption>
                                            <h5 class="from-top mb-0">Read More</h5>
                                        </figcaption>
                                    </figure>

                                </div>
                                <div>
                                    <div>
                                        <h2 class="post-title mt-1 mb-0">
                                            <a class="link-dark"
                                                href="{{ route('category.show', $category) }}">{{ $category->name }}</a>
                                        </h2>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <ul class="post-meta d-flex mb-0">
                                        <li class="post-date">
                                            <i class="uil uil-calendar-alt"></i>
                                            <span>{{ $category->created_at->diffForHumans() }}</span>
                                        </li>
                                        <li class="post-comments">
                                            <a href="{{ route('category.show', $category) }}">
                                                <i class="uil uil-tag"></i>{{ count($category->posts) }}
                                                <span>Posts</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="post-meta d-flex mb-0">
                                        <li class="post-author">
                                            <a href="#"><i class="uil uil-user"></i><span>By
                                                    {{ $category->user->name }}</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h3>No category found</h3>
                    @endforelse
                </div>
                {{ $categories->links() }}
            </article>
        </div>
    </div>
@endsection
