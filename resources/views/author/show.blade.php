@extends('main_layout.master')

@section('tittle', 'Blogpost | Home')

@section('content')
    <div class="col-lg-8">
        <div class="blog classic-view">
            <div class='mb-6'>
                <p>Result for <strong>{{ $author->name }}</strong></p>
            </div>
            @forelse ($posts as $post)
                <x-single-post :post="$post" />
            @empty
                <h3>No posts found</h3>
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
