<?php

namespace App\Models;

use Eloquent;

class Consult extends Eloquent
{
    public $table = 'consults';

    public $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable=[
        'id',
        'date',
        'hour',
        'patient_id',
        'note',
        'session',
        'presence'
    ];
    public $timestamps = false;

}