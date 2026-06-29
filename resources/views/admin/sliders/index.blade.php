@extends('admin.layout.app')
@section('title', 'Home Sliders')
@section('page_heading', 'Home Sliders')
@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-sliders-h me-2"></i>All Sliders</h5>
        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary btn-admin"><i class="fas fa-plus"></i> Add Slider</a>
    </div>
    @if($sliders->count())
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr><th>ID</th><th>Title</th><th>Button</th><th>Sort</th><th>Status</th><th></th></tr>
            </thead>
            <tbody>
                @foreach($sliders as $s)
                <tr>
                    <td>{{ $s->id }}</td>
                    <td>{{ $s->title ?? 'N/A' }}</td>
                    <td>{{ $s->button_text ?? 'N/A' }}</td>
                    <td>{{ $s->sort_order }}</td>
                    <td><span class="badge-status bg-{{ $s->status ? 'success' : 'danger' }} text-dark">{{ $s->status ? 'Active' : 'Inactive' }}</span></td>
                    <td>
                        <a href="{{ route('admin.sliders.edit', $s) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.sliders.destroy', $s) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state"><i class="fas fa-sliders-h"></i><p>No sliders yet.</p></div>
    @endif
</div>
@endsection
