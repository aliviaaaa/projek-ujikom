<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_pasien';

    protected $fillable = [
        'nm_pasien',
        'j_kel',
        'agama',
        'alamat',
        'tgl_lhr',
        'usia',
        'no_tlp',
        'nm_kk',
        'hub_kel',
    ];
}
