<?php

namespace App\Models;

use Eloquent;

class Patient extends Eloquent
{
    public function address()
    {
        return $this->hasOne(PatientAddress::class);
    }

    public function phones()
    {
        return $this->hasMany(PatientPhone::class);
    }

    public function agreement()
    {
        return $this->hasOne(PatientAgreement::class);
    }

    public function responsible()
    {
        return $this->hasOne(PatientResponsible::class);
    }
}