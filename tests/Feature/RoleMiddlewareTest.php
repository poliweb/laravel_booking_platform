<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    public function test_admin_can_access_admin_route()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Добро пожаловать, администратор!']);
    }

    public function test_master_can_access_master_route()
    {
        $master = User::factory()->create(['role' => 'master']);

        $response = $this->actingAs($master)->get('/master');

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Добро пожаловать, мастер!']);
    }

    public function test_client_cannot_access_admin_route()
    {
        $client = User::factory()->create(['role' => 'client']);

        $response = $this->actingAs($client)->get('/admin');

        $response->assertStatus(403);
    }
}
