<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $primaryKey = 'kd_obat';
    protected $fillable = [
        'nm_obat',
        'jml_obat',
        'ukuran',
        'harga',
    ];
}
