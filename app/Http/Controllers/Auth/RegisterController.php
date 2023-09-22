<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Auth\AuthServices;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(): View
    {
        return (new AuthServices)->getRegister();
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'names' => 'required',
            'email' => 'required | email | unique:users',
            'tin' => 'required | numeric | unique:users',
            'telephone' => 'required | numeric | unique:users',
            'residence' =>  'required',
            'password' => 'required | min:6 | confirmed',
            'password_confirmation' => 'required | min:6'
        ]);
        return (new AuthServices)->postRegister($request);
    }
}
