@extends('admin.layout.main') @section('tittle', 'Create Comment')
@section('content')
    <div class="alert alert-info global-success global-alert d-none"></div>
    <form onsubmit="return false;" method="post">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="form-group mb-4">
                    <h4>Select post</h4>
                    <select class="form-control" name="post_id" id="post_id">
                        @foreach ($posts as $post)
                            <option value="{{ $post->id }}">{{ $post->tittle }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-4">
                    <h4>Comment</h4>
                    <textarea name="the_comment" id="the_comment" class="form-control" rows="5" required></textarea>
                </div>
                <div class="form-group mb-4 d-flex justify-content-end">
                    <button id="commentSave" type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </form>
@endsection

@section('custom-js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/ckfinder/ckfinder.js') }} "></script>
    <script>
        $(document).on('click', '#commentSave', (e) => {
            e.preventDefault;
            let $this = e.target;
            let csrf_token = $($this).parents('form').find('input[name="_token"]').val();
            let the_comment = $($this).parents('form').find('textarea[name="the_comment"]').val();
            let post_id = $($this).parents('form').find('select[name="post_id"]').val();

            let formData = new FormData();
            formData.append('_token', csrf_token);
            formData.append('the_comment', the_comment);
            formData.append('post_id', post_id);
            $.ajax({
                url: "{{ route('admin.comment.store') }}",
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
