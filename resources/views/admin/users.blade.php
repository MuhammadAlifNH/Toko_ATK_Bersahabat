@extends('layouts.app_oprator')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>List Users</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h1 class="mb-4">List Users</h1>

        <form method="GET" action="{{ route('admin.users') }}" class="form-inline mb-4">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search by name or email" value="{{ request('search') }}">
            <select name="status" class="form-control mr-2">
                <option value="">All Status</option>
                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>User</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Admin</option>
            </select>
            <input type="date" name="ttl" class="form-control mr-2" value="{{ request('ttl') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>TTL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->status == 0 ? 'User' : ($user->status == 1 ? 'Admin' : 'Owner') }}</td>
            <td>{{ $user->TTL }}</td>
            <td>
                @if (auth()->user()->status == 2 || (auth()->user()->status == 1 && $user->status == 0))
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
</tbody>
        </table>

        {{ $users->links() }}
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection