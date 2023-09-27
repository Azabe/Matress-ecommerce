<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Services\Manager\OrdersServices;
use App\Models\Order;
use Illuminate\Contracts\View\View;

class AvailableOrdersController extends Controller
{
    public function index(): View
    {
        $data = (new OrdersServices)->getOrders(Order::APPROVED);
        $totalSumOfAvailableOrdersPrice = $data['sum'];
        $availableOrders = $data['orders'];
        $totalAvailableOrders = $data['total'];

        return view('manager.orders.available.index', compact('totalSumOfAvailableOrdersPrice', 'availableOrders', 'totalAvailableOrders'));
    }
}
