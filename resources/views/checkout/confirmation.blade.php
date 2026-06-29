@extends('layout.app')

@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 p-5">
                <div class="mb-4">
                    <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                </div>
                <h2 class="mb-3">Order Placed Successfully!</h2>
                <p class="text-muted mb-4">Thank you for your order. Your order number is:</p>
                <h3 class="fw-bold mb-4" style="color: var(--primary-color);">{{ $order->order_number }}</h3>
                <p class="mb-1">We will process your order shortly.</p>
                <p class="mb-4">You will receive a confirmation email with your order details.</p>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('user.orders') }}" class="btn btn-primary px-4 py-2" style="background: var(--primary-color); border: none; border-radius: 30px;">
                        View My Orders
                    </a>
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 30px;">
                        Continue Shopping
                    </a>
                </div>
            </div>

            <div class="card shadow-sm border-0 p-4 mt-4 text-start">
                <h5 class="mb-3">Order Summary</h5>
                <p><strong>Order #:</strong> {{ $order->order_number }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                <p><strong>Payment:</strong> {{ ucfirst($order->payment_method) }}</p>
                <p><strong>Status:</strong> <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span></p>
                <hr>
                <p><strong>Shipping to:</strong><br>
                {{ $order->shipping_name }}<br>
                {{ $order->shipping_address }}<br>
                {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}</p>
                <hr>
                <h6>Items</h6>
                @foreach($order->items as $item)
                <div class="d-flex justify-content-between mb-1">
                    <span>{{ $item->product_name }} × {{ $item->quantity }}</span>
                    <span>₹{{ number_format($item->total) }}</span>
                </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between"><span>Subtotal</span><span>₹{{ number_format($order->subtotal) }}</span></div>
                <div class="d-flex justify-content-between"><span>Shipping</span><span>₹{{ number_format($order->shipping) }}</span></div>
                @if($order->discount > 0)
                <div class="d-flex justify-content-between text-success"><span>Discount</span><span>-₹{{ number_format($order->discount) }}</span></div>
                @endif
                <div class="d-flex justify-content-between fw-bold fs-5 mt-2"><span>Total</span><span>₹{{ number_format($order->total) }}</span></div>
            </div>
        </div>
    </div>
</div>

<style>
.card { border-radius: 12px; }
</style>
@endsection
