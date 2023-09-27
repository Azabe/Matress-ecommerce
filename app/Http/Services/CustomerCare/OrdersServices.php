<?php

namespace App\Http\Services\CustomerCare;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrdersServices
{
    public function getAllPendingOrders(): View
    {
        $query = Order::where('status', Order::PENDING);
        $totalSumOfPendingOrdersPrice = $query->with('products')
            ->get()
            ->flatMap(function ($order) {
                return $order->products->pluck('pivot.total_price');
            })
            ->sum();
        $totalPendingOrders = $query->count();
        $pendingOrders = $query->with('products')->orderBy('created_at', 'desc')->get();

        return view('customercare.orders.index', compact('totalSumOfPendingOrdersPrice', 'pendingOrders', 'totalPendingOrders'));
    }

    public function processOrder(string $orderId): RedirectResponse
    {
        $orderToProcess = Order::find($orderId);
        $orderToProcess->update([
            'status' => Order::PROCESSING
        ]);
        return back()->with('success', 'order # ' . $orderToProcess->code . ' processed successfuly');
    }
}
