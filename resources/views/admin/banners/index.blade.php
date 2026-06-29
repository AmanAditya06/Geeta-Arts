@extends('admin.layout.app')
@section('title', 'Hero Banners')
@section('page_heading', 'Hero Banners')
@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-images me-2"></i>All Banners</h5>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary btn-admin"><i class="fas fa-plus"></i> Add Banner</a>
    </div>
    @if($banners->count())
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr><th>ID</th><th>Type</th><th>Slug</th><th>Title</th><th>Status</th><th></th></tr>
            </thead>
            <tbody>
                @foreach($banners as $b)
                <tr>
                    <td>{{ $b->id }}</td>
                    <td><span class="badge-status bg-info text-dark">{{ ucfirst($b->ref_type) }}</span></td>
                    <td>{{ $b->ref_slug }}</td>
                    <td>{{ $b->title ?? 'N/A' }}</td>
                    <td><span class="badge-status bg-{{ $b->status ? 'success' : 'danger' }} text-dark">{{ $b->status ? 'Active' : 'Inactive' }}</span></td>
                    <td>
                        <a href="{{ route('admin.banners.edit', $b) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.banners.destroy', $b) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state"><i class="fas fa-images"></i><p>No banners yet.</p></div>
    @endif
</div>
@endsection
