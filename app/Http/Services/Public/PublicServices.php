<?php

namespace App\Http\Services\Public;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PublicServices
{
    public function getHomePage(): View
    {
        $latestProducts = Product::orderBy('created_at', 'desc')->limit(6)->get();
        $minimumProductPrice = Product::min('price');
        return view('public.welcome', compact('latestProducts', 'minimumProductPrice'));
    }

    public function getProductsPage(): View
    {
        $products = Product::where('quantity', '>', 0)->get();
        return view('public.products.index', compact('products'));
    }

    public function getProductPage(string $productId): View
    {
        $product = Product::find($productId);
        return view('public.products.show', compact('product'));
    }
}
