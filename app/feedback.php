<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
    protected $fillable = ['telephone', 'feedbackMessage'];

    public function user() {
        return $this->belongsTo('App\User');
    }
    public function accountant() {
        return $this->belongsTo('App\accountants');
    }
}
