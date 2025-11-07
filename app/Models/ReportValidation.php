<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportValidation extends Model
{
    protected $fillable = [
        'report_id', 'validator_id', 'action', 'status_from', 'status_to',
        'notes', 'rejection_reason', 'required_changes', 'notification_sent',
        'notification_sent_at', 'ip_address', 'user_agent',
    ];

    protected $casts = [
        'notification_sent' => 'boolean',
        'notification_sent_at' => 'datetime',
        'required_changes' => 'array',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_id');
    }
}
