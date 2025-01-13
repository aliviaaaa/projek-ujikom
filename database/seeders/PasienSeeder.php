<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pasiens')->insert([
            'nm_pasien' => 'John Doe',
            'j_kel' => 'Laki-laki',
            'agama' => 'Islam',
            'alamat' => 'Jl. Kebon Jeruk No. 1',
            'tgl_lhr' => '1990-01-01',
            'usia' => 30,
            'no_tlp' => '08123456789',
            'nm_kk' => 'Jane Doe',
            'hub_kel' => 'Suami',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}