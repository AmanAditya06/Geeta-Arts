@extends('admin.layout.app')
@section('title', 'Contact Messages')
@section('page_heading', 'Contact Messages')
@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-envelope me-2"></i>All Messages</h5>
    </div>
    @if($contacts->count())
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Message</th><th>Date</th><th></th></tr>
            </thead>
            <tbody>
                @foreach($contacts as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->email }}</td>
                    <td>{{ $c->number ?? 'N/A' }}</td>
                    <td>{{ Str::limit($c->message, 50) }}</td>
                    <td>{{ $c->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.contacts.show', $c) }}" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i></a>
                        <form action="{{ route('admin.contacts.destroy', $c) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this message?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state"><i class="fas fa-envelope"></i><p>No messages yet.</p></div>
    @endif
</div>
@endsection
