@extends('layouts.public.app')

@section('content')
@include('partials.public.navbar')

@include('partials.public.page-top-info', [
'header' => 'Order '.$order->code .'',
'links' => [
[
'label' => 'Home',
'route' => 'home'
],
[
'label' => 'My Orders',
'route' => "distributor.orders.index"
],
[
'label' => 'Order '.$order->code .'',
'route' => "#"
],
]
])

<section class="checkout-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 order-2 order-lg-1">
                <form class="checkout-form" action="{{route('distributor.orders.update', $order->id)}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="cf-title">Billing Address</div>
                    <div class="row address-inputs">
                        <div class="col-md-12">
                            <label for="">Names</label>
                            <input type="text" placeholder="Address" value={{$order->user->names}} disabled>
                            <label for="">TIN Number</label>
                            <input type="text" placeholder="Address" value={{$order->user->tin}} disabled>
                            <label for="">District</label>
                            <input type="text" placeholder="Address" value={{$order->user->residence}} disabled>
                            <label for="">Telephone</label>
                            <input type="text" placeholder="Country" value={{$order->user->telephone}} disabled>
                        </div>
                    </div>
                   @if ($order->status === \App\Models\Order::CREATED)
                   <button class="site-btn submit-order-btn" type="submit">Place Order</button>
                   @else
                   <span class="text-center text-danger"><b>Order #{{$order->code}} Placed</b></span>
                   @endif
                </form>
            </div>
            <div class="col-lg-5 order-1 order-lg-2">
                <div class="checkout-cart">
                    <h3>Order # {{$order->code}} Details</h3>
                    <ul class="product-list">
                        @foreach ($order->products as $product)
                        <li>
                            <div class="pl-thumb"><img src="{{ asset('storage/' . $product->image) }}" alt=""></div>
                            <h6>{{$product->title}}</h6>
                            <p>{{$product->price}} RWF</p>
                            <p>{{$product->pivot->quantity}} Piece(s) Ordered</p>
                            <p>Total: {{$product->price * $product->pivot->quantity}} FRWS</p>
                        </li>
                        @endforeach
                    </ul>
                    <ul class="price-list">
                        <li>Total<span>{{$order->products()->sum('total_price')}} FRWS</span></li>
                        <li>Shipping<span>free</span></li>
                        <li class="total">Grand Total<span>{{$order->products()->sum('total_price')}} FRWS</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.public.footer')
@endsection