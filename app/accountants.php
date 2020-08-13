<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class accountants extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
     'name', 'email', 'password', 'address', 'phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    
public function orders() {
    return $this->hasMany('App\Order');
}

public function payments() {
    return $this->hasMany('App\payment');
}

public function shipment() {
    return $this->hasMany('App\shipment');

}
}

