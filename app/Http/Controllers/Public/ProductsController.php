<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Services\Public\PublicServices;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(): View
    {
        return (new PublicServices)->getProductsPage();
    }
}
