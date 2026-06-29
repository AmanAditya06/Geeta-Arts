@extends('layout.app')

@section('content')

@include('components.hero-banner')
<!-- Main Content -->
<div class="container customer-service">
    <div class="service-nav">
        <ul>
            <li><a href="#shipping-policy" class="tab-btn active">Shipping Policy</a></li>
            <li><a href="#return-policy" class="tab-btn ">Return Policy</a></li>
            <li><a href="#terms" class="tab-btn ">Terms & Conditions</a></li>
        </ul>
    </div>

    <div class="service-content">
        <!-- Shipping Policy -->
        <section id="shipping-policy" class="policy-section tab-content">
            <span class="sub-heading">{{$contents['shipping_policy']->label}}</span>
            <div class="policy-content">
                <h3>{{$contents['shipping_policy']->title}}</h3>
                <p>{{$contents['shipping_policy']->description}}</p>
                
                <h3>{{$contents['shipping_rates']->title}}</h3>
                <p>{{$contents['shipping_rates']->description}}</p>

                <h3>{{$contents['order_tracking']->title}}</h3>
                <p>{{$contents['order_tracking']->description}}</p>
            </div>
        </section>

        <!-- Return Policy -->
        <section id="return-policy" class="policy-section tab-content" style="display:none; ">
            <span class="sub-heading">{{$contents['return_policy']->label}}</span>
            <div class="policy-content">
                <h3>{{$contents['return_policy']->title}}</h3>
                <p>{{$contents['return_policy']->description}}</p>
                
                <h3>{{$contents['return_steps']->title}}</h3>
                <p>{{$contents['return_steps']->description}}</p>

                <h3>{{$contents['refund_process']->title}}</h3>
                <p>{{$contents['refund_process']->description}}</p>
            </div>
        </section>

       

        <!-- Terms & Conditions -->
        <section id="terms" class="policy-section  tab-content" style="display:none;">
            <span class="sub-heading">{{$contents['terms_general']->label}}</span>
            <div class="policy-content">
                <h3>{{$contents['terms_general']->title}}</h3>
                <p>{{$contents['terms_general']->description}}</p>
                
                <h3>{{$contents['terms_products']->title}}</h3>
                <p>{{$contents['terms_products']->description}}</p>
                
                <h3>{{$contents['terms_pricing']->title}}</h3>
                <p>{{$contents['terms_pricing']->description}}</p>
                
                <h3>{{$contents['terms_liability']->title}}</h3>
                <p>{{$contents['terms_liability']->description}}</p>
                
                <h3>{{$contents['terms_law']->title}}</h3>
                <p>{{$contents['terms_law']->description}}</p>
            </div>
        </section>
    </div>
</div>

@endsection