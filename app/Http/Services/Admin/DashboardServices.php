<?php

namespace App\Http\Services\Admin;

use App\Charts\DistrictsOrdersChart;
use App\Charts\ProductsSoldChart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;

class DashboardServices
{
    public function getDashboardOverview(ProductsSoldChart $productsSoldChart, DistrictsOrdersChart $districtsOrdersChart): View
    {
        $totalDistributors = User::whereHas('role', function ($query) {
            $query->where('role', Role::DISTRIBUTOR);
        })->count();
        $latestOrders = Order::with('user')->with('products')->whereNot('status', Order::CREATED)->orderBy('created_at', 'desc')->limit(10)->get();
        $totalProducts = Product::count();
        $totalCompletedOrders = Order::where('status', Order::APPROVED)->count();
        $productsSoldChart = $productsSoldChart->build();
        $districtsOrdersChart = $districtsOrdersChart->build();
        return view('admin.home', compact('totalDistributors', 'totalProducts', 'totalCompletedOrders', 'productsSoldChart', 'districtsOrdersChart', 'latestOrders'));
    }
}
