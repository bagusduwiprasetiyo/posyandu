<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = [
        'posyandu_id', 'users_id', 'nama',  'nik', 'tempat_lahir', 'tgl_lahir', 'umur', 'pekerjaan', 'pendidikan',
        'nama_suami', 'nik_suami', 'umur_suami', 'pekerjaan_suami', 'pendidikan_suami',
        'alamat', 'alamat_domisili', 'rw', 'kecamatan', 'kabupaten', 'kota', 'no_tlp', 'pekerjaan_lainnya', 'pekerjaan_suami_lainnya'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'id', 'users_id');
    }

    public function bumil()
    {
        return $this->hasOne('App\Models\Bumil', 'pasien_id', 'id');
    }

    public function pengantin()
    {
        return $this->hasOne('App\Models\Pengantin', 'pasien_id', 'id');
    }
}
