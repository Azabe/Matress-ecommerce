<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\ProductsServices;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ProductsController extends Controller
{
    public function index(): View
    {
        return (new ProductsServices)->getAllProducts();
    }

    public function create(): View
    {
        return (new ProductsServices)->createNewProduct();
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'size' => 'required',
            'type' => 'required',
            'image' => 'required',
            'description' => 'required | unique:products',
            'length' => 'required',
            'quantity' => 'required',
            'height' => 'required',
            'width' => 'required',
            'price' => 'required'
        ]);

        return (new ProductsServices)->storeNewProduct($request);
    }

    public function destroy(string $productId): RedirectResponse
    {
        return (new ProductsServices)->deleteSoldProduct($productId);
    }
}
