<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Http\Services\Public\PublicServices;

class HomeController extends Controller
{
    public function index(): View
    {
        return (new PublicServices)->getHomePage();
    }
}
