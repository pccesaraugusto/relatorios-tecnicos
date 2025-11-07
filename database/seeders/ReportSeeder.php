<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    public function run()
    {
        // Exemplo simples de relatório técnico criado por técnico e vinculado a supervisor
        DB::table('reports')->insert([
            [
                'uuid' => \Illuminate\Support\Str::uuid(),
                'technician_id' => 3, // Ajuste para id válido de técnico no seu BD
                'supervisor_id' => 2, // Ajuste para id válido de supervisor no seu BD
                'title' => 'Relatório Técnico de Exemplo',
                'description' => 'Descrição detalhada do relatório técnico para testes.',
                'report_type' => 'Manutenção',
                'client_name' => 'Cliente Exemplo',
                'client_document' => '123.456.789-00',
                'service_order' => 'OS-1001',
                'original_filename' => 'relatorio_exemplo.pdf',
                'original_file_path' => '/files/relatorios/relatorio_exemplo.pdf',
                'original_file_size' => 204800,
                'original_file_hash' => hash('sha256', 'dummy content'),
                'qr_code' => 'QR20251106-123456-ABCDEFGH', // Pode usar função geradora para produção
                'status' => 'pending',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}