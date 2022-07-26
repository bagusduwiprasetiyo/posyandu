<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bayi extends Model
{
    protected $fillable = ['pasien_id', 'nama_ibu', 'nama_ayah', 'posyandu_id', 'nama', 'tanggal_lahir', 'bb_pb', 'l_p', 'campak', 'meninggal', 'keterangan', 'kms', 'diare'];

    protected $table = 'bayi';
}
