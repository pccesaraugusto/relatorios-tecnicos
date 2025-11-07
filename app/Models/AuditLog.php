<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id', 'event_type', 'auditable_type', 'auditable_id', 'action', 'description',
        'old_values', 'new_values', 'ip_address', 'user_agent', 'url', 'method',
        'metadata', 'severity',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'metadata' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
