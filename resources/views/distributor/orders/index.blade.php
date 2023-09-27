@extends('layouts.public.app')

@section('content')
@include('partials.public.navbar')

@include('partials.public.page-top-info', [
'header' => 'My Orders',
'links' => [
[
'label' => 'Home',
'route' => 'home'
],
[
'label' => 'My Orders',
'route' => "#"
],
]
])

<!--Cart-->
<section class="cart-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart-table">
                    <h3>My Orders</h3>
                    <div class="cart-table-warp">
                        <table>
                            <thead>
                                <tr>
                                    <th class="size-th">Order Code</th>
                                    <th class="total-th">Order Status</th>
                                    <th class="total-th">Number of products</th>
                                    <th class="total-th">Order Amount(FRWS)</th>
                                    <th class="total-th">Delivery Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td class="size-col">
                                        <h4>{{$order->code}}</h4>
                                    </td>
                                    <td class="total-col total-price">
                                        <h4><span class='badge badge-{{$order->renderOrderStatusBadge()}}'>{{$order->status}}</span></h4>
                                    </td>
                                    <td class="size-col">
                                        <h4>{{$order->products->count()}}</h4>
                                    </td>
                                    <td class="total-col total-price">
                                        <h4>{{$order->products()->sum('total_price')}}</h4>
                                    </td>
                                    <td class="total-col total-price">
                                        <h4>{{$order->delivery_date}}</h4>
                                    </td>
                                    <td class="total-col total-price">
                                        <a href="{{route('distributor.orders.show', $order->id)}}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('partials.public.footer')
@endsection