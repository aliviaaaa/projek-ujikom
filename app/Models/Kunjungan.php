<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kunjungan';

    protected $fillable = [
        'no_pasien',
        'kd_poli',
        'tgl_kunjungan',
        'jam_kunjungan',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'no_pasien');
    }

    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class, 'kd_poli');
    }
}
