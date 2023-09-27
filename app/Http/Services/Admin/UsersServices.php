<?php

namespace App\Http\Services\Admin;

use App\Http\Services\Auth\AuthServices;
use App\Jobs\SendMessage;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersServices
{
    protected $role;

    public function __construct()
    {
        $this->role = new Role();
    }

    public function getUsers(): View
    {
        $users = User::with('role')->get();
        return view('admin.users.index', compact('users'));
    }

    public function createNewUser(): View
    {
        $roles = Role::get();
        $districts = (new AuthServices)->getDistricts();
        return view('admin.users.create', compact('roles', 'districts'));
    }

    public function storeNewUser(Request $request): RedirectResponse
    {
        $generatedPassword = rand(100000, 999999);
        $newUser = [
            'id' => Str::uuid()->toString(),
            'role_id' => $request->role,
            'names' => $request->names,
            'residence' => $request->residence,
            'tin' => $request->tin,
            'telephone' => $request->telephone,
            'status' => User::ACTIVE,
            'email' => $request->email,
            'password' => Hash::make($generatedPassword),
            'created_at' => now(),
            'updated_at' => now()
        ];
        $newUserMessage = 'Dear ' . $newUser['names'] . ' Your account has been created as a ' . $this->role->getRoleName(Role::DISTRIBUTOR) . ' with the default password of ' . $generatedPassword . ' please login
        to our site and change your default password and keep using our services';

        User::create($newUser);
        SendMessage::dispatch($newUser['telephone'], $newUserMessage);
        return redirect()->route('admin.users.index')->with('success', 'New user has been created successfully');
    }

    public function changeUserStatus(string $userId): RedirectResponse
    {
        $userToUpdate = User::find($userId);
        $userToUpdate->update([
            'status' => $userToUpdate->status === User::ACTIVE ? User::INACTIVE : User::ACTIVE
        ]);

        return back()->with('success', 'user status changed successfully');
    }

    public function getUsersReports()
    {
        
    }
}
