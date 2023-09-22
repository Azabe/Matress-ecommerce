<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Auth\AuthServices;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;

class LoginController extends Controller
{
    public function index(): View
    {
        return (new AuthServices)->getLogin();
    }
}
