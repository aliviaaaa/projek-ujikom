<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliklinikSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('polikliniks')->insert([
            'nm_poli' => 'Poli Umum',
            'lantai' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}