<table class="table table-bordered" id="roleTable" width="100%" cellspacing="0">
    <thead>
        <tr role="row">
            <th class="text-center">ID</th>
            <th>Name</th>
            <th>Related user</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $role)
            <tr>
                <td class="text-center col-sm-1">{{ $role->id }}</td>
                <td class="col-sm-4 ">{{ $role->name }}</td>
                <td class="text-center col-sm-2">
                    <a href="{{ route('admin.role.show', $role->id) }}"><input type="button" class="btn btn-primary"
                            value="Related User"></a>
                </td>
                <td class="col-sm-2">{{ $role->created_at->diffForHumans() }}</td>
                <td class="col-sm-2">
                    <div class="d-flex flex-row justify-content-center">
                        <a href="{{ route('admin.role.edit', $role) }}">
                            <input type="button" class="btn btn-primary mr-1" value="Edit">
                        </a>
                        <input type="button" class="btn btn-danger mr-1"
                            onclick="deleteRole({{ $role->id }},'{{ csrf_token() }}')" value="Delete">
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
