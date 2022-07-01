<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengantin extends Model
{

    protected $fillable = [
        'pasien_id','st_imun','tgl_imun','ikut_kelas','berat','tinggi','lila',
        'kes_jiwa','hiv','kehamilan','rwt_penyakit','rwt_penyakit_klg','kontrasepsi',
        'suhu','nadi','nafas','tk_darah','hb','trombosit','leukosit','gol_darah','rhesus',
        'gds','thalasemia','hepatitis_b','hepatitis_c','torch','urin','pakaian','pakaian_dlm'
    ];

    public function pasien()
    {
        return $this->belongsTo('App\Models\Pasien', 'pasien_id', 'id');
    }
}
