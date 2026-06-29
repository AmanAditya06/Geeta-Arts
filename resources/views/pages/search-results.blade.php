@extends('layout.app')

@section('content')

<div class="container">
    <h2>Search Result for "{{ $query }}"</h2>

    @if($products->count() > 0)

    <div class="row">
        @foreach($products as $item)
        <div class="col-md-3">
            <div class="product-card">
                <img src="{{ asset($item->image) }}" width="100%">

                <h5>{{ $item->name }}</h5>
                <p>₹{{ $item->price }}</p>

                <a href="{{ url('product/'.$item->slug) }}" 
                   class="btn btn-sm btn-primary">
                    View
                </a>
            </div>
        </div>
        @endforeach
    </div>

    @else
        <p>No product found </p>
    @endif
</div>

@endsection
