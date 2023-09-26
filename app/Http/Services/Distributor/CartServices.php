<?php

namespace App\Http\Services\Distributor;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class CartServices
{
    public function getCartPage($user): View
    {
        $myCart = $this->getMyCart($user);
        return view('distributor.cart.index', compact('myCart'));
    }

    public function getMyCart(User $user): Cart
    {
        if (is_null($user->cart)) {
            $user->cart()->create([
                'id' => Str::uuid()->toString()
            ]);
        }
        $user->load('cart.products');
        return $user->cart;
    }

    public function addProductToCart(User $user, Product $product): RedirectResponse
    {
        $this->pushProductToCart($user, $product);
        return redirect()->route('distributor.cart.products.index');
    }

    public function removeProductFromCart(User $user, string $productId): RedirectResponse
    {
        $userCart = $this->getMyCart($user);
        $userCart->products()->detach($productId);
        return redirect()->back();
    }

    public function pushProductToCart(User $user, Product $product): void
    {
        $userCart = $this->getMyCart($user);
        $userCart->products()->attach($product, [
            'id' => Str::uuid()->toString()
        ]);
    }
}
