<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
                'name' => 'Administrator',
                'email' => 'admin@utmvoice.com',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        User::create(
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@utmvoice.com',
                'password' => Hash::make('superadmin123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
