<?php

namespace App\Http\Services\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthServices
{

    protected $role;

    public function __construct()
    {
        $this->role = new Role();
    }
    public function getRegister(): View
    {
        $districts = $this->getDistricts();
        return view('auth.register', compact('districts'));
    }

    public function getLogin(): View
    {
        return view('auth.login');
    }

    public function postRegister(Request $request): RedirectResponse
    {
        $newUser = [
            'id' => Str::uuid()->toString(),
            'role_id' => $this->role->getRoleId(Role::DISTRIBUTOR),
            'names' => $request->names,
            'residence' => $request->residence,
            'tin' => $request->tin,
            'telephone' => $request->telephone,
            'status' => User::ACTIVE,
            'password_confirmed' => true,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now()
        ];
        User::insert($newUser);
        return $this->postLogin($request->email, $request->password);
    }

    public function postLogin($email, $password): RedirectResponse
    {
        $credentials = ['email' => $email, 'password' => $password];
        return Auth::attempt($credentials) ?
            $this->redirectIfAuthenticated(Auth::user())
            : back()->withInput()->with('error', 'invalid credentials');
    }

    public function redirectIfAuthenticated($user): RedirectResponse
    {
        if ($user->status === User::INACTIVE) {
            Auth::logout();
            return back()->withInput()->with('error', 'Your account has been closed.. please contact the administrator');
        }
        if (!$user->password_confirmed) {
            return back()->withInput()->with('error', 'Account not confirmed');
        }
        if ($user->role->role === Role::ADMIN) {
            return redirect()->route('admin.home');
        }
        if ($user->role->role === Role::FACTORY_MANAGER) {
            return redirect()->route('manager.orders.processing.index');
        }
        if ($user->role->role === Role::DISTRIBUTOR) {
            return redirect()->route('home');
        }
        if ($user->role->role === Role::CUSTOMER_CARE) {
            return redirect()->route('customercare.orders.index');
        }
    }

    public function getDistricts(): array
    {
        $districts =  [
            'Bugesera',
            'Gatsibo',
            'Kayonza',
            'Kirehe',
            'Ngoma',
            'Nyagatare',
            'Rwamagana',
            'Gasabo',
            'Kicukiro',
            'Nyarugenge',
            'Burera',
            'Gakenke',
            'Gicumbi',
            'Musanze',
            'Rulindo',
            'Gisagara',
            'Huye',
            'Kamonyi',
            'Muhanga',
            'Nyamagabe',
            'Nyanza',
            'Nyaruguru',
            'Ruhango',
            'Karongi',
            'Ngororero',
            'Nyabihu',
            'Nyamasheke',
            'Rubavu',
            'Rusizi',
            'Rutsiro'
        ];
        sort($districts);
        return $districts;
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect('/');
    }
}
