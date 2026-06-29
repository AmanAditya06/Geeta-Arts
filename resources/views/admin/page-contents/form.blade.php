@extends('admin.layout.app')
@section('title', isset($pageContent) ? 'Edit Page Content' : 'Create Page Content')
@section('page_heading', isset($pageContent) ? 'Edit Page Content' : 'Create Page Content')
@section('content')
<div class="form-card">
    <form action="{{ isset($pageContent) ? route('admin.page-contents.update', $pageContent) : route('admin.page-contents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($pageContent)) @method('PUT') @endif
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Page Slug *</label>
                <input type="text" name="page_slug" class="form-control" value="{{ old('page_slug', $pageContent->page_slug ?? '') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Section Key *</label>
                <input type="text" name="section_key" class="form-control" value="{{ old('section_key', $pageContent->section_key ?? '') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="col-md-4">
                <label class="form-label">Label</label>
                <input type="text" name="label" class="form-control" value="{{ old('label', $pageContent->label ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $pageContent->title ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Subtitle</label>
                <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $pageContent->subtitle ?? '') }}">
            </div>
            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $pageContent->description ?? '') }}</textarea>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input type="checkbox" name="status" class="form-check-input" id="status" value="1" {{ (old('status', $pageContent->status ?? true)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Active</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-admin">{{ isset($pageContent) ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.page-contents.index') }}" class="btn btn-secondary btn-admin">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
