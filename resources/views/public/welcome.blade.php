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
                        <h2 style="font-weight: 900">Sweet Dreams</h2>
                        <p style="font-weight: 900">meticulously crafted to redefine your sleep experience. 
                        This mattress seamlessly combines cutting-edge technology with plush comfort, 
                        offering you the perfect sanctuary for a rejuvenating night's sleep. </p>
                        <a href="{{route('public.products.index')}}" class="site-btn sb-line">SHOP</a>
                    </div>
                </div>
                <div class="offer-card">
                    <span>from</span>
                    <h3 style="color:#ede837">{{$minimumProductPrice}} FRW</h3>
                </div>
            </div>
        </div>
        <div class="hs-item set-bg" data-setbg="/webAssets/img/bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-7">
                        <span>New Arrivals</span>
                        <h2 style="font-weight: 900">Lala Salama </h2>
                        <p style="font-weight: 900">Lala Salama mattresses again machine taped at the mattress edges
                         and covered with elegantly designed 
                         jacquard fabric enhancing the superior look of the mattresses.
                        Available in different sizes and thicknesses.
                        </p>
                        <a href="{{route('public.products.index')}}" class="site-btn sb-line">SHOP</a>
                    </div>
                </div>
                <div class="offer-card">
                    <span>from</span>
                    <h3 style="color:#ede837">{{$minimumProductPrice}} FRW</h3>
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
            @include('public.products.components.product', ['product' => $product, 'height' => '400px',
            'show_tag_sale' => false])
            @endforeach
        </div>
    </div>
</section>
@include('partials.public.footer')
@endsection