<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessAuditLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'access_request_id',
        'document_id',
        'user_id',
        'ip',
        'user_agent',
        'viewed_at',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];
}
