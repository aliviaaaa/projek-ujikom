<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorium extends Model
{
    use HasFactory;

    protected $table = 'laboratoriums';

    protected $primaryKey = 'kd_lab';

    protected $fillable = [
        'no_rm',
        'hasil_lab',
        'ket',
    ];

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'no_rm', 'no_rm');
    }
}
