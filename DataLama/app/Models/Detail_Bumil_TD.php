<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_Bumil_TD extends Model
{
    protected $fillable = ['bumils_id','status','tanggal'];

	protected $table = 'detail_bumils_tablet_tambah_darah';

}
