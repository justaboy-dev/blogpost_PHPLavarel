<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr role="row">
            <th>ID</th>
            <th>Tittle</th>
            <th>Category</th>
            <th>Author</th>
            <th>Create At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->tittle }}</td>
                <td>{{ $post->categories->name }}</td>
                <td>{{ $post->author->name }}</td>
                <td>{{ $post->created_at }}</td>
                <td>
                    <div class="d-flex flex-row">
                        <a href="{{ route('admin.admin_dashboard.post.edit', $post) }}"><input type="button"
                                class="btn btn-primary mr-1" value="Edit"></a>
                        <input type="button" class="btn btn-danger mr-1" onclick="deletePost({{ $post->id }})"
                            value="Delete">
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
