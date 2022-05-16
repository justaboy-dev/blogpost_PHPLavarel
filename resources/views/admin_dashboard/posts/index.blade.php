@extends('admin_dashboard.layout.main')
@section('tittle', 'Posts')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                @include('admin_dashboard.posts.post-paginate', [
                    'posts' => $posts,
                ])
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}"></script>
    <script>
        $('#postTable').DataTable({
            "columnDefs": [{
                    "orderable": false,
                    "targets": [6]
                },
                {
                    "orderable": true,
                    "targets": [0, 1, 2, 3, 4, 5]
                }
            ],
            pageLength: 20,
            lengthMenu: [20, 50, 100, 200, 500],
        });

        function deletePost(id, token) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this post!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var url = "{{ route('admin.post.destroy', ':id') }}";
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
