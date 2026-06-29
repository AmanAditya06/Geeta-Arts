@extends('admin.layout.app')
@section('title', 'Edit User')
@section('page_heading', 'Edit User')
@section('content')
<div class="form-card">
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">User Type</label>
                <select name="user_type" class="form-select">
                    <option value="user" {{ $user->user_type == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-admin">Update</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-admin">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
