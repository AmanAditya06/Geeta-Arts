@extends('layout.app')

@section('content')
<div class="gtaprof-main">
    <div class="gtaprof-header">
        <h1 class="gtaprof-title">My Orders</h1>
        <p class="gtaprof-subtitle">View your order history and track shipments</p>
    </div>

    <div class="gtaprof-body">
        @if(isset($orders) && count($orders) > 0)
            <div class="order-list">
                @foreach($orders as $order)
                <div class="order-item">
                    <div class="order-header">
                        <div>
                            <span class="order-number">Order #{{ $order->id }}</span>
                            <span class="order-date">Placed on: {{ $order->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="order-status status-{{ strtolower($order->status) }}">
                            {{ ucfirst($order->status) }}
                        </div>
                    </div>

                    <div class="order-details">
                        @if(isset($order->items) && count($order->items) > 0)
                            @foreach($order->items as $item)
                            <div class="order-product">
                                @if(isset($item->image))
                                <img src="{{ asset($item->image) }}" alt="{{ $item->name ?? 'Product' }}" class="product-image">
                                @endif
                                <div class="product-info">
                                    <h4>{{ $item->name ?? 'Product' }}</h4>
                                    <p>Quantity: {{ $item->quantity ?? 1 }}</p>
                                    @if(isset($item->price))
                                    <p class="price">₹{{ number_format(($item->price * ($item->quantity ?? 1)), 2) }}</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @endif
                        
                        <div class="order-actions">
                            <a href="{{ route('user.order-details', ['id' => $order->id]) }}" class="gtaprof-btn btn-outline">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                            @if(isset($order->status) && in_array(strtolower($order->status), ['pending', 'processing']))
                            <button class="gtaprof-btn btn-primary" onclick="cancelOrder({{ $order->id }})">
                                <i class="fas fa-times"></i> Cancel Order
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="order-empty">
                <div class="order-empty-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>

                <h3 class="order-empty-title">No Orders Yet</h3>
                <p class="order-empty-text">
                    You haven't placed any orders yet.<br>
                    Start shopping to see your orders here.
                </p>

                <a href="{{ url('/') }}" class="gtaprof-btn gtaprof-btn-primary">
                    <i class="fas fa-store"></i> Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function cancelOrder(orderId) {
    if(confirm('Are you sure you want to cancel this order?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/user/orders/' + orderId + '/cancel';
        const token = document.createElement('input');
        token.type = 'hidden';
        token.name = '_token';
        token.value = '{{ csrf_token() }}';
        form.appendChild(token);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endpush
@endsection

<style>
    /* ========== ORDERS PAGE ========== */
    .order-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .order-item {
        background: var(--card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        border-bottom: 1px solid var(--border-color);
    }

    .order-number {
        font-weight: 600;
        color: var(--text);
        margin-right: 15px;
    }

    .order-date {
        color: #6c757d;
        font-size: 0.9em;
    }

    .order-status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8em;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-delivered {
        background-color: #d4edda;
        color: #155724;
    }

    .status-shipped, .status-processing {
        background-color: #cce5ff;
        color: #004085;
    }
    
    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .status-cancelled {
        background-color: #f8d7da;
        color: #721c24;
    }

    .order-details {
        padding: 20px;
    }

    .order-product {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        padding: 15px;
        border: 1px solid #eee;
        border-radius: 6px;
    }

    .product-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid var(--border-color);
    }

    .product-info h4 {
        margin: 0 0 8px 0;
        color: var(--text);
        font-size: 1.1em;
    }

    .product-info p {
        margin: 5px 0;
        color: #6c757d;
        font-size: 0.9em;
    }

    .price {
        color: var(--primary-color) !important;
        font-weight: 600;
        font-size: 1.1em !important;
    }

    .order-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        padding-top: 15px;
        border-top: 1px solid var(--border-color);
        margin-top: 15px;
    }

    .btn-outline {
        background: transparent;
        border: 1px solid var(--primary-color);
        color: var(--primary-color);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 8px 15px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .btn-outline:hover {
        background: var(--primary-color);
        color: white;
        text-decoration: none;
    }

    .btn-primary {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        opacity: 0.9;
    }

    /* Empty State Styles */
    .order-empty {
        text-align: center;
        padding: 40px 20px;
        background: #f9f9f9;
        border-radius: 8px;
        margin: 20px 0;
    }

    .order-empty-icon {
        font-size: 48px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .order-empty-title {
        color: #333;
        margin-bottom: 10px;
    }

    .order-empty-text {
        color: #6c757d;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .gtaprof-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: var(--primary-color);
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: all 0.3s ease;
    }


    /* ========== RESPONSIVE STYLES ========== */
    @media (max-width: 768px) {
        .order-product {
            flex-direction: column;
        }

        .product-image {
            width: 100%;
            height: auto;
            max-height: 200px;
        }

        .order-actions {
            flex-direction: column;
        }

        .gtaprof-btn, .btn-outline, .btn-primary {
            width: 100%;
            text-align: center;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .order-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .order-status {
            align-self: flex-start;
        }

        .order-number,
        .order-date {
            display: block;
            margin: 2px 0;
        }
    }
</style>