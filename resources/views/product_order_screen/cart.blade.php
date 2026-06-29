@extends('layout.app')

@section('content')
<div class="gta-container">
    <div class="gta-header">
        <h1><i class="fas fa-shopping-cart"></i> Your Shopping Cart</h1>
    </div>
    <div class="gta-cart-content">
        <!-- CART ITEMS -->
        <div class="gta-cart-items">
            @if(session('cart') && count(session('cart')))

            @foreach(session('cart') as $id => $item)
            <div class="gta-cart-item">
                <a href="{{ route('user.order-details', ['id' => $id]) }}" class="gta-image">
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                </a>
                <div class="gta-item-details">
                    <a href="{{ route('user.order-details', ['id' => $id]) }}" class="gta-item-name">{{ $item['name'] }}</a>
                    <!-- <p class="product-subtitle">{{ $item['subtitle'] ?? 'No description available' }}</p> -->
                   <p class="description">{{ $item['subtitle'] ?? 'No description available' }}</p>
                    <div class="gta-item-price">₹{{ number_format($item['price']) }}</div>
                    <div class="gta-item-controls">
                        <div class="gta-qty-control">
                            <a href="{{ route('cart.qty', ['id' => $id, 'action' => 'decrease']) }}" class="gta-qty-btn"><i class="fa-solid fa-minus"></i></a>
                            <input type="text" class="gta-qty-input" value="{{ $item['quantity'] }}" readonly>
                            <a href="{{ route('cart.qty', ['id' => $id, 'action' => 'increase']) }}" class="gta-qty-btn"><i class="fa-solid fa-plus"></i></a>
                        </div>

                        <a class="gta-remove-btn" href="{{ route('cart.remove', $id) }}">Remove</a>
                    </div>
                </div>
            </div>
            @endforeach

            @else
            <div class="gta-empty-cart">
                <h3>Your cart is empty</h3>
                <a href="/" class="gta-btn gta-btn-primary mt-3">Continue Shopping</a>
            </div>
            @endif

        </div>

        <!-- ORDER SUMMARY -->
        <div>
            <div class="gta-order-summary">
                <h3 class="gta-summary-title">Order Summary</h3>

                <div class="gta-summary-row">
                    <span>Subtotal:</span>
                    <span>₹{{ number_format($subtotal) }}</span>
                </div>

                <div class="gta-summary-row">
                    <span>Shipping Charges:</span>
                    <span>₹{{ $shipping }}</span>
                </div>

                <div class="gta-summary-row">
                    <span>Discount:</span>
                    <span style="color:green;">- ₹{{ $discount }}</span>
                </div>

                <div class="gta-summary-row gta-total">
                    <span>Total:</span>
                    <span>₹{{ number_format($total) }}</span>
                </div>

                <a href="{{ route('checkout.index') }}" class="gta-checkout-btn" style="display:block; text-align:center; text-decoration:none;">Proceed to Checkout</a>
            </div>
        </div>
    </div>
</div>
@endsection