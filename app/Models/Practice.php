<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    protected $fillable = [
        'external_id',
        'practice_type',
        'status',
        'opened_at',
        'closed_at',
    ];

    protected $casts = [
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public function metadata()
    {
        return $this->hasMany(PracticeMetadata::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // Se hai creato access_request_practices (opzionale), lascia questa relazione.
    // Se NON hai quella tabella, puoi commentarla o rimuoverla.
    public function accessRequests()
    {
        return $this->belongsToMany(
            AccessRequest::class,
            'access_request_practices'
        );
    }
}
