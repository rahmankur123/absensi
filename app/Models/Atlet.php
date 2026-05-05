<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atlet extends Model
{
    use HasFactory;

    protected $table = 'atlet';

    protected $fillable = [
        'user_id',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'berat_badan',
        'tinggi_badan',
        'sabuk'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kehadiran()
{
    return $this->hasMany(Kehadiran::class);
}

public function prestasi()
{
    return $this->hasMany(Prestasi::class, 'atlet_id');
}
}