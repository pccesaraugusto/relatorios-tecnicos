<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_roles()
    {
        $user = User::factory()->create();
        Role::factory()->count(3)->create();

        $this->actingAs($user);

        $response = $this->getJson('/roles');

        $response->assertStatus(200)
            ->assertJsonCount(3); // Removido 'data' já que o controller retorna lista simples
    }

    public function test_store_creates_role()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $payload = [
            'name' => 'Administrator',
            'display_name' => 'Administrator Display',
            'description' => 'Admin role',
        ];

        $response = $this->postJson('/roles', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'Administrator']);

        $this->assertDatabaseHas('roles', ['name' => 'Administrator']);
    }

    public function test_show_returns_single_role()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();

        $this->actingAs($user);

        $response = $this->getJson("/roles/{$role->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $role->name]);
    }

    public function test_update_modifies_role()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create(['name' => 'Old Name', 'display_name' => 'Old Display']);

        $this->actingAs($user);

        $payload = [
            'name' => 'New Name',
            'display_name' => 'New Display',
        ];

        $response = $this->putJson("/roles/{$role->id}", $payload);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'New Name']);

        $this->assertDatabaseHas('roles', ['id' => $role->id, 'name' => 'New Name']);
    }

    public function test_destroy_deletes_role()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();

        $this->actingAs($user);

        $response = $this->deleteJson("/roles/{$role->id}");

        $response->assertStatus(204);

        $this->assertSoftDeleted('roles', ['id' => $role->id]);
    }
}
