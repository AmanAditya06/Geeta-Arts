@extends('layout.app')

@section('content')

@php
    $images = ['sofa1.jpg', 'sofa2.jpg', 'sofa3.jpg'];
    $firstImage = asset('assets/images/Product-images/' . $product->image);
@endphp

<section class="single-product-page">
    <div class="container py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                @if($product->category)
                <li class="breadcrumb-item"><a href="{{ route('collection.category', $product->category->slug) }}">{{ $product->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row g-5 mt-3">
            <div class="col-lg-6">
                <div class="product-main-image">
                    <img src="{{ $firstImage }}" alt="{{ $product->name }}" id="mainProductImage">
                </div>
                <div class="product-thumbnails mt-3">
                    <div class="thumbnail active" onclick="changeImage(this, '{{ $firstImage }}')">
                        <img src="{{ $firstImage }}" alt="Thumbnail">
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="product-detail-info">
                    <h1 class="product-detail-title">{{ $product->name }}</h1>
                    <p class="product-detail-price">₹{{ number_format($product->price) }}</p>
                    <p class="product-detail-desc">{{ $product->description ?? 'No description available' }}</p>

                    <div class="product-detail-qty mt-4">
                        <label>Quantity:</label>
                        <div class="qty-selector">
                            <button class="qty-btn" onclick="updateQty(-1)">-</button>
                            <input type="number" value="1" min="1" id="qtyInput" readonly>
                            <button class="qty-btn" onclick="updateQty(1)">+</button>
                        </div>
                    </div>

                    @auth
                    <form action="{{ route('cart.add') }}" method="POST" id="singleCartForm" class="mt-4">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <input type="hidden" name="image" value="{{ $firstImage }}">
                        <button type="submit" class="buy-btn btn-lg">Add to Cart</button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="buy-btn btn-lg mt-4 d-inline-block">Add to Cart</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.single-product-page {
    background: #fff;
    min-height: 60vh;
}
.product-main-image {
    width: 100%;
    height: 450px;
    overflow: hidden;
    border-radius: 12px;
    border: 2px solid var(--secondary-color);
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}
.product-main-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.product-thumbnails {
    display: flex;
    gap: 10px;
}
.product-thumbnails .thumbnail {
    width: 80px;
    height: 80px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
}
.product-thumbnails .thumbnail:hover,
.product-thumbnails .thumbnail.active {
    border-color: var(--primary-color);
}
.product-thumbnails .thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.product-detail-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 1rem;
    font-family: var(--main-font), sans-serif;
}
.product-detail-price {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
}
.product-detail-desc {
    color: #555;
    line-height: 1.8;
    font-size: 1.05rem;
    font-family: var(--secondary-font);
}
.product-detail-qty label {
    font-weight: 600;
    margin-right: 15px;
    color: var(--text);
}
.qty-selector {
    display: inline-flex;
    border: 1px solid #ddd;
    border-radius: 6px;
    overflow: hidden;
}
.qty-selector .qty-btn {
    width: 40px;
    height: 40px;
    background: #f8f9fa;
    border: none;
    font-size: 1.2rem;
    cursor: pointer;
    transition: background 0.3s;
}
.qty-selector .qty-btn:hover {
    background: #e9ecef;
}
.qty-selector input {
    width: 50px;
    height: 40px;
    text-align: center;
    border: none;
    border-left: 1px solid #ddd;
    border-right: 1px solid #ddd;
}
.breadcrumb {
    background: transparent;
    padding: 0;
}
.breadcrumb a {
    color: var(--primary-color);
    text-decoration: none;
}
.breadcrumb .active {
    color: #6c757d;
}
.btn-lg {
    padding: 14px 40px;
    font-size: 1.1rem;
}
</style>

<script>
function changeImage(element, src) {
    document.getElementById('mainProductImage').src = src;
    document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
    element.classList.add('active');
}
function updateQty(change) {
    const input = document.getElementById('qtyInput');
    let val = parseInt(input.value) + change;
    if (val < 1) val = 1;
    input.value = val;
}
</script>
@endsection
