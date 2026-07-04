<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();
        $staffRole = Role::where('name', 'Staff')->first();
        $managerRole = Role::where('name', 'Manager')->first();

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@inlife.com',
            'password' => Hash::make('password123'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Staff Inventaris',
            'email' => 'staff@inlife.com',
            'password' => Hash::make('password123'),
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Manager Laporan',
            'email' => 'manager@inlife.com',
            'password' => Hash::make('password123'),
            'role_id' => 3,
        ]);
    }
}
