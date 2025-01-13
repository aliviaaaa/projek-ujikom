<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dokters')->insert([
            'kd_poli' => 1,
            'kd_user' => 1,
            'nm_dokter' => 'Dr. Smith',
            'SIP' => '123456',
            'tgl_kunjungan' => now(),
            'tmpat_lhr' => 'Jakarta',
            'no_tlp' => '08123456789',
            'alamat' => 'Jl. Kebon Jeruk No. 2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}