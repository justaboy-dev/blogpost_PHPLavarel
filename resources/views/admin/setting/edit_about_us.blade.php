@extends('admin.layout.main') @section('tittle', 'Edit About Us')
@section('content')
    <div class="alert alert-info global-success global-alert d-none"></div>
    <form onsubmit="return false;" method="post">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="form-group mb-4">
                    <h4>Tittle</h4>
                    <input type="text" id="about_tittle" name="about_tittle" class="form-control" placeholder="Tittle"
                        required value="{{ $settings->where('key', 'about_tittle')->first()->value }}" />
                </div>
                <div class="form-group mb-4">
                    <h4>Description</h4>
                    <textarea class="form-control" name="about_description" placeholder="Description" hidden="true" id="about_description"
                        rows="10" required minlength="30"></textarea>
                </div>
                <div class="form-group mb-4">
                    <h4>Sub tittle</h4>
                    <input type="text" id="about_sub_tittle" name="about_sub_tittle" class="form-control"
                        placeholder="Sub tittle" required
                        value="{{ $settings->where('key', 'about_sub_tittle')->first()->value }}" />
                </div>
                <div class="form-group mb-4">
                    <h4>Sub description</h4>
                    <textarea id="about_sub_description" rows="10" name="about_sub_description" hidden="true" placeholder="Sub description"
                        required minlength="30"></textarea>
                </div>
                <div class="form-group mb-4">
                    <h4>Address</h4>
                    <input type="text" id="address" name="address" class="form-control" placeholder="Address" required
                        value="{{ $settings->where('key', 'address')->first()->value }}" />
                </div>
                <div class="form-group mb-4">
                    <h4>Phone</h4>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" required
                        value="{{ $settings->where('key', 'phone')->first()->value }}" />
                </div>
                <div class="form-group mb-4">
                    <h4>Email</h4>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required
                        value="{{ $settings->where('key', 'email')->first()->value }}" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-4">
                    <h4>Image</h4>
                    <div class="custom_image_box" id="upload" role="button">
                        <img id="about_image_select"
                            src="{{ $settings->where('key', 'about_image')->first()->value ? asset($settings->where('key', 'about_image')->first()->value) : asset('storage/images/upload.jpg') }}"
                            alt="">
                        <input type="text" id="about_image" name="about_image" hidden required
                            value="{{ $settings->where('key', 'about_image')->first()->value }}">
                    </div>
                </div>
                <div class="form-group mb-4">
                    <input type="submit" id="aboutUsSave" class="btn btn-success btn-lg btn-block" value="Save">
                </div>
            </div>
        </div>
    </form>
@endsection

@section('custom-js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/ckfinder/ckfinder.js') }}"></script>
    <script>
        CKEDITOR.replace('about_description', {
            filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
            filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Images') }}",
            filebrowserFlashBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Flash') }}",
            filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
            filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            filebrowserFlashUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
        });
        CKEDITOR.replace('about_sub_description', {
            filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
            filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Images') }}",
            filebrowserFlashBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Flash') }}",
            filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
            filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            filebrowserFlashUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
        });
        CKEDITOR.instances['about_description'].setData("{!! $settings->where('key', 'about_description')->first()->value !!}");
        CKEDITOR.instances['about_sub_description'].setData("{!! $settings->where('key', 'about_sub_description')->first()->value !!}");
        $('#upload').click(function() {
            CKFinder.popup({
                chooseFiles: true,
                onInit: function(finder) {
                    finder.on('files:choose', function(evt) {
                        var file = evt.data.files.first();
                        $('#about_image_select').attr('src', file.getUrl());
                        $('#about_image').val(file.getUrl());
                    });
                    finder.on('file:choose:resizedImage', function(evt) {
                        $('#about_image_select').attr('src', evt.data.resizedUrl);
                        $('#about_image').val(evt.data.resizedUrl);
                    });
                }
            });
        });
        $(document).on('click', '#aboutUsSave', (e) => {
            e.preventDefault;
            let $this = e.target;
            let csrf_token = $($this).parents('form').find('input[name="_token"]').val();
            let about_tittle = $($this).parents('form').find('input[name="about_tittle"]').val();
            let about_sub_tittle = $($this).parents('form').find('input[name="about_sub_tittle"]').val();
            let about_description = CKEDITOR.instances['about_description'].getData();
            let about_sub_description = CKEDITOR.instances['about_sub_description'].getData();
            let address = $($this).parents('form').find('input[name="address"]').val();
            let phone = $($this).parents('form').find('input[name="phone"]').val();
            let email = $($this).parents('form').find('input[name="email"]').val();
            let about_image = $($this).parents('form').find('input[name="about_image"]').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                url: "{{ route('admin.setting.update_about_us') }}",
                type: 'PUT',
                contentType: 'application/json',
                processData: false,
                data: JSON.stringify({
                    about_tittle: about_tittle,
                    about_sub_tittle: about_sub_tittle,
                    about_description: about_description,
                    about_sub_description: about_sub_description,
                    address: address,
                    phone: phone,
                    email: email,
                    about_image: about_image
                }),
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    if (data.success) {
                        swal({
                            position: 'top-end',
                            icon: 'success',
                            title: data.message,
                            button: false,
                            timer: 1500
                        });
                    } else {
                        swal({
                            position: 'top-end',
                            icon: 'error',
                            title: data.message,
                            text: data.error.join('\n'),
                            button: true,
                        })
                    }
                }
            })
        });
    </script>
@endsection
