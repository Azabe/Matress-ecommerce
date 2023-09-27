<?php

namespace App\Http\Services\Distributor;

use App\Jobs\SendMessage;
use App\Models\Order;
use App\Models\Order_Product;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrdersServices
{

    public function storeNewOrder(Request $request, User $user): RedirectResponse
    {
        $newOrder = [
            'id' => Str::uuid()->toString(),
            'code' => rand(100000, 999999),
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $productIds = $request->productIds;
        $quantities = $request->quantities;
        $this->createNewOrder($newOrder, $productIds, $quantities);
        (new CartServices)->clearCart($user);
        return redirect()->route('distributor.orders.show', $newOrder['id']);
    }

    public function createNewOrder($newOrder, $productIds, $quantities): void
    {

        $orderProducts = [];

        for ($i = 0; $i < count($productIds); $i++) {
            for ($j = 0; $j < count($quantities); $j++) {
                if ($i == $j) {
                    $product = new Product();
                    $productPrice = $product->getProductPrice($productIds[$i]);
                    $totalPrice = $productPrice * $quantities[$i];
                    $orderProducts[] = [
                        'id' => Str::uuid()->toString(),
                        'product_id' => $productIds[$i],
                        'order_id' => $newOrder['id'],
                        'quantity' => $quantities[$i],
                        'total_price' => $totalPrice,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
            }
        }
        Order::insert($newOrder);
        foreach ($orderProducts as $orderProduct) {
            Order_Product::insert($orderProduct);
        }
    }

    public function placeOrder(User $user, string $orderId): RedirectResponse
    {
        $orderToUpdate = Order::find($orderId);
        $orderToUpdate->update([
            'status' => Order::PENDING
        ]);
        $this->confirmPlacedOrderByMessage($user, $orderToUpdate->code);
        return redirect()->route('distributor.orders.index');
    }

    public function confirmPlacedOrderByMessage(User $user, string $orderCode)
    {
        $message = 'Dear ' . $user->names . ' your order with code ' . $orderCode . ' has been received successfully';
        SendMessage::dispatch($user->telephone, $message);
    }
}
