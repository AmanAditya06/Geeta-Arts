@extends('admin.layout.app')
@section('title', isset($carousel) ? 'Edit Carousel Image' : 'Create Carousel Image')
@section('page_heading', isset($carousel) ? 'Edit Carousel Image' : 'Create Carousel Image')
@section('content')
<div class="form-card">
    <form action="{{ isset($carousel) ? route('admin.carousels.update', $carousel) : route('admin.carousels.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($carousel)) @method('PUT') @endif
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Page Slug *</label>
                <input type="text" name="page_slug" class="form-control" value="{{ old('page_slug', $carousel->page_slug ?? '') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Section Key *</label>
                <input type="text" name="section_key" class="form-control" value="{{ old('section_key', $carousel->section_key ?? '') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $carousel->sort_order ?? 0) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input type="checkbox" name="status" class="form-check-input" id="status" value="1" {{ (old('status', $carousel->status ?? true)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Active</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-admin">{{ isset($carousel) ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.carousels.index') }}" class="btn btn-secondary btn-admin">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
