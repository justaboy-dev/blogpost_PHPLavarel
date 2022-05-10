@props(['status'])

@if (session()->has($status))
    <div class="alert alert-{{ $status == 'success' ? 'success' : 'danger' }}">
        {{ session($status) }}
    </div>
@endif
