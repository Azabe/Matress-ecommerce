<?php

namespace App\Http\Services\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;

class UsersServices
{
    public function getUsers(): View
    {
        $users = User::with('role')->get();
        return view('admin.users.index', compact('users'));
    }

    public function createNewUser(): View
    {
        $roles = Role::get();
        return view('admin.users.create', compact('roles'));
    }
}
