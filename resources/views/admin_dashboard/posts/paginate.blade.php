<table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid"
    aria-describedby="dataTable_info" style="width: 100%;">
    <thead>
        <tr role="row">
            <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 30px;">ID</th>
            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                aria-label="Position: activate to sort column ascending" style="width: 300px;">Tittle</th>
            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                aria-label="Position: activate to sort column ascending" style="width: 100px;">Category</th>
            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                aria-label="Position: activate to sort column ascending" style="width: 100px;">Tags</th>
            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                aria-label="Position: activate to sort column ascending" style="width: 150px;">Author</th>
            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                aria-label="Position: activate to sort column ascending" style="width: 100px;">Created At</th>
            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                aria-label="Position: activate to sort column ascending" style="width: 100px;">Action</th>
        </tr>
    <tbody>
        @foreach ($posts as $post)
            <tr>
                <td class="">{{ $post->id }}</td>
                <td class="">{{ $post->tittle }}</td>
                <td class="">{{ $post->categories->name }}</td>
                <td class="">
                    @foreach ($post->tags as $tag)
                        <span class="badge badge-info">{{ $tag->name }}</span>
                    @endforeach
                </td>
                <td class="">{{ $post->author->name }}</td>
                <td class="">{{ $post->created_at }}</td>
                <td class="">Action</td>
            </tr>
        @endforeach
    </tbody>
</table>

@section('custom-js')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
    <script>
        $('#dataTable').DataTable({
            "columnDefs": [{
                    "orderable": false,
                    "targets": [3, 6]
                },
                {
                    "orderable": true,
                    "targets": [0, 1, 2, 4, 5]
                }
            ],
        });
    </script>
@endsection
