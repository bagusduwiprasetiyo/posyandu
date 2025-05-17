<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function getHasilAttribute()
    {
        return $this->orderBy('jarak', 'asc');
    }

    public function kehamilanTerakhir()
    {
        $this->belongsTo(Kehamilan::class);
    }
}
