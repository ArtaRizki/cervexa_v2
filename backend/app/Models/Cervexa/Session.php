<?php

namespace App\Models\Cervexa;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'cervexa_sessions';

    protected $fillable = [
        'session_code',
        'patient_id',
        'status',
        'hospital_name',
        'notes',
        'started_at',
        'completed_at'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'session_id');
    }
}
