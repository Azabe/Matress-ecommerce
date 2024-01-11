<?php

namespace App\Http\Services\CustomerCare;

use App\Jobs\SendMessage;
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
        // Send message
        $message = 'Dear ' . $orderToProcess->user->names . ' confirm your order #' . $orderToProcess->code . ' with total of '. $orderToProcess->products()->sum('total_price') .' FRWS by paying using *182*8*1*005566#';
        SendMessage::dispatch($orderToProcess->user->telephone, $message);
        $orderToProcess->update([
            'status' => Order::PROCESSING
        ]);
        return back()->with('success', 'order # ' . $orderToProcess->code . ' processed successfuly');
    }
}
