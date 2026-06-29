@extends('admin.layout.app')
@section('title', 'Categories')
@section('page_heading', 'Categories')
@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-tags me-2"></i>All Categories</h5>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-admin"><i class="fas fa-plus"></i> Add Category</a>
    </div>
    @if($categories->count())
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr><th>ID</th><th>Image</th><th>Name</th><th>Slug</th><th>Products</th><th>Status</th><th></th></tr>
            </thead>
            <tbody>
                @foreach($categories as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td><img src="{{ asset('assets/images/'.$c->image) }}" class="img-thumb" onerror="this.src='https://via.placeholder.com/60'"></td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->slug }}</td>
                    <td>{{ $c->products_count }}</td>
                    <td><span class="badge-status bg-{{ $c->status ? 'success' : 'danger' }} text-dark">{{ $c->status ? 'Active' : 'Inactive' }}</span></td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $c) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.categories.destroy', $c) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category? Products will be uncategorized.')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state"><i class="fas fa-tags"></i><p>No categories yet.</p></div>
    @endif
</div>
@endsection
