@extends('admin.layout.main') @section('tittle', 'Create Role')
@section('content')
    <div class="alert alert-info global-success global-alert d-none"></div>
    <form onsubmit="return false;" method="post">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="row justify-content-between mb-4 mr-3">
                    <div class="col-8">
                        <h4>Select all</h4>
                    </div>
                    <div class="col-2">
                        <input type="checkbox" data-toggle="toggle" data-on="Select" id="selectAll" data-off="Unselect"
                            data-onstyle="success" data-offstyle="warning"
                            {{ $role->permissions->count() > 0 ? '' : 'checked' }}>
                    </div>
                </div>
                <div class="row">
                    @php
                        $the_count = count($permissions);
                        $start = 0;
                    @endphp
                    @for ($i = 1; $i <= 3; $i++)
                        @php
                            $end = round($the_count * ($i / 3));
                        @endphp
                        <div class="col-md-4">
                            @for ($j = $start; $j < $end; $j++)
                                <div class="form-check mb-3 pl-0">
                                    <div class="row">
                                        <div class="col-md-7 row align-items-center pl-0">
                                            <label class="form-check-label" for="permission{{ $permissions[$j]->id }}">
                                                {{ $permissions[$j]->name }}
                                            </label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="checkbox" name="permission[]" data-toggle="toggle" data-on="Enable"
                                                value="{{ $permissions[$j]->id }}"
                                                id="permission{{ $permissions[$j]->id }}" data-off="Disable"
                                                data-onstyle="success" data-offstyle="danger"
                                                {{ $role->permissions->contains($permissions[$j]->id) ? '' : 'checked' }}>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        @php
                            $start = $end;
                        @endphp
                    @endfor
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-4">
                    <h4>Role name</h4>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Role name"
                        value="{{ $role->name }}" required />
                </div>
                <div class="form-group mb-4">
                    <input type="submit" id="roleSave" class="btn btn-success btn-lg btn-block" value="Save">
                </div>
            </div>
        </div>
    </form>
@endsection

@section('custom-js')
    <script>
        $('#selectAll').change(function() {
            if ($(this).prop('checked')) {
                $('input[name="permission[]"]').each(function() {
                    $(this).bootstrapToggle('off');
                });
            } else {
                $('input[name="permission[]"]').each(function() {
                    $(this).bootstrapToggle('on');
                });
            }
        });
        $('input[name="permission[]"]').each(function() {
            if ($(this).prop('checked')) {
                $(this).bootstrapToggle('off');
            } else {
                $(this).bootstrapToggle('on');
            }
        });
        $(document).on('click', '#roleSave', (e) => {
            e.preventDefault;
            let $this = e.target;

            let permission = [];
            $('input[name="permission[]"]:checked').each(function() {
                permission.push($(this).val());
            });

            let csrf_token = $($this).parents('form').find('input[name="_token"]').val();
            let name = $($this).parents('form').find('input[name="name"]').val();

            let formData = new FormData();
            formData.append('_token', csrf_token);
            formData.append('name', name);
            formData.append('permission', permission.length > 0 ? permission.join(',') : JSON.stringify(
                permission));
            let url = "{{ route('admin.role.update', ':id') }}"
            url = url.replace(':id', "{{ $role->id }}");

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                url: url,
                type: 'PUT',
                contentType: 'application/json',
                processData: false,
                data: JSON.stringify({
                    name: name,
                    permission: permission.length > 0 ? permission : [],
                    _token: csrf_token
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
                            window.location.href = "{{ route('admin.role.index') }}";
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
