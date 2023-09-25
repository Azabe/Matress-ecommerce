<?php

namespace App\Http\Services\Admin;

use App\Models\User;
use Illuminate\Contracts\View\View;

class UsersServices
{
    public function getUsers(): View
    {
        $users = User::with('role')->get();
        return view('admin.users.index', compact('users'));
    }
}
