@props(['status'])

@if (session()->has($status))
    <div class="alert global-{{ $status == 'success' ? 'success' : 'error' }} global-alert">
        {{ session($status) }}
    </div>
@endif
