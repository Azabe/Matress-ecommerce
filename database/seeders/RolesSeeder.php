<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->delete();
        
        foreach (Role::ROLES as $role) {
            Role::create([
                'id' => Str::uuid()->toString(),
                'role' => $role,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
