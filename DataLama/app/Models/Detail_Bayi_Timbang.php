<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_Bayi_Timbang extends Model
{
    protected $fillable = ['bayi_id','bulan_ke','bulan','umur_bulan','umur_hari','berat_badan','tinggi_badan','sd_bb','sd_pb','status_bb','status_pb','tanggal'];

	protected $table = 'detail_bayi_timbang';

}
