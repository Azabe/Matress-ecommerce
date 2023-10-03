<?php

namespace App\Http\Services\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;


class DashboardServices
{
    public function getDashboardOverview()
    {
        $totalDistributors = User::whereHas('role', function($query) {
            $query->where('role', Role::DISTRIBUTOR);
        })->count();
        $totalProducts = Product::count();
        $totalCompletedOrders = Order::where('status', Order::APPROVED)->count();
        return view('admin.home', compact('totalDistributors', 'totalProducts', 'totalCompletedOrders'));
    }
}
