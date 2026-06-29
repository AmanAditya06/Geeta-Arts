@extends('admin.layout.app')
@section('title', 'Page Contents')
@section('page_heading', 'Page Contents')
@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-file-alt me-2"></i>All Page Content</h5>
        <a href="{{ route('admin.page-contents.create') }}" class="btn btn-primary btn-admin"><i class="fas fa-plus"></i> Add Content</a>
    </div>
    @if($contents->count())
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr><th>ID</th><th>Page</th><th>Section Key</th><th>Label</th><th>Title</th><th>Status</th><th></th></tr>
            </thead>
            <tbody>
                @foreach($contents as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td><span class="badge-status bg-secondary text-white">{{ $c->page_slug }}</span></td>
                    <td><code>{{ $c->section_key }}</code></td>
                    <td>{{ $c->label ?? 'N/A' }}</td>
                    <td>{{ Str::limit($c->title ?? 'N/A', 30) }}</td>
                    <td><span class="badge-status bg-{{ $c->status ? 'success' : 'danger' }} text-dark">{{ $c->status ? 'Active' : 'Inactive' }}</span></td>
                    <td>
                        <a href="{{ route('admin.page-contents.edit', $c) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.page-contents.destroy', $c) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state"><i class="fas fa-file-alt"></i><p>No page content yet.</p></div>
    @endif
</div>
@endsection
