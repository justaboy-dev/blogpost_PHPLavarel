<table class="table table-bordered" id="categoryTable" width="100%" cellspacing="0">
    <thead>
        <tr role="row">
            <th class="text-center">ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Related Post</th>
            <th>Author</th>
            <th>Create At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <td class="text-center">{{ $category->id }}</td>
                <td class="col-sm-2">{{ $category->name }}</td>
                <td class="col-sm-4">{{ $category->slug }}</td>
                <td class="text-center col-sm-2">
                    <a href="{{ route('admin.category.show', $category->id) }}"><input type="button"
                            class="btn btn-primary" value="Related Post"></a>
                </td>
                <td class="col-sm-2">{{ $category->user->name }}</td>
                <td class="col-sm-2">{{ $category->created_at->diffForHumans() }}</td>
                <td class="col-sm-2">
                    <div class="d-flex flex-row justify-content-center">
                        <a href="{{ route('admin.category.edit', $category) }}"><input type="button"
                                class="btn btn-primary mr-1" value="Edit"></a>
                        <input type="button" class="btn btn-danger mr-1"
                            onclick="deleteCategory({{ $category->id }},'{{ csrf_token() }}')" value="Delete">
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
