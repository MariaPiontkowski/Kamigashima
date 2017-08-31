<?php

namespace App\Models;

use Eloquent;

class Patient extends Eloquent
{
    public function address()
    {
        return $this->hasOne('App\Models\PatientAddress');
    }

    public function phones()
    {
        return $this->hasMany('App\Models\PatientPhone');
    }
}