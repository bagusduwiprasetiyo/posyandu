<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_Bayi_Imun extends Model
{
    protected $fillable = ['bayi_id','hbo','bcg','dpt_hb','polio'];

	protected $table = 'detail_bayi_imun';

}
