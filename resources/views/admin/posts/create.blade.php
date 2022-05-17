@extends('admin.layout.main') @section('tittle', 'Create Post')
@section('content')
    <div class="alert alert-info global-success global-alert d-none"></div>
    <form onsubmit="return false;" method="post">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="form-group mb-4">
                    <h4>Post tittle</h4>
                    <input type="text" id="tittle" name="tittle" class="form-control" placeholder="Post tittle" required />
                </div>
                <div class="form-group mb-4">
                    <h4>Post slug</h4>
                    <input type="text" id="slug" name="slug" class="form-control" placeholder="Post slug" required />
                </div>
                <div class="form-group mb-4">
                    <h4>Post content</h4>
                    <textarea class="form-control" name="body" placeholder="Post content" hidden="true" id="postcontent" rows="10" required
                        minlength="30"></textarea>
                </div>
                <div class="form-group mb-4">
                    <h4>Post excerpt</h4>
                    <textarea id="postexcerpt" rows="5" name="excerpt" hidden="true" placeholder="Post excerpt" required
                        minlength="30"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-4">
                    <h4>Post category</h4>
                    <select class="form-control" id="postcategory" required name="category_id">
                        <option value="">Select category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-4">
                    <h4>Post thumbnail</h4>
                    <div class="custom_image_box" id="upload" role="button">
                        <img id="postthumb" src="{{ asset('storage/images/upload.jpg') }}" alt="">
                        <input type="text" id="postthumbnail" name="post_thumb" hidden required>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <h4>Post tags</h4>
                    <input type="text" class="form-control" id="tags" name="tags" required />
                </div>
                <div class="form-group mb-4">
                    <div class="row justify-content-between">
                        <div class="col-4" style="padding-left: 0">
                            <h4>Published</h4>
                        </div>
                        <div class="col-3" style="padding-right: 0">
                            <input type="checkbox" name="public" data-toggle="toggle" data-on="Publish" id="public"
                                data-off="Draft" data-onstyle="success" data-offstyle="warning" checked>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <input type="submit" id="postSave" class="btn btn-success btn-lg btn-block" value="Save">
                </div>
            </div>
        </div>
    </form>
@endsection

@section('custom-js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/ckfinder/ckfinder.js') }}"></script>
    <script>
        $('#tags').tagsinput({
            tagClass: 'badge badge-primary p-2 m-1',
            confirmKeys: [13, 32, 44],
            maxChars: 20,
            trimValue: true,
            allowDuplicates: false,
        });
        CKEDITOR.replace('postcontent', {
            filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
            filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Images') }}",
            filebrowserFlashBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Flash') }}",
            filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
            filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            filebrowserFlashUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
        });
        CKEDITOR.replace('postexcerpt', {
            filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
            filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Images') }}",
            filebrowserFlashBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Flash') }}",
            filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
            filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            filebrowserFlashUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
        });
        $('#upload').click(function() {
            CKFinder.popup({
                chooseFiles: true,
                onInit: function(finder) {
                    finder.on('files:choose', function(evt) {
                        var file = evt.data.files.first();
                        $('#postthumb').attr('src', file.getUrl());
                        $('#postthumbnail').val(file.getUrl());
                    });
                    finder.on('file:choose:resizedImage', function(evt) {
                        $('#postthumb').attr('src', evt.data.resizedUrl);
                        $('#postthumbnail').val(evt.data.resizedUrl);
                    });
                }
            });
        });
        $(document).on('click', '#postSave', (e) => {
            e.preventDefault;
            let $this = e.target;
            let csrf_token = $($this).parents('form').find('input[name="_token"]').val();
            let tittle = $($this).parents('form').find('input[name="tittle"]').val();
            let slug = $($this).parents('form').find('input[name="slug"]').val();
            let body = CKEDITOR.instances['postcontent'].getData();
            let excerpt = CKEDITOR.instances['postexcerpt'].getData();
            let category_id = $($this).parents('form').find('select[name="category_id"]').val();
            let tagsInput = $($this).parents('form').find('input[name="tags"]').val();
            let post_thumb = $($this).parents('form').find('input[name="post_thumb"]').val();
            var tags = tagsInput.split(',');
            let public = $($this).parents('form').find('input[name="public"]').is(':checked') ? 1 : 0;


            let formData = new FormData();
            formData.append('_token', csrf_token);
            formData.append('tittle', tittle);
            formData.append('slug', slug);
            formData.append('body', body);
            formData.append('excerpt', excerpt);
            formData.append('category_id', category_id);
            formData.append('post_thumb', post_thumb);
            formData.append('tags', tags);
            formData.append('public', public);
            $.ajax({
                url: "{{ route('admin.post.store') }}",
                type: 'POST',
                contentType: false,
                processData: false,
                data: formData,
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
                        })
                        $($this).parents('form').trigger('reset');
                        CKEDITOR.instances['postcontent'].setData('');
                        CKEDITOR.instances['postexcerpt'].setData('');
                        $('#postthumb').attr('src', "{{ asset('storage/images/upload.jpg') }}");
                        $('#postthumbnail').val('');
                        $('#tags').tagsinput('removeAll');
                        $('#public').bootstrapToggle('on');
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
        $('#tittle').keyup(function() {
            var title = $(this).val();
            var slug = stringToSlug(title);
            $('#slug').val(slug);
        });

        function stringToSlug(str) {
            var from = "àáãảạăằắẳẵặâầấẩẫậèéẻẽẹêềếểễệđùúủũụưừứửữựòóỏõọôồốổỗộơờớởỡợìíỉĩịäëïîöüûñçýỳỹỵỷ",
                to = "aaaaaaaaaaaaaaaaaeeeeeeeeeeeduuuuuuuuuuuoooooooooooooooooiiiiiaeiiouuncyyyyy";
            for (var i = 0, l = from.length; i < l; i++) {
                str = str.replace(RegExp(from[i], "gi"), to[i]);
            }
            str = str.toLowerCase()
                .trim()
                .replace(/[^a-z0-9\-]/g, '-')
                .replace(/-+/g, '-');
            return str;
        }
    </script>
@endsection
