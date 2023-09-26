@extends('layouts.public.app')

@section('content')
@include('partials.public.navbar')
@include('partials.public.page-top-info', [
'header' => 'Products',
'links' => [
[
'label' => 'Home',
'route' => 'home'
],
[
'label' => 'Products',
'route' => "public.products.index"
],
[
'label' => $product->title,
'route' => "#"
],
]
])

<section class="product-section">
    <div class="container">
        <div class="back-link">
            <a href="{{route('public.products.index')}}"> &lt;&lt; Back to Products List</a>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="product-pic-zoom">
                    <img class="product-big-img" src="{{ asset('storage/' . $product->image) }}" alt="">
                </div>
            </div>
            @include('public.products.components.productDetails', [
            'product' => $product
            ])
        </div>
    </div>
</section>
@endsection()