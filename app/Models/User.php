<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'role_id', 'name', 'email', 'password', 'cpf', 'phone',
        'avatar', 'digital_certificate', 'certificate_serial',
        'certificate_valid_from', 'certificate_valid_until',
        'certificate_issuer', 'is_active', 'last_login_at', 'last_login_ip',
        'failed_login_attempts', 'locked_until', 'locale', 'timezone',
        'theme', 'email_notifications', 'notification_preferences',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'certificate_valid_from' => 'datetime',
        'certificate_valid_until' => 'datetime',
        'is_active' => 'boolean',
        'email_notifications' => 'boolean',
        'notification_preferences' => 'array',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relação com Role (pertence a uma Role)
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relacionamento com relatórios onde é técnico
    public function technicianReports()
    {
        return $this->hasMany(Report::class, 'technician_id');
    }

    // Relacionamento com relatórios onde é supervisor
    public function supervisorReports()
    {
        return $this->hasMany(Report::class, 'supervisor_id');
    }
}
