@extends('admin.layout.app')
@section('title', isset($banner) ? 'Edit Banner' : 'Create Banner')
@section('page_heading', isset($banner) ? 'Edit Banner' : 'Create Banner')
@section('content')
<div class="form-card">
    <form action="{{ isset($banner) ? route('admin.banners.update', $banner) : route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($banner)) @method('PUT') @endif
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Type *</label>
                <select name="ref_type" class="form-select" required>
                    <option value="page" {{ (old('ref_type', $banner->ref_type ?? '') == 'page') ? 'selected' : '' }}>Page</option>
                    <option value="category" {{ (old('ref_type', $banner->ref_type ?? '') == 'category') ? 'selected' : '' }}>Category</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Slug *</label>
                <input type="text" name="ref_slug" class="form-control" value="{{ old('ref_slug', $banner->ref_slug ?? '') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="col-md-6">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Subtitle</label>
                <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $banner->subtitle ?? '') }}">
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input type="checkbox" name="status" class="form-check-input" id="status" value="1" {{ (old('status', $banner->status ?? true)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Active</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-admin">{{ isset($banner) ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary btn-admin">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
