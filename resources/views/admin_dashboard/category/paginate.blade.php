<table class="table table-bordered" id="categoryTable" width="100%" cellspacing="0">
    <thead>
        <tr role="row">
            <th class="text-center">ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Author</th>
            <th>Create At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <td class="text-center">{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->user->name }}</td>
                <td>{{ $category->created_at->diffForHumans() }}</td>
                <td>
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
