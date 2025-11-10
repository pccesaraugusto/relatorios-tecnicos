<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid', 'technician_id', 'supervisor_id', 'user_id', 'file_path',// adicione user_id aqui
        'title', 'description', 'report_type',
        'client_name', 'client_document', 'service_order', 'original_filename', 'original_file_path',
        'original_file_size', 'original_file_hash', 'original_mime_type', 'signed_file_path',
        'signed_file_hash', 'signed_at', 'qr_code', 'qr_code_image_path', 'status',
        'validation_notes', 'validated_at', 'rejected_at', 'rejection_reason', 'retroactive_date',
        'retroactive_justification', 'metadata', 'tags', 'version', 'parent_report_id',
        'is_public', 'expires_at',
    ];

    protected $casts = [
        'signed_at' => 'datetime',
        'validated_at' => 'datetime',
        'rejected_at' => 'datetime',
        'retroactive_date' => 'date',
        'metadata' => 'array',
        'tags' => 'array',
        'expires_at' => 'datetime',
        'is_public' => 'boolean',
    ];

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Relaciona o usuário que criou o relatório
    }

    public function parentReport()
    {
        return $this->belongsTo(Report::class, 'parent_report_id');
    }

    public function signatures()
    {
        return $this->hasMany(ReportSignature::class, 'report_id');
    }

    public function validations()
    {
        return $this->hasMany(ReportValidation::class, 'report_id');
    }
}
