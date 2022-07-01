<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relasi_Bayi extends Model
{
    protected $table = 'relasi_bayi';
    protected $fillable = ['id', 'users_id', 'bayi_id'];
}
