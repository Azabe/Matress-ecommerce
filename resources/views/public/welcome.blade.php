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
                        <p style="font-weight: 900">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
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
                        <p style="font-weight: 900">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
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
@endsection