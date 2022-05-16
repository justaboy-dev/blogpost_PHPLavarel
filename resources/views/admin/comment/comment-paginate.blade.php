<table class="table table-bordered" id="commentTable" width="100%" cellspacing="0">
    <thead>
        <tr role="row">
            <th class="text-center">ID</th>
            <th>The comment</th>
            <th>Post tittle</th>
            <th>User</th>
            <th>Create At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($comments as $comment)
            <tr>
                <td class="text-center">{{ $comment->id }}</td>
                <td class="col-sm-4">
                    {{ Str::limit($comment->the_comment, 50) }}
                </td>
                <td class="col-sm-3">
                    {{ Str::limit($comment->post->tittle, 40) }}
                </td>
                <td class="col-sm-2">{{ $comment->user->name }}</td>
                <td class="col-sm-2">{{ $comment->created_at->diffForHumans() }}</td>
                <td class="col-sm-2">
                    <div class="d-flex flex-row justify-content-center">
                        <a href="{{ route('admin.comment.edit', $comment) }}"><input type="button"
                                class="btn btn-primary mr-1" value="Edit"></a>
                        <input type="button" class="btn btn-danger mr-1"
                            onclick="deleteComment({{ $comment->id }},'{{ csrf_token() }}')" value="Delete">
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
