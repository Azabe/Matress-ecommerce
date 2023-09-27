<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Services\Manager\OrdersServices;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProcessingOrdersController extends Controller
{
    public function index(): View
    {
        $data = (new OrdersServices)->getOrders(Order::PROCESSING);
        $totalSumOfProcessingOrdersPrice = $data['sum'];
        $processingOrders = $data['orders'];
        $totalProcessingOrders = $data['total'];

        return view('manager.orders.processing.index', compact('totalSumOfProcessingOrdersPrice', 'processingOrders', 'totalProcessingOrders'));
    }

    public function update(Request $request, string $orderId): RedirectResponse
    {
        return (new OrdersServices)->makeOrderAvailable($request, $orderId);
    }
}
