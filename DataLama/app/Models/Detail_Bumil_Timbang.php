<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_Bumil_Timbang extends Model
{
    protected $fillable = ['bumils_id', 'bulan_ke','bulan','berat_badan','tekanan_darah','tanggal'];

	protected $table = 'detail_bumils_hasil_penimbangan';

}

