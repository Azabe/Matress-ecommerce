@extends('admin.layouts.app')

@section('pageTitle')
Dashboard
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-xl-4 col-sm-6">
            <div class="card card-default card-mini">
                <div class="card-header">
                    <h2>{{$totalProducts}}</h2>
                    <div class="sub-title">
                        <span class="mr-1">Total Products</span>
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
        <div class="col-xl-4 col-sm-6">
            <div class="card card-default card-mini">
                <div class="card-header">
                    <h2>{{$totalDistributors}}</h2>
                    <div class="sub-title">
                        <span class="mr-1">Total Distributors</span>
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
        <div class="col-xl-4 col-sm-6">
            <div class="card card-default card-mini">
                <div class="card-header">
                    <h2>{{$totalCompletedOrders}}</h2>
                    <div class="sub-title">
                        <span class="mr-1">Total Delivered Orders</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-wrapper">
                        <div>
                            <div id="spline-area-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-6">
           <div class="card card-default">
             <div class="card-header">
                <h2>Orders Per Product Summary</h2>
             </div>
             <div class="card-body">
                {!! $productsSoldChart->container() !!}
             </div>
           </div>
        </div>
        <div class="col-xl-6">
           <div class="card card-default">
             <div class="card-header">
                <h2>Orders Per District Summary</h2>
             </div>
             <div class="card-body">
                {!! $districtsOrdersChart->container() !!}
             </div>
           </div>
        </div>
    </div>
</div>
<script src="{{ $productsSoldChart->cdn() }}"></script>
<script src="{{ $districtsOrdersChart->cdn() }}"></script>
{{ $productsSoldChart->script() }}
{{ $districtsOrdersChart->script() }}
@endsection