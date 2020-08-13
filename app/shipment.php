<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shipment extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function accountant() {
        return $this->belongsTo('App\accountants');
    }

    public function driver() {
        return $this->belongsTo('App\drivers');
    }
    public function ordermanager() {
        return $this->belongsTo('App\ordermanager');
    }
}
