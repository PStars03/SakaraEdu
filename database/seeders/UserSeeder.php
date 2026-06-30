<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@sakaraedu.com',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@sakaraedu.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'bank_name' => 'bca',
            'bank_account_number' => '1234567890',
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@sakaraedu.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    }
}
