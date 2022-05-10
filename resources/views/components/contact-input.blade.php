@props(['name', 'placeholder', 'type' => 'text'])

<div class="form-floating mb-4">
    <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" class="form-control"
        placeholder="{{ $placeholder }}" required>
    <label for="form_name">{{ $placeholder }}*</label>
    <div class="valid-feedback"> Looks good! </div>
    <div class="invalid-feedback"> Please enter your {{ $placeholder }}</div>
</div>
@error($name)
    <p class="text-danger">{{ $message }}</p>
@enderror
