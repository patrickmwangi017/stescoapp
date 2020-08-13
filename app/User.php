<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $primaryKey = 'id';
    protected $fillable = [
        'Email', 'password', 'approved_at', 'name', 'phone', 'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders() {
        return $this->hasMany('App\Order');
    }
    public function bookedservices() {
        return $this->hasMany('App\bookedservice');
    }
    public function payments() {
        return $this->hasMany('App\payment');
    }
    public function shipment() {
        return $this->hasMany('App\shipment');

    }
    public function product() {
        return $this->hasMany('App\Product');

    }
    public function users() {
        return $this->hasMany('App\User');

    }
    

    public function servicedelivery() {
        return $this->hasMany('App\servicedelivery');
}
public function feedback() {
    return $this->hasMany('App\feedback');
}
}
