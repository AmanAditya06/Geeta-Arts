<!-- @php
    $bannerImage = $hero->image ?? 'default.jpg';
@endphp -->

<section class="sofa-hero"
    style="background-image: linear-gradient(
        rgba(0, 0, 0, 0.6),
        rgba(0, 0, 0, 0.6)
    ), url('{{ asset('assets/images/' . ($hero->image ?? '')) }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 120px 0;
    color: white;
    text-align: center;">
    <div class="container">
        <div class="hero-content">
            <h1>{{ $hero->title ?? '' }}</h1>
            <p>{{ $hero->subtitle ?? '' }}</p>
        </div>
    </div>
</section>