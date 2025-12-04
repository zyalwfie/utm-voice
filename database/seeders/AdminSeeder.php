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
                'password' => Hash::make('contoh123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
