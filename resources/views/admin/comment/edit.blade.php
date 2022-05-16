@extends('admin.layout.main') @section('tittle', 'Edit Comment: ' . $comment->post->tittle)
@section('content')
    <div class="alert alert-info global-success global-alert d-none"></div>
    <form onsubmit="return false;" method="post">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="form-group mb-4">
                    <h4>Select post</h4>
                    <select class="form-control" name="post_id" value="{{ $comment->post_id }}" id="post_id">
                        @foreach ($posts as $post)
                            <option {{ $comment->post_id === $post->id ? 'selected' : '' }} value="{{ $post->id }}">
                                {{ $post->tittle }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-4">
                    <h4>Comment</h4>
                    <textarea name="the_comment" id="the_comment" class="form-control" rows="5" required></textarea>
                </div>
                <div class="form-group mb-4 d-flex justify-content-end">
                    <button id="commentSave" type="submit" class="btn btn-primary">Save</button>
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
        $('#the_comment').val('{{ $comment->the_comment }}');
        $(document).on('click', '#commentSave', (e) => {
            e.preventDefault;
            let $this = e.target;
            let csrf_token = $($this).parents('form').find('input[name="_token"]').val();
            let the_comment = $($this).parents('form').find('textarea[name="the_comment"]').val();
            let post_id = $($this).parents('form').find('select[name="post_id"]').val();
            let url = "{{ route('admin.comment.update', ':id') }}"
            url = url.replace(':id', "{{ $comment->id }}");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                url: url,
                type: 'PUT',
                contentType: 'application/json',
                processData: false,
                data: JSON.stringify({
                    "_token": csrf_token,
                    "the_comment": the_comment,
                    "post_id": post_id
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
                        }).then(() => {
                            window.location.href = "{{ route('admin.comment.index') }}";
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
