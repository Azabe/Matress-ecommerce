<?php

namespace App\Http\Services\Public;

use Illuminate\Contracts\View\View;

class PublicServices
{
    public function getHomePage(): View
    {
        // return latest products
        return view('public.welcome');
    }
}
