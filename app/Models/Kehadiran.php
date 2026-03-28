<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $table = 'kehadiran';

    protected $fillable = [
        'absensi_id',
        'atlet_id',
        'status',
        'bukti_kehadiran',
        'evaluasi_teknik',
        'evaluasi_fisik',
        'evaluasi_mental'
    ];

    // 🔥 relasi ke absensi
    public function absensi()
    {
        return $this->belongsTo(Absensi::class);
    }

    // 🔥 relasi ke atlet
    public function atlet()
    {
        return $this->belongsTo(Atlet::class);
    }
}