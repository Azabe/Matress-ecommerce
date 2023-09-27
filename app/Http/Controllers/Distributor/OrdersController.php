<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Services\Distributor\OrdersServices;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index(): View
    {
        $orders = $this->user->orders()->with('products')->get();
        return view('distributor.orders.index', compact('orders'));
    }

    public function store(Request $request): RedirectResponse
    {
        return (new OrdersServices)->storeNewOrder($request, $this->user);
    }

    public function show(string $orderId): View
    {
        $order = Order::with('products')->with('user')->find($orderId);
        return view('distributor.orders.show', compact('order'));
    }

    public function update(string $orderId)
    {
        return (new OrdersServices)->placeOrder($this->user, $orderId);
    }
}
