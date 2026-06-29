@extends('layout.app')

@section('content')

<!-- slider-section start -->
<section class="slider-wrapper">
    <div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($sliders as $key => $slider)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{ asset('assets/images/'.$slider->image) }}"
                    class="d-block w-100 slider-img"
                    alt="Slide {{ $key+1 }}">
            </div>
            @endforeach
        </div>
        @if($sliders->count())
        <div class="carousel-caption-custom">
            <h2>{{ $sliders[0]->title }}</h2>
            <p>{{ $sliders[0]->subtitle }}</p>
            <a href="{{ $sliders[0]->button_link }}" class="btn-slider">{{ $sliders[0]->button_text }}</a>
        </div>
        @endif

        <button class="carousel-control-prev" type="button"
            data-bs-target="#homeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button"
            data-bs-target="#homeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

    </div>
</section>
<!-- ------------hero content section------------------>
<section class="hero">
    <div class="sub-hero">
        <div class="left-title">
            <h3>{{ $contents['home_intro_left']->title }}</h3>
            <p>
                {{ $contents['home_intro_left']->description }}
            </p>

            <h3>{{ $contents['home_intro_left_2']->title }}</h3>
            <p>{{ $contents['home_intro_left_2']->description }}</p>
        </div>
        <div class="image">
            <img src="{{ asset('assets/images/'.$contents['home_intro_image']->image) }}"
                alt="Handmade Craft">
        </div>
        <div class="right-title">
            <h3>{{ $contents['home_intro_right']->title }}</h3>
            <p>{{ $contents['home_intro_right']->description }}</p>

            <h3>{{ $contents['home_intro_right_2']->title }}</h3>
            <p>{{ $contents['home_intro_right_2']->description }}</p>

        </div>
    </div>
</section>


<!-- Gallery Section -->

<section class="gallery-section">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">{{ $contents['home_collections']->title }}</h2>
            <p class="section-subtitle">{{ $contents['home_collections']->subtitle }}</p>
        </div>

        <div class="gallery-grid">
            @foreach($categories as $category)
            <div class="gallery-item-wrapper">
                <div class="gallery-item">
                    <img src="{{ asset('assets/images/'.$category->image) }}"
                        alt="{{ $category->name }}"
                        class="gallery-image">

                    <div class="image-overlay">
                        <a href="{{ route('collection.category', $category->slug) }}"
                            class="btn-explore">
                            View Details
                        </a>
                    </div>
                </div>

                <div class="gallery-item-text">
                    <h4>{{ $category->name }}</h4>
                    <p>{{ $category->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ===========slider=======---------------- -->



<section class="multi-carousel-section">

    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">{{ $contents['home_premium']->title }}</h2>
            <p class="section-subtitle">{{ $contents['home_premium']->subtitle }}</p>
        </div>
        <div class="carousel-slider">
            <button id="prev-slider" class="slider-button">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="image-list">
               @foreach($carousel as $item)
               <img src="{{ asset('assets/images/'.$item->image) }}"
               alt="{{ $item->name }}"
               class="image-item">
               @endforeach
            </div>
            <button id="next-slider" class="slider-button">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
        <div class="slider-scrollbar">
            <div class="scrollbar-track">
                <div class="scrollbar-thumb"></div>
            </div>
        </div>
    </div>
</section>


@endsection