<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicedelivery extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function accountant() {
        return $this->belongsTo('App\accountants');
    }

    public function suppliers() {
        return $this->belongsTo('App\suppliers');
    }
}
