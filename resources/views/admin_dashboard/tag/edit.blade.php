@extends('admin_dashboard.layout.main')
@section('tittle', 'Update Tag: ' . $tag->name)
@section('content')
    <div class="alert alert-info global-success global-alert d-none"></div>
    <form onsubmit="return false;" method="post">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <h4>Tag name</h4>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $tag->name }}"
                        placeholder="Tag name" required />
                </div>
                <div class="form-group mb-4 mt-8 d-flex justify-content-end">
                    <input type="submit" id="tagUpdate" class="btn btn-success btn-lg" value="Save">
                </div>
            </div>
        </div>
    </form>
@endsection

@section('custom-js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/ckfinder/ckfinder.js') }}"></script>
    <script>
        $(document).on('click', '#tagUpdate', (e) => {
            e.preventDefault;
            let $this = e.target;
            let csrf_token = $($this).parents('form').find('input[name="_token"]').val();
            let name = $($this).parents('form').find('input[name="name"]').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': csrf_token,
                },
                url: "{{ route('admin.tag.update', $tag) }}",
                type: 'PUT',
                contentType: 'application/json',
                processData: false,
                data: JSON.stringify({
                    "_token": csrf_token,
                    "name": name,
                }),
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
                                    "{{ route('admin.tag.index') }}";
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
    </script>
@endsection
