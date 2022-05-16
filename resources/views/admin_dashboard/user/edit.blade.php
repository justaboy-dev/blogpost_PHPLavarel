@extends('admin_dashboard.layout.main') @section('tittle', 'Edit User: ' . $user->name)
@section('content')
    <form onsubmit="return false;" method="post">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="form-group mb-4">
                    <h4>Name</h4>
                    <input type="text" id="name" name="name" class="form-control" placeholder="User name"
                        value="{{ $user->name }}" required autocomplete="username" />
                </div>
                <div class="form-group mb-4">
                    <h4>Email</h4>
                    <input type="email" id="email" name="email" class="form-control" placeholder="User email" required
                        value="{{ $user->email }}" autocomplete="email" />
                </div>
                <div class="form-group mb-4">
                    <h4>Password</h4>
                    <input type="password" id="password" name="password" class="form-control" placeholder="User password"
                        autocomplete="new-password" required />
                </div>
                <div class="form-group mb-4">
                    <h4>Confirm password</h4>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        autocomplete="new-password" placeholder="User password" required />
                </div>
                <div class="form-group mb-4">
                    <h4>Role</h4>
                    <select class="form-control" id="role_id" required name="role_id">
                        <option value="">Select role</option>
                        @foreach ($roles as $role)
                            <option {{ $user->role_id === $role->id ? 'selected' : '' }} value="{{ $role->id }}">
                                {{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-4">
                    <h4>Status</h4>
                    <select class="form-control" id="status" required name="status">
                        <option {{ $user->status === 1 ? 'selected' : '' }} value="1">Active</option>
                        <option {{ $user->status === 0 ? 'selected' : '' }} value="0">Supend</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-4">
                    <h4>Image</h4>
                    <div class="custom_image_box" id="upload" role="button">
                        <img id="postthumb" src="{{ asset($user->images->path) }}" alt="">
                        <input type="text" id="postthumbnail" value="{{ $user->images->path }}" name="post_thumb" hidden
                            required>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <input type="submit" id="userSave" class="btn btn-success btn-lg btn-block" value="Save">
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
        $(document).on('click', '#userSave', (e) => {
            e.preventDefault;
            let $this = e.target;
            let csrf_token = $($this).parents('form').find('input[name="_token"]').val();
            let name = $($this).parents('form').find('input[name="name"]').val();
            let email = $($this).parents('form').find('input[name="email"]').val();
            let password = $($this).parents('form').find('input[name="password"]').val();
            let password_confirmation = $($this).parents('form').find('input[name="password_confirmation"]').val();
            let role_id = $($this).parents('form').find('select[name="role_id"]').val();
            let status = $($this).parents('form').find('select[name="status"]').val();
            let post_thumb = $($this).parents('form').find('input[name="post_thumb"]').val();
            $.ajax({
                header: {
                    'X-CSRF-TOKEN': csrf_token
                },
                url: "{{ route('admin.user.update', $user) }}",
                type: 'PUT',
                contentType: 'application/json',
                processData: false,
                data: JSON.stringify({
                    _token: csrf_token,
                    name: name,
                    email: email,
                    password: password,
                    password_confirmation: password_confirmation,
                    role_id: role_id,
                    status: status,
                    post_thumb: post_thumb,
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
                        }).then(function() {
                            window.location.href =
                                "{{ route('admin.user.index') }}";
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
