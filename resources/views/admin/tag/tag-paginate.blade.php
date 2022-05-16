<table class="table table-bordered" id="tagTable" width="100%" cellspacing="0">
    <thead>
        <tr role="row">
            <th class="text-center">ID</th>
            <th>Name</th>
            <th>Related Post</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tags as $tag)
            <tr>
                <td class="text-center col-sm-1">{{ $tag->id }}</td>
                <td class="col-sm-4 ">{{ $tag->name }}</td>
                <td class="text-center col-sm-2">
                    <a href="{{ route('admin.tag.show', $tag->id) }}"><input type="button" class="btn btn-primary"
                            value="Related Post"></a>
                </td>
                <td class="col-sm-2">{{ $tag->created_at->diffForHumans() }}</td>
                <td class="col-sm-2">
                    <div class="d-flex flex-row justify-content-center">
                        <a href="{{ route('admin.tag.edit', $tag) }}">
                            <input type="button" class="btn btn-primary mr-1" value="Edit">
                        </a>
                        <input type="button" class="btn btn-danger mr-1"
                            onclick="deleteTag({{ $tag->id }},'{{ csrf_token() }}')" value="Delete">
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
