<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun tetap untuk testing 3 role (password: password)
        User::factory()->create(['name' => 'Admin Toko',  'email' => 'admin@example.com',  'role' => User::ROLE_ADMIN]);
        User::factory()->create(['name' => 'Editor Satu', 'email' => 'editor@example.com', 'role' => User::ROLE_EDITOR]);
        User::factory()->create(['name' => 'Editor Dua',  'email' => 'editor2@example.com', 'role' => User::ROLE_EDITOR]);
        User::factory()->create(['name' => 'User Biasa',  'email' => 'user@example.com',   'role' => User::ROLE_USER]);

        // 8 user tambahan
        User::factory(8)->create(['role' => User::ROLE_USER]);
    }
}