<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\AuditLog; // ajuste para sua model correta de logs
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuditLogControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_audit_logs()
    {
        // Cria um usuário para autenticação, caso a rota exija
        $user = User::factory()->create();
        $this->actingAs($user);

        // Cria 3 logs de auditoria no banco para teste
        AuditLog::factory()->count(3)->create([
            'user_id' => $user->id,
            'action' => 'update',
            'old_values' => json_encode(['field1' => 'old']),
            'new_values' => json_encode(['field1' => 'new']),
        ]);

        // Faz requisição GET para a rota dos logs de auditoria
        $response = $this->getJson('/audit-logs'); // ajuste a URL conforme sua rota real

        // Asserções para verificar que retornou sucesso, 3 itens e estrutura correta
        $response->assertStatus(200);
        $response->assertJsonCount(3);
        $response->assertJsonStructure([
            '*' => ['id', 'user_id', 'action', 'old_values', 'new_values', 'created_at']
        ]);
    }

    // Adicione outros testes para criar, filtrar, mostrar detalhes conforme necessário
}
