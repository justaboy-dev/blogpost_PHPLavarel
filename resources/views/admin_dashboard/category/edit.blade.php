@extends('admin_dashboard.layout.main') @section('tittle', 'Update Category')
@section('content')
    <div class="alert alert-info global-success global-alert d-none"></div>
    <form onsubmit="return false;" method="post">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="form-group mb-4">
                    <h4>Category name</h4>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $category->name }}"
                        placeholder="Category name" required />
                </div>
                <div class="form-group mb-4">
                    <h4>Category slug</h4>
                    <input type="text" id="slug" name="slug" class="form-control" value="{{ $category->slug }}"
                        placeholder="Category slug" required />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-4">
                    <h4>Category thumbnail</h4>
                    <div id="upload" class="custom_image_box" role="button">
                        <img id="postthumb" src="{{ asset($category->images->path) }}" alt="">
                        <input type="text" id="postthumbnail" name="category_thumb" value="{{ $category->images->path }}"
                            hidden required>
                    </div>
                </div>
                <div class="form-group mb-4 mt-8">
                    <input type="submit" id="categoryUpdate" class="btn btn-success btn-lg btn-block" value="Save">
                </div>
            </div>
        </div>
    </form>
@endsection

@section('custom-js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/ckfinder/ckfinder.js') }}"></script>
    <script>
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
        $(document).on('click', '#categoryUpdate', (e) => {
            e.preventDefault;
            let $this = e.target;
            let csrf_token = $($this).parents('form').find('input[name="_token"]').val();
            let name = $($this).parents('form').find('input[name="name"]').val();
            let slug = $($this).parents('form').find('input[name="slug"]').val();
            let category_thumb = $($this).parents('form').find('input[name="category_thumb"]').val();
            let formData = new FormData();
            formData.append('_token', csrf_token);
            formData.append('name', name);
            formData.append('slug', slug);
            formData.append('category_thumb', category_thumb);
            $.ajax({
                url: "{{ route('admin.admin_dashboard.category.update', $category) }}",
                type: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                dataType: 'JSON',
                success: function(data) {
                    if (data.success) {
                        swal({
                            position: 'top-end',
                            icon: 'success',
                            title: data.message,
                            button: false,
                            timer: 1500
                        }).then(
                            function() {
                                window.location.href =
                                    "{{ route('admin.admin_dashboard.category.index') }}";
                            },
                        );
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
        $('#name').keyup(function() {
            var name = $(this).val();
            var slug = stringToSlug(name);
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
