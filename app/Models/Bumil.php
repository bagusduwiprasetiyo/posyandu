<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bumil extends Model
{
    protected $fillable = [

        'pasien_id', 'posyandu_id', 'nama_ibu', 'nama_suami', 'umur', 'klp_dasa_wisma', 'tanggal', 'umur_kelahiran', 'hamil_ke', 'lila', 'pmt_pemulihan', 'kapsul_yodium', 'resiko', 'bayi', 'bayi_meninggal', 'persalinan', 'tanggal_persalinan', 'ibu_meninggal', 'keterangan', 'menyusui', 'berhenti_menyusui', 'nama_bayi'
    ];

    public function pasien()
    {
        return $this->belongsTo('App\Models\Pasien', 'pasien_id', 'id');
    }
}
