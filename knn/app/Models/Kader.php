<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kader extends Model
{
    protected $table = 'kader';
    protected $fillable = ['id', 'nik', 'posyandu_id', 'users_id', 'is_active'];

    //'status', 'name', 'email', 'email_verified_at', 'no_tlp', 'alamat', 'password', 'remember_token', 'created_at', 'updated_at'

    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'users_id', 'id');
    }

    public function posyandu()
    {
        return $this->belongsTo('App\Models\Posyandu', 'posyandu_id', 'id');
    }
}
