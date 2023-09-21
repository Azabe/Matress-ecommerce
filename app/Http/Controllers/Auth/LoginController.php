<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Auth\AuthServices;
use Illuminate\Contracts\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return (new AuthServices)->getRegister();
    }
}
