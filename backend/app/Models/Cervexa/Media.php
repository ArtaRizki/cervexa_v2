<?php

namespace App\Models\Cervexa;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'cervexa_media';

    protected $fillable = [
        'session_id',
        'type',
        'original_name',
        'public_url',
        'file_size',
        'mime_type'
    ];

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
}
