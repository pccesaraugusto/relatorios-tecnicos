<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ReportValidationSeeder extends Seeder
{
    public function run()
    {
        // Validação inicial do relatório
        DB::table('report_validations')->insert([
            [
                'report_id' => 1, // Ajustar para o ID do relatório inserido
                'validator_id' => 2, // Supervisor validador
                'action' => 'submitted',
                'status_from' => null,
                'status_to' => 'pending',
                'notification_sent' => false,
                'created_at' => now(),
            ],
        ]);
    }
}