<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaboratoriumSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('laboratoriums')->insert([
            'no_rm' => 1,
            'hasil_lab' => 'Negatif',
            'ket' => 'Tidak ada infeksi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}