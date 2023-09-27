<?php

namespace App\Http\Services\Manager;

use App\Jobs\SendMessage;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrdersServices
{
    public function makeOrderAvailable(Request $request, string $orderId): RedirectResponse
    {
        $orderToMakeAvailable = Order::with('user')->with('products')->find($orderId);
        foreach ($orderToMakeAvailable->products as $product) {
            $this->updateProductQuantity($product->id, $product->pivot->quantity);
        }
        $orderToMakeAvailable->update([
            'delivery_date' => $request->delivery_date,
            'status' => Order::APPROVED
        ]);
        $message = 'Dear ' . $orderToMakeAvailable->user->names . ' your order #' . $orderToMakeAvailable->code . ' is available and will be delivered to your residence (' . $orderToMakeAvailable->user->residence . ') on ' . $request->delivery_date . ' ';
        SendMessage::dispatch($orderToMakeAvailable->user->telephone, $message);
        return back()->with('success', 'order # ' . $orderToMakeAvailable->code . ' is ready to be picked');
    }

    public function getOrders($status): array
    {
        $query = Order::where('status', $status);
        $totalSumOfOrdersPrice = $query->with('products')
            ->get()
            ->flatMap(function ($order) {
                return $order->products->pluck('pivot.total_price');
            })
            ->sum();
        $totalOrders = $query->count();
        $orders = $query->with('products')->orderBy('created_at', 'desc')->get();
        return [
            'sum' => $totalSumOfOrdersPrice,
            'total' => $totalOrders,
            'orders' => $orders
        ];
    }

    public function updateProductQuantity($productId, $quantity): void
    {
        $productToUpdateQuantity = Product::find($productId);
        $productToUpdateQuantity->update([
            'quantity' => $productToUpdateQuantity->quantity - $quantity
        ]);
    }
}
