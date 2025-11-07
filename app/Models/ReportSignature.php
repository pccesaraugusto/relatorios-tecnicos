<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportSignature extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'report_id', 'signer_id', 'signer_role', 'signature_type', 'signature_hash',
        'signature_data', 'certificate_serial', 'certificate_issuer', 'certificate_subject',
        'signed_at', 'signature_ip', 'user_agent', 'icp_validated', 'icp_validation_data',
    ];

    protected $casts = [
        'signed_at' => 'datetime',
        'icp_validated' => 'boolean',
        'icp_validation_data' => 'array',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function signer()
    {
        return $this->belongsTo(User::class, 'signer_id');
    }
}
