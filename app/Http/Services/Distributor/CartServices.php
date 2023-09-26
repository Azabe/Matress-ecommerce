<?php

namespace App\Http\Services\Distributor;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;

class CartServices
{
    public function getMyCart(User $user)
    {
        if (is_null($user->cart)) {
            $user->cart()->create([
                'id' => Str::uuid()->toString()
            ]);
        }
        $user->load('cart.products');
        return $user->cart;
    }

    public function addProductToCart(User $user, Product $product)
    {
        $userCart = $this->getMyCart($user);
        $userCart->products()->attach($product, [
            'id' => Str::uuid()->toString()
        ]);
        return $userCart;
        // return 'done';
    }
}
