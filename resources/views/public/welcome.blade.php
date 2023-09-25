@extends('layouts.public.app')

@section('content')
@include('partials.public.navbar')

<section class="hero-section">
    <div class="hero-slider owl-carousel">
        <div class="hs-item set-bg" data-setbg="/webAssets/img/bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-7">
                        <span style="color: #00adef">New Arrivals</span>
                        <h2 style="font-weight: 900">denim jackets</h2>
                        <p style="font-weight: 900">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo
                            viverra maecenas accumsan lacus vel facilisis. </p>
                        <a href="#" class="site-btn sb-line">DISCOVER</a>
                        <a href="#" class="site-btn sb-white">ADD TO CART</a>
                    </div>
                </div>
                <div class="offer-card">
                    <span>from</span>
                    <h2>$29</h2>
                </div>
            </div>
        </div>
        <div class="hs-item set-bg" data-setbg="/webAssets/img/bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-7">
                        <span>New Arrivals</span>
                        <h2 style="font-weight: 900">denim jackets</h2>
                        <p style="font-weight: 900">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo
                            viverra maecenas accumsan lacus vel facilisis. </p>
                        <a href="#" class="site-btn sb-line">DISCOVER</a>
                        <a href="#" class="site-btn sb-white">ADD TO CART</a>
                    </div>
                </div>
                <div class="offer-card">
                    <span>from</span>
                    <h2>$29</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="slide-num-holder" id="snh-1"></div>
    </div>
</section>

<section class="features-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 p-0 feature">
                <div class="feature-inner">
                    <div class="feature-icon">
                        <img src="/webAssets/img/icons/1.png" alt="#">
                    </div>
                    <h2>Fast Secure Payments</h2>
                </div>
            </div>
            <div class="col-md-4 p-0 feature">
                <div class="feature-inner">
                    <div class="feature-icon">
                        <img src="/webAssets/img/icons/2.png" alt="#">
                    </div>
                    <h2>Premium Products</h2>
                </div>
            </div>
            <div class="col-md-4 p-0 feature">
                <div class="feature-inner">
                    <div class="feature-icon">
                        <img src="/webAssets/img/icons/3.png" alt="#">
                    </div>
                    <h2>Free & fast Delivery</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="top-letest-product-section">
    <div class="container">
        <div class="section-title">
            <h2>LATEST PRODUCTS</h2>
        </div>
        <div class="product-slider owl-carousel">
            @foreach ($latestProducts as $product)
            <div class="product-item">
                <div class="pi-pic">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="" height="400px">
                </div>
                <div class="pi-text">
                    <h6>RWF {{$product->price}}</h6>
                    <p>{{$product->description}} </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection