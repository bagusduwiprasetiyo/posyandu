<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $table = 'kunjungan';
    protected $guarded = ['id'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function kehamilan()
    {
        return $this->belongsTo(Kehamilan::class);
    }
}
