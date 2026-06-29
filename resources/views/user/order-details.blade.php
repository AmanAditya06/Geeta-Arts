@extends('layout.app')

@section('content')
<div class="gtaprof-main">
    <div class="gtaprof-header">
        <a href="{{ route('user.orders') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Orders
        </a>
        <h1 class="gtaprof-title">Order Details</h1>
        @if($order)
        <p class="gtaprof-subtitle">Order #{{ $order->order_number }} • Placed on {{ $order->created_at->format('M d, Y') }}</p>
        @endif
    </div>

    <div class="gtaprof-body">
        @if($order)
        <div class="order-details-container">
            <div class="order-summary">
                <div class="order-summary-card">
                    <h3>Order Summary</h3>
                    @foreach($order->items as $item)
                    <div class="order-product">
                        <div class="product-info">
                            <h4>{{ $item->product_name }}</h4>
                            <p>Quantity: {{ $item->quantity }}</p>
                            <p class="price">₹{{ number_format($item->total) }}</p>
                        </div>
                    </div>
                    @endforeach

                    <div class="summary-row">
                        <span>Subtotal ({{ $order->items->sum('quantity') }} item)</span>
                        <span>₹{{ number_format($order->subtotal) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span class="free-shipping">{{ $order->shipping > 0 ? '₹'.number_format($order->shipping) : 'FREE' }}</span>
                    </div>
                    @if($order->discount > 0)
                    <div class="summary-row">
                        <span>Discount</span>
                        <span style="color:green;">-₹{{ number_format($order->discount) }}</span>
                    </div>
                    @endif
                    <div class="summary-row total">
                        <span>Total</span>
                        <span>₹{{ number_format($order->total) }}</span>
                    </div>

                    <div class="shipping-address">
                        <h4>Shipping Address</h4>
                        <p>{{ $order->shipping_name }}<br>
                        {{ $order->shipping_address }}<br>
                        {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}<br>
                        {{ $order->shipping_country }}<br>
                        Phone: {{ $order->shipping_phone }}</p>
                    </div>

                    <div class="payment-method">
                        <h4>Payment Method</h4>
                        <div class="payment-details">
                            <span>{{ ucfirst($order->payment_method) }} ({{ ucfirst($order->payment_status) }})</span>
                        </div>
                    </div>

                    <div class="order-status mt-3">
                        <span class="badge-status bg-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'pending' ? 'warning' : ($order->status == 'cancelled' ? 'danger' : 'info')) }}">
                            Status: {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    @if(in_array($order->status, ['pending', 'processing']))
                    <div class="mt-3">
                        <form method="POST" action="{{ route('user.orders.cancel', $order) }}" onsubmit="return confirm('Are you sure you want to cancel this order?')">
                            @csrf
                            <button type="submit" class="gtaprof-btn btn-primary" style="background:#dc2625;border-color:#dc2625;">
                                <i class="fas fa-times"></i> Cancel Order
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @else
        <div class="order-empty">
            <div class="order-empty-icon"><i class="fas fa-shopping-bag"></i></div>
            <h3 class="order-empty-title">Order Not Found</h3>
            <a href="{{ route('user.orders') }}" class="gtaprof-btn gtaprof-btn-primary">Back to Orders</a>
        </div>
        @endif
    </div>
</div>

<style>
.back-link { display: inline-flex; align-items: center; color: var(--primary-color); text-decoration: none; margin-bottom: 15px; font-weight: 500; }
.back-link i { margin-right: 8px; }
.order-summary { margin-top: 30px; }
.order-product { padding: 15px; border: 1px solid #eee; border-radius: 6px; margin-bottom: 10px; }
.product-info h4 { margin: 0 0 5px; color: var(--text); }
.price { color: var(--primary-color) !important; font-weight: 600; }
.order-summary-card { background: var(--card); border-radius: 8px; padding: 25px; box-shadow: 0 2px 15px rgba(0,0,0,0.05); }
.summary-row { display: flex; justify-content: space-between; margin-bottom: 12px; color: #555; }
.summary-row.total { margin-top: 20px; padding-top: 15px; border-top: 1px solid var(--border-color); font-size: 1.2em; font-weight: 700; color: var(--text); }
.free-shipping { color: #10b981; font-weight: 600; }
.shipping-address, .payment-method { margin-top: 25px; padding-top: 20px; border-top: 1px solid var(--border-color); }
.shipping-address h4, .payment-method h4 { margin-top: 0; margin-bottom: 15px; }
.order-empty { text-align: center; padding: 40px 20px; }
.badge-status { padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; }
.bg-success { background: #d1fae5; color: #065f46; }
.bg-warning { background: #fef3c7; color: #92400e; }
.bg-danger { background: #fee2e2; color: #991b1b; }
.bg-info { background: #dbeafe; color: #1e40af; }
</style>
@endsection
