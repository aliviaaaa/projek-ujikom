<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';
    protected $primaryKey = 'no_rm';

    protected $fillable = [
        'kd_tindakan',
        'kd_obat',
        'kd_user',
        'no_pasien',
        'diagnosa',
        'resep',
        'keluhan',
        'tgl_pemeriksaan',
        'ket',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'no_pasien', 'no_pasien');
    }

    public function tindakan()
    {
        return $this->belongsTo(Tindakan::class, 'kd_tindakan', 'kd_tindakan');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'kd_obat', 'kd_obat');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'kd_user', 'kd_user');
    }
}

