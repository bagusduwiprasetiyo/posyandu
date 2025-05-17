<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relasi_Bumil extends Model
{
    protected $table = 'relasi_bumil';
    protected $fillable = ['id', 'users_id', 'bumils_id'];
}
