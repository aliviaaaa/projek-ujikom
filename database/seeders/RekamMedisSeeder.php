<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RekamMedisSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rekam_medis')->insert([
            'kd_tindakan' => 1,
            'kd_obat' => 1,
            'kd_user' => 1,
            'no_pasien' => 1,
            'diagnosa' => 'Flu',
            'resep' => 'Paracetamol 500mg',
            'keluhan' => 'Demam dan batuk',
            'tgl_pemeriksaan' => now(),
            'ket' => 'Istirahat yang cukup',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}