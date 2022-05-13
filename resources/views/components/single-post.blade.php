@props(['post'])
<article class="post">
    <div class="row">
        <div class="col-sm-5">
            <div class="card">
                <figure class="card-img-top overlay overlay-1 hover-scale">
                    <a href="{{ route('posts.show', $post) }}">
                        <img src="{{ asset($post->images->path) }}" alt="" />
                    </a>
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
                        <a class="link-dark" href="{{ route('posts.show', $post) }}">{{ $post->tittle }}</a>
                    </h2>
                    <div class="post-category">
                        <span class="badge badge-secondary">
                            <a href="{{ route('category.show', $post->categories) }}" class="hover"
                                rel="category">{{ $post->categories->name }}</a>
                        </span>
                    </div>
                </div>
                <div class="post-content">
                    {!! $post->excerpt !!}
                </div>
            </div>
            <div class="pt-4">
                <ul class="post-meta d-flex mb-3">
                    <li class="post-author">
                        <i class="uil uil-eye"></i>
                        <span>{{ $post->views }} Views</span>
                    </li>
                </ul>
                <ul class="post-meta d-flex mb-3">
                    <li class="post-author">
                        <a href="{{ route('author.show', $post->author) }}"><i class="uil uil-user"></i><span>By
                                {{ $post->author->name }}</span></a>
                    </li>
                </ul>
                <ul class="post-meta d-flex mb-3">

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

            </div>
        </div>
    </div>
</article>
