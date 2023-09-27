<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\UsersServices;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(): View
    {
        return (new UsersServices)->getUsers();
    }
    public function create(): View
    {
        return (new UsersServices)->createNewUser();
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'names' => 'required',
            'email' => 'required | email | unique:users',
            'tin' => 'required | numeric | unique:users',
            'telephone' => 'required | numeric | unique:users',
            'residence' =>  'required',
            'role' => 'required'
        ]);
        return (new UsersServices)->storeNewUser($request);
    }

    public function update(string $userId): RedirectResponse
    {
        return (new UsersServices)->changeUserStatus($userId);
    }

    public function print()
    {
        return (new UsersServices)->getUsersReports();
    }
}
