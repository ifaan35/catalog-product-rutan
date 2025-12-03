<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user admin untuk testing
        User::updateOrCreate(
            ['email' => 'admin@rutanshop.com'],
            [
                'name' => 'Admin RUTAN SHOP',
                'email' => 'admin@rutanshop.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Buat user petugas lainnya
        User::updateOrCreate(
            ['email' => 'petugas@rutanshop.com'],
            [
                'name' => 'Petugas RUTAN',
                'email' => 'petugas@rutanshop.com',
                'email_verified_at' => now(),
                'password' => Hash::make('petugas123'),
                'role' => 'admin',
            ]
        );

        // Buat user customer untuk testing
        User::updateOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Customer Test',
                'email' => 'customer@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('customer123'),
                'role' => 'customer',
            ]
        );

        echo "Admin users created successfully!\n";
        echo "Admin: admin@rutanshop.com / admin123\n";
        echo "Petugas: petugas@rutanshop.com / petugas123\n";
        echo "Customer: customer@example.com / customer123\n";
    }
}
