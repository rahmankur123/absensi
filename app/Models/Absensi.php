<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'jadwal_id',
        'tanggal',
        'status'
    ];

    // 🔥 relasi ke jadwal
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    // 🔥 relasi ke kehadiran (detail)
    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class);
    }
}