<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class suppliers extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'address', 'phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function servicedelivery() {
        return $this->hasMany('App\servicedelivery');

    }
    public function supply() {
        return $this->hasMany('App\supply', 'supplier_id', 'id');

    }
}
