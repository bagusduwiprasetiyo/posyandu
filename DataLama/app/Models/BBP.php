<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BBP extends Model
{
     
   	protected $fillable = ['umur','min3','min2','min1','median','plus1','plus2','plus3'];

	protected $table = 'bbp';
}
