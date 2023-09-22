<?php

namespace App\Http\Services\Auth;

use Illuminate\Contracts\View\View;

class AuthServices
{
    public function getRegister(): View
    {
        $districts = $this->getDistricts();
        return view('auth.register', compact('districts'));
    }

    public function getLogin(): View
    {
        return view('auth.login');
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
}
