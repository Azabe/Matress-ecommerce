<?php

namespace App\Http\Services\Public;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class PublicServices
{
    public function getHomePage(): View
    {
        $latestProducts = Product::orderBy('created_at', 'desc')->limit(6)->get();
        return view('public.welcome', compact('latestProducts'));
    }
}
