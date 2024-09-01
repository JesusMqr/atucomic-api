<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginUserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    /** @test */
    public function it_logs_in_a_user()
    {
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'john@example.com',
            'password' => 'password',
            'device_name' => 'testing-device',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token']]);
    }

    /** @test */
    public function it_requires_an_email_and_password()
    {
        $response = $this->postJson('/api/login', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email', 'password']);
    }

    /** @test */
    public function it_returns_an_error_if_credentials_are_incorrect()
    {
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'john@example.com',
            'password' => 'wrong-password',
            'device_name' => 'testing-device',
        ]);

        $response->assertStatus(422);
        $response->assertJson(['message' => 'The credentials are incorrect']);
    }
}
