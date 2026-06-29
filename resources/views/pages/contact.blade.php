@extends('layout.app')

@section('content')

<!-- Hero Section -->
 @include('components.hero-banner')

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <div class="contact-wrapper">
            <div class="contact-info">
                <div class="section-header">
                    <span class="c-heading">{{$contents['contact_main']->label}}</span>
                    <h3 class="section-title">{{$contents['contact_main']->title}}</h3>
                    <p>{{$contents['contact_main']->subtitle}}</p>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-content">
                            <h4>{{$contents['contact_address']->title}}</h4>
                            <p>{{$contents['contact_address']->description}}</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="info-content">
                            <h4>{{$contents['contact_phone']->title}}</h4>
                            <p>{{$contents['contact_phone']->description}}</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h4>{{$contents['contact_email']->title}}</h4>
                            <p>{{$contents['contact_email']->description}}</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="info-content">
                            <h4>{{$contents['contact_working']->label}}</h4>
                            <p>{{$contents['contact_working']->title}}</p>
                            <p>{{$contents['contact_working']->description}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <h3>Send Us a Message</h3>
                @if(session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif
                <form id="contactForm" class="" action="{{route('contact')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" id="name" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <input type="tel" id="phone" name="number" placeholder="Phone Number">
                    </div>
                    <div class="form-group">
                        <textarea id="message" name="message" rows="5" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>


@endsection