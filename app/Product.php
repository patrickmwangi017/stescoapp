<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{


   protected $fillable = ['Picture', 'productName', 'Description', 'Price', 'quantity_available'];

   public function stockmanager() {
      return $this->belongsTo('App\stockmanager');
  }
}
