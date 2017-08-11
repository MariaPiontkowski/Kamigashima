<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function provider()
    {
        return $this->belongsTo('App\Product');
    }
}
