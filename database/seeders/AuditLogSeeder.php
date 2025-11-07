<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuditLogSeeder extends Seeder
{
    public function run()
    {
        DB::table('audit_logs')->insert([
            [
                'user_id' => 1, // Usuário administrador
                'event_type' => 'login',
                'auditable_type' => 'User',
                'auditable_id' => 1,
                'action' => 'login',
                'description' => 'Usuário administrador efetuou login.',
                'ip_address' => '192.168.1.100',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)...',
                'created_at' => now(),
                'severity' => 'low',
            ],
            [
                'user_id' => 2,
                'event_type' => 'report_created',
                'auditable_type' => 'Report',
                'auditable_id' => 1,
                'action' => 'create',
                'description' => 'Relatório técnico criado.',
                'ip_address' => '192.168.1.101',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)...',
                'created_at' => now(),
                'severity' => 'medium',
            ],
        ]);
    }
}