<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supply extends Model
{

    public function suppliers() {
        return $this->belongsTo('App\suppliers');
    }
}
