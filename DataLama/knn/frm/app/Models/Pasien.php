<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $fillable = ['rekam_medik', 'nama_ibu', 'nama_suami', 'golongan_darah', 'alamat'];

    public function kehamilans()
    {
        return $this->hasMany(Kehamilan::class, 'pasien_id');
    }

    public function kunjungans()
    {
        return $this->hasMany(Kunjungan::class, 'pasien_id');
    }
}
