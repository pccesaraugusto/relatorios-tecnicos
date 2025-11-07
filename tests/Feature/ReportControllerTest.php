<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Report; // ajuste se o nome e namespace forem diferentes
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_reports()
    {
        // Cria um usuário para autenticação, caso seja necessário
        $user = User::factory()->create();
        $this->actingAs($user);

        // Cria registros de relatórios para teste
        Report::factory()->count(5)->create();

        // Faz requisição GET para a rota que lista os relatórios
        $response = $this->getJson('/reports'); // ajuste a URL conforme sua rota real

        // Verifica se a resposta foi HTTP 200 OK
        $response->assertStatus(200);

        // Verifica que foram retornados 5 registros
        $response->assertJsonCount(5);

        // Verifica a estrutura esperada da resposta JSON
        $response->assertJsonStructure([
            '*' => ['id', 'title', 'description', 'created_at', 'updated_at']
        ]);
    }

    // Você pode adicionar mais métodos para testar outras funcionalidades do ReportController,
    // como criar, editar, deletar, etc.
}
