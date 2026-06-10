<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('user can login with valid credentials', function () {
    $user = User::factory()->create([
        'user_name' => 'testuser',
        'password' => Hash::make('password123'),
    ]);

    $response = $this->postJson('/api/auth/login', [
        'user_name' => 'testuser',
        'password' => 'password123',
    ]);

    $response
        ->assertStatus(200)
        ->assertJson([
            'success' => true,
        ])
        ->assertJsonStructure([
            'success',
            'message',
            'user'
        ]);

    $this->assertAuthenticated();
});

test('user cannot login with wrong password', function () {
    User::factory()->create([
        'user_name' => 'testuser',
        'password' => Hash::make('password123'),
    ]);

    $response = $this->postJson('/api/auth/login', [
        'user_name' => 'testuser',
        'password' => 'wrong123',
    ]);

    $response->assertStatus(422);
});

test('login validation errors', function () {
    $response = $this->postJson('/api/auth/login', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['user_name', 'password']);
});