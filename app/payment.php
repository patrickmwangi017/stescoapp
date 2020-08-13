<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $fillable = ['mpesa_code', 'name'];

    public function user() {
        return $this->belongsTo('App\User');
    }
    public function accountant() {
        return $this->belongsTo('App\accountants');
    }
}


