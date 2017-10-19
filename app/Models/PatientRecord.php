<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;

class PatientRecord extends Eloquent
{
    protected $appends = ['date_at', 'hour_at'];

    protected function getDateAtAttribute()
    {
        return Carbon::parse($this->created_at)->format("d/m/Y");
    }

    protected function getHourAtAttribute()
    {
        return Carbon::parse($this->created_at)->format("H:i");
    }
}