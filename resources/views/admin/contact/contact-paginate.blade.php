<table class="table table-bordered" id="contactTable" width="100%" cellspacing="0">
    <thead>
        <tr role="row">
            <th class="text-center">ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contacts as $contact)
            <tr>
                <td class="text-center">{{ $contact->id }}</td>
                <td class="col-sm-1">{{ $contact->first_name }}</td>
                <td class="col-sm-1">{{ $contact->last_name }}</td>
                <td class="col-sm-2">{{ $contact->email }}</td>
                <td class="col-sm-3">{{ $contact->subject }}</td>
                <td class="col-sm-3">{{ Str::limit($contact->message, 50) }}</td>
                <td class="col-sm-1">
                    <div class="d-flex flex-row justify-content-center">
                        <input type="button" class="btn btn-danger mr-1"
                            onclick="deletecontact({{ $contact->id }},'{{ csrf_token() }}')" value="Delete">
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
