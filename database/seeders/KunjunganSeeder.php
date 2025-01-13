<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KunjunganSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kunjungans')->insert([
            'no_pasien' => 1,
            'kd_poli' => 1,
            'tgl_kunjungan' => now(),
            'jam_kunjungan' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}