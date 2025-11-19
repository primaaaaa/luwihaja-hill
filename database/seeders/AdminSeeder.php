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
        if (!User::where('email', 'admin@luwihaja.com')->exists()) {
            User::create([
                'nama' => 'Administrator',
                'email' => 'admin@luwihaja.com',
                'password' => Hash::make('password123'), 
                'noTelepon' => '081234567890',
                'role' => 'Admin',
            ]);
        }

        $admins = [
            [
                'nama' => 'Admin Utama',
                'email' => 'adminutama@luwihaja.com',
                'password' => Hash::make('admin123'),
                'noTelepon' => '081234567891',
                'role' => 'Admin',
            ],
        ];

        foreach ($admins as $admin) {
            if (!User::where('email', $admin['email'])->exists()) {
                User::create($admin);
            }
        }

        if (!User::where('email', 'tamu@test.com')->exists()) {
            User::create([
                'nama' => 'Tamu Test',
                'email' => 'tamu@test.com',
                'password' => Hash::make('password123'),
                'noTelepon' => '082345678901',
                'role' => 'Calon Tamu',
            ]);
        }
    }
}