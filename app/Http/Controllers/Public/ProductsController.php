<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Services\Public\PublicServices;
use Illuminate\Contracts\View\View;

class ProductsController extends Controller
{
    public function index(): View
    {
        return (new PublicServices)->getProductsPage();
    }
    public function show(string $productId): View
    {
        return (new PublicServices)->getProductPage($productId);
    }
}
