@extends('admin.layout.app')
@section('title', 'Message #'.$contact->id)
@section('page_heading', 'Message from '.$contact->name)
@section('content')
<div class="form-card">
    <div class="mb-3"><strong>Name:</strong> {{ $contact->name }}</div>
    <div class="mb-3"><strong>Email:</strong> {{ $contact->email }}</div>
    <div class="mb-3"><strong>Phone:</strong> {{ $contact->number ?? 'N/A' }}</div>
    <div class="mb-3"><strong>Date:</strong> {{ $contact->created_at->format('d M Y h:i A') }}</div>
    <div class="mb-3"><strong>Message:</strong></div>
    <div class="p-3 bg-light rounded">{{ $contact->message }}</div>
    <div class="mt-4">
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary btn-admin">Back</a>
        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger btn-admin">Delete</button>
        </form>
    </div>
</div>
@endsection
