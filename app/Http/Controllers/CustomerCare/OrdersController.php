<?php

namespace App\Http\Controllers\CustomerCare;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Http\Services\CustomerCare\OrdersServices;
use Illuminate\Http\RedirectResponse;

class OrdersController extends Controller
{
    public function index(): View
    {
        return (new OrdersServices)->getAllPendingOrders();
    }

    public function update(string $orderId): RedirectResponse
    {
        return (new OrdersServices)->processOrder($orderId);
    }
}
