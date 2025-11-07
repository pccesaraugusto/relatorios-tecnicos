<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_index_returns_success()
    {
        User::factory()->count(3)->create();

        $response = $this->getJson('/users');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'email', 'role_id']
        ]);
    }
}
