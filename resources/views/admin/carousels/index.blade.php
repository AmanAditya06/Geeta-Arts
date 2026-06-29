@extends('admin.layout.app')
@section('title', 'Carousel Images')
@section('page_heading', 'Carousel Images')
@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-images me-2"></i>All Carousel Images</h5>
        <a href="{{ route('admin.carousels.create') }}" class="btn btn-primary btn-admin"><i class="fas fa-plus"></i> Add Image</a>
    </div>
    @if($carousels->count())
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr><th>ID</th><th>Page</th><th>Section</th><th>Sort</th><th>Status</th><th></th></tr>
            </thead>
            <tbody>
                @foreach($carousels as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->page_slug }}</td>
                    <td>{{ $c->section_key }}</td>
                    <td>{{ $c->sort_order }}</td>
                    <td><span class="badge-status bg-{{ $c->status ? 'success' : 'danger' }} text-dark">{{ $c->status ? 'Active' : 'Inactive' }}</span></td>
                    <td>
                        <a href="{{ route('admin.carousels.edit', $c) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.carousels.destroy', $c) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state"><i class="fas fa-images"></i><p>No carousel images yet.</p></div>
    @endif
</div>
@endsection
