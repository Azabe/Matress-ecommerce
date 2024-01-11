@extends('customercare.layouts.app')

@section('pageTitle')
Pending Orders
@endsection
@section('content')
<div class="content">
    <!--Cards-->
    <div class="row">
        <div class="col-xl-6 col-sm-6">
            <div class="card card-default card-mini">
                <div class="card-header">
                    <h2>{{$totalPendingOrders}}</h2>
                    <div class="sub-title">
                        <span class="mr-1">Pending Orders</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-wrapper">
                        <div>
                            <div id="spline-area-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6">
            <div class="card card-default card-mini">
                <div class="card-header">
                    <h2>RWF {{$totalSumOfPendingOrdersPrice}}</h2>
                    <div class="sub-title">
                        <span class="mr-1">Total Amout of Pending Orders</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-wrapper">
                        <div>
                            <div id="spline-area-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Orders-->
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <h2>Pending Orders</h2>
                </div>
                <div class="card-body">
                    @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success</strong> {{Session::get('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <table id="productsTable" class="table table-hover table-product" style="width:100%">
                        <thead>
                            <tr>
                                <th>Order Code</th>
                                <th>Order Status</th>
                                <th>Customer Names</th>
                                <th>Customer TIN</th>
                                <th>Customer Redisence</th>
                                <th>Customer Telephone</th>
                                <th>Order Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingOrders as $order)
                            <tr>
                                <td>{{$order->code}}</td>
                                <td>
                                    <span
                                        class="badge badge-pill badge-{{$order->renderOrderStatusBadge()}}">{{$order->status}}</span>
                                </td>
                                <td>{{$order->user->names}}</td>
                                <td>{{$order->user->tin}}</td>
                                <td>{{$order->user->residence}}</td>
                                <td>{{$order->user->telephone}}</td>
                                <td>{{$order->products()->sum('total_price')}} FRWS</td>
                                <td>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right"
                                            aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#pending-order-details-{{$order->id}}">More</a>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="pending-order-details-{{$order->id}}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLarge" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLarge">Order
                                                        #{{$order->code}}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        @foreach ($order->products as $product)
                                                        <div class="col-lg-6 col-xl-6">
                                                            <div class="card card-default p-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                                            class="mr-3" alt="Avatar Image"
                                                                            width="100%">
                                                                    </div>

                                                                    <div class="col-md-10">
                                                                        <div class="media-body">
                                                                            <h5 class="mt-0 mb-2 text-dark">
                                                                                {{$product->title}}
                                                                            </h5>
                                                                            <ul class="list-unstyled text-smoke">
                                                                                <li class="d-flex">
                                                                                    <i class="mdi mdi-cash mr-1"></i>
                                                                                    <span>Product price:
                                                                                        <b>{{$product->price}}
                                                                                            FRWS</b></span>
                                                                                </li>
                                                                                <li class="d-flex">
                                                                                    <i class="mdi mdi-cart mr-1"></i>
                                                                                    <span>Ordered quantity:
                                                                                        <b>{{$product->pivot->quantity}}</b></span>
                                                                                </li>
                                                                                <li class="d-flex">
                                                                                    <i class="mdi mdi-cash mr-1"></i>
                                                                                    <span>Total:
                                                                                        <b>{{$product->pivot->total_price}}
                                                                                            FRWS</b></span>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5 class="ml-3">Grand Total:
                                                                    <b>{{$order->products()->sum('total_price')}}
                                                                        FRW</b>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" onclick="document.getElementById('form-process-order-{{$order->id}}').submit();" class="btn btn-primary btn-pill">Process Order</button>
                                                    <form action="{{route('customercare.orders.update', $order->id)}}" method="POST" id="form-process-order-{{$order->id}}">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PUT">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
@endsection