<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObatSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('obats')->insert([
            'nm_obat' => 'Paracetamol',
            'jml_obat' => 100,
            'ukuran' => '500mg',
            'harga' => 5000.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}