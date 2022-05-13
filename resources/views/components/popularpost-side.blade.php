@props(['popular_post'])
<div class="widget">
    <h4 class="widget-title mb-3">Popular Posts</h4>
    <ul class="image-list">
        @foreach ($popular_post as $p_post)
            <li>
                <figure class="rounded"><a href=""><img src="{{ asset($p_post->images->path) . '' }}"
                            alt="" /></a>
                </figure>
                <div class="post-content">
                    <h6 class="mb-2">
                        <a class="link-dark"
                            href="{{ route('posts.show', $p_post) }}">{{ Str::limit($p_post->tittle, 30) }}</a>
                    </h6>
                    <div class="d-flex align-items-end">
                        <ul class="post-meta">
                            <li class="post-date">
                                <i class="uil uil-calendar-alt"></i>
                                <span>{{ $p_post->created_at->diffForHumans() }}</span>
                            </li>
                            <li class="post-comments">
                                <i class="uil uil-eye"></i>
                                <span>{{ $p_post->views }} Views</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
