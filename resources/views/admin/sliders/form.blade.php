@extends('admin.layout.app')
@section('title', isset($slider) ? 'Edit Slider' : 'Create Slider')
@section('page_heading', isset($slider) ? 'Edit Slider' : 'Create Slider')
@section('content')
<div class="form-card">
    <form action="{{ isset($slider) ? route('admin.sliders.update', $slider) : route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($slider)) @method('PUT') @endif
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $slider->title ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Subtitle</label>
                <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $slider->subtitle ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Button Text</label>
                <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $slider->button_text ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Button Link</label>
                <input type="text" name="button_link" class="form-control" value="{{ old('button_link', $slider->button_link ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $slider->sort_order ?? 0) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input type="checkbox" name="status" class="form-check-input" id="status" value="1" {{ (old('status', $slider->status ?? true)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Active</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-admin">{{ isset($slider) ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary btn-admin">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
