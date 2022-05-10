@props(['name', 'placeholder', 'type' => 'text'])


<div class="form-floating mb-4">
    <textarea id="{{ $name }}" name="{{ $name }}" class="form-control" placeholder="{{ $placeholder }}"
        style="height: 150px" required=""></textarea>
    <label for="form_message">{{ $placeholder }} *</label>
    <div class="valid-feedback"> Looks good! </div>
    <div class="invalid-feedback"> Please enter your messsage. </div>
</div>
