<?php

namespace App\Http\Services\Auth;

use Illuminate\Contracts\View\View;

class AuthServices
{
    public function getRegister(): View
    {
        return view('auth.register');
    }

    public function getLogin(): View
    {
        return view('auth.login');
    }
}
