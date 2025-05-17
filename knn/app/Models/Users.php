<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = ['id', 'username','status', 'name', 'email', 'email_verified_at', 'no_tlp', 'alamat', 'password', 'remember_token', 'created_at', 'updated_at'];

    //

    public function kader()
    {
        return $this->hasOne('App\Models\Kader', 'users_id', 'id');
    }

    public function pasien()
    {
    	return $this->hasOne('App\Models\Pasien', 'users_id', 'id');
    }

}
