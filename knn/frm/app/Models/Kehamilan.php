<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehamilan extends Model
{
    use HasFactory;

    protected $table = 'kehamilan';
    protected $guarded = ['id'];

    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function kelahiran()
    {
        return $this->hasOne(Kelahiran::class);
    }

    public function kunjunganTerakhir()
    {
        return $this->hasOne(Kunjungan::class)->latest();
    }
}
