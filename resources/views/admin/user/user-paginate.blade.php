<table class="table table-bordered" id="userTable" width="100%" cellspacing="0">
    <thead>
        <tr role="row">
            <th class="text-center">ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Related Post</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td class="text-center">{{ $user->id }}</td>
                <td class="col-sm-1 text-center">
                    <img src="{{ asset($user->images->path) }}" alt="{{ $user->name }}"
                        class="img-fluid rounded-rectage-height-avatar">
                </td>
                <td class="col-sm-2">{{ $user->name }}</td>
                <td class="col-sm-3">{{ $user->email }}</td>
                <td class="col-sm-2 text-center">
                    <a href="{{ route('admin.user.show', $user->id) }}"><input type="button" class="btn btn-primary"
                            value="Related Post"></a>
                </td>
                <td class="col-sm-1">{{ $user->role->name }}</td>
                <td class="col-sm-1">
                    @if ($user->status === 1)
                        <span class="badge badge-success pl-3 pr-3 pt-2 pb-2"><i class="fas fa-circle pr-1"></i>
                            Active</span>
                    @else
                        <span class="badge badge-danger pl-3 pr-3 pt-2 pb-2"><i class="fas fa-square pr-1"></i>
                            Disable</span>
                    @endif
                </td>
                <td class="col-sm-2">{{ $user->created_at->diffForHumans() }}</td>
                <td class="col-sm-2">
                    <div class="d-flex flex-row justify-content-center">
                        <a href="{{ route('admin.user.edit', $user) }}"><input type="button"
                                class="btn btn-primary mr-1" value="Edit"></a>
                        <input type="button" class="btn btn-danger mr-1"
                            onclick="deleteUser({{ $user->id }},'{{ csrf_token() }}')" value="Delete">
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
