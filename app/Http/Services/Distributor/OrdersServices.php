<?php

namespace App\Http\Services\Distributor;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_Product;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrdersServices
{

    public function storeNewOrder(Request $request, User $user)
    {
        $newOrder = [
            'id' => Str::uuid()->toString(),
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $productIds = $request->productIds;
        $quantities = $request->quantities;
        $this->createNewOrder($newOrder, $productIds, $quantities);
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
}
