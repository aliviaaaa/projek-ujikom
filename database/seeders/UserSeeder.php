<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['username' => 'admin', 'password' => 'admin123', 'role' => 'admin'],
            ['username' => 'dokter', 'password' => 'dokter123', 'role' => 'dokter'],
            ['username' => 'pasien', 'password' => 'pasien123', 'role' => 'pasien'],
            ['username' => 'laboratorium', 'password' => 'laboratorium123', 'role' => 'laboratorium'],
            ['username' => 'farmasi', 'password' => 'farmasi123', 'role' => 'farmasi'],
            ['username' => 'perawat', 'password' => 'perawat123', 'role' => 'perawat'],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'username' => $user['username'],
                'password' => Hash::make($user['password']),
                'role' => $user['role'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}