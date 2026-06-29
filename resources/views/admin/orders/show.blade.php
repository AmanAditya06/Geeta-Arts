@extends('admin.layout.app')
@section('title', 'Order #'.$order->id)
@section('page_heading', 'Order #'.$order->id)
@section('content')
<div class="row g-4">
    <div class="col-md-8">
        <div class="table-container mb-4">
            <h5 class="mb-3"><i class="fas fa-box me-2"></i>Order Items</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-light">
                        <tr><th>Product</th><th>Price</th><th>Qty</th><th>Total</th></tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>₹{{ number_format($item->price) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>₹{{ number_format($item->total) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr><th colspan="3" class="text-end">Subtotal</th><th>₹{{ number_format($order->subtotal) }}</th></tr>
                        <tr><td colspan="3" class="text-end">Shipping</td><td>₹{{ number_format($order->shipping) }}</td></tr>
                        @if($order->discount > 0)<tr><td colspan="3" class="text-end">Discount</td><td>-₹{{ number_format($order->discount) }}</td></tr>@endif
                        <tr class="table-active"><th colspan="3" class="text-end">Total</th><th>₹{{ number_format($order->total) }}</th></tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="table-container">
            <h5 class="mb-3"><i class="fas fa-truck me-2"></i>Shipping Address</h5>
            <p>{{ $order->shipping_name }}<br>{{ $order->shipping_address }}<br>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}<br>{{ $order->shipping_country }}<br>Phone: {{ $order->shipping_phone }}</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="table-container mb-4">
            <h5 class="mb-3"><i class="fas fa-info-circle me-2"></i>Order Info</h5>
            <p><strong>Status:</strong> <span class="badge-status bg-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'pending' ? 'warning' : ($order->status == 'cancelled' ? 'danger' : 'info')) }}">{{ ucfirst($order->status) }}</span></p>
            <p><strong>Payment:</strong> {{ ucfirst($order->payment_method ?? 'N/A') }}</p>
            <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status ?? 'N/A') }}</p>
            <p><strong>Date:</strong> {{ $order->created_at->format('d M Y h:i A') }}</p>
            @if($order->notes)<p><strong>Notes:</strong> {{ $order->notes }}</p>@endif
        </div>
        <div class="table-container">
            <h5 class="mb-3"><i class="fas fa-edit me-2"></i>Update Status</h5>
            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                @csrf
                <select name="status" class="form-select mb-3">
                    @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                        <option value="{{ $s }}" {{ $order->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary btn-admin w-100">Update Status</button>
            </form>
            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="mt-2" onsubmit="return confirm('Delete this order?')">
                @csrf @method('DELETE')
                <button class="btn btn-outline-danger btn-admin w-100"><i class="fas fa-trash"></i> Delete Order</button>
            </form>
        </div>
    </div>
</div>
@endsection
