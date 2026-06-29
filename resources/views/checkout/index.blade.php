@extends('layout.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Checkout</h2>

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-4">Shipping Address</h4>
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="shipping_name" class="form-control" value="{{ old('shipping_name', auth()->user()->name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone *</label>
                                <input type="text" name="shipping_phone" class="form-control" value="{{ old('shipping_phone', auth()->user()->phone) }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Address *</label>
                                <input type="text" name="shipping_address" class="form-control" value="{{ old('shipping_address') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">City *</label>
                                <input type="text" name="shipping_city" class="form-control" value="{{ old('shipping_city') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">State *</label>
                                <input type="text" name="shipping_state" class="form-control" value="{{ old('shipping_state') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">ZIP Code *</label>
                                <input type="text" name="shipping_zip" class="form-control" value="{{ old('shipping_zip') }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Country *</label>
                                <input type="text" name="shipping_country" class="form-control" value="{{ old('shipping_country', 'India') }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Order Notes (optional)</label>
                                <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                            </div>
                            <div class="col-12">
                                <h5 class="mb-3">Payment Method</h5>
                                <div class="form-check mb-2">
                                    <input type="radio" name="payment_method" value="cash" class="form-check-input" id="cash" checked>
                                    <label class="form-check-label" for="cash">Cash on Delivery</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="payment_method" value="online" class="form-check-input" id="online">
                                    <label class="form-check-label" for="online">Online Payment</label>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-4">Order Summary</h4>
                    @foreach($cart as $id => $item)
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                        <span>₹{{ number_format($item['price'] * $item['quantity']) }}</span>
                    </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>₹{{ number_format($subtotal) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span>
                        <span>₹{{ $shipping }}</span>
                    </div>
                    @if($discount > 0)
                    <div class="d-flex justify-content-between mb-2 text-success">
                        <span>Discount</span>
                        <span>-₹{{ number_format($discount) }}</span>
                    </div>
                    @endif
                    <hr>
                    <div class="d-flex justify-content-between mb-4 fw-bold fs-5">
                        <span>Total</span>
                        <span>₹{{ number_format($total) }}</span>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-3" style="background: var(--primary-color); border: none; border-radius: 30px; font-weight: 600;">
                        Place Order
                    </button>
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100 mt-2">Back to Cart</a>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>

<style>
.form-label { font-weight: 600; color: #374151; margin-bottom: 5px; }
.form-control, .form-select { border-radius: 8px; padding: 10px 14px; border: 2px solid #e2e8f0; }
.form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(132,167,169,0.15); }
.card { border: none; border-radius: 12px; }
</style>
@endsection
