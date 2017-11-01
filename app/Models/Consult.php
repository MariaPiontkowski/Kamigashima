<?php

namespace App\Models;

use Eloquent;

class Consult extends Eloquent
{
    public $table = 'consults';

    public $primaryKey = 'hour';

    protected $fillable=[
        'date',
        'hour',
        'patient_id',
        'note'
    ];
    public $timestamps = false;

}