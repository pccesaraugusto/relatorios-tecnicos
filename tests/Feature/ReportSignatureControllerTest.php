<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Report;
use App\Models\ReportSignature;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportSignatureControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_report_signatures()
    {
        // Cria usuário autenticado
        $user = User::factory()->create();
        $this->actingAs($user);

        // Cria um relatório para associar as assinaturas
        $report = Report::factory()->create();

        // Cria 5 assinaturas associadas ao report criado, usando o user criado
        ReportSignature::factory()->count(5)->create([
            'report_id' => $report->id,
            'user_id' => $user->id,
        ]);

        // Faz a requisição GET para a rota das assinaturas
        $response = $this->getJson('/report-signatures');

        // Valida resposta HTTP e estrutura JSON
        $response->assertStatus(200);
        $response->assertJsonCount(5);
        $response->assertJsonStructure([
            '*' => ['id', 'report_id', 'user_id', 'signature', 'created_at', 'updated_at']
        ]);
    }
}
