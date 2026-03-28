<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasi';

    protected $fillable = [
        'atlet_id',
        'nama_kejuaraan',
        'tingkat',
        'juara',
        'status',
        'tahun',
        'bukti_prestasi',
        'keterangan'
    ];

    public function atlet()
    {
        return $this->belongsTo(Atlet::class);
    }
}