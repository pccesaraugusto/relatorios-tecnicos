<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Report;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportValidationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_fails_validation_on_invalid_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $invalidData = []; // dados vazios para disparar erros

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->postJson('/report-validations', $invalidData);

        $response->assertStatus(422);

        // Verifica os erros de validação para os campos obrigatórios corretos
        $response->assertJsonValidationErrors([
            'report_id',
            'validator_id',
            'action',
            'status_to',
        ]);
    }

    public function test_store_succeeds_with_valid_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $report = Report::factory()->create();

        $validData = [
            'report_id' => $report->id,
            'validator_id' => $user->id,
            'action' => 'approved',
            'status_to' => 'finalized',
            // adicione os demais campos necessários para criação válida
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->postJson('/report-validations', $validData);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'report_id' => $report->id,
            'validator_id' => $user->id,
            'action' => 'approved',
            'status_to' => 'finalized',
        ]);

        $this->assertDatabaseHas('report_validations', [
            'report_id' => $report->id,
            'validator_id' => $user->id,
            'action' => 'approved',
            'status_to' => 'finalized',
        ]);
    }
}
