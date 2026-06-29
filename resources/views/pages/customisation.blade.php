@extends('layout.app')

@section('content')

<!-- Hero Section -->
 @include('components.hero-banner')

 <section class="half-overlay-section">
    <div class="left-text">
        <span class="sub-heading">{{$contents['cust_main']->label}}</span>
        <h1 class="main-heading">
             {{$contents['cust_main']->title}}
        </h1>
        <p class="para">
            {{$contents['cust_main']->description}}

    </div>

    <div class="right-image">
        <img src="{{ asset('assets/images/'.$contents['cust_main']->image) }}" alt="">
    </div>
</section>

<!-- Customisation Form Section -->
<section class="customisation-form-section">
    <div class="container">
        <div class="section-header text-center">
            <span class="s-heading">START YOUR PROJECT</span>
            <h2 class="section-title">Request a Custom Design</h2>
            <p>Fill out the form below and our design team will get back to you within 24 hours</p>
        </div>
        
        <div class="customisation-form-wrapper">
            <form id="customisationForm" class="customisation-form">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Your Name <span>*</span></label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address <span>*</span></label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                   
                    <div class="form-group full-width">
                        <label for="description">Design Description <span>*</span></label>
                        <textarea id="description" name="description" rows="4" required placeholder=""></textarea>
                    </div>
                  
                </div>
                <div class="form-submit">
                    <button type="submit" class="submit-btn">Submit Request</button>
                </div>
            </form>
        </div>
    </div>
</section>


@endsection