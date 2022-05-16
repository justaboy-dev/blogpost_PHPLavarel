@extends('admin_dashboard.layout.main')


@section('tittle', 'Tag')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                @include('admin_dashboard.tag.tag-paginate', [
                    'tags' => $tags,
                ])
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}"></script>
    <script>
        $('#tagTable').DataTable({
            "columnDefs": [{
                    "orderable": false,
                    "targets": [2, 4]
                },
                {
                    "orderable": true,
                    "targets": [0, 1, 3]
                }
            ],
            pageLength: 20,
            lengthMenu: [20, 50, 100, 200, 500],
        });

        function deleteTag(id, token) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this post!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var url = "{{ route('admin.tag.destroy', ':id') }}";
                        url = url.replace(':id', id);
                        $.ajax({
                            url: url.toString(),
                            type: "DELETE",
                            data: {
                                '_token': token,
                            },
                            success: function(data) {
                                swal(data["message"], {
                                    icon: data["success"] ? "success" : "error",
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
        };
    </script>
@endsection
