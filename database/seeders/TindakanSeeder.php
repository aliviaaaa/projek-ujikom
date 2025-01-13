<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TindakanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tindakans')->insert([
            'nm_tindakan' => 'Pemeriksaan Umum',
            'ket' => 'Pemeriksaan kesehatan umum',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}