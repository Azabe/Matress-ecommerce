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
                    <div class="col-md-4 col-sm-6">
                        @include('public.products.components.product', ['product' => $product, 'height' => '700px',
                        'show_tag_sale' => true])
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@include('partials.public.footer')
@endsection