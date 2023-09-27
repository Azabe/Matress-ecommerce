<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Auth\AuthServices;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::user() || (Auth::user() && Auth::user()->password_confirmed)) {
                return back();
            }
            $this->user = Auth::user();
            return $next($request);
        });
    }
    public function index(): View
    {
        return (new AuthServices)->getUpdatePasswordPage($this->user);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required | min:6 | confirmed',
            'password_confirmation' => 'required | min:6'
        ]);
        return (new AuthServices)->updatePassword($request, $this->user);
    }
}
