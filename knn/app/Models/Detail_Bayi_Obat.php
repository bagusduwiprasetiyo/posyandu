<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_Bayi_Obat extends Model
{
    protected $fillable = ['bayi_id', 'sirup_fe', 'vit_a', 'oralit', 'pmt',];

    protected $table = 'detail_bayi_obat';
}
