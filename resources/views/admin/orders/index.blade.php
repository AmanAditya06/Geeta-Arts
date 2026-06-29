@extends('admin.layout.app')
@section('title', 'Orders')
@section('page_heading', 'Orders')
@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-shopping-bag me-2"></i>All Orders</h5>
    </div>
    @if($orders->count())
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr><th>#</th><th>Customer</th><th>Total</th><th>Payment</th><th>Status</th><th>Date</th><th></th></tr>
            </thead>
            <tbody>
                @foreach($orders as $o)
                <tr>
                    <td>#{{ $o->id }}</td>
                    <td>{{ $o->user->name ?? 'N/A' }}<br><small class="text-muted">{{ $o->user->email ?? '' }}</small></td>
                    <td>₹{{ number_format($o->total) }}</td>
                    <td>{{ ucfirst($o->payment_method ?? 'N/A') }}</td>
                    <td><span class="badge-status bg-{{ $o->status == 'delivered' ? 'success' : ($o->status == 'pending' ? 'warning' : ($o->status == 'cancelled' ? 'danger' : 'info')) }} text-dark">{{ ucfirst($o->status) }}</span></td>
                    <td>{{ $o->created_at->format('d M Y') }}</td>
                    <td><a href="{{ route('admin.orders.show', $o) }}" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state"><i class="fas fa-shopping-bag"></i><p>No orders yet.</p></div>
    @endif
</div>
@endsection
