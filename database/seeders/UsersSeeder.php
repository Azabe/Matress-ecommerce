<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = new Role();

        DB::table('users')->delete();

        DB::table('users')->insert([
            [
                'id' => Str::uuid()->toString(),
                'role_id' => $role->getRoleId(Role::ADMIN),
                'names' => 'system administrator',
                'residence' => 'KIGALI',
                'tin' => 11111,
                'telephone' => 250788111111,
                'status' => User::ACTIVE,
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin12345'),
                'password_confirmed' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid()->toString(),
                'role_id' => $role->getRoleId(Role::FACTORY_MANAGER),
                'names' => 'system distributor',
                'residence' => 'KIGALI',
                'tin' => 22222,
                'telephone' => 250788222222,
                'status' => User::ACTIVE,
                'email' => 'manager@gmail.com',
                'password' => Hash::make('manager12345'),
                'password_confirmed' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid()->toString(),
                'role_id' => $role->getRoleId(Role::CUSTOMER_CARE),
                'names' => 'system customer care',
                'residence' => 'KIGALI',
                'tin' => 33333,
                'telephone' => 250788333333,
                'status' => User::ACTIVE,
                'email' => 'customercare@gmail.com',
                'password' => Hash::make('customercare12345'),
                'password_confirmed' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
