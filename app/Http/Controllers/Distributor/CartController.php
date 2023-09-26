<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Services\Distributor\CartServices;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index(): View
    {
        return (new CartServices)->getCartPage($this->user);
    }

    public function store(Request $request): RedirectResponse
    {
        $product = Product::find($request->productId);
        return (new CartServices)->addProductToCart($this->user, $product);
    }

    public function destroy(string $productId): RedirectResponse
    {
        return (new CartServices)->removeProductFromCart($this->user, $productId);
    }
}
