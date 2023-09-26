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
            <div class="col-lg-6 product-details">
                <h2 class="p-title">{{$product->description }}</h2>
                <h3 class="p-price">{{$product->price}} RWF</h3>
                <h4 class="p-stock">Available: <span>In Stock</span></h4>
                @can('add-product-to-cart')
                <a href="#" class="site-btn" onclick="document.getElementById('product-cart-{{$product->id}}').submit();">ADD TO CART</a>
                <form action="{{route('distributor.cart.products.store')}}" method="POST" id="product-cart-{{$product->id}}">
                    @csrf
                    <input type="hidden" name="productId" value="{{$product->id}}">
                </form>
                @else
                <span class="text-danger"><b>only authenticated distributors can add this product to cart</b></span>
                @endcan
                <div id="accordion" class="accordion-area">
                    <div class="panel">
                        <div class="panel-header" id="headingOne">
                            <button class="panel-link active" data-toggle="collapse" data-target="#collapse1"
                                aria-expanded="true" aria-controls="collapse1">description</button>
                        </div>
                        <div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="panel-body">
                                <p>{{$product->description}}.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection()