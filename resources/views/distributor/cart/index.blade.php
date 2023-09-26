@extends('layouts.public.app')

@section('content')
@include('partials.public.navbar')

@include('partials.public.page-top-info', [
'header' => 'My Cart',
'links' => [
[
'label' => 'Home',
'route' => 'home'
],
[
'label' => 'My Cart',
'route' => "distributor.cart.products.index"
],
]
])

<!--Cart-->
<section class="cart-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table">
                    <h3>Your Cart</h3>
                    @if (!is_null($myCart) && $myCart->products()->count() > 0)
                    <div class="cart-table-warp">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-th">Product</th>
                                    <th class="quy-th">Quantity</th>
                                    <th class="size-th">Unit price(FRWS)</th>
                                    <th class="total-th">Total Price(FRWS)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($myCart->products as $product)
                                <tr>
                                    <td class="product-col">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="">
                                        <div class="pc-title">
                                            <h4>{{$product->title}}</h4>
                                        </div>
                                    </td>
                                    <td class="quy-col">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="size-col">
                                        <h4>{{$product->price}}</h4>
                                    </td>
                                    <td class="total-col">
                                        <h4>0</h4>
                                    </td>
                                    <td class="total-col">
                                        <i class="fa fa-close text-danger"
                                            onclick="document.getElementById('cart-product-remove-{{$product->id}}').submit();"></i>
                                        <form action="{{route('distributor.cart.products.destroy', $product->id)}}"
                                            method="POST" id="cart-product-remove-{{$product->id}}">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="total-cost">
                        <h6>Total <span>$99.90</span></h6>
                    </div>
                    @else
                    <span class="text-danger text-center mb-4"><b>Empty Card</b></span>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 card-right">
                <a href="" class="site-btn">Proceed to checkout</a>
                <a href="" class="site-btn sb-dark">Continue shopping</a>
            </div>
        </div>
    </div>
</section>
@include('partials.public.footer')
@endsection