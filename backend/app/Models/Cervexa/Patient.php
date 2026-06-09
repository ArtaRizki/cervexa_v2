<?php

namespace App\Models\Cervexa;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'cervexa_patients';

    protected $fillable = [
        'nama',
        'nik',
        'hospital_name',
        'nrm',
        'dob'
    ];

    public function sessions()
    {
        return $this->hasMany(Session::class, 'patient_id');
    }
}
