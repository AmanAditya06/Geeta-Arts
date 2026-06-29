@extends('admin.layout.app')
@section('title', isset($product) ? 'Edit Product' : 'Create Product')
@section('page_heading', isset($product) ? 'Edit Product' : 'Create Product')
@section('content')
<div class="form-card">
    <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($product)) @method('PUT') @endif
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">SKU</label>
                <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select">
                    <option value="">-- None --</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ (old('category_id', $product->category_id ?? '') == $c->id) ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Type</label>
                <input type="text" name="type" class="form-control" value="{{ old('type', $product->type ?? 'default') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Price *</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock ?? 0) }}">
            </div>
            <div class="col-md-8">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @if(isset($product) && $product->image)
                    <small class="text-muted">Current: {{ $product->image }}</small>
                @endif
            </div>
            <div class="col-12">
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="status" class="form-check-input" id="status" value="1" {{ (old('status', $product->status ?? true)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured" value="1" {{ (old('is_featured', $product->is_featured ?? false)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_featured">Featured</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-admin">{{ isset($product) ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-admin">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
