<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login(): void
    {
        $user = User::factory()->create();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'user' => ['email', 'name'],
            'token'
        ]);
    }

    public function test_user_can_see_auth_routes(): void
    {
        $user = User::factory()->create();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $token = $response->json('token');


        $response = $this
            ->withHeader('Authorization', "Bearer {$token}")
            ->get('/api/user');

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ]);
    }
}
