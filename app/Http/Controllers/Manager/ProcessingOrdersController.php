<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Services\Manager\OrdersServices;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProcessingOrdersController extends Controller
{
    public function index(): View
    {
        return (new OrdersServices)->getAllProcessingsOrders();
    }

    public function update(Request $request, string $orderId): RedirectResponse
    {
        return (new OrdersServices)->makeOrderAvailable($request, $orderId);
    }
}
