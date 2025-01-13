<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $primaryKey = 'kd_dokter';

    protected $fillable = [
        'kd_poli',
        'kd_user',
        'nm_dokter',
        'SIP',
        'tgl_kunjungan',
        'tmpat_lhr',
        'no_tlp',
        'alamat',
    ];

    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class, 'kd_poli');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'kd_user');
    }
}
