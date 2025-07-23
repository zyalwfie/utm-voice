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
        // Create default admin user
        User::updateOrCreate(
            ['email' => 'admin@utmvoice.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@utmvoice.com',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // Create another admin user for testing
        User::updateOrCreate(
            ['email' => 'superadmin@utmvoice.com'],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@utmvoice.com',
                'password' => Hash::make('superadmin123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin users created successfully!');
        $this->command->info('');
        $this->command->info('=== LOGIN CREDENTIALS ===');
        $this->command->info('Email: admin@utmvoice.com');
        $this->command->info('Password: admin123');
        $this->command->info('');
        $this->command->info('Email: superadmin@utmvoice.com');
        $this->command->info('Password: superadmin123');
        $this->command->info('========================');
    }
}
