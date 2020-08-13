<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class stockmanager extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
     'name', 'email', 'password', 'address', 'phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function product() {
        return $this->hasMany('App\Product');

    }

}

