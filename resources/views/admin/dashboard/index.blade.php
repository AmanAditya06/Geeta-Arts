@extends('admin.layout.app')
@section('title', 'Dashboard')
@section('page_heading', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#0ea5e9;"><i class="fas fa-box"></i></div>
            <div class="stat-info">
                <h3>{{ $totalProducts }}</h3>
                <p>Total Products</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#8b5cf6;"><i class="fas fa-tags"></i></div>
            <div class="stat-info">
                <h3>{{ $totalCategories }}</h3>
                <p>Categories</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#10b981;"><i class="fas fa-shopping-bag"></i></div>
            <div class="stat-info">
                <h3>{{ $totalOrders }}</h3>
                <p>Total Orders</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#f59e0b;"><i class="fas fa-users"></i></div>
            <div class="stat-info">
                <h3>{{ $totalUsers }}</h3>
                <p>Users</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#ef4444;"><i class="fas fa-clock"></i></div>
            <div class="stat-info">
                <h3>{{ $pendingOrders }}</h3>
                <p>Pending Orders</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#14b8a6;"><i class="fas fa-rupee-sign"></i></div>
            <div class="stat-info">
                <h3>₹{{ number_format($totalRevenue) }}</h3>
                <p>Total Revenue</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#f43f5e;"><i class="fas fa-envelope"></i></div>
            <div class="stat-info">
                <h3>{{ $unreadContacts }}</h3>
                <p>Contact Messages</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="table-container">
            <div class="table-header">
                <h5><i class="fas fa-clock me-2"></i>Recent Orders</h5>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            @if($recentOrders->count())
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                            <td>₹{{ number_format($order->total) }}</td>
                            <td><span class="badge-status bg-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'pending' ? 'warning' : ($order->status == 'cancelled' ? 'danger' : 'info')) }} text-dark">{{ ucfirst($order->status) }}</span></td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-info">View</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-shopping-bag"></i>
                <p>No orders yet</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
