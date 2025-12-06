<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function Symfony\Component\Clock\now;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'student_id' => '21TI080',
                'name' => 'Lingga Jati',
                'email' => 'uchihalingga12@gmail.com',
                'email_verified_at' => now(),
                'is_admin' => false,
                'password' => Hash::make('LinggaJati12'),
                'remember_token' => Str::random(10),
            ],
            [
                'student_id' => '21TI096',
                'name' => 'Reza Ramadhan',
                'email' => 'rezaramadhan@gmail.com',
                'email_verified_at' => now(),
                'is_admin' => false,
                'password' => Hash::make('Reza12345'),
                'remember_token' => Str::random(10),
            ],
            [
                'student_id' => '21TI112',
                'name' => 'Ziyat Al Wafi',
                'email' => 'zyalwfie@gmail.com',
                'email_verified_at' => now(),
                'is_admin' => false,
                'password' => Hash::make('ziyadalwafie123'),
                'remember_token' => Str::random(10),
            ],
            [
                'student_id' => '21TI115',
                'name' => 'Zulkarnaen',
                'email' => 'bigfamiliy901@gmail.com',
                'email_verified_at' => now(),
                'is_admin' => false,
                'password' => Hash::make('jungxyare'),
                'remember_token' => Str::random(10),
            ],
        ];

        User::insert($data);
    }
}
