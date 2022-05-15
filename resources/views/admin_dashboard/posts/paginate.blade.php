<table class="table table-bordered" id="postTable" width="100%" cellspacing="0">
    <thead>
        <tr role="row">
            <th class="text-center">ID</th>
            <th>Tittle</th>
            <th>Category</th>
            <th>Author</th>
            <th>Create At</th>
            <th>Post status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
            <tr>
                <td class="text-center">{{ $post->id }}</td>
                <td>{{ $post->tittle }}</td>
                <td>{{ $post->categories->name }}</td>
                <td>{{ $post->author->name }}</td>
                <td>{{ $post->created_at->diffForHumans() }}</td>
                <td>
                    @if ($post->public === 1)
                        <span class="badge badge-success pl-3 pr-3 pt-2 pb-2"><i class="fas fa-circle pr-1"></i>
                            Publish</span>
                    @else
                        <span class="badge badge-warning pl-3 pr-3 pt-2 pb-2"><i class="fas fa-square pr-1"></i>
                            Draft</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex flex-row justify-content-center">
                        <a href="{{ route('admin.post.edit', $post) }}"><input type="button"
                                class="btn btn-primary mr-1" value="Edit"></a>
                        <input type="button" class="btn btn-danger mr-1"
                            onclick="deletePost({{ $post->id }},'{{ csrf_token() }}')" value="Delete">
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
