@extends('layout.app')
@section('content')

<!-- Hero Section -->
@include('components.hero-banner')

<section class="half-overlay-section">
    <div class="left-text">
        <span class="sub-heading">{{$contents['about_story']->label}}</span>
        <h1 class="main-heading">
            {{$contents['about_story']->title}}
        </h1>
        <p class="para">
           {{$contents['about_story']->description}}

    </div>

    <div class="right-image">
        <img src="{{ asset('assets/images/'.$contents['about_story']->image) }}" alt="">
    </div>
</section>



<!-- Team Section -->
<section class="team-section">
    <div class="container text-center">
        <h2 class="section-title">{{$contents['team_heading']->title}}</h2>
        <p class="section-subtitle">{{$contents['team_heading']->subtitle}}</p>
        <div class="team-grid">
            <div class="team-member">
                <div class="member-image">
                    <img src="{{ asset('assets/images/'.$contents['member1']->image) }}" alt="Team Member" class="img-fluid">
                </div>
                <h3>{{$contents['member1']->label}}</h3>
                <p>{{$contents['member1']->subtitle}}</p>
            </div>
            <div class="team-member">
                <div class="member-image">
                    <img src="{{ asset('assets/images/'.$contents['member2']->image) }}" alt="Team Member" class="img-fluid">
                </div>
                <h3>{{$contents['member2']->label}}</h3>
                <p>{{$contents['member2']->subtitle}}</p>
            </div>
            <div class="team-member">
                <div class="member-image">
                    <img src="{{ asset('assets/images/'.$contents['member3']->image) }}" alt="Team Member" class="img-fluid">
                </div>
                <h3>{{$contents['member3']->label}}</h3>
                <p>{{$contents['member3']->subtitle}}</p>
            </div>
        </div>
    </div>
</section>
@endsection
