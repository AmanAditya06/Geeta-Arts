@extends('admin.layout.app')
@section('title', isset($category) ? 'Edit Category' : 'Create Category')
@section('page_heading', isset($category) ? 'Edit Category' : 'Create Category')
@section('content')
<div class="form-card">
    <form action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($category)) @method('PUT') @endif
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @if(isset($category) && $category->image)
                    <small class="text-muted">Current: {{ $category->image }}</small>
                @endif
            </div>
            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description ?? '') }}</textarea>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input type="checkbox" name="status" class="form-check-input" id="status" value="1" {{ (old('status', $category->status ?? true)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Active</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-admin">{{ isset($category) ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-admin">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
