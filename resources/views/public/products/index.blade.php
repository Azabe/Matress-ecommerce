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
]
])

<!--Products-->
<section class="category-section spad">
    <div class="container">
        <div class="row">

            <div class="col-lg-12  order-1 order-lg-2 mb-5 mb-lg-0">
                <div class="row">
                    @foreach ($products as $product)
                    @include('public.products.components.product', ['product' => $product])
                    @endforeach
                    <div class="text-center w-100 pt-3">
                        <button class="site-btn sb-line sb-dark">LOAD MORE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection