<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSignatureSeeder extends Seeder
{
    public function run()
    {
        // Exemplo de assinatura para relatório
        DB::table('report_signatures')->insert([
            [
                'report_id' => 1, // Ajustar para o ID do relatório inserido
                'signer_id' => 3, // Técnico assinante
                'signer_role' => 'technician',
                'signature_type' => 'system_signature',
                'signature_hash' => hash('sha256', 'signature dummy'),
                'signed_at' => now(),
                'icp_validated' => false,
                'created_at' => now(),
            ]
        ]);
    }
}