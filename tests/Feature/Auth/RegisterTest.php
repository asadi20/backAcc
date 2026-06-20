<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('User can register with valid data', function () {
    $response = $this->postJson('/api/auth/register', [
        'user_name' => 'testUser',
        'name' => 'testName',
        'email' => 'test@email.com',
        'password' => 'password123'
    ]);

    $response->assertStatus(201)
        ->assertJson([
            'success' => true
        ])->assertJsonStructure([
                'success',
                'message',
                'data',
                'error'
            ]);

    $this->assertDatabaseHas('users', [
        'user_name' => 'testUser',
        'email' => 'test@email.com'
    ]);

    $this->assertAuthenticated();
});

test('register validation errors', function () {
    $response = $this->postJson('/api/auth/register', []);

    $response
        ->assertStatus(422)
        ->assertJsonValidationErrors([
            'user_name',
            'name',
            'email',
            'password'
        ]);
});