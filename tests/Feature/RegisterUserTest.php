<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    /** @test */
    public function it_registers_a_user()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'device_name'=>'app',
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['data' => ['token']]);
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }

    /** @test */
    public function it_requires_a_name_email_and_password()
    {
        $response = $this->postJson('/api/register', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    /** @test */
    public function it_requires_password_confirmation()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['password']);
    }
}
