<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;

class OrdersController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('user')->with('products')->get();
        return view('admin.orders.index', compact('orders'));
    }
}
