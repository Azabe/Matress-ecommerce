<?php

namespace App\Http\Services\Manager;

use App\Jobs\SendMessage;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrdersServices
{
    public function getAllProcessingsOrders(): View
    {
        $query = Order::where('status', Order::PROCESSING);
        $totalSumOfProcessingOrdersPrice = $query->with('products')
            ->get()
            ->flatMap(function ($order) {
                return $order->products->pluck('pivot.total_price');
            })
            ->sum();
        $totalProcessingOrders = $query->count();
        $processingOrders = $query->with('products')->orderBy('created_at', 'desc')->get();

        return view('manager.orders.processing.index', compact('totalSumOfProcessingOrdersPrice', 'processingOrders', 'totalProcessingOrders'));
    }

    public function makeOrderAvailable(Request $request, string $orderId): RedirectResponse
    {
        $orderToMakeAvailable = Order::with('user')->find($orderId);
        $orderToMakeAvailable->update([
            'delivery_date' => $request->delivery_date,
            'status' => Order::APPROVED
        ]);
        $message = 'Dear ' . $orderToMakeAvailable->user->names . ' your order #' . $orderToMakeAvailable->code . ' is available and will be delivered to your residence (' . $orderToMakeAvailable->user->residence . ') on ' . $request->delivery_date . ' ';
        SendMessage::dispatch($orderToMakeAvailable->user->telephone, $message);
        return back()->with('success', 'order # ' . $orderToMakeAvailable->code . ' is ready to be picked');
    }
}
