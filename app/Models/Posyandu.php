<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    protected $table = 'list_posyandu';
    protected $fillable = ['id', 'nama'];

    public function kader()
    {
        return $this->hasOne('App\Models\Kader', 'id', 'posyandu_id');
    }
}
