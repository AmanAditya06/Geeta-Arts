
<!-- PRODUCT SECTION -->
@foreach($groupedProducts as $type => $items)
<section class="buy-section">
    <div class="container">
        <h2 class="b-title">{{ ucwords(str_replace('-', ' ', $type)) }}</h2>
        <div class="row g-4">
            @if($items->count() > 0)
                @foreach($items as $product)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="buy-card">
                        <div class="w-icon">
                            <i class="far fa-heart"></i>
                        </div>
                        <!-- PRODUCT IMAGE -->
                        <img src="{{ asset('assets/images/Product-images/'.$product->image) }}" alt="{{ $product->name }}">
                        <!-- PRODUCT INFO -->
                        <h3>{{ $product->name }}</h3>
                        <p class="description">{{ $product->description ?? '' }}</p>
                        <p class="price">₹{{ number_format($product->price) }}</p>
                        <!-- ADD TO CART -->
                        @auth
                        <form action="{{ route('cart.add') }}" method="POST" id="cartForm{{$product->id}}" style="display:none;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="subtitle" value="{{ $product->subtitle }}">  
                            <input type="hidden" name="description" value="{{ $product->description }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="hidden" name="image" value="{{ asset('assets/images/Product-images/'.$product->image) }}">
                        </form>

                        <button class="buy-btn" onclick="document.getElementById('cartForm{{ $product->id }}').submit();">
                            Add to Cart
                        </button>
                        @else
                        <a href="{{ route('login') }}" class="buy-btn"> Add to Cart</a>
                        @endauth

                    </div>
                </div>
                @endforeach
            @else
                <p class="text-center">No Products Available in {{ ucwords($type) }}</p>
            @endif

        </div>
    </div>
</section>
@endforeach
