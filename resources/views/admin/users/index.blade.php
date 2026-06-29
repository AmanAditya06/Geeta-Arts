@extends('admin.layout.app')
@section('title', 'Users')
@section('page_heading', 'Users')
@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-users me-2"></i>All Users</h5>
    </div>
    @if($users->count())
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Type</th><th>Joined</th><th></th></tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->phone ?? 'N/A' }}</td>
                    <td><span class="badge-status bg-{{ $u->user_type == 'admin' ? 'warning' : 'info' }} text-dark">{{ ucfirst($u->user_type) }}</span></td>
                    <td>{{ $u->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this user?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state"><i class="fas fa-users"></i><p>No users yet.</p></div>
    @endif
</div>
@endsection
