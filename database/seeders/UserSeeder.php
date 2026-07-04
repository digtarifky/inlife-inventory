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
            'name' => 'Admin Utama',
            'email' => 'admin@telkomsel.com',
            'password' => Hash::make('password123'),
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'name' => 'Staff Inventaris',
            'email' => 'staff@telkomsel.com',
            'password' => Hash::make('password123'),
            'role_id' => $staffRole->id,
        ]);

        User::create([
            'name' => 'Manager Laporan',
            'email' => 'manager@telkomsel.com',
            'password' => Hash::make('password123'),
            'role_id' => $managerRole->id,
        ]);
    }
}
