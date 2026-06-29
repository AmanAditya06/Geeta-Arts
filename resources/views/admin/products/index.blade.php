@extends('admin.layout.app')
@section('title', 'Products')
@section('page_heading', 'Products')
@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-box me-2"></i>All Products</h5>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-admin"><i class="fas fa-plus"></i> Add Product</a>
    </div>
    @if($products->count())
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr><th>ID</th><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Status</th><th></th></tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td><img src="{{ asset('assets/images/Product-images/'.$p->image) }}" class="img-thumb" onerror="this.src='https://via.placeholder.com/60'"></td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->category->name ?? 'N/A' }}</td>
                    <td>₹{{ number_format($p->price) }}</td>
                    <td>{{ $p->stock }}</td>
                    <td><span class="badge-status bg-{{ $p->status ? 'success' : 'danger' }} text-dark">{{ $p->status ? 'Active' : 'Inactive' }}</span></td>
                    <td>
                        <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.products.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state"><i class="fas fa-box"></i><p>No products yet.</p></div>
    @endif
</div>
@endsection
