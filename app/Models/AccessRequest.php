<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessRequest extends Model
{
    protected $fillable = [
        'protocol_number',
        'subject',
        'requester_name',
        'requester_fiscal_code',
        'requester_email',
        'requester_type',
        'status',
        'requested_at',
        'processed_at',
        'expires_at',
        'created_by',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'processed_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'access_request_documents');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'access_request_users')
            ->withPivot(['granted_at', 'revoked_at'])
            ->withTimestamps();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
