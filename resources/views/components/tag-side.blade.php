@props(['tags'])
<div class="widget">
    <h4 class="widget-title mb-3">Tags</h4>
    <ul class="list-unstyled tag-list">
        @foreach ($tags as $tag)
            <li><a href="{{ route('tag.show', $tag) }}"
                    class="btn btn-soft-ash btn-sm rounded-pill">{{ $tag->name }}</a></li>
        @endforeach
    </ul>
</div>
